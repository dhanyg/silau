<?= $this->extend('layouts/master'); ?>

<?= $this->section('css-libraries'); ?>
<!-- Daterangepicker -->
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<?= $this->endSection(); ?>

<?= $this->section('body'); ?>
<div class="row mt-3">
    <div class="col-lg-12">
        <div class="card shadow">
            <div class="card-body">
                <div class="mb-4">
                    <h5 class="text-center mb-3">Filter Laporan</h5>
                    <form action="" method="GET" class="form-inline justify-content-center">
                        <label for="dari_tanggal" class="my-1 ">Dari</label>
                        <input type="text" class="my-1 datepicker mx-2 form-control form-control-sm" name="dari_tanggal" id="dari_tanggal" required>
                        <label for="sampai_tanggal" class="my-1 ">Sampai</label>
                        <input type="text" class="my-1 datepicker mx-2 form-control form-control-sm" name="sampai_tanggal" id="sampai_tanggal" required>
                        <button type="submit" class="my-1 ml-1 btn btn-sm btn-primary">Filter</button>
                        <a href="/reports/transaksi-pengambilan" class="my-1 ml-2 btn btn-sm btn-secondary">Reset Filter</a>
                    </form>
                </div>
                <?php if (!$pengambilan) : ?>
                    <h6 class="text-center m-0">Tidak ada data</h6>
                <?php else : ?>
                    <?php if (isset($_GET['dari_tanggal'])) : ?>
                        <a href="/reports/transaksi-pengambilan/generate-pdf/<?= $_GET['dari_tanggal']; ?>/<?= $_GET['sampai_tanggal']; ?>" class="btn btn-sm btn-danger mb-3"><i class="far fa-file-pdf mr-2"></i>PDF</a>
                    <?php endif ?>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr class="text-center">
                                    <th>#</th>
                                    <th>Tgl. Ambil</th>
                                    <th class="text-left">Nama</th>
                                    <th>No. Transaksi</th>
                                    <th>Operator</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1 + ($perPage * ($currentPage - 1));
                                foreach ($pengambilan as $data) : ?>
                                    <tr>
                                        <td class="text-center"><?= $no++; ?></td>
                                        <td class="text-center"><?= $data['tgl_ambil']; ?></td>
                                        <td><?= $data['nama']; ?></td>
                                        <td class="text-center"><?= $data['transaksi_masuk_id']; ?></td>
                                        <td class="text-center"><?= $data['user_creator']; ?></td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="d-sm-flex justify-content-between align-items-center">
                        <?= $pager->links('default', 'custom_pagination') ?>
                        <div>Jumlah Pengambilan : <?= $count_jumlah_pengambilan; ?></div>
                    </div>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('js-libraries'); ?>
<!-- Daterangpicker -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<?= $this->endSection(); ?>