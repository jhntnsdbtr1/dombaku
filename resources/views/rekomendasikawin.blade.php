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
    <title>@yield('title', 'Rekomendasi Kawin')</title>

    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/ruang-admin.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/css/select2.min.css') }}" rel="stylesheet">

    <!-- AOS CSS -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

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

        #form-rekomendasi button:hover {
            background-color: #0c2e22;
            border-color: #0c2e22;
            transform: scale(1.02);
        }

        #form-rekomendasi {
            padding: 25px;
            background-color: #f8f9fa;
        }

        #hasil-rekomendasi {
            margin-top: 30px;
        }

        #loading-rekomendasi {
            display: none;
        }

        #pohon-container {
            display: none;
        }

        .btn-custom {
            background-color: #0F382A;
            border: none;
        }

        .btn-custom:hover {
            background-color: #0b2e21;
        }

        /* Animation Transitions */
        .table,
        .chart-container {
            transition: transform 0.5s ease-in-out, opacity 0.5s ease-in-out;
        }

        .btnLanjutkanSemuaRekomendasi {
            display: none;
            font-size: 16px;
            /* Ukuran font */
            padding: 10px 20px;
            /* Padding untuk ukuran tombol */
            border-radius: 5px;
            /* Membuat sudut tombol sedikit membulat */
            position: absolute;
            /* Menempatkan tombol secara mutlak */
            right: 20px;
            /* Menempatkan tombol di kanan */
            bottom: 20px;
            /* Menempatkan tombol sedikit dari bawah */
            z-index: 9999;
            /* Menjamin tombol di atas elemen lainnya */
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
                    <img src="{{ asset('img/logo/dombakuh.png') }}">
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
                        <h1 class="h3 mb-0 text-gray-800">Rekomendasi Perkawinan</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./">Halaman Utama</a></li>
                            <li class="breadcrumb-item">Perkawinan</li>
                            <li class="breadcrumb-item active" aria-current="page">Rekomendasi Kawin Domba</li>
                        </ol>
                    </div>

                    <div class="container mt-5">
                        <div class="card shadow-lg p-4 rounded-lg">
                            <h5 class="text-center mb-4 ">Cari Pasangan Domba Sekarang</h5>
                            <form id="form-rekomendasi" class="p-4 rounded shadow-sm" style="background-color: #f8f9fa;">
                                <div class="form-group mb-3">
                                    <label for="id_jantan" class="font-weight-bold text-primary">Masukkan ID Domba Jantan:</label>
                                    <input
                                        type="text"
                                        class="form-control rounded-pill px-4 py-2"
                                        id="id_jantan"
                                        name="id_jantan"
                                        placeholder="Contoh: 007"
                                        required
                                        style="font-size: 1rem;">
                                </div>

                                <div class="d-flex justify-content-end">
                                    <button type="submit"
                                        class="btn btn-sm text-white rounded-pill px-3 py-2 d-flex align-items-center gap-2"
                                        style="background-color: #0F382A; border: none;">
                                        <i class="fas fa-search"></i> Cari Rekomendasi
                                    </button>
                                </div>
                            </form>

                            <!-- Spinner Loading -->
                            <div id="loading-rekomendasi" class="text-center mt-4" style="display: none;">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                                <p class="mt-2">🔍 Sedang mencari rekomendasi, mohon tunggu...</p>
                            </div>

                            <!-- Hasil Rekomendasi -->
                            <div id="hasil-rekomendasi" class="mt-5"></div>

                            <!-- Tombol untuk membuka modal -->
                            <div class="d-flex justify-content-end mt-3">
                                <div class="me-2">
                                    <button class="btn btn-primary" id="btnCariLagi" style="display: none;">Cari Lagi</button>
                                </div>
                                <div class="ms-2">
                                    <button class="btn btn-success" id="btnLanjutkanSemua" data-id_jantan="{{ session('id_jantan') }}" style="display: none;">Lanjutkan</button>
                                </div>
                            </div>

                            <!-- Chart Skor Kecocokan -->
                            <div id="chart-skor-container" class="mt-5 text-center" style="display: none;">
                                <h4>Visualisasi Skor Kecocokan Kawin Domba</h4>
                                <canvas id="chartSkor" style="max-height: 400px;"></canvas>
                            </div>

                            <!-- Chart Inbreeding -->
                            <div id="chart-inbreed-container" class="mt-5 text-center" style="display: none; ">
                                <h4>Visualisasi Data Inbreeding Domba</h4>
                                <canvas id="chartInbreeding" style="max-height: 400px;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Container Fluid -->

                <!-- Modal Lanjutkan SEMUA -->
                <div class="modal fade" id="modalLanjutkanSemua" tabindex="-1" aria-labelledby="modalLanjutkanSemuaLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form id="formLanjutkanSemua" method="POST" action="{{ route('lanjutkan.manajemenperkawinan') }}">
                            @csrf
                            <input type="hidden" name="id_jantan" value="{{ session('id_jantan') }}">
                            <input type="hidden" name="source" value="modal_lanjutkan_semua">

                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Lanjutkan Semua Rekomendasi</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label>Kandang</label>
                                        <input type="text" class="form-control" name="kandang" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Tanggal Mulai</label>
                                        <input type="date" class="form-control" name="tanggal_mulai" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Tanggal Selesai</label>
                                        <input type="date" class="form-control" name="tanggal_selesai" required>
                                    </div>

                                    <div id="hidden-betina-inputs"></div> <!-- Tempat inject hidden input dari JS -->

                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary" style="background-color: #0F382A; color: white; border: none;">Simpan</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                </div>
                            </div>
                        </form>
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

    <!-- AOS JS -->
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>

    <script>
        console.log("jQuery version:", $.fn.jquery);
    </script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        $(document).ready(function() {
            AOS.init();

            let chartSkor = null;
            let chartInbreeding = null;

            $('#form-rekomendasi').on('submit', function(e) {
                e.preventDefault();
                let idJantan = $('#id_jantan').val().trim();

                if (!idJantan) {
                    alert('Mohon masukkan ID Jantan.');
                    return;
                }

                $('#loading-rekomendasi').show();
                $('#hasil-rekomendasi').html('');
                $('#btnLanjutkanSemua').hide(); // Sembunyikan tombol "Lanjutkan Semua" saat loading

                $('#chart-skor-container').fadeOut();
                $('#chart-inbreed-container').fadeOut();

                $.ajax({
                    url: "{{ route('rekomendasi.kawin') }}",
                    method: "POST",
                    data: {
                        id_jantan: idJantan,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        console.log('Respon:', response);

                        let rekomendasi = response.rekomendasi || [];

                        // 🔽 Tambahkan baris ini agar filteredData terisi!
                        filteredData = rekomendasi;

                        if (rekomendasi.length === 0) {
                            $('#hasil-rekomendasi').html('<p class="text-danger">ID Jantan tidak ditemukan.</p>');
                            $('#loading-rekomendasi').hide();
                            return;
                        }

                        if (filteredData.length === 0) {
                            $('#hasil-rekomendasi').html('<p class="text-warning">Tidak ada rekomendasi kawin dengan skor di atas 80%.</p>');
                        }

                        html = `
<h3 class="mt-4">Hasil Rekomendasi Kawin:</h3>
<div class="table-responsive p-3" data-aos="fade-up">
    <table class="table table-bordered table-hover text-center">
        <thead class="thead-light">
            <tr>
                <th>Eartag Jantan</th>
                <th>Eartag Betina</th>
                <th>Skor Kecocokan</th>
                <th>Status Inbreeding</th>
                <th>Checklist</th>
            </tr>
        </thead>
        <tbody>`;

                        filteredData.sort((a, b) => b.skor_kecocokan - a.skor_kecocokan);

                        filteredData.forEach((item, index) => {
                            // Badge warna eartag
                            const warnaBadgeJantan = warnaBadgeClass(item.warna_eartag_jantan);
                            const warnaBadgeBetina = warnaBadgeClass(item.warna_eartag_betina);

                            // Status dan badge inbreeding
                            const isAman = item.koefisien_inbreeding === 1;
                            const labelInbreeding = isAman ? "Aman Kawin" : "Berisiko Inbreeding";
                            const badgeInbreeding = isAman ? "badge-success" : "badge-danger";

                            html += `
                            <tr>
                                <td><span class="badge ${warnaBadgeJantan}">${item.id_jantan}</span></td>
                                <td><span class="badge ${warnaBadgeBetina}">${item.id_betina}</span></td>
                                <td>${(item.skor_kecocokan * 100).toFixed(2)}%</td>
                                <td><span class="badge ${badgeInbreeding}">${labelInbreeding}</span></td>
                                <td>
                                    <input type="checkbox" class="pilih-betina" id="betina_${index}" data-id="${item.id_betina}">
                                </td>
                            </tr>`;
                        });

                        html += `
                                </tbody>
                            </table>
                        </div>`;

                        $('#hasil-rekomendasi').html(html);

                        // Inisialisasi data chart
                        let labels = filteredData.map(item => item.id_betina);
                        let dataSkor = filteredData.map(item => item.skor_kecocokan);
                        let dataInbreeding = filteredData.map(item => item.inbreeding ? 1 : 0);

                        if (chartSkor) chartSkor.destroy();
                        if (chartInbreeding) chartInbreeding.destroy();

                        // Chart Skor Kecocokan
                        let ctxSkor = document.getElementById('chartSkor').getContext('2d');
                        chartSkor = new Chart(ctxSkor, {
                            type: 'bar',
                            data: {
                                labels: labels,
                                datasets: [{
                                    label: 'Skor Kecocokan',
                                    data: dataSkor,
                                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                                    borderColor: 'rgba(54, 162, 235, 1)',
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                responsive: true,
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        max: 1,
                                        ticks: {
                                            callback: value => (value * 100).toFixed(0) + '%'
                                        }
                                    }
                                }
                            }
                        });

                        // Chart Inbreeding
                        let totalInbreeding = dataInbreeding.filter(x => x === 1).length;
                        let totalNoInbreeding = dataInbreeding.filter(x => x === 0).length;

                        let ctxInbreed = document.getElementById('chartInbreeding').getContext('2d');
                        chartInbreeding = new Chart(ctxInbreed, {
                            type: 'doughnut',
                            data: {
                                labels: ['Inbreeding', 'No Inbreeding'],
                                datasets: [{
                                    label: 'Status Inbreeding',
                                    data: [totalInbreeding, totalNoInbreeding],
                                    backgroundColor: [
                                        'rgba(255, 99, 132, 0.6)',
                                        'rgba(75, 192, 192, 0.6)'
                                    ],
                                    borderColor: [
                                        'rgba(255, 99, 132, 1)',
                                        'rgba(75, 192, 192, 1)'
                                    ],
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                responsive: true,
                                plugins: {
                                    legend: {
                                        position: 'bottom'
                                    },
                                    tooltip: {
                                        callbacks: {
                                            label: function(context) {
                                                const value = context.raw;
                                                const total = totalInbreeding + totalNoInbreeding;
                                                const percent = ((value / total) * 100).toFixed(1);
                                                return `${context.label}: ${value} (${percent}%)`;
                                            }
                                        }
                                    }
                                }
                            }
                        });

                        // Tampilkan chart
                        $('#chart-skor-container').fadeIn();
                        $('#chart-inbreed-container').fadeIn();

                        $('#loading-rekomendasi').hide();

                        // Tampilkan tombol lanjutkan setelah rekomendasi tampil
                        $('#btnCariLagi').fadeIn();
                        $('#btnLanjutkanSemua').fadeIn();

                        $('html, body').animate({
                            scrollTop: $("#hasil-rekomendasi").offset().top - 100
                        }, 600);
                    },
                    error: function(xhr) {
                        const message = xhr.responseJSON?.message || 'Terjadi kesalahan saat memproses.';
                        $('#hasil-rekomendasi').html(`<p class="text-danger">${message}</p>`);
                        $('#loading-rekomendasi').hide();
                        console.error('Error:', xhr);
                    }
                });
            });

            $(document).on('click', '#btnLanjutkanSemua', function() {
                const betinaIds = []; // Array untuk ID Betina terpilih
                $('#hidden-betina-inputs').html(''); // Kosongkan elemen input tersembunyi sebelumnya

                // Ambil ID Betina dari filteredData dan masukkan ke dalam array betinaIds
                $('.pilih-betina:checked').each(function() {
                    const idBetina = $(this).data('id');
                    betinaIds.push(idBetina);
                    $('#hidden-betina-inputs').append(`<input type="hidden" name="betina[]" value="${idBetina}">`);
                });

                // Pastikan bahwa betinaIds tidak kosong
                if (betinaIds.length === 0) {
                    alert('Tidak ada ID betina yang dipilih.');
                    return;
                }

                // Menampilkan modal
                const modal = new bootstrap.Modal(document.getElementById('modalLanjutkanSemua'));
                modal.show();
            });

            $(document).on('click', '#btnCariLagi', function() {
                location.reload(); // Ini akan menyegarkan halaman
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

        function warnaBadgeClass(warna) {
            warna = warna?.toLowerCase();
            switch (warna) {
                case 'putih':
                    return 'badge-putih';
                case 'merah':
                    return 'badge-merah';
                case 'biru':
                    return 'badge-biru';
                case 'hijau':
                    return 'badge-hijau';
                case 'kuning':
                    return 'badge-kuning';
                default:
                    return 'badge-secondary';
            }
        }
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