<?php

namespace App\Controllers;

use App\Models\TaskModel;

class TaskController extends BaseController
{
    // Public: List only non-archived tasks
    public function index()
    {
        $taskModel = new TaskModel();
        $data['tasks'] = $taskModel->getActiveTasks();

        return view('tasks/index', $data);
    }

    // Protected: Render creation form
    public function new()
    {
        return view('tasks/create');
    }

    // Protected: Store new task with validation
    public function create()
    {
        $rules = [
            'title'     => 'required|min_length[3]',
            'task_date' => 'required|valid_date',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $taskModel = new TaskModel();
        $taskModel->save([
            'user_id'     => session()->get('user_id') ?? 1,
            'title'       => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'task_date'   => $this->request->getPost('task_date'),
            'status'      => $this->request->getPost('status') ?? 'Pending',
            'is_archived' => 0,
        ]);

        return redirect()->to('/tasks')->with('success', 'Task created successfully!');
    }

    // Protected: Render edit form
    public function edit($id)
    {
        $taskModel = new TaskModel();
        $data['task'] = $taskModel->find($id);

        if (!$data['task'] || $data['task']['is_archived'] == 1) {
            return redirect()->to('/tasks')->with('error', 'Task not found.');
        }

        return view('tasks/edit', $data);
    }

    // Protected: Update task
    public function update($id)
    {
        $rules = [
            'title'     => 'required|min_length[3]',
            'task_date' => 'required|valid_date',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $taskModel = new TaskModel();
        $taskModel->update($id, [
            'title'       => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'task_date'   => $this->request->getPost('task_date'),
            'status'      => $this->request->getPost('status'),
        ]);

        return redirect()->to('/tasks')->with('success', 'Task updated successfully!');
    }

    // Protected: Soft Delete (Sets is_archived flag to 1)
    public function delete($id)
    {
        $taskModel = new TaskModel();
        $taskModel->update($id, ['is_archived' => 1]);

        return redirect()->to('/tasks')->with('success', 'Task archived successfully!');
    }
}