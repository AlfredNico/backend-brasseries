<?php

namespace App\Repositories;

use App\Interfaces\Crud_Interface;
use App\Models\User;

class UserRepository implements Crud_Interface
{

    public function getAll()
    {
        return User::all();
        // return User::select('ids', 'name as nm', 'departement_id as dp_id')->get();
    }

    public function getById($ids)
    {
        return User::select('ids', 'name as nm', 'departement_id as dp_id')->get();
    }

    public function delete(int $ids)
    {
        return null;
    }

    public function create(object $data)
    {
        return User::create([
            'name' => $data->name,
            'username' => $data->username,
            'passwd' => bcrypt($data->password),
            'is_activated' => isset($data->is_activated) ? $data->is_activated : false,
            'cle_user' => isset($data->cle_user) ? $data->cle_user : null,
            'departement_id' => isset($data->departement_id) ? $data->departement_id : null,
            'usertype_id' => isset($data->usertype_id) ? $data->usertype_id : null,
        ]);
    }

    public function update($ids, array $newDetails)
    {
        return null;
    }

}
