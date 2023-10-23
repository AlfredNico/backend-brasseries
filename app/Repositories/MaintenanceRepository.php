<?php

namespace App\Repositories;

use App\Interfaces\Crud_Interface;
use App\Models\Maintenance;
use Carbon\Carbon;

class MaintenanceRepository implements Crud_Interface
{

    public function getAll()
    {
        return Maintenance::all();
    }

    public function getById(object $maint)
    {
        return $maint;
    }

    public function delete(object $maint)
    {
        return $maint->delete();
    }

    public function create(object $data)
    {
        return User::create([
            'name' => $data->name,
            'username' => $data->username,
            'passwd' => bcrypt($data->password),
            'dates' => $data->dates ? Carbon::parse($data->dates)->format('Y-m-d H:m:s') : null,
            // Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
            'is_activated' => isset($data->is_activated) ? $data->is_activated : false,
            'cle_user' => isset($data->cle_user) ? $data->cle_user : null,
            'departement_id' => isset($data->departement_id) ? $data->departement_id : null,
            'usertype_id' => isset($data->usertype_id) ? $data->usertype_id : null,
        ]);
    }

    public function update(object $rq, object $maint)
    {
        return $maint->update($rq->all());
    }

}
