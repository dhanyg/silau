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
                        <a href="/reports/pengeluaran" class="my-1 ml-2 btn btn-sm btn-secondary">Reset Filter</a>
                    </form>
                </div>
                <?php if (!$pengeluaran) : ?>
                    <h6 class="text-center m-0">Tidak ada data</h6>
                <?php else : ?>
                    <?php if (isset($_GET['dari_tanggal'])) : ?>
                        <a href="/reports/pengeluaran/generate-pdf/<?= $_GET['dari_tanggal']; ?>/<?= $_GET['sampai_tanggal']; ?>" class="btn btn-sm btn-danger mb-3"><i class="far fa-file-pdf mr-2"></i>PDF</a>
                    <?php endif ?>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr class="text-center">
                                    <th>#</th>
                                    <th class="text-left">Keterangan</th>
                                    <th>Tanggal</th>
                                    <th class="text-right">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1 + ($perPage * ($currentPage - 1));
                                foreach ($pengeluaran as $data) : ?>
                                    <tr>
                                        <td class="text-center"><?= $no++; ?></td>
                                        <td><?= $data['keterangan']; ?></td>
                                        <td class="text-center"><?= date('d/m/Y', strtotime($data['tanggal'])); ?></td>
                                        <td class="text-right">Rp<?= number_format($data['jumlah']); ?></td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                    <?= $pager->links('default', 'custom_pagination'); ?>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>
<?php if ($pengeluaran) : ?>
    <div class="row">
        <div class="col-sm-6 col-md-3">
            <div class="card shadow">
                <div class="card-body text-center text-md-left">
                    <div class="card-title text-primary font-weight-bolder">Total Pengeluaran</div>
                    <div class="h3 font-weight-bold mb-0"><?= number_format($total_pengeluaran); ?></div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="card shadow">
                <div class="card-body text-center text-md-left">
                    <div class="card-title text-primary font-weight-bolder">Jumlah Data</div>
                    <div class="h3 font-weight-bold mb-0"><?= $count_jumlah_data; ?></div>
                </div>
            </div>
        </div>
    <?php endif ?>
    <?= $this->endSection(); ?>

    <?= $this->section('js-libraries'); ?>
    <!-- Daterangpicker -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <?= $this->endSection(); ?>