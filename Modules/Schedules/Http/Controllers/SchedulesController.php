<?php

namespace Modules\Schedules\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Buses\Repositories\busInterface;
use Modules\Schedules\Http\Requests\ChangeStatusRequest;
use Modules\Schedules\Http\Requests\ScheduleCheckAvaiabilityRequest;
use Modules\Schedules\Http\Requests\ScheduleUpdateRequest;
use Modules\Schedules\Repositories\ScheduleInterface;

class SchedulesController extends Controller
{
    public function __construct(ScheduleInterface $schedule, busInterface $bus)
    {
        $this->schedule=$schedule;
        $this->bus=$bus;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $schedules = $this->schedule->getAll();
        return view('schedules::index',compact('schedules'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $types = $this->bus->getTypes();
        return view('schedules::create',compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $data = $this->schedule->store($request);
        if($data['code'] == 1) {
            return redirect('schedule/list')->with(['success' => true,
                'success' => 'Schedule created Successfully!']);
        }else{
            return redirect('schedule/list')->with(['errors' => true,
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
        return view('schedules::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $schedule = $this->schedule->findById($id);
        return view('schedules::edit',compact('schedule'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(ScheduleUpdateRequest $request)
    {
        $id = $request->id;
        $data = $this->schedule->update($id,$request);
        if($data['code'] == 1) {
            return redirect('schedule/list')->with(['success' => true,
                'success' => 'Schedule Updated Successfully!']);
        }else{
            return redirect('schedule/list')->with(['errors' => true,
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

    public function checkAvailable(ScheduleCheckAvaiabilityRequest $request){
        return $this->schedule->checkAvailability($request);
    }

    public function changeStatus(ChangeStatusRequest $request){
        $data = $this->schedule->changeStatus($request->schedule_id,$request->status);

        if($data['code'] == 1) {
            return redirect('schedule/list')->with(['success' => true,
                'success' => 'Schedule status changed Successfully!']);
        }else{
            return redirect('schedule/list')->with(['errors' => true,
                'error' => $data['msg']]);
        }
    }
}
