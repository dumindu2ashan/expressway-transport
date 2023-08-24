<?php

namespace Modules\Routes\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Routes\Http\Requests\ChangeStatusRequest;
use Modules\Routes\Http\Requests\RouteCreateRequest;
use Modules\Routes\Http\Requests\RouteUpdateRequest;
use Modules\Routes\Repositories\RouteInterface;

class RoutesController extends Controller
{

    public function __construct(RouteInterface $route)
    {
        $this->route=$route;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $routes = $this->route->getAll();
        return view('routes::index',compact('routes'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('routes::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(RouteCreateRequest $request)
    {
        $data = $this->route->store($request);
        if($data['code'] == 1) {
            return redirect('route/list')->with(['success' => true,
                'success' => 'Route created Successfully!']);
        }else{
            return redirect('route/list')->with(['errors' => true,
                'error' => $data['msg']]);
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('routes::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $route = $this->route->findById($id);
        return view('routes::edit',compact('route'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(RouteUpdateRequest $request)
    {
        $id = $request->id;
        $data = $this->route->update($id,$request);
        if($data['code'] == 1) {
            return redirect('route/list')->with(['success' => true,
                'success' => 'Bus Updated Successfully!']);
        }else{
            return redirect('route/list')->with(['errors' => true,
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
        $data = $this->route->changeStatus($request->route_id,$request->status);

        if($data['code'] == 1) {
            return redirect('route/list')->with(['success' => true,
                'success' => 'Route status changed Successfully!']);
        }else{
            return redirect('route/list')->with(['errors' => true,
                'error' => $data['msg']]);
        }
    }
}
