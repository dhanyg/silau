<?= $this->extend('layouts/master'); ?>
<?= $this->section('body'); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow">
            <form action="/tools/menu/save" method="post">
                <?= csrf_field(); ?>
                <div class="card-header bg-primary m-0 p-0 rounded-top" style="min-height: 10px;"></div>
                <div class="card-body row">
                    <div class="form-group col-lg-6">
                        <label for="name">Menu name</label>
                        <input class="form-control <?= $validation->hasError('name') ? 'is-invalid' : ''; ?>" type="text" name="name" id="name" autofocus autocomplete="off" value="<?= old('name'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('name'); ?>
                        </div>
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="display_name">Display name</label>
                        <input class="form-control <?= $validation->hasError('display_name') ? 'is-invalid' : ''; ?>" type="text" name="display_name" id="display_name" autocomplete="off" value="<?= old('display_name'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('display_name'); ?>
                        </div>
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="type">Type</label>
                        <select name="type" id="type" class="custom-select">
                            <option value="static" selected>Static</option>
                            <option value="dynamic">Dynamic</option>
                        </select>
                        <div class="invalid-feedback">
                            <?= $validation->getError('type'); ?>
                        </div>
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="url">URL</label>
                        <input class="form-control" type="text" name="url" id="url" autocomplete="off" value="<?= old('url'); ?>" placeholder="parent-menu/submenu">
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="icon">Icon</label>
                        <input class="form-control" type="text" name="icon" id="icon" autocomplete="off" value="<?= old('icon'); ?>" placeholder="fas fa-fw fa-icon-name">
                    </div>
                    <div class="form-group col-lg-6 d-flex align-items-end justify-content-between">
                        <label class="custom-switch pl-0 mt-2">
                            <input type="checkbox" name="is_active" class="custom-switch-input">
                            <span class="custom-switch-indicator"></span>
                            <span class="custom-switch-description">Enable/Disable Menu</span>
                        </label>
                        <div>
                            <a href="/tools/menu" class="btn btn-danger mr-1">Cancel</a>
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>