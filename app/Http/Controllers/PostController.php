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
        //
        $output["categories"] = Category::all();
        $output["posts"] = Post::all();
        return view("index", $output);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
