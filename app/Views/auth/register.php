<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8">
    <title>UKM Futsal UTDI</title>

    <!-- Site favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('assets/vendors/images/logo.jpeg') ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('assets/vendors/images/logo.jpeg') ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('assets/vendors/images/logo.jpeg') ?>">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/vendors/styles/core.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/vendors/styles/icon-font.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/vendors/styles/style.css') ?>">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-119386393-1');
    </script>
</head>

<!-- ... (Bagian head dan bagian lainnya tetap sama) ... -->

<body class="login-page">
    <div class="login-header box-shadow">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <div class="brand-logo">
                <a href="<?= base_url('/login') ?>">
                    <img src="<?= base_url('assets/vendors/images/logo.ico') ?>" alt="">
                </a>
            </div>
            <div class="login-menu">
                <ul>
                    <li><a href="<?= base_url('/login') ?>">Login</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="register-page-wrap d-flex align-items-center flex-wrap justify-content-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 col-lg-7">
                    <img src="<?= base_url('assets/vendors/images/register-page-img.png') ?>" alt="">
                </div>
                <!-- horizontal Basic Forms Start -->
                <div class="pd-20 card-box mb-30 col-md-6 col-lg-5"> <!-- Mengubah lebar kolom menjadi 5 -->
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-blue h4">Daftar Anggota Baru</h4>
                            <p class="mb-30">Pendaftaran akun untuk anggota baru</p>
                        </div>
                        <?php if (session()->has('success')) : ?>
                            <div class="alert alert-success" role="alert">
                                <?= session('success') ?>
                            </div>
                        <?php endif; ?>

                        <?php if (session()->has('error')) : ?>
                            <div class="alert alert-danger" role="alert">
                                <?= session('error') ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <form action="/register" method="post">
                        <div class="form-group">
                            <label>Username</label>
                            <input class="form-control" type="text" name="nim" placeholder="Masukan NIM">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input class="form-control" name="password" type="password">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input class="form-control" name="email" type="email">
                        </div>
                        <div class="form-group">
                            <label>No Handphone</label>
                            <input class="form-control" name="noTelepon" type="tel">
                        </div>
                        <button type="submit" class="btn btn-primary">Daftar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- js -->
    <script src="<?= base_url('assets/vendors/scripts/core.js') ?>"></script>
    <script src="<?= base_url('assets/vendors/scripts/script.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendors/scripts/process.js') ?>"></script>
    <script src="<?= base_url('assets/vendors/scripts/layout-settings.js') ?>"></script>
    <script src="<?= base_url('assets/src/plugins/jquery-steps/jquery.steps.js') ?>"></script>
    <script src="<?= base_url('assets/vendors/scripts/steps-setting.js') ?>"></script>

</body>

</html>