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

<body class="login-page">
    <div class="login-header box-shadow">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <div class="brand-logo">
                <a href="<?= base_url('/login') ?>">
                    <img alt="" src="<?= base_url('assets/vendors/images/logo.ico') ?>">
                </a>
            </div>
            <div class="login-menu">
                <ul>
                    <li><a href="<?= base_url('/register') ?>">Register</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 col-lg-7">
                    <img src="<?= base_url('assets/vendors/images/depanberanda.jpeg') ?>" alt="">
                </div>
                <div class="col-md-6 col-lg-5">
                    <div class="login-box bg-white box-shadow border-radius-10">
                        <div class="login-title">
                            <h2 class="text-center text-primary">Login To UKM FUTSAL UTDI</h2>
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
                        <!-- Gunakan form_open untuk membuka form dengan method dan action yang benar -->
                        <?php echo form_open('login'); ?>
                        <div class="input-group custom">
                            <!-- Tambahkan name="username" pada input -->
                            <input type="text" class="form-control form-control-lg" placeholder="Username" name="username" required>
                            <div class="input-group-append custom">
                                <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
                            </div>
                        </div>
                        <div class="input-group custom">
                            <!-- Tambahkan name="password" pada input -->
                            <input type="password" class="form-control form-control-lg" placeholder="**********" name="password" required>
                            <div class="input-group-append custom">
                                <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="input-group mb-0">
                                    <!-- Ganti input type dengan button untuk memicu form submit -->
                                    <button class="btn btn-primary btn-lg btn-block" type="submit">Sign In</button>
                                </div>
                                <div class="font-16 weight-600 pt-10 pb-10 text-center" data-color="#707373">OR
                                </div>
                                <div class="input-group mb-0">
                                    <a class="btn btn-outline-primary btn-lg btn-block" href="<?= base_url('/register') ?>">Register To Create Account</a>
                                </div>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- js -->
    <script src="<?= base_url('assets/vendors/scripts/core.js') ?>"></script>
    <script src="<?= base_url('assets/vendors/scripts/script.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendors/scripts/process.js') ?>"></script>
    <script src="<?= base_url('assets/vendors/scripts/layout-settings.js') ?>"></script>
</body>

</html>