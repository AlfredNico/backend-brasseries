<?php

namespace App\Repositories;

use App\Interfaces\Crud_Interface;
use App\Models\Departement;
use Carbon\Carbon;

class DepartementRepository implements Crud_Interface
{

    public function getAll()
    {
        return Departement::all();
    }

    public function getById(object $depart)
    {
        return $depart;
    }

    public function delete(object $depart)
    {
        return $depart->delete();
    }

    public function create(object $data)
    {
        return Departement::create([
            'name' => $data->name,
            'site_id' => $data->site_id,
        ]);
    }

    public function update(object $rq, object $depart)
    {
        return $depart->update($rq->all());
    }

}
