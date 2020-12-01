<?= $this->extend('layouts/master'); ?>
<?= $this->section('body'); ?>
<div class="row">
    <div class="col-lg-6">
        <div class="card shadow">
            <form action="/roles/save" method="post">
                <?= csrf_field(); ?>
                <div class="card-header bg-primary m-0 p-0 rounded-top" style="min-height: 10px;"></div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Role name</label>
                        <input class="form-control <?= $validation->hasError('name') ? 'is-invalid' : ''; ?>" type="text" name="name" id="name" autofocus autocomplete="off" value="<?= old('name'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('name'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="display_name">Display name</label>
                        <input class="form-control <?= $validation->hasError('display_name') ? 'is-invalid' : ''; ?>" type="text" name="display_name" id="display_name" autocomplete="off" value="<?= old('display_name'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('display_name'); ?>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <a href="/roles" class="btn btn-danger">Cancel</a>
                    <button class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>