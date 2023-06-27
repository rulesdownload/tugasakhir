<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\post_raw;
use App\Events\notifevent;
use App\Models\User;
class Notifadmin extends Component
{
protected $listeners = ["echo:notifchannel,notifevent" => 'notifyNewOrder'];
public $data=[];
public $reportnewid=[];
public $showNewReportNotification = false;
    
    public function getReportNewId($value)
    {
     $this->reportnewid = $value;
     dd($this->reportnewid); 
    }

    public function notifyNewOrder($event)
    {
	dd($event);
       $this->showNewReportNotification = true;

    }

    public function getData($event)
    {
	dd($event);
    }
    public function render()
    {	
        return view('livewire.notifadmin', [
	'reports' => Post_raw::latest()->get(),
       ]);
    }
}
