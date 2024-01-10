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

<div class="row">
    <div class="col-md-8 mb-30">
        <div class="card card-box">
            <div class="card-header">
                Visi:
                <?php if (session()->get('role') == 'admin'): ?>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahVisiModal">
                        Tambah Visi
                    </button>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editVisiModal">
                        Update Visi
                    </button>
                <?php endif; ?>
            </div>
            <div class="card-body">
                <blockquote class="blockquote mb-0">
                    <ul>
                        <?php foreach ($dashboard as $dash): ?>
                            <?php if ($dash['visi'] != null | $dash['visi'] != ''): ?>
                                <li>
                                    <?= $dash['visi']; ?>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </blockquote>
            </div>
        </div>
        <?php if (session()->get('role') == 'admin'): ?>
            <div class="modal fade" id="tambahVisiModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Visi</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Formulir tambah visi di sini -->
                            <form action="<?= base_url() ?>dashboard-add/save/visi" method="post">
                                <label for="visi">Visi</label>
                                <input type="text" name="visi">
                                <button type="submit" class="btn btn-primary">
                                    Tambahkan Visi
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="modal fade" id="editVisiModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Visi</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Formulir edit visi di sini -->
                            <form method="post" action="<?= base_url('/dashboard-update/update/batch/') ?>">
                                <?php foreach ($dashboard as $dash): ?>
                                    <?php if ($dash['visi'] != null | $dash['visi'] != ''): ?>
                                        <div class="form-group">
                                            <input type="text" name="id_dashboard_<?= $dash['id_dashboard'] ?>"
                                                value="<?= $dash['id_dashboard'] ?>" hidden>
                                            <label for="visi<?= $dash['id_dashboard']; ?>">Visi
                                                <?= $dash['id_dashboard']; ?>:
                                            </label>
                                            <input type="text" name="visi_<?= $dash['id_dashboard']; ?>" class="form-control"
                                                value="<?= $dash['visi']; ?>">
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif;?>

        <div class="card card-box mt-4">
            <div class="card-header">
                Misi:
                <?php if (session()->get('role') == 'admin'): ?>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahmisiModal">
                        Tambah Misi
                    </button>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editMisiModal">
                        Update Misi
                    </button>
                <?php endif;?>
            </div>
            <div class="card-body">
                <blockquote class="blockquote mb-0">
                    <ul>
                        <?php foreach ($dashboard as $dash): ?>
                            <?php if ($dash['misi'] != null | $dash['misi'] != ''): ?>
                                <li>
                                    <?= $dash['misi']; ?>
                                    <!-- <a class="btn btn-primary"
                                        href="<?= site_url("/dashboard-update/edit/" . $dash['id_dashboard']); ?>/misi/">Update
                                        Visi</a> -->
                                </li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </blockquote>
            </div>
        </div>
    </div>
    <?php if (session()->get('role') == 'admin'): ?>
        <div class="modal fade" id="tambahmisiModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Misi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Formulir tambah visi di sini -->
                        <form action="<?= base_url() ?>dashboard-add/save/misi" method="post">
                            <label for="misi">Misi</label>
                            <input type="text" name="misi">
                            <button type="submit" class="btn btn-primary">
                                Tambahkan Misi
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="editMisiModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Misi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Formulir edit misi di sini -->
                        <!-- TODO misi belum dibuat -->
                        <form method="post" action="<?= base_url('/dashboard-update/update/batch_misi/') ?>">
                            <?php foreach ($dashboard as $dash): ?>
                                <?php if ($dash['misi'] != null | $dash['misi'] != ''): ?>
                                    <div class="form-group">
                                        <input type="text" name="id_dashboard_<?= $dash['id_dashboard'] ?>"
                                            value="<?= $dash['id_dashboard'] ?>" hidden>
                                        <label for="misi<?= $dash['id_dashboard']; ?>">Visi
                                            <?= $dash['id_dashboard']; ?>:
                                        </label>
                                        <input type="text" name="misi_<?= $dash['id_dashboard']; ?>" class="form-control"
                                            value="<?= $dash['misi']; ?>">
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endif;?>

    <div class="col-md-4 mb-30">
        <div class="card-box height-100-p pd-20">
            <?php foreach ($dashboard as $dash): ?>
                <?php if ($dash['dashboard_gambar'] != null || $dash['dashboard_gambar'] != ''): ?>
                    <!-- Jika ada gambar, tampilkan gambar -->
                    <img src="<?= base_url($dash['dashboard_gambar']); ?>" alt="dashboard_image">
                <?php endif; ?>
            <?php endforeach; ?>
            <?php if (session()->get('role') == 'admin'): ?>
                <form action="
                       <?php if (!empty($dashboard)): ?>
                            <?php $printedlinkupdate = 0 ?>
                            <?php $printedlinkadd = 0 ?>
                            <?php foreach ($dashboard as $dash): ?>
                                <?php
                                if ($dash['dashboard_gambar'] != null || $dash['dashboard_gambar'] != '') {
                                    $printedlinkupdate++;
                                    $selectedid = $dash['id_dashboard'];
                                    break;
                                } else {
                                    $printedlinkadd++;
                                }
                                ?>
                            <?php endforeach; ?>
                            
                            <?php if ($printedlinkupdate > 0): ?>
                                <?= base_url("dashboard-update/update/" . $selectedid . "/gambar"); ?>
                            <?php else: ?>
                                <?= base_url("dashboard-add/save/gambar/") ?>
                            <?php endif; ?>
    
                       <?php else: ?>
                            <?php echo base_url("dashboard-add/save/gambar/"); ?>
                       <?php endif; ?>
                       " method="post" enctype="multipart/form-data">
                    <br />
    
                    <label for="dashboard_gambar">Upload</label>
                    <input type="file" name="dashboard_gambar" class="input-group">
                    <button type="submit" class="btn btn-primary input-group">
                        Upload Gambar
                    </button>
                </form>
            <?php endif;?>

        </div>
    </div>
</div>
<?= $this->endSection() ?>