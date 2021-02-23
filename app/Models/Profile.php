<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'bio',
        'user_id',
        'profile_image',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function work() {
        return $this->hasMany(Work::class);
    }

    public function education() {
        return $this->hasMany(Education::class);
    }

    public function address() {
        return $this->hasMany(Address::class);
    }
}
