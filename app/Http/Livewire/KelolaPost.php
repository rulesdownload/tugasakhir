<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\post_raw;
use App\Models\drainaseProblems;
use App\Models\drainaseTypes;
use App\Models\AdditionalPhotos;
use Livewire\WithFileUploads;
use App\Models\Status;
use App\Models\comment;
use Illuminate\Http\Request;

use \Illuminate\Session\SessionManager;

class KelolaPost extends Component
{
    public $posts = [];
    public $postId = [];
    public $reports;
    public $latitude;
    public $longitude;
    public $type = [];
    public $tipe = [];
    public $problem = [];
    public $prompt;
    public $photos = [];
    public $status;
    public $status_value = [];
    public $progresphotos = [];
    public $progresphotoshow = [];
    public $donephotos = [];
    public $donephotoshow = [];
    public $progtext = [];
    public $donetext;
    use WithFileUploads;
    //komentar
    public $created_at;
    public $comment_input;
    public $commentprompt;
    protected $listeners = ['postViewed' => 'adminHandle', 'postUpdated','CommentCreated','showComment'=>'Comment'];

    public function mount($id)
    {
       $reports = post_raw::find($id);
       $this->posts = $reports; 
       //saat proses update dibutuhkan sebuah nilai. nilainya yaitu property post Id.
       $this->postId = $reports->id;
       $this->dispatchBrowserEvent('latitude-loaded', [
        'latitude' => $this->latitude = $this->posts->lat
    ]);

    $this->dispatchBrowserEvent('longitude-loaded', [
        'longitude' => $this->longitude = $this->posts->lng
    ]);

        $this->photos = additionalphotos::where('post_raw_id', $reports->id)->get();
        $this->progresphotoshow = additionalphotos::where('post_raw_id', $reports->prog_id)->get();
        $this->donephotoshow = additionalphotos::where('post_raw_id', $reports->done_id)->get();    
//jika status id = 1(belum dibaca) maka nilai berubah jadi 2 (telah dibaca) 
        if($this->posts->status_id == 1){
            $this->posts->status_id = 2;
            $this->posts->save();
        }

    //komentar
    // $this->koment = Comment::where('post_raw_id', $reportId)->get();
    }

    public function postUpdated()
    {
        $this->prompt ="berhasil diperbaharui";
    }

    public function CommentCreated()
    {
        $this->commentprompt = "Komentar berhasil terkirim";

    }       

    public function photoProgCreated()
    {
        $this->prompt ="berhasil dibuat";
    }

    protected function rules() {
        return [

            'problem' => 'required',
            'type' =>'required',
            'status'=>'required',
            'comment_input' =>'',   
        ];
    }

    public function update()
    {
        $this->validate();

        if($this->postId) {
            $post = post_raw::find($this->postId);
            $post->update([
                'problem_id' => $this->problem,
                'tipe_id' => $this->type,
                'status_id' => $this->status,

            ]);
        }
    
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

    public function addProsesPhotos()
    {
       
       foreach ($this->progresphotos as $pphoto) {
            $pphoto->store('additional_photos','public');

            AdditionalPhotos::create([
                'post_raw_id' => $this->posts->prog_id,
                'filename' => $pphoto->hashName()
            ]);
        }
    }

    public function addDonePhotos()
    {

       foreach ($this->donephotos as $pphoto) {
            $pphoto->store('additional_photos','public');

            AdditionalPhotos::create([
                'post_raw_id' => $this->posts->done_id,
                'filename' => $pphoto->hashName()
            ]);
        };
    }

    public function createProgTxt()
    {        

        if($this->postId) {
            $post = post_raw::find($this->postId);
            $post->update([
                'progtxt' => $this->progtext
            ]);
        }
     
    }
    public function createDoneTxt()
    {
     
        if($this->postId) {
            $post = post_raw::find($this->postId);
            $post->update([
                'donetxt' => $this->donetext
            ]);
        }
     
    }
    public function render()
    {
        
        return view('livewire.kelola-post', [
                'problems' => DrainaseProblems::all(),
                'types' => DrainaseTypes::all(),
                'stats' => Status::all(),
                'koment' => Comment::all(),
        ])
        ->layout('layouts.admin');

    }
}
