<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link href="{{ asset('img/logo/domba.png') }}" rel="icon">
    <title>@yield('title', 'Detail Domba')</title>

    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/ruang-admin.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/css/select2.min.css') }}" rel="stylesheet">

    <style>
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
                    <img src="{{ asset('img/logo/dombakuh.png') }}" alt="DombaKu Logo" style="height: 40px;">
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
                                <img class="img-profile rounded-circle" src="{{ asset('img/boy.png') }}" style="max-width: 60px">
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
                        <div class="d-flex align-items-center">
                            <a href="javascript:history.back()" class="btn btn-secondary mr-3">
                                <i class="fas fa-arrow-left"></i>
                            </a>
                            <h1 class="h3 mb-0 text-gray-800">Detail Domba</h1>
                        </div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./">Halaman Utama</a></li>
                            <li class="breadcrumb-item">Manajemen</li>
                            <li class="breadcrumb-item active" aria-current="page">Detail Domba</li>
                        </ol>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary w-100">Detail Domba</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <!-- Informasi Domba -->
                                        <div class="col-md-6 mb-4">
                                            <div class="card">
                                                <div class="card-header bg-info text-white">
                                                    <h5 class="mb-0">Informasi Domba</h5>
                                                </div>
                                                <div class="card-body">
                                                    <p><strong>Nomor Eartag :</strong> {{ $domba['eartag'] }}</p>
                                                    <p><strong>Jenis Kelamin:</strong> {{ $domba['kelamin'] }}</p>
                                                    <p><strong>Tanggal Lahir:</strong> {{ $domba['tanggal_lahir'] }}</p>
                                                    <p><strong>Umur :</strong> {{ $domba['umur'] }}</p>
                                                    <p><strong>Bobot Badan :</strong> {{ $domba['bobot_badan'] }} kg</p>
                                                    <p><strong>Kandang :</strong> {{ $domba['kandang'] }}</p>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Foto Domba -->
                                        <div class="col-md-6 mb-4">
                                            <div class="card h-100">
                                                <div class="card-header bg-primary text-white">
                                                    <h5 class="mb-0">Foto Domba</h5>
                                                </div>
                                                <div class="card-body d-flex justify-content-center align-items-center">
                                                    <img src="{{ asset('storage/' . $domba['foto']) }}" alt="Foto Domba"
                                                        class="img-fluid rounded shadow border"
                                                        style="max-width: 100%; max-height: 250px; object-fit: cover;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <!-- Informasi Kesehatan -->
                                        <div class="col-md-6 mb-4">
                                            <div class="card">
                                                <div class="card-header bg-success text-white">
                                                    <h5 class="mb-0">Informasi Kesehatan</h5>
                                                </div>
                                                <div class="card-body">
                                                    <p><strong>Kesehatan :</strong> {{ $domba['kesehatan'] }}</p>
                                                    <p><strong>Keterangan :</strong> {{ $domba['keterangan'] }}</p>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Informasi Keluarga -->
                                        <div class="col-md-6 mb-4">
                                            <div class="card">
                                                <div class="card-header bg-warning text-white">
                                                    <h5 class="mb-0">Informasi Keluarga</h5>
                                                </div>
                                                <div class="card-body">
                                                    <p><strong>Induk Betina :</strong> {{ $domba['induk_betina'] }}</p>
                                                    <p><strong>Induk Jantan :</strong> {{ $domba['induk_jantan'] }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Ayah -->
                                    <h5 class="text-primary mt-4">Ayah</h5>
                                    @if ($ayah)
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Eartag</th>
                                                <th>Jenis Kelamin</th>
                                                <th>Tanggal Lahir</th>
                                                <th>Induk Betina</th>
                                                <th>Induk Jantan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <a href="{{ route('manajemendomba.show', $ayah['id']) }}" class="badge
                    @if($ayah['warna_eartag'] == 'Putih') badge-putih
                    @elseif($ayah['warna_eartag'] == 'Merah') badge-merah
                    @elseif($ayah['warna_eartag'] == 'Biru') badge-biru
                    @elseif($ayah['warna_eartag'] == 'Hijau') badge-hijau
                    @elseif($ayah['warna_eartag'] == 'Kuning') badge-kuning
                    @else badge-secondary @endif">
                                                        {{ $ayah['eartag'] }}
                                                    </a>
                                                </td>
                                                <td>{{ $ayah['kelamin'] }}</td>
                                                <td>{{ $ayah['tanggal_lahir'] }}</td>
                                                <td>{{ $ayah['induk_betina'] }}</td>
                                                <td>{{ $ayah['induk_jantan'] }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    @else
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th colspan="5">No Data Available</th>
                                            </tr>
                                        </thead>
                                    </table>
                                    @endif

                                    <!-- Kakek (Ayah dari Ayah) -->
                                    <h5 class="text-primary mt-4">Kakek (Ayah dari Ayah)</h5>
                                    @if ($kakek)
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Eartag</th>
                                                <th>Jenis Kelamin</th>
                                                <th>Tanggal Lahir</th>
                                                <th>Induk Betina</th>
                                                <th>Induk Jantan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <a href="{{ route('manajemendomba.show', $kakek['id']) }}" class="badge
                    @if($kakek['warna_eartag'] == 'Putih') badge-putih
                    @elseif($kakek['warna_eartag'] == 'Merah') badge-merah
                    @elseif($kakek['warna_eartag'] == 'Biru') badge-biru
                    @elseif($kakek['warna_eartag'] == 'Hijau') badge-hijau
                    @elseif($kakek['warna_eartag'] == 'Kuning') badge-kuning
                    @else badge-secondary @endif">
                                                        {{ $kakek['eartag'] }}
                                                    </a>
                                                </td>
                                                <td>{{ $kakek['kelamin'] }}</td>
                                                <td>{{ $kakek['tanggal_lahir'] }}</td>
                                                <td>{{ $kakek['induk_betina'] }}</td>
                                                <td>{{ $kakek['induk_jantan'] }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    @else
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th colspan="5">No Data Available</th>
                                            </tr>
                                        </thead>
                                    </table>
                                    @endif

                                    <!-- Buyut (Ayah dari Kakek) -->
                                    <h5 class="text-primary mt-4">Buyut (Ayah dari Kakek)</h5>
                                    @if ($buyut)
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Eartag</th>
                                                <th>Jenis Kelamin</th>
                                                <th>Tanggal Lahir</th>
                                                <th>Induk Betina</th>
                                                <th>Induk Jantan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <a href="{{ route('manajemendomba.show', $buyut['id']) }}" class="badge
                    @if($buyut['warna_eartag'] == 'Putih') badge-putih
                    @elseif($buyut['warna_eartag'] == 'Merah') badge-merah
                    @elseif($buyut['warna_eartag'] == 'Biru') badge-biru
                    @elseif($buyut['warna_eartag'] == 'Hijau') badge-hijau
                    @elseif($buyut['warna_eartag'] == 'Kuning') badge-kuning
                    @else badge-secondary @endif">
                                                        {{ $buyut['eartag'] }}
                                                    </a>
                                                </td>
                                                <td>{{ $buyut['kelamin'] }}</td>
                                                <td>{{ $buyut['tanggal_lahir'] }}</td>
                                                <td>{{ $buyut['induk_betina'] }}</td>
                                                <td>{{ $buyut['induk_jantan'] }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    @else
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th colspan="5">No Data Available</th>
                                            </tr>
                                        </thead>
                                    </table>
                                    @endif

                                    <!-- Saudara -->
                                    <h5 class="text-primary mt-4">Saudara dari Ayah</h5>
                                    <table class="table table-bordered" id="dataTableHover">
                                        <thead>
                                            <tr>
                                                <th>Eartag</th>
                                                <th>Jenis Kelamin</th>
                                                <th>Tanggal Lahir</th>
                                                <th>Induk Betina</th>
                                                <th>Induk Jantan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($saudara as $sdr)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('manajemendomba.show', $sdr['id']) }}" class="badge
                    @if($sdr['warna_eartag'] == 'Putih') badge-putih
                    @elseif($sdr['warna_eartag'] == 'Merah') badge-merah
                    @elseif($sdr['warna_eartag'] == 'Biru') badge-biru
                    @elseif($sdr['warna_eartag'] == 'Hijau') badge-hijau
                    @elseif($sdr['warna_eartag'] == 'Kuning') badge-kuning
                    @else badge-secondary @endif">
                                                        {{ $sdr['eartag'] }}
                                                    </a>
                                                </td>
                                                <td>{{ $sdr['kelamin'] }}</td>
                                                <td>{{ $sdr['tanggal_lahir'] }}</td>
                                                <td>{{ $sdr['induk_betina'] }}</td>
                                                <td>{{ $sdr['induk_jantan'] }}</td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="5">No Data Available</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>

                                    <!-- Sepupu dari Kakek -->
                                    <h5 class="text-primary mt-4">Sepupu dari Kakek</h5>
                                    <table class="table table-bordered" id="dataTableHover">
                                        <thead>
                                            <tr>
                                                <th>Eartag</th>
                                                <th>Jenis Kelamin</th>
                                                <th>Tanggal Lahir</th>
                                                <th>Induk Betina</th>
                                                <th>Induk Jantan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($sepupuDariKakek as $sepupuKakek)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('manajemendomba.show', $sepupuKakek['id']) }}" class="badge
                    @if($sepupuKakek['warna_eartag'] == 'Putih') badge-putih
                    @elseif($sepupuKakek['warna_eartag'] == 'Merah') badge-merah
                    @elseif($sepupuKakek['warna_eartag'] == 'Biru') badge-biru
                    @elseif($sepupuKakek['warna_eartag'] == 'Hijau') badge-hijau
                    @elseif($sepupuKakek['warna_eartag'] == 'Kuning') badge-kuning
                    @else badge-secondary @endif">
                                                        {{ $sepupuKakek['eartag'] }}
                                                    </a>
                                                </td>
                                                <td>{{ $sepupuKakek['kelamin'] }}</td>
                                                <td>{{ $sepupuKakek['tanggal_lahir'] }}</td>
                                                <td>{{ $sepupuKakek['induk_betina'] }}</td>
                                                <td>{{ $sepupuKakek['induk_jantan'] }}</td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="5">No Data Available</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>

                                    <!-- Sepupu dari Buyut -->
                                    <h5 class="text-primary mt-4">Sepupu dari Buyut</h5>
                                    <table class="table table-bordered" id="dataTableHover">
                                        <thead>
                                            <tr>
                                                <th>Eartag</th>
                                                <th>Jenis Kelamin</th>
                                                <th>Tanggal Lahir</th>
                                                <th>Induk Betina</th>
                                                <th>Induk Jantan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($sepupuDariBuyut as $sepupuBuyut)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('manajemendomba.show', $sepupuBuyut['id']) }}" class="badge
                    @if($sepupuBuyut['warna_eartag'] == 'Putih') badge-putih
                    @elseif($sepupuBuyut['warna_eartag'] == 'Merah') badge-merah
                    @elseif($sepupuBuyut['warna_eartag'] == 'Biru') badge-biru
                    @elseif($sepupuBuyut['warna_eartag'] == 'Hijau') badge-hijau
                    @elseif($sepupuBuyut['warna_eartag'] == 'Kuning') badge-kuning
                    @else badge-secondary @endif">
                                                        {{ $sepupuBuyut['eartag'] }}
                                                    </a>
                                                </td>
                                                <td>{{ $sepupuBuyut['kelamin'] }}</td>
                                                <td>{{ $sepupuBuyut['tanggal_lahir'] }}</td>
                                                <td>{{ $sepupuBuyut['induk_betina'] }}</td>
                                                <td>{{ $sepupuBuyut['induk_jantan'] }}</td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="5">No Data Available</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>

                                    <!-- Anak -->
                                    <h5 class="text-primary mt-4">Anak</h5>
                                    <table class="table table-bordered" id="dataTableHover">
                                        <thead>
                                            <tr>
                                                <th>Eartag</th>
                                                <th>Jenis Kelamin</th>
                                                <th>Tanggal Lahir</th>
                                                <th>Induk Betina</th>
                                                <th>Induk Jantan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($anak as $an)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('manajemendomba.show', $an['id']) }}" class="badge
                    @if($an['warna_eartag'] == 'Putih') badge-putih
                    @elseif($an['warna_eartag'] == 'Merah') badge-merah
                    @elseif($an['warna_eartag'] == 'Biru') badge-biru
                    @elseif($an['warna_eartag'] == 'Hijau') badge-hijau
                    @elseif($an['warna_eartag'] == 'Kuning') badge-kuning
                    @else badge-secondary @endif">
                                                        {{ $an['eartag'] }}
                                                    </a>
                                                </td>
                                                <td>{{ $an['kelamin'] }}</td>
                                                <td>{{ $an['tanggal_lahir'] }}</td>
                                                <td>{{ $an['induk_betina'] }}</td>
                                                <td>{{ $an['induk_jantan'] }}</td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="5">No Data Available</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>

                                    <!-- Menampilkan Grafik Bar Generasi -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h5 class="text-center mb-4">Grafik Generasi Keturunan</h5>
                                            <div id="chart_div"></div>
                                        </div>
                                    </div>
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

    <script src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
        google.charts.load('current', {
            packages: ['corechart', 'bar']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable(<?php echo json_encode($generations); ?>);

            var options = {
                chart: {
                    title: 'Grafik Generasi Keturunan Domba',
                    subtitle: 'Jumlah berdasarkan generasi'
                }
            };

            var chart = new google.charts.Bar(document.getElementById('chart_div'));
            chart.draw(data, google.charts.Bar.convertOptions(options));
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