<?php
/**
 * @var array $user
 * @var \CodeIgniter\Validation\Validation $validation
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit User</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container py-4">
    <h2>Edit User Account</h2>

    <?php if (isset($validation)): ?>
        <div class="alert alert-danger">
            <?= $validation->listErrors() ?>
        </div>
    <?php endif; ?>

    <form action="/users/update/<?= esc($user['id'] ?? '') ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>
        
        <div class="mb-3">
            <label class="form-label">Current Avatar</label><br>
            <?php if (!empty($user['avatar']) && file_exists(FCPATH . 'uploads/avatars/' . $user['avatar'])): ?>
                <img src="/uploads/avatars/<?= esc($user['avatar']) ?>" class="rounded mb-2" width="100" height="100">
            <?php else: ?>
                <img src="https://via.placeholder.com/100?text=No+Image" class="rounded mb-2" width="100" height="100">
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label class="form-label">Upload Profile Picture (JPG/PNG, Max 2MB)</label>
            <input type="file" name="avatar" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Username *</label>
            <input type="text" name="username" class="form-control" value="<?= set_value('username', $user['username'] ?? '') ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Full Name *</label>
            <input type="text" name="full_name" class="form-control" value="<?= set_value('full_name', $user['full_name'] ?? '') ?>">
        </div>

        <button type="submit" class="btn btn-primary">Update User</button>
        <a href="/users" class="btn btn-secondary">Cancel</a>
    </form>
</body>
</html>