<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\post_raw;
use Illuminate\Http\Request;  

class ShowPosts extends Component
{
    protected $listener = ['DetailPost'];
    public $posts;
    public function render()
    {
        return view('livewire.show-posts',[
            'reports' => post_raw::with(['user'])->where('user_id', auth()->user()->id)->get()
            
        ]);
	$this->emit('modalDestroy');
    }

    public function confirmDestroy()
    {
        $this->emit('modalDestroy');
    }

    public function DetailPost()
    {

        $this->emit('toggleGalaxyFormModal');

    }
}
