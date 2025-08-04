<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index() {
        
        $posts = POST::all();
        return view('about', compact('posts'));
    }
}
