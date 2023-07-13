<?php

namespace App\Http\Livewire;

use App\Events\ReportSent;
use Livewire\Component;
use App\Models\post_raw;
use App\Models\City;
use App\Models\User;
use App\Models\district;
use App\Models\AdditionalPhotos;
use App\Models\comment;
use Livewire\WithFileUploads;
class Index extends Component
{

    protected $listeners = ['open'=>'loadPosts', 'CommentCreated','refreshParentComponent' => '$refresh'];
    public $cities = [];
    public $districts= [];
    public $posts = [];
    public $postId = [];
    public $reports;
    public $latitude;
    public $longitude;
    public $photos = [];
    public $progresphotoshow = []; 
    public $donephotoshow = [];
    //komentar
    public $created_at;
    public $comment_input;
    public $commentprompt;

    public function loadPosts($uid)
    {
	$this->uid = $uid - 1;
	$reports = post_raw::all()->get($this->uid);
        $this->posts = $reports;
        $this->postId = $reports->id;

        $this->dispatchBrowserEvent('latitude-loaded', ['alat' => $this->latitude = $reports->lat]);
        $this->dispatchBrowserEvent('longitude-loaded', ['alng' => $this->longitude = $reports->lng]);

        $this->photos = AdditionalPhotos::where('post_raw_id', $reports->id)->get();
        $this->donephotoshow = additionalphotos::where('post_raw_id', $reports->done_id)->get();
        $this->progresphotoshow = additionalphotos::where('post_raw_id', $reports->prog_id)->get();    
        // binding Kecamatan dan Kelurahan berdasarkan post yang dipilih user
        $this->cities = City::where('id', $reports->city_id)->get();
        $this->districts = District::where('id', $reports->district_id)->get();
	$this->emit('toggleGalaxyFormModal');
        $this->emit('confirmDestroy');
        }

    protected function rules()
    {
        return[
            
            'comment_input' =>'',   
        ];
    }

    public function CommentCreated()
    {
        $this->commentprompt = "Komentar berhasil terkirim";
    }
    
    public function confirmDestroy()
    {
	$this->emit('modalDestroy');
    }

    public function addComment()
    {
        Comment::create([
            'komentar' => $this->comment_input,
            'user_id'=> auth()->user()->id,
            'post_raw_id' => $this->posts->id,
        ]);

        $this->emit('CommentCreated');
        $this->reset('comment_input');
    }

    public function render()
    {
 
        return view('livewire.index', [
            'koment'=> comment::all()
        ]);

    }
}
