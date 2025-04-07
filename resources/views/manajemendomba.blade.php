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
      gap: 10px;
      /* Jarak antar elemen */
      margin-bottom: 2px;
      /* Jarak dari elemen di bawah */
      padding: 20px;
      /* Tambahkan padding */
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

    .putih {
      background-color: white;
      border: 1px solid black;
    }

    .merah {
      background-color: red;
      border: 1px solid black;
    }

    .biru {
      background-color: blue;
      border: 1px solid black;
    }

    .hijau {
      background-color: green;
      border: 1px solid black;
    }

    .kuning {
      background-color: yellow;
      border: 1px solid black;
    }

    .table {
      width: 100%;
      table-layout: auto;
      /* Agar lebar tabel menyesuaikan isi */
      font-size: 12px;
      /* Ukuran font lebih kecil supaya lebih muat */
      border-collapse: collapse;
    }

    .table th,
    .table td {
      padding: 8px;
      text-align: center;
      white-space: nowrap;
      /* Agar header tetap dalam satu baris */
      overflow: hidden;
      text-overflow: ellipsis;
      /* Jika terlalu panjang, tampilkan '...' */
    }

    .table th {
      background-color: #f8f9fa;
      /* Warna header lebih jelas */
      font-size: 12px;
    }

    .table td {
      font-size: 12px;
    }

    /* Atur ukuran tombol supaya tetap kecil */
    .btn {
      padding: 4px 8px;
      font-size: 12px;
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
                    .eartag-putih {
                      background-color: white;
                      color: black;
                      font-weight: bold;
                    }

                    .eartag-merah {
                      background-color: red;
                      color: white;
                      font-weight: bold;
                    }

                    .eartag-biru {
                      background-color: blue;
                      color: white;
                      font-weight: bold;
                    }

                    .eartag-hijau {
                      background-color: green;
                      color: white;
                      font-weight: bold;
                    }

                    .eartag-kuning {
                      background-color: yellow;
                      color: black;
                      font-weight: bold;
                    }
                  </style>

                  <table class="table align-items-center table-flush table-hover text-center" id="dataTableHover">
                    <thead class="thead-light">
                      <tr>
                        <th>No</th>
                        <th>EARTAG</th>
                        <th>Kelamin</th>
                        <th>Tanggal Lahir</th>
                        <th>Umur</th> <!-- Kolom Umur -->
                        <th>Induk Betina</th>
                        <th>Induk Jantan</th>
                        <th>Bobot Badan (kg)</th>
                        <th>Kandang</th>
                        <th>Keterangan</th>
                        <th>Kesehatan</th>
                        <th>Dokumentasi</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($dombaData as $index => $domba)
                      <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $domba['eartag'] }}</td>
                        <td>{{ $domba['kelamin'] }}</td>
                        <td>{{ $domba['tanggal_lahir'] }}</td>
                        <td>{{ $domba['umur'] }}</td> <!-- Menampilkan umur dalam format Tahun, Bulan, Hari -->
                        <td>{{ $domba['induk_betina'] }}</td>
                        <td>{{ $domba['induk_jantan'] }}</td>
                        <td>{{ $domba['bobot_badan'] }}</td>
                        <td>{{ $domba['kandang'] }}</td>
                        <td>{{ $domba['keterangan'] }}</td>
                        <td><span class="badge bg-info">{{ $domba['kesehatan'] }}</span></td>
                        <td>
                          <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#modalLihat{{ $domba['id'] }}">
                            Lihat
                          </button>
                        </td>
                        <td>
                          <a href="{{ route('manajemendomba.show', $domba['id']) }}" class="btn btn-sm btn-primary">Detail</a>

                          <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editModal{{ $domba['id'] }}" data-id="{{ $domba['id'] }}">Edit</button>

                          <form action="{{ route('manajemendomba.destroy', $domba['id']) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                          </form>
                        </td>
                      </tr>
                      @endforeach
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
                  <form id="formTambah" enctype="multipart/form-data" method="POST" action="{{ route('manajemendomba.store') }}">
                    @csrf
                    <div class="form-group">
                      <label for="eartag">EARTAG</label>
                      <input type="text" class="form-control" id="eartag" name="eartag" required>
                    </div>
                    <div class="form-group">
                      <label for="kelamin">Kelamin</label>
                      <select class="form-control" id="kelamin" name="kelamin" required>
                        <option value="Jantan">Jantan</option>
                        <option value="Betina">Betina</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="tanggal_lahir">Tanggal Lahir</label>
                      <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
                    </div>
                    <div class="form-group">
                      <label for="induk_betina">Induk Betina</label>
                      <input type="text" class="form-control" id="induk_betina" name="induk_betina">
                    </div>
                    <div class="form-group">
                      <label for="induk_jantan">Induk Jantan</label>
                      <input type="text" class="form-control" id="induk_jantan" name="induk_jantan">
                    </div>
                    <div class="form-group">
                      <label for="bobot_badan">Bobot Badan (kg)</label>
                      <input type="number" class="form-control" id="bobot_badan" name="bobot_badan" step="0.1" required>
                    </div>
                    <div class="form-group">
                      <label for="kandang">Kandang</label>
                      <input type="text" class="form-control" id="kandang" name="kandang" required>
                    </div>
                    <div class="form-group">
                      <label for="keterangan">Keterangan</label>
                      <textarea class="form-control" id="keterangan" name="keterangan"></textarea>
                    </div>
                    <div class="form-group">
                      <label for="kesehatan">Kesehatan</label>
                      <textarea class="form-control" id="kesehatan" name="kesehatan"></textarea>
                    </div>

                    <!-- Input Upload Dokumentasi -->
                    <div class="form-group">
                      <label for="dokumentasi">Upload Dokumentasi (JPG, PNG, PDF)</label>
                      <input type="file" class="form-control-file" id="dokumentasi" name="dokumentasi" accept=".jpg, .jpeg, .png, .pdf" required>
                      <small class="form-text text-muted">Maksimum 2MB</small>
                      <div id="previewDokumentasi" class="mt-2"></div>
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

          @foreach($dombaData as $domba)
          <!-- Modal Edit -->
          <div class="modal fade" id="editModal{{ $domba['id'] }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="editModalLabel">Edit Data Domba</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form class="edit-domba-form">
                    @csrf
                    <input type="hidden" name="_method" value="PATCH">
                    <div class="form-group">
                      <label for="eartag">EARTAG</label>
                      <input type="text" class="form-control" name="eartag" value="{{ $domba['eartag'] }}" required>
                    </div>

                    <div class="form-group">
                      <label for="kelamin">Kelamin</label>
                      <select class="form-control" name="kelamin" required>
                        <option value="Jantan" {{ $domba['kelamin'] == 'Jantan' ? 'selected' : '' }}>Jantan</option>
                        <option value="Betina" {{ $domba['kelamin'] == 'Betina' ? 'selected' : '' }}>Betina</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="tanggal_lahir">Tanggal Lahir</label>
                      <input type="date" class="form-control" name="tanggal_lahir" value="{{ $domba['tanggal_lahir'] }}" required>
                    </div>

                    <div class="form-group">
                      <label for="bobot_badan">Bobot Badan (kg)</label>
                      <input type="number" class="form-control" name="bobot_badan" step="0.1" value="{{ $domba['bobot_badan'] }}" required>
                    </div>

                    <div class="form-group">
                      <label for="kandang">Kandang</label>
                      <input type="text" class="form-control" name="kandang" value="{{ $domba['kandang'] }}" required>
                    </div>

                    <div class="form-group">
                      <label for="keterangan">Keterangan</label>
                      <textarea class="form-control" name="keterangan">{{ $domba['keterangan'] }}</textarea>
                    </div>

                    <div class="form-group">
                      <label for="kesehatan">Kesehatan</label>
                      <textarea class="form-control" name="kesehatan">{{ $domba['kesehatan'] }}</textarea>
                    </div>

                    <div class="form-group">
                      <label for="foto">Dokumentasi (Foto)</label>
                      <input type="file" class="form-control" name="foto">
                    </div>


                    <div class="form-group">
                      <label for="deskripsi">Deskripsi Perubahan</label>
                      <textarea class="form-control" name="deskripsi" placeholder="Contoh: Pindah kandang karena domba sakit, atau update bobot setelah penimbangan."></textarea>
                    </div>

                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary">Update</button>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          @endforeach

          @foreach($dombaData as $domba)
          <div class="modal fade" id="modalLihat{{ $domba['id'] }}" tabindex="-1" role="dialog" aria-labelledby="modalLihatLabel{{ $domba['id'] }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="modalLihatLabel{{ $domba['id'] }}">
                    Dokumentasi Domba - Eartag: {{ $domba['eartag'] }}
                  </h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body text-center">
                  <img src="{{ asset('storage/' . $domba['foto']) }}"
                    alt="Dokumentasi Domba"
                    class="img-fluid rounded"
                    style="max-width: 100%; height: auto;">
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
              </div>
            </div>
          </div>
          @endforeach

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
  <script src="{{ asset('vendor/js/select2.min.js') }}"></script>


  <!-- Page level plugins -->
  <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

  <!-- Page level custom scripts -->
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
    $('button[data-toggle="modal"]').on('click', function() {
      var id = $(this).data('id');
      console.log('ID yang diteruskan ke URL:', id);

      var modal = $('#editModal' + id);
      modal.modal('show');

      // Hapus event listener lama agar tidak terduplikasi
      modal.find('form').off('submit').on('submit', function(e) {
        e.preventDefault();

        var form = $(this);
        var formData = form.serialize(); // kirim sebagai x-www-form-urlencoded

        console.log('Data yang akan dikirim:', formData);

        $.ajax({
          url: '/manajemendomba/update/' + id,
          type: 'POST',
          data: formData,
          success: function(response) {
            console.log('[AJAX] Success:', response);
            window.location.reload();
          },
          error: function(xhr) {
            console.error('[AJAX] Error:', xhr);
            alert('Gagal memperbarui data domba.');
          }
        });
      });
    });
  </script>


</body>

</html>