<?php

namespace App\Http\Livewire\Sidebar;

use Livewire\Component;

class Sidebar extends Component
{

    public $page = 1;
    public function setMenu($xy): void
    {
        $this->page = $xy;

        //set page name
        session()->put("page-name",$this->pageName($xy));
        $this->emit('menuClicked',$xy);
    }
    public function render()
    {
        return view('livewire.sidebar.sidebar');
    }


    public function pageName($id){
        
        switch ($id) {

            case 1:
                return 'Dashboard';
                break;
            case 2:
                return 'Tickets';
                break;
            case 3:
                return 'Users';
                break;
            case 4:
                return 'Levels';
                break;

                case 5:
                    return 'profile';
                    break;

              default:
                return 'Dashboard';
                break;
            }  
    }
}
