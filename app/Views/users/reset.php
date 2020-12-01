<?= $this->extend('layouts/auth'); ?>
<?= $this->section('body'); ?>
<div class="row">
    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">

        <div class="card card-primary mt-5">
            <div class="card-header">
                <h4>Reset Password - <?= $user['display_name']; ?></h4>
            </div>

            <div class="card-body">
                <form method="POST" action="/users/changepass/<?= $user['id']; ?>">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="_method" value="PATCH">
                    <div class="form-group">
                        <label for="password">New Password</label>
                        <input id="password" type="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" name="password" tabindex="1" autocomplete="off" autofocus>
                        <div class="invalid-feedback">
                            <?= $validation->getError('password'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="confirmation" class="control-label">Password Confirmation</label>
                        <input id="confirmation" type="password" class="form-control <?= ($validation->hasError('confirmation')) ? 'is-invalid' : ''; ?>" name="confirmation" tabindex="2">
                        <div class="invalid-feedback">
                            <?= $validation->getError('confirmation'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                            Change
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>