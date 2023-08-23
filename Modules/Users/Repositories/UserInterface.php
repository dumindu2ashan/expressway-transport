<?php


namespace Modules\Users\Repositories;


interface UserInterface
{
    public function getAll();
    public function store($data);
    public function findById($id);
    public function update($id,$data);
    public function changeStatus($id,$status);
}