<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'username', 'password', 'role',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function facilities()
    {
        return $this->hasMany(Facility::class, 'created_by');
    }
}
