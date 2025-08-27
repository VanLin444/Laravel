<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tag extends Model
{
    use HasFactory;
    // Разрешить изменять и добавлять атрибуты в БД
    protected $guarded = [];
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
