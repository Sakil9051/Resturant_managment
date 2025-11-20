<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ReservationModel;
use App\Models\TableModel;

class Reservations extends BaseController
{
    public function index()
    {
        $model = new ReservationModel();
        $data['reservations'] = $model->orderBy('date', 'ASC')->findAll();
        
        $tableModel = new TableModel();
        $data['tables'] = $tableModel->where('status', 'Available')->findAll();
        
        return view('admin/reservations', $data);
    }

    public function approve($id)
    {
        // Logic to approve and assign table
        $model = new ReservationModel();
        $model->update($id, ['status' => 'Confirmed']);
        
        return redirect()->to('/admin/reservations')->with('msg', 'Reservation Approved');
    }

    public function delete($id)
    {
        $model = new ReservationModel();
        try {
            $model->delete($id);
            return redirect()->to('/admin/reservations')->with('msg', 'Reservation Deleted Successfully');
        } catch (\Exception $e) {
            return redirect()->to('/admin/reservations')->with('error', 'Cannot delete reservation.');
        }
    }
}
