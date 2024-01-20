<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    // Redirect to Post
    public function index(){
        return redirect()->route('posts.index');   
    }
}