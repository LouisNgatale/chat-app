<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'body',
        'post_id',
        'isMain',
        'hasParent',
        'parentId',
    ];

    public function post() {
        return $this->belongsTo(Post::class,'post_id');
    }

    public function children() {
        return $this->hasMany(Comment::class,'parentId');
    }
}
