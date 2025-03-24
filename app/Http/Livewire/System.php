<?php

namespace App\Http\Livewire;

use Livewire\Component;

class System extends Component
{
    public $page = 1;


    protected $listeners = ['menuClicked' => 'handleMenuClick'];

    public function handleMenuClick($data)
    {
        $this->page = $data;

    }

    public function render()
    {
        return view('livewire.system');
    }
}
