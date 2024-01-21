<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Intervention\Image\Image;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $output["categories"] = Category::all();
    $output["posts"] = Post::latest()->filter(request()->only('search'))->get();
    return view("index", $output);
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view("posts.create", ["posts"=> Post::all(), "categories" => Category::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $formData = $request->validate([
            "title" => "required",
            "category_id" => "required",
            "content" => "required|min:25",
            "image" => "image|mimes:jpeg,png,jpg|max:2048|dimensions:width=180,height=200",
        ]);

        $post = new Post();
        $post->title = $formData["title"];
        $post->category_id = $formData["category_id"];
        $post->content = $formData["content"];

        if ($request->hasFile("image")) {
            $file = $request->file("image");
            $ext = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $ext;

            // Move the file to the "public/uploads" directory
            $file->move(public_path('uploads'), $fileName);

            // Update the file path in the database
            $post->image = 'uploads/' . $fileName;
        }

        $post->user_id = auth()->user()->id;

        $post->save();

        return redirect()->route("posts.index")->with("success", "Blog created successfully.");
    }


    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
        return view("posts.show", ["post"=> $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        return view("posts.edit", ["post"=> Post::find($id), "categories" => Category::all()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //

        if($post->user_id != auth()->user()->id){
            return abort(403, "Unauthorized Request");
        }
        $formData = $request->validate([
            "title" => "required",
            "category_id" => "required",
            "content" => "required|min:25",
            "image" => "image|mimes:jpeg,png,jpg||max:8192|dimensions:width=180,height=200",
        ]);

        $post->title = $formData["title"];
        $post->category_id = $formData["category_id"];
        $post->content = $formData["content"];

        if ($request->hasFile("image")) {
            $file = $request->file("image");
            $ext = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $ext;

            // Move the file to the "public/uploads" directory
            $file->move(public_path('uploads'), $fileName);

            // Update the file path in the database
            $post->image = 'uploads/' . $fileName;
        }

        $post->user_id = auth()->user()->id;

        $post->save();

        return redirect()->route("dashboard")->with("success", "Post updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $post = Post::find($id);
        $post->delete();
        return redirect()->route("dashboard")->with("success","Post deleted successfully.");
    }
}
