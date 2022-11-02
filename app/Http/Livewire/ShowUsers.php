<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post_raw;
use App\Models\City;
use App\Models\District;
use Illuminate\Http\Request;  

class ShowUsers extends Component
{
    public function render()
    {
        return view('livewire.show-users',[
            'reports' => Post_raw::all()
        ]);

    }
}
