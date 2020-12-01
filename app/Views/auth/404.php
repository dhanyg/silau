<?= $this->extend('layouts/auth'); ?>
<?= $this->section('body'); ?>
<div class="page-error">
    <div class="page-inner">
        <h1>404</h1>
        <div class="page-description">
            The page you were looking for could not be found.
        </div>
        <div class="page-search">
            <div class="mt-3">
                <a href="/dashboard">Back to Home</a>
            </div>
        </div>
    </div>
</div>
<div class="simple-footer mt-5">
    Copyright &copy; Stisla 2018
</div>
<?= $this->endSection(); ?>