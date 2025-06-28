<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    // Разрешить изменять и добавлять атрибуты в БД
    protected $guarded = [];
}
