<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <link href="{{ asset('img/logo/domba.png') }}" rel="icon">
  <title>@yield('title', 'Manajemen Perkawinan Domba')</title>

  <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('css/ruang-admin.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/css/select2.min.css') }}" rel="stylesheet">


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
            <h1 class="h3 mb-0 text-gray-800">Manajemen Perkawinan Domba</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item">Tables</li>
              <li class="breadcrumb-item active" aria-current="page">Manajemen Perkawinan Domba</li>
            </ol>
          </div>

          <div class="row">
            <!-- DataTable with Hover -->
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary w-100">Detail Perkawinan Domba</h6>
                  <button type="button" class="btn btn-sm btn-success d-flex align-items-center" data-toggle="modal" data-target="#tambahModal">
                    <i class="fas fa-plus mr-2"></i> Tambah
                  </button>
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush table-hover text-center" id="dataTableHover">
                    <thead class="thead-light">
                      <tr>
                        <th>ID</th>
                        <th>Eartag Pejantan</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th>Kandang</th>
                        <th>Jumlah Betina</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>1</td>
                        <td>DM001</td>
                        <td>14-11-2024</td>
                        <td>14-01-2025</td>
                        <td>Koloni Baru</td>
                        <td>20</td>
                        <td><button class="btn btn-sm btn-primary detail-btn" data-toggle="modal" data-target="#detailModal">Detail</button></td>
                      </tr>
                      <tr>
                        <td>2</td>
                        <td>DM002</td>
                        <td>05-03-2024</td>
                        <td>05-05-2024</td>
                        <td>Semi Umbaran</td>
                        <td>20</td>
                        <td><button class="btn btn-sm btn-primary detail-btn" data-toggle="modal" data-target="#detailModal">Detail</button></td>
                      </tr>
                      <tr>
                        <td>3</td>
                        <td>DM003</td>
                        <td>10-03-2024</td>
                        <td>10-05-2024</td>
                        <td>Koloni 1</td>
                        <td>20</td>
                        <td><button class="btn btn-sm btn-primary detail-btn" data-toggle="modal" data-target="#detailModal">Detail</button></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Modal Tambah Data -->
        <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="tambahModalLabel">Tambah Perkawinan Domba</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form id="formTambah">
                  <div class="form-group">
                    <label for="eartagPejantan">Eartag Pejantan</label>
                    <input type="text" class="form-control" id="eartagPejantan" required>
                  </div>
                  <div class="form-group">
                    <label for="tanggalMulai">Tanggal Mulai</label>
                    <input type="date" class="form-control" id="tanggalMulai" required>
                  </div>
                  <div class="form-group">
                    <label for="tanggalSelesai">Tanggal Selesai</label>
                    <input type="date" class="form-control" id="tanggalSelesai" required>
                  </div>
                  <div class="form-group">
                    <label for="kandang">Kandang</label>
                    <input type="text" class="form-control" id="kandang" required>
                  </div>
                  <!-- Eartag Betina (Max 20) -->
                  <div class="form-group">
                    <label for="eartag_betina">Eartag Betina (Maks. 20)</label>
                    <select class="form-control select2" id="eartag_betina" name="eartag_betina[]" multiple="multiple">
                      <option value="BETINA-001">BETINA-001</option>
                      <option value="BETINA-002">BETINA-002</option>
                      <option value="BETINA-003">BETINA-003</option>
                      <option value="BETINA-004">BETINA-004</option>
                      <option value="BETINA-005">BETINA-005</option>
                      <option value="BETINA-006">BETINA-006</option>
                      <option value="BETINA-007">BETINA-007</option>
                      <option value="BETINA-008">BETINA-008</option>
                      <option value="BETINA-009">BETINA-009</option>
                      <option value="BETINA-010">BETINA-010</option>
                      <option value="BETINA-011">BETINA-011</option>
                      <option value="BETINA-012">BETINA-012</option>
                      <option value="BETINA-013">BETINA-013</option>
                      <option value="BETINA-014">BETINA-014</option>
                      <option value="BETINA-015">BETINA-015</option>
                      <option value="BETINA-016">BETINA-016</option>
                      <option value="BETINA-017">BETINA-017</option>
                      <option value="BETINA-018">BETINA-018</option>
                      <option value="BETINA-019">BETINA-019</option>
                      <option value="BETINA-020">BETINA-020</option>
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

        <!-- Modal Detail Betina -->
        <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Detail 20 Betina dan % Kehamilan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <table class="table table-bordered text-center">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Eartag Betina</th>
                      <th>Persentase Kehamilan</th>
                    </tr>
                  </thead>
                  <tbody id="betinaTableBody">
                    <tr>
                      <td>1</td>
                      <td>BT001</td>
                      <td>75%</td>
                    </tr>
                    <tr>
                      <td>2</td>
                      <td>BT002</td>
                      <td>80%</td>
                    </tr>
                    <tr>
                      <td>3</td>
                      <td>BT003</td>
                      <td>65%</td>
                    </tr>
                    <tr>
                      <td>4</td>
                      <td>BT004</td>
                      <td>85%</td>
                    </tr>
                    <tr>
                      <td>5</td>
                      <td>BT005</td>
                      <td>90%</td>
                    </tr>
                    <tr>
                      <td>6</td>
                      <td>BT006</td>
                      <td>70%</td>
                    </tr>
                    <tr>
                      <td>7</td>
                      <td>BT007</td>
                      <td>95%</td>
                    </tr>
                    <tr>
                      <td>8</td>
                      <td>BT008</td>
                      <td>60%</td>
                    </tr>
                    <tr>
                      <td>9</td>
                      <td>BT009</td>
                      <td>88%</td>
                    </tr>
                    <tr>
                      <td>10</td>
                      <td>BT010</td>
                      <td>92%</td>
                    </tr>
                    <tr>
                      <td>11</td>
                      <td>BT011</td>
                      <td>78%</td>
                    </tr>
                    <tr>
                      <td>12</td>
                      <td>BT012</td>
                      <td>85%</td>
                    </tr>
                    <tr>
                      <td>13</td>
                      <td>BT013</td>
                      <td>80%</td>
                    </tr>
                    <tr>
                      <td>14</td>
                      <td>BT014</td>
                      <td>70%</td>
                    </tr>
                    <tr>
                      <td>15</td>
                      <td>BT015</td>
                      <td>89%</td>
                    </tr>
                    <tr>
                      <td>16</td>
                      <td>BT016</td>
                      <td>77%</td>
                    </tr>
                    <tr>
                      <td>17</td>
                      <td>BT017</td>
                      <td>91%</td>
                    </tr>
                    <tr>
                      <td>18</td>
                      <td>BT018</td>
                      <td>68%</td>
                    </tr>
                    <tr>
                      <td>19</td>
                      <td>BT019</td>
                      <td>73%</td>
                    </tr>
                    <tr>
                      <td>20</td>
                      <td>BT020</td>
                      <td>87%</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
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

  <!-- Load jQuery (Pastikan ini hanya ada 1x) -->
  <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>

  <!-- Load Bootstrap -->
  <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  <!-- Load DataTables -->
  <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

  <script src="{{ asset('vendor/js/select2.min.js') }}"></script>


  <script>
    $(document).ready(function() {
      $('#dataTable').DataTable();
      $('#dataTableHover').DataTable();
      $('#eartag_betina').select2({
        placeholder: "Pilih hingga 20 eartag betina",
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