<?php
/**
 * @var array $users
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>User Management</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container py-4">

    <!-- Header with User Greeting and Logout Button -->
    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
        <h2 class="mb-0">User Accounts</h2>
        <div>
            <span class="me-3">Logged in as: <strong><?= esc(session()->get('full_name') ?? session()->get('username')) ?></strong></span>
            <a href="/logout" class="btn btn-outline-danger btn-sm">Logout</a>
        </div>
    </div>

    <a href="/users/new" class="btn btn-primary mb-3">Add New User</a>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <table class="table table-bordered align-middle">
        <thead>
            <tr>
                <th>Avatar</th>
                <th>ID</th>
                <th>Username</th>
                <th>Full Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($users) && is_array($users)): ?>
                <?php foreach ($users as $user): ?>
                <tr>
                    <td class="text-center" style="width: 80px;">
                        <?php if (!empty($user['avatar']) && file_exists(FCPATH . 'uploads/avatars/' . $user['avatar'])): ?>
                            <img src="/uploads/avatars/<?= esc($user['avatar']) ?>" alt="Avatar" class="rounded-circle" width="50" height="50">
                        <?php else: ?>
                            <img src="https://via.placeholder.com/50?text=User" alt="Placeholder" class="rounded-circle" width="50" height="50">
                        <?php endif; ?>
                    </td>
                    <td><?= esc($user['id'] ?? '') ?></td>
                    <td><?= esc($user['username'] ?? '') ?></td>
                    <td><?= esc($user['full_name'] ?? '') ?></td>
                    <td>
                        <a href="/users/edit/<?= esc($user['id'] ?? '') ?>" class="btn btn-sm btn-warning">Edit</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center">No users found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>