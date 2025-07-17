<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="">
    <meta name="description" content="">

    <link href="{{ asset('img/logo/domba.png') }}" rel="icon">
    <title>@yield('title', 'DombaKu')</title>

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:wght@700&family=Open+Sans:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('page/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('page/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('page/lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('page/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('page/css/style.css') }}" rel="stylesheet">

    <style>
        .video-container {
            position: relative;
            width: 100%;
            height: 100vh;
            /* Video fullscreen */
            overflow: hidden;
        }

        #bg-video {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4);
            /* Efek gelap supaya teks terbaca */
        }

        .video-caption {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: white;
        }

        .video-caption h1 {
            font-size: 38px;
            font-weight: bold;
        }

        .video-caption p {
            font-size: 25px;
        }

        /* Responsive untuk mobile */
        @media (max-width: 768px) {
            .video-caption h1 {
                font-size: 28px;
            }

            .video-caption p {
                font-size: 16px;
            }
        }

        .container-xxl {
            color: #0F382A;
        }

        .text-primary {
            color: #0F382A !important;
        }

        h1,
        h2,
        h5,
        span {
            color: #0F382A;
        }

        .footer {
            background-color: #0F382A !important;
        }

        .copyright {
            color: black !important;
        }

        .copyright a {
            color: black !important;
            text-decoration: none;
            /* Opsional, untuk menghilangkan garis bawah */
        }
    </style>
</head>


<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;"></div>
    </div>
    <!-- Spinner End -->


    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top px-4 px-lg-5">
        <a href="/" class="navbar-brand d-flex align-items-center">
            <img src="img/logo/dombaku.png" alt="DombaKu Logo" class="img-fluid" style="max-height:50px; width: auto;">
            <h3 class="m-0" style="color: #0F382A; font-family: 'Exo 2', sans-serif; font-weight: 600;">DombaKu</h3>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <!-- Tombol Masuk (putih, border hijau) -->
                <a href="/login" class="btn rounded-pill px-4 py-2 me-2" style="background-color: white; border: 2px solid #0F382A; color: #0F382A;">Masuk</a>
                <!-- Tombol Daftar (hijau solid) -->
                <a href="/register" class="btn rounded-pill px-4 py-2" style="background-color: #0F382A; color: white;">Daftar</a>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->

    <!-- Video Background Start -->
    <div class="video-container">
        <video autoplay loop muted playsinline id="bg-video">
            <source src="{{ asset('page/img/background.mp4') }}" type="video/mp4">
            Browser Anda tidak mendukung tag video.
        </video>
        <div class="overlay"></div>
        <div class="video-caption">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 text-center">
                        <p class="fs-4 text-white">Selamat Datang di <span style="color: #FFFFFF;">DombaKu</span></p>
                        <h1 class="display-4 text-white mb-4 animated fadeIn">Solusi Cerdas Manajemen Ternak</h1>
                        <a href="" class="btn btn-secondary rounded-pill py-3 px-5 animated fadeIn">Jelajahi Lebih Lanjut</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Video Background End -->


    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5 align-items-end">
                <div class="col-lg-6">
                    <div class="row g-2">
                        <div class="col-6 wow fadeIn" data-wow-delay="0.1s">
                            <img class="img-fluid rounded" src="{{ asset('page/img/1.jpg') }}">
                        </div>
                        <div class="col-6 wow fadeIn" data-wow-delay="0.1s">
                            <img class="img-fluid rounded" src="{{ asset('page/img/2.jpg') }}">
                        </div>
                        <div class="col-6 wow fadeIn" data-wow-delay="0.3s">
                            <img class="img-fluid rounded" src="{{ asset('page/img/3.jpg') }}">
                        </div>
                        <div class="col-6 wow fadeIn" data-wow-delay="0.5s">
                            <img class="img-fluid rounded" src="{{ asset('page/img/4.jpg') }}">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                    <p class="section-title bg-white text-start text-primary pe-3">Tentang DombaKu</p>
                    <h1 class="mb-4">DombaKu</h1>
                    <p class="mb-4">DombaKu adalah platform berbasis teknologi untuk manajemen ternak domba yang membantu peternak dalam pengelolaan data ternak, pemilihan pasangan kawin, serta pemantauan kesehatan secara efisien dan akurat. Dengan menggunakan Alg Supervised Learning, DombaKu memudahkan pemantauan kesehatan dan perkawinan domba secara otomatis berdasarkan data genetik dan kesehatan yang tercatat.</p>
                    <div class="row g-5 pt-2 mb-5">
                        <div class="col-sm-6">
                            <img class="img-fluid mb-4" alt="">
                            <h5 class="mb-3">Manajemen Ternak Domba</h5>
                            <span>Platform cerdas untuk memantau kesehatan, perkembangan, dan data genetik ternak domba.</span>
                        </div>
                        <div class="col-sm-6">
                            <img class="img-fluid mb-4" alt="">
                            <h5 class="mb-3">Rekomendasi Kawin Domba</h5>
                            <span>Algoritma berbasis Tree-based Learning untuk menentukan pasangan kawin terbaik untuk domba Anda.</span>
                        </div>
                    </div>
                    <a class="btn btn-secondary rounded-pill py-3 px-5" href="">Pelajari Lebih Lanjut</a>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

    <!-- Service Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto pb-4 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <p class="section-title bg-white text-center text-primary px-3">Layanan Kami</p>
                <h2 class="mb-5">Layanan Untuk Manajemen Ternak Domba</h2>
            </div>
            <div class="row gy-5 gx-4">
                <div class="col-lg-4 col-md-6 pt-5 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item d-flex h-100">
                        <div class="service-img">
                            <img class="img-fluid" src="{{ asset('page/img/service-1.jpg') }}" alt="">
                        </div>
                        <div class="service-text p-5 pt-0">
                            <div class="service-icon">
                                <img class="img-fluid rounded-circle" src="{{ asset('page/img/service-1.jpg') }}" alt="">
                            </div>
                            <h5 class="mb-3">Manajemen Data Ternak</h5>
                            <p class="mb-4">Kami menyediakan platform untuk pengelolaan data ternak secara efisien, termasuk informasi genetik, kesehatan, dan riwayat perkawinan ternak Anda.</p>
                            <a class="btn btn-square rounded-circle" href=""><i class="bi bi-chevron-double-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 pt-5 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item d-flex h-100">
                        <div class="service-img">
                            <img class="img-fluid" src="{{ asset('page/img/service-2.jpg') }}" alt="">
                        </div>
                        <div class="service-text p-5 pt-0">
                            <div class="service-icon">
                                <img class="img-fluid rounded-circle" src="{{ asset('page/img/service-2.jpg') }}" alt="" />
                            </div>
                            <h5 class="mb-3">Rekomendasi Pasangan Kawin</h5>
                            <p class="mb-4">Kami memberikan rekomendasi pasangan kawin yang optimal, menghindari inbreeding dengan mempertimbangkan faktor genetik dan kesehatan ternak, serta memberi panduan perawatan untuk meningkatkan hasil ternak Anda.</p>
                            <a class="btn btn-square rounded-circle" href=""><i class="bi bi-chevron-double-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 pt-5 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item d-flex h-100">
                        <div class="service-img">
                            <img class="img-fluid" src="{{ asset('page/img/service-3.jpg') }}" alt="">
                        </div>
                        <div class="service-text p-5 pt-0">
                            <div class="service-icon">
                                <img class="img-fluid rounded-circle" src="{{ asset('page/img/service-3.jpg') }}" alt="" />
                            </div>
                            <h5 class="mb-3">Laporan Data Ternak</h5>
                            <p class="mb-4">Kami menyediakan laporan lengkap mengenai jumlah domba berdasarkan umur, jenis kelamin, kelahiran, dan bulan lahir. Laporan ini disajikan dalam bentuk chart untuk mempermudah analisis dan pengambilan keputusan dalam manajemen ternak Anda.</p>
                            <a class="btn btn-square rounded-circle" href=""><i class="bi bi-chevron-double-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->

    <!-- Gallery Start -->
    <div class="container-xxl py-5 px-0">
        <div class="text-center mx-auto pb-4 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <p class="section-title bg-white text-center text-primary px-3">Gallery</p>
            <h2 class="mb-5">Dokumentasi Domba</h2>
        </div>
        <div class="row g-0">
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="row g-0">
                    <div class="col-12">
                        <a class="d-block" href="{{ asset('page/img/gallery-5.jpg') }}" data-lightbox="gallery">
                            <img class="img-fluid" src="{{ asset('page/img/gallery-5.jpg') }}" alt="">
                        </a>
                    </div>
                    <div class="col-12">
                        <a class="d-block" href="{{ asset('page/img/gallery-1.jpg') }}" data-lightbox="gallery">
                            <img class="img-fluid" src="{{ asset('page/img/gallery-1.jpg') }}" alt="">
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="row g-0">
                    <div class="col-12">
                        <a class="d-block" href="{{ asset('page/img/gallery-2.jpg') }}" data-lightbox="gallery">
                            <img class="img-fluid" src="{{ asset('page/img/gallery-2.jpg') }}" alt="">
                        </a>
                    </div>
                    <div class="col-12">
                        <a class="d-block" href="{{ asset('page/img/gallery-6.jpg') }}" data-lightbox="gallery">
                            <img class="img-fluid" src="{{ asset('page/img/gallery-6.jpg') }}" alt="">
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                <div class="row g-0">
                    <div class="col-12">
                        <a class="d-block" href="{{ asset('page/img/gallery-7.jpg') }}" data-lightbox="gallery">
                            <img class="img-fluid" src="{{ asset('page/img/gallery-7.jpg') }}" alt="">
                        </a>
                    </div>
                    <div class="col-12">
                        <a class="d-block" href="{{ asset('page/img/gallery-3.jpg') }}" data-lightbox="gallery">
                            <img class="img-fluid" src="{{ asset('page/img/gallery-3.jpg') }}" alt="">
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.7s">
                <div class="row g-0">
                    <div class="col-12">
                        <a class="d-block" href="{{ asset('page/img/gallery-4.jpg') }}" data-lightbox="gallery">
                            <img class="img-fluid" src="{{ asset('page/img/gallery-4.jpg') }}" alt="">
                        </a>
                    </div>
                    <div class="col-12">
                        <a class="d-block" href="{{ asset('page/img/gallery-8.jpg') }}" data-lightbox="gallery">
                            <img class="img-fluid" src="{{ asset('page/img/gallery-8.jpg') }}" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Gallery End -->

    <!-- Footer Start -->
    <div class="container-fluid bg-dark footer mt-5 py-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <!-- Kantor Kami -->
                <div class="col-lg-4 col-md-6">
                    <h5 class="text-white mb-4">Kantor Kami</h5>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Politeknik Negeri Batam, Batam, Indonesia</p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+62 778 123 4567</p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>dombaku.id@gmail.com</p>
                    <div class="d-flex pt-3">
                        <a class="btn btn-square btn-secondary rounded-circle me-2" href="https://www.instagram.com/dombaku_id/"><i class="fab fa-instagram"></i></a>
                        <a class="btn btn-square btn-secondary rounded-circle me-2" href="https://www.instagram.com/dombaku_id/"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-square btn-secondary rounded-circle me-2" href="https://www.instagram.com/dombaku_id/"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>

                <!-- Tautan Cepat -->
                <div class="col-lg-4 col-md-6">
                    <h5 class="text-white mb-4">Tautan Cepat</h5>
                    <a class="btn btn-link text-white" href="">Tentang Kami</a>
                    <a class="btn btn-link text-white" href="">Hubungi Kami</a>
                    <a class="btn btn-link text-white" href="">Layanan Kami</a>
                    <a class="btn btn-link text-white" href="">Syarat & Ketentuan</a>
                    <a class="btn btn-link text-white" href="">Bantuan</a>
                </div>

                <!-- Jam Operasional -->
                <div class="col-lg-4 col-md-6">
                    <h5 class="text-white mb-4">Jam Operasional</h5>
                    <p class="mb-1">Senin - Jumat</p>
                    <h6 class="text-light">09:00 - 17:00 WIB</h6>
                    <p class="mb-1">Sabtu - Minggu</p>
                    <h6 class="text-light">Tutup</h6>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- Copyright Start -->
    <div class="container-fluid bg-secondary text-body copyright py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    &copy; <span id="year"></span> <a class="fw-semi-bold" href="#">PBL TRPL-605</a>, Semua Hak Dilindungi.
                </div>
                <div class="col-md-6 text-center text-md-end">
                    Dirancang oleh <a class="fw-semi-bold" href="">PBL</a> | TRPL-605
                </div>
            </div>
        </div>
    </div>
    <!-- Copyright End -->

    <script>
        document.getElementById('year').textContent = new Date().getFullYear();
    </script>

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('page/lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('page/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('page/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('page/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('page/lib/counterup/counterup.min.js') }}"></script>
    <script src="{{ asset('page/lib/parallax/parallax.min.js') }}"></script>
    <script src="{{ asset('page/lib/lightbox/js/lightbox.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('page/js/main.js') }}"></script>
</body>

</html>