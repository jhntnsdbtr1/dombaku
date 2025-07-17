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
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">


  <style>
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

    .badge-putih {
      background-color: #ffffff;
      color: black;
      border: 1px solid #000;
      /* Menambahkan border hitam */
    }

    .badge-merah {
      background-color: #ff0000;
      color: #fff;
      border: 1px solid #000;
      /* Menambahkan border hitam */
    }

    .badge-biru {
      background-color: #0000ff;
      color: #fff;
      border: 1px solid #000;
      /* Menambahkan border hitam */
    }

    .badge-hijau {
      background-color: #00ff00;
      color: black;
      border: 1px solid #000;
      /* Menambahkan border hitam */
    }

    .badge-kuning {
      background-color: #ffff00;
      color: #000;
      border: 1px solid #000;
      /* Menambahkan border hitam */
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
          <span>Beranda</span>
        </a>
      </li>

      <hr class="sidebar-divider">

      <div class="sidebar-heading">
        Fitur
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
            <li class="nav-item d-flex align-items-center mr-3">
              <div class="text-white small" id="realtime-clock">
                <i class="fas fa-clock mr-1"></i> <span id="clock"></span>
              </div>
            </li>

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
            <h1 class="h3 mb-0 text-gray-800">Manajemen Kandang Domba</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Halaman Utama</a></li>
              <li class="breadcrumb-item">Manajemen</li>
              <li class="breadcrumb-item active" aria-current="page">Manajemen Kandang</li>
            </ol>
          </div>

          <div class="row">
            <!-- DataTable with Hover -->
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary w-100">Rekap Kandang Domba</h6>
                  <button type="button" class="btn btn-sm d-flex align-items-center" style="background-color: #0F382A; color: white; border: none;" data-toggle="modal" data-target="#tambahModal">
                    <i class="fas fa-plus mr-2"></i> Tambah
                  </button>
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush table-hover text-center" id="dataTableHover">
                    <thead class="thead-light">
                      <tr>
                        <th>No</th>
                        <th>Nama Kandang</th>
                        <th>Total Domba</th>
                        <th>Kapasitas Maksimal</th>
                        <th>Status</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($kandangs as $index => $kandang)
                      <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $kandang['nama_kandang'] }}</td>
                        <td>{{ count($kandang['eartag_domba']) }}</td>
                        <td>{{ $kandang['kapasitas_maks'] }}</td>
                        <td>{{ $kandang['status'] }}</td>
                        <td>
                          <!-- Tombol Detail -->
                          <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#detailModal{{ $kandang['id'] }}">Detail</button>

                          <!-- Tombol Edit -->
                          <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal{{ $kandang['id'] }}">Edit</button>

                          <!-- Tombol Delete -->
                          <form action="{{ route('manajemenkandang.destroy', $kandang['id']) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus kandang ini?')">Delete</button>
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
                      <input type="text" class="form-control" id="namaKandang" required>
                    </div>
                    <div class="form-group">
                      <label for="kapasitasMaks">Kapasitas Maksimal</label>
                      <input type="number" class="form-control" id="kapasitasMaks" required>
                    </div>
                    <div class="form-group">
                      <label for="statusKandang">Status</label>
                      <select class="form-control" id="statusKandang">
                        <option value="Terisi">Terisi</option>
                        <option value="Penuh">Penuh</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="eartagDomba">Eartag Domba (Maks. sesuai kapasitas)</label>
                      <select class="form-control select2" id="eartagDomba" name="eartagDomba[]" multiple="multiple">
                        @foreach ($semuaEartag as $eartag)
                        <option value="{{ $eartag['eartag'] }}">
                          {{ $eartag['eartag'] }} - {{ $eartag['warna_eartag'] }}
                        </option>
                        @endforeach
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

          @foreach($kandangs as $kandang)
          <!-- Modal Edit -->
          <div class="modal fade" id="editModal{{ $kandang['id'] }}" tabindex="-1" aria-labelledby="editModalLabel{{ $kandang['id'] }}" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <form id="editForm{{ $kandang['id'] }}">
                  <div class="modal-header">
                    <h5 class="modal-title">Edit Kandang - {{ $kandang['nama_kandang'] }}</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                    <input type="hidden" id="editDocId{{ $kandang['id'] }}" value="{{ $kandang['id'] }}">

                    <div class="form-group">
                      <label>Nama Kandang</label>
                      <input type="text" class="form-control" id="editNamaKandang{{ $kandang['id'] }}" value="{{ $kandang['nama_kandang'] }}" required>
                    </div>
                    <div class="form-group">
                      <label>Kapasitas Maksimal</label>
                      <input type="number" class="form-control" id="editKapasitasMaks{{ $kandang['id'] }}" value="{{ $kandang['kapasitas_maks'] }}" required>
                    </div>
                    <div class="form-group">
                      <label>Status</label>
                      <select class="form-control" id="editStatus{{ $kandang['id'] }}">
                        <option value="Terisi" {{ $kandang['status'] == 'Terisi' ? 'selected' : '' }}>Terisi</option>
                        <option value="Penuh" {{ $kandang['status'] == 'Penuh' ? 'selected' : '' }}>Penuh</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Eartag Domba</label>
                      <select class="form-control select2" id="eartagSelect{{ $kandang['id'] }}" name="eartag_domba[]" multiple="multiple" style="width: 100%;">
                        @foreach($semuaEartag as $tag)
                        <option value="{{ $tag['eartag'] }}" {{ in_array($tag['eartag'], $kandang['eartag_domba']) ? 'selected' : '' }}>
                          {{ $tag['eartag'] }} ({{ $tag['warna_eartag'] }})
                        </option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning">Update</button>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <!-- Modal Detail Kandang -->
          <div class="modal fade" id="detailModal{{ $kandang['id'] }}" tabindex="-1" aria-labelledby="detailModalLabel{{ $kandang['id'] }}" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Detail Domba - {{ $kandang['nama_kandang'] }}</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <table class="table table-bordered text-center">
                    <thead class="thead-light">
                      <tr>
                        <th>No</th>
                        <th>Eartag</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if(isset($kandang['eartag_domba']) && is_array($kandang['eartag_domba']) && count($kandang['eartag_domba']) > 0)
                      @foreach($kandang['eartag_domba'] as $i => $eartag)
                      @php
                      // Tentukan warna berdasarkan eartag yang diambil dari dombaMap
                      $warna = 'badge-secondary';

                      // Cek jika ada informasi warna pada dombaMap
                      foreach ($dombaMap as $data) {
                      if ($data['eartag'] == $eartag) {
                      $warnaEartag = $data['warna_eartag'];
                      break;
                      }
                      }

                      // Tentukan class badge berdasarkan warna eartag
                      switch ($warnaEartag) {
                      case 'Putih': $warna = 'badge-putih'; break;
                      case 'Merah': $warna = 'badge-merah'; break;
                      case 'Biru': $warna = 'badge-biru'; break;
                      case 'Hijau': $warna = 'badge-hijau'; break;
                      case 'Kuning': $warna = 'badge-kuning'; break;
                      }
                      @endphp
                      <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>
                          <span class="badge {{ $warna }}">
                            {{ $eartag }}
                          </span>
                        </td>
                      </tr>
                      @endforeach
                      @else
                      <tr>
                        <td colspan="2">Tidak ada domba dalam kandang ini.</td>
                      </tr>
                      @endif
                    </tbody>
                  </table>
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
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vendor/js/select2.min.js') }}"></script>

    <!-- DataTables & Buttons JS -->
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>

    <script src="https://www.gstatic.com/firebasejs/9.22.1/firebase-app-compat.js"></script>
    <script src="https://www.gstatic.com/firebasejs/9.22.1/firebase-firestore-compat.js"></script>
    <script src="{{ asset('js/firebase-init.js') }}"></script>

    <script>
      const namaPeternak = <?php echo json_encode(session('nama_peternak') ?? ''); ?>;
    </script>

    <script type="text/javascript">
      $(document).ready(function() {
        // ✅ Fungsi reload tabel
        function reloadKandangTable() {
          if ($.fn.DataTable.isDataTable('#dataTable')) {
            $('#dataTable').DataTable().ajax.reload(null, false); // jika pakai AJAX
          } else {
            location.reload(); // jika datatable biasa
          }
        }
        $('#dataTableHover').DataTable({
          dom: 'Bfrtip',
          buttons: [{
              extend: 'csvHtml5',
              text: 'CSV', // Nama tombol untuk ekspor CSV
              exportOptions: {
                // Pilih kolom yang ingin di-export
                columns: [1, 2, 3, 4] // Kolom Nama Kandang, Jumlah Domba, Kapasitas Maksimal, Status
              },
              // Atur nama file CSV yang akan di-download
              filename: 'data_kandang',
              // Ganti delimiter jika diperlukan
              fieldSeparator: ','
            },
            {
              extend: 'excelHtml5',
              exportOptions: {
                columns: [1, 2, 3, 4] // Kolom Nama Kandang, Jumlah Domba, Kapasitas Maksimal, Status
              }
            },
            {
              extend: 'pdfHtml5',
              orientation: 'landscape',
              pageSize: 'A4',
              title: 'Data Kandang Domba',
              exportOptions: {
                columns: [1, 2, 3, 4] // Kolom Nama Kandang, Jumlah Domba, Kapasitas Maksimal, Status
              }
            },
            {
              extend: 'print',
              orientation: 'landscape',
              title: 'Data Kandang Domba',
              exportOptions: {
                columns: [1, 2, 3, 4] // Kolom Nama Kandang, Jumlah Domba, Kapasitas Maksimal, Status
              }
            }
          ]
        });

        // ✅ Ambil data domba dari Firestore yang belum punya kandang

        firebase.firestore().collection("manajemendomba").get()
          .then((querySnapshot) => {
            $('#eartagDomba').empty();

            querySnapshot.forEach((doc) => {
              const data = doc.data();
              const tidakPunyaKandang = !data.kandang || data.kandang === "";

              if (tidakPunyaKandang) {
                // ⛔ Salah: option pakai value = data.eartag
                // const option = new Option(data.eartag, data.eartag, false, false);

                // ✅ Benar: value = doc.id (Firestore doc ID), label = eartag
                const label = `${data.eartag} - ${data.warna_eartag || 'Tanpa Warna'}`;
                const option = new Option(label, doc.id, false, false);

                $('#eartagDomba').append(option);
              }
            });

            // Inisialisasi Select2
            $('#eartagDomba').select2({
              placeholder: "Pilih Eartag Domba",
              maximumSelectionLength: 20,
              width: '100%',
              dropdownParent: $('#tambahModal')
            });
          })

          .catch((error) => {
            console.error("Error mengambil data domba:", error);
          });

        // ✅ Inisialisasi Select2 di dalam Modal Edit
        $('[id^="editModal"]').on('shown.bs.modal', function() {
          const modalId = $(this).attr('id');
          const selectId = '#eartagSelect' + modalId.replace('editModal', '');
          $(selectId).select2({
            dropdownParent: $('#' + modalId),
            width: '100%',
            placeholder: "Pilih Eartag Domba"
          });
        });

        // ✅ Submit Tambah ke Firebase
        $('#formTambah').submit(function(e) {
          e.preventDefault();

          const namaKandang = $('#namaKandang').val();
          const kapasitasMaks = parseInt($('#kapasitasMaks').val());
          const status = $('#statusKandang').val();
          const selectedEartags = $('#eartagDomba').val(); // array of Firestore doc IDs

          // 1. Query untuk ambil eartag berdasarkan doc IDs
          const db = firebase.firestore();
          const batch = db.batch(); // Membuat batch operation

          // Ambil semua eartag berdasarkan selectedEartags
          const eartagPromises = selectedEartags.map(docId => {
            return db.collection("manajemendomba").doc(docId).get()
              .then(doc => {
                if (doc.exists) {
                  const eartag = doc.data().eartag; // Ambil eartag dari dokumen domba

                  // Menambahkan eartag ke array (jika belum ada)
                  return eartag;
                }
              })
              .catch(error => {
                console.error("Error fetching eartag for docId " + docId, error);
              });
          });

          // Tunggu semua promise selesai
          Promise.all(eartagPromises)
            .then((eartags) => {
              // Membuat dokumen kandang baru atau update dokumen yang sudah ada
              const kandangRef = db.collection("manajemenkandang").doc(); // Membuat dokumen baru untuk kandang

              // Menambahkan eartag ke dalam array eartag_domba di dokumen kandang
              batch.set(kandangRef, {
                nama_kandang: namaKandang,
                kapasitas_maks: kapasitasMaks,
                status: status,
                eartag_domba: firebase.firestore.FieldValue.arrayUnion(...eartags), // Menambahkan semua eartag ke array
                nama_peternak: namaPeternak // ✅ TAMBAHKAN INI
              });

              // Update domba dengan kandang yang baru
              selectedEartags.forEach(docId => {
                const dombaRef = db.collection("manajemendomba").doc(docId);
                batch.update(dombaRef, {
                  kandang: namaKandang
                });
              });

              // Commit batch setelah semua update selesai
              return batch.commit();
            })
            .then(() => {
              alert("✅ Kandang berhasil ditambahkan dan domba di-update!");
              $('#tambahModal').modal('hide');
              $('#formTambah')[0].reset();
              $('#eartagDomba').val(null).trigger('change');
              reloadKandangTable(); // Refresh DataTable setelah tambah
            })
            .catch((error) => {
              console.error("❌ Error saat simpan kandang:", error);
              alert("Gagal menyimpan kandang.");
            });
        });
      });

      // Cek versi jQuery (debugging)
      console.log("jQuery version:", $.fn.jquery);
    </script>
    <script>
      $(document).ready(function() {
        // Inisialisasi semua Select2 untuk edit modal
        $('[id^="editModal"]').on('shown.bs.modal', function() {
          const modalId = $(this).attr('id').replace('editModal', '');
          $('#eartagSelect' + modalId).select2({
            dropdownParent: $('#editModal' + modalId),
            width: '100%',
            placeholder: "Pilih Eartag Domba"
          });
        });

        // Event submit semua form edit
        $('[id^="editForm"]').on('submit', function(e) {
          e.preventDefault();

          const formId = $(this).attr('id').replace('editForm', '');
          const kandangId = $('#editDocId' + formId).val();
          const namaKandang = $('#editNamaKandang' + formId).val();
          const kapasitasMaks = parseInt($('#editKapasitasMaks' + formId).val());
          const status = $('#editStatus' + formId).val();
          const selectedEartags = $('#eartagSelect' + formId).val() || [];

          const db = firebase.firestore();
          const kandangRef = db.collection('manajemenkandang').doc(kandangId);

          kandangRef.get().then((doc) => {
            if (!doc.exists) {
              alert("Kandang tidak ditemukan.");
              return;
            }

            const oldData = doc.data();
            const oldEartags = oldData.eartag_domba || [];

            const batch = db.batch();

            // Hapus eartag yang tidak dipilih lagi (reset kandang jadi kosong)
            const removed = oldEartags.filter(e => !selectedEartags.includes(e));
            removed.forEach(docId => {
              const dombaRef = db.collection("manajemendomba").doc(docId);
              batch.update(dombaRef, {
                kandang: ""
              });
            });

            // Tambah eartag baru yang belum punya kandang
            const added = selectedEartags.filter(e => !oldEartags.includes(e));
            added.forEach(docId => {
              const dombaRef = db.collection("manajemendomba").doc(docId);
              batch.update(dombaRef, {
                kandang: namaKandang
              });
            });

            // Update kandang
            batch.update(kandangRef, {
              nama_kandang: namaKandang,
              kapasitas_maks: kapasitasMaks,
              status: status,
              eartag_domba: selectedEartags
            });

            return batch.commit();
          }).then(() => {
            alert("✅ Kandang berhasil diupdate!");
            $('#editModal' + formId).modal('hide');
            reloadKandangTable(); // Fungsi custom kamu
          }).catch((error) => {
            console.error("❌ Error saat update kandang:", error);
            alert("Terjadi kesalahan saat menyimpan perubahan.");
          });
        });
      });
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

    <script>
      function updateClock() {
        const now = new Date();
        const day = String(now.getDate()).padStart(2, '0');
        const month = now.toLocaleString('id-ID', {
          month: 'long'
        });
        const year = now.getFullYear();
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');

        const fullDateTime = `${day}  ${month}  ${year}, ${hours} : ${minutes} : ${seconds}`;
        document.getElementById('clock').textContent = fullDateTime;
      }

      setInterval(updateClock, 1000);
      updateClock();
    </script>

</body>

</html>