<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\RoleModel;

class Staff extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();
        $data['users'] = $userModel->select('users.*, roles.role_name')
                                   ->join('roles', 'roles.id = users.role_id')
                                   ->findAll();
        
        $roleModel = new RoleModel();
        $data['roles'] = $roleModel->findAll();
        
        // Layout variables
        $data['title'] = 'Staff Management';
        $data['page_title'] = 'Staff Management';
        $data['page_subtitle'] = 'Manage users and access roles';
        $data['active_menu'] = 'staff';
        
        return view('admin/staff', $data);
    }

    public function add()
    {
        $model = new UserModel();
        $data = [
            'name'     => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role_id'  => $this->request->getPost('role_id')
        ];
        $model->save($data);
        return redirect()->to('/admin/staff')->with('msg', 'Staff Member Added Successfully');
    }

    public function edit($id)
    {
        $userModel = new UserModel();
        $data['user'] = $userModel->find($id);
        
        $roleModel = new RoleModel();
        $data['roles'] = $roleModel->findAll();
        
        return view('admin/staff_edit', $data);
    }

    public function update($id)
    {
        $model = new UserModel();
        $data = [
            'name'     => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
            'role_id'  => $this->request->getPost('role_id')
        ];
        
        if($this->request->getPost('password')) {
            $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }
        
        $model->update($id, $data);
        return redirect()->to('/admin/staff')->with('msg', 'Staff Member Updated Successfully');
    }

    public function delete($id)
    {
        $model = new UserModel();
        try {
            $model->delete($id);
            return redirect()->to('/admin/staff')->with('msg', 'Staff Member Deleted Successfully');
        } catch (\Exception $e) {
            return redirect()->to('/admin/staff')->with('error', 'Cannot delete staff member. They may be associated with other records.');
        }
    }
}
