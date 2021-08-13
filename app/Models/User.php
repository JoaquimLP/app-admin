<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'status_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function getUserAll()
    {
        return self::where('status_id', "A")->simplePaginate(15);
    }

    public static function getUser($id)
    {
        return self::where('id', $id)->where('status_id', "A")->first();
    }

    public static function getUserSearch($filter = null)
    {
        return self::where('id', $filter )->orWhere('name', 'LIKE', "%{$filter}%")
            ->orWhere('email', 'LIKE', "%{$filter}%")->where('status_id', "A")->simplePaginate(15);
    }
}
