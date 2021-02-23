<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    use HasFactory;

    protected $fillable = [
        'workPlace',
        'position',
        'workCity',
        'profile_id',
        'from',
        'to'
    ];

    public function profile() {
        return $this->belongsTo(Profile::class,'profile_id');
    }
}
