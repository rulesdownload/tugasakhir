<div>
    {{-- Do your work, then step back. --}}
    @foreach($reports as $id => $report)

<div class="card">
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
</div>

    @endforeach
</div>

<script type="module">
    Pusher.logToConsole = true;
    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
      alert(JSON.stringify(data));
    });
</script>

