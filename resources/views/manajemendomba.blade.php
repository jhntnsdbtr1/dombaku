<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <link href="{{ asset('img/logo/domba.png') }}" rel="icon">
    <title>@yield('title', 'Manajemen Kandang Domba')</title>

    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/ruang-admin.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/css/select2.min.css') }}" rel="stylesheet">

    <style>
    .legend-box {
        display: flex;
        flex-wrap: wrap;
        gap: 10px; /* Jarak antar elemen */
        margin-bottom: 2px; /* Jarak dari elemen di bawah */
        padding: 20px; /* Tambahkan padding */
    }
    .legend-item {
        display: flex;
        align-items: center;
        gap: 5px;
        
    }
    .legend-color {
        width: 20px;
        height: 20px;
        border-radius: 4px;
        display: inline-block;
    }
    .putih { background-color: white; border: 1px solid black; }
    .merah { background-color: red; border: 1px solid black; }
    .biru { background-color: blue; border: 1px solid black; }
    .hijau { background-color: green; border: 1px solid black; }
    .kuning { background-color: yellow; border: 1px solid black; }
</style>

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
              <span>History</span> <!-- Ditambahkan -->
          </a>
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
            <h1 class="h3 mb-0 text-gray-800">Manajemen Domba</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item">Manajemen</li>
              <li class="breadcrumb-item active" aria-current="page">Manajemen Domba</li>
            </ol>
          </div>

          <div class="row">
  <!-- DataTable with Hover -->
  <div class="col-lg-12">
    <div class="card mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary w-100">Detail Domba</h6>
        <button type="button" class="btn btn-sm btn-success d-flex align-items-center" data-toggle="modal" data-target="#tambahModal">
                  <i class="fas fa-plus mr-2"></i> Tambah
              </button>
      </div>

      <div class="legend-box">
        <div class="legend-item">
            <span class="legend-color putih"></span> <span>Betina lahir di kandang, siap kawin</span>
        </div>
        <div class="legend-item">
            <span class="legend-color merah"></span> <span>Indukan luar</span>
        </div>
        <div class="legend-item">
            <span class="legend-color biru"></span> <span>Jantan</span>
        </div>
        <div class="legend-item">
            <span class="legend-color hijau"></span> <span>Cempe < 1 bulan</span>
        </div>
        <div class="legend-item">
            <span class="legend-color kuning"></span> <span>Cempe > 1 bulan</span>
        </div>
    </div>
      <div class="table-responsive p-3">
      <style>
    .eartag-putih { background-color: white; color: black; font-weight: bold; }
    .eartag-merah { background-color: red; color: white; font-weight: bold; }
    .eartag-biru { background-color: blue; color: white; font-weight: bold; }
    .eartag-hijau { background-color: green; color: white; font-weight: bold; }
    .eartag-kuning { background-color: yellow; color: black; font-weight: bold; }
</style>

<table class="table align-items-center table-flush table-hover text-center" id="dataTableHover">
    <thead class="thead-light">
        <tr>
            <th>No</th>
            <th>EARTAG</th>
            <th>Kelamin</th>
            <th>Tanggal Lahir</th>
            <th>Induk Betina</th>
            <th>Induk Jantan</th>
            <th>Bobot Badan (kg)</th>
            <th>Kandang</th>
            <th>Keterangan</th>
            <th>Kesehatan</th>
            <th>Detail</th>
        </tr>
    </thead>
    <tbody>                
        <tr>
            <td>1</td>
            <td class="eartag-biru">DM001</td>
            <td>Jantan</td>
            <td>10-03-2023</td>
            <td>IB001</td>
            <td>IJ001</td>
            <td>45</td>
            <td>Kandang A</td>
            <td></td>
            <td><span class="badge badge-success">Sehat</span></td>
            <td><a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#detailModal">Detail</a></td>
        </tr>
        <tr>
            <td>2</td>
            <td class="eartag-putih">DM002</td>
            <td>Betina</td>
            <td>15-08-2023</td>
            <td>IB002</td>
            <td>IJ002</td>
            <td>38</td>
            <td>Kandang B</td>
            <td>Kurang nafsu makan dalam seminggu terakhir</td>
            <td><span class="badge badge-warning">Perlu Perhatian</span></td>
            <td><a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#detailModal">Detail</a></td>
        </tr>
        <tr>
            <td>3</td>
            <td class="eartag-biru">DM003</td>
            <td>Jantan</td>
            <td>05-06-2022</td>
            <td>IB003</td>
            <td>IJ003</td>
            <td>50</td>
            <td>Kandang C</td>
            <td></td>
            <td><span class="badge badge-success">Sehat</span></td>
            <td><a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#detailModal">Detail</a></td>
        </tr>
        <tr>
            <td>4</td>
            <td class="eartag-merah">DM004</td>
            <td>Betina</td>
            <td>20-11-2022</td>
            <td>IB004</td>
            <td>IJ004</td>
            <td>42</td>
            <td>Kandang D</td>
            <td>Mengalami batuk dan lemas dalam dua hari terakhir</td>
            <td><span class="badge badge-danger">Sakit</span></td>
            <td><a href="#" class="btn btn-sm btn-primary">Detail</a></td>
        </tr>
        <tr>
            <td>5</td>
            <td class="eartag-kuning">DM005</td>
            <td>Jantan</td>
            <td>12-07-2023</td>
            <td>IB005</td>
            <td>IJ005</td>
            <td>47</td>
            <td>Kandang E</td>
            <td></td>
            <td><span class="badge badge-success">Sehat</span></td>
            <td><a href="#" class="btn btn-sm btn-primary">Detail</a></td>
        </tr>
    </tbody>
</table>

      </div>
    </div>
  </div>
</div>

<!-- Modal Tambah Data Domba -->
<div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahModalLabel">Tambah Data Domba</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formTambah">
                    <div class="form-group">
                        <label for="eartag">EARTAG</label>
                        <input type="text" class="form-control" id="eartag" required>
                    </div>
                    <div class="form-group">
                        <label for="kelamin">Kelamin</label>
                        <select class="form-control" id="kelamin" required>
                            <option value="Jantan">Jantan</option>
                            <option value="Betina">Betina</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_lahir">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="tanggal_lahir" required>
                    </div>
                    <div class="form-group">
                        <label for="induk_betina">Induk Betina</label>
                        <input type="text" class="form-control" id="induk_betina">
                    </div>
                    <div class="form-group">
                        <label for="induk_jantan">Induk Jantan</label>
                        <input type="text" class="form-control" id="induk_jantan">
                    </div>
                    <div class="form-group">
                        <label for="bobot_badan">Bobot Badan (kg)</label>
                        <input type="number" class="form-control" id="bobot_badan" step="0.1" required>
                    </div>
                    <div class="form-group">
                        <label for="kandang">Kandang</label>
                        <input type="text" class="form-control" id="kandang" required>
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea class="form-control" id="keterangan"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="kesehatan">Kesehatan</label>
                        <textarea class="form-control" id="kesehatan"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>


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

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>copyright &copy; <script> document.write(new Date().getFullYear()); </script> - developed by
              <b><a>PBL TRPL-605 DombaKu</a></b>
            </span>
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
<script src="{{ asset('vendor/js/select2.min.js') }}"></script>


<!-- Page level plugins -->
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<!-- Page level custom scripts -->
<script>
    $(document).ready(function () {
        $('#dataTable').DataTable();
        $('#dataTableHover').DataTable();
        $('#eartag_betina').select2({
    placeholder: "Pilih hingga 20 eartag betina",
    maximumSelectionLength: 20,
    width: '100%',
});
    });
</script>


</body>

</html>