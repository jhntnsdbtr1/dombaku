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
  <title>@yield('title', 'Manajemen Perkawinan Domba')</title>

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
            <h1 class="h3 mb-0 text-gray-800">Manajemen Perkawinan Domba</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Halaman Utama</a></li>
              <li class="breadcrumb-item">Perkawinan</li>
              <li class="breadcrumb-item active" aria-current="page">Manajemen Perkawinan Domba</li>
            </ol>
          </div>

          <div class="row">
            <!-- DataTable with Hover -->
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary w-100">Detail Perkawinan Domba</h6>
                  <button type="button" class="btn btn-sm d-flex align-items-center" style="background-color: #0F382A; color: white; border: none;" data-toggle="modal" data-target="#tambahModal">
                    <i class="fas fa-plus mr-2"></i> Tambah
                  </button>
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush table-hover text-center" id="dataTableHover">
                    <thead class="thead-light">
                      <tr>
                        <th>No</th>
                        <th>Eartag Pejantan</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th>Kandang</th>
                        <th>Jumlah Betina</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($perkawinan as $index => $item)
                      <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                          <span class="badge 
                            @if($item['warna_eartag'] == 'Putih') badge-putih
                            @elseif($item['warna_eartag'] == 'Merah') badge-merah
                            @elseif($item['warna_eartag'] == 'Biru') badge-biru
                            @elseif($item['warna_eartag'] == 'Hijau') badge-hijau
                            @elseif($item['warna_eartag'] == 'Kuning') badge-kuning
                            @else badge-secondary @endif">
                            {{ $item['eartag_pejantan'] }}
                          </span>
                        </td>
                        <td>{{ $item['tanggal_mulai'] }}</td>
                        <td>{{ $item['tanggal_selesai'] }}</td>
                        <td>{{ $item['kandang'] }}</td>
                        <td>{{ count($item['betina']) }}</td>
                        <td>
                          <!-- Tombol Detail -->
                          <button
                            class="btn btn-sm btn-info"
                            data-id="{{ $item['id'] }}"
                            onclick="tampilkanDetailBetina(this)">
                            Detail
                          </button>

                          <!-- Tombol Edit -->
                          <button class="btn btn-sm btn-warning" data-id="{{ $item['id'] }}" onclick="openEditModal(this)">
                            Edit
                          </button>

                          <!-- Tombol Hapus -->
                          <form action="{{ route('perkawinan.destroy', $item['id']) }}"
                            method="POST"
                            style="display:inline-block;"
                            onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                              Hapus
                            </button>
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
                <form id="formTambah" action="{{ route('perkawinan.store') }}" method="POST">
                  @csrf

                  <div class="form-group mb-3">
                    <label for="eartagPejantan">Eartag Pejantan</label>
                    <select class="form-control select2" name="eartag_pejantan" id="eartagPejantan" required>
                      <option value="">-- Pilih Eartag Jantan --</option>
                      @foreach($eartagJantan as $jantan)
                      <option value="{{ $jantan['eartag'] }}">
                        {{ $jantan['eartag'] }} - {{ $jantan['warna'] }}
                      </option>
                      @endforeach
                    </select>
                  </div>

                  <div class="form-group mb-3">
                    <label for="tanggalMulai">Tanggal Mulai</label>
                    <input type="date" class="form-control" name="tanggal_mulai" id="tanggalMulai" required>
                  </div>

                  <div class="form-group mb-3">
                    <label for="tanggalSelesai">Tanggal Selesai</label>
                    <input type="date" class="form-control" name="tanggal_selesai" id="tanggalSelesai" required>
                  </div>

                  <div class="form-group mb-3">
                    <label for="kandang">Kandang</label>
                    <input type="text" class="form-control" name="kandang" id="kandang" required>
                  </div>

                  <div class="form-group mb-3">
                    <label for="eartag_betina">Pilih Eartag Betina (maksimal 20)</label>
                    <select class="form-control select2" name="eartag_betina[]" id="eartag_betina" multiple="multiple" required>
                      @foreach($eartagBetina as $betina)
                      <option value="{{ $betina['eartag'] }}">
                        {{ $betina['eartag'] }} - {{ $betina['warna'] }}
                      </option>
                      @endforeach
                    </select>
                  </div>

                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
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
                <h5 class="modal-title" id="detailModalLabel">Detail Betina</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
              </div>
              <div class="modal-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Eartag</th>
                      <th>Persentase Kehamilan</th>
                    </tr>
                  </thead>
                  <tbody id="betinaTableBody">
                    <!-- Data akan ditampilkan di sini -->
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

        <!-- Modal Edit Perkawinan -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Perkawinan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
              </div>
              <div class="modal-body">
                <form id="editForm" method="POST" action="">
                  @csrf
                  @method('PATCH')

                  <input type="hidden" id="editId" name="id">

                  <div class="mb-3">
                    <label for="editEartagPejantan" class="form-label">Eartag Pejantan</label>
                    <input type="text" class="form-control" id="editEartagPejantan" name="eartag_pejantan" readonly>
                  </div>

                  <div class="mb-3">
                    <label for="editTanggalMulai" class="form-label">Tanggal Mulai</label>
                    <input type="date" class="form-control" id="editTanggalMulai" name="tanggal_mulai" required>
                  </div>

                  <div class="mb-3">
                    <label for="editTanggalSelesai" class="form-label">Tanggal Selesai</label>
                    <input type="date" class="form-control" id="editTanggalSelesai" name="tanggal_selesai" required>
                  </div>

                  <div class="mb-3">
                    <label for="editKandang" class="form-label">Kandang</label>
                    <input type="text" class="form-control" id="editKandang" name="kandang">
                  </div>

                  <div class="mb-3">
                    <label for="editEartagBetina" class="form-label">Eartag Betina</label>
                    <select id="editEartagBetina" name="eartag_betina[]" class="form-control select2" multiple required>
                      <!-- Opsi betina akan dimuat oleh JavaScript -->
                    </select>
                  </div>

                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                  </div>
                </form>
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
    <!---Container Fluid-->
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

  <!-- DataTables & Buttons JS -->
  <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.flash.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>

  <script>
    $(document).ready(function() {
      $('#dataTable').DataTable({
        dom: 'Bfrtip',
        buttons: [
          'copy',
          {
            extend: 'csvHtml5',
            exportOptions: {
              columns: ':not(.noExport)'
            }
          },
          {
            extend: 'excelHtml5',
            exportOptions: {
              columns: ':not(.noExport)'
            }
          },
          {
            extend: 'pdfHtml5',
            orientation: 'landscape',
            pageSize: 'A4',
            title: 'Data Perkawinan',
            exportOptions: {
              columns: ':not(.noExport)'
            }
          },
          {
            extend: 'print',
            orientation: 'landscape',
            title: 'Data Perkawinan',
            exportOptions: {
              columns: ':not(.noExport)'
            }
          }
        ]
      });

      $('#dataTableHover').DataTable({
        dom: 'Bfrtip',
        buttons: [
          'copy',
          {
            extend: 'csvHtml5',
            exportOptions: {
              columns: ':not(.noExport)'
            }
          },
          {
            extend: 'excelHtml5',
            exportOptions: {
              columns: ':not(.noExport)'
            }
          },
          {
            extend: 'pdfHtml5',
            orientation: 'landscape',
            pageSize: 'A4',
            title: 'Data Perkawinan',
            exportOptions: {
              columns: ':not(.noExport)'
            }
          },
          {
            extend: 'print',
            orientation: 'landscape',
            title: 'Data Perkawinan',
            exportOptions: {
              columns: ':not(.noExport)'
            }
          }
        ]
      });
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

  <script>
    $(document).ready(function() {
      $('.select2').select2({
        placeholder: "Pilih Eartag Domba",
        maximumSelectionLength: 25,
        width: '100%'
      });
    });
  </script>

  <script>
    function openEditModal(buttonElement) {
      const id = buttonElement.dataset.id;
      const url = `/perkawinan/${id}/edit`;

      fetch(url)
        .then(response => response.json())
        .then(data => {
          document.getElementById('editId').value = data.id;
          document.getElementById('editEartagPejantan').value = data.eartag_pejantan;
          document.getElementById('editTanggalMulai').value = data.tanggal_mulai;
          document.getElementById('editTanggalSelesai').value = data.tanggal_selesai;
          document.getElementById('editKandang').value = data.kandang;

          const form = document.getElementById('editForm');
          form.action = `/perkawinan/${data.id}`;

          const eartagBetinaSelect = $('#editEartagBetina');
          eartagBetinaSelect.empty(); // Bersihkan sebelumnya

          // Mengisi Select2 dengan opsi baru
          data.betina.forEach(betina => {
            const option = new Option(betina['stringValue'], betina['stringValue'], false, false);
            eartagBetinaSelect.append(option);
          });

          // Memastikan nilai yang sudah dipilih
          if (data.selectedBetina && Array.isArray(data.selectedBetina)) {
            eartagBetinaSelect.val(data.selectedBetina).trigger('change');
          }

          // Re-inisialisasi select2 jika perlu
          eartagBetinaSelect.select2({
            placeholder: "Pilih hingga 20 eartag betina",
            maximumSelectionLength: 20,
            width: '100%',
          });
        })
        .catch(error => console.error('Error:', error));

      const modal = new bootstrap.Modal(document.getElementById('editModal'));
      modal.show();
    }

    function tampilkanDetailBetina(button) {
      const id = button.getAttribute('data-id'); // Ambil ID dari data-id pada tombol

      // Tampilkan loading sementara
      document.getElementById('betinaTableBody').innerHTML = `
        <tr>
            <td colspan="4">Memuat...</td>
        </tr>
    `;

      // Fetch data dari route /perkawinan/{id}
      fetch(`/perkawinan/${id}`)
        .then(response => response.json())
        .then(data => {
          const betinaList = data.betina || [];
          let rows = '';

          // Memasukkan data ke dalam tabel
          betinaList.forEach((item, index) => {
            // Tentukan kelas badge berdasarkan warna_eartag
            let badgeClass = 'badge-secondary'; // Default

            switch (item.warna_eartag.toLowerCase()) {
              case 'merah':
                badgeClass = 'badge-merah';
                break;
              case 'hijau':
                badgeClass = 'badge-hijau';
                break;
              case 'biru':
                badgeClass = 'badge-biru';
                break;
              case 'kuning':
                badgeClass = 'badge-kuning';
                break;
              case 'putih':
                badgeClass = 'badge-putih';
                break;
              default:
                badgeClass = 'badge-secondary';
            }

            rows += `
                <tr>
                    <td>${index + 1}</td>
                    <td>
                        <span class="badge ${badgeClass}">${item.eartag}</span>
                    </td>
                    <td>${item.persentase}</td>
                </tr>
            `;
          });

          document.getElementById('betinaTableBody').innerHTML = rows;
        })
        .catch(error => {
          document.getElementById('betinaTableBody').innerHTML = `
            <tr>
                <td colspan="3">Gagal memuat data</td>
            </tr>
        `;
          console.error('Gagal mengambil data:', error);
        });

      // Tampilkan modal Bootstrap
      const modal = new bootstrap.Modal(document.getElementById('detailModal'));
      modal.show();

    }
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