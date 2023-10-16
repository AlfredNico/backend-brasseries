<?php

namespace App\Interfaces;

interface Crud_Interface
{

    public function getAll();
    public function getById($ids);
    public function delete(int $ids);
    public function create(object $dataDetails);
    public function update($ids, array $newDetails);

}
