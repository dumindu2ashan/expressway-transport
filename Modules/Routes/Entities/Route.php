<?php

namespace Modules\Routes\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Route extends Model
{
    use HasFactory;

    const ROUTE_STATUS_ACTIVE = 1;
    const ROUTE_STATUS_DEACTIVE = 0;

    protected $fillable = ['name','is_expressway','status'];

    public function getStatusStringAttribute(){
        switch ($this->status) {
            case Route::ROUTE_STATUS_ACTIVE:
                return 'Active';
            case Route::ROUTE_STATUS_DEACTIVE:
                return 'Deactive';
        }
    }
}
