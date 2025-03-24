<?php

namespace App\Http\Livewire\Pages;

use App\Mail\UserCredentials;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Livewire\Component;

class Settings extends Component
{

    public $name;
    public $email;
    public $level;
    public $addUser = false;

    public $users;
    public $selectedUserId;

    public $level_name;
    public $excallation_email;
    public $response_time;
    public $resolution_time;


    public function mount()
    {
        $this->users = DB::table('users')->get();
    }

    protected $rules = [
        'level_name' => 'required|string|max:255',
        'excallation_email' => 'required|email|unique:users,email',
        'response_time' => 'required',
        'resolution_time' => 'required',
    ];

    public function createTicketLevel()
    {
        $this->validate([
            'level_name' => 'required|string|max:100',
            'excallation_email' => 'required|email|max:255',
            'response_time' => 'required|integer|min:1',
            'resolution_time' => 'required|integer|min:1',
        ]);

        try {
            DB::table('levels')->insert([
                'level_name' => $this->level_name,
                'excallation_email' => $this->excallation_email,
                'response_time' => $this->response_time,
                'resolution_time' => $this->resolution_time,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            session()->flash('success', 'Ticket level created successfully!');
            $this->reset(['level_name', 'excallation_email', 'response_time', 'resolution_time']);
            $this->addUser = false;

        } catch (\Exception $e) {
            session()->flash('error', 'Error creating ticket level: ' . $e->getMessage());
        }
    }

    public function showForm()
    {
        $this->addUser = true;
    }




    public function edit($userId)
    {
        $this->selectedUserId = $userId;
        $user = DB::table('levels')->find($userId);
        $this->level_name = $user->level_name;
        $this->excallation_email = $user->excallation_email;
        $this->response_time = $user->response_time;
        $this->resolution_time = $user->resolution_time;

    }

    public function updateLevel()
    {
//        $this->validate([
//            'level' => 'required|integer|min:1|max:3',
//        ]);



        DB::table('levels')->where('id', $this->selectedUserId)->update([
            'level_name' => $this->level_name,
            'excallation_email' => $this->excallation_email,
            'response_time' => $this->response_time,
            'resolution_time' => $this->resolution_time,
        ]);

        // Refresh data
        $this->users = DB::table('levels')->get();
        session()->flash('success', 'User level updated successfully.');

        // Wait for 3 seconds
        sleep(1);

        // Reset fields
        $this->reset(['level_name', 'excallation_email', 'response_time', 'resolution_time']);
    }





    public function render()
    {
        $this->users = DB::table('levels')->get();
        return view('livewire.pages.settings');
    }
}
