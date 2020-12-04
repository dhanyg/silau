<?= $this->extend('layouts/master'); ?>

<?= $this->section('css-libraries'); ?>
<link rel="stylesheet" href="/vendor/izitoast/css/iziToast.min.css">
<?= $this->endSection(); ?>

<?= $this->section('body'); ?>
<?php helper('menuaccess'); ?>
<div class="row mt-3">
    <div class="col-lg-12">
        <div class="card shadow">
            <div class="card-body">
                <table class="table table-responsive table-bordered table-striped">
                    <thead>
                        <tr class="text-center">
                            <th>#</th>
                            <th>Role</th>
                            <th>Menu</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($roles as $role) : ?>
                            <tr>
                                <td class="text-center"><?= $no++; ?></td>
                                <td><?= $role['display_name']; ?></td>
                                <td class="d-flex align-items-center justify-content-center">
                                    <?php foreach ($all_menu as $menu) : ?>
                                        <div class="form-check mr-3">
                                            <input class="form-check-input" type="checkbox" name="menu_id[]" disabled <?= (checkAccess($menu['id'], $role['id']) != false) ? 'checked' : ''; ?>>
                                            <label class="form-check-label"><?= $menu['display_name']; ?></label>
                                        </div>
                                    <?php endforeach ?>
                                </td>
                                <td class="text-center">
                                    <a href="/tools/access/edit/<?= $role['id']; ?>" class="btn btn-warning">Edit</a>
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