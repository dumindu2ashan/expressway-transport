<?php

namespace Modules\Users\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Users\Http\Requests\ChangeStatusRequest;
use Modules\Users\Http\Requests\UserUpdateRequest;
use Modules\Users\Repositories\UserInterface;

class UsersController extends Controller
{

    public function __construct(UserInterface $user)
    {
        $this->user=$user;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $users = $this->user->getAll();
        return view('users::index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('users::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('users::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $user = $this->user->findById($id);
        return view('users::edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(UserUpdateRequest $request)
    {
        $id = $request->id;
        $data = $this->user->update($id,$request);
        if($data['code'] == 1) {
            return redirect('users/list')->with(['success' => true,
                'success' => 'User status changed Successfully!']);
        }else{
            return redirect('users/list')->with(['errors' => true,
                'error' => $data['msg']]);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }

    public function changeStatus(ChangeStatusRequest $request){
        $data = $this->user->changeStatus($request->user_id,$request->status);

        if($data['code'] == 1) {
            return redirect('users/list')->with(['success' => true,
                'success' => 'User status changed Successfully!']);
        }else{
            return redirect('users/list')->with(['errors' => true,
                'error' => $data['msg']]);
        }
    }
}
