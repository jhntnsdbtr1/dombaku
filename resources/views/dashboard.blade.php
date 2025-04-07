<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <link href="{{ asset('img/logo/domba.png') }}" rel="icon">
  <title>@yield('title', 'DombaKu - Dashboard')</title>

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
          <span>Dashboard</span>
        </a>
      </li>

      <hr class="sidebar-divider">

      <div class="sidebar-heading">
        Features
      </div>

      <!-- Manajemen -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTable" aria-expanded="true"
          aria-controls="collapseTable">
          <i class="fas fa-fw fa-table"></i>
          <span>Manajemen</span>
        </a>
        <div id="collapseTable" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Manajemen Data</h6>
            <a class="collapse-item" href="/manajemendomba">Manajemen Domba</a>
            <a class="collapse-item" href="/manajemenkandang">Manajemen Kandang</a>
            <a class="collapse-item" href="/kelahiran">Manajemen Kelahiran</a> <!-- Ditambahkan -->
          </div>
        </div>
      </li>

      <!-- Perkawinan & Silsilah -->
      <li class="nav-item">
        <a class="nav-link" href="/perkawinan">
          <i class="fas fa-fw fa-link"></i>
          <span>Perkawinan</span>
        </a>
      </li>

      <!-- Denah Kandang -->
      <li class="nav-item">
        <a class="nav-link" href="/kandang">
          <i class="fas fa-fw fa-map"></i>
          <span>Denah Kandang</span> <!-- Ditambahkan -->
        </a>
      </li>

      <!-- History -->
      <li class="nav-item">
        <a class="nav-link" href="/history">
          <i class="fas fa-fw fa-history"></i>
          <span>Riwayat</span> <!-- Ditambahkan -->
        </a>
      </li>

      <!-- Laporan & Analisis -->
      <li class="nav-item">
        <a class="nav-link" href="/charts">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Laporan</span>
        </a>
      </li>

      <!-- Users -->
      <li class="nav-item">
        <a class="nav-link" href="/users">
          <i class="fas fa-fw fa-user"></i> <!-- Mengubah ikon menjadi user -->
          <span>Pengguna</span> <!-- Mengubah teks -->
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
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                aria-labelledby="searchDropdown">
                <form class="navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-1 small" placeholder="What do you want to look for?"
                      aria-label="Search" aria-describedby="basic-addon2" style="border-color: #3f51b5;">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <span class="badge badge-danger badge-counter">3+</span>
              </a>
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                  Alerts Center
                </h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-primary">
                      <i class="fas fa-file-alt text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 12, 2019</div>
                    <span class="font-weight-bold">A new monthly report is ready to download!</span>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-success">
                      <i class="fas fa-donate text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 7, 2019</div>
                    $290.29 has been deposited into your account!
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-warning">
                      <i class="fas fa-exclamation-triangle text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 2, 2019</div>
                    Spending Alert: We've noticed unusually high spending for your account.
                  </div>
                </a>
                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
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
                  Logout
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
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
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
                      <div class="h5 mb-0 font-weight-bold text-gray-800">45</div>
                      <div class="mt-2 mb-0 text-muted text-xs">
                        <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 5%</span>
                        <span>Since last month</span>
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
                      <div class="h5 mb-0 font-weight-bold text-gray-800">50</div>
                      <div class="mt-2 mb-0 text-muted text-xs">
                        <span class="text-danger mr-2"><i class="fa fa-arrow-down"></i> 2%</span>
                        <span>Since last month</span>
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
                      <div class="h5 mb-0 font-weight-bold text-gray-800">25</div>
                      <div class="mt-2 mb-0 text-muted text-xs">
                        <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 10%</span>
                        <span>Since last month</span>
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
                      <div class="h5 mb-0 font-weight-bold text-gray-800">120</div>
                      <div class="mt-2 mb-0 text-muted text-xs">
                        <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 4%</span>
                        <span>Since last month</span>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-success"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div> <!-- End row statistik -->

          <!-- Row untuk grafik -->
          <div class="row mb-3">
            <!-- Grafik Rekap Bulanan -->
            <div class="col-xl-8 col-lg-7">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Laporan Rekap Bulanan</h6>
                  <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                      aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                      aria-labelledby="dropdownMenuLink">
                      <div class="dropdown-header">Filter Periode:</div>
                      <a class="dropdown-item" href="#">Mingguan</a>
                      <a class="dropdown-item" href="#">Bulanan</a>
                      <a class="dropdown-item" href="#">Tahunan</a>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <div class="chart-area">
                    <canvas id="chartRekapBulanan"></canvas>
                  </div>
                </div>
              </div>
            </div>

            <!-- Grafik Pie: Distribusi Populasi -->
            <div class="col-xl-4 col-lg-5">
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary text-center">Distribusi Populasi Domba</h6>
                </div>
                <div class="card-body">
                  <div class="chart-pie">
                    <canvas id="chartDistribusiDomba"></canvas>
                  </div>
                  <div class="mb-3">
                    <div class="small text-gray-500">Domba Jantan
                      <div class="small float-right"><b>45 dari 120</b></div>
                    </div>
                    <div class="progress" style="height: 12px;">
                      <div class="progress-bar bg-primary" style="width: 37.5%"></div>
                    </div>
                  </div>
                  <div class="mb-3">
                    <div class="small text-gray-500">Domba Betina
                      <div class="small float-right"><b>50 dari 120</b></div>
                    </div>
                    <div class="progress" style="height: 12px;">
                      <div class="progress-bar bg-danger" style="width: 41.7%"></div>
                    </div>
                  </div>
                  <div class="mb-3">
                    <div class="small text-gray-500">Domba Anakan
                      <div class="small float-right"><b>25 dari 120</b></div>
                    </div>
                    <div class="progress" style="height: 12px;">
                      <div class="progress-bar bg-warning" style="width: 20.8%"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div> <!-- End row grafik -->

          <!-- Footer -->
          <footer class="sticky-footer bg-white">
            <div class="container my-auto">
              <div class="copyright text-center w-100">
                <span>Copyright &copy; 2025 - Developed by <b>PBL TRPL-605 DombaKu</b></span>
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

        <!-- Tambahkan Chart.js -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js" defer></script>

        <script>
          document.addEventListener("DOMContentLoaded", function() {
            setTimeout(() => {
              try {
                // Inisialisasi Chart Rekap Bulanan (Line Chart)
                var ctxArea = document.getElementById("chartRekapBulanan");
                if (!ctxArea) {
                  console.warn("⚠️ Elemen #chartRekapBulanan tidak ditemukan. Chart tidak akan dirender.");
                  return;
                }
                var chartRekapBulanan = new Chart(ctxArea.getContext("2d"), {
                  type: "line",
                  data: {
                    labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"],
                    datasets: [{
                      label: "Total Domba",
                      data: [100, 120, 130, 110, 150, 160, 170, 165, 180, 200, 220, 230],
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

                // Inisialisasi Chart Distribusi Populasi Domba (Doughnut Chart)
                var ctxPie = document.getElementById("chartDistribusiDomba");
                if (!ctxPie) {
                  console.warn("⚠️ Elemen #chartDistribusiDomba tidak ditemukan. Chart tidak akan dirender.");
                  return;
                }
                var chartDistribusiDomba = new Chart(ctxPie.getContext("2d"), {
                  type: "doughnut",
                  data: {
                    labels: ["Domba Jantan", "Domba Betina", "Domba Anakan"],
                    datasets: [{
                      data: [45, 50, 25],
                      backgroundColor: ["#4e73df", "#e74a3b", "#f6c23e"],
                      hoverBorderColor: "rgba(234, 236, 244, 1)"
                    }]
                  },
                  options: {
                    responsive: true,
                    plugins: {
                      legend: {
                        position: "bottom"
                      }
                    }
                  }
                });

              } catch (error) {
                console.error("❌ Terjadi kesalahan saat merender chart:", error);
              }
            }, 100); // Delay kecil untuk memastikan elemen sudah termuat
          });
        </script>
  </body>

</html>