<div>

        <table class="table">
  <thead>
    <tr>
      <th scope="col">No.</th>
      <th scope="col">Deskripsi Masalah</th>
      <th scope="col">Deskripsi Lokasi</th>
      <th scope="col">Kecamatan</th>
      <th scope="col">Kelurahan</th>
      <th scope="col">Status</th>
        <th scope="col">Pelapor</th>
      <th scope="col">Created at</th>
    </tr>
  </thead>
  <tbody>
        @foreach($reports as $id => $report)

      <div wire:key="{{ $id }}">
      <th scope="row">{{ $loop->iteration }}</th>
      <td>{{ $report->des_mas }}</td>
      <td>{{ $report->des_lok }}</td>
      <td>{{ $report->city->kecamatan}}</td>
      <td>{{ $report->district->kelurahan }}</td>
      <td>{{ $report->status->parameter}}</td>
      <td>{{ $report->user->name }}</td>
      <td>{{ $report->created_at }}</td>
      <td >

        <a href="{{route('kelola',[$report->id])}}" class="btn btn-primary btn-sm active">view</a></td>
      </div>
    </tr>
        @endforeach
  </tbody>
</table>
</div>
