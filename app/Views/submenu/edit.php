<?= $this->extend('layouts/master'); ?>
<?= $this->section('body'); ?>
<div class="row mb-3">
    <div class="col-lg-6">
        <a href="/tools/submenu" class="btn btn-primary">Back</a>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow">
            <form action="/tools/submenu/update/<?= $submenu['id']; ?>" method="post">
                <?= csrf_field(); ?>
                <input type="hidden" name="_method" value="PUT">
                <div class="card-header bg-primary m-0 p-0 rounded-top" style="min-height: 10px;"></div>
                <div class="card-body row">
                    <div class="form-group col-lg-6">
                        <label for="name">Submenu name</label>
                        <input class="form-control <?= $validation->hasError('name') ? 'is-invalid' : ''; ?>" type="text" name="name" id="name" autocomplete="off" value="<?= old('name', $submenu['name']); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('name'); ?>
                        </div>
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="display_name">Display name</label>
                        <input class="form-control <?= $validation->hasError('display_name') ? 'is-invalid' : ''; ?>" type="text" name="display_name" id="display_name" autocomplete="off" value="<?= old('display_name', $submenu['display_name']); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('display_name'); ?>
                        </div>
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="menu_id">Menu Parent</label>
                        <select name="menu_id" id="menu_id" class="custom-select" autofocus>
                            <?php foreach ($all_menu as $menu) : ?>
                                <option value="<?= $menu['id']; ?>" <?= $submenu['menu_id'] == $menu['id'] ? 'selected' : ''; ?>><?= $menu['display_name']; ?></option>
                            <?php endforeach ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= $validation->getError('menu_id'); ?>
                        </div>
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="url">URL</label>
                        <input class="form-control" type="text" name="url" id="url" autocomplete="off" value="<?= old('url', $submenu['url']); ?>" placeholder="Ex: admin/users">
                    </div>
                    <div class="form-group col-lg-6">
                        <label class="custom-switch pl-0 mt-2">
                            <input type="checkbox" name="is_active" class="custom-switch-input" <?= $submenu['is_active'] == 1 ? 'checked' : ''; ?>>
                            <span class="custom-switch-indicator"></span>
                            <span class="custom-switch-description">Enable/Disable Menu</span>
                        </label>
                    </div>
                    <div class="form-group col-lg-6 text-right">
                        <button class="btn btn-danger mr-1" id="delete">Delete</button>
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('custom-script'); ?>
<script>
    $('#delete').fireModal({
        title: 'Delete Confirmation',
        body: `
        <div>
            Yakin ingin menghapus data ?
            <div class="text-right mt-4">
                <button type="button" class="btn btn-secondary mr-1" data-dismiss="modal">Cancel</button>
                <form action="/tools/submenu/delete/<?= $submenu['id'] ?>" method="post" class="d-inline">
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
        `
    });
</script>
<?= $this->endSection(); ?>