<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'api_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function scopeSearch($query, string $locale, array $inputs)
    {
        if (isset($inputs['orderBy']) && isset($inputs['direction'])) {
            $query->orderBy($inputs['orderBy'], $inputs['direction']);
        }

        if (isset($inputs['term'])) {
            $query->where('name', 'like', '%' . $inputs['term'] . '%')
                ->orWhere('email', 'like', '%' . $inputs['term'] . '%');
        }

        return $query;
    }

}
