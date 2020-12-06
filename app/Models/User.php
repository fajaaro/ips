<?php

namespace App\Models;

use App\Models\CourseUser;
use App\Models\Order;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo('App\Models\Role');
    }

    public function image()
    {
        return $this->morphOne('App\Models\Image', 'imageable');
    }

    public function userAddress()
    {
        return $this->hasOne('App\Models\UserAddress');
    }

    public function inRole($role)
    {
        if ($this->role->name == strtolower($role)) {
            return true;
        }

        return false;
    }

    public function courses()
    {
        return $this->belongsToMany('App\Models\Course')->withPivot('expired_at');
    }

    public function hasCourse($id)
    {
        return CourseUser::where([
            ['course_id', $id],
            ['user_id', $this->id],
            ['expired_at', '>=', now()]
        ])->exists();
    }

    public function activeCourses()
    {
        return CourseUser::where([
            ['user_id', $this->id],
            ['expired_at', '>=', now()]
        ])->get();
    }

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

    public function paidOrders()
    {
        return Order::where([
            ['user_id', $this->id],
            ['payment_status', 'paid']
        ])->get();
    }

    public function unpaidOrders()
    {
        return Order::where([
            ['user_id', $this->id],
            ['payment_status', 'unpaid']
        ])->get();
    }

    public function getFullName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
