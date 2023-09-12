<?php


namespace Modules\Routes\Repositories;


interface RouteInterface
{
    public function getAll();
    public function store($data);
    public function findById($id);
    public function update($id,$data);
    public function changeStatus($id,$status);
}