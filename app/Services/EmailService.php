<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Models\Email;
use Webklex\PHPIMAP\Exceptions\ConnectionFailedException;
use Webklex\PHPIMAP\Exceptions\AuthFailedException;
use Webklex\PHPIMAP\Exceptions\ImapBadRequestException;
use Webklex\PHPIMAP\Exceptions\ImapServerErrorException;
use Webklex\PHPIMAP\Exceptions\ResponseException;
use Webklex\PHPIMAP\Exceptions\EventNotFoundException;
use Webklex\PHPIMAP\Exceptions\GetMessagesFailedException;


use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

use App\Models\EmailThread;
use Illuminate\Database\QueryException;
use PhpImap\Mailbox;


use Exception;
use Illuminate\Support\Facades\DB;
use Webklex\IMAP\Facades\Client;

use Webklex\PHPIMAP\Exceptions\RuntimeException;


class EmailService
{
    /**
     * Connect to the IMAP server
     */
    protected function connectToIMAP()
    {
        try {
            Log::info('IMAP: Attempting to connect to the server.');

            $client = Client::account('default');
            $client->connect();

            Log::info('IMAP: Connection successful.');

            return $client;
        } catch (ConnectionFailedException | AuthFailedException | ImapBadRequestException | ImapServerErrorException | ResponseException | RuntimeException $e) {
            Log::error('IMAP Connection Error: ' . $e->getMessage(), [
                'exception' => $e,
                'trace' => $e->getTraceAsString(),
            ]);

            // Optionally rethrow the exception if you want to handle it elsewhere
            throw $e;
        }
    }

    /**
     * Read and process emails from the IMAP server
     */
    public function readEmails()
    {
        try {
            $client = $this->connectToIMAP();

            Log::info('Access the INBOX folder and fetch messages from the last 70 days');

            // Access the INBOX folder and fetch messages from the last 70 days
            $inboxFolder = $client->getFolder('INBOX');
            $query = $inboxFolder->query()->since(now()->subDays(70));

            Log::info('Access the INBOX folder and fetch messages from the last 70 days , process done');

            $query->setFetchOrder('asc')->chunked(function ($messages, $chunk) use ($inboxFolder) {
                Log::info("Processing Chunk #$chunk");

                $this->processMessagesBatch($messages, $inboxFolder);
            }, $chunk_size = 50, $start_chunk = 1);

        } catch (AuthFailedException | ConnectionFailedException | EventNotFoundException |
        GetMessagesFailedException | ImapBadRequestException | ImapServerErrorException |
        ResponseException | RuntimeException $e) {
            Log::error("IMAP Error: " . $e->getMessage());
        } catch (\Exception $e) {
            Log::error("General Error: " . $e->getMessage());
        }
    }

    /**
     * Process a batch of email messages
     */
    protected function processMessagesBatch($messages, $inboxFolder)
    {
        foreach ($messages as $message) {
            // Parse metadata
            $emailData = [
                'message_id'  => $message->getMessageId()->first(),
                'subject'     => $message->getSubject()->first(),
                'from_email'  => $message->getFrom()[0]->mail ?? 'unknown',
                'body'        => $message->getTextBody(),
                'flags'       => json_encode($message->getFlags()->all()),
                'received_at' => $message->getDate()->first()->toDateTimeString(),
                'true_false'  => true,
                'level'       => 1,
                'status'      => 'New',
            ];

            $email = Email::create($emailData);

            // Handle attachments
            foreach ($message->getAttachments() as $attachment) {
                $filename = 'attachments/' . $email->id . '/' . $attachment->name;
                Storage::disk('local')->put($filename, $attachment->content);

                // Uncomment if you have an attachments relationship set up
                // $email->attachments()->create([
                //     'filename' => $attachment->name,
                //     'path' => $filename,
                //     'size' => $attachment->size()
                // ]);
            }

            // Mark as seen
            $message->setFlag('Seen');
        }

        Log::info("Batch processing complete.");
    }
}