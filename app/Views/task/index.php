<?php /** @var array $tasks */ ?>
<!DOCTYPE html>
<html>
<head><title>Tasks - Tasks for Today</title></head>
<body>
    <h2>Task List</h2>

    <div>
        <?php if (session()->get('isLoggedIn')): ?>
            <span>Welcome, <?= session()->get('user_name') ?>!</span> |
            <a href="/tasks/new">+ Add New Task</a> |
            <a href="/logout">Logout</a>
        <?php else: ?>
            <a href="/login">Login to manage tasks</a>
        <?php endif; ?>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <p style="color:green;"><?= session()->getFlashdata('success') ?></p>
    <?php endif; ?>

    <table border="1" cellpadding="8" style="margin-top:15px; border-collapse:collapse;">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Task Date</th>
                <th>Status</th>
                <?php if (session()->get('isLoggedIn')): ?>
                    <th>Actions</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tasks as $task): ?>
            <tr>
                <td><?= esc($task['title']) ?></td>
                <td><?= esc($task['description']) ?></td>
                <td><?= esc($task['task_date']) ?></td>
                <td><?= esc($task['status']) ?></td>
                <?php if (session()->get('isLoggedIn')): ?>
                <td>
                    <a href="/tasks/edit/<?= $task['id'] ?>">Edit</a> |
                    <a href="/tasks/delete/<?= $task['id'] ?>" onclick="return confirm('Archive this task?')">Delete</a>
                </td>
                <?php endif; ?>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>