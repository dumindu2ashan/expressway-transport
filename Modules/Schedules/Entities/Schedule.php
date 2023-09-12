<?php

namespace Modules\Schedules\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Buses\Entities\Buses;

class Schedule extends Model
{
    use HasFactory;

    const SCHEDULE_STATUS_ACTIVE = 1;
    const SCHEDULE_STATUS_DEACTIVE = 0;

    protected $fillable = ['start_date','end_date','estimated_km','price_per_km','status'];
    
    public function buses(){
        return $this->belongsToMany(Buses::class,'buses_schedules','schedule_id','bus_id');
    }

    public function getStatusStringAttribute()
    {
        switch ($this->status) {
            case Schedule::SCHEDULE_STATUS_ACTIVE:
                return 'Active';
            case Schedule::SCHEDULE_STATUS_DEACTIVE:
                return 'Deactive';
        }
    }
}
