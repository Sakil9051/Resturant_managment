<?php

namespace App\Controllers;

class Reservation extends BaseController
{
    public function index()
    {
        return view('public/reservation');
    }

    public function book()
    {
        // Handle table reservation submission
        $model = new \App\Models\ReservationModel();
        $model->save($this->request->getPost());
        
        return redirect()->to('/reservation')->with('msg', 'Reservation Request Received!');
    }
}
