<div>

<div class="row">
      <div class="modal-dialog modal-xl m-1 col-md-6" style="width: 674px">
                <div class="modal-content">
                      <div class="modal-header">
		@foreach ($cities as $city)
                        <h5 class="modal-title font-bold" id="exampleModalLabel">Kec. {{ $city->kecamatan }} </h5>
                        @foreach ($districts as $district)
                        <h5 class="modal-title font-bold" id="exampleModalLabel"> Kel.{{ $district->kelurahan }}</h5>
			@endforeach
                 @endforeach       
                      </div>
			
                      <div class="row g-5" style="height: auto; padding: 2px;">
                            <div  class="align-items-start bd-highlight d-flex flex-column start-0 top-50" style="height: 400px;">
                                    <div wire:ignore id="map" class="p-2 bd-highlight mx-auto" style=" width: 460px; height: 300px; float: left;"></div>
                            <div class="row pb-3">
                                <div class="flex p-2 bd-highlight ml-2">
                @foreach($photos as $photo)
                <img width="62" height="22" class="img-fluid img-thumbnail" src="{{ asset('storage/app/public/additional_photos/'.$photo->filename)}}" alt="post images" onclick="openModal();currentSlide({{$loop->iteration}})"class="img-fluid mr-2" wire:ignore>
                @endforeach
                                </div>
                            </div> 

                            </div>
                        <div class="modal-dialog col-md-10 col-lg-9 order-md-last ">
                                
                                 @foreach ($posts as $post)

                                        @if ($loop->first)
                                  <div class="modal-dialog col-md-10 col-lg-9 order-md-last m-1 ">
                                        <div class="row">
                                                    <div class="col-sm-6 ">
                                                    <p class="h5">Deskripsi masalah</p>
                                                </div>
                                                <div class="col-sm-6 ">
                                                    <p>{{ $posts->des_mas }}</p>
                                                </div>
                                        </div>
                                  </div>

                                  <div class="modal-dialog col-md-10 col-lg-9 order-md-last m-1">
                                        <div class="row">
                                            <div class="col-sm-6 ">
                                                <p class="h5">Deskripsi lokasi</p>
                                            </div>
                                            <div class="col-sm-6 ">
                                                <p>{{ $posts->des_lok }}</p>
                                            </div>
                                        </div>
                                    </div>  

                                  <div class="modal-dialog col-md-10 col-lg-9 order-md-last m-1">
                                    <div class="row">
                                            <div class="col-sm-6 ">
                                                <p class="h5">Status</p>
                                            </div>
                                            <div class="col-sm-6 ">
                                                <p>{{ $posts->status->parameter }}</p>
                                            </div>
                                        </div>
                                   </div>   

                                    <div class="modal-dialog col-md-10 col-lg-9 order-md-last m-1">
                                    <div class="row">
                                            <div class="col-sm-6 ">
                                                <p class="h5">Jenis drainase</p>
                                            </div>
                                            <div class="col-sm-6 ">
                                                <p>{{ $posts->type->tipe}}</p>
                                            </div>
                                        </div>
                                   </div>   

                                    <div class="modal-dialog col-md-10 col-lg-9 order-md-last m-1">
                                    <div class="row">
                                            <div class="col-sm-6 ">
                                                <p class="h5">Klasifikasi masalah</p>
                                            </div>
                                            <div class="col-sm-6 ">
                                                <p>{{ $posts->problem->problem }}</p>
                                            </div>
                                        </div>
                                   </div>
                                    <div class="modal-dialog col-md-10 col-lg-9 order-md-last m-1 mt-2">
                                    <div class="row">
                                            <div class="col-sm-6 ">
                                                <p class="h5">Keterangan Admin</p>
                                            </div>
                                            <div class="col-sm-6 ">
                                                <p>{{ $posts->donetxt }}</p>
                                            </div>
				    </div>
			 	    </div>
                                    <div class="modal-dialog col-md-10 col-lg-9 order-md-last m-1">
                                    <div class="row">
                                            <div class="col-sm-6 ml-auto">
                                                <p>{{ $posts->progtxt }}</p>
                                            </div>
                                    </div>
				   
                                   </div>
                                @endif
                           @endforeach     
                                
                                        
             
            <div class="col-10 text-center text-lg-start">
                <div class="col-sm-6 ">
                       <p>Foto Oleh admin</p>
                </div>  
                @foreach($donephotoshow as $photo)
                <div class="col-6 col-md-4 pb-1 pl-sm-4 pr-md-4 pt-1"> 
                <img width="62" height="22" class="img-fluid img-thumbnail" src="{{ asset('storage/app/public/additional_photos/'.$photo->filename)}}" alt="post images" onclick="openModal2();currentSlide2({{$loop->iteration}})">
                </div>
                @endforeach 
            </div>

            <div class="col-10 text-center text-lg-start">  
                @foreach($progresphotoshow as $photo)
                <div class="col-6 col-md-4 pb-1 pl-sm-4 pr-md-4 pt-1"> 
                <img width="62" height="22" class="img-fluid img-thumbnail" src="{{ asset('storage/app/public/additional_photos/'.$photo->filename)}}" alt="post images" onclick="openModal1();currentSlide1({{$loop->iteration}})">
                </div>
		@endforeach
            </div>
		
	</div>
                  </div>
                        <div class="modal-footer">
                    <button wire:click="confirmDestroy()" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
	</div>
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

window.addEventListener('livewire:load', function () {
        Livewire.on('modalDestroy', function (data) {
            $("#detail-post-modal").modal("hide");
        });
    });

function openModal() {
  document.getElementById("ModalGambar").style.display = "block";
}

// Close the Modal
function closeModal() {
  document.getElementById("ModalGambar").style.display = "none";
}

// Open the Modal
function openModal2() {
  document.getElementById("ModalGambar2").style.display = "block";
}

// Close the Modal
function closeModal2() {
  document.getElementById("ModalGambar2").style.display = "none";
}

// Open the Modal
function openModal1() {
  document.getElementById("ModalGambar1").style.display = "block";
}

// Close the Modal
function closeModal1() {
  document.getElementById("ModalGambar1").style.display = "none";
}


var slideIndex = 1;
showSlides(slideIndex);

var slideIndex2 = 1;
showSlides2(slideIndex2);

var slideIndex1 = 1;
showSlides1(slideIndex1);

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
</script>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBrFLi96zuuekA3nlI5TllQ--4ktUMvoF8&libraries=places&callback=initialize"
  type="text/javascript"></script>



