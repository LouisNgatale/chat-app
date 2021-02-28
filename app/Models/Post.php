<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function user() {
        return $this->belongsTo(User::class,'user_id');
    }

    public function comment() {
        return $this->hasMany(Comment::class)->where('isMain','=',1);
    }

    public function tag() {
        return $this->belongsToMany(Tag::class,'post_has_tag',
            'tag_id','post_id');
    }
}
