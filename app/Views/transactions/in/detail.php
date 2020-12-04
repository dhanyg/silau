<?= $this->extend('layouts/master'); ?>

<?= $this->section('css-libraries'); ?>
<link rel="stylesheet" href="/vendor/izitoast/css/iziToast.min.css">
<?= $this->endSection(); ?>

<?= $this->section('body'); ?>
<div class="row mb-4">
    <div class="col-lg-4">
        <a class="btn btn-secondary" href="/transactions/transaksi-masuk">Back</a>
    </div>
</div>
<div class="invoice">
    <div class="invoice-print">
        <div class="row">
            <div class="col-lg-12">
                <div class="invoice-title">
                    <h3>Transaksi #<?= $transaksi['id']; ?></h3>
                    <!-- <div class="invoice-number">Order #12345</div> -->
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-2">
                            <strong>Pelanggan:</strong><br>
                            <?= $transaksi['nama']; ?><br>
                        </div>
                        <div class="mb-2">
                            <strong>Layanan:</strong><br>
                            <?= $transaksi['nama_layanan']; ?><br>
                        </div>
                        <div class="mb-2">
                            <strong>Status Transaksi:</strong><br>
                            <?= $transaksi['status'] == 1 ? 'Selesai' : 'Belum Selesai'; ?><br>
                        </div>
                        <div class="">
                            <strong>Pembayaran:</strong><br>
                            <?= $transaksi['lunas'] == 1 ? 'Lunas' : 'Non-lunas'; ?><br>
                        </div>
                    </div>
                    <div class="col-md-6 text-md-right">
                        <div class="mb-2">
                            <strong>Tanggal Masuk:</strong><br>
                            <?= date('d/m/Y', strtotime($transaksi['tgl_masuk'])); ?><br>
                        </div>
                        <div class="mb-2">
                            <strong>Tanggal Selesai:</strong><br>
                            <?= date('d/m/Y', strtotime($transaksi['tgl_selesai'])); ?><br>
                        </div>
                        <div>
                            <strong>Operator:</strong><br>
                            <?= $transaksi['user_creator']; ?><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <!-- <div class="section-title">Order Summary</div> -->
                <p class="section-lead text-right"><strong>Jumlah item:</strong><br><?= $transaksi['jumlah_item']; ?></p>
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-md">
                        <tr>
                            <th data-width="40">#</th>
                            <th>Item</th>
                            <th class="text-center">Jumlah</th>
                            <th class="text-center">Satuan</th>
                            <th class="text-right">Harga</th>
                        </tr>
                        <?php foreach ($items as $item) : ?>
                            <tr>
                                <td>1</td>
                                <td><?= $item['nama_item']; ?></td>
                                <td class="text-center"><?= $item['jumlah']; ?></td>
                                <td class="text-center"><?= $item['satuan']; ?></td>
                                <td class="text-right">Rp<?= number_format($item['harga']); ?></td>
                            </tr>
                        <?php endforeach ?>
                    </table>
                </div>
                <div class="row mt-4">
                    <div class="col-lg-12 text-right">
                        <div class="invoice-detail-item">
                            <div class="invoice-detail-name">Total</div>
                            <div class="invoice-detail-value invoice-detail-value-lg">Rp<?= number_format($transaksi['total_harga']); ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>

    <div class="row mb-3">
        <div class="col-lg-12 text-muted">
            <!-- <div>
                <strong>Created at:</strong>
                27/20/2020 13:51 - User
            </div> -->
            <div>
                <strong>Last modified:</strong>
                <?= date('d/m/Y', strtotime($transaksi['updated_at'])); ?> - <?= $transaksi['user_editor']; ?>
            </div>
        </div>
    </div>

    <div class="text-md-right">
        <div class="float-lg-left mb-lg-0 mb-3">
            <a href="/transactions/transaksi-masuk/edit/<?= $transaksi['id']; ?>" class="btn btn-warning btn-icon icon-left"><i class="fas fa-pen"></i> Edit</a>
            <button type="button" class="btn btn-danger btn-icon icon-left" id="delete"><i class="fas fa-trash"></i> Delete</button>
        </div>
        <a href="/transactions/invoice/generate-pdf/<?= $transaksi['id'] ?>" class="btn btn-primary btn-icon icon-left"><i class="fas fa-print"></i> Print</a>
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

<?= $this->section('custom-script'); ?>
<script>
    $('#delete').fireModal({
        title: 'Delete Confirmation',
        body: `
        <div>
            Yakin ingin menghapus transaksi ?
            <div class="text-right mt-4">
                <button type="button" class="btn btn-secondary mr-1" data-dismiss="modal">Cancel</button>
                <form action="/transactions/transaksi-masuk/delete/<?= $transaksi['id'] ?>" method="post" class="d-inline">
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
        `
    });
</script>
<?= $this->endSection(); ?>