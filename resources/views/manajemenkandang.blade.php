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
    .table {
      margin-right: 20px;
      /* Tambah jarak kanan */
      border-spacing: 10px;
      /* Beri ruang antar sel */
    }

    .table th,
    .table td {
      padding: 12px 15px;
      /* Buat lebih luas */
    }

    .badge-success {
      background-color: #28a745;
      color: white;
    }

    .badge-warning {
      background-color: #ffc107;
      color: black;
    }

    .badge-danger {
      background-color: #dc3545;
      color: white;
    }
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
                </span> </a>
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
            <h1 class="h3 mb-0 text-gray-800">Manajemen Kandang Domba</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item">Manajemen</li>
              <li class="breadcrumb-item active" aria-current="page">Manajemen Kandang</li>
            </ol>
          </div>

          <div class="row">
            <!-- DataTable with Hover -->
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary w-100">Detail Kandang Domba</h6>
                  <button type="button" class="btn btn-sm btn-success d-flex align-items-center" data-toggle="modal" data-target="#tambahModal">
                    <i class="fas fa-plus mr-2"></i> Tambah
                  </button>
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush table-hover text-center" id="dataTableHover">
                    <thead class="thead-light">
                      <tr>
                        <th>Nama Kandang</th>
                        <th>Total Domba</th>
                        <th>Kapasitas Maksimal</th>
                        <th>Status</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Koloni 1</td>
                        <td>20</td>
                        <td>30</td>
                        <td><span class="badge badge-success">Tersedia</span></td>
                        <td><button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#detailKandang1">Detail</button></td>
                      </tr>
                      <tr>
                        <td>Koloni 2</td>
                        <td>21</td>
                        <td>30</td>
                        <td><span class="badge badge-warning">Hampir Penuh</span></td>
                        <td><button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#detailKandang2">Detail</button></td>
                      </tr>
                      <tr>
                        <td>Koloni 3</td>
                        <td>28</td>
                        <td>30</td>
                        <td><span class="badge badge-danger">Penuh</span></td>
                        <td><button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#detailKandang3">Detail</button></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

          <!-- Modal Tambah Data -->
          <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="tambahModalLabel">Tambah Kandang Domba</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form id="formTambah">
                    <div class="form-group">
                      <label for="namaKandang">Nama Kandang</label>
                      <select class="form-control" id="namaKandang" required>
                        <option value="Koloni 1">Koloni 1</option>
                        <option value="Koloni 2">Koloni 2</option>
                        <option value="Koloni 3">Koloni 3</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="kapasitasMaks">Kapasitas Maksimal</label>
                      <input type="number" class="form-control" id="kapasitasMaks" required>
                    </div>
                    <div class="form-group">
                      <label for="statusKandang">Status</label>
                      <select class="form-control" id="statusKandang">
                        <option value="Tersedia">Tersedia</option>
                        <option value="Hampir Penuh">Hampir Penuh</option>
                        <option value="Penuh">Penuh</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="eartagDomba">Eartag Domba (Maks. sesuai kapasitas)</label>
                      <select class="form-control select2" id="eartagDomba" name="eartagDomba[]" multiple="multiple">
                        <option value="DMB-001">DMB-001</option>
                        <option value="DMB-002">DMB-002</option>
                        <option value="DMB-003">DMB-003</option>
                        <option value="DMB-004">DMB-004</option>
                        <option value="DMB-005">DMB-005</option>
                        <option value="DMB-006">DMB-006</option>
                        <option value="DMB-007">DMB-007</option>
                        <option value="DMB-008">DMB-008</option>
                        <option value="DMB-009">DMB-009</option>
                        <option value="DMB-010">DMB-010</option>
                      </select>
                    </div>
                    <div class="d-flex justify-content-end">
                      <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal">Batal</button>
                      <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>

          <!-- Modal Detail Kandang -->
          <div class="modal fade" id="detailKandang1" tabindex="-1" aria-labelledby="detailKandangLabel1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="detailKandangLabel1">Detail Domba di Koloni 1</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <table class="table table-bordered text-center">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Eartag</th>
                        <th>Jenis Kelamin</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>1</td>
                        <td>D001</td>
                        <td>Betina</td>
                      </tr>
                      <tr>
                        <td>2</td>
                        <td>D002</td>
                        <td>Betina</td>
                      </tr>
                      <tr>
                        <td>3</td>
                        <td>D003</td>
                        <td>Betina</td>
                      </tr>
                      <tr>
                        <td>4</td>
                        <td>D004</td>
                        <td>Betina</td>
                      </tr>
                      <tr>
                        <td>5</td>
                        <td>D005</td>
                        <td>Betina</td>
                      </tr>
                      <tr>
                        <td>6</td>
                        <td>D006</td>
                        <td>Betina</td>
                      </tr>
                      <tr>
                        <td>7</td>
                        <td>D007</td>
                        <td>Betina</td>
                      </tr>
                      <tr>
                        <td>8</td>
                        <td>D008</td>
                        <td>Betina</td>
                      </tr>
                      <tr>
                        <td>9</td>
                        <td>D009</td>
                        <td>Betina</td>
                      </tr>
                      <tr>
                        <td>10</td>
                        <td>D010</td>
                        <td>Betina</td>
                      </tr>
                      <tr>
                        <td>11</td>
                        <td>D011</td>
                        <td>Betina</td>
                      </tr>
                      <tr>
                        <td>12</td>
                        <td>D012</td>
                        <td>Betina</td>
                      </tr>
                      <tr>
                        <td>13</td>
                        <td>D013</td>
                        <td>Betina</td>
                      </tr>
                      <tr>
                        <td>14</td>
                        <td>D014</td>
                        <td>Betina</td>
                      </tr>
                      <tr>
                        <td>15</td>
                        <td>D015</td>
                        <td>Betina</td>
                      </tr>
                      <tr>
                        <td>16</td>
                        <td>D016</td>
                        <td>Betina</td>
                      </tr>
                      <tr>
                        <td>17</td>
                        <td>D017</td>
                        <td>Betina</td>
                      </tr>
                      <tr>
                        <td>18</td>
                        <td>D018</td>
                        <td>Betina</td>
                      </tr>
                      <tr>
                        <td>19</td>
                        <td>D019</td>
                        <td>Betina</td>
                      </tr>
                      <tr>
                        <td>20</td>
                        <td>D020</td>
                        <td>Betina</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

          <!-- Modal Logout -->
          <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout" aria-hidden="true">
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
                  <a href="{{ route('logout') }}" class="btn btn-primary">Logout</a>
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
            <span>copyright &copy; <script>
                document.write(new Date().getFullYear());
              </script> - developed by
              <b><a>PBL TRPL-605 DombaKu</a></b>
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
  <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('vendor/js/select2.min.js') }}"></script>

  <script>
    $(document).ready(function() {
      $('#dataTable').DataTable();
      $('#dataTableHover').DataTable();
      $('#eartagDomba').select2({
        placeholder: "Pilih hingga 20 Eartag Domba",
        maximumSelectionLength: 20,
        width: '100%',
      });
    });
  </script>
  <script>
    console.log("jQuery version:", $.fn.jquery);
  </script>
</body>

</html>