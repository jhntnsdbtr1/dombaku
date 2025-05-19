<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <link href="{{ asset('img/logo/domba.png') }}" rel="icon">
  <title>@yield('title', 'Beranda')</title>

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

            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <span class="badge badge-danger badge-counter" id="alertsCount">{{ count($alerts ?? []) }}</span>
              </a>
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                  Notifikasi
                </h6>

                @forelse($alerts ?? [] as $alert)
                <a class="dropdown-item d-flex align-items-center" href="#" data-alert-id="{{ $alert['id'] }}">
                  <div class="mr-3">
                    <div class="icon-circle bg-warning">
                      <i class="fas fa-exclamation-triangle text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">{{ \Carbon\Carbon::parse($alert['tanggal'])->format('F d, Y') }}</div>
                    {{ $alert['message'] }}
                  </div>
                </a>
                @empty
                <div class="dropdown-item text-center small text-gray-500">Tidak ada notifikasi</div>
                @endforelse

                <a class="dropdown-item text-center small text-gray-500" href="#">Tampilkan Semua</a>
              </div>
            </li>
            <div class="topbar-divider d-none d-sm-block"></div>
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <img class="img-profile rounded-circle" src="img/boy.png" style="max-width: 60px">
                <span class="ml-2 d-none d-lg-inline text-white small">
                  {{ session('username', 'Guest') }}
                </span>
              </a>
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
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Halaman Utama</a></li>
              <li class="breadcrumb-item active" aria-current="page">Beranda</li>
            </ol>
          </div>


          <!-- Row untuk statistik -->
          <div class="row mb-3">
            <!-- Domba Jantan -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Domba Jantan</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jantan }}</div>
                      <div class="mt-2 mb-0 text-muted text-xs">
                        <span class="{{ $jantanDiff >= 0 ? 'text-success' : 'text-danger' }} mr-2">
                          <i class="fa {{ $jantanDiff >= 0 ? 'fa-arrow-up' : 'fa-arrow-down' }}"></i> {{ abs($jantanDiff) }}%
                        </span>
                        <span class="text-nowrap">Sejak bulan lalu</span>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-mars fa-2x text-primary"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Domba Betina -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Domba Betina</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $betina }}</div>
                      <div class="mt-2 mb-0 text-muted text-xs">
                        <span class="{{ $betinaDiff >= 0 ? 'text-success' : 'text-danger' }} mr-2">
                          <i class="fa {{ $betinaDiff >= 0 ? 'fa-arrow-up' : 'fa-arrow-down' }}"></i> {{ abs($betinaDiff) }}%
                        </span>
                        <span class="text-nowrap">Sejak bulan lalu</span>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-venus fa-2x text-danger"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Domba Anakan -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Domba Anakan</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $anakan }}</div>
                      <div class="mt-2 mb-0 text-muted text-xs">
                        <span class="{{ $anakanDiff >= 0 ? 'text-success' : 'text-danger' }} mr-2">
                          <i class="fa {{ $anakanDiff >= 0 ? 'fa-arrow-up' : 'fa-arrow-down' }}"></i> {{ abs($anakanDiff) }}%
                        </span>
                        <span class="text-nowrap">Sejak bulan lalu</span>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-baby fa-2x text-warning"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Total Domba -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Total Domba</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalDomba }}</div>
                      <div class="mt-2 mb-0 text-muted text-xs">
                        <span class="{{ $totalDiff >= 0 ? 'text-success' : 'text-danger' }} mr-2">
                          <i class="fa {{ $totalDiff >= 0 ? 'fa-arrow-up' : 'fa-arrow-down' }}"></i> {{ abs($totalDiff) }}%
                        </span>
                        <span class="text-nowrap">Sejak bulan lalu</span>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-success"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <!-- Grafik Bulanan: Rekap Bulanan (Line Chart) -->
            <div class="col-xl-8 col-lg-8 col-md-12 mb-4"> <!-- Ukuran kolom lebih besar -->
              <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between">
                  <!-- Menampilkan tahun yang dipilih dalam judul -->
                  <h6 class="m-0 font-weight-bold text-primary text-center">
                    Rekap Bulanan Domba {{ $selectedYear }} <!-- Menampilkan tahun di sini -->
                  </h6>

                  <!-- Select Year -->
                  <form method="GET" action="{{ route('dashboard') }}">
                    <div class="form-group d-flex align-items-center">
                      <label for="year" class="mr-2">Pilih Tahun:</label>
                      <select name="year" id="year" class="form-control" onchange="this.form.submit()" style="width: auto;">
                        @for ($i = 2020; $i <= \Carbon\Carbon::now()->year; $i++)
                          <option value="{{ $i }}" {{ $i == $selectedYear ? 'selected' : '' }}>{{ $i }}</option>
                          @endfor
                      </select>
                    </div>
                  </form>
                </div>
                <div class="card-body">
                  <div class="chart-area">
                    <canvas id="chartRekapBulanan"></canvas>
                  </div>
                </div>
              </div>
            </div>

            <!-- Grafik Pie: Distribusi Populasi Domba -->
            <div class="col-xl-4 col-lg-4 col-md-12 mb-4"> <!-- Ukuran kolom lebih kecil -->
              <div class="card shadow mb-4 h-100">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary text-center">Distribusi Populasi Domba</h6>
                </div>
                <div class="card-body d-flex flex-column align-items-center p-3">
                  <!-- Grafik Pie -->
                  <div class="chart-pie mb-1" style="width: 80%; height: 200px;">
                    <canvas id="chartDistribusiDomba"></canvas>
                  </div>

                  <!-- Domba Jantan -->
                  <div class="mb-0 w-100">
                    <div class="small text-gray-500">Domba Jantan
                      <div class="small float-right">
                        <b><span id="jantanCount"></span> dari <span id="totalCountJantan"></span></b>
                      </div>
                    </div>
                    <div class="progress" style="height: 12px;">
                      <div class="progress-bar bg-primary" style="width: 0%" id="jantanProgress"></div>
                    </div>
                  </div>

                  <!-- Domba Betina -->
                  <div class="mb-1 w-100">
                    <div class="small text-gray-500">Domba Betina
                      <div class="small float-right">
                        <b><span id="betinaCount"></span> dari <span id="totalCountBetina"></span></b>
                      </div>
                    </div>
                    <div class="progress" style="height: 12px;">
                      <div class="progress-bar bg-danger" style="width: 0%" id="betinaProgress"></div>
                    </div>
                  </div>

                  <!-- Domba Anakan -->
                  <div class="mb-1 w-100">
                    <div class="small text-gray-500">Domba Anakan
                      <div class="small float-right">
                        <b><span id="anakanCount"></span> dari <span id="totalCountAnakan"></span></b>
                      </div>
                    </div>
                    <div class="progress" style="height: 12px;">
                      <div class="progress-bar bg-warning" style="width: 0%" id="anakanProgress"></div>
                    </div>
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

        </div> <!-- End container-wrapper -->

        <!-- Scroll to top -->
        <a class="scroll-to-top rounded" href="#page-top">
          <i class="fas fa-angle-up"></i>
        </a>

        <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
        <script src="{{ asset('js/ruang-admin.min.js') }}"></script>

        <script src="https://cdn.jsdelivr.net/npm/chart.js" defer></script>

        <script>
          document.addEventListener("DOMContentLoaded", function() {
            setTimeout(() => {
              try {
                // Data dari PHP
                var dombaJantan = <?php echo $jantan; ?>;
                var dombaBetina = <?php echo $betina; ?>;
                var dombaAnakan = <?php echo $anakan; ?>;
                var totalDomba = dombaJantan + dombaBetina;

                // Update total populasi
                document.getElementById("totalCountJantan").innerText = totalDomba;
                document.getElementById("totalCountBetina").innerText = totalDomba;
                document.getElementById("totalCountAnakan").innerText = totalDomba;

                // Update nilai dan progress (hindari pembagian 0)
                if (totalDomba > 0) {
                  var jantanPercentage = (dombaJantan / totalDomba) * 100;
                  var betinaPercentage = (dombaBetina / totalDomba) * 100;
                  var anakanPercentage = (dombaAnakan / totalDomba) * 100;
                } else {
                  var jantanPercentage = 0;
                  var betinaPercentage = 0;
                  var anakanPercentage = 0;
                }

                document.getElementById("jantanCount").innerText = dombaJantan;
                document.getElementById("jantanProgress").style.width = jantanPercentage.toFixed(2) + "%";

                document.getElementById("betinaCount").innerText = dombaBetina;
                document.getElementById("betinaProgress").style.width = betinaPercentage.toFixed(2) + "%";

                document.getElementById("anakanCount").innerText = dombaAnakan;
                document.getElementById("anakanProgress").style.width = anakanPercentage.toFixed(2) + "%";

                var ctxArea = document.getElementById("chartRekapBulanan");
                if (ctxArea) {
                  new Chart(ctxArea.getContext("2d"), {
                    type: "line",
                    data: {
                      labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"],
                      datasets: [{
                        label: "Total Domba " + "{{ $selectedYear }}", // Menambahkan tahun ke label
                        data: <?php echo json_encode($rekapBulanan); ?>,
                        backgroundColor: "rgba(78, 115, 223, 0.05)",
                        borderColor: "rgba(78, 115, 223, 1)",
                        fill: true,
                        tension: 0.4
                      }]
                    },
                    options: {
                      responsive: true,
                      plugins: {
                        legend: {
                          display: true
                        }
                      },
                      scales: {
                        y: {
                          beginAtZero: true
                        }
                      }
                    }
                  });
                }

                // Doughnut Chart Distribusi
                var ctxPie = document.getElementById("chartDistribusiDomba");
                if (ctxPie) {
                  new Chart(ctxPie.getContext("2d"), {
                    type: "doughnut",
                    data: {
                      labels: ["Domba Jantan", "Domba Betina", "Domba Anakan"],
                      datasets: [{
                        data: [dombaJantan, dombaBetina, dombaAnakan],
                        backgroundColor: ["#4e73df", "#e74a3b", "#f6c23e"],
                        hoverBorderColor: "rgba(234, 236, 244, 1)"
                      }]
                    },
                    options: {
                      responsive: true,
                      plugins: {
                        legend: {
                          display: false
                        }
                      }
                    }
                  });
                }

              } catch (error) {
                console.error("❌ Terjadi kesalahan saat merender chart:", error);
              }
            }, 100);
          });
        </script>

        <script>
          // Menambahkan log untuk memeriksa apakah event listener bekerja
          document.querySelectorAll('.dropdown-item').forEach(function(item) {
            item.addEventListener('click', function(event) {
              event.preventDefault(); // Mencegah aksi default dari klik
              var alertId = item.getAttribute('data-alert-id'); // Mendapatkan ID notifikasi dari atribut data
              console.log("ID Notifikasi yang diklik:", alertId); // Log ID notifikasi

              // Memeriksa apakah ID valid sebelum mengirim
              if (alertId) {
                markAsRead(alertId); // Memanggil fungsi untuk menandai sebagai "read"
              } else {
                console.error('Alert ID tidak ditemukan pada item');
              }
            });
          });

          // Ambil token CSRF dari meta tag di HTML
          const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

          // Fungsi untuk menandai notifikasi sebagai "read"
          function markAsRead(alertId) {
            console.log("Menandai Alert ID sebagai read:", alertId); // Log ID yang dikirim
            if (alertId) {
              // Mengirim permintaan PATCH ke server untuk menandai notifikasi sebagai "read"
              fetch(`/mark-alert-read/${alertId}`, {
                  method: 'PATCH',
                  headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken, // Mengirimkan token CSRF
                  },
                })
                .then(response => {
                  console.log('Status Response:', response.status); // Log status dari respons
                  if (!response.ok) {
                    throw new Error('Gagal menandai notifikasi sebagai read');
                  }
                  return response.json(); // Mengonversi respons ke format JSON
                })
                .then(data => {
                  console.log('Response dari server:', data); // Log respons server
                  // Memperbarui jumlah notifikasi yang belum dibaca di UI
                  if (data.newCount !== undefined) {
                    document.getElementById('alertsCount').textContent = data.newCount; // Mengupdate elemen dengan ID 'alertsCount'
                  } else {
                    console.error('Jumlah notifikasi baru tidak ditemukan dalam respons');
                  }
                })
                .catch(error => {
                  console.error('Error dalam permintaan fetch:', error); // Log jika terjadi error dalam permintaan fetch
                });
            } else {
              console.error('No alert ID passed'); // Log jika ID tidak ditemukan
            }
          }
        </script>

        <!-- Tambahkan compromise.js -->
        <script src="{{ asset('js/compromise.js') }}"></script>

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