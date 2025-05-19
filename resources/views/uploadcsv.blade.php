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
    <title>@yield('title', 'Training Data')</title>

    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/ruang-admin.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

    <style>
        .btn-custom {
            background-color: #0F382A;
            color: white;
            border-radius: 25px;
            padding: 12px 40px;
            font-size: 1.1rem;
            transition: background-color 0.3s ease;
        }

        .btn-custom:hover {
            background-color: #0b2e21;
        }

        .alert {
            font-weight: bold;
        }

        /* Spinner styling */
        .spinner-container {
            display: none;
            text-align: center;
            margin-top: 20px;
        }

        .spinner-border {
            width: 3rem;
            height: 3rem;
        }

        .spinner-text {
            font-size: 1.2rem;
            font-weight: 600;
            margin-top: 15px;
        }

        /* Animations */
        .fade-in {
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
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
                                </span>
                            </a>
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
                        <h1 class="h3 mb-0 text-gray-800">Upload Data untuk Pelatihan Model</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./">Halaman Utama</a></li>
                            <li class="breadcrumb-item">Perkawinan</li>
                            <li class="breadcrumb-item active" aria-current="page">Upload Data Pelatihan</li>
                        </ol>
                    </div>

                    <!-- Card for upload form -->
                    <div class="container mt-5">
                        <div class="card shadow-lg p-4 rounded-lg fade-in">
                            <h5 class="text-center mb-4">Upload File CSV untuk Melatih Model Rekomendasi Kawin Domba</h5>
                            <p class="text-center mb-4">Pilih file CSV yang berisi data untuk melatih model rekomendasi kawin domba.</p>

                            <form id="uploadForm" action="{{ route('upload.rekomendasi') }}" method="POST" enctype="multipart/form-data" class="form-group">
                                @csrf

                                <!-- File input field -->
                                <div class="form-group">
                                    <label for="csv_file" class="font-weight-bold text-primary">Pilih file CSV:</label>
                                    <input type="file" class="form-control-file border rounded-pill p-3" name="csv_file" accept=".csv" required>
                                </div>

                                <!-- Submit button -->
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-sm text-white rounded-pill px-3 py-2 d-flex align-items-center gap-2" style="background-color: #0F382A; border: none;">
                                        <i class="fas fa-upload"></i> Upload Data
                                    </button>
                                </div>
                            </form>

                            <!-- Spinner loading ketika file sedang diproses -->
                            <div id="processing" class="mt-3 text-center" style="display: none;">
                                <div class="spinner-border text-primary" role="status"></div>
                                <div class="spinner-text text-secondary">Sedang Memproses Data...</div>
                            </div>

                            <!-- Menampilkan pesan sukses/error setelah upload -->
                            @if(session('upload_message'))
                            <div class="alert alert-success mt-4 text-center" role="alert">
                                {{ session('upload_message') }}
                            </div>
                            @endif

                            @if(session('error_message'))
                            <div class="alert alert-danger mt-4 text-center" role="alert">
                                {{ session('error_message') }}
                            </div>
                            @endif
                        </div>
                    </div>
                    <!-- Container Fluid -->
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
            $('#dataTable').DataTable(); // ID untuk DataTable utama
            $('#dataTableHover').DataTable(); // ID untuk DataTable dengan efek hover
        });
    </script>

    <!-- Script untuk menampilkan spinner selama proses upload -->
    <script>
        document.getElementById("uploadForm").addEventListener("submit", function() {
            document.getElementById("processing").style.display = "block"; // Tampilkan spinner
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