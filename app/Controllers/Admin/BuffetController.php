<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BuffetPackageModel;
use App\Models\BuffetBookingModel;

class BuffetController extends BaseController
{
    public function index()
    {
        $model = new BuffetPackageModel();
        $data['packages'] = $model->findAll();
        
        $bookingModel = new BuffetBookingModel();
        $data['bookings'] = $bookingModel->orderBy('date', 'ASC')->findAll();
        
        // Layout variables
        $data['title'] = 'Buffet Packages';
        $data['page_title'] = 'Buffet Management';
        $data['page_subtitle'] = 'Manage buffet packages and pricing';
        $data['active_menu'] = 'buffet';
        
        return view('admin/buffet', $data);
    }

    public function add()
    {
        $model = new BuffetPackageModel();
        $data = [
            'name' => $this->request->getPost('name'),
            'adult_price' => $this->request->getPost('adult_price'),
            'child_price' => $this->request->getPost('child_price'),
            'time_slot' => $this->request->getPost('time_slot'),
            'items_list' => json_encode(explode(',', $this->request->getPost('items_list')))
        ];
        $model->save($data);
        return redirect()->to('/admin/buffet')->with('msg', 'Buffet Package Added Successfully');
    }

    public function edit($id)
    {
        $model = new BuffetPackageModel();
        $data['package'] = $model->find($id);
        return view('admin/buffet_edit', $data);
    }

    public function update($id)
    {
        $model = new BuffetPackageModel();
        $data = [
            'name' => $this->request->getPost('name'),
            'adult_price' => $this->request->getPost('adult_price'),
            'child_price' => $this->request->getPost('child_price'),
            'time_slot' => $this->request->getPost('time_slot'),
            'items_list' => json_encode(explode(',', $this->request->getPost('items_list')))
        ];
        $model->update($id, $data);
        return redirect()->to('/admin/buffet')->with('msg', 'Buffet Package Updated Successfully');
    }

    public function delete($id)
    {
        $model = new BuffetPackageModel();
        try {
            $model->delete($id);
            return redirect()->to('/admin/buffet')->with('msg', 'Buffet Package Deleted Successfully');
        } catch (\Exception $e) {
            return redirect()->to('/admin/buffet')->with('error', 'Cannot delete buffet package. It may be booked.');
        }
    }
}
