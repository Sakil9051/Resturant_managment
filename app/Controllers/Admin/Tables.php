<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\TableModel;

class Tables extends BaseController
{
    public function index()
    {
        $model = new TableModel();
        $data['tables'] = $model->findAll();
        
        // Layout variables
        $data['title'] = 'Tables';
        $data['page_title'] = 'Table Management';
        $data['page_subtitle'] = 'Manage restaurant tables and seating';
        $data['active_menu'] = 'tables';
        
        return view('admin/tables', $data);
    }

    public function add()
    {
        $model = new TableModel();
        $model->save($this->request->getPost());
        return redirect()->to('/admin/tables')->with('msg', 'Table Added Successfully');
    }

    public function edit($id)
    {
        $model = new TableModel();
        $data['table'] = $model->find($id);
        return view('admin/tables_edit', $data);
    }

    public function update($id)
    {
        $model = new TableModel();
        $model->update($id, $this->request->getPost());
        return redirect()->to('/admin/tables')->with('msg', 'Table Updated Successfully');
    }

    public function delete($id)
    {
        $model = new TableModel();
        try {
            $model->delete($id);
            return redirect()->to('/admin/tables')->with('msg', 'Table Deleted Successfully');
        } catch (\Exception $e) {
            return redirect()->to('/admin/tables')->with('error', 'Cannot delete table. It may have active orders or reservations.');
        }
    }
}
