<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;


    protected $fillable = [
        'country'
    ];

    public function profile() {
        $this->belongsTo(Profile::class,'profile_id');
    }
}
