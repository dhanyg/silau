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
                        <a href="/reports/transaksi-masuk" class="my-1 ml-2 btn btn-sm btn-secondary">Reset Filter</a>
                    </form>
                </div>
                <?php if (!$transaksi_masuk) : ?>
                    <h6 class="text-center m-0">Tidak ada data</h6>
                <?php else : ?>
                    <?php if (isset($_GET['dari_tanggal'])) : ?>
                        <a href="/reports/transaksi-masuk/generate-pdf/<?= $_GET['dari_tanggal']; ?>/<?= $_GET['sampai_tanggal']; ?>" class="btn btn-sm btn-danger mb-3"><i class="far fa-file-pdf mr-2"></i>PDF</a>
                    <?php endif ?>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr class="text-center">
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Layanan</th>
                                    <th>Tgl. Masuk</th>
                                    <th>Tgl. Selesai</th>
                                    <th>Harga</th>
                                    <th>Pembayaran</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($transaksi_masuk as $data) : ?>
                                    <tr>
                                        <td class="text-center"><?= $data['id']; ?></td>
                                        <td><?= $data['nama']; ?></td>
                                        <td class="text-center"><?= $data['nama_layanan']; ?></td>
                                        <td class="text-center"><?= date('d-m-Y', strtotime($data['tgl_masuk'])); ?></td>
                                        <td class="text-center"><?= date('d-m-Y', strtotime($data['tgl_selesai'])); ?></td>
                                        <td class="text-right">Rp <?= number_format($data['total_harga']); ?></td>
                                        <td>
                                            <?php if ($data['lunas'] == 1) : ?>
                                                Lunas
                                            <?php else : ?>
                                                Non-lunas
                                            <?php endif ?>
                                        </td>
                                        <td>
                                            <?php if ($data['status'] == 1) : ?>
                                                Selesai
                                            <?php else : ?>
                                                Belum Selesai
                                            <?php endif ?>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                    <?= $pager->links('default', 'custom_pagination') ?>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>
<?php if ($transaksi_masuk) : ?>
    <div class="row">
        <div class="col-sm-6 col-md-3">
            <div class="card shadow">
                <div class="card-body text-center text-md-left">
                    <div class="card-title text-primary font-weight-bolder">Jumlah Transaksi</div>
                    <div class="h3 font-weight-bold mb-0"><?= $count_jumlah_transaksi; ?></div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="card shadow">
                <div class="card-body text-center text-md-left">
                    <div class="card-title text-primary font-weight-bolder">Transaksi Selesai</div>
                    <div class="h3 font-weight-bold mb-0"><?= $count_transaksi_selesai; ?></div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="card shadow">
                <div class="card-body text-center text-md-left">
                    <div class="card-title text-primary font-weight-bolder">Transaksi Laundry</div>
                    <div class="h3 font-weight-bold mb-0"><?= $count_transaksi_laundry; ?></div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="card shadow">
                <div class="card-body text-center text-md-left">
                    <div class="card-title text-primary font-weight-bolder">Transaksi Setrika</div>
                    <div class="h3 font-weight-bold mb-0"><?= $count_transaksi_setrika; ?></div>
                </div>
            </div>
        </div>
    </div>
<?php endif ?>
<?= $this->endSection(); ?>

<?= $this->section('js-libraries'); ?>
<!-- Daterangpicker -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<?= $this->endSection(); ?>