<?php

namespace App\Controllers;

use App\Models\MenuModel;
use App\Models\MenuCategoryModel;

class Menu extends BaseController
{
    public function index()
    {
        // In a real app, we would fetch from DB
        // $model = new MenuModel();
        // $data['items'] = $model->findAll();
        
        // For now, we'll use static data or just render the view
        return view('public/menu');
    }
}
