<?php

namespace App\Http\Livewire\Pages;

use App\Jobs\ProcessEmailsJob;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Dashboard extends Component
{
    public $groupedEmails;



    public function runJob(){
        
        ProcessEmailsJob::dispatch();

        dd("done");

    }

    public function render()
    {


        $query = DB::table('emails')
            ->select('id', 'subject', 'from_email', 'body', 'created_at')
            ->where('status','New')
            ->orderBy('created_at', 'asc');

        $emails = $query->get();

        // Group by the original subject (without "RE:")
        $this->groupedEmails = $emails->groupBy(fn($email) => preg_replace('/^RE:\s*/i', '', $email->subject));


        return view('livewire.pages.dashboard');
    }
}
