<?= $this->extend('layout/base') ?>
<?= $this->section('content') ?>
<div class="min-height-200px">
    <div class="page-header">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="title">
                    <h1>Laporan kegiatan</h1>
                </div>
                <br>
                <a href="/laporan/xls" class="btn btn-primary">Export Excel</a>
                <br><br>
                <div class="col-md-12 col-sm-12">
                    <table class="table">
                        <tr>
                            <th>Tanggal</th>
                            <th>Pengumuman</th>
                            <th>Keterangan</th>
                        </tr>
                        <?php foreach ($laporans as $laporan): ?>
                            <tr>
                                <td>
                                    <?= $laporan->tanggal_jadwal ?>
                                </td>
                                <td>
                                    <?= $laporan->pengumuman ?>
                                </td>
                                <td>
                                    <?= $laporan->keterangan ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
