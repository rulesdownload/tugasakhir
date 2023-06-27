<?php

namespace App\Http\Livewire;

use App\Models\post_raw;
use App\Models\City;
use App\Models\district;
use App\Models\AdditionalPhotos;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Http\Request;  
use App\Events\notifevent;

class AddressSelect extends Component
{

    public $cities;
    public $districts;
    public $district;
    public $des_lok, $des_mas, $lat, $lng, $latitude, $longitude,$kec,$kel;
    public $prompt;
    public $modelId;
    public  $photos = [];
    use WithFileUploads;
    protected $listeners = [
        "refreshParent", 
        "getLatitudeForInput",
        "getLongitudeForInput",
        "getModelId",
	"getKecamatan",
	"getKelurahan",
    ];


        protected $messages = [
        'citys.required' => 'Kecamatan tidak boleh kosong.',
        'districts.required' => 'Kelurahan tidak boleh kosong.',
        'des_lok.required' => 'Deskripsi lokasi tidak boleh kosong.',
        'des_mas.required' => 'Deskripsi masalah tidak boleh kosong.',
        'lat.required' => 'Belum memilih titik lokasi silahkan tekan tombol Buka Map',
        'lng.required' => 'Belum memilih titik lokasi silahkan tekan tombol buka Map.',
        'photo' => 'Masukan bukti foto',

    ];
    protected function rules() {
        return [ 

        'cities' =>'required',
        'districts' =>'required',
        'des_lok'=>'required',
        'des_mas'=>'required',
        'lat' => 'required',
        'lng' =>'required',
        'photos.*' => 'image|max:8127|required',
        ];
    }

    public function removeImg($index){
        array_splice($this->photos, $index);
    }

    public function refreshParent()
    {
        $this->prompt ="Laporan anda berhasil dibuat, silahkan tunggu admin untuk mengkonfirmasi laporan anda";
        return view('livewire.list-dashboard');
    }
    
    public function getLatitudeForInput($value) 
    {
        $this->lat = $value;        
    }

    public function getKecamatan($value) 
    {
        $this->kec = $value;

	//if($this->kec !=null)
	//$this->cities = city::where('kecamatan', '=',' Tikala')->get();
              
    }

    public function getKelurahan($value) 
    {
        $this->kel = $value;
    }

    public function getLongitudeForInput($value)
    {
        
            $this->lng = $value;
    }

    public function render()
    {
        //if(!empty($this->kec)) {
        //    $this->cities = city::where('kecamatan',"=",$this->kec)->first();
        //}
        if(!empty($this->kel)) {
            $this->districts = district::where('kelurahan',"=",$this->kel)->first()->id;
	    $this->cities = district::where('kelurahan',"=",$this->kel)->first()->cities_id;
	  // $this->cities = city::where('id',"=",)
        }
        return view('livewire.address-select');
	
    }

    public function getModelId($modelId){

        $this->modelId = $modelId;
        $model = Post_raw::find($this->modelId);

    }


    public function store()
    {
        $this->validate();


        if ($this->modelId) {
            Post_raw::find($this->modelId);
            $postInstanceId  = $this->modelId;
        } 
        else {
            $postInstance = Post_raw::create([
            'city_id' => $this->cities,
            'district_id' => $this->districts,
            'des_lok' => $this->des_lok,
            'des_mas' => $this->des_mas,
            'lat'=>$this->lat,
            'lng'=>$this->lng,
            'user_id' => auth()->user()->id,
            'status_id'=>1,
            'problem_id'=>1,
            'tipe_id'=>1,
        ]);
            $postInstanceId = $postInstance->id;
	  
	    event(new notifevent);
        }

        foreach ($this->photos as $photo) {
            $photo->store('additional_photos','public');

            AdditionalPhotos::create([
                'post_raw_id' => $postInstanceId,
                'filename' => $photo->hashName()
            ]);
        }

        $this->emit('refreshParent');
    }
}
