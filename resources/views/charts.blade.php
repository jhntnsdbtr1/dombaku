<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <link href="{{ asset('img/logo/domba.png') }}" rel="icon">
  <title>@yield('title', 'Charts')</title>

  <!-- Styles -->
  <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('css/ruang-admin.min.css') }}" rel="stylesheet">
</head>


<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/dashboard">
        <div class="sidebar-brand-icon">
          <img src="img/logo/dombakuh.png">
        </div>
        <div class="sidebar-brand-text mx-3" style="color: #ffffff;">DombaKu</div>
      </a>
      <hr class="sidebar-divider my-0">
      <li class="nav-item active">
        <a class="nav-link" href="/dashboard">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Beranda</span>
        </a>
      </li>

      <hr class="sidebar-divider">

      <div class="sidebar-heading">
        Fitur
      </div>

      <!-- Manajemen -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTable" aria-expanded="true" aria-controls="collapseTable">
          <i class="fas fa-fw fa-table"></i>
          <span>Manajemen</span>
        </a>
        <div id="collapseTable" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Manajemen Data</h6>
            <a class="collapse-item" href="/manajemendomba">Manajemen Domba</a>
            <a class="collapse-item" href="/manajemenkandang">Manajemen Kandang</a>
            <a class="collapse-item" href="/kelahiran">Manajemen Kelahiran</a>
          </div>
        </div>
      </li>

      <!-- Perkawinan Domba -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePerkawinan" aria-expanded="false" aria-controls="collapsePerkawinan">
          <i class="fas fa-fw fa-link"></i>
          <span>Perkawinan Domba</span>
        </a>
        <div id="collapsePerkawinan" class="collapse" aria-labelledby="headingPerkawinan" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Perkawinan & Rekomendasi</h6>
            <a class="collapse-item" href="/uploadcsv">Upload Training Data</a>
            <a class="collapse-item" href="/rekomendasikawin">Rekomendasi Kawin</a>
            <a class="collapse-item" href="/perkawinan">Manajemen Perkawinan</a>
          </div>
        </div>
      </li>

      <!-- Riwayat -->
      <li class="nav-item">
        <a class="nav-link" href="/history">
          <i class="fas fa-fw fa-history"></i>
          <span>Riwayat</span>
        </a>
      </li>

      <!-- Denah Kandang -->
      <li class="nav-item">
        <a class="nav-link" href="/kandang">
          <i class="fas fa-fw fa-map"></i>
          <span>Denah Kandang</span>
        </a>
      </li>

      <!-- Laporan & Analisis -->
      <li class="nav-item">
        <a class="nav-link" href="/charts">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Laporan</span>
        </a>
      </li>

      <!-- Pengguna -->
      <li class="nav-item">
        <a class="nav-link" href="/users">
          <i class="fas fa-fw fa-user"></i>
          <span>Pengguna</span>
        </a>
      </li>
    </ul>
    <!-- Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- TopBar -->
        <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
          <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>
          <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="voiceDropdown" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-microphone fa-fw" id="voiceButton" style="cursor: pointer;"></i>
              </a>
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="voiceDropdown">
                <p id="voiceOutput" class="mt-2">Perintah akan ditampilkan di sini...</p>
              </div>
            </li>
            <div class="topbar-divider d-none d-sm-block"></div>
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <img class="img-profile rounded-circle" src="img/boy.png" style="max-width: 60px">
                <span class="ml-2 d-none d-lg-inline text-white small">
                  {{ session('username', 'Guest') }}
                </span> </a>
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Keluar
                </a>
              </div>
            </li>
          </ul>
        </nav>
        <!-- Topbar -->
        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Charts</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Halaman Utama</a></li>
              <li class="breadcrumb-item active" aria-current="page">Charts</li>
            </ol>
          </div>
          <!-- Row -->
          <div class="row">
            <!-- Area Chart - Populasi Domba per Bulan -->
            <div class="col-lg-6">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Populasi Domba per Bulan</h6>
                </div>
                <div class="card-body">
                  <div class="chart-area">
                    <canvas id="populationChart"></canvas>
                  </div>
                </div>
              </div>
            </div>

            <!-- Bar Chart - Distribusi Domba Berdasarkan Umur -->
            <div class="col-lg-6">
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Distribusi Domba Berdasarkan Umur</h6>
                </div>
                <div class="card-body">
                  <div class="chart-bar">
                    <canvas id="ageChart"></canvas>
                  </div>
                </div>
              </div>
            </div>

            <!-- Gender Distribution -->
            <div class="col-lg-6 d-flex justify-content-center">
              <div class="card shadow mb-4 w-100">
                <div class="card-header py-3 text-center">
                  <h6 class="m-0 font-weight-bold text-primary">Proporsi Jenis Kelamin Domba</h6>
                </div>
                <div class="card-body d-flex justify-content-center align-items-center">
                  <div class="chart-container" style="position: relative; height: 350px; width: 350px;">
                    <canvas id="genderChart"></canvas>
                  </div>
                </div>
              </div>
            </div>

            <!-- Fertility Chart -->
            <div class="col-lg-6">
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Tingkat Fertilitas Domba</h6>
                </div>
                <div class="card-body">
                  <div class="chart-line">
                    <canvas id="fertilityChart"></canvas>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Modal Logout -->
          <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabelLogout">Keluar dari Sistem?</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p>Apakah Anda yakin ingin keluar?</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-success" data-dismiss="modal">Batal</button>
                  <a href="{{ route('logout') }}" class="btn btn-success">Keluar</a>
                </div>
              </div>
            </div>
          </div>
          <!---Container Fluid-->
        </div>

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>copyright &copy; <script>
                  document.write(new Date().getFullYear());
                </script> - developed by
                <b><a href="{{ route('landingpage') }}" style="color: #0F382A; text-decoration: none;">PBL-TRPL605</a></b>
              </span>
              <br>
              <span id="version-ruangadmin"></span>
            </div>
          </div>
        </footer>
        <!-- Footer -->
      </div>
    </div>

    <!-- Scroll to top -->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Scripts -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/ruang-admin.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('js/demo/chart-pie-demo.js') }}"></script>
    <script src="{{ asset('js/demo/chart-bar-demo.js') }}"></script>

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Chart.js Script -->
    <script>
      const monthLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

      // Data dari Controller Laravel
      const populationData = <?php echo json_encode($populasiPerBulan); ?>;
      const genderData = <?php echo json_encode($genderData); ?>;
      const fertilityData = <?php echo json_encode($fertilityData); ?>;
      const ageData = <?php echo json_encode($ageData); ?>;

      // Chart Populasi
      var ctx1 = document.getElementById('populationChart').getContext('2d');
      var populationChart = new Chart(ctx1, {
        type: 'line',
        data: {
          labels: monthLabels,
          datasets: [{
            label: 'Populasi Domba',
            data: populationData,
            backgroundColor: 'rgba(40, 167, 69, 0.2)', // Ubah warna latar belakang menjadi hijau
            borderColor: 'rgba(40, 167, 69, 1)', // Ubah warna garis border menjadi hijau
            borderWidth: 2
          }]
        }
      });

      // Chart Jenis Kelamin
      var ctx2 = document.getElementById('genderChart').getContext('2d');
      var genderChart = new Chart(ctx2, {
        type: 'doughnut',
        data: {
          labels: ['Jantan', 'Betina'],
          datasets: [{
            data: genderData,
            backgroundColor: ['rgba(255, 99, 132, 0.7)', 'rgba(75, 192, 192, 0.7)']
          }]
        }
      });

      // Chart Fertilitas
      var ctx3 = document.getElementById('fertilityChart').getContext('2d');
      var fertilityChart = new Chart(ctx3, {
        type: 'bar',
        data: {
          labels: monthLabels,
          datasets: [{
            label: 'Jumlah Kelahiran',
            data: fertilityData, // ini sekarang benar
            backgroundColor: 'rgba(54, 162, 235, 0.6)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
          }]
        }
      });

      // Chart Umur
      var ctx4 = document.getElementById('ageChart').getContext('2d');
      var ageChart = new Chart(ctx4, {
        type: 'bar',
        data: {
          labels: ['0-6 Bulan', '7-12 Bulan', '13-24 Bulan', '25-36 Bulan', '37-48 Bulan', '49+ Bulan'],
          datasets: [{
            label: 'Jumlah Domba',
            data: ageData,
            backgroundColor: 'rgba(153, 102, 255, 0.6)',
            borderColor: 'rgba(153, 102, 255, 1)',
            borderWidth: 1
          }]
        }
      });
    </script>

    <!-- Tambahkan compromise.js -->
    <script src="https://unpkg.com/compromise"></script>

    <script>
      document.getElementById("voiceButton").addEventListener("click", function() {
        const recognition = new(window.SpeechRecognition || window.webkitSpeechRecognition)();
        recognition.lang = 'id-ID'; // Bahasa Indonesia
        recognition.interimResults = false;
        recognition.maxAlternatives = 1;

        recognition.start();

        recognition.onresult = function(event) {
          const command = event.results[0][0].transcript.toLowerCase();
          document.getElementById("voiceOutput").innerText = "Perintah: " + command;

          // Proses NLP dengan compromise.js
          const doc = nlp(command);
          const nouns = doc.nouns().out('array'); // ekstrak kata benda
          const verbs = doc.verbs().out('array'); // ekstrak kata kerja

          // Ubah jadi format string agar masih cocok dengan kode asli
          const commandNLP = nouns.concat(verbs).join(" ");

          // Kodingan asli tetap dipakai
          if (commandNLP.includes("refresh halaman")) {
            location.reload();
          } else if (commandNLP.includes("beranda")) {
            window.location.href = `/dashboard`;
          } else if (commandNLP.includes("manajemen domba")) {
            window.location.href = `/manajemendomba`;
          } else if (commandNLP.includes("manajemen kandang")) {
            window.location.href = `/manajemenkandang`;
          } else if (commandNLP.includes("manajemen kelahiran")) {
            window.location.href = `/kelahiran`;
          } else if (commandNLP.includes("upload") || commandNLP.includes("training data")) {
            window.location.href = `/uploadcsv`;
          } else if (commandNLP.includes("rekomendasi kawin")) {
            window.location.href = `/rekomendasikawin`;
          } else if (commandNLP.includes("manajemen perkawinan")) {
            window.location.href = `/perkawinan`;
          } else if (commandNLP.includes("riwayat")) {
            window.location.href = `/history`;
          } else if (commandNLP.includes("denah kandang")) {
            window.location.href = `/kandang`;
          } else if (commandNLP.includes("laporan")) {
            window.location.href = `/charts`;
          } else if (commandNLP.includes("pengguna")) {
            window.location.href = `/users`;
          } else {
            alert("Perintah tidak dikenali: " + command);
          }
        };

        recognition.onerror = function(event) {
          alert("Terjadi error: " + event.error);
        };
      });
    </script>

</body>

</html>