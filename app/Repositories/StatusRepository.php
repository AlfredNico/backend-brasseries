<?php

namespace App\Repositories;

use App\Interfaces\Crud_Interface;
use App\Models\Status;
use Carbon\Carbon;

class StatusRepository implements Crud_Interface
{

    public function getAll()
    {
        return Status::all();
    }

    public function getById(object $status)
    {
        return $status;
    }

    public function delete(object $status)
    {
        return $status->delete();
    }

    public function create(object $data)
    {
        return Status::create([
            'name' => $data->name,
            'type' => $data->type,
        ]);
    }

    public function update(object $rq, object $status)
    {
        return $status->update($rq->all());
    }

}
