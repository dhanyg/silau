<?= $this->extend('layouts/master'); ?>

<?= $this->section('css-libraries'); ?>
<link rel="stylesheet" href="/vendor/izitoast/css/iziToast.min.css">
<?= $this->endSection(); ?>

<?= $this->section('body'); ?>
<div class="row">
    <div class="col-lg-4">
        <a href="/roles/create" class="btn btn-primary"><i class="fas fa-plus"></i> New Role</a>
    </div>
</div>
<div class="row mt-3">
    <div class="col-lg-6">
        <div class="card shadow">
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr class="text-center">
                            <th>#</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
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