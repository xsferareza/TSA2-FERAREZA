<?php /** @var array $task */ ?>
<!DOCTYPE html>
<html>
<head><title>Edit Task</title></head>
<body>
    <h2>Edit Task</h2>

    <?php if (session()->getFlashdata('errors')): ?>
        <ul style="color:red;">
            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form action="/tasks/update/<?= $task['id'] ?>" method="post">
        <?= csrf_field() ?>
        <label>Title *:</label><br>
        <input type="text" name="title" value="<?= esc($task['title']) ?>" required><br><br>

        <label>Description:</label><br>
        <textarea name="description"><?= esc($task['description']) ?></textarea><br><br>

        <label>Task Date *:</label><br>
        <input type="date" name="task_date" value="<?= esc($task['task_date']) ?>" required><br><br>

        <label>Status:</label><br>
        <select name="status">
            <option value="Pending" <?= $task['status'] == 'Pending' ? 'selected' : '' ?>>Pending</option>
            <option value="In Progress" <?= $task['status'] == 'In Progress' ? 'selected' : '' ?>>In Progress</option>
            <option value="Completed" <?= $task['status'] == 'Completed' ? 'selected' : '' ?>>Completed</option>
        </select><br><br>

        <button type="submit">Update Task</button>
        <a href="/tasks">Cancel</a>
    </form>
</body>
</html>