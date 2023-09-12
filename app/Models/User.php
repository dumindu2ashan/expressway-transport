<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const USER_TYPE_IT_ADMIN = 1;
    const USER_TYPE_OWNER = 2;
    const USER_TYPE_MANAGER = 3;
    const USER_TYPE_USER = 4;

    const USER_STATUS_ACTIVE = 1;
    const USER_STATUS_DEACTIVE = 0;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
        'status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'type'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getTypeStringAttribute()
    {
        switch ($this->type) {
            case User::USER_TYPE_IT_ADMIN:
                return 'IT Admin';
            case User::USER_TYPE_OWNER:
                return 'Owner';
            case User::USER_TYPE_MANAGER:
                return 'Manager';
            case User::USER_TYPE_USER:
                return 'User';
        }
    }

    public function getStatusStringAttribute(){
        switch ($this->status) {
            case User::USER_STATUS_ACTIVE:
                return 'Active';
            case User::USER_STATUS_DEACTIVE:
                return 'Deactive';
        }
    }
}
