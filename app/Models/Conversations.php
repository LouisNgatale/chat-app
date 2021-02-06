<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversations extends Model{
    use HasFactory;
    protected $fillable = ['id'];

    public function messages(){
        return $this->hasMany(Messages::class);
    }

    public function users() {
        return $this->belongsToMany(User::class,'conversations_users_pivot',
            'users_id','conversations_id');
    }
}
