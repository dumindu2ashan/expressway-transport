<?php

namespace Modules\Buses\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Bus;
use Modules\Buses\Entities\Buses;
use Modules\Buses\Http\Requests\BusUpdateRequest;
use Modules\Buses\Http\Requests\ChangeStatusRequest;
use Modules\Buses\Repositories\busInterface;

class BusesController extends Controller
{
    public function __construct(busInterface $bus)
    {
        $this->bus=$bus;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $buses = $this->bus->getAll();
        return view('buses::index',compact('buses'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('buses::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $data = $this->bus->store($request);
        if($data['code'] == 1) {
            return redirect('buses/list')->with(['success' => true,
                'success' => 'Bus created Successfully!']);
        }else{
            return redirect('buses/list')->with(['errors' => true,
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
        return view('buses::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $bus = $this->bus->findById($id);
        return view('buses::edit',compact('bus'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(BusUpdateRequest $request)
    {
        $id = $request->id;
        $data = $this->bus->update($id,$request);
        if($data['code'] == 1) {
            return redirect('buses/list')->with(['success' => true,
                'success' => 'Bus Updated Successfully!']);
        }else{
            return redirect('buses/list')->with(['errors' => true,
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
        $data = $this->bus->changeStatus($request->bus_id,$request->status);

        if($data['code'] == 1) {
            return redirect('buses/list')->with(['success' => true,
                'success' => 'User status changed Successfully!']);
        }else{
            return redirect('buses/list')->with(['errors' => true,
                'error' => $data['msg']]);
        }
    }
}
