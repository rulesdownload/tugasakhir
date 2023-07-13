<div>
    <div class="container mt-2">
        <div class="row">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header">
                        <button id="buttonKecamatan" type="button"class="btn btn-secondary active float-right mt-2" data-toggle="button" aria-pressed="false" autocomplete="off">+</button>
                        <h5 class="card-title pt-3">Pengaturan Kecamatan</h5>
                    </div>
                    <div wire:ignore.self id="kecamatancontent" class="card-body hiddenclass">
                    @foreach($cities as $id => $city)
                        <fieldset disabled>
                          <div class="form-group row">
                                <label for="inputKecamatan" class="col-sm-4 col-form-label">Kecamatan</label>
                                <div class="col-sm-10">
                                        <input type="text" id="disabledTextInput.{{$city->id}}" class="form-control col-xs-4" placeholder="{{$city->kecamatan}}">
                                </div>
                          </div>
                        </fieldset>
                            <form wire:submit.prevent="updateKecamatan({{$city->id}})">
                                <div class="form-group row">
                                    <label for="input Camat" class="col-sm-4 col-form-label ">Camat</label>
                                    <div class="col-sm-10 input-group-prepend">
                                            <input type="text" wire:model.defer="camatinput.{{$city->id}}" class="form-control mb-4 " placeholder="{{$city->camat}}">
                                            <button type="submit" class="btn btn-outline-secondary h-60">Ok</button>
                                    </div>
                               </div>
                            </form>
                    @error('updatecamat') <span class="error">{{ $message }}</span> @enderror
                    @endforeach
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header">
                            <button id="buttonPermasalahan" type="button"class="btn btn-secondary active float-right mt-2" data-toggle="button" aria-pressed="false" autocomplete="off">+</button>
                            <h5 class="card-title pt-3">Pengaturan Permasalahan dan Marker</h5>
                    </div>
                    <div wire:ignore id="problemcontent" class="card-body hiddenclass">
                        <form wire:submit.prevent="createproblems">
                        @error('baruproblem') <span class="error">{{ $message }}</span> @enderror
                            <div wire:ignore id="createproblem" class=" card-header mb-3">
                                <label for="baruproblem" class="col ">Tambahkan jenis masalah drainase</label> 
                                <input  type="text" id="baruproblem" class="form-control mb-2 ml-2" wire:model="baruproblem" placeholder="Masukan Permasalah">
                                
                                    <div>
                                        @if (session()->has('message'))
                                            <div class="alert alert-success">
                                                {{ session('message') }}
                                            </div>
                                        @endif
                                    </div>

                                    <select id="my-select" class="image-picker" wire:model="optionmarkerbaru" data-container="#createproblem" >
                                        @foreach($Markers as $marker)
                                        <option value="{{$marker->id}}" data-img-src="{{ asset('storage/app/public/marker/'.$marker->filename)}}">{{$marker->id}}</option>
                                        @endforeach
                                    </select>
                                @error('optionmarkerbaru') <span class="error">{{ $message }}</span> @enderror
                                <button type="submit" class="btn btn-info ">Save</button>
                            </div>
                        </form>
                        @foreach($problems as $problem)
                        <form>
                            <div wire:ignore class="form-group row">
                                <label for="inputproblem" class="col-sm-2 col-form-label">Masalah Drainase</label>
                                <div wire:ignore class="col-sm-10">
                                    <input wire:ignore type="text" wire:model.defer="probleminput.{{$problem->id}}" class="form-control" placeholder="{{$problem->problem}}">
                                        <select wire:ignore class="image-pickerupd" wire:model.defer="optionmarkerupdate.{{$problem->id}}" data-container="#createproblem" >
                                        @foreach($Markers as $marker)
                                            <option value="{{$marker->id}}" data-img-src="{{ asset('storage/app/public/marker/'.$marker->filename)}}">{{$marker->id}}</option>
                                        @endforeach
                                        </select>  
                                    <button wire:click="hapusproblem({{$problem->id}})" class="btn btn-danger float-right">Delete</button>
                                    <button wire:click="updateProblem({{$problem->id}})" class="btn btn-info float-right">Save</button>
                                </div>
                            </div>
                        </form>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-xxl-7">
                <div class="card">
                    <div class="card-header">
                        <button id="buttonTipe" type="button"class="btn btn-secondary active float-right mt-2" data-toggle="button" aria-pressed="false" autocomplete="off">+</button>
                        <h5 class="card-title pt-3">Pengaturan Tipe</h5>
                    </div>
                    <div wire:ignore id="tipecontent" class="card-body hiddenclass">
                     <form wire:submit.prevent="createtipe">
                        <div wire:ignore id="createtipe" class=" card-header mb-3">
                            @error('barutipe') <span class="error">{{ $message }}</span> @enderror
                                <div wire:ignore id="createtipe" class=" card-header mb-3">
                                    <label for="barutipe" class="col ">Tambahkan tipe drainase</label> 
                                    <input  type="text" id="barutipe" class="form-control mb-2 ml-2" wire:model="barutipe" placeholder="Masukan Tipe ">
                            <button type="submit" class="btn btn-info ">Save</button>
                        </div>
                    </form>
                    @foreach($types as $tipe)
                            <form>
                                <div class="form-group row">
                                    <label for="input tipe" class="col-sm-4 col-form-label ">Tipe drainase</label>
                                    <div class="col-sm-10 input-group-prepend">
                                            <input type="text" wire:model.defer="tipeupdate.{{$tipe->id}}" class="form-control mb-4 " placeholder="{{$tipe->tipe}}">
                                            <button wire:click="updateTipe({{$tipe->id}})" class="btn btn-outline-secondary h-60">Ok</button>
                                            <button wire:click="hapustipe({{$tipe->id}})" class="btn btn-outline-secondary h-60">delete</button>
                                    </div>
                               </div>
                            </form>
                    @error('updatetipe') <span class="error">{{ $message }}</span> @enderror
                    @endforeach
                    </div>
                </div>
            </div> 

        </div>

        <div class="container">
            <div class="row">

                
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    $("#buttonKecamatan").click(function(){
    if($(this).html() == "+"){
        $(this).html("-");
    }
    else{
        $(this).html("+");
    }
         $('#kecamatancontent').slideToggle();
    });

    $("#buttonPermasalahan").click(function(){
    if($(this).html() == "+"){
        $(this).html("-");
    }
    else{
        $(this).html("+");
    }
         $('#problemcontent').slideToggle();
    });

    $("#buttonTipe").click(function(){
    if($(this).html() == "+"){
        $(this).html("-");
    }
    else{
        $(this).html("+");
    }
         $('#tipecontent').slideToggle();
    });

     jQuery("select.image-picker").imagepicker({
         selected: function(option){
                    var values = this.val();
                    @this.set('optionmarkerbaru',values);

                }
    });



        document.addEventListener('livewire:load', function () {
     
        var probJSON =  JSON.parse(@this.problemdis);

           for(var i = 0; i < probJSON.length;i++){
                var probs = probJSON[i];
                var selects = $('.image-pickerupd');
                var selectjson = selects[i];
                var selectobj = Object.values(selectjson);
                var probsObject = Object.values(probs);
                var probsValue = probsObject[0];
                console.log(probsValue);
                $(selectjson).val(probsValue);
                $(selectjson).data('picker').sync_picker_with_select();

                }

        });
               jQuery("select.image-pickerupd").imagepicker({
                selected: function(option){
                    var valuesupdate = this.val();
                    @this.set('optionmarkerupdate',valuesupdate);
                    
                }

            });

    //issue gak bisa dapat value dari select. harus dari jquery lgnsung trus parsing ka livewire

                // $(".image-picker").val('2');
                // $(".image-picker").data('picker').sync_picker_with_select();

    // jQuery("select.image-picker").imagepicker({
    //     selected: function(option){
    //         var values = this.val();
    //         @this.set('optionmarkerbaru',values);
    //     }
    // });
</script>
