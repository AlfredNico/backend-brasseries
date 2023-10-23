<?php

namespace App\Repositories;

use App\Interfaces\Crud_Interface;
use App\Models\AllPositions;
use Carbon\Carbon;

class AllPositionRepository implements Crud_Interface
{

    public function getAll()
    {
        return AllPositions::all();
    }

    public function getById(object $allPst)
    {
        return $allPst;
    }

    public function delete(object $allPst)
    {
        return $allPst->delete();
    }

    public function create(object $data)
    {
        return AllPositions::create([
            'last_driver' =>  $data->last_driver,
            'vehicle_id' =>  $data->vehicle_id,
            'position_name' =>  $data->position_name,
            'longs' =>  $data->longs,
            'lats' =>  $data->lats,
            'dates' => $data->dates ? Carbon::parse($data->dates)->format('Y-m-d H:m:s') : null,
            'odometer' =>  $data->odometer,
        ]);
    }

    public function update(object $rq, object $allPst)
    {
        return $allPst->update($rq->all());
    }

}
