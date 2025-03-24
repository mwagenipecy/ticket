<?php

namespace App\Jobs;

use App\Models\Email;
use App\Models\EmailThread;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Webklex\PHPIMAP\Client;


class ReadEmailsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $client = $this->connectToIMAP();

            $inboxFolder = $client->getFolder('INBOX');
            $sentFolder = $this->getSentFolder($client);

            $query = $inboxFolder->query();
            $query->all()->setFetchOrder('asc')->chunked(function ($messages, $chunk) use ($sentFolder) {
                Log::info("Processing Chunk #$chunk");

                $messages->each(function ($message) use ($sentFolder) {
                    $this->processMessage($message, $sentFolder);
                });
            }, $chunk_size = 10, $start_chunk = 1);

        } catch (Exception $e) {
            Log::error("IMAP Job Error: " . $e->getMessage());
        }
    }

    /**
     * Establish a connection to the IMAP server.
     */
    protected function connectToIMAP(): Client
    {
        try {
            Log::info('IMAP: Attempting to connect to the server.');

            $client = Client::account('default');
            $client->connect();

            Log::info('IMAP: Connection successful.');

            return $client;
        } catch (Exception $e) {
            Log::error('IMAP Connection Error: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Process a single email message.
     */
    protected function processMessage($message, $sentFolder)
    {
        try {
            Log::info("Processing Message UID: " . $message->uid);

            Email::updateOrCreate(
                ['message_id' => $message->getMessageId()],
                [
                    'subject'      => $message->getSubject(),
                    'from_email'   => $message->getFrom()[0]->mail ?? 'unknown',
                    'body'         => $message->getTextBody(),
                    'flags'        => json_encode($message->getFlags()->all()),
                    'received_at'  => $message->getDate(),
                    'true_false'   => true,
                    'level'        => 1,
                ]
            );

            $this->processThread($message, $sentFolder);

            $message->setFlag('Seen');

            Log::info("Successfully processed email: " . $message->getSubject());
        } catch (Exception $e) {
            Log::error("Error processing email: " . $e->getMessage());
        }
    }

    /**
     * Process an email thread.
     */
    protected function processThread($message, $sentFolder)
    {
        $thread = $message->thread($sentFolder);

        foreach ($thread as $threadMessage) {
            try {
                Email::firstOrCreate(
                    ['message_id' => $threadMessage->getMessageId()],
                    [
                        'subject'     => $threadMessage->getSubject(),
                        'from_email'  => $threadMessage->getFrom()[0]->mail ?? 'unknown',
                        'body'        => $threadMessage->getTextBody(),
                        'flags'       => json_encode($threadMessage->getFlags()->all()),
                        'received_at' => $threadMessage->getDate(),
                        'true_false'  => true,
                        'level'       => 2,
                    ]
                );

                EmailThread::firstOrCreate([
                    'email_id'  => $threadMessage->id,
                    'thread_id' => $message->getMessageId(),
                ]);
            } catch (Exception $e) {
                Log::error("Error saving thread email: " . $e->getMessage());
            }
        }
    }

    /**
     * Retrieve the sent folder.
     */
    protected function getSentFolder($client)
    {
        $possibleSentFolders = ['Sent', 'Sent Items', 'Sent Mail'];

        foreach ($possibleSentFolders as $folderName) {
            try {
                return $client->getFolder($folderName);
            } catch (Exception $e) {
                continue;
            }
        }

        throw new Exception('Sent folder not found.');
    }
}
