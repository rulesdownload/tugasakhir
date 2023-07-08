<div>
    {{-- Do your work, then step back. --}}
    @foreach($reports as $id => $report)

<div class="card">
  <a href="/admin/kelola/{{$report->id}}" class="text-decoration-none"style="color: #1d1c26">
  <div class="card-header">
    Laporan Baru oleh {{$report->user->name}}
    <cite class="blocquote-footer position-sticky "style="left: 1400px;"title="Source Title">{{\Carbon\Carbon::parse($report->created_at)->diffForHumans()}} </cite>
  </div>
  <div class="card-body">
    <blockquote class="blockquote mb-0">
      <p>{{$report->des_mas}}</p>
      <footer class="blockquote-footer">{{$report->status->parameter}}</footer>
    </blockquote>
  </div>
  </a>
</div>

    @endforeach

{{ $reports->links() }}
</div>

<script type="module">

Echo.channel('notifchannel')
        .listen('.notifevent', (e) => {
            console.log('test');
        });
</script>
