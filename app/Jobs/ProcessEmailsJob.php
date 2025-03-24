<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use Illuminate\Support\Facades\Log;

class ProcessEmailsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            Log::info('Starting email processing job');
            
            // Create an instance of your class that contains the email processing methods
            // Assuming it's called EmailService in the App\Services namespace
            $emailService = app(\App\Services\EmailService::class);
            
            // Call the readEmails method to process emails
            $emailService->readEmails();
            
            Log::info('Email processing job completed successfully');
        } catch (\Exception $e) {
            Log::error('Email processing job failed: ' . $e->getMessage(), [
                'exception' => $e,
                'trace' => $e->getTraceAsString(),
            ]);
        }


    }
}
