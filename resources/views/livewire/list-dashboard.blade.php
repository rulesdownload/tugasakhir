<div>
        <div  class="row justify-content-center">
                <div class="m-2 col">   
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title pt-3">Map</h5>
                        </div>
                        <div class="card-body">
                            <div id="maps" class="p-2 bd-highlight" style=" width: 100%; height: 300px; float: left;"></div>
                        </div>
                        <div class="container-fluid">
                            <h5 class="ml-4" for="">Keterangan</h5>
                            <div class="row m-1 ml-4">

                                @foreach($problemos as $problemo)
                                <div class="col-12 col-lg-6 mb-1">
                                    <label for="">{{$problemo->problem}} :</label>
                                        @foreach($fotos as $foto)
                                            @if($problemo->marker_id == $foto->id)
                                            <img width="20" height="25" src="{{ asset('storage/marker/'.$foto->filename)}}" alt="{{$foto->filename}}" class="float-right">
                                            @endif
                                        @endforeach
                                </div>                                  
                                @endforeach
                            </div>                              
                        </div>                              
                    </div>
                </div>
            </div>

        <div>

                <table class="table">
                      <thead>
                            <tr>
                              <th scope="col">
                                    No
                                   <a href="#"wire:click="sorting('id','asc')">&uarr;</a>
                                   <a href="#"wire:click="sorting('id','desc')">&darr;</a>
                              </th>
                              <th scope="col">
                                Deskripsi Masalah
                              </th>
                              <th scope="col">
                                   <a href="#"wire:click="sorting('city_id','asc')">&uarr;</a>
                                   <a href="#"wire:click="sorting('city_id','desc')">&darr;</a>
                                   Kecamatan
                              </th>      <th scope="col">
                                   <a href="#"wire:click="sorting('district_id','asc')">&uarr;</a>
                                   <a href="#"wire:click="sorting('district_id','desc')">&darr;</a>
                                   Kelurahan
                              </th>
                              <th scope="col">
                                   <a href="#"wire:click="sorting('status_id','asc')">&uarr;</a>
                                   <a href="#"wire:click="sorting('status_id','desc')">&darr;</a>
                                   Status Laporan
                              </th>
                              <th scope="col">
                                  <a href="#"wire:click="sorting('problem_id','asc')">&uarr;</a>
                                  <a href="#"wire:click="sorting('problem_id','desc')">&darr;</a>
                                  Jenis Permasalahan
                              </th>
                              <th scope="col">
                                  <a href="#"wire:click="sorting('tipe_id','asc')">&uarr;</a>
                                  <a href="#"wire:click="sorting('tipe_id','desc')">&darr;</a>
                                  Tipe Drainase
                              </th>
                            </tr>
                      </thead>
                      <tbody>
                        
                            @foreach($lists as $id => $list)
                        <tr class="cursor-pointer"  wire:click.prevent="$emitTo('index', 'open', {{ $id }})">
                          <div wire:key="{{ $id }}">
                          <th scope="row">{{ $loop->iteration }}</th>
                          <td>{{ $list->des_mas }}</td>
                          <td>{{ $list->city->kecamatan }}</td>
                          <td>{{ $list->district->kelurahan }}</td>
                          <td>{{ $list->status->parameter}}</td>
                          <td>{{ $list->problem->problem }}</td>
                          <td>{{ $list->type->tipe}}</td>
                          </div>
                        </tr>
                            @endforeach
                      </tbody>
            </table>

            <div class="modal fade" id="detail-post-modal" tabindex="1" role="dialog" aria-hidden="true">
                @livewire('index')
            </div>
        </div>
</div>

@section('scripts')
<script type="text/javascript">

    window.livewire.on('toggleGalaxyFormModal', () => $('#detail-post-modal').modal('toggle'));

</script>
@endsection

<script async defer src="https://maps.googleapis.com/maps/api/js?key={{config('services.google.key')}}&libraries=places&callback=initmap"></script>
<script type="text/javascript">

        setTimeout(function initmap(){
                //Center the map to manado.
                const lat = 1.474830;
                const lng = 124.842079;
                const manado = new google.maps.LatLng(lat,lng);
                const map = new google.maps.Map(document.getElementById("maps"),{
                    zoom: 12,
                    scrollwheel: true,
                    panControl: false,
                    zoomControl: true,
                    mapTypeId: google.maps.MapTypeId.roadmap,
                    center: manado,
                    styles: [ 
                        { 
                            "featureType": "poi", 
                            "stylers": [ 
                                { "visibility": "off" } 
                            ] 
                        } 
                    ] 
                });

                //Retrieve values from JSON to List
                //CHANGES: Multiple marker showed up done.
                //add: problem id as an indicator if the problem is diffrent and changes the marker colours
                var latJSON = JSON.parse(@this.latitudes);
                var lngJSON = JSON.parse(@this.longitudes);
                //markerjson data berupa nama marker yang telah disesuaikan dengan permasalahan yang dipilih 
                var markerJSON = JSON.parse(@this.markers);
                var postJSON = JSON.parse(@this.problems);
                //text variabel untuk mengarahkan path storage sebuah gambar dari marker
                var text = 'storage/marker/';

                for(var i = 0; i < latJSON.length;i++){
                    var lats = latJSON[i];
                    var lngs = lngJSON[i];
                    var posts = postJSON[i];
                    var markers = markerJSON[i];
                    var latsObject = Object.values(lats);
                    var lngsObject = Object.values(lngs);
                    var postsObject = Object.values(posts);
                    var marksObject = Object.values(markers);
                    var marksValue = marksObject[1];
                    var latitudeValue = latsObject[0];
                    var longitudeValue = lngsObject[0];
                    var problemValue = latsObject[1];
                    var idValue = postsObject[0];
                    // var imagesObject = Object.values(image[problemValue]);
                    var images = text+marksValue;
                    const marker = new google.maps.Marker({
                        position: new google.maps.LatLng(latitudeValue,longitudeValue),
                        map,
                        icon: images,   
                        title: String(i)
                    });
                    attachSecretMessage(marker, i);
                }
        },1500);
                    function attachSecretMessage(marker, i){
                        google.maps.event.addListener(marker, 'click', function() {
                        window.Livewire.emitTo('index','open', i);
                             
                            $('#detail-post-modal').modal('toggle');
                        });
                    }


                // function attachMarker(marker) {
                //   const infowindow = new google.maps.InfoWindow({
                //     content: secretMessage,
                //   });

        
</script>


