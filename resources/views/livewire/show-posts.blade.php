<div>

    <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Deskripsi Masalah</th>
      <th scope="col">Deskripsi Lokasi</th>
      <th scope="col">Status Laporan</th>
      <th scope="col">Jenis Permasalahan</th>
      <th scope="col">Tipe Drainase</th>
    </tr>
  </thead>
  <tbody>
    
        @foreach($reports as $id => $report)
    <tr class="cursor-pointer"  wire:click.prevent="$emitTo('index', 'open', {{ $id }})">
      <div wire:key="{{ $id }}">
      <th scope="row">{{ $loop->iteration }}</th>
      <td>{{ $report->des_mas }}</td>
      <td>{{ $report->des_lok }}</td>
      <td>{{ $report->status->parameter}}}</td>
      <td>{{ $report->problem->problem }}</td>
      <td>{{ $report->type->tipe}}</td>
      </div>
    </tr>
        @endforeach
  </tbody>
</table>
        <div class="modal fade" id="detail-post-modal" tabindex="-1" role="dialog" aria-hidden="true">
            @livewire('index')
        </div>
</div>

@section('scripts')
<script type="text/javascript">

    window.livewire.on('toggleGalaxyFormModal', () => $('#detail-post-modal').modal('toggle'));

</script>
@endsection