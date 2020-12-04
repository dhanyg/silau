<?= $this->extend('layouts/master'); ?>

<?= $this->section('css-libraries'); ?>
<!-- Daterangepicker -->
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<?= $this->endSection(); ?>

<?= $this->section('body'); ?>
<div class="row">
    <div class="col-lg-6">
        <div class="card shadow">
            <form action="/cash-flow/pengeluaran/save" method="post">
                <?= csrf_field(); ?>
                <div class="card-header bg-primary m-0 p-0 rounded-top" style="min-height: 10px;"></div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="keterangan">Keterangan Pengeluaran</label>
                        <input class="form-control <?= $validation->hasError('keterangan') ? 'is-invalid' : ''; ?>" type="text" name="keterangan" id="keterangan" value="<?= old('keterangan') ?>" autofocus autocomplete="off">
                        <div class="invalid-feedback">
                            <?= $validation->getError('keterangan'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="jumlah">Tanggal</label>
                        <input class="form-control datepicker <?= $validation->hasError('tanggal') ? 'is-invalid' : ''; ?>" type="text" name="tanggal" id="tanggal" value="<?= old('tanggal') ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('tanggal'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="jumlah">Jumlah (Rp)</label>
                        <input class="form-control <?= $validation->hasError('jumlah') ? 'is-invalid' : ''; ?>" type="number" name="jumlah" id="jumlah" value="<?= old('jumlah') ?>" autocomplete="off">
                        <div class="invalid-feedback">
                            <?= $validation->getError('jumlah'); ?>
                        </div>
                    </div>
                    <a href="/cash-flow/pengeluaran" class="btn btn-secondary">Batal</a>
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