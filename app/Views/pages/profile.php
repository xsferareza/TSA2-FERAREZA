<?= view('templates/header'); ?>

<div class="card col-md-6 mx-auto">
    <div class="card-header bg-dark text-white fw-bold">Demo User Profile</div>
    <div class="card-body">
        <?php if (!empty($user)): ?>
            <p><strong>Username:</strong> <?= esc($user['username']); ?></p>
            <p><strong>Full Name:</strong> <?= esc($user['full_name']); ?></p>
            <p><strong>Email:</strong> <?= esc($user['email']); ?></p>
            <p><strong>Account Created:</strong> <?= esc($user['created_at']); ?></p>
        <?php else: ?>
            <p class="text-danger">No profile found.</p>
        <?php endif; ?>
    </div>
</div>

<?= view('templates/footer'); ?>