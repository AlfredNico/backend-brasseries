<?php

namespace App\Repositories;

use App\Interfaces\Crud_Interface;
use App\Models\LastPosition;
use Carbon\Carbon;

class PositionRepository implements Crud_Interface
{

    public function getAll()
    {
        return LastPosition::all();
    }

    public function getById(object $post)
    {
        // return User::select('ids', 'name as nm', 'departement_id as dp_id')->get();
        return $post;
    }

    public function delete(object $post)
    {
        return $post->delete();
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

    public function update(object $rq, object $post)
    {
        return $post->update($rq->all());
    }

}
