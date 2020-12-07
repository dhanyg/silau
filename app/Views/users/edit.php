<?= $this->extend('layouts/master'); ?>
<?= $this->section('body'); ?>
<div class="row">
    <div class="col-lg-8">
        <div class="card shadow">
            <div class="card-header bg-primary m-0 p-0 rounded-top" style="min-height: 10px;"></div>
            <div class="card-body">
                <form action="/users/update/<?= $user['id']; ?>" method="post">
                    <input type="hidden" name="_method" value="PUT">
                    <div class="form-group row">
                        <label for="display_name" class="col-sm-4 col-form-label text-sm-right">Name</label>
                        <div class="col-sm">
                            <input type="text" class="form-control form-control-sm <?= $validation->hasError('display_name') ? 'is-invalid' : ''; ?>" name="display_name" id="display_name" value="<?= old('display_name', $user['display_name']); ?>" autocomplete="off">
                            <div class="invalid-feedback">
                                <?= $validation->getError('display_name'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="username" class="col-sm-4 col-form-label text-sm-right">Username</label>
                        <div class="col-sm">
                            <input type="text" class="form-control form-control-sm <?= $validation->hasError('username') ? 'is-invalid' : ''; ?>" name="username" id="username" value="<?= old('username', $user['username']); ?>" autocomplete="off">
                            <div class="invalid-feedback">
                                <?= $validation->getError('username'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="role_id" class="col-sm-4 col-form-label text-sm-right">Role</label>
                        <div class="col-sm">
                            <select name="role_id" id="role_id" class="custom-select custom-select-sm">
                                <?php foreach ($roles as $role) : ?>
                                    <option value="<?= $role['id']; ?>" <?= $user['role_id'] == $role['id'] ? 'selected' : ''; ?>><?= $role['display_name']; ?></option>
                                <?php endforeach ?>
                            </select>
                            <div class="invalid-feedback">
                                <?= $validation->getError('role_id'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-4 col-form-label text-sm-right">Email</label>
                        <div class="col-sm">
                            <input type="email" class="form-control form-control-sm <?= $validation->hasError('email') ? 'is-invalid' : ''; ?>" name="email" id="email" value="<?= old('email', $user['email']); ?>" autocomplete="off">
                            <div class="invalid-feedback">
                                <?= $validation->getError('email'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phone" class="col-sm-4 col-form-label text-sm-right">Phone</label>
                        <div class="col-sm">
                            <input type="text" class="form-control form-control-sm <?= $validation->hasError('phone') ? 'is-invalid' : ''; ?>" name="phone" id="phone" value="<?= old('phone', $user['phone']); ?>" autocomplete="off">
                            <div class="invalid-feedback">
                                <?= $validation->getError('phone'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <a href="/users/detail/<?= $user['id']; ?>" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-info">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>