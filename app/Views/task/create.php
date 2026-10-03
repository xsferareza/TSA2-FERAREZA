<!DOCTYPE html>
<html>
<head><title>Create Task</title></head>
<body>
    <h2>Add New Task</h2>

    <?php if (session()->getFlashdata('errors')): ?>
        <ul style="color:red;">
            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form action="/tasks/create" method="post">
        <?= csrf_field() ?>
        <label>Title *:</label><br>
        <input type="text" name="title" value="<?= old('title') ?>" required><br><br>

        <label>Description:</label><br>
        <textarea name="description"><?= old('description') ?></textarea><br><br>

        <label>Task Date *:</label><br>
        <input type="date" name="task_date" value="<?= old('task_date') ?>" required><br><br>

        <label>Status:</label><br>
        <select name="status">
            <option value="Pending">Pending</option>
            <option value="In Progress">In Progress</option>
            <option value="Completed">Completed</option>
        </select><br><br>

        <button type="submit">Save Task</button>
        <a href="/tasks">Cancel</a>
    </form>
</body>
</html>