<?php


namespace Modules\Schedules\Repositories;


use Modules\Buses\Entities\Buses;
use Modules\Schedules\Entities\Schedule;

class ScheduleRepository implements ScheduleInterface
{

    public function getAll()
    {
        return Schedule::all();
    }

    public function store($data)
    {
        try {
            $schedule = new Schedule();
            $schedule->start_date = $data->start_date;
            $schedule->end_date = $data->end_date;
            $schedule->estimated_km = $data->estimated_km;
            $schedule->total_bill = $data->total_bill;
            $schedule->save();

            $schedule->buses()->attach($data->buses_ids);

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
        return Schedule::findOrFail($id);
    }

    public function update($id, $data)
    {
        try {
            $schedule = Schedule::findOrFail($id);
            $schedule->name = $data->name;
            $schedule->is_expressway = $data->is_expressway;
            $schedule->update();

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
            $schedule = Schedule::findOrFail($id);
            $schedule->status = !$status;
            $schedule->update();

            $response['code'] = 1;
            $response['msg'] = "Success";
            return $response;
        } catch (\Exception $e) {
            $response['code'] = 0;
            $response['msg'] = $e->getMessage();
            return $response;
        }
    }

    public function checkAvailability($data)
    {
        $query = Buses::whereHas('schedules' , function ($q) use ($data) {
            $q
                ->where('status', Schedule::SCHEDULE_STATUS_ACTIVE)
                ->whereBetween('start_date', [$data->start_date, $data->end_date])
                ->whereBetween('end_date', [$data->start_date, $data->end_date])
            ;
        });
        if (isset($data->type)) {
            $query->where('buses.type', $data->type);
        }
        $dum = $query->where('.buses.status', Buses::BUS_STATUS_ACTIVE)->pluck('id');

        $data = Buses::whereNotIn('id',$dum)->get();

        return $data;
    }


}