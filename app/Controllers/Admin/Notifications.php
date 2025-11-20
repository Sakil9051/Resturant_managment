<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\NotificationModel;

class Notifications extends BaseController
{
    public function index()
    {
        $model = new NotificationModel();
        $data['notifications'] = $model->orderBy('created_at', 'DESC')->findAll();
        $data['unread_count'] = $model->getUnreadCount();
        
        return view('admin/notifications', $data);
    }

    public function recent()
    {
        $model = new NotificationModel();
        
        $notifications = $model->getRecent(10);
        $unreadCount = $model->getUnreadCount();
        
        return $this->response->setJSON([
            'success' => true,
            'notifications' => $notifications,
            'unread_count' => $unreadCount
        ]);
    }

    public function create()
    {
        $model = new NotificationModel();
        
        $json = $this->request->getJSON(true);
        
        $id = $model->createNotification(
            $json['type'] ?? 'general',
            $json['title'] ?? 'Notification',
            $json['message'] ?? '',
            $json['data'] ?? null
        );
        
        return $this->response->setJSON([
            'success' => true,
            'id' => $id
        ]);
    }

    public function markRead($id)
    {
        $model = new NotificationModel();
        $model->markAsRead($id);
        
        return $this->response->setJSON([
            'success' => true
        ]);
    }

    public function markAllRead()
    {
        $model = new NotificationModel();
        $model->markAllAsRead();
        
        return $this->response->setJSON([
            'success' => true
        ]);
    }

    public function delete($id)
    {
        $model = new NotificationModel();
        
        try {
            $model->delete($id);
            return redirect()->to('/admin/notifications')->with('msg', 'Notification Deleted Successfully');
        } catch (\Exception $e) {
            return redirect()->to('/admin/notifications')->with('error', 'Failed to delete notification');
        }
    }
}
