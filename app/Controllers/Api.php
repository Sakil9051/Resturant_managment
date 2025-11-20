<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\MenuModel;
use App\Models\BuffetPackageModel;
use App\Models\ReservationModel;
use App\Models\BuffetBookingModel;

class Api extends BaseController
{
    use ResponseTrait;

    public function getMenu()
    {
        $model = new MenuModel();
        $data = $model->getItemsWithCategory();
        return $this->respond($data);
    }

    public function getBuffetPackages()
    {
        $model = new BuffetPackageModel();
        $data = $model->findAll();
        return $this->respond($data);
    }

    public function createReservation()
    {
        $model = new ReservationModel();
        $data = $this->request->getJSON(true); // Get JSON payload

        if ($model->save($data)) {
            return $this->respondCreated(['status' => 'success', 'message' => 'Reservation created']);
        } else {
            return $this->fail($model->errors());
        }
    }

    public function createBuffetBooking()
    {
        $model = new BuffetBookingModel();
        $data = $this->request->getJSON(true);

        if ($model->save($data)) {
            return $this->respondCreated(['status' => 'success', 'message' => 'Buffet booking created']);
        } else {
            return $this->fail($model->errors());
        }
    }
}
