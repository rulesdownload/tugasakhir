<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post_raw;
use Illuminate\Http\Request;  

class ShowPosts extends Component
{
    protected $listener = ['DetailPost'];
    public $posts;
    public function render()
    {
        return view('livewire.show-posts',[
            'reports' => Post_raw::with(['user'])->where('user_id', auth()->user()->id)->get()
            
        ]);
    }

    public function DetailPost()
    {

        $this->emit('toggleGalaxyFormModal');

    }
}
