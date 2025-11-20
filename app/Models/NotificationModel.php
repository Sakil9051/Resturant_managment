<?php

namespace App\Models;

use CodeIgniter\Model;

class NotificationModel extends Model
{
    protected $table            = 'notifications';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['user_id', 'type', 'title', 'message', 'data', 'is_read', 'created_at'];

    protected bool $allowEmptyInserts = false;
    protected $useTimestamps = false;

    /**
     * Get unread notifications count for a user
     */
    public function getUnreadCount($userId = null)
    {
        $builder = $this->where('is_read', 0);
        
        if ($userId) {
            $builder->where('user_id', $userId);
        } else {
            $builder->where('user_id IS NULL');
        }
        
        return $builder->countAllResults();
    }

    /**
     * Get recent notifications
     */
    public function getRecent($limit = 10, $userId = null)
    {
        $builder = $this->orderBy('created_at', 'DESC')->limit($limit);
        
        if ($userId) {
            $builder->where('user_id', $userId);
        } else {
            $builder->where('user_id IS NULL');
        }
        
        return $builder->findAll();
    }

    /**
     * Mark notification as read
     */
    public function markAsRead($id)
    {
        return $this->update($id, ['is_read' => 1]);
    }

    /**
     * Mark all notifications as read
     */
    public function markAllAsRead($userId = null)
    {
        $builder = $this->builder();
        
        if ($userId) {
            $builder->where('user_id', $userId);
        } else {
            $builder->where('user_id IS NULL');
        }
        
        return $builder->update(['is_read' => 1]);
    }

    /**
     * Create a new notification
     */
    public function createNotification($type, $title, $message, $data = null, $userId = null)
    {
        return $this->insert([
            'user_id' => $userId,
            'type' => $type,
            'title' => $title,
            'message' => $message,
            'data' => is_array($data) ? json_encode($data) : $data,
            'is_read' => 0
        ]);
    }
}
