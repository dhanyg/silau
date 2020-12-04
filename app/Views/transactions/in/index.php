<?= $this->extend('layouts/master'); ?>

<?= $this->section('css-libraries'); ?>
<link rel="stylesheet" href="/vendor/izitoast/css/iziToast.min.css">
<?= $this->endSection(); ?>

<?= $this->section('body'); ?>
<div class="row justify-content-between">
    <div class="col-lg-4">
        <a href="/transactions/transaksi-masuk/create" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Data</a>
    </div>
    <?php if (isset($_GET['keyword'])) : ?>
        <div class="col-lg-4">
            <a href="/transactions/transaksi-masuk" class="btn btn-warning">Reset Pencarian</a>
        </div>
    <?php endif ?>
    <div class="col-lg-4">
        <form action="" method="get">
            <div class="input-group">
                <input type="text" class="form-control" name="keyword" placeholder="Ketik nama atau no. transaksi" autocomplete="off">
                <div class="input-group-append">
                    <button class="btn btn-secondary" type="submit">Cari</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="row mt-3">
    <div class="col-lg-12">
        <div class="card shadow">
            <div class="card-body">
                <?php if (!$transaksi_masuk) : ?>
                    <h6 class="text-center m-0">Tidak ada data</h6>
                <?php else : ?>
                    <table class="table table-responsive table-bordered table-striped">
                        <thead>
                            <tr class="text-center">
                                <th>#</th>
                                <th>Nama</th>
                                <th>Layanan</th>
                                <th>Tgl. Masuk</th>
                                <th>Tgl. Selesai</th>
                                <th>Harga</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($transaksi_masuk as $data) : ?>
                                <tr>
                                    <td class="text-center"><?= $data['id']; ?></td>
                                    <td class="d-flex justify-content-between align-items-center"><?= $data['nama']; ?>
                                        <div>
                                            <?php if ($data['lunas'] == 1) : ?>
                                                <span class="bg-primary text-white rounded-pill px-2 py-0">lunas</span>
                                            <?php endif ?>
                                            <?php if ($data['status'] == 1) : ?>
                                                <span class="bg-success text-white rounded-pill px-2 py-0"><i class="fas fa-check"></i></span>
                                            <?php endif ?>
                                        </div>
                                    </td>
                                    <td class="text-center"><?= $data['nama_layanan']; ?></td>
                                    <td class="text-center"><?= date('d-m-Y', strtotime($data['tgl_masuk'])); ?></td>
                                    <td class="text-center"><?= date('d-m-Y', strtotime($data['tgl_selesai'])); ?></td>
                                    <td class="text-right">Rp <?= number_format($data['total_harga']); ?></td>
                                    <td class="text-center">
                                        <a href="/transactions/transaksi-masuk/detail/<?= $data['id']; ?>" class="btn btn-info">Detail</a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                    <?= $pager->links('default', 'custom_pagination') ?>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('js-libraries'); ?>
<!-- Toastr JS -->
<script src="/vendor/izitoast/js/iziToast.min.js"></script>
<script>
    <?php if (session()->getFlashdata('success')) : ?>
        iziToast.success({
            message: "<?= session()->getFlashdata('success'); ?>",
            position: 'topRight',
            timeout: 10000,
        });
    <?php endif ?>
</script>
<?= $this->endSection(); ?>