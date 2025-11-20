<?php

namespace App\Controllers;

class Buffet extends BaseController
{
    public function index()
    {
        return view('public/buffet');
    }

    public function book()
    {
        // Handle buffet booking submission
        $model = new \App\Models\BuffetBookingModel();
        $model->save($this->request->getPost());
        
        return redirect()->to('/buffet')->with('msg', 'Booking Request Received!');
    }
}
