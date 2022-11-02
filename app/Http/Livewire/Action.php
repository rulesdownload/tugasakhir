<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\City;
use App\Models\drainaseProblems;
use App\Models\DrainaseTypes;
use App\Models\Marker;
use Illuminate\Support\Arr;


class Action extends Component
{
    public $camatinput = [];
    public $updatecamat = [];
    public $updateproblem = [];
    public $createproblem = [];
    public $kecupdate;
    public $probupdate;
    public $problemdelete;
    public $tipemdelete;
    public $inputcamat;
    public $probleminput;
    public $tipearr = [];
    public $tipeupdate;
    public $updatetipe;
    public $barutipe;
    public $baruproblem = [];
    public $optionmarkerbaru = [];
    public $optionmarkerupdate = [];
    public $problemlexp = [];
    public $problemlist = [];
    public $problemlistArr = [];
    public $problemdis = [];

    public function mount()
    {
        $this->problemlist = drainaseProblems::whereNotIn('id',[1])->get('marker_id')->toJSON();
        $this->dispatchBrowserEvent('problem-loaded',[
            'problemdis' => $this->problemdis = $this->problemlist
        ]);

    }

    public function updateKecamatan($idCamat)
    {

        if($idCamat){
        $this->updatecamat = Arr::get($this->camatinput, $idCamat );
            $kecupdate = City::find($idCamat);
            $kecupdate->update([
                'camat' => $this->updatecamat,
            ]);

        }
    }

    public function updateProblem($id)
    {

        if($id){

            $this->updateproblem = Arr::get($this->probleminput, $id);
            $probupdate = drainaseProblems::find($id);
            $probupdate->update([
                'problem' => $this->updateproblem,
                'marker_id' => $this->optionmarkerupdate
            ]);
        }
    }

    public function hapusproblem($id)
    {
        if($id){
            $problemdelete = drainaseProblems::find($id);
            $problemdelete->delete();
        }
        session()->flash('messagedelete', 'Data Berhasil Dihapus.');
        return redirect()->route('action');
    }   

    public function hapustipe($id)
    {
        if($id){
            $tipemdelete = DrainaseTypes::find($id);
            $tipemdelete->delete();
        }
        session()->flash('messagedelete', 'Data Berhasil Dihapus.');
        // return redirect()->route('action');
    }

    public function createtipe()
    {
        $validateData = $this->validate(
            ['barutipe'=> 'required'],
            ['barutipe.required' => 'Tipe kosong']);

        $this->createtipe = DrainaseTypes::create([
            'tipe' => $this->barutipe
        ]);
        session()->flash('message', 'Data Berhasil Dibuat.');
        // return redirect()->route('action');

    }

    public function createproblems()
    {

        $validateData = $this->validate(
            ['baruproblem' => 'required'],
            [
                'optionmarkerbaru.required' => 'Belum memilih marker.',
                'baruproblem.required' => 'Belum mengisi masalah.'
            ],
            ['optionmarkerbaru' => 'required']
                
        );

        $this->createproblem = drainaseProblems::create([
            'problem' => $this->baruproblem,
            'marker_id' => $this->optionmarkerbaru
        ]);

        session()->flash('message', 'Data Berhasil Dibuat.');
        // return redirect()->route('action');
    }

    public function updateTipe($id)
    {
        if($id){
            $this->tipearr =  Arr::get($this->tipeupdate, $id);
            $updatetipe = DrainaseTypes::find($id);
            $updatetipe->update([
                'tipe' => $this->tipearr,
            ]);
        }
    }

    public function render()
    {

        return view('livewire.action',[
            'cities' => City::all(),
            'problems'=> drainaseProblems::whereNotIn('id',[1])->get(),
            'Markers' => Marker::all(),
            'types' => DrainaseTypes::whereNotIn('id',[1])->get(),
        ]);
    }
}
