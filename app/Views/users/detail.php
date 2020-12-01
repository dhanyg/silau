<?= $this->extend('layouts/master'); ?>

<?= $this->section('css-libraries'); ?>
<link rel="stylesheet" href="/vendor/izitoast/css/iziToast.min.css">
<?= $this->endSection(); ?>

<?= $this->section('body'); ?>

<div class="row">
    <div class="col-lg-4">
        <a href="/users" class="btn btn-primary"><i class="fas fa-plus"></i> Back</a>
    </div>
</div>
<div class="row mt-3">
    <div class="col-lg-12">
        <div class="card shadow">
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr class="text-center">
                            <th>Name</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Password</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-center">
                            <td><?= $user['display_name']; ?></td>
                            <td><?= $user['username']; ?></td>
                            <td><?= $user['role_name']; ?></td>
                            <td><?= $user['email'] ? $user['email'] : '-'; ?></td>
                            <td><?= $user['phone'] ? $user['phone'] : '-'; ?></td>
                            <td><?= $user['password'] ? '********' : '-'; ?></td>
                            <td>
                                <a href="/users/edit/<?= $user['id']; ?>" class="btn btn-info">Edit</a>
                                <button class="btn btn-warning" id="reset">Reset Password</button>
                                <button class="btn btn-danger" id="delete">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <button class="btn btn-secondary" disabled><em>Created on : <?= date('d M y', strtotime($user['created_at'])); ?></em></button>
                <button class="btn btn-secondary" disabled><em>Last modified : <?= date('d M y', strtotime($user['updated_at'])); ?></em></button>
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
            Yakin ingin menghapus user ?
            <div class="text-right mt-4">
                <button type="button" class="btn btn-secondary mr-1" data-dismiss="modal">Cancel</button>
                <form action="/users/delete/<?= $user['id'] ?>" method="post" class="d-inline">
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
        `
    });
    $('#reset').fireModal({
        title: 'Reset Password Confirmation',
        body: `
        <div>
            Yakin ingin mereset password user ?
            <div class="text-right mt-4">
                <button type="button" class="btn btn-secondary mr-1" data-dismiss="modal">Cancel</button>
                <a href="/users/reset/<?= $user['id'] ?>" class="btn btn-danger">Reset</a>
            </div>
        </div>
        `
    });
</script>
<?= $this->endSection(); ?>