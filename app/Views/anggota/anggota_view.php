<?= $this->extend('layout/base') ?>
<?= $this->section('content') ?>
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
<div class="min-height-200px">

    <div class="page-header">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="title">
                    <h4>Anggota</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url('/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Anggota</li>
                    </ol>
                </nav>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahAnggotaModal">
                    Tambah Anggota
                </button>

            </div>

        </div>
    </div>

    <div class="contact-directory-list">
        <ul class="row">
            <?php foreach ($anggota as $dash) : ?>
                <li class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                    <div class="contact-directory-box">
                        <div class="contact-dire-info text-center">
                            <div class="contact-avatar">
                                <span>
                                    <img src="<?= $dash->pas_foto ?>" alt="">
                                </span>
                            </div>
                            <div class="contact-name">
                                <h4>
                                    <?= $dash->nama_lengkap ?>
                                </h4>
                                <p>
                                    <?= $dash->nim ?>
                                </p>
                                <div class="work text-success"><i class="ion-android-person"></i>
                                    <?= $dash->jurusan ?>
                                </div>
                            </div>
                            <div class="contact-skill">
                                <?php
                                $posisiArray = explode(" ", $dash->posisi);

                                foreach ($posisiArray as $posisiItem) :
                                    if (!empty($posisiItem)) : // Menyaring item kosong jika ada
                                ?>
                                        <span class="badge badge-pill">
                                            <?= $posisiItem ?>
                                        </span>
                                <?php
                                    endif;
                                endforeach;
                                ?>
                                <span class="badge badge-pill badge-primary">+ 8</span>
                            </div>

                            <div class="profile-sort-desc">
                                <?= $dash->email ?>
                                <?= $dash->no_telepon ?>
                            </div>
                        </div>
                        <div class="view-contact">
                            <a href="<?= base_url('/anggota-detail/' . $dash->id_anggota_baru) ?>">View Profile</a>
                        </div>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>

    </div>
    <!-- Modal -->
    <div class="modal fade" id="tambahAnggotaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Anggota</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Formulir tambah anggota di sini -->
                    <form method="post" action="/anggota-add/save/" enctype="multipart/form-data">
                        <div>
                            <label for="nama_lengkap">Nama Lengkap:</label>
                            <input type="text" name="nama_lengkap" class="form-control">
                            <label for="jurusan">Jurusan:</label>
                            <input type="text" name="jurusan" class="form-control">
                            <label for="nim">NIM:</label>
                            <input type="text" name="nim" class="form-control">
                            <label for="tempat_lahir">Tempat lahir:</label>
                            <input type="text" name="tempat_lahir" class="form-control">
                            <label for="tanggal_lahir">Tanggal Lahir:</label>
                            <input type="date" name="tanggal_lahir" class="form-control">
                            <label for="jenis_kelamin">Jenis Kelamin:</label>
                            <input type="text" name="jenis_kelamin" class="form-control">
                            <label for="agama">Agama:</label>
                            <input type="text" name="agama" class="form-control">
                            <label for="email">Email:</label>
                            <input type="text" name="email" class="form-control">
                            <label for="no_telepon">No telepon:</label>
                            <input type="text" name="no_telepon" class="form-control">
                            <label for="alamat">Alamat:</label>
                            <input type="text" name="alamat" class="form-control">
                            <label for="posisi">Posisi:</label>
                            <input type="text" name="posisi" class="form-control">
                            <label for="pas_foto">Pas Foto:</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="pas_foto" id="pas_foto_input" accept=".jpg, .png, .jpeg, .webp" onchange="updateFileName()">
                                <label class="custom-file-label" id="pas_foto_label">Choose file</label>
                            </div>
                            
                        </div><br>
                        <!-- Tambahkan kolom-kolom lain yang perlu diperbarui dalam formulir -->
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function updateFileName() {
            var fileName = document.getElementById('pas_foto_input').files[0].name;
            document.getElementById('pas_foto_label').innerText = fileName;
        }
    </script>
</div>
<?= $this->endSection() ?>