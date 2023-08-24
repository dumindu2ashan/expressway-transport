<?php


namespace Modules\Schedules\Repositories;


interface ScheduleInterface
{
    public function getAll();
    public function store($data);
    public function findById($id);
    public function update($id,$data);
    public function changeStatus($id,$status);
    public function checkAvailability($data);
}