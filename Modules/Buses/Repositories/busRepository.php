<?php


namespace Modules\Buses\Repositories;


use Modules\Buses\Entities\Buses;

class busRepository implements busInterface
{

    public function getAll()
    {
        return Buses::all();
    }

    public function store($data)
    {
        try {
            $bus = new Buses();
            $bus->vehicle_no = $data->vehicle_no;
            $bus->type = $data->type;
            $bus->price_per_km = $data->price_per_km;
            $bus->save();

            $response['code'] = 1;
            $response['msg'] = "Success";
            return $response;
        } catch (\Exception $e) {
            $response['code'] = 0;
            $response['msg'] = $e->getMessage();
            return $response;
        }
    }

    public function findById($id)
    {
        return Buses::findOrFail($id);
    }

    public function update($id, $data)
    {
        try {
            $bus = Buses::findOrFail($id);
            $bus->vehicle_no = $data->vehicle_no;
            $bus->type = $data->type;
            $bus->price_per_km = $data->price_per_km;
            $bus->update();

            $response['code'] = 1;
            $response['msg'] = "Success";
            return $response;
        } catch (\Exception $e) {
            $response['code'] = 0;
            $response['msg'] = $e->getMessage();
            return $response;
        }
    }

    public function changeStatus($id, $status)
    {
        try {
            $user = Buses::findOrFail($id);
            $user->status = !$status;
            $user->update();

            $response['code'] = 1;
            $response['msg'] = "Success";
            return $response;
        } catch (\Exception $e) {
            $response['code'] = 0;
            $response['msg'] = $e->getMessage();
            return $response;
        }
    }
}