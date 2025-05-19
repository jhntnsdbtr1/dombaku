<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link href="{{ asset('img/logo/domba.png') }}" rel="icon">
    <title>@yield('title', 'Riwayat Domba')</title>

    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/ruang-admin.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

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
                        <h1 class="h3 mb-0 text-gray-800">Riwayat Domba</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./">Halaman Utama</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Riwayat</li>
                        </ol>
                    </div>

                    <!-- Form Pencarian Eartag dan Warna Eartag -->
                    <div class="row mb-3">
                        <div class="col-lg-12">
                            <div class="card mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Cari Riwayat Domba Berdasarkan Eartag</h6>
                                </div>
                                <div class="card-body">
                                    <form method="GET" action="{{ route('riwayat.index') }}">
                                        <div class="form-row">
                                            <div class="col-7">
                                                <input type="text" class="form-control" name="eartag" placeholder="Masukkan Eartag Domba" value="{{ request()->input('eartag') }}" required>
                                            </div>
                                            <div class="col-4">
                                                @if(request()->input('eartag') != '')
                                                <select name="warna_eartag" class="form-control" required>
                                                    <option value="">Pilih Warna Eartag</option>
                                                    @foreach($warna_eartag_list as $warna)
                                                    <option value="{{ $warna }}" {{ $warna == request()->input('warna_eartag') ? 'selected' : '' }}>{{ ucfirst($warna) }}</option>
                                                    @endforeach
                                                </select>
                                                @endif
                                            </div>
                                            <div class="col-1">
                                                <!-- Tombol Cari -->
                                                <button type="submit" class="btn btn-block" style="background-color: #0F382A; color: white; border: none;" id="btn-cari">Cari</button>
                                                <!-- Tombol Cari Lagi -->
                                                <a href="javascript:void(0)" class="btn btn-primary" style="background-color: #1c3494; color: white; border: none; display: none; font-size: 12px; padding: 9px 11px;" id="btn-cari-lagi">Cari Lagi</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tabel Riwayat Domba -->
                    @if(request()->has('eartag') && request()->has('warna_eartag'))
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary w-100">Riwayat Domba</h6>
                                </div>
                                <div class="table-responsive p-3">
                                    <table class="table table-hover text-center" id="dataTableHover">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Tanggal</th>
                                                <th>Kategori</th>
                                                <th>Deskripsi</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(!empty($riwayatDomba) && count($riwayatDomba) > 0)
                                            @foreach($riwayatDomba as $index => $riwayat)
                                            <tr>
                                                <td>{{ $riwayat['tanggal'] }}</td>
                                                <td>{{ $riwayat['kategori'] }}</td>
                                                <td>{{ $riwayat['deskripsi'] }}</td>
                                                <td>
                                                    <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#historyModal{{ $index }}">Detail</button>
                                                </td>
                                            </tr>

                                            <!-- Modal Detail Per Item -->
                                            <div class="modal fade" id="historyModal{{ $index }}" tabindex="-1" role="dialog">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Detail Riwayat - {{ $riwayat['tanggal'] }}</h5>
                                                            <button type="button" class="close" data-dismiss="modal">
                                                                <span>&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p><strong>Kategori:</strong> {{ $riwayat['kategori'] }}</p>
                                                            <p><strong>Deskripsi:</strong> {{ $riwayat['deskripsi'] }}</p>
                                                            <p><strong>Oleh:</strong> {{ $riwayat['oleh'] }}</p>

                                                            <hr>
                                                            <h6>Data Sebelum:</h6>
                                                            <ul>
                                                                @forelse ($riwayat['data_sebelum'] as $key => $val)
                                                                <li><strong>{{ ucfirst(str_replace('_', ' ', $key)) }}:</strong> {{ $val }}</li>
                                                                @empty
                                                                <li><em>Tidak ada data</em></li>
                                                                @endforelse
                                                            </ul>

                                                            <h6>Data Setelah:</h6>
                                                            <ul>
                                                                @forelse ($riwayat['data_setelah'] as $key => $val)
                                                                <li><strong>{{ ucfirst(str_replace('_', ' ', $key)) }}:</strong> {{ $val }}</li>
                                                                @empty
                                                                <li><em>Tidak ada data</em></li>
                                                                @endforelse
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                            @else
                                            <tr>
                                                <td colspan="4">Belum ada riwayat untuk Eartag dan warna ini.</td>
                                            </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Modal -->
                    <div class="modal fade" id="historyModal" tabindex="-1" role="dialog" aria-labelledby="historyModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="historyModalLabel">Detail Riwayat</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p><strong>Tanggal:</strong> <span id="modalTanggal"></span></p>
                                    <p><strong>Kategori:</strong> <span id="modalKategori"></span></p>
                                    <p><strong>Deskripsi:</strong> <span id="modalDeskripsi"></span></p>

                                    <div id="modalDataSebelum">
                                        <p><strong>Data Sebelum:</strong></p>
                                        <ul id="modalSebelumList"></ul>
                                    </div>

                                    <div id="modalDataSetelah">
                                        <p><strong>Data Setelah:</strong></p>
                                        <ul id="modalSetelahList"></ul>
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


    <!-- Page level custom scripts -->
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $('#dataTableHover').DataTable(); // Inisialisasi DataTable
            }, 500); // Menunggu sedikit agar tabel sudah sepenuhnya ter-render
        });
    </script>


    <script>
        $('#historyModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Tombol yang diklik
            var tanggal = button.data('tanggal');
            var kategori = button.data('kategori');
            var deskripsi = button.data('deskripsi');
            var dataSebelum = button.data('sebelum') || {};
            var dataSetelah = button.data('setelah') || {};

            $('#modalTanggal').text(tanggal);
            $('#modalKategori').text(kategori);
            $('#modalDeskripsi').text(deskripsi);

            // Data Sebelum
            var sebelumList = '';
            for (var key in dataSebelum) {
                if (dataSebelum.hasOwnProperty(key)) {
                    sebelumList += `<li><strong>${key}:</strong> ${dataSebelum[key]}</li>`;
                }
            }
            $('#modalSebelumList').html(sebelumList || '<li>-</li>');

            // Data Setelah
            var setelahList = '';
            for (var key in dataSetelah) {
                if (dataSetelah.hasOwnProperty(key)) {
                    setelahList += `<li><strong>${key}:</strong> ${dataSetelah[key]}</li>`;
                }
            }
            $('#modalSetelahList').html(setelahList || '<li>-</li>');
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var eartagInput = document.querySelector('input[name="eartag"]');
            var warnaSelect = document.querySelector('select[name="warna_eartag"]');
            var btnCari = document.getElementById('btn-cari');
            var btnCariLagi = document.getElementById('btn-cari-lagi');
            var resultsTable = document.querySelector('.table-responsive'); // Pastikan tabel hasil pencarian ada di sini

            // Cek jika ada nilai pada eartag dan warna_eartag
            if (eartagInput.value !== '' && warnaSelect.value !== '') {
                // Sembunyikan tombol Cari
                if (btnCari) {
                    btnCari.style.display = 'none';
                }

                // Tampilkan tombol Cari Lagi jika ada hasil pencarian
                if (btnCariLagi) {
                    btnCariLagi.style.display = 'inline-block';
                }

                // Tampilkan tabel hasil pencarian jika ada
                if (resultsTable && resultsTable.children.length > 0) {
                    resultsTable.style.display = 'block'; // Pastikan tabel ditampilkan
                }
            } else {
                // Jika input eartag atau warna kosong, tampilkan tombol Cari
                if (btnCari) {
                    btnCari.style.display = 'inline-block';
                }

                // Sembunyikan tombol Cari Lagi jika tidak ada hasil
                if (btnCariLagi) {
                    btnCariLagi.style.display = 'none';
                }

                // Sembunyikan tabel jika tidak ada pencarian
                if (resultsTable) {
                    resultsTable.style.display = 'none';
                }
            }

            // Jika tombol "Cari Lagi" diklik, reset halaman dan kembali ke URL /history
            if (btnCariLagi) {
                btnCariLagi.addEventListener('click', function(event) {
                    // Arahkan ke halaman /history
                    window.location.href = '/history';
                });
            }
        });
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