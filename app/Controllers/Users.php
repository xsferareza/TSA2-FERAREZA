<?php

namespace App\Controllers;

use App\Models\UserModel;

class Users extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();
        $data['users'] = $userModel->findAll();
        return view('users/index', $data);
    }

    public function new()
    {
        helper(['form']);
        return view('users/new');
    }

    public function create()
    {
        helper(['form']);

        $rules = [
            'username'  => 'required|is_unique[users.username]|min_length[3]',
            'full_name' => 'required|min_length[3]',
            'password'  => 'required|min_length[6]'
        ];

        if (!$this->validate($rules)) {
            return view('users/new', [
                'validation' => $this->validator
            ]);
        }

        $userModel = new UserModel();
        $userModel->save([
            'username'  => $this->request->getPost('username'),
            'full_name' => $this->request->getPost('full_name'),
            'password'  => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
        ]);

        return redirect()->to('/users')->with('success', 'User created successfully.');
    }

    public function edit($id = null)
    {
        helper(['form']);
        $userModel = new UserModel();
        $user = $userModel->find($id);

        if (!$user) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('User not found');
        }

        $data['user'] = $user;
        return view('users/edit', $data);
    }

    public function update($id = null)
    {
        helper(['form']);

        $rules = [
            'username'  => "required|is_unique[users.username,id,{$id}]|min_length[3]",
            'full_name' => 'required|min_length[3]',
            'avatar'    => 'is_image[avatar]|mime_in[avatar,image/jpg,image/jpeg,image/png]|max_size[avatar,2048]'
        ];

        $userModel = new UserModel();

        if (!$this->validate($rules)) {
            $data['user'] = $userModel->find($id);
            $data['validation'] = $this->validator;
            return view('users/edit', $data);
        }

        $updateData = [
            'username'  => $this->request->getPost('username'),
            'full_name' => $this->request->getPost('full_name'),
        ];

        // If a new password was typed, update and hash it
        $newPassword = $this->request->getPost('password');
        if (!empty($newPassword)) {
            $updateData['password'] = password_hash($newPassword, PASSWORD_BCRYPT);
        }

        // Process avatar image upload
        $img = $this->request->getFile('avatar');

        if ($img && $img->isValid() && !$img->hasMoved()) {
            $newName = $img->getRandomName();
            $uploadPath = ROOTPATH . 'public/uploads/avatars';

            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }

            $img->move($uploadPath, $newName);

            // Prepare thumbnail copy (150x150 center crop)
            \Config\Services::image()
                ->withFile($uploadPath . '/' . $newName)
                ->fit(150, 150, 'center')
                ->save($uploadPath . '/' . $newName);

            $updateData['avatar'] = $newName;
        }

        $userModel->update($id, $updateData);

        return redirect()->to('/users')->with('success', 'User updated successfully.');
    }
}