<?php

namespace App\Controllers;

use App\Models\CustomerModel;

class Customers extends BaseController
{
    public function index()
    {
        $customerModel = new CustomerModel();
        $data['customers'] = $customerModel->findAll();
        return view('customers/index', $data);
    }

    public function new()
    {
        helper(['form']);
        return view('customers/new');
    }

    public function create()
    {
        helper(['form']);

        $rules = [
            'full_name' => 'required|min_length[3]',
            'email'     => 'required|valid_email'
        ];

        if (!$this->validate($rules)) {
            return view('customers/new', [
                'validation' => $this->validator
            ]);
        }

        $customerModel = new CustomerModel();
        $customerModel->save([
            'full_name' => $this->request->getPost('full_name'),
            'email'     => $this->request->getPost('email'),
            'phone'     => $this->request->getPost('phone'),
            'address'   => $this->request->getPost('address'),
        ]);

        return redirect()->to('/customers')->with('success', 'Customer created successfully.');
    }

    public function edit($id = null)
    {
        helper(['form']);
        $customerModel = new CustomerModel();
        $customer = $customerModel->find($id);

        if (!$customer) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Customer not found');
        }

        $data['customer'] = $customer;
        return view('customers/edit', $data);
    }

    public function update($id = null)
    {
        helper(['form']);

        $rules = [
            'full_name' => 'required|min_length[3]',
            'email'     => 'required|valid_email'
        ];

        $customerModel = new CustomerModel();

        if (!$this->validate($rules)) {
            $data['customer'] = $customerModel->find($id);
            $data['validation'] = $this->validator;
            return view('customers/edit', $data);
        }

        $customerModel->update($id, [
            'full_name' => $this->request->getPost('full_name'),
            'email'     => $this->request->getPost('email'),
            'phone'     => $this->request->getPost('phone'),
            'address'   => $this->request->getPost('address'),
        ]);

        return redirect()->to('/customers')->with('success', 'Customer updated successfully.');
    }
}