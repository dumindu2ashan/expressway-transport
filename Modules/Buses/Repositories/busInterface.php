<?php


namespace Modules\Buses\Repositories;


interface busInterface
{
    public function getAll();
    public function store($data);
    public function findById($id);
    public function update($id,$data);
    public function changeStatus($id,$status);

    public function getTypes();
    public function allReport();
}