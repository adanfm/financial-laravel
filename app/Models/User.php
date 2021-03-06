<?php

namespace CodeFin\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    const ROLE_ADMIN = 'admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function getJWTIdentifier()
    {
        return (int) $this->id;
    }

    public function getJWTCustomClaims()
    {
        return [
            'user'  =>  [
                'id'    =>  $this->id,
                'name'  =>  $this->name,
                'email' =>  $this->email
            ]
        ];
    }

}
