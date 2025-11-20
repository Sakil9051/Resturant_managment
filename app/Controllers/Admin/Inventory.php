<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\IngredientModel;
use App\Models\InventoryTransactionModel;

class Inventory extends BaseController
{
    public function index()
    {
        $model = new IngredientModel();
        $data['ingredients'] = $model->findAll();
        return view('admin/inventory', $data);
    }

    public function add()
    {
        $model = new IngredientModel();
        $data = [
            'name' => $this->request->getPost('name'),
            'unit' => $this->request->getPost('unit'),
            'quantity' => $this->request->getPost('quantity'),
            'min_threshold' => $this->request->getPost('min_threshold')
        ];
        $model->save($data);
        return redirect()->to('/admin/inventory')->with('msg', 'Ingredient Added Successfully');
    }

    public function edit($id)
    {
        $model = new IngredientModel();
        $data['ingredient'] = $model->find($id);
        return view('admin/inventory_edit', $data);
    }

    public function update($id)
    {
        $model = new IngredientModel();
        $data = [
            'name' => $this->request->getPost('name'),
            'unit' => $this->request->getPost('unit'),
            'quantity' => $this->request->getPost('quantity'),
            'min_threshold' => $this->request->getPost('min_threshold')
        ];
        $model->update($id, $data);
        return redirect()->to('/admin/inventory')->with('msg', 'Ingredient Updated Successfully');
    }

    public function delete($id)
    {
        $model = new IngredientModel();
        try {
            $model->delete($id);
            return redirect()->to('/admin/inventory')->with('msg', 'Ingredient Deleted Successfully');
        } catch (\Exception $e) {
            return redirect()->to('/admin/inventory')->with('error', 'Cannot delete ingredient. It may be in use.');
        }
    }
}
