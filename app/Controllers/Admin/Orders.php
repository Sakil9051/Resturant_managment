<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\OrderModel;
use App\Models\OrderItemModel;
use App\Models\TableModel;
use App\Models\MenuModel;

class Orders extends BaseController
{
    public function index()
    {
        $model = new OrderModel();
        $data['orders'] = $model->orderBy('id', 'DESC')->findAll();
        
        $tableModel = new TableModel();
        $data['tables'] = $tableModel->findAll();
        
        $menuModel = new MenuModel();
        $data['menuItems'] = $menuModel->where('available', 1)->findAll();
        
        // Layout variables
        $data['title'] = 'Orders';
        $data['page_title'] = 'Orders Management';
        $data['page_subtitle'] = 'View and manage customer orders';
        $data['active_menu'] = 'orders';
        
        return view('admin/orders', $data);
    }

    public function create()
    {
        // Simplified order creation for demo
        $orderModel = new OrderModel();
        $itemModel = new OrderItemModel();
        
        $data = [
            'table_id' => $this->request->getPost('table_id'),
            'type' => $this->request->getPost('type'),
            'status' => 'Pending',
            'total' => 0 // Calculate later
        ];
        
        $orderId = $orderModel->insert($data);
        
        // Create notification in database
        $notificationModel = new \App\Models\NotificationModel();
        $notificationModel->createNotification(
            'new_order',
            '🛒 New Order',
            "Order #{$orderId} received",
            json_encode($data)
        );
        
        // Placeholder for order creation logic
        // In a real app, this would handle adding items to an order
        return redirect()->to('/admin/orders')->with('msg', 'Order Created Successfully');
    }

    public function delete($id)
    {
        $model = new OrderModel();
        try {
            $model->delete($id);
            return redirect()->to('/admin/orders')->with('msg', 'Order Deleted Successfully');
        } catch (\Exception $e) {
            return redirect()->to('/admin/orders')->with('error', 'Cannot delete order. It may have associated items.');
        }
    }
}
