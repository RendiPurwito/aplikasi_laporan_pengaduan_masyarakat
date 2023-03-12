<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Pages / Login - NiceAdmin Bootstrap Template</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="/niceadmin/assets/img/favicon.png" rel="icon">
    <link href="/niceadmin/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="/niceadmin/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/niceadmin/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="/niceadmin/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="/niceadmin/assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="/niceadmin/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="/niceadmin/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="/niceadmin/assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="/niceadmin/assets/css/style.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Mar 09 2023 with Bootstrap v5.2.3
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <main>
        <div class="container">

            <section
                class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            <div class="d-flex justify-content-center py-4">
                                <a href="index.html" class="logo d-flex align-items-center w-auto">
                                    <img src="/niceadmin/assets/img/logo.png" alt="">
                                    <span class="d-none d-lg-block">Alapemas</span>
                                </a>
                            </div><!-- End Logo -->

                            <div class="card mb-3">

                                <div class="card-body">

                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                                        <p class="text-center small">Enter your personal details to create account</p>
                                    </div>

                                    <form action="{{route('register')}}" method="POST" class="row g-3">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="nik" class="form-label">NIK</label>
                                            <input type="number" class="form-control @error('nik') is-invalid @enderror" id="nik" name="nik"
                                                placeholder="Masukan nik anda" required autocomplete="nik" autofocus />
                                            @error('nik')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="nama" class="form-label">Nama</label>
                                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama"
                                                placeholder="Masukan nama anda" required autocomplete="nama" autofocus />
                                            @error('nama')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="username" class="form-label">Username</label>
                                            <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" placeholder="Masukan username anda" required autocomplete="username" autofocus />
                                            @error('username')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                                                placeholder="Masukan email anda" required autocomplete="email" />
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="telp" class="form-label">No Telepon</label>
                                            <input type="number" class="form-control @error('telp') is-invalid @enderror" id="telp" name="telp"
                                                placeholder="Masukan nomor telepon anda" required autocomplete="telp"/>
                                            @error('telp')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3 form-password-toggle">
                                            <label class="form-label" for="password">Password</label>
                                            <div class="input-group input-group-merge">
                                                <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password"
                                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                    aria-describedby="password" required autocomplete="new-password"/>
                                                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                            </div>
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3 form-password-toggle">
                                            <label class="form-label" for="password">Confirm Password</label>
                                            <div class="input-group input-group-merge">
                                                <input type="password" id="password-confirm" class="form-control @error('password') is-invalid @enderror" name="password_confirmation"
                                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                    aria-describedby="password" required autocomplete="new-password"/>
                                                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                            </div>
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit">Create Account</button>
                                        </div>
                                        
                                        <div class="col-12">
                                            <p class="small mb-0">
                                                Already have an account? 
                                                <a href="{{route('form-login')}}">Log in</a>
                                            </p>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </section>

        </div>
    </main><!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="/niceadmin/assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="/niceadmin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/niceadmin/assets/vendor/chart.js/chart.umd.js"></script>
    <script src="/niceadmin/assets/vendor/echarts/echarts.min.js"></script>
    <script src="/niceadmin/assets/vendor/quill/quill.min.js"></script>
    <script src="/niceadmin/assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="/niceadmin/assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="/niceadmin/assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="/niceadmin/assets/js/main.js"></script>

</body>

</html>