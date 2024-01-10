<?= $this->extend('layout/base') ?>
<?= $this->section('content') ?>
<!-- Default Basic Forms Start -->
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

<div class="pd-20 card-box mb-30">
    <div class="clearfix">
        <div class="pull-left">
            <h4 class="text-blue h4">Edit anggota</h4>
        </div>
    </div>
    <form method="post" action="/anggota-update/update/<?= $anggota['id_anggota_baru'] ?>" enctype="multipart/form-data">
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label" for="nama_lengkap">Nama Lengkap:</label>
            <div class="col-sm-12 col-md-10">
                <input class="form-control" type="text" name="nama_lengkap" value="<?= $anggota['nama_lengkap'] ?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label" for="jurusan">Jurusan:</label>
            <div class="col-sm-12 col-md-10">
                <input class="form-control" typ e="search" type="text" name="jurusan" value="<?= $anggota['jurusan'] ?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label" for="nim">NIM:</label>
            <div class="col-sm-12 col-md-10">
                <input class="form-control" type="text" name="nim" value="<?= $anggota['nim'] ?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label" for="tempat_lahir">Tempat lahir:</label>
            <div class="col-sm-12 col-md-10">
                <input class="form-control" type="text" name="tempat_lahir" value="<?= $anggota['tempat_lahir'] ?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label" for="tanggal_lahir">Tanggal Lahir:</label>
            <div class="col-sm-12 col-md-10">
                <input class="form-control" type="date" name="tanggal_lahir" value="<?= $anggota['tanggal_lahir'] ?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label" for="jenis_kelamin">Jenis Kelamin:</label>
            <div class="col-sm-12 col-md-10">
                <input class="form-control" type="text" name="jenis_kelamin" value="<?= $anggota['jenis_kelamin'] ?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label" for="agama">Agama:</label>
            <div class="col-sm-12 col-md-10">
                <input class="form-control" type="text" name="agama" value="<?= $anggota['agama'] ?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label" for="email">Email:</label>
            <div class="col-sm-12 col-md-10">
                <input class="form-control" type="email" name="email" value="<?= $anggota['email'] ?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label" for="no_telepon">Telephone</label>
            <div class="col-sm-12 col-md-10">
                <input class="form-control" type="tel" name="no_telepon" value="<?= $anggota['no_telepon'] ?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label" for="alamat">Alamat:</label>
            <div class="col-sm-12 col-md-10">
                <input class="form-control" type="text" name="alamat" value="<?= $anggota['alamat'] ?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label" for="posisi">Posisi:</label>
            <div class="col-sm-12 col-md-10">
                <input class="form-control" type="text" name="posisi" value="<?= $anggota['posisi'] ?>">
            </div>
        </div>

        <!-- Foto -->
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label" for="pas_foto">Pas Foto:</label>
            <div class="col-sm-12 col-md-10">
                <label id="file_label" for="pas_foto_input" class="custom-file-label">Choose file</label>
                <input type="file" class="form-control" name="pas_foto" id="pas_foto_input" accept=".jpg, .png, .jpeg, .webp" onchange="updateFileName(this)">
            </div>
            <!-- Tampilkan foto jika tersedia -->
            <?php if ($anggota['pas_foto']) : ?>
                <img src="<?= base_url($anggota['pas_foto']) ?>" alt="Pas Foto" class="img-thumbnail mt-2" style="max-width: 150px;">
            <?php endif; ?>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>

<script>
    function updateFileName(input) {
        var fileName = input.files[0].name;
        document.getElementById('file_label').innerText = fileName;
    }
</script>

<?= $this->endSection() ?>