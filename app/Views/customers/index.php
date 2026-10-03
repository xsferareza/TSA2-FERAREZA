<?php
/**
 * @var array $customers
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Customer Management</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container py-4">

    <!-- Header with User Greeting and Logout Button -->
    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
        <h2 class="mb-0">Customer List</h2>
        <div>
            <span class="me-3">Logged in as: <strong><?= esc(session()->get('full_name') ?? session()->get('username')) ?></strong></span>
            <a href="/logout" class="btn btn-outline-danger btn-sm">Logout</a>
        </div>
    </div>

    <a href="/customers/new" class="btn btn-primary mb-3">Add New Customer</a>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <table class="table table-bordered align-middle">
        <thead>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($customers) && is_array($customers)): ?>
                <?php foreach ($customers as $customer): ?>
                <tr>
                    <td><?= esc($customer['id'] ?? '') ?></td>
                    <td><?= esc($customer['full_name'] ?? '') ?></td>
                    <td><?= esc($customer['email'] ?? '') ?></td>
                    <td><?= esc($customer['phone'] ?? '') ?></td>
                    <td>
                        <a href="/customers/edit/<?= esc($customer['id'] ?? '') ?>" class="btn btn-sm btn-warning">Edit</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center">No customers found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>