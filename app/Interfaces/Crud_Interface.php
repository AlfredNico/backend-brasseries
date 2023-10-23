<?php

namespace App\Interfaces;

interface Crud_Interface
{

    public function getAll();
    public function getById(object $dataModel);
    public function delete(object $dataModel);
    public function create(object $data);
    public function update(object $rq, object $newData);

}
