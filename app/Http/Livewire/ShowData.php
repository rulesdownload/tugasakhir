<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\post_raw;
use App\Models\district;
use App\Models\city;
use App\Models\drainaseProblems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class ShowData extends Component
{
    public $kecamatan = [];
    public $kec;
    public $kel;
    public $kectot = [];
    public $post;
    public $statdone;
    public $statprog;
    public $statunread;
    public $statread;
    public $probcount;
    public $probnama;
    public $postdate;
    public $monthpost;
    public $monthcount;

   public function mount()
    {
      $post = Post_raw::all()->count();
      $this->jumposts= $post;
     
      $statdone = Post_raw::where('status_id','=',5)->count();
      $this->statdone = $statdone;

      $statprog = Post_raw::where('status_id','=',4)->count();
      $this->statprog = $statprog;

      $statunread = Post_raw::where('status_id','=',1)->count();
      $this->statunread = $statunread;
      
      $statread = Post_raw::where('status_id','=',2)->count();
      $this->statread = $statread;

      $kec = Post_raw::groupBy('city_id')
               ->selectRaw('COUNT(*)as countkec,city_id')
               ->get('countkec','city_id');

      foreach ($kec as $item)
      {
         $data['kecamatan'][]=$item->city->kecamatan;
         $data['countkec'][]=$item->countkec;
      }
       $this->kectot = json_encode($data);

      $kel = Post_raw::groupBy('district_id')
               ->selectRaw('COUNT(*)as countkel,district_id')
               ->get('countkel','district_id'); 

      foreach ($kel as $item)
      {
         $data['kelurahan'][]=$item->district->kelurahan;
         $data['countkel'][]=$item->countkel;
      }
       $this->keltot = json_encode($data);
     
      $probcount = Post_raw::groupBy('problem_id')
               ->selectRaw('COUNT(*)as countprob,problem_id')
	       ->where('problem_id','>',1)
               ->get('countprob','problem_id');

      foreach ($probcount as $item)
      {
         $data['countprob'][]=$item->countprob;
         $data['probnama'][]=$item->problem->problem;
      }
       $this->probcount = json_encode($data);

      $monthpost = Post_raw::groupby('month(created_at)')
			->selectRaw('COUNT(*)as monthcount, month(created_at)')
			->selectRaw('month(created_at)as created')
			->get('monthcount','month(created_at),created');

      foreach ($monthpost as $item)
      {
         $data['month'][]=Carbon::createFromDate('M',$item->created)->format('M');
         $data['monthcount'][]=$item->monthcount;
      }
        $this->month = json_encode($data);

    }
    public function render()
    {
        return view('livewire.show-data');
    }
}
