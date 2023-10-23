<?php

namespace App\Repositories;

use App\Interfaces\Crud_Interface;
use App\Models\Site;
use Carbon\Carbon;

class SiteRepository implements Crud_Interface
{

    public function getAll()
    {
        return Site::all();
    }

    public function getById(object $site)
    {
        return $site;
    }

    public function delete(object $site)
    {
        return $site->delete();
    }

    public function create(object $data)
    {
        return Site::create([
            'name' => $data->name,
        ]);
    }

    public function update(object $rq, object $site)
    {
        return $site->update($rq->all());
    }

}
