<?= $this->extend('layouts/master'); ?>

<?= $this->section('css-libraries'); ?>
<link rel="stylesheet" href="/vendor/izitoast/css/iziToast.min.css">
<?= $this->endSection(); ?>

<?= $this->section('body'); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="alert alert-info d-flex align-items-center shadow">
            <i class="fas fa-info-circle mr-3" style="font-size: 3rem;"></i>
            Informasi di bawah ini sudah tercatat secara otomatis. Apabila terdapat transaksi masuk dengan status lunas atau transaksi pengambilan maka pembayaran akan otomatis tercatat di sini. Begitu juga jika terdapat perubahan pada transaksi masuk dan transaksi pengambilan.</div>
    </div>
</div>
<div class="row mt-3">
    <div class="col-lg-12">
        <div class="card shadow">
            <div class="card-body">
                <?php if (!$pemasukan) : ?>
                    <h6 class="text-center m-0">Belum ada transaksi</h6>
                <?php else : ?>
                    <table class="table table-responsive table-bordered table-striped">
                        <thead>
                            <tr class="text-center">
                                <th>#</th>
                                <th>Tanggal</th>
                                <th>Keterangan</th>
                                <th>No. Transaksi</th>
                                <th>Jumlah</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1 + ($perPage * ($currentPage - 1));
                            foreach ($pemasukan as $data) : ?>
                                <tr>
                                    <td class="text-center"><?= $no++; ?></td>
                                    <td class="text-center"><?= date('d/m/Y', strtotime($data['tanggal'])); ?></td>
                                    <td><?= $data['keterangan']; ?></td>
                                    <td class="text-center"><?= $data['transaksi_masuk_id']; ?></td>
                                    <td class="text-right">Rp<?= number_format($data['jumlah']); ?></td>
                                    <td class="text-center">
                                        <a href="/transactions/transaksi-masuk/detail/<?= $data['transaksi_masuk_id']; ?>" class="btn btn-info rounded-pill">Detail Transaksi</a>
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