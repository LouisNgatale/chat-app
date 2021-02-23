<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable,HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstName',
        'secondName',
        'userName',
        'phoneNumber',
        'gender',
        'birthDate',
        'email',
        'password',
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

    public function conversations() {
        return   $this->belongsToMany(Conversations::class,'conversations_users_pivot',
            'conversations_id','users_id');
    }

    public function profile() {
        return $this->hasOne(Profile::class);
    }

    public function posts() {
        return $this->hasMany(Post::class);
    }

    public function work() {
        return $this->hasManyThrough(
            Work::class,
            Profile::class,
            'user_id',
            'profile_id',
            'id',
            'id'
        );
    }

    public function address() {
        return $this->hasManyThrough(
          Address::class,
          Profile::class,
            'user_id',
            'profile_id',
            'id',
            'id'
        );
    }

}
