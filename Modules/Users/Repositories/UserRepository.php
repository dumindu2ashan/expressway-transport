<?php


namespace Modules\Users\Repositories;


use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Mockery\Exception;

class UserRepository implements UserInterface
{

    public function getAll()
    {
        return User::all();
    }

    public function store($data)
    {
        // TODO: Implement store() method.
    }

    public function findById($id)
    {
        return User::findOrFail($id);
    }

    public function update($id, $data)
    {
        try {
            $user = User::findOrFail($id);
            $user->name = $data->name;
            $user->email = $data->email;
            $user->type = $data->type;
//            if ($user->password != '') {
//                $user->password = Hash::make($data['password']);
//            }
            $user->update();

            $response['code'] = 1;
            $response['msg'] = "Success";
            return $response;
        } catch (Exception $e) {
            $response['code'] = 0;
            $response['msg'] = $e->getMessage();
            return $response;
        }
    }

    public function changeStatus($id, $status)
    {
        try {
            $user = User::findOrFail($id);
            $user->status = !$status;
            $user->update();

            $response['code'] = 1;
            $response['msg'] = "Success";
            return $response;
        } catch (Exception $e) {
            $response['code'] = 0;
            $response['msg'] = $e->getMessage();
            return $response;
        }
    }
}