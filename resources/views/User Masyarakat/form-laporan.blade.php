<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>FlexStart Bootstrap Template - Index</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="/flexstart/assets/img/favicon.png" rel="icon">
    <link href="/flexstart/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="/flexstart/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="/flexstart/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/flexstart/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="/flexstart/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="/flexstart/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="/flexstart/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="/flexstart/assets/css/style.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: FlexStart
  * Updated: Mar 09 2023 with Bootstrap v5.2.3
  * Template URL: https://bootstrapmade.com/flexstart-bootstrap-startup-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top">
        <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

            <a href="{{route('landing-page')}}" class="logo d-flex align-items-center">
                <img src="/flexstart/assets/img/logo.png" alt="">
                <span>Alapemas</span>
            </a>

            <nav id="navbar" class="navbar">
                <ul>
                    @if (Auth::guard('masyarakats')->user())
                    <li><a class="nav-link scrollto" href="{{route('form-laporan')}}">Lapor</a></li>
                    <li><a class="nav-link scrollto" href="{{route('laporan-saya')}}">Laporan Saya</a></li>
                    <li><a class="nav-link scrollto" href="{{route('logout')}}">Hai,
                            {{Auth::guard('masyarakats')->user()->nama}}</a></li>
                    @else
                    <li><a class="nav-link scrollto" href="{{route('form-login')}}">Masuk</a></li>
                    <li><a class="getstarted scrollto" href="{{route('form-register')}}">Daftar</a></li>
                    @endif
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->

    <div id="hero" class="align-items-center py-5 ">
        <h2 class="text-center mb-3 mt-4">Layanan Pengaduan Online Masyarakat</h2>
        <div class="card mx-5">
            <div class="card-body">
                <h4 class="card-title">Sampaikan Laporan Anda</h4>
                <form action="{{route('simpan-laporan')}}" method="POST" id="myForm" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <input type="hidden" class="form-control" id="nik_pelapor" name="nik_pelapor" autocomplete="off" value="{{Auth::guard('masyarakats')->user()->nik}}" />
                        <input type="hidden" class="form-control" id="status" name="status" autocomplete="off" value="diterima" />
                        <input type="hidden" name="lokasi" id="lokasi" value="">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-company">Kategori Laporan</label>
                        <select id="defaultSelect" class="form-select" name="kategori_id">
                            <option selected>Pilih Kategori</option>
                            @foreach ($kategoris as $kategori)
                                <option value="{{$kategori->id}}">{{$kategori->nama_kategori}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="basic-default-company">Judul Laporan</label>
                        <input type="text" class="form-control" name="judul_laporan" />
                        @error('judul_laporan')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="basic-default-company">Isi Laporan</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="4"
                            name="isi_laporan"></textarea>
                        @error('isi_laporan')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="formFile" class="form-label">Foto (Optional)</label>
                        <input class="form-control" type="file" id="formFile" name="foto" />
                    </div>

                    <div class="btn-footer d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary" id="submitButton">Lapor!</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Vendor JS Files -->
    <script src="/flexstart/assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="/flexstart/assets/vendor/aos/aos.js"></script>
    <script src="/flexstart/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/flexstart/assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="/flexstart/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="/flexstart/assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="/flexstart/assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="/flexstart/assets/js/main.js"></script>
    <script>
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            alert("Geolocation is not supported by this browser.");
        }
        function showPosition(position) {
            var lat = position.coords.latitude;
            var lng = position.coords.longitude;
            document.getElementById("lokasi").value = lat + "," + lng;
        }
    </script>

</body>

</html>