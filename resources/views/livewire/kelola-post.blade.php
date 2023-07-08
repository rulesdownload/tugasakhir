<div>
        <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard admin') }}
        </h2>
    </x-slot>


        <div class="container mt-2">
            
            <div class="row justify-content-center">
                <div class="col-md-12">

                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title pt-3">Map</h5>
                        </div>

                        <div class="card-body form-group">
                            <div wire:ignore id="map" class="p-2 bd-highlight" style=" width: 100%; height: 300px; float: left;">


                        </div>
                    </div>
                </div>
        <div class="row">

            <div class="col-sm-6">
                <div class="card">
                        <div class="card-header">
                            <h5 class="card-title pt-3">Form</h5>
                        </div>

                        <div class="card-body form-group">

                            <div class="row pb-3">
                                <div class="col-sm-6 flex p-2 bd-highlight">
                                    <p class="h6">Gambar</p>
                @foreach($photos as $photo)
                <img width="62" height="22" src="{{ asset('storage/app/public/additional_photos/'.$photo->filename)}}" alt="post images" onclick="openModal();currentSlide({{$loop->iteration}})"class="img-fluid mr-2" wire:ignore>
                @endforeach
                                </div>
                            </div> 
                            <div class="row pb-3">
                                <div class="col-sm-6 ">
                                    <p class="h6">Tipe Drainase</p>
                                    <p>{{ $posts->type->tipe }}</p>
                                </div>
                            </div>
                            <div class="row pb-3">
                                <div class="col-sm-6 ">
                                    <p class="h6">Jenis Masalah Drainase</p>
                                    <p>{{ $posts->problem->problem }}</p>
                                </div>
                            </div>                            
                            <div class="row pb-3">
                                <div class="col-sm-6 ">
                                    <p class="h6">Deskripsi Masalah</p>
                                    <p>{{ $posts->des_mas }}</p>
                                </div>
                            </div>
                            <div class="row pb-3">
                                <div class="col-sm-6 ">
                                    <p class="h6">Deskripsi Lokasi</p>
                                    <p>{{ $posts->des_lok }}</p>
                                </div>
                            </div>
                            <div class="row pb-3">
                                <div class="col-sm-6 ">
                                    <p class="h6">Kecamatan</p>
                                    <p>{{ $posts->city->kecamatan }}</p>
                                    <p>({{ $posts->city->camat }})</p>
                                </div>
                            </div>  
                            <div class="row pb-3">
                                <div class="col-sm-6 ">
                                    <p class="h6">kelurahan</p>
                                    <p>{{ $posts->district->kelurahan }}</p>
                                </div>
                            </div>  
                            <div class="row pb-3">
                                <div class="col-sm-6 ">
                                    <p class="h6">Status Laporan</p>
                                    <p>{{ $posts->status->parameter }}</p>
                                </div>
                            </div>                       
                        </div>
                    </div>
                </div>


                <div class="col-sm-6">

                <form wire:submit.prevent="update">
                <div class="card">
                        <div class="card-header">
                            <h5 class="card-title pt-3">Admin Panel</h5>
                        </div>

                        <div class="card-body form-group">
                            <div class="row pb-3">
                                <div class="col-sm-6 ">
                                    <p class="h6">Jenis Masalah</p>
                                    <select 
                                    name="problem" 
                                    wire:model="problem" 
                                    class="mt-1 mb-4 w-full outline-primary">
                                        <option value=''>Pilih Jenis Masalah</option>
                                        @foreach( $problems as $id => $problem )
                                            @if($problem->id == 1)
                                                <option class="hidden" value={{ $problem->id }} ></option>
                                                @else
                                                <option value={{ $problem->id }}>{{ $problem->problem }}</option>         
                                            @endif

                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row pb-3">
                                <div class="col-sm-6 ">
                                    <p class="h6">Tipe Saluran/Drainase</p>
                                    <select 
                                    name="type"
                                    wire:model="type" 
                                    class="mt-1 mb-4 w-full outline-primary">
                                        <option value=''>Pilih Tipe</option>
                                        @foreach($types as $id => $type)
                                            @if($type->id == 1)
                                                <option class="hidden" value={{ $type->id }}></option>
                                            @else
                                                <option value={{ $type->id }}>{{ $type->tipe }}</option>
                                            @endif

                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row pb-3">
                                <div class="col-sm-6 ">
                                    <p class="h6">Status laporan</p>
                                    <select 
                                    name="status"
                                    wire:model="status" 
                                    class="mt-1 mb-4 w-full outline-primary">
                                        <option value=''>Pilih <s></s>tatus laporan</option>
                                        @foreach($stats as $id => $status)
                                            @if($status->id == 1 || $status->id == 2 )
                                                <option class="hidden" value={{ $status->id }}></option>
                                            @else
                                                <option value={{ $status->id }}>{{ $status->parameter }}</option>
                                            @endif

                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        <button type="submit" class="btn btn-sm btn-primary" >Submit</button> 
                        {{ $prompt }}
                        </div>
                    </div>
                </form>
               
                <form wire:submit.prevent="addProsesPhotos">
                <div class="card">
                     <div class="card-header">
                            <h5 class="card-title pt-3">Uploud Bukti Proses Perbaikan</h5>
                      </div>
                       <div class="p-2 bd-highlight">
                <label class="col pl-0"> Masukan Foto </label>
                <div wire:loading wire:target="photo">Uploading...</div>
                <input type="file" wire:model="progresphotos" class="pb-3.5" multiple>
                <div wire:loading wire:target="progresphotos">Uploading...</div>
                <button type="submit" class="btn btn-sm btn-primary" >Submit</button>
               {{ $prompt }}
                </form>
                <form wire:submit.prevent="createProgTxt">
                <div class=" pb-3.5 pt-1.5">
                <label class="col pl-0"> Tambahkan Keterangan </label>
                <p class="h6">{{ $posts->progtxt }}</p>
                <textarea class="form-control" wire:model.lazy="progtext" id="textAreaExample1" rows="4"></textarea>
                </div>    
                <button type="submit" class="btn btn-sm btn-primary" >Submit</button>
                 </form>
                </div>

            <div class="row text-center text-lg-start">  
                @foreach($progresphotoshow as $photo)
                <div class="col-6 col-md-4 pb-1 pl-sm-4 pr-md-4 pt-1"> 
                <img class="img-fluid img-thumbnail" src="{{ asset('storage/app/public/additional_photos/'.$photo->filename)}}" alt="post images" onclick="openModal1();currentSlide1({{$loop->iteration}})">
                </div>
                @endforeach 
            </div>
	        </div>

                <form wire:submit.prevent="addDonePhotos">
                <div class="card">
                     <div class="card-header">
                            <h5 class="card-title pt-3">Upload Bukti Terselesaikan</h5>
                      </div>
                       <div class="p-2 bd-highlight">
                <label class="col pl-0"> Masukan Foto </label>
                <input type="file" wire:model="donephotos" class="pb-3.5" multiple>
                <div wire:loading wire:target="donephotos">Uploading...</div>
                <button type="submit" class="btn btn-sm btn-primary" >Submit</button>
                </form>
                {{ $prompt }}
                <div class=" pb-3.5 pt-1.5">
                <form wire:submit.prevent="createDoneTxt">
                <label class="col pl-0"> Tambahkan Keterangan </label>
                <p>{{ $posts->donetxt }}</p>
                <textarea class="form-control"wire:model.lazy="donetext" id="textAreaExample2" rows="4"></textarea>
                <button type="submit" class="btn btn-sm btn-primary" >Submit</button>
                </form>
	        </div>
                </div>

            <div class="row text-center text-lg-start">  
                @foreach($donephotoshow as $photo)
                <div class="col-6 col-md-4 pb-1 pl-sm-4 pr-md-4 pt-1"> 
                <img class="img-fluid img-thumbnail" src="{{ asset('storage/app/public/additional_photos/'.$photo->filename)}}" alt="post images" onclick="openModal2();currentSlide2({{$loop->iteration}})">
                </div>
                @endforeach 
            </div>
                </div>            


                <div class="card">
                        <div class="card-header">
                            <h5 class="card-title pt-3">Komentar</h5>
                        </div>


                            <div class="mt-1 mb-4 mr-2 ml-2">
                                <textarea wire:model="comment_input" class="form-control" id="textAreaExample1" rows="4"></textarea>
                                  <button wire:click="addComment" class="btn btn-sm btn-primary" >kirim</button>
                            </div>
                            {{ $commentprompt }}
                        @foreach($koment as $komentar)
                            @if($komentar->post_raw_id == $postId)
                            <div class=" card rounded border shadow p-3 m-3">

                            <div class="flex justify-start my-2">
                                <p class="font-bold text-lg"> {{$komentar->user->name}}</p>
                                <p class="mx-3 py-2 text-xs text-grey-500 font-semibold"> {{\Carbon\Carbon::parse($komentar->created_at)->diffForHumans()}} </p>
                            </div>
                            <p> {{$komentar->komentar}}</p>
                        </div>
                            @endif
                        
                        @endforeach

                </div>



        </div>

                </div>
            </div>
        </div>
        <div id ="ModalGambar" class="moodal">
            <span class="close cursor" onclick="closeModal()">&times;</span>
            <div class="modal-konten" style="margin-top: 20px; margin-bottom: 150px;">

                @foreach ($photos as $photo)
                <div class="mySlides">
                    <div class="numbertext">{{$loop->iteration}}</div>
                    <img src="{{ asset('storage/app/public/additional_photos/'.$photo->filename)}}" class="h-25 mx-auto w-25" style="width:100%">    
                </div>
                @endforeach

                    <!-- Next/previous controls -->
                <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                <a class="next" onclick="plusSlides(1)">&#10095;</a>

            </div>
        </div>

        <div id ="ModalGambar1" class="moodal">
            <span class="close cursor" onclick="closeModal1()">&times;</span>
            <div class="modal-konten" style="margin-top: 20px; margin-bottom: 150px;">

                @foreach ($progresphotoshow as $photo)
                <div class="mySlides1">
                    <div class="numbertext">{{$loop->iteration}}</div>
                    <img src="{{ asset('storage/app/public/additional_photos/'.$photo->filename)}}" class="h-25 mx-auto w-25" style="width:100%">    
                </div>
                @endforeach

                    <!-- Next/previous controls -->
                <a class="prev" onclick="plusSlides1(-1)">&#10094;</a>
                <a class="next" onclick="plusSlides1(1)">&#10095;</a>

            </div>
        </div>

        <div id ="ModalGambar2" class="moodal">
            <span class="close cursor" onclick="closeModal2()">&times;</span>
            <div class="modal-konten" style="margin-top: 20px; margin-bottom: 150px;">

                @foreach ($donephotoshow as $photo)
                <div class="mySlides2">
                    <div class="numbertext">{{$loop->iteration}}</div>
                    <img src="{{ asset('storage/app/public/additional_photos/'.$photo->filename)}}" class="h-25 mx-auto w-25" style="width:100%">
                </div>
                @endforeach

                    <!-- Next/previous controls -->
                <a class="prev" onclick="plusSlides2(-1)">&#10094;</a>
                <a class="next" onclick="plusSlides2(1)">&#10095;</a>

            </div>
        </div>
</div>

<script type="text/javascript">

   function initialize() {

        console.log(@this.longitude);
        var lat = @this.latitude ;
        var lng = @this.longitude;
        console.log(@this.latitude);
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
    markers.push(marker);

}
    document.addEventListener('livewire:load', function () {
    google.maps.event.addDomListener(window, "load", initialize);

});
        
</script>

<script async defer src="https://maps.googleapis.com/maps/api/js?key={{config('services.google.key')}}&libraries=places&callback=initialize"
  type="text/javascript"></script>

<script type="text/javascript">
// Open the Modal
function openModal() {
  document.getElementById("ModalGambar").style.display = "block";
}

// Close the Modal
function closeModal() {
  document.getElementById("ModalGambar").style.display = "none";
}

// Open the Modal
function openModal1() {
  document.getElementById("ModalGambar1").style.display = "block";
}

// Close the Modal
function closeModal1() {
  document.getElementById("ModalGambar1").style.display = "none";
}

// Open the Modal
function openModal2() {
  document.getElementById("ModalGambar2").style.display = "block";
}

// Close the Modal
function closeModal2() {
  document.getElementById("ModalGambar2").style.display = "none";
}

var slideIndex = 1;
showSlides(slideIndex);

var slideIndex1 = 1;
showSlides1(slideIndex1);

var slideIndex2 = 1;
showSlides2(slideIndex2);
// Next/previous controls
function plusSlides(n) {
  showSlides(slideIndex += n);
}

// Thumbnail image controls
function currentSlide(n) {
  showSlides(slideIndex = n);
}

function plusSlides1(n) {
  showSlides1(slideIndex1 += n);
}

// Thumbnail image controls
function currentSlide1(n) {
  showSlides1(slideIndex1 = n);
}

function plusSlides2(n) {
  showSlides2(slideIndex2 += n);
}

// Thumbnail image controls
function currentSlide2(n) {
  showSlides2(slideIndex2 = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo");
  var captionText = document.getElementById("caption");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
  captionText.innerHTML = dots[slideIndex-1].alt;
}

function showSlides1(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides1");
  var dots = document.getElementsByClassName("demo");
  var captionText = document.getElementById("caption");
  if (n > slides.length) {slideIndex1 = 1}
  if (n < 1) {slideIndex1 = slides.length}
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex1-1].style.display = "block";
  dots[slideIndex1-1].className += " active";
  captionText.innerHTML = dots[slideIndex1].alt;
}

function showSlides2(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides2");
  var dots = document.getElementsByClassName("demo");
  var captionText = document.getElementById("caption");
  if (n > slides.length) {slideIndex2 = 1}
  if (n < 1) {slideIndex2 = slides.length}
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex2-1].style.display = "block";
  dots[slideIndex2-1].className += " active";
  captionText.innerHTML = dots[slideIndex2].alt;
}
</script>


