<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <link href="{{ asset('img/logo/domba.png') }}" rel="icon">
  <title>@yield('title', 'Login')</title>

  <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('css/ruang-admin.min.css') }}" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@600&display=swap" rel="stylesheet">

  <style>
    body {
      position: relative;
      background: url("{{ asset('page/img/carousel-1.jpg') }}") no-repeat center center fixed;
      background-size: cover;
      height: 100vh;
      width: 100%;
      height: 100%;
    }

    body::before {
      content: "";
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.5);
      z-index: 0;
    }


    .input-group .form-control {
      border-left: none;
    }

    .btn-success {
      background-color: #0F382A;
      border: none;
      transition: background-color 0.3s ease;
    }

    .btn-success:hover {
      background-color: #0c2f23;
    }

    input::placeholder {
      font-weight: 400;
      color: #999;
    }

    .toggle-password i {
      color: #6c757d;
    }

    .fw-bold {
      font-weight: 600;
    }
  </style>
</head>

<body>
  <!-- Login Content -->
  <div class="container-login">
    <div class="row justify-content-center">
      <div class="col-xl-5 col-lg-5 col-md-5">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <!-- Logo -->
                    <img src="{{ asset('img/logo/dombaku.png') }}" alt="Logo DombaKu" class="mb-3" width="100">

                    <!-- Judul -->
                    <h3 class="font-weight-bold" style="color: #000000;">
                      Selamat Datang di <span style="color: #0F382A; font-family: 'Exo 2', sans-serif; font-weight: 600;">DombaKu</span>
                    </h3>
                  </div>

                  <!-- Form Login -->
                  <form action="{{ url('/login') }}" method="POST" class="user">
                    @csrf

                    <!-- Email -->
                    <div class="form-group mb-3">
                      <div class="input-group">
                        <span class="input-group-text bg-white"><i class="fas fa-envelope text-muted"></i></span>
                        <input type="email" name="email" class="form-control" placeholder="Enter Email" required>
                      </div>
                    </div>

                    <!-- Password -->
                    <div class="form-group mb-3 position-relative">
                      <div class="input-group">
                        <span class="input-group-text bg-white"><i class="fas fa-lock text-muted"></i></span>
                        <input type="password" name="password" id="passwordLogin" class="form-control" placeholder="Password" required>
                        <span class="input-group-text toggle-password" toggle="#passwordLogin" style="cursor: pointer;">
                          <i class="fas fa-eye"></i>
                        </span>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Remember Me</label>
                      </div>
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-block" style="background-color: #0F382A; color: white;">Masuk</button>
                    </div>

                    <div class="text-center mt-3">
                      Belum punya akun? <a href="{{ url('/register') }}" style="color: #0F382A;">Daftar di sini</a>
                    </div>

                    @if ($errors->any())
                    <div class="alert alert-danger">
                      <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                      </ul>
                    </div>
                    @endif
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- JavaScript -->
  <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
  <script src="{{ asset('js/ruang-admin.min.js') }}"></script>

  <script>
    document.querySelectorAll('.toggle-password').forEach(function(element) {
      element.addEventListener('click', function() {
        const input = document.querySelector(this.getAttribute('toggle'));
        const icon = this.querySelector('i');
        if (input.type === 'password') {
          input.type = 'text';
          icon.classList.remove('fa-eye');
          icon.classList.add('fa-eye-slash');
        } else {
          input.type = 'password';
          icon.classList.remove('fa-eye-slash');
          icon.classList.add('fa-eye');
        }
      });
    });
  </script>
</body>

</html>