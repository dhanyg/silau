<?= $this->extend('layouts/auth'); ?>
<?= $this->section('body'); ?>
<div class="row">
    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
        <div class="login-brand">
            <!-- <img src="/assets/img/stisla-fill.svg" alt="logo" width="100" class="shadow-light rounded-circle"> -->
            S!LAU
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>Login</h4>
            </div>

            <div class="card-body">
                <?php if (session()->getFlashdata('error')) : ?>
                    <div class="alert alert-danger d-flex justify-content-between align-items-center"><?= session()->getFlashdata('error'); ?> <i class="fas fa-times"></i></div>
                <?php endif ?>
                <form method="POST" action="/auth">
                    <?= csrf_field(); ?>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input id="username" type="text" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?>" name="username" value="<?= old('username'); ?>" tabindex="1" autocomplete="off" autofocus>
                        <div class="invalid-feedback">
                            <?= $validation->getError('username'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="d-block">
                            <label for="password" class="control-label">Password</label>
                            <!-- <div class="float-right">
                                <a href="auth-forgot-password.html" class="text-small">
                                    Forgot Password?
                                </a>
                            </div> -->
                        </div>
                        <input id="password" type="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" name="password" tabindex="2">
                        <div class="invalid-feedback">
                            <?= $validation->getError('password'); ?>
                        </div>
                    </div>

                    <!-- <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                                            <label class="custom-control-label" for="remember-me">Remember Me</label>
                                        </div>
                                    </div> -->

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                            Login
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <!-- <div class="mt-5 text-muted text-center">
            Don't have an account? <a href="auth-register.html">Create One</a>
        </div> -->
        <div class="simple-footer">
            Copyright &copy; <?= date("Y"); ?>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>