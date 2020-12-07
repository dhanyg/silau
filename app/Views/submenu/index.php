<?= $this->extend('layouts/master'); ?>

<?= $this->section('css-libraries'); ?>
<link rel="stylesheet" href="/vendor/izitoast/css/iziToast.min.css">
<?= $this->endSection(); ?>

<?= $this->section('body'); ?>
<div class="row">
    <div class="col-lg-4">
        <a href="/tools/submenu/create" class="btn btn-primary"><i class="fas fa-plus"></i> New Submenu</a>
    </div>
</div>
<div class="row mt-3">
    <div class="col-lg-6">
        <form action="" method="get">
            <div class="input-group">
                <input type="text" class="form-control" name="keyword" placeholder="Ketik nama submenu" autocomplete="off">
                <div class="input-group-append">
                    <button class="btn btn-secondary" type="submit">Cari</button>
                </div>
            </div>
        </form>
    </div>
    <?php if (isset($_GET['keyword'])) : ?>
        <div class="col-lg-2">
            <a href="/tools/submenu" class="btn btn-warning">Reset Pencarian</a>
        </div>
    <?php endif ?>
</div>
<div class="row mt-3">
    <div class="col-lg-8">
        <div class="card shadow">
            <div class="card-body">
                <?php if (!$all_submenu) : ?>
                    <h6 class="text-center">Tidak ada data</h6>
                <?php else : ?>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr class="text-center">
                                    <th>#</th>
                                    <th>Submenu</th>
                                    <th>Menu Parent</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1 + ($perPage * ($currentPage - 1));
                                foreach ($all_submenu as $submenu) : ?>
                                    <tr>
                                        <td class="text-center"><?= $no++; ?></td>
                                        <td><?= $submenu['display_name']; ?></td>
                                        <td><?= $submenu['menu_name']; ?></td>
                                        <td class="text-center">
                                            <a href="/tools/submenu/edit/<?= $submenu['id']; ?>" class="btn btn-info">Edit</a>
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