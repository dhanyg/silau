<?= $this->extend('layouts/master'); ?>
<?= $this->section('body'); ?>
<div class="row">
    <div class="col-lg-8">
        <div class="card shadow">
            <form action="/users/save" method="post">
                <?= csrf_field(); ?>
                <div class="card-header bg-primary m-0 p-0 rounded-top" style="min-height: 10px;"></div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <label>Required information <span class="text-danger font-weight-bold">*</span></label>
                        </div>
                        <div class="col-lg-8">
                            <div class="row flex-column">
                                <div class="form-group col-lg">
                                    <label for="username">Username</label>
                                    <input class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?>" type="text" name="username" id="username" value="<?= old('username'); ?>" autofocus autocomplete="off">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('username'); ?>
                                    </div>
                                </div>
                                <div class="form-group col-lg">
                                    <label for="display_name">Display Name</label>
                                    <input class="form-control <?= ($validation->hasError('display_name')) ? 'is-invalid' : ''; ?>" type="text" name="display_name" id="display_name" value="<?= old('display_name'); ?>" autocomplete="off">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('display_name'); ?>
                                    </div>
                                </div>
                                <div class="form-group col-lg">
                                    <label for="role_id">Role</label>
                                    <select name="role_id" id="role_id" class="custom-select <?= $validation->hasError('role_id') ? 'is-invalid' : '' ?>">
                                        <option value="" selected disabled>Choose Role</option>
                                        <?php foreach ($roles as $role) : ?>
                                            <option value="<?= $role['id']; ?>" <?= old('role_id') == $role['id'] ? 'selected' : '' ?>><?= $role['display_name']; ?></option>
                                        <?php endforeach ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('role_id'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-4">
                            <label>Optional information</label>
                        </div>
                        <div class="col-lg-8">
                            <div class="row flex-column">
                                <div class="form-group col-lg">
                                    <label for="email">Email</label>
                                    <input class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>" type="email" name="email" id="email" value="<?= old('email'); ?>" autocomplete="off">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('email'); ?>
                                    </div>
                                </div>
                                <div class="form-group col-lg">
                                    <label for="phone">Phone</label>
                                    <input class="form-control <?= ($validation->hasError('phone')) ? 'is-invalid' : ''; ?>" type="number" name="phone" id="phone" value="<?= old('phone'); ?>" autocomplete="off">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('phone'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-4">
                            <label>Security <span class="text-danger font-weight-bold">*</span></label>
                        </div>
                        <div class="col-lg-8">
                            <div class="row flex-column">
                                <div class="form-group col-lg">
                                    <label for="password">Password</label>
                                    <input class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" type="password" name="password" id="password">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('password'); ?>
                                    </div>
                                </div>
                                <div class="form-group col-lg">
                                    <label for="confirm">Password Confirm</label>
                                    <input class="form-control <?= ($validation->hasError('confirm')) ? 'is-invalid' : ''; ?>" type="password" name="confirm" id="confirm">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('confirm'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg text-right">
                            <a href="/users" class="btn btn-danger">Cancel</a>
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>