<?php

namespace App\Http\Livewire\Pages;

use App\Models\User;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

use App\Models\Email;
use App\Models\EmailThread;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use PhpImap\Mailbox;


use Exception;
use Illuminate\Support\Facades\DB;
use Webklex\IMAP\Facades\Client;
use Webklex\PHPIMAP\Exceptions\AuthFailedException;
use Webklex\PHPIMAP\Exceptions\ConnectionFailedException;
use Webklex\PHPIMAP\Exceptions\EventNotFoundException;
use Webklex\PHPIMAP\Exceptions\GetMessagesFailedException;
use Webklex\PHPIMAP\Exceptions\ImapBadRequestException;
use Webklex\PHPIMAP\Exceptions\ImapServerErrorException;
use Webklex\PHPIMAP\Exceptions\ResponseException;
use Webklex\PHPIMAP\Exceptions\RuntimeException;


class Tickets extends Component
{



    public $threads;
    public array $emails = [];
    public $threadID;


    public $receivedId;

    public $email_body;

    public $subject;

    public $from;

    public $received_at;

    public $emailThreads;

    public $content;

    public $last_email_id;

    public $last_message_id;


    public $selectedEmail;
    public $replies = [];

    public $userAssigned;

    public $progress = [];
    public $totalDays = 0;

    public $statuses;
    public $activeStatus = 0;
    public $status_name;
    public $groupedEmails;
    public $ticket_status;
    public $level_id;

    public $userLevelId;


    public function boot(): void
    {

  if(auth()->user()->level==0){

    $this->userLevelId=DB::table("levels")->pluck("id")->toArray();

  }else{
    $this->userLevelId= [auth()->user()->level];
  }


        // TODO  run every five minutes
       // $this->readEmails();


    }




    public function mount()
    {
        $statuses = DB::table('ticket_statuses')->get();
        foreach ($statuses as $status) {
            $status->totalNumber = DB::table('emails')
                ->where('status', $status->status_name)
                ->whereIn('level', $this->userLevelId)
                ->count();   
        }

        $this->statuses = $statuses;

      }

    public function setView($statusId)
    {

        if (str_ends_with($statusId, 'a')) {
            $levelid = str_ireplace('a', '', $statusId);
            $this->level_id = $levelid;
            $this->status_name = null;
        } else {
            $this->activeStatus = $statusId;
            $this->status_name = DB::table('ticket_statuses')->where('id',$statusId)->value('status_name');
            $this->level_id = null;
        }

    }

    public function set()
    {

        // Update the 'emails' table
        DB::table('emails')
            ->where('id', $this->last_message_id)
            ->update([
                'status' => $this->ticket_status,
            ]);

        DB::table('tasks')
            ->where('ticket_id', $this->last_message_id)
            ->where('which_is_current', 'current')
            ->update([
                'status' => $this->ticket_status,
            ]);


    }

    public function goback()
    {
        $this->reset([
            'threads',
            'emails',
            'threadID',
            'receivedId',
            'email_body',
            'subject',
            'from',
            'received_at',
            'emailThreads',
            'content',
            'last_email_id',
            'last_message_id',
            'selectedEmail',
            'replies',
            'userAssigned',
            'progress',
            'totalDays',
            'statuses',
            'groupedEmails',
            'ticket_status'
        ]);

    }



    public function handleViewEmail($id)
    {
        //dd('hghg');
        // Fetch the original email
        // Fetch the original email and convert it to an array
        $this->last_message_id = $id;
        $email = DB::table('emails')->find($id);

        if ($email) {
            $this->selectedEmail = (array) $email;

            // Get replies (with RE: in the subject and same subject)
            $this->replies = DB::table('emails')
                ->where('subject', 'LIKE', "RE: {$email->subject}")
                //->where('from_email', $email->from_email)
                ->orderBy('created_at', 'asc')
                ->get()
                ->toArray(); // Convert replies to array
        }

        $this->loadProgress();
    }

    public function assign()
    {


        if($this->userAssigned and $this->last_message_id){


            // Fetch the user's level
            $level = DB::table('users')->where('id', $this->userAssigned)->value('level');

            // Update the 'emails' table
            DB::table('emails')
                ->where('id', $this->last_message_id)
                ->update([
                    'current_task_user' => $this->userAssigned,
                    'status' => 'In Progress',
                    'level' => $level,
                ]);

            DB::table('tasks')
                ->where('ticket_id', $this->last_message_id)
                ->where('which_is_current', 'current')
                ->update([
                    'status' => 'Assigned',
                    'which_is_current' => 'passed'
                ]);

            // Insert into the 'tasks' table
            DB::table('tasks')->insert([
                'ticket_id' => $this->last_message_id,
                'assigned_to_id' => $this->userAssigned,
                'assigned_by_id' => Auth::user()->id,
                'status' => 'In Progress',
                'level' => $level,
                'which_is_current' => 'current',
                'days' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);


            $this->reset(['userAssigned']);
        }

    }

    public function loadProgress()
    {
        $tasks = DB::table('tasks')
            ->where('ticket_id', $this->last_message_id)
            ->orderBy('created_at')
            ->get();

        $this->progress = $tasks->map(function ($task, $index) use ($tasks) {
            $next = $tasks[$index + 1] ?? null;
            $task->duration = $next
                ? now()->diffInDays($task->created_at)
                : now()->diffInDays($task->created_at);

            return $task;
        });

        $this->totalDays = $this->progress->sum('duration');
    }




    /**
     * @throws \PhpImap\Exception
     */
    public function saveTrixContent($data)
     {

         $this->content = $data;

        $this->respondToEmail($this->last_message_id, $this->content);

         // Handle content (e.g., save to the database)
         session()->flash('message', 'Content saved successfully!');
     }



    public function handleViewEmailx($id)
    {

        $this->receivedId = $id;
        $this->email_body = Email::where('id',$id)->where('level', 1)->value('body');
        $this->subject = Email::where('id',$id)->where('level', 1)->value('subject');
        $this->from = Email::where('id',$id)->where('level', 1)->value('from_email');
        $this->received_at = Email::where('id',$id)->where('level', 1)->value('received_at');
        $this->message_id = Email::where('id',$id)->where('level', 1)->value('message_id');

        $this->emailThreads = DB::table('email_threads')
        ->where('thread_id', $this->message_id)
        ->get();

        $this->last_email_id = DB::table('email_threads')
    ->where('thread_id', $this->message_id)
    ->orderBy('id', 'desc') // Sort by 'id' in descending order
    ->pluck('email_id') // Get only the email_id
    ->first();
        $this->last_message_id = Email::where('id',$this->last_email_id)->value('message_id');

//dd($this->last_message_id);

    }

    public function toggleDivs(){
        //dd($this->receivedId);
        $this->receivedId = null;
        $this->email_body = null;
        $this->subject = null;
        $this->from = null;
        $this->received_at = null;
    }





    public function showTicket($x)
    {

        $this->threadID = $x;

    }





/**
 * Establishes a connection to the IMAP server and retries on failure.
 */
    protected function connectToIMAP(): \Webklex\PHPIMAP\Client
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



    public function readEmails()
    {

        try {
            $client = $this->connectToIMAP();
            //$this->clientx = $client;

            // Access the INBOX folder and fetch only unseen messages
            $inboxFolder = $client->getFolder('INBOX');
            //$query = $inboxFolder->query()->unseen();

            //$query = $inboxFolder->query()->unseen()->since(now()->subDays(7)); // Last 7 days
            $query = $inboxFolder->query()->since(now()->subDays(70));

            $query->setFetchOrder('asc')->chunked(function ($messages, $chunk) use ($inboxFolder) {
                Log::info("Processing Chunk #$chunk");

                $this->processMessagesBatch($messages,$inboxFolder);
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
     * Processes a batch of messages.
     */
    protected function processMessagesBatch($messages,$inboxFolder)
    {



//
//        $emailsToInsert = [];
//        $messageUids = [];
//
//        $messages->each(function ($message) use ($imap, $emailsToInsert, &$messageUids) {
//            Log::info("Processing Message UID: " . $message->uid);
//            dd($message);
//            $emailsToInsert[] = [
//                'message_id'  => $message->getMessageId(),
//                'subject'     => $message->getSubject(),
//                'from_email'  => $message->getFrom()[0]->mail ?? 'unknown',
//                'body'        => $message->getTextBody(),
//                'flags'       => json_encode($message->getFlags()->all()),
//                'received_at' => $message->getDate(),
//                'true_false'  => true,
//                'level'       => 1,
//                'status'      => 'New',
//            ];
//
//            $messageUids[] = $message->uid;
//
//            imap_setflag_full($imap, $message->uid, '\\Seen');
//
//        });
//
//
//        // Batch insert all emails
//        if (!empty($emailsToInsert)) {
//            Email::insert($emailsToInsert);
//        }
//
//        // Batch mark messages as "Seen"
//        if (!empty($messageUids)) {
//            //$messages->first()->getFolder()->batchSetFlag('Seen', $messageUids);
//
//            //$inboxFolder->setFlag(['\Seen'], $messageUids);
//
//            //imap_setflag_full($this->clientx, (string)$messageUids, '\\Flagged', ST_UID);
//
//        }
//

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

            //dd($emailData);

            $email = Email::create($emailData);

            // Handle attachments
            foreach ($message->getAttachments() as $attachment) {
                $filename = 'attachments/' . $email->id . '/' . $attachment->name;
                Storage::disk('local')->put($filename, $attachment->content);

//                $email->attachments()->create([
//                    'filename' => $attachment->name,
//                    'path' => $filename,
//                    'size' => $attachment->size()
//                ]);
            }

            // Mark as seen
            $message->setFlag('Seen');
        }


        Log::info("Batch processing complete.");
    }



    /**
     * @throws \PhpImap\Exception
     */
    public function respondToEmail($messageId, $replyBody)
    {
        try {
            // Ensure IMAP storage directory exists
            $imapStoragePath = storage_path('app/imap');
            if (!File::exists($imapStoragePath)) {
                File::makeDirectory($imapStoragePath, 0777, true);
            }

            // Fetch the email details once
            $email = Email::find($messageId);
            if (!$email) {
                Log::warning("Email with ID: {$messageId} not found.");
                return response()->json(['status' => 'error', 'message' => 'Email not found.'], 404);
            }

            // Prepare response message details
            $replySubject = 'Re: ' . $email->subject;
            $replyFrom = env('MAIL_FROM_ADDRESS', 'default@example.com');
            $replyTo = $email->from_email;

            // Generate a unique message ID for the reply
            $theid = $messageId . "_x" . bin2hex(random_bytes(3));

            // Send the reply email
            try {
                Mail::send([], [], function ($message) use ($replyFrom, $replyTo, $replySubject, $replyBody) {
                    $message->from($replyFrom, 'Andrew Mashamba')
                        ->to($replyTo)
                        ->subject($replySubject)
                        ->html($replyBody . '<br><br><p>If this was not intended for you, please ignore this message.</p>')
                        ->text(strip_tags($replyBody))
                        ->replyTo('support@zima.co.tz', 'Zima Support');
                });

                Log::info("Email successfully sent to: {$replyTo}");

                // Store the response in the database
                Email::firstOrCreate(
                    ['message_id' => $theid],
                    [
                        'subject'     => $replySubject,
                        'from_email'  => $replyFrom,
                        'body'        => $replyBody,
                        'flags'       => '',
                        'received_at' => Date::now(),
                        'true_false'  => true,
                        'level'       => 2, // Responses are level 2
                    ]
                );

                Log::info("Response recorded for email with Subject: {$replySubject}");
                return response()->json(['status' => 'success', 'message' => 'Email sent successfully.']);
            } catch (\Exception $e) {
                Log::error("Failed to send email to {$replyTo}. Error: {$e->getMessage()}");
                return response()->json(['status' => 'error', 'message' => 'Failed to send email.', 'error' => $e->getMessage()], 500);
            }
        } catch (ConnectionException $e) {
            Log::error("IMAP connection error: " . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'IMAP connection failed.', 'error' => $e->getMessage()], 500);
        } catch (\Exception $e) {
            Log::error("Unexpected error: " . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'An unexpected error occurred.', 'error' => $e->getMessage()], 500);
        }
    }




    public function render()
    {

        //$this->statuses = DB::table('ticket_statuses')->get();

        if($this->last_message_id){

            $email = DB::table('emails')->find($this->last_message_id);

            if ($email) {
                $this->selectedEmail = (array) $email;

                // Get replies (with RE: in the subject and same subject)
                $this->replies = DB::table('emails')
                    ->where('subject', 'LIKE', "RE: {$email->subject}")
                    //->where('from_email', $email->from_email)
                    ->orderBy('created_at', 'asc')
                    ->get()
                    ->toArray(); // Convert replies to array
            }
        }
        //$this->threads = Email::where('level', 1)->get();



        $query = DB::table('emails')
            ->select('id', 'subject', 'from_email', 'body', 'created_at')
            ->orderBy('created_at', 'asc');

        // Apply filters if they exist
        if ($this->status_name) {

            $query->where('status', $this->status_name);
        } 
        
        // if ($this->level_id) {
        //     $query->where('level', $this->level_id);
        // }


          
        if ($this->userLevelId) {
            $query->whereIn('level', $this->userLevelId);
        }


        // Execute the query
        $emails = $query->get();

        // Group by the original subject (without "RE:")
        $this->groupedEmails = $emails->groupBy(fn($email) => preg_replace('/^RE:\s*/i', '', $email->subject));


        $this->loadProgress();

        return view('livewire.pages.tickets');
    }
}
