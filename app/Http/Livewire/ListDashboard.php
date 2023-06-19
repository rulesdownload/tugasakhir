<?php

namespace app\Http\Livewire;

use Livewire\Component;
use App\Models\post_raw;
use App\Models\City;
use App\Models\drainaseProblems;
use App\Models\Marker;
use app\Models\district;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;

class ListDashboard extends Component
{
    public $posts = [];
    public $latitudes = [];
    public $longitudes = [];
    public $markers = [];
    public $problems = [];
    public $latarray = [];
    public $lngarray = [];
    public $markerlist = [];
    public $sortby = 'id';
    public $direction = 'asc';
    protected $listener = ['DetailPost'];

    public function mount()
    {
        //flatmap iterasi
        $this->posts = post_raw::all()->toJSON();
        $this->postsflat = post_raw::all()->flatmap(function($item, $key){

            $this->problemlists = drainaseProblems::all()->where('id','=', $item['problem_id']);
            return $this->problemlists;
        });

        $this->markerlists = $this->postsflat->flatmap(function($item, $key){
            $this->markerfind = Marker::all()->where('id','=',$item['marker_id']);
            return $this->markerfind;
        });

        $this->latarray = post_raw::all('lat','problem_id')->toJSON();
        $this->lngarray = post_raw::all('lng','problem_id')->toJSON();

        $this->dispatchBrowserEvent('problem-loaded',[
            'problems' => $this->problems = $this->posts
        ]);

        $this->dispatchBrowserEvent('marker-loaded',[
            'markers' => $this->markers = $this->markerlists->toJSON()
        ]);


        $this->dispatchBrowserEvent('latitude-loaded',[
            'latitudes' => $this->latitudes = $this->latarray
        ]);


        $this->dispatchBrowserEvent('longitude-loaded',[
            'longitudes' => $this->longitudes = $this->lngarray
        ]);
    }
    
    public function sorting($field, $direction)
    {

        $this->sortby = $field;
        $this->direction = $direction;

    }

    public function DetailPost()
    {

        $this->emit('toggleGalaxyFormModal');

    }

    public function render()
    {

        $lists = post_raw::orderBy($this->sortby, $this->direction);
        
        return view('livewire.list-dashboard', [
            'lists' => $lists->get(),
            'problemos' => drainaseProblems::all()->sortby('marker_id'),
            'fotos' => Marker::all()
        ]);
    }
}
