<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link href="{{ asset('img/logo/domba.png') }}" rel="icon">
    <title>@yield('title', 'Users')</title>

    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/ruang-admin.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/css/select2.min.css') }}" rel="stylesheet">


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
                        <h1 class="h3 mb-0 text-gray-800">Manajemen Pengguna</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./">Home</a></li>
                            <li class="breadcrumb-item">Tables</li>
                            <li class="breadcrumb-item active" aria-current="page">Manajemen Pengguna</li>
                        </ol>
                    </div>

                    <div class="row">
                        <!-- DataTable with Hover -->
                        <div class="col-lg-12">
                            <div class="card mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary w-100">Daftar Pengguna</h6>
                                    <button type="button" class="btn btn-sm btn-success d-flex align-items-center" data-toggle="modal" data-target="#tambahModal">
                                        <i class="fas fa-plus mr-2"></i> Tambah
                                    </button>
                                </div>
                                <div class="table-responsive p-3">
                                    <table class="table align-items-center table-flush table-hover text-center" id="dataTableHover">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>ID</th>
                                                <th>Email</th>
                                                <th>Username</th>
                                                <th>Role</th> <!-- Tambahkan kolom Role -->
                                                <th>Status</th>
                                                <th>Created At</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($userList as $user)
                                            <tr>
                                                <td>{{ $user['id'] }}</td> <!-- ID sudah diambil di controller -->
                                                <td>{{ $user['email'] }}</td>
                                                <td>{{ $user['username'] }}</td>
                                                <td>{{ $user['role'] }}</td>
                                                <td>
                                                    <span class="badge {{ $user['status'] == 'Aktif' ? 'badge-success' : 'badge-danger' }}">
                                                        {{ $user['status'] }}
                                                    </span>
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($user['createdAt'])->format('d-m-Y H:i:s') }}</td>
                                                <td class="text-center">
                                                    <div class="d-inline-flex">
                                                        <!-- Button Detail -->
                                                        <button class="btn btn-sm btn-primary mr-2" data-toggle="modal" data-target="#detailModal" data-id="{{ $user['id'] }}">Detail</button>

                                                        <!-- Button Edit -->
                                                        <button class="btn btn-sm btn-warning mr-2 edit-btn" data-toggle="modal" data-target="#editModal" data-id="{{ $user['id'] }}">Edit</button>

                                                        <!-- Button Hapus -->
                                                        <button class="btn btn-sm btn-danger delete-btn" data-id="{{ $user['id'] }}">Hapus</button>
                                                    </div>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="7">Tidak ada data pengguna</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal untuk Menambah Pengguna -->
            <div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="tambahModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="tambahModalLabel">Tambah Pengguna</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="formTambah" method="POST" action="/add-user">
                            @csrf
                            <div class="modal-body">
                                <!-- Form fields -->
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email" required>
                                </div>

                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" required>
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-outline-secondary toggle-password">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Tambahkan Input Username -->
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username" required>
                                </div>

                                <div class="form-group">
                                    <label for="role">Role</label>
                                    <select class="form-control" id="role" name="role" required>
                                        <option value="Admin">Admin</option>
                                        <option value="User">User</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control" id="status" name="status" required>
                                        <option value="Aktif">Aktif</option>
                                        <option value="Non-Aktif">Non-Aktif</option>
                                    </select>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-success">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal untuk Menampilkan Detail Pengguna -->
            <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="detailModalLabel">Detail Pengguna</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p><strong>Email:</strong> <span id="detailEmail"></span></p>
                            <p><strong>Username:</strong> <span id="detailUsername"></span></p>
                            <p><strong>Role:</strong> <span id="detailRole"></span></p>
                            <p><strong>Status:</strong> <span id="detailStatus"></span></p>
                            <p><strong>Created At:</strong> <span id="detailCreatedAt"></span></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal untuk Mengedit Pengguna -->
            <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel">Edit Pengguna</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="formEdit" method="POST">
                            @csrf
                            @method('PATCH') <!-- Tambahkan ini -->

                            <div class="modal-body">
                                <!-- Form fields -->
                                <input type="hidden" id="editUserId" name="user_id">
                                <div class="form-group">
                                    <label for="editEmail">Email</label>
                                    <input type="email" class="form-control" id="editEmail" name="email" required>
                                </div>

                                <div class="form-group">
                                    <label for="editUsername">Username</label>
                                    <input type="text" class="form-control" id="editUsername" name="username" required>
                                </div>

                                <div class="form-group">
                                    <label for="editRole">Role</label>
                                    <select class="form-control" id="editRole" name="role" required>
                                        <option value="Admin">Admin</option>
                                        <option value="User">User</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="editStatus">Status</label>
                                    <select class="form-control" id="editStatus" name="status" required>
                                        <option value="Aktif">Aktif</option>
                                        <option value="Non-Aktif">Non-Aktif</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="editPassword">Password</label>
                                    <input type="password" class="form-control" id="editPassword" name="password" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-success">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

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

    <!-- Page level plugins -->
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script>
        $(document).ready(function() {
            $('#dataTableHover').DataTable(); // Hanya menggunakan #dataTableHover
        });
    </script>


    <script>
        $(document).ready(function() {
            // Menambahkan pengguna
            $('#formTambah').on('submit', function(e) {
                e.preventDefault(); // Mencegah form dikirim langsung

                let formData = {
                    email: $('#email').val(),
                    password: $('#password').val(),
                    role: $('#role').val(),
                    status: $('#status').val(),
                    username: $('#username').val(),
                    _token: $('meta[name="csrf-token"]').attr('content') // CSRF Token
                };

                $.ajax({
                    url: '/add-user',
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        alert(response.message);
                        $('#formTambah')[0].reset();
                        $('#tambahModal').modal('hide');
                        window.location.reload();
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan: ' + xhr.responseText);
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // Lihat Detail Pengguna
            $(document).on('click', '.detail-btn', function() {
                let userId = $(this).data('id');
                console.log("User ID:", userId);

                $.ajax({
                    url: `/users/${userId}`,
                    method: 'GET',
                    success: function(response) {
                        console.log('Response:', response);
                        if (response && response.email) {
                            $('#detailModal .modal-body').html(`
                            <p>Email: ${response.email.stringValue ?? 'Tidak ada email'}</p>
                            <p>Username: ${response.username?.stringValue ?? 'Tidak ada username'}</p>
                            <p>Role: ${response.role?.stringValue ?? 'Tidak ada role'}</p>
                            <p>Status: ${response.status?.stringValue ?? 'Tidak ada status'}</p>
                        `);
                            $('#detailModal').modal('show'); // Tampilkan modal
                        } else {
                            alert('Data pengguna tidak ditemukan');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log('AJAX Error:', error);
                        alert('Terjadi kesalahan saat mengambil detail pengguna.');
                    }
                });
            });

            $(document).on('click', '.edit-btn', function() {
                let userId = $(this).data('id');
                console.log("Edit User ID:", userId);

                $.ajax({
                    url: `/users/${userId}`, // GET Request ke server
                    method: 'GET',
                    success: function(response) {
                        console.log('Response Edit:', response);
                        if (response && response.email) {
                            // Mengisi form dengan data pengguna
                            $('#editUserId').val(userId);
                            $('#editEmail').val(response.email?.stringValue ?? '');
                            $('#editUsername').val(response.username?.stringValue ?? '');
                            $('#editRole').val(response.role?.stringValue ?? '');
                            $('#editStatus').val(response.status?.stringValue ?? '');

                            // Tampilkan modal edit
                            $('#editModal').modal('show');
                        } else {
                            alert('Data pengguna tidak ditemukan');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log('AJAX Error:', error);
                        alert('Terjadi kesalahan saat mengambil data pengguna.');
                    }
                });
            });


            $('#formEdit').submit(function(event) {
                event.preventDefault();
                let userId = $('#editUserId').val();

                $.ajax({
                    url: `/users/${userId}`,
                    method: 'PUT', // PUT untuk update
                    data: $(this).serialize(),
                    success: function(response) {
                        alert(response.message);
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.log('AJAX Error:', error);
                        alert('Terjadi kesalahan saat memperbarui data pengguna.');
                    }
                });
            });


            $(document).on('click', '.delete-btn', function() {
                let userId = $(this).data('id');

                if (!userId || userId.trim() === '') {
                    alert('User ID tidak valid.');
                    return;
                }

                if (confirm('Apakah Anda yakin ingin menghapus pengguna ini?')) {
                    $.ajax({
                            url: `/users/${userId}`,
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Ambil CSRF token dari meta tag
                            }
                        })
                        .done(function(response) {
                            alert(response.message);
                            window.location.reload(true); // Paksa reload tanpa cache
                        })
                        .fail(function(xhr) {
                            console.error("AJAX Error:", xhr.status, xhr.responseText);
                            alert('Terjadi kesalahan saat menghapus pengguna.');
                        });
                }
            });
        });
    </script>
</body>

</html>