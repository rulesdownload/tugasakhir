<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\post_raw;
use App\Events\notifevent;
use App\Models\User;
use Livewire\WithPagination;

class Notifadmin extends Component
{
protected $listeners = ["echo:notifchannel,.notifevent" => 'notifyNewOrder'];
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
       $this->showNewReportNotification = true;

    }

    public function getData($event)
    {
	dd($event);
    }
    public function render()
    {	
        return view('livewire.notifadmin', [
	'reports' => Post_raw::latest()->paginate(5),
       ]);
    }
}
