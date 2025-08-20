<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    // Разрешить изменять и добавлять атрибуты в БД
    protected $guarded = [];
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
