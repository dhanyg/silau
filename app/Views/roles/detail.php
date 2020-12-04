<?= $this->extend('layouts/master'); ?>

<?= $this->section('css-libraries'); ?>
<link rel="stylesheet" href="/vendor/izitoast/css/iziToast.min.css">
<?= $this->endSection(); ?>

<?= $this->section('body'); ?>
<div class="row">
    <div class="col-lg-4">
        <a href="/roles" class="btn btn-primary">Back</a>
    </div>
</div>
<div class="row mt-3">
    <div class="col-lg-6">
        <div class="card shadow">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr class="text-center">
                                <th>Role Name</th>
                                <th>Display Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?= $role['name']; ?></td>
                                <td><?= $role['display_name']; ?></td>
                                <td class="text-center">
                                    <a href="/roles/edit/<?= $role['id']; ?>" class="btn btn-warning">Edit</a>
                                    <button class="btn btn-danger" id="delete">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('js-libraries'); ?>
<!-- Toastr JS -->
<script src="/vendor/izitoast/js/iziToast.min.js"></script>
<script>
    <?php if (session()->getFlashdata('success')) : ?>
        iziToast.success({
            message: "<?= session()->getFlashdata('success'); ?>",
            position: 'topRight',
            timeout: 10000,
        });
    <?php endif ?>
</script>
<?= $this->endSection(); ?>

<?= $this->section('custom-script'); ?>
<script>
    $('#delete').fireModal({
        title: 'Delete Confirmation',
        body: `
        <div>
            Yakin ingin menghapus role ?
            <div class="text-right mt-4">
                <button type="button" class="btn btn-secondary mr-1" data-dismiss="modal">Cancel</button>
                <form action="/roles/delete/<?= $role['id'] ?>" method="post" class="d-inline">
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
        `
    });
</script>
<?= $this->endSection(); ?>