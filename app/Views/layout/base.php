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
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
		rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/vendors/styles/core.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/vendors/styles/icon-font.min.css') ?>">
	<link rel="stylesheet" type="text/css"
		href="<?= base_url('assets/src/plugins/datatables/css/dataTables.bootstrap4.min.css') ?>">
	<link rel="stylesheet" type="text/css"
		href="<?= base_url('assets/src/plugins/datatables/css/responsive.bootstrap4.min.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/vendors/styles/style.css') ?>">

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag() { dataLayer.push(arguments); }
		gtag('js', new Date());

		gtag('config', 'UA-119386393-1');
	</script>
</head>

<body>
	<div class="pre-loader">
		<div class="pre-loader-box">
			<div class="loader-logo"><img src="<?= base_url('assets/vendors/images/logokecil.jpg') ?>" alt=""></div>
			<div class='loader-progress' id="progress_div">
				<div class='bar' id='bar1'></div>
			</div>
			<div class='percent' id='percent1'>0%</div>
			<div class="loading-text">
				Loading...
			</div>
		</div>
	</div>

	<div class="header">
		<div class="header-left">
			<div class="menu-icon dw dw-menu"></div>
		</div>
	</div>
	<div class="left-side-bar">
		<div class="brand-logo">
			<a href="<?= base_url('/dashboard') ?>">
				<img src="<?= base_url('assets/vendors/images/FUTSAL UTDI.png') ?>" alt="" class="dark-logo">
				<img src="<?= base_url('assets/vendors/images/FUTSAL UTDI.png') ?>" alt="" class="light-logo">
			</a>
			<div class="close-sidebar" data-toggle="left-sidebar-close">
				<i class="ion-close-round"></i>
			</div>
		</div>
		<div class="user-info-dropdown">
			<div class="dropdown">
				<a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
					<span class="user-icon">
						<img src="<?= base_url('assets/vendors/images/photo1.jpg') ?>" alt="">
					</span>
					<span class="mtext" style="color: antiquewhite;">
						<!-- app/Views/dashboard.php -->

						<?php
						$session = session();
						$anggotaModel = new \App\Models\AnggotaModel();

						if ($session->has('username') && $session->has('role')) {
							$id_user = $session->get('id_user');

							if ($session->get('role') == 'admin') {
								// Menampilkan username jika yang login adalah admin
								echo   $session->get('username');
							} else {
								// Menggunakan AnggotaModel untuk mendapatkan nama lengkap berdasarkan id_anggota_baru
								$nama_lengkap = $anggotaModel->select('nama_lengkap')->where('id_anggota_baru', $id_user)->first();

								// Menampilkan pesan selamat datang dengan nama lengkap
								echo  $nama_lengkap['nama_lengkap'];
							}
						} else {
							echo 'Welcome, Guest';
						}
						?>

					</span>
				</a>
				<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
					<a class="dropdown-item" href="/anggota-detail/<?= $session->get('id_user') ?>"><i class="dw dw-user1"></i> Profile</a>
					<a class="dropdown-item" href="<?= base_url('/logout') ?>"><i class="dw dw-logout"></i> Log Out</a>
				</div>
			</div>
		</div>
		<!-- Menampilkan menu Anggota, Jadwal, dan Kegiatan hanya untuk role 'anggota' -->
		<?php if ($session->get('role') === 'anggota'): ?>
			<div class="menu-block customscroll">
				<div class="sidebar-menu">
					<ul id="accordion-menu">
						<li class="dropdown">
							<a href="<?= base_url('/dashboard') ?>" class="dropdown-toggle no-arrow">
								<span class="micon dw dw-house-1"></span><span class="mtext">Dashboard</span>
							</a>
						</li>
						<li class="dropdown">
							<a href="/anggota-detail/<?= $session->get('id_user') ?>" class="dropdown-toggle no-arrow">
								<span class="micon dw dw-user-2"></span><span class="mtext">Lengkapi <br> Data
									Anggota</span>
							</a>
						</li>
						<li>
							<a href="/jadwal" class="dropdown-toggle no-arrow">
								<span class="micon dw dw-calendar1"></span><span class="mtext">Jadwal</span>
							</a>
						</li>
						<li class="dropdown">
							<a href="/kegiatan" class="dropdown-toggle no-arrow">
								<span class="micon dw dw-library"></span><span class="mtext">Kegiatan</span>
							</a>
						</li>
					</ul>
				</div>
			</div>
		<?php endif; ?>

		<!-- Menampilkan semua menu untuk role 'admin' -->
		<?php if ($session->get('role') === 'admin'): ?>
			<div class="menu-block customscroll">
				<div class="sidebar-menu">
					<ul id="accordion-menu">
						<li class="dropdown">
							<a href="/dashboard" class="dropdown-toggle no-arrow">
								<span class="micon dw dw-house-1"></span><span class="mtext">Dashboard</span>
							</a>
						</li>
						<li class="dropdown">
							<a href="/anggota" class="dropdown-toggle no-arrow">
								<span class="micon dw dw-user-2"></span><span class="mtext">Anggota</span>
							</a>
						</li>
						<li>
							<a href="/jadwal" class="dropdown-toggle no-arrow">
								<span class="micon dw dw-calendar1"></span><span class="mtext">Jadwal</span>
							</a>
						</li>
						<li class="dropdown">
							<a href="/kegiatan" class="dropdown-toggle no-arrow">
								<span class="micon dw dw-library"></span><span class="mtext">Kegiatan</span>
							</a>
						</li>
						<li class="dropdown">
							<a href="/laporan" class="dropdown-toggle no-arrow">
								<span class="micon dw dw-copy"></span><span class="mtext">Laporan</span>
							</a>
						</li>
					</ul>
				</div>
			</div>
		<?php endif; ?>

	</div>
	<div class="mobile-menu-overlay"></div>

	<div class="main-container">
		<div class="pd-ltr-20">
			<!-- <?php //var_dump(session());?> -->
			<?= $this->renderSection('content') ?>
			<div class="footer-wrap pd-20 mb-20 card-box">
				Aplikasi - UKM Futsal <a href="#">UTDI</a>
			</div>
		</div>
	</div>
	<!-- js -->
	<script src="<?= base_url('assets/vendors/scripts/core.js') ?>"></script>
	<script src="<?= base_url('assets/vendors/scripts/script.min.js') ?>"></script>
	<script src="<?= base_url('assets/vendors/scripts/process.js') ?>"></script>
	<script src="<?= base_url('assets/vendors/scripts/layout-settings.js') ?>"></script>
	<script src="<?= base_url('assets/src/plugins/apexcharts/apexcharts.min.js') ?>"></script>
	<script src="<?= base_url('assets/src/plugins/datatables/js/jquery.dataTables.min.js') ?>"></script>
	<script src="<?= base_url('assets/src/plugins/datatables/js/dataTables.bootstrap4.min.js') ?>"></script>
	<script src="<?= base_url('assets/src/plugins/datatables/js/dataTables.responsive.min.js') ?>"></script>
	<script src="<?= base_url('assets/src/plugins/datatables/js/responsive.bootstrap4.min.js') ?>"></script>
	<script src="<?= base_url('assets/vendors/scripts/dashboard.js') ?>"></script>
	<!-- buttons for Export datatable -->
	<script src="<?= base_url('assets/src/plugins/datatables/js/dataTables.buttons.min.js') ?>"></script>
	<script src="<?= base_url('assets/src/plugins/datatables/js/buttons.bootstrap4.min.js') ?>"></script>
	<script src="<?= base_url('assets/src/plugins/datatables/js/buttons.print.min.js') ?>"></script>
	<script src="<?= base_url('assets/src/plugins/datatables/js/buttons.html5.min.js') ?>"></script>
	<script src="<?= base_url('assets/src/plugins/datatables/js/buttons.flash.min.js') ?>"></script>
	<script src="<?= base_url('assets/src/plugins/datatables/js/pdfmake.min.js') ?>"></script>
	<script src="<?= base_url('assets/src/plugins/datatables/js/vfs_fonts.js') ?>"></script>
	<!-- Datatable Setting js -->
	<script src="<?= base_url('assets/vendors/scripts/datatable-setting.js') ?>"></script>
</body>
</body>

</html>