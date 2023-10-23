<?php

namespace App\Repositories;

use App\Interfaces\Crud_Interface;
use App\Models\Vehicle;
use Carbon\Carbon;

class VehicleRepository implements Crud_Interface
{

    public function getAll()
    {
        return Vehicle::all();
    }

    public function getById(object $vehl)
    {
        return $vehl;
    }

    public function delete(object $vehl)
    {
        return $vehl->delete();
    }

    public function create(object $data)
    {
        return Vehicle::create([
            'name' => $data->name,
            'departement_id' => $data->username,
            'status_vehicle_id' => $data->username,
        ]);
    }

    public function update(object $rq, object $vehl)
    {
        return $vehl->update($rq->all());
    }

}
