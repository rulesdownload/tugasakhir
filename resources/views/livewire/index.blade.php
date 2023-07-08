<div>

<div class="row">
      <div class="modal-dialog modal-xl m-1 col-md-6" style="width: 647px">
                <div class="modal-content">
                      <div class="modal-header">
		@foreach ($cities as $city)
                        <h5 class="modal-title font-bold" id="exampleModalLabel">Kec. {{ $city->kecamatan }}- </h5>
                        @foreach ($districts as $district)
                        <h5 class="modal-title font-bold" id="exampleModalLabel"> Kel. {{ $district->kelurahan }}</h5>
			@endforeach
                 @endforeach
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
		       
                      </div>
			
                      <div class="row g-5" style="height: auto; padding: 2px;">
                            <div  class="align-items-start bd-highlight d-flex flex-column start-0 top-50" style="height: 400px;">
                                    <div wire:ignore id="map" class="p-2 bd-highlight mx-auto" style=" width: 460px; height: 300px; float: left;"></div>
                                    <div class="flex p-2 bd-highlight">
                                                @foreach($photos as $photo)
                                                                <img width="62" height="22" src="{{ asset('storage/app/public/additional_photos/'.$photo->filename)}}" alt="post images" class="img-fluid mr-2">
                                                @endforeach
                                      </div>    
                            </div>
                        <div class="modal-dialog col-md-10 col-lg-9 order-md-last ">
                                
                                 @foreach ($posts as $post)

                                        @if ($loop->first)
                                  <div class="modal-dialog col-md-10 col-lg-9 order-md-last m-1 ">
                                        <div class="row">
                                                    <div class="col-sm-6 ">
                                                    <p class="h5">deskripsi masalah</p>
                                                </div>
                                                <div class="col-sm-6 ">
                                                    <p>{{ $posts->des_mas }}</p>
                                                </div>
                                        </div>
                                  </div>

                                  <div class="modal-dialog col-md-10 col-lg-9 order-md-last m-1">
                                        <div class="row">
                                            <div class="col-sm-6 ">
                                                <p class="h5">deskripsi lokasi</p>
                                            </div>
                                            <div class="col-sm-6 ">
                                                <p>{{ $posts->des_lok }}</p>
                                            </div>
                                        </div>
                                    </div>  

                                  <div class="modal-dialog col-md-10 col-lg-9 order-md-last m-1">
                                    <div class="row">
                                            <div class="col-sm-6 ">
                                                <p class="h5">status</p>
                                            </div>
                                            <div class="col-sm-6 ">
                                                <p>{{ $posts->status->parameter }}</p>
                                            </div>
                                        </div>
                                   </div>   

                                    <div class="modal-dialog col-md-10 col-lg-9 order-md-last m-1">
                                    <div class="row">
                                            <div class="col-sm-6 ">
                                                <p class="h5">jenis drainase</p>
                                            </div>
                                            <div class="col-sm-6 ">
                                                <p>{{ $posts->type->tipe}}</p>
                                            </div>
                                        </div>
                                   </div>   

                                    <div class="modal-dialog col-md-10 col-lg-9 order-md-last m-1">
                                    <div class="row">
                                            <div class="col-sm-6 ">
                                                <p class="h5">klasifikasi masalah</p>
                                            </div>
                                            <div class="col-sm-6 ">
                                                <p>{{ $posts->problem->problem }}</p>
                                            </div>
                                        </div>
                                   </div>   
                                @endif
                                @endforeach
                                
                                        
                    </div>

                  </div>
                        <div class="modal-footer">
                    <button wire:click="confirmDestroy()" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
            </div>

</div>
                <form wire:submit.prevent = "addComment"class="col">
                <div class="card m-3 w-75 mx-auto p-1">
                    @if (Route::has('login') || Route::has('adminlogin'))
                        @auth
                                <!-- komentar bila user telah login -->
                                <div class="card-header">
                                    <h5 class="card-title pt-3">Komentar</h5>
                                </div>
                                <div class="mt-1 mb-4 mr-2 ml-2">
                                        <textarea wire:model="comment_input" class="form-control" id="textAreaExample1" rows="4"></textarea>
                                        <button type="submit" class="btn btn-sm btn-primary" >kirim</button>
                                </div>
                                    {{ $commentprompt }}

                        @else
                            <fieldset disabled>
                                <div class="card-header">
                                    <h5 class="card-title pt-3">Komentar</h5>
                                </div>
                                <div class="mt-1 mb-4 mr-2 ml-2 ">
                                        <textarea placeholder="Anda harus Sign-in untuk dapat berkomentar" class="form-control " rows="4"></textarea>
                                        <button type="submit" class="btn btn-sm btn-primary" >kirim</button>
                                </div>
                            </fieldset>
                        @endauth
                    @endif
                        
                                @foreach($koment as $komentar)
                                    @if($komentar->post_raw_id == $postId)
                                    <div class=" card rounded border shadow p-3 m-3"> 
                                    <div class="flex justify-start my-2">
				    <img src="{{$komentar->user->avatar}}" alt="avatar" class="rounded-circle m-1" style="width:40px; height: 40px">
                                        <p class="font-bold mt-2.5 pl-1 text-lg"> {{$komentar->user->name}}</p>
                                        <p class="mx-3 py-2 text-xs text-grey-500 font-semibold"> {{\Carbon\Carbon::parse($komentar->created_at)->diffForHumans()}} </p>
                                    </div>
                                    <p> {{$komentar->komentar}}</p>
                                </div>
                                    @endif
                                @endforeach
                </div>
                </form>
</div>
<script type="text/javascript">


   function initialize() {
        
    window.addEventListener('latitude-loaded', event => {

        var lat = @this.latitude ;
        var lng = @this.longitude;
    var latlng = new google.maps.LatLng(lat , lng);
    var crosshairShape = {
    coords: [0, 0, 0, 0],
    type: 'rect'
  };
  var mapCanvas = document.getElementById('map');
  var mapOptions = {
    center: latlng,
    zoom: 17,
    scrollwheel: false,
    panControl: false,
    zoomControl: true,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  }
  var map = new google.maps.Map(mapCanvas, mapOptions);

  var marker = new google.maps.Marker({
    map: map,
    position: latlng,
    });
  });

}
</script>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBrFLi96zuuekA3nlI5TllQ--4ktUMvoF8&libraries=places&callback=initialize"
  type="text/javascript"></script>



