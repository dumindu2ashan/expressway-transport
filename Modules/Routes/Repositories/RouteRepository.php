<?php


namespace Modules\Routes\Repositories;


use Modules\Routes\Entities\Route;

class RouteRepository implements RouteInterface
{

    public function getAll()
    {
        return Route::all();
    }

    public function store($data)
    {
        try {
            $bus = new Route();
            $bus->name = $data->name;
            $bus->is_expressway = $data->is_expressway;
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
        return Route::findOrFail($id);
    }

    public function update($id, $data)
    {
        try {
            $bus = Route::findOrFail($id);
            $bus->name = $data->name;
            $bus->is_expressway = $data->is_expressway;
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
            $user = Route::findOrFail($id);
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