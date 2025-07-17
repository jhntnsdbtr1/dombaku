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
  <title>@yield('title', 'Manajemen Domba')</title>

  <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('css/ruang-admin.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/css/select2.min.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">


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
      background-color: #ff0000;
      border: 1px solid black;
    }

    .biru {
      background-color: #0000ff;
      border: 1px solid black;
    }

    .hijau {
      background-color: #00ff00;
      border: 1px solid black;
    }

    .kuning {
      background-color: #ffff00;
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
      background-color: #00ff00;
      color: white;
      font-weight: bold;
    }

    .eartag-kuning {
      background-color: yellow;
      color: black;
      font-weight: bold;
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
            <h1 class="h3 mb-0 text-gray-800">Manajemen Domba</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Halaman Utama</a></li>
              <li class="breadcrumb-item">Manajemen</li>
              <li class="breadcrumb-item active" aria-current="page">Manajemen Domba</li>
            </ol>
          </div>

          <div class="row">
            <!-- DataTable with Hover -->
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3">
                  <div class="d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Rekap Data Domba</h6>
                    <button type="button" class="btn btn-sm d-flex align-items-center" style="background-color: #0F382A; color: white; border: none;" data-toggle="modal" data-target="#tambahModal">
                      <i class="fas fa-plus mr-2"></i> Tambah
                    </button>
                  </div>
                </div>

                <div class="legend-box d-flex flex-wrap gap-4 align-items-center text-center">
                  <label><span class="legend-color putih"></span> Betina lahir di kandang, siap kawin <input type="checkbox" class="filter-checkbox ms-2" value="Putih"></label>
                  <label><span class="legend-color merah"></span> Indukan luar <input type="checkbox" class="filter-checkbox ms-2" value="Merah"></label>
                  <label><span class="legend-color biru"></span> Jantan <input type="checkbox" class="filter-checkbox ms-2" value="Biru"></label>
                  <label><span class="legend-color hijau"></span> Cempe &lt; 1 bulan <input type="checkbox" class="filter-checkbox ms-2" value="Hijau"></label>
                  <label><span class="legend-color kuning"></span> Cempe &gt; 1 bulan <input type="checkbox" class="filter-checkbox ms-2" value="Kuning"></label>
                </div>

                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush table-hover text-center" id="dataTableHover">
                    <thead class="thead-light">
                      <tr>
                        <th>No</th>
                        <th>EARTAG</th>
                        <th>Warna Eartag</th>
                        <th>Jenis Kelamin</th>
                        <th>Tanggal Lahir</th>
                        <th>Usia</th>
                        <th>Berat</th>
                        <th>Induk Betina</th>
                        <th>Warna Induk Betina</th>
                        <th>Induk Jantan</th>
                        <th>Warna Induk Jantan</th>
                        <th>Kakek</th>
                        <th>Warna Kakek</th>
                        <th>Buyut</th>
                        <th>Warna Buyut</th>
                        <th>Kandang</th>
                        <th>Kesehatan</th>
                        <th>Keterangan</th>
                        <th>RiwayatKawin</th>
                        <th class="noExport">Dokumentasi</th>
                        <th class="noExport">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($dombaData as $index => $domba)
                      <tr data-warna="{{ $domba['warna_eartag'] }}">
                        <td>{{ $index + 1 }}</td>
                        <td data-warna="{{ $domba['warna_eartag'] }}">
                          <a href="{{ route('manajemendomba.show', $domba['id']) }}" class="badge
                              @if($domba['warna_eartag'] == 'Putih') badge-putih
                              @elseif($domba['warna_eartag'] == 'Merah') badge-merah
                              @elseif($domba['warna_eartag'] == 'Biru') badge-biru
                              @elseif($domba['warna_eartag'] == 'Hijau') badge-hijau
                              @elseif($domba['warna_eartag'] == 'Kuning') badge-kuning
                              @else badge-secondary @endif">
                            {{ $domba['eartag'] }}
                          </a>
                        </td>
                        <td>{{ $domba['warna_eartag'] }}</td> {{-- kolom warna_eartag yang disembunyikan --}}
                        <td>{{ $domba['kelamin'] }}</td>
                        <td>{{ $domba['tanggal_lahir'] }}</td>
                        <td>{{ $domba['umur'] }}</td>
                        <td>{{ $domba['bobot_badan'] }}</td>
                        <!-- Induk Betina -->
                        <td>
                          @if(!empty($domba['induk_betina']))
                          <a href="{{ isset($domba['induk_betina_id']) ? route('manajemendomba.show', $domba['induk_betina_id']) : '#' }}" class="badge
      @if(($domba['warna_induk_betina'] ?? '') == 'Putih') badge-putih
      @elseif(($domba['warna_induk_betina'] ?? '') == 'Merah') badge-merah
      @elseif(($domba['warna_induk_betina'] ?? '') == 'Biru') badge-biru
      @elseif(($domba['warna_induk_betina'] ?? '') == 'Hijau') badge-hijau
      @elseif(($domba['warna_induk_betina'] ?? '') == 'Kuning') badge-kuning
      @else badge-secondary @endif">
                            {{ $domba['induk_betina'] }}
                          </a>
                          @else
                          -
                          @endif
                        </td>
                        <td>{{ $domba['warna_induk_betina'] ?? '' }}</td>
                        <!-- Induk Jantan -->
                        <td>
                          @if(!empty($domba['induk_jantan']))
                          <a href="{{ isset($domba['induk_jantan_id']) ? route('manajemendomba.show', $domba['induk_jantan_id']) : '#' }}" class="badge
      @if(($domba['warna_induk_jantan'] ?? '') == 'Putih') badge-putih
      @elseif(($domba['warna_induk_jantan'] ?? '') == 'Merah') badge-merah
      @elseif(($domba['warna_induk_jantan'] ?? '') == 'Biru') badge-biru
      @elseif(($domba['warna_induk_jantan'] ?? '') == 'Hijau') badge-hijau
      @elseif(($domba['warna_induk_jantan'] ?? '') == 'Kuning') badge-kuning
      @else badge-secondary @endif">
                            {{ $domba['induk_jantan'] }}
                          </a>
                          @else
                          -
                          @endif
                        </td>
                        <td>{{ $domba['warna_induk_jantan'] ?? '' }}</td>

                        <!-- Kakek -->
                        <td>
                          @if(!empty($domba['kakek']))
                          <a href="{{ isset($domba['kakek_id']) ? route('manajemendomba.show', $domba['kakek_id']) : '#' }}" class="badge
      @if(($domba['warna_kakek'] ?? '') == 'Putih') badge-putih
      @elseif(($domba['warna_kakek'] ?? '') == 'Merah') badge-merah
      @elseif(($domba['warna_kakek'] ?? '') == 'Biru') badge-biru
      @elseif(($domba['warna_kakek'] ?? '') == 'Hijau') badge-hijau
      @elseif(($domba['warna_kakek'] ?? '') == 'Kuning') badge-kuning
      @else badge-secondary @endif">
                            {{ $domba['kakek'] }}
                          </a>
                          @else
                          -
                          @endif
                        </td>
                        <td>{{ $domba['warna_kakek'] ?? '' }}</td>

                        <!-- Buyut -->
                        <td>
                          @if(!empty($domba['buyut']))
                          <a href="{{ isset($domba['buyut_id']) ? route('manajemendomba.show', $domba['buyut_id']) : '#' }}" class="badge
      @if(($domba['warna_buyut'] ?? '') == 'Putih') badge-putih
      @elseif(($domba['warna_buyut'] ?? '') == 'Merah') badge-merah
      @elseif(($domba['warna_buyut'] ?? '') == 'Biru') badge-biru
      @elseif(($domba['warna_buyut'] ?? '') == 'Hijau') badge-hijau
      @elseif(($domba['warna_buyut'] ?? '') == 'Kuning') badge-kuning
      @else badge-secondary @endif">
                            {{ $domba['buyut'] }}
                          </a>
                          @else
                          -
                          @endif
                        </td>
                        <td>{{ $domba['warna_buyut'] ?? '' }}</td>
                        <td>{{ $domba['kandang'] }}</td>
                        <td>
                          <span class="badge 
                            @if($domba['kesehatan'] == 'Sehat') bg-success 
                            @elseif($domba['kesehatan'] == 'Sakit') bg-danger 
                            @else bg-secondary @endif
                            text-white">
                            {{ $domba['kesehatan'] }}
                          </span>
                        </td>
                        <td>{{ $domba['keterangan'] }}</td>
                        <td>
                          @if(isset($domba['pernah_kawin']) && $domba['pernah_kawin'])
                          <span class="badge bg-success text-white">Sudah</span>
                          @else
                          <span class="badge bg-warning text-white">Belum</span>
                          @endif
                        </td>
                        <td>
                          <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalLihat{{ $domba['id'] }}">
                            Lihat
                          </button>
                        </td>
                        <td>
                          <a href="{{ route('manajemendomba.show', $domba['id']) }}" class="btn btn-sm btn-info">Detail</a>
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
                      <label for="warna_eartag">Warna Eartag</label>
                      <select class="form-control" id="warna_eartag" name="warna_eartag" required>
                        <option value="Putih">Putih - Betina lahir di kandang, siap kawin</option>
                        <option value="Merah">Merah - Indukan luar</option>
                        <option value="Biru">Biru - Jantan</option>
                        <option value="Hijau">Hijau - Cempe &lt; 1 bulan</option>
                        <option value="Kuning">Kuning - Cempe &gt; 1 bulan</option>
                      </select>
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
                      <input type="text" class="form-control" id="kandang" name="kandang">
                    </div>
                    <div class="form-group">
                      <label for="keterangan">Keterangan</label>
                      <textarea class="form-control" id="keterangan" name="keterangan"></textarea>
                    </div>
                    <div class="form-group">
                      <label for="kesehatan">Kesehatan</label>
                      <select class="form-control" id="kesehatan" name="kesehatan" required>
                        <option value="Sehat">Sehat</option>
                        <option value="Sakit">Sakit</option>
                      </select>
                    </div>
                    <!-- Input Upload Dokumentasi -->
                    <div class="form-group">
                      <label for="dokumentasi">Upload Dokumentasi (JPG, PNG, PDF)</label>
                      <input type="file" class="form-control-file" id="dokumentasi" name="dokumentasi" accept=".jpg, .jpeg, .png, .pdf">
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
                  <form class="edit-domba-form" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="_method" value="PATCH">
                    <div class="form-group">
                      <label for="eartag">EARTAG</label>
                      <input type="text" class="form-control" name="eartag" value="{{ $domba['eartag'] }}" readonly>
                    </div>

                    <div class="form-group">
                      <label for="warna_eartag">Warna Eartag</label>
                      <select class="form-control" name="warna_eartag" required>
                        <option value="Putih" {{ $domba['warna_eartag'] == 'Putih' ? 'selected' : '' }}>Putih - Betina lahir di kandang, siap kawin</option>
                        <option value="Merah" {{ $domba['warna_eartag'] == 'Merah' ? 'selected' : '' }}>Merah - Indukan luar</option>
                        <option value="Biru" {{ $domba['warna_eartag'] == 'Biru' ? 'selected' : '' }}>Biru - Jantan</option>
                        <option value="Hijau" {{ $domba['warna_eartag'] == 'Hijau' ? 'selected' : '' }}>Hijau - Cempe &lt; 1 bulan</option>
                        <option value="Kuning" {{ $domba['warna_eartag'] == 'Kuning' ? 'selected' : '' }}>Kuning - Cempe &gt; 1 bulan</option>
                      </select>
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
                      <input type="date" class="form-control" name="tanggal_lahir" value="{{ \Carbon\Carbon::parse($domba['tanggal_lahir'])->format('Y-m-d') }}" required>
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
                      <select class="form-control" name="kesehatan" required>
                        <option value="Sehat" {{ $domba['kesehatan'] == 'Sehat' ? 'selected' : '' }}>Sehat</option>
                        <option value="Sakit" {{ $domba['kesehatan'] == 'Sakit' ? 'selected' : '' }}>Sakit</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="foto">Dokumentasi (Foto)</label>

                      <!-- Tampilkan foto lama jika ada -->
                      @if (isset($domba['foto']) && $domba['foto'])
                      <div class="mb-2">
                        <img src="{{ Storage::url($domba['foto']) }}" alt="Dokumentasi Lama" style="max-width: 150px; max-height: 150px;">
                      </div>
                      <small>Foto Lama</small>
                      @else
                      <p>Tidak ada dokumentasi yang tersedia.</p>
                      @endif

                      <!-- Input untuk mengganti foto jika ingin -->
                      <input type="file" class="form-control" name="foto">

                    </div>

                    <div class="form-group">
                      <label for="deskripsi">Deskripsi Perubahan</label>
                      <textarea class="form-control" name="deskripsi" placeholder="Contoh: Pindah kandang karena domba sakit, atau update bobot setelah penimbangan."></textarea>
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
    <script src="{{ asset('vendor/js/select2.min.js') }}"></script>


    <!-- Page level plugins -->
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

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
        var table = $('#dataTableHover').DataTable({
          dom: 'Bfrtip',
          columnDefs: [{
            targets: [2, 8, 10, 12, 14], // Kolom disembunyikan
            visible: false,
            searchable: false
          }],
          buttons: [{
              extend: 'csvHtml5',
              title: 'data_asli',
              exportOptions: {
                columns: [1, 2, 3, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 16, 18]
              },
              format: {
                body: function(data, row, column, node) {
                  if (column === 5) { // Kolom Umur
                    var newData = data.replace(/,/g, ';'); // ganti koma jadi titik koma
                    return `"${newData}"`; // bungkus tanda kutip supaya dianggap 1 field
                  }
                  return data;
                }
              },
              customize: function(csv) {
                // Jangan hapus tanda kutip supaya data tetap valid
                return csv;
              }
            },
            {
              extend: 'excelHtml5',
              orientation: 'landscape',
              pageSize: 'A4',
              title: 'Data Daftar Domba',
              exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18]
              }
            },
            {
              extend: 'pdfHtml5',
              orientation: 'landscape',
              pageSize: 'A4',
              title: 'Data Daftar Domba',
              exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18]
              }
            },
            {
              extend: 'print',
              orientation: 'landscape',
              title: 'Data Daftar Domba',
              exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18]
              }
            }
          ],
          createdRow: function(row, data, dataIndex) {
            // Ambil warna dari atribut data-warna atau kolom ke-2
            var warna = $(row).attr('data-warna') || data[2];
            if (warna) {
              warna = warna.toLowerCase().replace(/\s/g, '');
              $(row).addClass('bg-' + warna);
            }
          }
        });

        $('#eartag_betina').select2({
          placeholder: "Pilih hingga 20 eartag betina",
          maximumSelectionLength: 20,
          width: '100%',
        });
      });
    </script>

    <script>
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $('button[data-toggle="modal"]').on('click', function() {
        var id = $(this).data('id');
        console.log('ID yang diteruskan ke URL:', id);

        var modal = $('#editModal' + id);
        modal.modal('show');

        // Hapus event listener lama agar tidak double
        modal.find('form').off('submit').on('submit', function(e) {
          e.preventDefault();

          var form = this;
          var formData = new FormData(form); // ✅ Ambil semua form input
          formData.append('_method', 'PATCH'); // ✅ Tambah PATCH override

          console.log('[FormData] Akan dikirim ke:', '/manajemendomba/update/' + id);

          $.ajax({
            url: '/manajemendomba/update/' + id,
            type: 'POST', // tetap POST, Laravel akan baca _method = PATCH
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
              console.log('[AJAX] Success:', response);
              window.location.reload();
            },
            error: function(xhr) {
              console.error('[AJAX] Error:', xhr.responseText);
              alert('Gagal memperbarui data domba.');
            }
          });
        });
      });
    </script>


    <script>
      document.querySelectorAll('.filter-checkbox').forEach(cb => {
        cb.addEventListener('change', function() {
          const selected = Array.from(document.querySelectorAll('.filter-checkbox:checked'))
            .map(x => x.value);

          document.querySelectorAll('tr[data-warna]').forEach(row => {
            const rowColor = row.getAttribute('data-warna');
            if (selected.length === 0 || selected.includes(rowColor)) {
              row.style.display = '';
            } else {
              row.style.display = 'none';
            }
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

          const doc = nlp(command);
          const nouns = doc.nouns().out('array');
          const verbs = doc.verbs().out('array');
          const commandNLP = nouns.concat(verbs).join(" ");

          // Cek apakah user mau lihat detail domba berdasarkan eartag (nomor)
          // Contoh ucapan: "lihat detail domba 123" atau "buka domba eartag 456"
          const regexEartag = /\b(\d{1,10})\b/; // mencari angka 1 sampai 10 digit dalam kalimat
          const matchEartag = command.match(regexEartag);

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
          } else if ((commandNLP.includes("lihat") || commandNLP.includes("buka") || commandNLP.includes("detail")) && matchEartag) {
            // jika perintah mengandung "lihat" atau "buka" atau "detail" dan ada nomor eartag
            const eartag = matchEartag[1];

            // cari baris di tabel yang punya eartag sama
            const rows = document.querySelectorAll("#dataTableHover tbody tr");
            let found = false;
            rows.forEach(row => {
              const eartagCell = row.querySelector("td:nth-child(2) a");
              if (eartagCell && eartagCell.textContent.trim() === eartag) {
                found = true;
                // klik otomatis ke link detailnya
                eartagCell.click();
              }
            });

            if (!found) {
              alert(`Domba dengan EARTAG ${eartag} tidak ditemukan.`);
            }
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

        const fullDateTime = `${day} : ${month} : ${year}, ${hours} : ${minutes} : ${seconds}`;
        document.getElementById('clock').textContent = fullDateTime;
      }

      setInterval(updateClock, 1000);
      updateClock();
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