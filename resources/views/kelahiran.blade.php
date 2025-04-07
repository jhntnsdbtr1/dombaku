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
            <h1 class="h3 mb-0 text-gray-800">Manajemen Kelahiran Domba</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item">Manajemen</li>
              <li class="breadcrumb-item active" aria-current="page">Manajemen Kelahiran</li>
            </ol>
          </div>

          <div class="row">
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary w-100">Detail Kelahiran Domba</h6>
                  <button type="button" class="btn btn-sm btn-success d-flex align-items-center" data-toggle="modal" data-target="#tambahModal">
                    <i class="fas fa-plus mr-2"></i> Tambah
                  </button>
                </div>
                <div class="table-responsive p-3">
                  <table class="table table-hover text-center" id="dataTableHover">
                    <thead class="thead-light">
                      <tr>
                        <th>Eartag Induk</th>
                        <th>Eartag Jantan</th>
                        <th>Eartag Anak</th>
                        <th>Kelamin Betina</th>
                        <th>Kelamin Jantan</th>
                        <th>Tanggal Lahir</th>
                        <th>Jumlah Anak</th>
                        <th>Bobot Anak</th>
                        <th>Mortalitas</th>
                        <th>% Mortalitas</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>281</td>
                        <td>1</td>
                        <td>1</td>
                        <td></td>
                        <td>1</td>
                        <td>26-08-2024</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><a href="#" class="btn btn-sm btn-primary">Detail</a></td>
                      </tr>
                      <tr>
                        <td>725</td>
                        <td>1</td>
                        <td>2</td>
                        <td>1</td>
                        <td></td>
                        <td>20-08-2024</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><a href="#" class="btn btn-sm btn-primary">Detail</a></td>
                      </tr>
                      <tr>
                        <td>724</td>
                        <td>1</td>
                        <td>3</td>
                        <td>1</td>
                        <td></td>
                        <td>21-08-2024</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><a href="#" class="btn btn-sm btn-primary">Detail</a></td>
                      </tr>
                      <tr>
                        <td>299</td>
                        <td>1</td>
                        <td>4</td>
                        <td></td>
                        <td>1</td>
                        <td>22-08-2024</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><a href="#" class="btn btn-sm btn-primary">Detail</a></td>
                      </tr>
                      <tr>
                        <td>275</td>
                        <td>1</td>
                        <td>5</td>
                        <td></td>
                        <td>1</td>
                        <td>19-08-2024</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><a href="#" class="btn btn-sm btn-primary">Detail</a></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

          <!-- Modal Tambah Data Kelahiran -->
          <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="tambahModal">Tambah Data Kelahiran</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form id="formTambahKelahiran">
                    <div class="form-group">
                      <label for="eartagInduk">Eartag Induk</label>
                      <select class="form-control select2" id="eartagInduk" name="eartagInduk" required>
                        <option value="">Pilih Eartag Induk</option>
                        <option value="281">281</option>
                        <option value="725">725</option>
                        <option value="724">724</option>
                        <option value="299">299</option>
                        <option value="275">275</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="eartagJantan">Eartag Pejantan</label>
                      <select class="form-control select2" id="eartagJantan" name="eartagJantan" required>
                        <option value="">Pilih Eartag Pejantan</option>
                        <option value="1">1</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="eartagAnak">Eartag Anak</label>
                      <input type="text" class="form-control" id="eartagAnak" name="eartagAnak" placeholder="Masukkan Eartag Anak" required>
                    </div>
                    <div class="form-group">
                      <label>Jenis Kelamin Anak</label>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="kelaminBetina" name="kelaminBetina">
                        <label class="form-check-label" for="kelaminBetina">Betina</label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="kelaminJantan" name="kelaminJantan">
                        <label class="form-check-label" for="kelaminJantan">Jantan</label>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="tanggalLahir">Tanggal Lahir</label>
                      <input type="date" class="form-control" id="tanggalLahir" name="tanggalLahir" required>
                    </div>
                    <div class="form-group">
                      <label for="jumlahAnak">Jumlah Anak</label>
                      <input type="number" class="form-control" id="jumlahAnak" name="jumlahAnak" required>
                    </div>
                    <div class="form-group">
                      <label for="bobotAnak">Bobot Anak (kg)</label>
                      <input type="number" class="form-control" id="bobotAnak" name="bobotAnak" step="0.1" required>
                    </div>
                    <div class="form-group">
                      <label for="mortalitas">Mortalitas</label>
                      <input type="number" class="form-control" id="mortalitas" name="mortalitas" required>
                    </div>
                    <div class="form-group">
                      <label for="persentaseMortalitas">% Mortalitas</label>
                      <input type="text" class="form-control" id="persentaseMortalitas" name="persentaseMortalitas" readonly>
                    </div>
                    <div class="form-group">
                      <label for="keterangan">Keterangan</label>
                      <textarea class="form-control" id="keterangan" name="keterangan" rows="3"></textarea>
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

          <h5 class="text-primary mt-4"><b>Rekap Data</b></h5>
          <div class="table-responsive">
            <table class="table table-bordered table-striped">
              <thead class="thead-dark">
                <tr>
                  <th>Deskripsi</th>
                  <th>Total</th>
                  <th>Persentase (%)</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Jumlah Kehamilan</td>
                  <td>127</td>
                  <td>-</td>
                </tr>
                <tr>
                  <td>Anak Betina</td>
                  <td>86</td>
                  <td>43.43%</td>
                </tr>
                <tr>
                  <td>Anak Jantan</td>
                  <td>112</td>
                  <td>56.56%</td>
                </tr>
                <tr>
                  <td>Jumlah Anak</td>
                  <td>198</td>
                  <td>1.56</td>
                </tr>
                <tr>
                  <td>Total Mortalitas</td>
                  <td>27</td>
                  <td>13.64%</td>
                </tr>
                <tr>
                  <td>Jumlah Anak Hidup</td>
                  <td>171</td>
                  <td>86.36%</td>
                </tr>
                <tr>
                  <td>Anak Hidup/Kehamilan</td>
                  <td>-</td>
                  <td>1.35</td>
                </tr>
              </tbody>
            </table>
          </div>

          <!-- Modal Detail Kelahiran Domba -->
          <div class="modal fade" id="detailKelahiranModal" tabindex="-1" aria-labelledby="detailKelahiranModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="detailKelahiranModalLabel">Detail Kelahiran Domba</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <table class="table table-bordered text-center">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Eartag Induk</th>
                        <th>Eartag Jantan</th>
                        <th>Eartag Anak</th>
                        <th>Jenis Kelamin</th>
                        <th>Tanggal Lahir</th>
                        <th>Bobot Lahir</th>
                        <th>Mortalitas</th>
                        <th>Keterangan</th>
                      </tr>
                    </thead>
                    <tbody id="kelahiranTableBody">
                      <tr>
                        <td>1</td>
                        <td>281</td>
                        <td>1</td>
                        <td>001</td>
                        <td>Jantan</td>
                        <td>26-08-2024</td>
                        <td>3.5 kg</td>
                        <td>-</td>
                        <td>Sehat</td>
                      </tr>
                      <tr>
                        <td>2</td>
                        <td>725</td>
                        <td>1</td>
                        <td>002</td>
                        <td>Betina</td>
                        <td>20-08-2024</td>
                        <td>3.2 kg</td>
                        <td>-</td>
                        <td>Sehat</td>
                      </tr>
                      <tr>
                        <td>3</td>
                        <td>724</td>
                        <td>1</td>
                        <td>003</td>
                        <td>Betina</td>
                        <td>21-08-2024</td>
                        <td>3.1 kg</td>
                        <td>-</td>
                        <td>Sehat</td>
                      </tr>
                      <tr>
                        <td>4</td>
                        <td>299</td>
                        <td>1</td>
                        <td>004</td>
                        <td>Jantan</td>
                        <td>22-08-2024</td>
                        <td>3.8 kg</td>
                        <td>-</td>
                        <td>Sehat</td>
                      </tr>
                      <tr>
                        <td>5</td>
                        <td>275</td>
                        <td>1</td>
                        <td>005</td>
                        <td>Jantan</td>
                        <td>19-08-2024</td>
                        <td>3.6 kg</td>
                        <td>-</td>
                        <td>Sehat</td>
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

  <!-- Page level custom scripts -->
  <script>
    $(document).ready(function() {
      $('#dataTable').DataTable(); // ID untuk DataTable utama
      $('#dataTableHover').DataTable(); // ID untuk DataTable dengan efek hover
    });
  </script>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const detailButtons = document.querySelectorAll(".btn-primary");
      const modalBody = document.querySelector("#kelahiranTableBody");

      detailButtons.forEach((button) => {
        button.addEventListener("click", function(event) {
          event.preventDefault();
          const row = this.closest("tr");
          const eartagInduk = row.children[0].textContent;
          const eartagJantan = row.children[1].textContent;
          const eartagAnak = row.children[2].textContent;
          const kelaminBetina = row.children[3].textContent.trim();
          const kelaminJantan = row.children[4].textContent.trim();
          const tanggalLahir = row.children[5].textContent;
          const bobotAnak = row.children[7].textContent || "-";
          const mortalitas = row.children[8].textContent || "-";
          const keterangan = row.children[10].textContent || "-";

          const jenisKelamin = kelaminBetina ? "Betina" : "Jantan";

          modalBody.innerHTML = `
          <tr>
            <td>1</td>
            <td>${eartagInduk}</td>
            <td>${eartagJantan}</td>
            <td>${eartagAnak}</td>
            <td>${jenisKelamin}</td>
            <td>${tanggalLahir}</td>
            <td>${bobotAnak}</td>
            <td>${mortalitas}</td>
            <td>${keterangan}</td>
          </tr>
        `;

          $('#detailKelahiranModal').modal('show');
        });
      });
    });
  </script>

  <script>
    $(document).ready(function() {
      $('.select2').select2({
        width: '100%'
      });

      $('#mortalitas, #jumlahAnak').on('input', function() {
        let totalAnak = parseInt($('#jumlahAnak').val()) || 0;
        let jumlahMati = parseInt($('#mortalitas').val()) || 0;
        if (totalAnak > 0) {
          let persen = ((jumlahMati / totalAnak) * 100).toFixed(2);
          $('#persentaseMortalitas').val(persen + '%');
        } else {
          $('#persentaseMortalitas').val('0%');
        }
      });
    });
  </script>

</body>

</html>