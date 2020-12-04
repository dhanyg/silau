<?= $this->extend('layouts/master'); ?>

<?= $this->section('css-libraries'); ?>
<link rel="stylesheet" href="/vendor/izitoast/css/iziToast.min.css">
<?= $this->endSection(); ?>

<?= $this->section('body'); ?>
<div class="row">
    <div class="col-lg-6">
        <a href="/roles/create" class="btn btn-primary"><i class="fas fa-plus"></i> New Role</a>
        <?php if (isset($_GET['keyword'])) : ?>
            <a href="/roles" class="btn btn-warning">Reset Pencarian</a>
        <?php endif ?>
    </div>
</div>
<div class="row mt-3">
    <div class="col-lg-6">
        <form action="" method="get">
            <div class="input-group">
                <input type="text" class="form-control" name="keyword" placeholder="Ketik nama role" autocomplete="off">
                <div class="input-group-append">
                    <button class="btn btn-secondary" type="submit">Cari</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="row mt-3">
    <div class="col-lg-6">
        <div class="card shadow">
            <div class="card-body">
                <?php if (!$roles) : ?>
                    <h6 class="text-center">Tidak ada data</h6>
                <?php else : ?>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr class="text-center">
                                    <th>#</th>
                                    <th>Role</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1 + ($perPage * ($currentPage - 1));
                                foreach ($roles as $role) : ?>
                                    <tr>
                                        <td class="text-center"><?= $no++; ?></td>
                                        <td><?= $role['display_name']; ?></td>
                                        <td class="text-center">
                                            <a href="/roles/detail/<?= $role['id']; ?>" class="btn btn-info">Detail</a>
                                        </td>
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