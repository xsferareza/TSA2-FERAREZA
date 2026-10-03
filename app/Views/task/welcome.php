<?= view('templates/header'); ?>

<h2>Tasks Scheduled for Today (<?= date('F j, Y'); ?>)</h2>
<p class="text-muted">Filtered dashboard view displaying active tasks for today.</p>

<?php if (!empty($tasks)): ?>
    <ul class="list-group">
        <?php foreach ($tasks as $task): ?>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span><?= esc($task['title']); ?></span>
                <span class="badge bg-<?= $task['status'] === 'completed' ? 'success' : 'warning'; ?>">
                    <?= esc(ucfirst($task['status'])); ?>
                </span>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <div class="alert alert-info">No tasks scheduled for today.</div>
<?php endif; ?>

<?= view('templates/footer'); ?>