<?php
/**
 * @var \CodeIgniter\Validation\Validation $validation
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>New User</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container py-4">
    <h2>Add New User</h2>

    <?php if (isset($validation)): ?>
        <div class="alert alert-danger">
            <?= $validation->listErrors() ?>
        </div>
    <?php endif; ?>

    <form action="/users/create" method="post">
        <?= csrf_field() ?>
        <div class="mb-3">
            <label class="form-label">Username *</label>
            <input type="text" name="username" class="form-control" value="<?= set_value('username') ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Full Name *</label>
            <input type="text" name="full_name" class="form-control" value="<?= set_value('full_name') ?>">
        </div>
        <button type="submit" class="btn btn-success">Save User</button>
        <a href="/users" class="btn btn-secondary">Cancel</a>
    </form>
</body>
</html>