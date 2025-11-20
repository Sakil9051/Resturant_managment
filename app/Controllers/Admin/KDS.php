<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\OrderModel;
use App\Models\OrderItemModel;

class KDS extends BaseController
{
    public function index()
    {
        $model = new OrderModel();
        $orderItemModel = new OrderItemModel();
        
        // Fetch orders that are not completed
        $data['orders'] = $model->whereIn('status', ['Pending', 'Preparing'])
                                ->orderBy('created_at', 'ASC')
                                ->findAll();
                                
        // Fetch items for each order
        foreach ($data['orders'] as &$order) {
            $order['items'] = $orderItemModel->select('order_items.*, menu_items.name')
                                             ->join('menu_items', 'menu_items.id = order_items.menu_item_id')
                                             ->where('order_id', $order['id'])
                                             ->findAll();
        }
        
        // Layout variables
        $data['title'] = 'Kitchen Display';
        $data['page_title'] = 'Kitchen Display System';
        $data['page_subtitle'] = 'Real-time order tracking for kitchen';
        $data['active_menu'] = 'kds';
        
        return view('admin/kds', $data);
    }

    public function update($id, $status)
    {
        $model = new OrderModel();
        
        // Validate status
        $validStatuses = ['Pending', 'Preparing', 'Ready', 'Completed'];
        if (in_array($status, $validStatuses)) {
            $model->update($id, ['status' => $status]);
        }
        
        return redirect()->to('/admin/kds');
    }
}
