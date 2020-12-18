<?php

namespace Rbac\Permission;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Rbac\Permission\Auth\AdminUser;
use Rbac\Permission\Traits\Rbac;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends AdminUser implements JWTSubject
{
    use HasFactory, Notifiable, Rbac;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
