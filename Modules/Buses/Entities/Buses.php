<?php

namespace Modules\Buses\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Schedules\Entities\Schedule;

class Buses extends Model
{
    use HasFactory;

    const BUS_STATUS_ACTIVE = 1;
    const BUS_STATUS_DEACTIVE = 0;

    protected $fillable = ['vehicle_no', 'type', 'price_pr_km', 'status'];


    public function getStatusStringAttribute()
    {
        switch ($this->status) {
            case Buses::BUS_STATUS_ACTIVE:
                return 'Active';
            case Buses::BUS_STATUS_DEACTIVE:
                return 'Deactive';
        }
    }

    public function schedules()
    {
        return $this->belongsToMany(Schedule::class, 'buses_schedules', 'bus_id', 'schedule_id');
    }
}
