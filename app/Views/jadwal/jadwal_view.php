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
            <div class="col-md-6 col-sm-12">
                <div class="title">
                    <h4>Jadwal</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Jadwal</li>
                    </ol>
                </nav>
            </div>
            <?php
            $session = session();

            if ($session->has('username') && $session->has('role')) {
                // Menampilkan tombol tambah dan update visi hanya jika role adalah 'admin'
                if ($session->get('role') == 'admin') {
            ?>
                    <div class="col-md-6 col-sm-12 text-right">
                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#tambahJadwalModal">Tambahkan
                            Jadwal</a>
                    </div>
            <?php
                }
            } else {
                echo 'Welcome, Guest';
            }
            ?>
        </div>
    </div>
    <!-- Simple Datatable start -->
    <div class="card-box mb-30">
        <div class="pd-20">
            <h4 class="text-blue h4">Daftar Kegiatan</h4>
        </div>
        <div class="pb-20">
            <table class="table hover multiple-select-row data-table-export nowrap">
                <thead>
                    <tr>
                        <th class="table-plus datatable-nosort">Informasi</th>
                        <th>Tanggal</th>
                        <th>Keterangan</th>
                        <th>Status</th>
                        <?php
                        $session = session();

                        if ($session->has('username') && $session->has('role')) {
                            // Menampilkan tombol tambah dan update visi hanya jika role adalah 'admin'
                            if ($session->get('role') == 'admin') {
                        ?>
                                <th class="datatable-nosort">Action</th>
                        <?php
                            }
                        } else {
                            echo 'Welcome, Guest';
                        }
                        ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($jadwals as $jadwal) : ?>
                        <tr>
                            <td class="table-plus">
                                <?= $jadwal['pengumuman']; ?>
                            </td>
                            <td>
                                <?= $jadwal['tanggal_jadwal']; ?>
                            </td>
                            <td>
                                <?= $jadwal['keterangan']; ?>
                            </td>
                            <td>
                                <?= $jadwal['status']; ?>
                            </td>
                            <?php
                            $session = session();

                            if ($session->has('username') && $session->has('role')) {
                                // Menampilkan tombol tambah dan update visi hanya jika role adalah 'admin'
                                if ($session->get('role') == 'admin') {
                            ?>
                                    <td>
                                        <div class="dropdown">
                                            <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                                <i class="dw dw-more"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                <a class="dropdown-item" data-toggle="modal" data-target="#editJadwalModal<?= $jadwal['id_jadwal'] ?>"><i class="dw dw-edit2"></i> Edit</a>
                                                <a class="dropdown-item" href="<?= base_url('/jadwal-done/' . $jadwal['id_jadwal']) ?>"><i class="dw dw-check"></i> Terlaksana</a>

                                                <!-- <a href=" ?>" class="btn btn-primary"></a> -->
                                                <a class="dropdown-item" data-toggle="modal" data-target="#hapusJadwalModal<?= $jadwal['id_jadwal'] ?>"><i class="dw dw-delete-3"></i> Delete</a>
                                            </div>
                                        </div>
                                    </td>
                            <?php
                                }
                            } else {
                                echo 'Welcome, Guest';
                            }
                            ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Simple Datatable End -->
    <!-- Modal Tambah Jadwal -->
    <div class="modal fade" id="tambahJadwalModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambahkan Jadwal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Formulir tambah jadwal di sini -->
                    <form action="/jadwal-add/save" method="post">
                        <div class="form-group">
                            <label for="pengumuman">Pengumuman</label>
                            <input type="text" name="pengumuman" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="tanggal_jadwal">Tanggal Jadwal</label>
                            <input type="date" name="tanggal_jadwal" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <input type="text" name="keterangan" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Update Jadwal -->
    <?php foreach ($jadwals as $jadwal) : ?>
        <div class="modal fade" id="editJadwalModal<?= $jadwal['id_jadwal'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Jadwal</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Formulir update jadwal di sini -->
                        <form action="/jadwal-update/update/<?= $jadwal['id_jadwal'] ?>" method="post">
                            <div class="form-group">
                                <label for="pengumuman">Pengumuman</label>
                                <input type="text" name="pengumuman" class="form-control" value="<?= $jadwal['pengumuman'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="tanggal_jadwal">Tanggal Jadwal</label>
                                <input type="date" name="tanggal_jadwal" class="form-control" value="<?= $jadwal['tanggal_jadwal'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <input type="text" name="keterangan" class="form-control" value="<?= $jadwal['keterangan'] ?>">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Hapus Jadwal -->
        <div class="modal fade" id="hapusJadwalModal<?= $jadwal['id_jadwal'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus Jadwal</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Anda yakin ingin menghapus jadwal ini?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <a href="/jadwal-delete/<?= $jadwal['id_jadwal'] ?>/" class="btn btn-danger">Hapus</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<?= $this->endSection() ?>