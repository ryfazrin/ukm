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
                    <h4>Kegiatan UKM Futsal UTDI</h4>
                </div>

                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url('/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Kegiatan</li>
                    </ol>
                </nav>
                <!-- Button trigger modal -->
                <br>
                <?php if (session()->get('role') == 'admin') : ?>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#kegiatanModal">
                        Tambah Kegiatan
                    </button>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-30">
            <div class="card-box height-100-p overflow-hidden">
                <div class="profile-tab height-100-p">
                    <div class="tab height-100-p">
                        <ul class="nav nav-tabs customtab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#timeline" role="tab">Timeline</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <!-- Timeline Tab start -->
                            <div class="tab-pane fade show active" id="timeline" role="tabpanel">
                                <div class="pd-20">
                                    <div class="profile-timeline">
                                        <?php $currentIdKegiatan = null; ?>

                                        <?php foreach ($kegiatan as $keg) : ?>
                                            <?php
                                            // Jika id_kegiatan berbeda, tutup container dan buka container baru
                                            if ($currentIdKegiatan !== $keg['id_kegiatan']) : ?>

                                                <?php if ($currentIdKegiatan !== null) : ?>
                                                    </ul>
                                                <?php endif; ?>
                                                <div class="timeline-month">
                                                    <h5>
                                                        <?= $keg['nama_kegiatan'] ?>
                                                    </h5>
                                                    <?php if (session()->get('role') == 'admin') : ?>
                                                        <a href="/kegiatan-delete/<?= $keg['id_kegiatan'] ?>" class="btn btn-danger ml-2">Delete</a>
                                                        <button class="btn btn-primary" data-toggle="modal" data-target="#kegiatanEditModal<?= $keg['id_kegiatan'] ?>">Update</button>
                                                        <button class="btn btn-primary" data-toggle="modal" data-target="#kegiatanImageModal<?= $keg['id_kegiatan'] ?>">Tambah Image</button>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="profile-timeline-list">
                                                    <ul>
                                                    <?php endif; ?>
                                                    <li>
                                                        <div class="date">
                                                            <?= $keg['tanggal_kegiatan'] ?>
                                                        </div>
                                                        <div class="task-name"><i class="ion-ios-chatboxes"></i>
                                                            Lokasi Kegiatan</div>
                                                        <p>
                                                            <?= $keg['tempat_kegiatan'] ?>
                                                        </p>
                                                        <!-- TODO Gambar kegiatan -->
                                                        <div class="row">
                                                            <?php
                                                            $gambar_kegiatan = explode(',', $keg['foto_kegiatan']);
                                                            foreach ($gambar_kegiatan as $gambar) :
                                                                if ($gambar != null) : // Removed the semicolon and added the colon
                                                            ?>
                                                                    <div class="col-md-4 mb-3">
                                                                        <img src="<?= base_url($gambar) ?>" alt="Gambar Kegiatan" style="max-width: 100%; height: auto;">
                                                                        <?php if (session()->get('role') == 'admin') : ?>
                                                                            <form action="/kegiatan-update/gambar/<?= $keg['id_gambar'] ?>" method="post" enctype="multipart/form-data">
                                                                                <div class="custom-file mt-2">
                                                                                    <label for="foto_kegiatan_input" class="custom-file-label" id="foto_kegiatan_label">Choose file</label>
                                                                                    <input type="file" class="custom-file-input" name="foto_kegiatan" id="foto_kegiatan" accept=".jpg, .png, .jpeg, .webp" onchange="updateFileName()">
                                                                                </div>
                                                                                <div class="d-flex mt-2">
                                                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                                                    <a href="/kegiatan-delete/gambar/<?= $keg['id_gambar'] ?>" class="btn btn-danger ml-2">Delete Gambar</a>
                                                                                </div>
                                                                            </form>
                                                                        <?php endif; ?>
                                                                    </div>
                                                            <?php
                                                                endif; // Added the endif statement
                                                            endforeach;
                                                            ?>
                                                        </div>
                                                    </li>
                                                    <?php $currentIdKegiatan = $keg['id_kegiatan']; ?>
                                                <?php endforeach; ?>
                                                    </ul>
                                                </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Timeline Tab End -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php if (session()->get('role') == 'admin') : ?>
        <!-- Modal -->
        <div class="modal fade" id="kegiatanModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Form Kegiatan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Formulir kegiatan di sini -->
                        <form action="/kegiatan-add/save" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="nama_kegiatan">Nama kegiatan:</label>
                                <input type="text" name="nama_kegiatan" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="tanggal_kegiatan">Tanggal kegiatan:</label>
                                <input type="date" name="tanggal_kegiatan" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="tempat_kegiatan">Tempat kegiatan:</label>
                                <input type="text" name="tempat_kegiatan" class="form-control">
                            </div>
                            <div class="custom-file">
                                <label for="foto_kegiatan_input" class="custom-file-label" id="foto_kegiatan_label">Choose
                                    file</label>
                                <input type="file" multiple class="custom-file-input" name="foto_kegiatan[]" id="foto_kegiatan_input" accept=".jpg, .png, .jpeg, .webp" onchange="updateFileName()">
                            </div>
                            <div id="additionalFiles"></div>
                            <br><br>
                            <button type="submit" class="btn btn-primary">Simpan data</button>
                        </form>
                        <script>
                            function updateFileName() {
                                var fileName = document.getElementById('foto_kegiatan_input').files[0].name;
                                document.getElementById('foto_kegiatan_label').innerText = fileName;
                            }
                        </script>
                    </div>
                </div>
            </div>
        </div>
        <?php foreach ($kegiatan as $keg) : ?>
            <!-- modal tambah gambar -->
            <div class="modal fade" id="kegiatanImageModal<?= $keg['id_kegiatan'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Gambar Kegiatan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Formulir kegiatan di sini -->
                            <form action="/kegiatan-update/add-image/<?= $keg['id_kegiatan'] ?>" method="post" enctype="multipart/form-data">
                                <div class="custom-file">
                                    <label for="foto_kegiatan_input" class="custom-file-label" id="foto_kegiatan_label">Choose
                                        file</label>
                                    <input type="file" multiple class="custom-file-input" name="foto_kegiatan[]" id="foto_kegiatan_input" accept=".jpg, .png, .jpeg, .webp" onchange="updateFileName()">
                                </div>
                                <br><br>
                                <button type="submit" class="btn btn-primary">Simpan data</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- update kegiatan -->
            <div class="modal fade" id="kegiatanEditModal<?= $keg['id_kegiatan'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Kegiatan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Formulir kegiatan di sini -->
                            <form action="/kegiatan-update/<?= $keg['id_kegiatan'] ?>" method="post" enctype="multipart/form-data">
                                <!-- upate text -->
                                <div class="form-group">
                                    <label for="nama_kegiatan">Nama kegiatan:</label>
                                    <input type="text" name="nama_kegiatan" class="form-control" value="<?= $keg['nama_kegiatan'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="tanggal_kegiatan">Tanggal kegiatan:</label>
                                    <input type="date" name="tanggal_kegiatan" class="form-control" value="<?= $keg['tanggal_kegiatan'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="tempat_kegiatan">Tempat kegiatan:</label>
                                    <input type="text" name="tempat_kegiatan" class="form-control" value="<?= $keg['tempat_kegiatan'] ?>">
                                </div>
                                <br><br>
                                <button type="submit" class="btn btn-primary">Simpan data</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    <?php endif; ?>
    <?= $this->endSection() ?>