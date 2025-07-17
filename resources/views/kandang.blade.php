<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <link href="{{ asset('img/logo/domba.png') }}" rel="icon">
  <title>@yield('title', 'Denah Kandang')</title>

  <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('css/ruang-admin.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

  <style>
    .denah-container {
      display: grid;
      grid-template-columns: 0.5fr 2fr 0.5fr 2fr 0.5fr;
      grid-template-rows: repeat(4, 200px);
      gap: 2px;
      background-color: #FFFFFF;
      padding: 20px;
      position: relative;
    }

    .jalan {
      color: black;
      background-color: yellow;
      border: 1px solid #000;
      writing-mode: vertical-rl;
      text-align: center;
      font-weight: bold;
      display: flex;
      justify-content: center;
      align-items: center;
      grid-column: 3 / 4;
      /* Tengah */
      grid-row: 1 / 5;
      /* Menyambung dari baris 1 sampai 4 */
      z-index: 1;
    }

    .kandang {
      border: 1px solid #000;
      background-color: white;
      font-weight: bold;
      display: flex;
      align-items: center;
      justify-content: center;
      color: black;
      padding: 10px;
      margin: 5px;
      text-align: center;
      border-radius: 5px;
    }

    .sekat {
      writing-mode: vertical-rl;
      text-align: center;
      font-weight: bold;
      border: 1px solid #000;
      display: flex;
      align-items: center;
      justify-content: center;
      color: black;
    }

    .kandang {
      padding: 10px;
      margin: 5px;
      text-align: center;
      border-radius: 5px;
    }

    .sekat.tersedia {
      background-color: #ffffff !important;
      /* Hijau */
      color: white;
    }

    .sekat.terisi {
      background-color: #28a745 !important;
      /* Kuning */
      color: white;
    }

    .legend-box {
      display: flex;
      gap: 2px;
      padding-left: 20px;
    }

    .legend-item {
      display: flex;
      align-items: center;
      gap: 5px;
      padding-left: 20px;
    }

    .legend-color {
      width: 15px;
      height: 15px;
      background-color: grey;
      /* Ini penting: biar kotak, jangan kasih border-radius */
    }

    @keyframes blinkAvailable {
      0% {
        background-color: #ffffff;
      }

      /* putih */
      50% {
        background-color: #f0f0f0;
      }

      /* abu terang */
      100% {
        background-color: #ffffff;
      }
    }

    .kandang.terisi,
    .sekat.terisi {
      color: white;
      animation: blinkGreen 1s infinite;
      /* Hapus !important dari background-color */
    }

    @keyframes blinkGreen {
      0% {
        background-color: #28a745;
      }

      50% {
        background-color: #218838;
      }

      100% {
        background-color: #28a745;
      }
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
            <h1 class="h3 mb-0 text-gray-800">Denah Kandang</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Halaman Utama</a></li>
              <li class="breadcrumb-item active" aria-current="page">Denah Kandang</li>
            </ol>
          </div>

          <!-- DataTable with Hover -->
          <div class="col-lg-12">
            <div class="card mb-4">
              <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Berikut adalah denah kandang beserta sekat dan jalan:</h6>
              </div>
              <!-- Legend Box -->
              <div class="legend-box">
                <div class="legend-item">
                  <div class="legend-color" style="background-color: #28a745;"></div> Terisi
                </div>
                <div class="legend-item">
                  <div class="legend-color" style="background-color: #ffffff; border: 1px solid #ccc;"></div> Tersedia
                </div>
              </div>

              <div class="card-body denah-container">
                <!-- Baris 1 -->
                <div class="sekat" data-id="Sekat 1">Sekat 1</div>
                <div class="kandang" data-id="Koloni 1">Koloni 1</div>
                <!-- Jalan akan menempati semua baris -->
                <div class="kandang" data-id="Koloni 2">Koloni 2</div>
                <div class="sekat" data-id="Sekat 2">Sekat 2</div>

                <!-- Baris 2 -->
                <div class="sekat" data-id="Sekat 3">Sekat 3</div>
                <div class="kandang" data-id="Koloni 3">Koloni 3</div>
                <div class="kandang" data-id="Koloni 4">Koloni 4</div>
                <div class="sekat" data-id="Sekat 4">Sekat 4</div>

                <!-- Baris 3 -->
                <div class="sekat" data-id="Sekat 5">Sekat 5</div>
                <div class="kandang" data-id="Koloni 5">Koloni 5</div>
                <div class="kandang" data-id="Koloni 6">Koloni 6</div>
                <div class="sekat" data-id="Sekat 6">Sekat 6</div>

                <!-- Baris 4 -->
                <div class="sekat" data-id="Sekat 7">Sekat 7</div>
                <div class="kandang" data-id="Koloni 7">Koloni 7</div>
                <div class="kandang" data-id="Koloni 8">Koloni 8</div>
                <div class="sekat" data-id="Sekat 8">Sekat 8</div>

                <!-- Jalan (Hanya 1x) -->
                <div class="jalan">Jalan</div>
              </div>
            </div>
          </div>

          <!-- Modal Detail Kandang -->
          <div class="modal fade" id="kandangDetailModal" tabindex="-1" role="dialog" aria-labelledby="kandangDetailModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="kandangDetailModalLabel">Detail Kandang - <span id="nama_kandang">
                      << /h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                          <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                  <p><strong>Kapasitas Maksimum:</strong> <span id="kapasitas_maks"></span></p>
                  <p><strong>Status:</strong> <span id="status"></span></p>
                  <table class="table table-bordered text-center">
                    <thead class="thead-light">
                      <tr>
                        <th>No</th>
                        <th>Eartag</th>
                      </tr>
                    </thead>
                    <tbody id="eartagDombaTbody">
                      <!-- Eartag Domba akan ditampilkan di sini -->
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

    <!-- Page level custom scripts -->
    <script>
      $(document).ready(function() {
        $('#dataTable').DataTable(); // ID untuk DataTable utama
        $('#dataTableHover').DataTable(); // ID untuk DataTable dengan efek hover
      });
    </script>

    <script>
      document.addEventListener('DOMContentLoaded', function() {
        // Ambil semua kandang dan sekat
        const kandangs = document.querySelectorAll('.kandang, .sekat');

        // Ambil data status dari backend
        fetch('/api/denahkandang')
          .then(response => response.json())
          .then(data => {
            data.forEach(kandangData => {
              const namaKandang = kandangData.nama_kandang;
              const status = kandangData.status;

              // Cari elemen HTML yang sesuai nama_kandang
              const elemen = Array.from(kandangs).find(el => el.getAttribute('data-id') === namaKandang);

              if (elemen) {
                elemen.setAttribute('data-status', status);

                if (status === 'Tersedia') {
                  elemen.classList.add('tersedia');
                  elemen.classList.remove('terisi');
                } else if (status === 'Terisi') {
                  elemen.classList.add('terisi');
                  elemen.classList.remove('tersedia');
                }
              }
            });
          })
          .catch(error => {
            console.error('Error ambil status kandang:', error);
          });

        // Klik untuk lihat detail kandang
        kandangs.forEach(function(elemen) {
          elemen.addEventListener('click', function() {
            const elemenId = this.getAttribute('data-id');

            fetch(`/denahkandang/${encodeURIComponent(elemenId)}`)
              .then(response => response.json())
              .then(data => {
                if (data.error) {
                  alert(data.error);
                  return;
                }

                // Menampilkan data di modal
                document.getElementById('nama_kandang').textContent = data.nama_kandang;
                document.getElementById('kapasitas_maks').textContent = data.kapasitas_maks;
                document.getElementById('status').textContent = data.status;

                // Menampilkan Eartag Domba
                const eartagDombaTbody = document.getElementById('eartagDombaTbody');
                eartagDombaTbody.innerHTML = ''; // Reset isi tabel sebelum diisi

                if (data.eartag_domba.length > 0) {
                  data.eartag_domba.forEach((eartag, index) => {
                    const row = document.createElement('tr');

                    // Tentukan kelas warna berdasarkan warna_eartag
                    let badgeClass = 'badge-secondary'; // Default

                    switch (eartag.warna_eartag.toLowerCase()) {
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
                        // Tambahkan warna lain sesuai kebutuhan
                      default:
                        badgeClass = 'badge-secondary'; // default jika warna tidak dikenal
                    }

                    // Update baris dengan warna badge yang sesuai
                    row.innerHTML = `<td>${index + 1}</td><td><span class="badge ${badgeClass}">${eartag.eartag}</span></td>`;
                    eartagDombaTbody.appendChild(row);
                  });
                } else {
                  const row = document.createElement('tr');
                  row.innerHTML = `<td colspan="2">Tidak ada domba dalam kandang ini.</td>`;
                  eartagDombaTbody.appendChild(row);
                }

                $('#kandangDetailModal').modal('show');
              })
              .catch(error => {
                console.error('Error:', error);
                alert('Gagal mengambil data.');
              });
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