<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\MenuModel;
use App\Models\MenuCategoryModel;

class MenuController extends BaseController
{
    public function index()
    {
        $model = new MenuModel();
        $data['items'] = $model->getItemsWithCategory();
        
        $catModel = new MenuCategoryModel();
        $data['categories'] = $catModel->findAll();
        
        return view('admin/menu', $data);
    }

    public function add()
    {
        $model = new MenuModel();
        
        // Handle image upload
        $file = $this->request->getFile('image');
        $imageName = null;
        if($file->isValid() && !$file->hasMoved()){
            $imageName = $file->getRandomName();
            $file->move('uploads/menu', $imageName);
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'category_id' => $this->request->getPost('category_id'),
            'price' => $this->request->getPost('price'),
            'image' => $imageName,
            'description' => $this->request->getPost('description'),
            'available' => 1
        ];
        
        $model->save($data);
        return redirect()->to('/admin/menu')->with('msg', 'Menu Item Added Successfully');
    }

    public function edit($id)
    {
        $model = new MenuModel();
        $data['item'] = $model->find($id);
        
        $catModel = new MenuCategoryModel();
        $data['categories'] = $catModel->findAll();
        
        return view('admin/menu_edit', $data);
    }

    public function update($id)
    {
        $model = new MenuModel();
        
        $data = [
            'name' => $this->request->getPost('name'),
            'category_id' => $this->request->getPost('category_id'),
            'price' => $this->request->getPost('price'),
            'description' => $this->request->getPost('description'),
            'available' => $this->request->getPost('available') ? 1 : 0
        ];

        $file = $this->request->getFile('image');
        if($file->isValid() && !$file->hasMoved()){
            $imageName = $file->getRandomName();
            $file->move('uploads/menu', $imageName);
            $data['image'] = $imageName;
        }

        $model->update($id, $data);
        return redirect()->to('/admin/menu')->with('msg', 'Menu Item Updated Successfully');
    }

    public function delete($id)
    {
        $model = new MenuModel();
        try {
            $model->delete($id);
            return redirect()->to('/admin/menu')->with('msg', 'Menu Item Deleted Successfully');
        } catch (\Exception $e) {
            return redirect()->to('/admin/menu')->with('error', 'Cannot delete menu item. It may be in existing orders.');
        }
    }
}
