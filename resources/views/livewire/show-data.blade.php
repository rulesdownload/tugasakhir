<div>
  <div class="">
  	<div class="card">
		<div class="card-header">
	 		 <h3>Laporan Info</h3>
		</div>
	<div class="card-body">
          <p>
		Total laporan = {{$jumposts}}
	  </p>
          <p>
		Total Laporan tertangani = {{$statdone}}
          </p>
          <p>
                Total Laporan sementara diproses =  {{$statprog}}
          </p>
          <p>
                Total Laporan yang telah dibaca = {{$statread}}
          </p>
          <p>
                Total Laporan belum dibaca = {{$statunread}}
          </p>
	</div>
	</div>
  </div>
     <div class="row">
        <div class="col-sm-6">
	  <div class="card"style="position: relative;">
  	 	 <canvas height="40vh" width="80vw" id="totalkecamatan"></canvas>
	 </div>
       </div>
  
        <div class="col-sm-6">
          <div class="card" style="position: relative;">
                 <canvas id="totalkelurahan" height="40vh" width="80vw"></canvas>
         </div>
       </div>

        <div class="col-sm-6">
          <div class="card" style="position: relative;">
                 <canvas id="totalproblem" height="40vh" width="80vw"></canvas>
         </div>
       </div>

        <div class="col-sm-6">
          <div class="card" style="position: relative;">
                 <canvas id="totaldate" height="40vh" width="80vw"></canvas>
         </div>
       </div>

    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script type="text/javascript">
  
  const ctx = document.getElementById('totalkecamatan');
  var kectot = JSON.parse('<?php echo $kectot ?>');  
  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: kectot.kecamatan,
      datasets: [{
        label: 'Jumlah Laporan per Kecamatan',
        data: kectot.countkec,
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });

  const ctr = document.getElementById('totalkelurahan');
  var keltot = JSON.parse('<?php echo $keltot ?>');  
  new Chart(ctr, {
    type: 'bar',
    data: {
      labels: keltot.kelurahan,
      datasets: [{
        label: 'Jumlah Laporan per Kelurahan',
        data: keltot.countkel,
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });

  const cty = document.getElementById('totalproblem');
  var probtot = JSON.parse('<?php echo $probcount ?>');  
  new Chart(cty, {
    type: 'bar',
    data: {
      labels: probtot.probnama,
      datasets: [{
        label: 'Masalah-masalah yang sering terjadi',
        data: probtot.countprob,
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });

  const ctu = document.getElementById('totaldate');
  var postdate = JSON.parse('<?php echo $month ?>');  
  new Chart(ctu, {
    type: 'bar',
    data: {
      labels: postdate.month,
      datasets: [{
        label: 'Masalah-masalah yang sering terjadi',
        data: postdate.monthcount,
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>
