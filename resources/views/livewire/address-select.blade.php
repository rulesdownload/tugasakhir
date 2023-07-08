<div >

   
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-backdrop="false">
      Buka Map
    </button>
            @error('lat') <span class="error">{{ $message }}</span> @enderror
    <form wire:submit.prevent="store">
         <div class="form-group " >

          <div class="relative mt-1 mb-4" >
            <label for="city"> Kecamatan </label>
              <div class="mt-1 mb-4 border rounded-md">
              <select 
              name="cities" 
              wire:model.lazy="cities" 
              class=" w-full outline-primary form-control"disabled >
                 value='{{$cities}}'>Kecamatan</option>
           
                  <option class="disabled" id="dropkec" value={{$cities}}>Kecamatan</option> 
                
              </select>
                @error('city') <span class="error">{{ $message }}</span> @enderror
                  </div>
          </div>

          <div class="mt-1 mb-4 disabled">            
            <label for="district"> Kelurahan </label>
              <div class="border rounded-md ">
              <select 
              name="districts" 
              wire:model.lazy="districts"
              class=" w-full outline-primary form-control" disabled>
                <option value='{{$districts}}'>Kelurahan</option>
                
                  <option id="dropkel" value={{ $districts}}></option> 
                
              </select>
                  @error('district') <span class="error">{{ $message }}</span> @enderror
             </div>
          </div>

        </div>
    <div class="form-group">  
     <label for="des_lok"> Masukan deskripsi Lokasi </label>
        <div class="mt-1 mb-4 pl-1 pt-1 pb-1 " >   
        <textarea class="resize-none border rounded-md focus:outline-none w-full" placeholder="Dijalan maesa, depan rumah makan kios bakmi.." name="des_lok"  wire:model.defer="des_lok" wire:ignore></textarea>
        @error('des_lok') <span class="error">{{ $message }}</span> @enderror
        </div>
     </div>

     <div class="form-group">  
     <label for="des_mas">Deskripsi Masalah</label>
        <div class="mt-1 mb-4 pl-1 pt-1 pb-1 " >   
        <textarea class="resize-none border rounded-md focus:outline-none w-full" placeholder="Sudah seminggu air diselokan tidak mengalir jika hujan maka air tumpah dijalan. " wire:model.defer="des_mas"></textarea>
        @error('des_mas') <span class="error">{{ $message }}</span> @enderror
        </div>
  
    </div>

        <label for="photo_input"> Masukan Gambar </label>
        <input type="file" wire:model.lazy="photos" multiple>
        <div wire:loading wire:target="photos">Uploading...</div>
    @error('photos.*') <span class="error">{{ $message }}</span> @enderror

    <div class="form-group" >
        <input type="" id="latitudehide" name="latitudehide" wire:model.lazy="lat" wire:model.lazy="lat"  >
        <input type="" id="longitudehide" name="longitudehide" wire:model.lazy="lng" wire:model.lazy="lng" >
    </div>

     <label for="status_id"></label>
      <input type="hidden" name="status_id" class="">

    <button wire:click="$emitSelf('ListDashboard','render')" type="submit" class="btn btn-sm btn-primary" wire:loading.attr="disabled" >Submit</button>

    </form>
    {{$prompt}}
    <!-- Button trigger modal -->

<!-- Modal Buka map -->
    <div class="modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content"style="width: 512px;right: 7px;">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tentukan titik lokasi</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            
        <input id="pac-input" type="text" placeholder="cari lokasi"class="mb-1.5">
        <div wire:ignore id="map" class="" style="width: 500px;height: 400px;float: left;position: relative;overflow: hidden;left: -23;right: 13px;left: -10;"></div>

        <input id="infolat"  type="text" name="infolat" class="hidden">
        <input id="infolng"  type="text" name="infolng" class="hidden">
        <input id="infokec" name="infokecamatan" class="hidden">
	<input id="infokel" name="infokelurahan" class="hidden">
        <div id="infoPanel" class="hidden">
            <b>Marker status:</b>
            <div id="markerStatus"><i>Click and drag the marker.</i></div>
            <b>Current position:</b>
        </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button onclick="myFunction()" id="save" type="button" class="btn btn-primary" data-dismiss="modal">Save changes</button>
          </div>
        </div>
      </div>
    </div>

</div>

@section('scripts')
<script async defer src="https://maps.googleapis.com/maps/api/js?key={{config('services.google.key')}}&libraries=places&callback=initialize"
  type="text/javascript"></script>
 <script src="{{ asset('public/js/mapInput.js') }}" defer></script>

<script >
// supaya menu dalam searchbox tidak membelakangi modal
var pacContainerInitialized = false;
$("#pac-input").keypress(function() {
  if (!pacContainerInitialized) {
    $(".pac-container").css("z-index", "9999");
    pacContainerInitialized = true;
  }
});

// ambil data latitude dan longitude dari input yang dimodal
    function myFunction() {
      var lat = document.getElementById("infolat").value;
      var lng = document.getElementById("infolng").value;
      var kec = document.getElementById("infokec").value;
      var kel = document.getElementById("infokel").value;
      console.log(kec);
    // agar Javascript dapat berkomunikasi dng Livewire
      Livewire.emit('getLatitudeForInput',lat);
      Livewire.emit('getLongitudeForInput',lng);
      Livewire.emit('getKecamatan',kec);
      Livewire.emit('getKelurahan',kel);

    // ambil value lewat DOM, tidak cocok buat livewire
      // x.setAttribute("value",lat );

    //memasukan value pada text input, tidak cocok dgn livewire
      // document.getElementById("infolat").value ;
      // document.getElementById("latutudehide").value = document.getElementById("infolat").value ;
      // document.getElementById("infolng").value ;
      // document.getElementById("longitudehide").value = document.getElementById("infolng").value ;
    }
 // Enter button disabling 
    $(document).keypress(
         function(event){
            if (event.which == '13') {
         event.preventDefault();
    }
});

</script> 
@endsection

