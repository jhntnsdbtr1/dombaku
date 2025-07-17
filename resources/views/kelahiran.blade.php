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
  <title>@yield('title', 'Manajemen Kelahiran')</title>

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
        Features
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
                <a class="dropdown-item" href="#">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
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
            <h1 class="h3 mb-0 text-gray-800">Manajemen Kelahiran Domba</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Halaman Utama</a></li>
              <li class="breadcrumb-item">Manajemen</li>
              <li class="breadcrumb-item active" aria-current="page">Manajemen Kelahiran</li>
            </ol>
          </div>

          <div class="row">
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary w-100">Rekap Kelahiran Domba</h6>
                  <button type="button" class="btn btn-sm d-flex align-items-center" style="background-color: #0F382A; color: white; border: none;" data-toggle="modal" data-target="#tambahModal">
                    <i class="fas fa-plus mr-2"></i> Tambah
                  </button>
                </div>
                <div class="table-responsive p-3">
                  <table class="table table-hover text-center" id="dataTableHover">
                    <thead class="thead-light">
                      <tr>
                        <th>No</th>
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
                      @if (isset($dataKelahiran) && count($dataKelahiran) > 0)
                      @foreach ($dataKelahiran as $index => $item)
                      <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                          @foreach($eartagJantan as $domba)
                          @if($domba['eartag'] == $item['eartag_jantan'])
                          <span class="badge
                            @if($domba['warna'] == 'Putih') badge-putih
                            @elseif($domba['warna'] == 'Merah') badge-merah
                            @elseif($domba['warna'] == 'Biru') badge-biru
                            @elseif($domba['warna'] == 'Hijau') badge-hijau
                            @elseif($domba['warna'] == 'Kuning') badge-kuning
                            @else badge-secondary @endif">
                            {{ $domba['eartag'] }}
                          </span>
                          @endif
                          @endforeach
                        </td>
                        <td>
                          @foreach($eartagBetina as $domba)
                          @if($domba['eartag'] == $item['eartag_induk'])
                          <span class="badge
                            @if($domba['warna'] == 'Putih') badge-putih
                            @elseif($domba['warna'] == 'Merah') badge-merah
                            @elseif($domba['warna'] == 'Biru') badge-biru
                            @elseif($domba['warna'] == 'Hijau') badge-hijau
                            @elseif($domba['warna'] == 'Kuning') badge-kuning
                            @else badge-secondary @endif">
                            {{ $domba['eartag'] }}
                          </span>
                          @endif
                          @endforeach
                        </td>
                        <td>{{ $item['eartag_anak'] }}</td>
                        <td>{{ $item['kelamin_betina'] }}</td>
                        <td>{{ $item['kelamin_jantan'] }}</td>
                        <td>{{ \Carbon\Carbon::parse($item['tanggal_lahir'])->format('d-m-Y') }}</td>
                        <td>{{ $item['jumlah_anak'] }}</td>
                        <td>{{ $item['bobot_anak'] }}</td>
                        <td>{{ $item['mortalitas'] }}</td>
                        <td>{{ $item['persentase_mortalitas'] }}%</td>
                        <td>{{ $item['keterangan'] }}</td>
                        <td>
                          <!-- Tombol Detail -->
                          <button type="button" class="btn btn-sm btn-info mb-1" data-id="{{ $item['id'] }}" onclick="openDetailModal(this)">
                            Detail
                          </button>

                          <!-- Tombol Edit -->
                          <button type="button" class="btn btn-sm btn-warning mb-1" data-id="{{ $item['id'] }}" onclick="openEditModal(this)">
                            Edit
                          </button>

                          <form action="{{ route('kelahiran.destroy', $item['id']) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin hapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                          </form>
                        </td>
                      </tr>
                      @endforeach
                      @else
                      <!-- If no data, display this -->
                      <tr>
                        <td colspan="13" class="text-center">No data available in table</td>
                      </tr>
                      @endif
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
                  <form method="POST" action="{{ route('kelahiran.store') }}">
                    @csrf
                    <div class="form-group">
                      <label for="eartagInduk">Eartag Induk</label>
                      <select class="form-control select2" id="eartagInduk" name="eartagInduk" required>
                        <option value="">Pilih Eartag Induk</option>
                        @foreach ($eartagBetina as $betina)
                        <option value="{{ $betina['eartag'] }}">
                          [{{ $betina['eartag'] }}] - {{ $betina['warna'] }}
                        </option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="eartagJantan">Eartag Pejantan</label>
                      <select class="form-control select2" id="eartagJantan" name="eartagJantan" required>
                        <option value="">Pilih Eartag Pejantan</option>
                        @foreach ($eartagJantan as $jantan)
                        <option value="{{ $jantan['eartag'] }}">
                          [{{ $jantan['eartag'] }}] - {{ $jantan['warna'] }}
                        </option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="eartagAnak">Eartag Anak</label>
                      <input type="text" class="form-control" id="eartagAnak" name="eartagAnak" placeholder="Masukkan Eartag Anak" required>
                    </div>
                    <div class="form-group">
                      <label for="jenisKelaminAnak">Jenis Kelamin Anak</label>
                      <select class="form-control" id="jenisKelaminAnak" name="jenisKelaminAnak" required>
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="betina">Betina</option>
                        <option value="jantan">Jantan</option>
                      </select>
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
            <table class="table table-bordered table-striped" id="dataTableHover">
              <thead class="thead-info">
                <tr>
                  <th>Deskripsi</th>
                  <th>Total</th>
                  <th>Persentase (%)</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Jumlah Kehamilan</td>
                  <td>{{ $rekapData['jumlah_kehamilan'] }}</td>
                  <td>-</td>
                </tr>
                <tr>
                  <td>Anak Betina</td>
                  <td>{{ $rekapData['jumlah_anak_betina'] }}</td>
                  <td>
                    @if($rekapData['jumlah_anak'] > 0)
                    {{ number_format(($rekapData['jumlah_anak_betina'] / $rekapData['jumlah_anak']) * 100, 2) }}%
                    @else
                    -
                    @endif
                  </td>
                </tr>
                <tr>
                  <td>Anak Jantan</td>
                  <td>{{ $rekapData['jumlah_anak_jantan'] }}</td>
                  <td>
                    @if($rekapData['jumlah_anak'] > 0)
                    {{ number_format(($rekapData['jumlah_anak_jantan'] / $rekapData['jumlah_anak']) * 100, 2) }}%
                    @else
                    -
                    @endif
                  </td>
                </tr>
                <tr>
                  <td>Jumlah Anak</td>
                  <td>{{ $rekapData['jumlah_anak'] }}</td>
                  <td>
                    @if($rekapData['jumlah_kehamilan'] > 0)
                    {{ number_format($rekapData['persentase_jumlah_anak'], 2) }}%
                    @else
                    -
                    @endif
                  </td>
                </tr>
                <tr>
                  <td>Total Mortalitas</td>
                  <td>{{ $rekapData['total_mortalitas'] }}</td>
                  <td>
                    @if($rekapData['jumlah_anak'] > 0)
                    {{ number_format(($rekapData['total_mortalitas'] / $rekapData['jumlah_anak']) * 100, 2) }}%
                    @else
                    -
                    @endif
                  </td>
                </tr>
                <tr>
                  <td>Jumlah Anak Hidup</td>
                  <td>{{ $rekapData['jumlah_anak_hidup'] }}</td>
                  <td>
                    @if($rekapData['jumlah_anak'] > 0)
                    {{ number_format(($rekapData['jumlah_anak_hidup'] / $rekapData['jumlah_anak']) * 100, 2) }}%
                    @else
                    -
                    @endif
                  </td>
                </tr>
                <tr>
                  <td>Anak Hidup/Kehamilan</td>
                  <td>-</td>
                  <td>{{ number_format($rekapData['anak_hidup_per_kehamilan'], 2) }}</td>
                </tr>
              </tbody>
            </table>
          </div>

          <!-- Modal Detail Kelahiran Domba -->
          <div class="modal fade" id="detailKelahiranModal" tabindex="-1" aria-labelledby="detailKelahiranModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content rounded-3 shadow">
                <div class="modal-header bg-success text-white">
                  <h5 class="modal-title" id="detailKelahiranModalLabel">Detail Kelahiran Domba</h5>
                  <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                  <div class="container-fluid">
                    <div class="row mb-2">
                      <div class="col-md-6"><strong>Eartag Induk:</strong> <span id="eartagIndukDetail"></span></div>
                      <div class="col-md-6"><strong>Eartag Jantan:</strong> <span id="eartagJantanDetail"></span></div>
                    </div>
                    <div class="row mb-2">
                      <div class="col-md-6"><strong>Eartag Anak:</strong> <span id="eartagAnakDetail"></span></div>
                      <div class="col-md-6"><strong>Jumlah Anak:</strong> <span id="jumlahAnakDisplay"></span></div>
                    </div>
                    <div class="row mb-2">
                      <div class="col-md-6"><strong>Kelamin Betina:</strong> <span id="kelaminBetinaDetail"></span></div>
                      <div class="col-md-6"><strong>Kelamin Jantan:</strong> <span id="kelaminJantanDetail"></span></div>
                    </div>
                    <div class="row mb-2">
                      <div class="col-md-6"><strong>Tanggal Lahir:</strong> <span id="tanggalLahir"></span></div>
                      <div class="col-md-6"><strong>Bobot Anak:</strong> <span id="bobotAnakDisplay"></span></div>
                    </div>
                    <div class="row mb-2">
                      <div class="col-md-6"><strong>Mortalitas:</strong> <span id="mortalitasDisplay"></span></div>
                      <div class="col-md-6"><strong>Persentase Mortalitas:</strong> <span id="persentaseMortalitasDisplay"></span></div>
                    </div>
                    <div class="row mb-2">
                      <div class="col-12"><strong>Keterangan:</strong> <span id="keteranganDisplay"></span></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Modal Edit Kelahiran -->
          <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="editModalLabel">Edit Data Kelahiran</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                  <form id="formEditKelahiran" method="POST">
                    @csrf
                    @method('PUT') <!-- Ini akan mengubah metode menjadi PUT -->

                    <input type="hidden" id="editId">

                    <div class="form-group">
                      <label for="editEartagInduk">Eartag Induk</label>
                      <input type="text" id="editEartagInduk" class="form-control" readonly>
                    </div>

                    <div class="form-group">
                      <label for="editEartagJantan">Eartag Jantan</label>
                      <input type="text" id="editEartagJantan" class="form-control" readonly>
                    </div>

                    <div class="form-group">
                      <label for="editEartagAnak">Eartag Anak</label>
                      <input type="text" id="editEartagAnak" class="form-control" readonly>
                    </div>

                    <div class="form-group">
                      <label for="editJenisKelaminAnak">Jenis Kelamin Anak</label>
                      <select class="form-control" id="editJenisKelaminAnak" name="jenisKelaminAnak" required>
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="betina" id="editBetina">Betina</option>
                        <option value="jantan" id="editJantan">Jantan</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="editTanggalLahir">Tanggal Lahir</label>
                      <input type="date" id="editTanggalLahir" class="form-control" required>
                    </div>

                    <div class="form-group">
                      <label for="editJumlahAnak">Jumlah Anak</label>
                      <input type="text" id="editJumlahAnak" class="form-control" required>
                    </div>

                    <div class="form-group">
                      <label for="editBobotAnak">Bobot Anak</label>
                      <input type="text" id="editBobotAnak" class="form-control">
                    </div>

                    <div class="form-group">
                      <label for="editMortalitas">Mortalitas</label>
                      <input type="text" id="editMortalitas" class="form-control">
                    </div>

                    <div class="form-group">
                      <label for="editPersentaseMortalitas">Persentase Mortalitas (%)</label>
                      <input type="text" id="editPersentaseMortalitas" class="form-control">
                    </div>

                    <div class="form-group">
                      <label for="editKeterangan">Keterangan</label>
                      <input type="text" id="editKeterangan" class="form-control">
                    </div>

                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                  <button type="submit" class="btn btn-success" form="formEditKelahiran">Simpan</button>
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

    <!-- DataTables init -->
    <script>
      $(document).ready(function() {
        $('#dataTableHover').DataTable({
          dom: 'Bfrtip',
          buttons: [{
              extend: 'csvHtml5',
              title: 'Data Kelahiran Domba',
              exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
              }
            },
            {
              extend: 'excelHtml5',
              title: 'Data Kelahiran Domba',
              exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
              }
            },
            {
              extend: 'pdfHtml5',
              orientation: 'landscape',
              pageSize: 'A4',
              title: 'Data Kelahiran Domba',
              exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
              }
            },
            {
              extend: 'print',
              orientation: 'landscape',
              title: 'Data Kelahiran Domba',
              exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
              }
            }
          ]
        });
      });
    </script>

    <!-- Hitung Persentase Mortalitas -->
    <script>
      $(document).ready(function() {
        $('.select2').select2({
          width: '100%'
        });

        $('#mortalitas, #jumlahAnak').on('input', function() {
          let totalAnak = parseInt($('#jumlahAnak').val()) || 0;
          let jumlahMati = parseInt($('#mortalitas').val()) || 0;

          let persen = (totalAnak > 0) ? ((jumlahMati / totalAnak) * 100).toFixed(2) + '%' : '0%';
          $('#persentaseMortalitas').val(persen);
        });
      });
    </script>

    <script>
      // Fungsi untuk membuka modal detail
      // Fungsi untuk membuka modal detail
      function openDetailModal(button) {
        const id = button.getAttribute('data-id');
        fetch(`/kelahiran/${id}`)
          .then(response => {
            if (!response.ok) {
              throw new Error('Terjadi masalah dengan respons server');
            }
            return response.json();
          })
          .then(data => {
            if (!data || Object.keys(data).length === 0) {
              throw new Error('Data tidak valid');
            }

            // Mengisi data di modal detail
            document.getElementById('eartagIndukDetail').textContent = data.eartag_induk || 'N/A';
            document.getElementById('eartagJantanDetail').textContent = data.eartag_jantan || 'N/A';
            document.getElementById('eartagAnakDetail').textContent = data.eartag_anak || 'N/A';
            document.getElementById('jumlahAnakDisplay').textContent = data.jumlah_anak || 'N/A';

            // Tampilkan jenis kelamin secara deskriptif
            document.getElementById('kelaminBetinaDetail').textContent = data.kelamin_betina == 1 ? 'Ya' : 'Tidak';
            document.getElementById('kelaminJantanDetail').textContent = data.kelamin_jantan == 1 ? 'Ya' : 'Tidak';

            document.getElementById('tanggalLahir').textContent = data.tanggal_lahir || 'N/A';
            document.getElementById('bobotAnakDisplay').textContent = data.bobot_anak || 'N/A';
            document.getElementById('mortalitasDisplay').textContent = data.mortalitas || 'N/A';
            document.getElementById('persentaseMortalitasDisplay').textContent = (data.persentase_mortalitas || 0) + '%';
            document.getElementById('keteranganDisplay').textContent = data.keterangan || 'N/A';

            // Tampilkan modal
            $('#detailKelahiranModal').modal('show');
          })
          .catch(error => {
            console.error('Ada masalah dengan operasi fetch:', error);
            alert('Data gagal dimuat');
          });
      }

      function openEditModal(button) {
        const id = button.getAttribute('data-id');
        fetch(`/kelahiran/${id}`)
          .then(response => response.json())
          .then(data => {
            // Mengisi form dengan data yang ada
            document.getElementById('editEartagInduk').value = data.eartag_induk || '';
            document.getElementById('editEartagJantan').value = data.eartag_jantan || '';
            document.getElementById('editEartagAnak').value = data.eartag_anak || '';
            document.getElementById('editTanggalLahir').value = data.tanggal_lahir || '';
            document.getElementById('editJumlahAnak').value = data.jumlah_anak || '';
            document.getElementById('editBobotAnak').value = data.bobot_anak || '';
            document.getElementById('editMortalitas').value = data.mortalitas || '';
            document.getElementById('editPersentaseMortalitas').value = data.persentase_mortalitas || '';
            document.getElementById('editKeterangan').value = data.keterangan || '';
            document.getElementById('editId').value = id;

            // Set jenis kelamin anak di dropdown
            if (data.kelamin_betina == 1) {
              document.getElementById('editJenisKelaminAnak').value = 'betina';
            } else if (data.kelamin_jantan == 1) {
              document.getElementById('editJenisKelaminAnak').value = 'jantan';
            } else {
              document.getElementById('editJenisKelaminAnak').value = ''; // Jika tidak ada kelamin
            }

            // Menampilkan modal
            $('#editModal').modal('show');
          })
          .catch(error => {
            console.error('Ada masalah dengan pengambilan data:', error);
            alert('Data gagal dimuat');
          });
      }

      $('#formEditKelahiran').submit(function(e) {
        e.preventDefault();

        var formData = {
          eartagInduk: $('#editEartagInduk').val(),
          eartagJantan: $('#editEartagJantan').val(),
          eartagAnak: $('#editEartagAnak').val(),
          jenisKelaminAnak: $('#editJenisKelaminAnak').val(),
          tanggalLahir: $('#editTanggalLahir').val(),
          jumlahAnak: $('#editJumlahAnak').val(),
          bobotAnak: $('#editBobotAnak').val(),
          mortalitas: $('#editMortalitas').val(),
          keterangan: $('#editKeterangan').val(),
          _method: 'PUT' // penting agar dikenali sebagai PUT
        };

        $.ajax({
          url: '/kelahiran/' + $('#editId').val(),
          type: 'POST',
          data: formData,
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success: function(response) {
            alert('Data berhasil diperbarui');
            $('#editModal').modal('hide');
            location.reload();
          },
          error: function(xhr, status, error) {
            console.log(xhr.responseText);
            alert('Terjadi kesalahan: ' + error);
          }
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