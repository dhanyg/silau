<?= $this->extend('layouts/master'); ?>

<?= $this->section('css-libraries'); ?>
<!-- Daterangepicker -->
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<?= $this->endSection(); ?>

<?= $this->section('body'); ?>
<?php if (session()->getFlashdata('error')) : ?>
    <div class="row">
        <div class="col-lg-6">
            <div class="alert alert-danger d-flex justify-content-between align-items-center">
                <?= session()->getFlashdata('error'); ?>
                <i class="fas fa-times"></i>
            </div>
        </div>
    </div>
<?php endif ?>
<div class="row">
    <div class="col-lg-6">
        <div class="card shadow">
            <form action="/transactions/transaksi-pengambilan/save" method="post">
                <?= csrf_field(); ?>
                <div class="card-header bg-primary m-0 p-0 rounded-top" style="min-height: 10px;"></div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="tgl_ambil">Tgl. Ambil</label>
                        <input class="form-control datepicker <?= $validation->hasError('tgl_ambil') ? 'is-invalid' : ''; ?>" type="text" name="tgl_ambil" id="tgl_ambil" value="<?= old('tgl_ambil') ?>" autofocus>
                        <div class="invalid-feedback">
                            <?= $validation->getError('tgl_ambil'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="transaksi_masuk_id">No. Transaksi</label>
                        <input class="form-control <?= $validation->hasError('transaksi_masuk_id') ? 'is-invalid' : ''; ?>" type="number" name="transaksi_masuk_id" id="transaksi_masuk_id" value="<?= old('transaksi_masuk_id') ?>" autocomplete="off">
                        <div class="invalid-feedback">
                            <?= $validation->getError('transaksi_masuk_id'); ?>
                        </div>
                    </div>
                    <a href="/transactions/transaksi-pengambilan" class="btn btn-secondary">Batall</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('js-libraries'); ?>
<!-- Daterangpicker -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<?= $this->endSection(); ?>