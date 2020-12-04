<?= $this->extend('layouts/master'); ?>

<?= $this->section('css-libraries'); ?>
<link rel="stylesheet" href="/vendor/izitoast/css/iziToast.min.css">
<?= $this->endSection(); ?>

<?= $this->section('body'); ?>
<div class="row justify-content-between">
    <div class="col-lg-4 my-1">
        <a href="/cash-flow/pengeluaran/create" class="btn btn-primary">Tambah Data</a>
    </div>
    <?php if (isset($_GET['keyword'])) : ?>
        <div class="col-lg-4 my-1">
            <a href="/cash-flow/pengeluaran" class="btn btn-warning">Reset Pencarian</a>
        </div>
    <?php endif ?>
    <div class="col-lg-4 my-1">
        <form action="" method="get">
            <div class="input-group">
                <input type="text" class="form-control" name="keyword" placeholder="Ketik kata pencarian" autocomplete="off">
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
                <?php if (!$pengeluaran) : ?>
                    <h6 class="text-center m-0">Tidak ada data</h6>
                <?php else : ?>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr class="text-center">
                                    <th>#</th>
                                    <th>Keterangan</th>
                                    <th>Tanggal</th>
                                    <th>Jumlah</th>
                                    <th>Action</th>
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
                                        <td class="text-center">
                                            <a href="/cash-flow/pengeluaran/edit/<?= $data['id']; ?>" class="btn btn-warning">Edit</a>
                                            <button type="button" class="btn btn-danger" id="delete-<?= $data['id'] ?>">Delete</button>
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
    <?php foreach ($pengeluaran as $data) : ?>
        $('#delete-<?= $data['id'] ?>').fireModal({
            title: 'Delete Confirmation',
            body: `
        <div>
            Yakin ingin menghapus data ?
            <div class="text-right mt-4">
                <button type="button" class="btn btn-secondary mr-1" data-dismiss="modal">Cancel</button>
                <form action="/cash-flow/pengeluaran/delete/<?= $data['id'] ?>" method="post" class="d-inline">
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
        `
        });
    <?php endforeach ?>
</script>
<?= $this->endSection(); ?>