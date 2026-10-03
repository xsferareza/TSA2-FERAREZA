<?php
/**
 * @var array $customer
 * @var \CodeIgniter\Validation\Validation $validation
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Customer</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container py-4">
    <h2>Edit Customer</h2>

    <?php if (isset($validation)): ?>
        <div class="alert alert-danger">
            <?= $validation->listErrors() ?>
        </div>
    <?php endif; ?>

    <form action="/customers/update/<?= esc($customer['id'] ?? '') ?>" method="post">
        <?= csrf_field() ?>
        <div class="mb-3">
            <label class="form-label">Full Name *</label>
            <input type="text" name="full_name" class="form-control" value="<?= set_value('full_name', $customer['full_name'] ?? '') ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Email *</label>
            <input type="email" name="email" class="form-control" value="<?= set_value('email', $customer['email'] ?? '') ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Phone</label>
            <input type="text" name="phone" class="form-control" value="<?= set_value('phone', $customer['phone'] ?? '') ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Address</label>
            <textarea name="address" class="form-control"><?= set_value('address', $customer['address'] ?? '') ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update Customer</button>
        <a href="/customers" class="btn btn-secondary">Cancel</a>
    </form>
</body>
</html>