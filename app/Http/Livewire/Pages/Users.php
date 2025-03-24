<?php

namespace App\Http\Livewire\Pages;

use App\Mail\UserCredentials;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Livewire\Component;

class Users extends Component
{
    public $name;
    public $email;
    public $level;
    public $addUser = false;

    public $users;
    public $selectedUserId;


    public function mount()
    {
        $this->users = DB::table('users')->get();
    }

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'level' => 'required|in:1,2,3',
    ];

    public function createUser()
    {
        $this->validate();

        $password = Str::random(8); // Generate a random password

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'level' => $this->level,
            'password' => Hash::make($password),
        ]);

        // Send login credentials via email
        Mail::to($this->email)->send(new UserCredentials($user, $password));

        session()->flash('success', 'User created successfully, and credentials sent via email!');

        $this->reset(['name', 'email', 'level']);
        $this->addUser = false;
    }

    public function showForm()
    {
        $this->addUser = true;
    }




    public function edit($userId)
    {
        $this->selectedUserId = $userId;
        $user = DB::table('users')->find($userId);
        $this->level = $user->level;
        $this->name = $user->name;
        $this->email = $user->email;
    }

    public function updateLevel()
    {
        $this->validate([
            'level' => 'required|integer|min:1|max:3',
        ]);

        DB::table('users')->where('id', $this->selectedUserId)->update([
            'level' => $this->level,
            'name' => $this->name,
            'email' => $this->email,
        ]);

        // Refresh data
        $this->users = DB::table('users')->get();
        session()->flash('success', 'User level updated successfully.');

        // Wait for 3 seconds
        sleep(1);

        // Reset fields
        $this->reset(['level', 'name', 'email', 'selectedUserId']);
    }




    public function render()
    {
        $this->users = DB::table('users')->get();
        return view('livewire.pages.users');
    }
}
