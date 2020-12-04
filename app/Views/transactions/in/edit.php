<?= $this->extend('layouts/master'); ?>

<?= $this->section('css-libraries'); ?>
<!-- Daterangepicker -->
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<?= $this->endSection(); ?>

<?= $this->section('body'); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow">
            <form action="/transactions/transaksi-masuk/update/<?= $transaksi['id']; ?>" method="post">
                <?= csrf_field(); ?>
                <input type="hidden" name="_method" value="PUT">
                <div class="card-header bg-primary m-0 p-0 rounded-top" style="min-height: 10px;"></div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-lg-12">
                            <h6>Nota</h6>
                            <span style="font-size: 2rem;"><?= $transaksi['id']; ?></span>
                        </div>
                    </div>
                    <!-- Nama, Layanan, Tanggal -->
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="nama">Nama</label>
                            <input class="form-control <?= $validation->hasError('nama') ? 'is-invalid' : ''; ?>" type="text" name="nama" id="nama" value="<?= old('nama', $transaksi['nama']); ?>" autofocus autocomplete="off">
                            <div class="invalid-feedback">
                                <?= $validation->getError('nama'); ?>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="layanan_id">Layanan</label>
                            <select name="layanan_id" id="layanan_id" class="custom-select <?= $validation->hasError('layaan_id') ? 'is-invalid' : '' ?>">
                                <option value="" selected disabled>- pilih layanan -</option>
                                <?php foreach ($all_layanan as $layanan) : ?>
                                    <option value="<?= $layanan['id']; ?>" <?= old('layanan_id', $transaksi['layanan_id']) == $layanan['id'] ? 'selected' : ''; ?>><?= $layanan['nama']; ?></option>
                                <?php endforeach ?>
                            </select>
                            <div class="invalid-feedback">
                                <?= $validation->getError('layanan_id'); ?>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="tgl_masuk">Tgl. Masuk</label>
                            <input class="form-control datepicker <?= $validation->hasError('tgl_masuk') ? 'is-invalid' : ''; ?>" type="text" name="tgl_masuk" id="tgl_masuk" value="<?= old('tgl_masuk', $transaksi['tgl_masuk']); ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('tgl_masuk'); ?>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="tgl_selesai">Tgl. Jadi</label>
                            <input class="form-control datepicker <?= $validation->hasError('tgl_selesai') ? 'is-invalid' : ''; ?>" type="text" name="tgl_selesai" id="tgl_selesai" value="<?= old('tgl_selesai', $transaksi['tgl_selesai']); ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('tgl_selesai'); ?>
                            </div>
                        </div>
                    </div>
                    <?php foreach ($items as $item) : ?>
                        <hr>
                        <!-- Item -->
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <input class="form-control <?= $validation->hasError('item') ? 'is-invalid' : '' ?>" type="text" name="item[]" id="item" value="<?= old('item[]', $item['nama_item']); ?>" placeholder="Item" required autocomplete="off">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('item'); ?>
                                </div>
                            </div>
                            <div class="col-md-2 mb-3">
                                <input class="form-control" type="number" name="jumlah[]" id="jumlah" value="<?= old('jumlah[]', $item['jumlah']); ?>" placeholder="Qty" min="0" step="0.1" required autocomplete="off">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('jumlah'); ?>
                                </div>
                            </div>
                            <div class="col-md-2 mb-3">
                                <select name="satuan[]" id="satuan" class="custom-select" required>
                                    <option value="kg" <?= $item['satuan'] == 'kg' ? 'selected' : ''; ?>>kg</option>
                                    <option value="pcs" <?= $item['satuan'] == 'pcs' ? 'selected' : ''; ?>>pcs</option>
                                </select>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('satuan[]'); ?>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <input class="form-control input-harga" type="number" name="harga[]" id="harga" value="<?= old('harga[]', $item['harga']); ?>" placeholder="Harga" min="0" step="100" required autocomplete="off">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('harga'); ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                    <hr id="beforeAddItem">
                    <!-- Lunas, Total Harga -->
                    <div class="row">
                        <div class="col-md-4">
                            <button type="button" class="btn btn-info mb-4" title="tambah item" id="addItem"><i class="fas fa-plus mr-1"></i> Item</button>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="lunas">Pembayaran</label>
                            <select name="lunas" id="lunas" class="custom-select">
                                <option value="0" <?= old('lunas', $transaksi['lunas']) == 0 ? 'selected' : ''; ?>><?= strtoupper('non-lunas'); ?></option>
                                <option value="1" <?= old('lunas', $transaksi['lunas']) == 1 ? 'selected' : ''; ?>><?= strtoupper('lunas'); ?></option>
                            </select>
                            <div class="invalid-feedback">
                                <?= $validation->getError('lunas'); ?>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label for="jumlah_item">Jumlah Item</label>
                            <input class="form-control <?= $validation->hasError('jumlah_item') ? 'is-invalid' : ''; ?>" type="number" name="jumlah_item" id="jumlah_item" value="<?= old('jumlah_item', $transaksi['jumlah_item']); ?>" autocomplete="off">
                            <div class="invalid-feedback">
                                <?= $validation->getError('jumlah_item'); ?>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="total_harga">Total Harga</label>
                            <input class="form-control" type="number" name="total_harga" id="total_harga" value="<?= old('total_harga', $transaksi['total_harga']); ?>" readonly>
                            <div class="invalid-feedback">
                                <?= $validation->getError('total_harga'); ?>
                            </div>
                        </div>
                    </div>
                    <!-- Submit button -->
                    <div class="row">
                        <div class="col-lg text-right">
                            <a href="/transactions/transaksi-masuk/detail/<?= $transaksi['id']; ?>" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-primary">Ubah</button>
                        </div>
                    </div>
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

<?= $this->section('custom-script'); ?>
<script>
    $(document).ready(function() {
        $('#addItem').on('click', function() {
            $('#beforeAddItem').before(`
            <div class="row new-item">
                <div class="col-md-4 mb-3">
                    <input class="form-control" type="text" name="item[]" id="item" value="<?= old('item[]'); ?>" placeholder="Item" required autocomplete="off">
                    <div class="invalid-feedback">
                        <?= $validation->getError('item'); ?>
                    </div>
                </div>
                <div class="col-md-2 mb-3">
                    <input class="form-control" type="number" name="jumlah[]" id="jumlah" value="<?= old('jumlah[]'); ?>" placeholder="Qty" min="0" step="0.1" required autocomplete="off">
                    <div class="invalid-feedback">
                        <?= $validation->getError('jumlah'); ?>
                    </div>
                </div>
                <div class="col-md-2 mb-3">
                    <select name="satuan[]" id="satuan" class="custom-select" required>
                        <option value="0" selected disabled>Satuan</option>
                        <option value="kg">kg</option>
                        <option value="pcs">pcs</option>
                    </select>
                    <div class="invalid-feedback">
                        <?= $validation->getError('satuan'); ?>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="d-flex">
                        <input class="form-control input-harga" type="number" name="harga[]" id="harga" value="<?= old('harga[]'); ?>" placeholder="Harga" min="0" step="100" required autocomplete="off">
                        <button type="button" class="ml-2 px-3 btn btn-sm btn-danger delete-item"><i class="fas fa-minus"></i></button>
                    </div>
                    <div class="invalid-feedback">
                        <?= $validation->getError('harga'); ?>
                    </div>
                </div>
            </div>
            `)
        });

        $('.card-body').on('click', '.delete-item', function(e) {
            $(this).closest('.new-item').remove();
        })

        $("form").on("keyup", ".input-harga", function() {
            totalHarga();
        });
    });

    function totalHarga() {
        let sum = 0;
        $(".input-harga").each(function() {
            if (!isNaN(this.value) && this.value.length != 0) {
                sum = sum + parseFloat(this.value);
            }
        });

        $("#total_harga").val(sum);
    }
</script>
<?= $this->endSection(); ?>