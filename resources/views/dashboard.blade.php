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
          <span>Dashboard</span></a>
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
        </div>
      </div>
    </li>

    <!-- Perkawinan & Silsilah -->
    <li class="nav-item">
      <a class="nav-link" href="/perkawinan">
        <i class="fas fa-fw fa-link"></i>
        <span>Perkawinan & Silsilah</span>
      </a>
    </li>

    <!-- Kesehatan -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseForm" aria-expanded="true"
        aria-controls="collapseForm">
        <i class="fas fa-fw fa-heartbeat"></i>
        <span>Kesehatan</span>
      </a>
      <div id="collapseForm" class="collapse" aria-labelledby="headingForm" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Pemantauan Kesehatan</h6>
          <a class="collapse-item" href="/kesehatan">Riwayat Kesehatan</a>
        </div>
      </div>
    </li>

    <!-- Laporan & Analisis -->
    <li class="nav-item">
      <a class="nav-link" href="/charts">
        <i class="fas fa-fw fa-chart-area"></i>
        <span>Laporan & Analisis</span>
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
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-envelope fa-fw"></i>
                <span class="badge badge-warning badge-counter">2</span>
              </a>
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="messagesDropdown">
                <h6 class="dropdown-header">
                  Message Center
                </h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="img/man.png" style="max-width: 60px" alt="">
                    <div class="status-indicator bg-success"></div>
                  </div>
                  <div class="font-weight-bold">
                    <div class="text-truncate">Hi there! I am wondering if you can help me with a problem I've been
                      having.</div>
                    <div class="small text-gray-500">Udin Cilok · 58m</div>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="img/girl.png" style="max-width: 60px" alt="">
                    <div class="status-indicator bg-default"></div>
                  </div>
                  <div>
                    <div class="text-truncate">Am I a good boy? The reason I ask is because someone told me that people
                      say this to all dogs, even if they aren't good...</div>
                    <div class="small text-gray-500">Jaenab · 2w</div>
                  </div>
                </a>
                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
              </div>
            </li>
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-tasks fa-fw"></i>
                <span class="badge badge-success badge-counter">3</span>
              </a>
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="messagesDropdown">
                <h6 class="dropdown-header">
                  Task
                </h6>
                <a class="dropdown-item align-items-center" href="#">
                  <div class="mb-3">
                    <div class="small text-gray-500">Design Button
                      <div class="small float-right"><b>50%</b></div>
                    </div>
                    <div class="progress" style="height: 12px;">
                      <div class="progress-bar bg-success" role="progressbar" style="width: 50%" aria-valuenow="50"
                        aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </a>
                <a class="dropdown-item align-items-center" href="#">
                  <div class="mb-3">
                    <div class="small text-gray-500">Make Beautiful Transitions
                      <div class="small float-right"><b>30%</b></div>
                    </div>
                    <div class="progress" style="height: 12px;">
                      <div class="progress-bar bg-warning" role="progressbar" style="width: 30%" aria-valuenow="30"
                        aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </a>
                <a class="dropdown-item align-items-center" href="#">
                  <div class="mb-3">
                    <div class="small text-gray-500">Create Pie Chart
                      <div class="small float-right"><b>75%</b></div>
                    </div>
                    <div class="progress" style="height: 12px;">
                      <div class="progress-bar bg-danger" role="progressbar" style="width: 75%" aria-valuenow="75"
                        aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </a>
                <a class="dropdown-item text-center small text-gray-500" href="#">View All Taks</a>
              </div>
            </li>
            <div class="topbar-divider d-none d-sm-block"></div>
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <img class="img-profile rounded-circle" src="img/boy.png" style="max-width: 60px">
                <span class="ml-2 d-none d-lg-inline text-white small">Jhonatan Sidabutar</span>
              </a>
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Settings
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                  Activity Log
                </a>
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

    <!-- Domba Bayi -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Domba Bayi</div>
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



    <div class="row mb-3">
    <!-- Area Chart: Laporan Rekap Bulanan -->
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

    <!-- Pie Chart: Distribusi Populasi Domba -->
    <div class="col-xl-4 col-lg-5">
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Distribusi Populasi Domba</h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle btn btn-primary btn-sm" href="#" role="button" id="dropdownMenuLink"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Periode <i class="fas fa-chevron-down"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                        aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header">Pilih Periode</div>
                        <a class="dropdown-item" href="#">Hari Ini</a>
                        <a class="dropdown-item" href="#">Minggu Ini</a>
                        <a class="dropdown-item active" href="#">Bulan Ini</a>
                        <a class="dropdown-item" href="#">Tahun Ini</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <div class="small text-gray-500">Domba Jantan
                        <div class="small float-right"><b>45 dari 120</b></div>
                    </div>
                    <div class="progress" style="height: 12px;">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 37.5%" aria-valuenow="37.5"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="small text-gray-500">Domba Betina
                        <div class="small float-right"><b>50 dari 120</b></div>
                    </div>
                    <div class="progress" style="height: 12px;">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 41.7%" aria-valuenow="41.7"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="small text-gray-500">Domba Bayi
                        <div class="small float-right"><b>25 dari 120</b></div>
                    </div>
                    <div class="progress" style="height: 12px;">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 20.8%" aria-valuenow="20.8"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-center">
                <a class="m-0 small text-primary card-link" href="#">Lihat Detail <i
                        class="fas fa-chevron-right"></i></a>
            </div>
        </div>
    </div>
</div>

          <!-- Invoice Table (Penjualan Domba) -->
<div class="col-xl-8 col-lg-7 mb-4">
  <div class="card">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">Laporan Penjualan Domba</h6>
      <a class="m-0 float-right btn btn-danger btn-sm" href="#">Lihat Semua <i class="fas fa-chevron-right"></i></a>
    </div>
    <div class="table-responsive">
      <table class="table align-items-center table-flush">
        <thead class="thead-light">
          <tr>
            <th>ID Transaksi</th>
            <th>Pelanggan</th>
            <th>Jenis Domba</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><a href="#">TRX001</a></td>
            <td>Ahmad Sutrisno</td>
            <td>Domba Texel</td>
            <td><span class="badge badge-success">Selesai</span></td>
            <td><a href="#" class="btn btn-sm btn-primary">Detail</a></td>
          </tr>
          <tr>
            <td><a href="#">TRX002</a></td>
            <td>Siti Rahma</td>
            <td>Domba Garut</td>
            <td><span class="badge badge-warning">Dikirim</span></td>
            <td><a href="#" class="btn btn-sm btn-primary">Detail</a></td>
          </tr>
          <tr>
            <td><a href="#">TRX003</a></td>
            <td>Budi Santoso</td>
            <td>Domba Merino</td>
            <td><span class="badge badge-danger">Pending</span></td>
            <td><a href="#" class="btn btn-sm btn-primary">Detail</a></td>
          </tr>
          <tr>
            <td><a href="#">TRX004</a></td>
            <td>Indra Wijaya</td>
            <td>Domba Suffolk</td>
            <td><span class="badge badge-info">Diproses</span></td>
            <td><a href="#" class="btn btn-sm btn-primary">Detail</a></td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="card-footer"></div>
  </div>
</div>

<!-- Message From Customer (Pesan dari Peternak) -->
<div class="col-xl-4 col-lg-5">
  <div class="card">
    <div class="card-header py-4 bg-primary d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-light">Pesan dari Peternak</h6>
    </div>
    <div>
      <div class="customer-message align-items-center">
        <a class="font-weight-bold" href="#">
          <div class="text-truncate message-title">Halo! Apakah ada saran untuk pakan terbaik?</div>
          <div class="small text-gray-500 message-time font-weight-bold">Rudi Sapi · 30m</div>
        </a>
      </div>
      <div class="customer-message align-items-center">
        <a href="#">
          <div class="text-truncate message-title">Bagaimana cara mengetahui domba sedang sakit?</div>
          <div class="small text-gray-500 message-time">Dian Kambing · 45m</div>
        </a>
      </div>
      <div class="customer-message align-items-center">
        <a class="font-weight-bold" href="#">
          <div class="text-truncate message-title">Adakah fitur untuk mencatat berat domba?</div>
          <div class="small text-gray-500 message-time font-weight-bold">Beni Peternak · 1h</div>
        </a>
      </div>
    </div>
    <div class="card-footer text-center">
      <a class="m-0 small text-primary card-link" href="#">Lihat Semua <i class="fas fa-chevron-right"></i></a>
    </div>
  </div>
</div>
</div>

<!-- Footer -->
<footer class="sticky-footer bg-white">
  <div class="container my-auto">
    <div class="copyright text-center w-100">
      <span>copyright &copy; <script> document.write(new Date().getFullYear()); </script> - developed by
        <b><a>PBL TRPL-605 DombaKu</a></b>
      </span>
    </div>
  </div>
</footer>
<!-- Footer -->


          <!-- Modal Logout -->
          <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabelLogout">Ohh No!</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p>Are you sure you want to logout?</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                  <a href="{{ route('landingpage') }}" class="btn btn-primary">Logout</a>
                </div>
              </div>
            </div>
          </div>

        </div>
        <!---Container Fluid-->
      </div>
    </div>
  </div>

  <!-- Scroll to top -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<script src="{{ asset('js/ruang-admin.min.js') }}"></script>
<script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('js/demo/chart-area-demo.js') }}"></script>

<!-- Tambahkan Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Data untuk Chart Rekap Bulanan (Area Chart)
    var ctxArea = document.getElementById("chartRekapBulanan").getContext("2d");
    var chartRekapBulanan = new Chart(ctxArea, {
        type: "line",
        data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"],
            datasets: [{
                label: "Total Domba",
                data: [100, 120, 130, 110, 150, 160, 170, 165, 180, 200, 220, 230],
                backgroundColor: "rgba(78, 115, 223, 0.05)",
                borderColor: "rgba(78, 115, 223, 1)",
                pointBackgroundColor: "rgba(78, 115, 223, 1)",
                pointBorderColor: "#fff",
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                pointHoverBorderColor: "#fff",
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            },
            scales: {
                x: { grid: { display: false } },
                y: { beginAtZero: true }
            }
        }
    });

    // Data untuk Chart Distribusi Populasi Domba (Pie Chart)
    var ctxPie = document.getElementById("chartDistribusiDomba").getContext("2d");
    var chartDistribusiDomba = new Chart(ctxPie, {
        type: "doughnut",
        data: {
            labels: ["Domba Jantan", "Domba Betina", "Domba Bayi"],
            datasets: [{
                data: [45, 50, 25], // Sesuaikan dengan data yang diambil dari database
                backgroundColor: ["#4e73df", "#e74a3b", "#f6c23e"],
                hoverBackgroundColor: ["#2e59d9", "#d62c1a", "#f4b400"],
                hoverBorderColor: "rgba(234, 236, 244, 1)"
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: "bottom" }
            }
        }
    });
</script>

</body>

</html>