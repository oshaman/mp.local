<?php

namespace Fresh\Medpravda;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo('Fresh\Medpravda\Role');
    }

    public function canDo()
    {
        if (($this->role->name == 'admin') || ($this->role->name == 'editor')) {
            return true;
        }

        return false;

    }

    public function hasRole($name)
    {
        if ($this->role->name == $name) {
            return true;
        }
        return false;
    }
}
