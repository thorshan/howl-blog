<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    //
    public function index(){
        // $posts = Post::latest()->get();
        $output["categories"] = Category::all();
        $output["posts"] = Post::all();
        return view("index", $output);
    }
}