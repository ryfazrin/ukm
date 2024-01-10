<?= $this->extend('layout/base') ?>
<?= $this->section('content') ?>
<?php if (session()->has('success')): ?>
    <div class="alert alert-success" role="alert">
        <?= session('success') ?>
    </div>
<?php endif; ?>

<?php if (session()->has('error')): ?>
    <div class="alert alert-danger" role="alert">
        <?= session('error') ?>
    </div>
<?php endif; ?>
<div class="min-height-200px">
    <div class="page-header">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="title">
                    <h4>Profile</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url('/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Profile</li>
                    </ol>
                    <?php foreach ($anggota as $angg): ?>
                        <a type="button" class="btn btn-primary"
                            href="<?= site_url("/anggota-update/edit/" . $angg->id_anggota_baru); ?>">Update</a>
                        <a type="button" class="btn btn-primary"
                            href="/anggota-delete/<?= $angg->id_anggota_baru; ?>/">Hapus </a>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#updatePasswordModal-<?= $angg->id_anggota_baru ?>">Update Password</button>
                    <?php endforeach; ?>
                </nav>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
            <?php foreach ($anggota as $angg): ?>
                <div class="pd-20 card-box height-100-p">
                    <div class="profile-photo">
                        <img src="<?= $angg->pas_foto; ?>" alt="" class="avatar-photo">
                    </div><br>
                    <h5 class="text-center h5 mb-0">
                        <?= $angg->nama_lengkap; ?>
                    </h5>
                    <p class="text-center text-muted font-14">
                        <?= $angg->nim; ?>-
                        <?= $angg->jurusan; ?>
                    </p>
                    <div class="profile-info">
                        <h5 class="mb-20 h5 text-blue">Contact Information</h5>
                        <ul>
                            <li>
                                <span>Email Address:</span>
                                <?= $angg->email; ?>
                            </li>
                            <li>
                                <span>Phone Number:</span>
                                <?= $angg->no_telepon; ?>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
                <div class="pd-20 card-box height-100-p">
                    <div class="profile-social">
                        <h5 class="mb-20 h5 text-blue">Posisi</h5>
                        <div class="contact-skill">
                            <?php
                            $posisiArray = explode(" ", $angg->posisi);
                            foreach ($posisiArray as $posisiItem):
                                if (!empty($posisiItem)): // Menyaring item kosong jika ada
                                    ?>
                                    <span class="btn btn-secondary btn-lg" disabled>
                                        <?= $posisiItem ?>
                                    </span>
                                    <?php
                                endif;
                            endforeach;
                            ?>
                        </div>
                    </div>
                    <hr>
                    <div class="profile-timeline-list">
                        <h5 class="mb-20 h5 text-blue">Information</h5>
                        <ul>
                            <li style="padding-left: 20px;">
                                <div class="task-name">Tempat_Lahir:</div>
                                <?= $angg->tempat_lahir; ?>
                            </li>
                            <li style="padding-left: 20px;">
                                <div class="task-name"></i>Tanggal_Lahir:</div>
                                <?= $angg->tanggal_lahir; ?>
                            </li>
                            <li style="padding-left: 20px;">
                                <div class="task-name">Jenis_Kelamin:</div>
                                <p>
                                    <?= $angg->jenis_kelamin; ?>
                                </p>
                            </li>
                            <li style="padding-left: 20px;">
                                <div class="task-name"></i> Agama:</div>
                                <p>
                                    <?= $angg->agama; ?>
                                </p>
                            </li>
                            <li style="padding-left: 20px;">

                                <div class="task-name"></i> Alamat:</div>
                                <p>
                                    <?= $angg->alamat; ?>
                                </p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<!-- modal update password -->
<?php foreach ($anggota as $angg): ?>
<div class="modal fade" id="updatePasswordModal-<?=$angg->id_anggota_baru?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Formulir tambah anggota di sini -->
                    <form method="post" action="/anggota-password/update/<?= $angg->id_anggota_baru ?>">
                        <div>
                            <label for="password_lama">Masukkan Password Lama:</label>
                            <input type="password" name="password_lama" class="form-control">
                            <label for="new_password">Masukkan Password Baru</label>
                            <input type="password" name="new_password" class="form-control">
                            <label for="confirm_new_password">Konfirmasi Password Baru   </label>
                            <input type="password" name="confirm_new_password" class="form-control">
                        </div><br>
                        <!-- Tambahkan kolom-kolom lain yang perlu diperbarui dalam formulir -->
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
</div>
<?php endforeach;?>

<?= $this->endSection() ?>