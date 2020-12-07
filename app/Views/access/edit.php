<?= $this->extend('layouts/master'); ?>

<?= $this->section('css-libraries'); ?>
<link rel="stylesheet" href="/vendor/izitoast/css/iziToast.min.css">
<?= $this->endSection(); ?>

<?= $this->section('body'); ?>
<?php helper('menuaccess'); ?>
<div class="row">
    <div class="col-lg-4">
        <a href="/tools/access" class="btn btn-primary">Back</a>
    </div>
</div>
<div class="row mt-3">
    <div class="col-lg-12">
        <div class="card shadow">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr class="text-center">
                                <th>Role</th>
                                <th>Menu</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <form action="/tools/access/update/<?= $role['id']; ?>" method="post">
                                    <input type="hidden" name="_method" value="PUT">
                                    <td class="text-center"><?= $role['display_name']; ?></td>
                                    <td class="d-flex align-items-center justify-content-center">
                                        <?php foreach ($all_menu as $menu) : ?>
                                            <div class="form-check mr-3">
                                                <input class="form-check-input" type="checkbox" name="menu_id[]" id="menu-<?= $menu['name']; ?>" value="<?= $menu['id']; ?>" <?= (checkAccess($menu['id'], $role['id']) != false) ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="menu-<?= $menu['name']; ?>"><?= $menu['display_name']; ?></label>
                                            </div>
                                        <?php endforeach ?>
                                    </td>
                                    <td class="text-center">
                                        <button type="submit" class="btn btn-success">Update</button>
                                    </td>
                                </form>
                            </tr>
                        </tbody>
                    </table>
                </div>
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