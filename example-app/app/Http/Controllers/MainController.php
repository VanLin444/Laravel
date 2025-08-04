<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index() {
        
        $posts = POST::all();
        return view('main', compact('posts'));
    }
}
