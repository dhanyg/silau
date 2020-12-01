<?= $this->extend('layouts/master'); ?>
<?= $this->section('body'); ?>
<div class="row mb-3">
    <div class="col-lg-6">
        <a href="/tools/menu" class="btn btn-primary">Back</a>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow">
            <form action="/tools/menu/update/<?= $menu['id']; ?>" method="post">
                <?= csrf_field(); ?>
                <input type="hidden" name="_method" value="PUT">
                <div class="card-header bg-primary m-0 p-0 rounded-top" style="min-height: 10px;"></div>
                <div class="card-body row">
                    <div class="form-group col-lg-6">
                        <label for="name">Menu name</label>
                        <input class="form-control <?= $validation->hasError('name') ? 'is-invalid' : ''; ?>" type="text" name="name" id="name" autocomplete="off" value="<?= old('name', $menu['name']); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('name'); ?>
                        </div>
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="display_name">Display name</label>
                        <input class="form-control <?= $validation->hasError('display_name') ? 'is-invalid' : ''; ?>" type="text" name="display_name" id="display_name" autocomplete="off" value="<?= old('display_name', $menu['display_name']); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('display_name'); ?>
                        </div>
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="type">Type</label>
                        <select name="type" id="type" class="custom-select">
                            <option value="static" <?= $menu['type'] === 'static' ? 'selected' : ''; ?>>Static</option>
                            <option value="dynamic" <?= $menu['type'] === 'dynamic' ? 'selected' : ''; ?>>Dynamic</option>
                        </select>
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="url">URL</label>
                        <input class="form-control" type="text" name="url" id="url" autocomplete="off" value="<?= old('url', $menu['url']); ?>">
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="icon">Icon</label>
                        <input class="form-control" type="text" name="icon" id="icon" autocomplete="off" value="<?= old('icon', $menu['icon']); ?>">
                    </div>
                    <div class="form-group col-lg-6 d-flex align-items-end justify-content-between">
                        <label class="custom-switch pl-0 mt-2">
                            <input type="checkbox" name="is_active" class="custom-switch-input" <?= $menu['is_active'] == 1 ? 'checked' : ''; ?>>
                            <span class="custom-switch-indicator"></span>
                            <span class="custom-switch-description">Enable/Disable Menu</span>
                        </label>
                        <div>
                            <button class="btn btn-danger mr-1" id="delete">Delete</button>
                            <button type="submit" class="btn btn-success">Update</button>
                        </div>
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
            Yakin ingin menghapus menu ?
            <div class="text-right mt-4">
                <button type="button" class="btn btn-secondary mr-1" data-dismiss="modal">Cancel</button>
                <form action="/tools/menu/delete/<?= $menu['id'] ?>" method="post" class="d-inline">
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
        `
    });
</script>
<?= $this->endSection(); ?>