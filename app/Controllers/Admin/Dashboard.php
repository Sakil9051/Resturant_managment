<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'page_title' => 'Dashboard',
            'page_subtitle' => 'Welcome back, Admin! Here\'s what\'s happening today.',
            'active_menu' => 'dashboard'
        ];
        
        return view('admin/dashboard', $data);
    }
}
