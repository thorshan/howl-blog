<?php

namespace App\Http\Controllers\users;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    //
    public function index()
    {

        $user = auth()->user();
        $posts = $user->posts()->orderBy("created_at", "desc")->get();
        return view("users.index", ["posts" => $posts, "user" => $user]);
    }

    //
    public function register()
    {
        return view("register");
    }

    //
    public function login()
    {
        return view("login");
    }

    // Register new user 
    public function create_user(Request $request)
    {

        $formData = $request->validate([
            "email" => ['required', 'email', Rule::unique('users')],
            "name" => "required|min:5",
            "password" => "required|min:5",
        ]);

        $user = new User();
        $user->email = $formData["email"];
        $user->name = $formData["name"];
        $user->password = bcrypt($formData["password"]);

        $user->save();

        auth()->login($user);

        return redirect()->route('home')->with("success", "User created successfully.");
    }

    // Edit User

    public function edit(User $user)
    {
        $user = auth()->user();
        return view("users.edit", ["user" => $user]);
    }

    // Update User
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|min:5',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore(auth()->id()),
            ],
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif', // Adjust the allowed file types and size as needed
            'summary' => ['nullable', 'string', 'max:200'],
        ]);
    
        $user = auth()->user();
        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'summary' => $request->input('summary'),
        ]);
    
        // Handle image upload
        if ($request->hasFile("img")) {
            $file = $request->file("img");
            $ext = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $ext;

            // Move the file to the "public/uploads" directory
            $file->move(public_path('uploads'), $fileName);

            // Update the file path in the database
            $user->img = 'uploads/' . $fileName;
        }

        $user->save();

        return redirect()->route('dashboard')->with("success", "User updated successfully.");
    }


    // Login
    public function authenticate(Request $request)
    {
        $formData = $request->validate([
            "email" => "email|required",
            "password" => "required|min:5",
        ]);

        // Attempt to authenticate the user
        if (auth()->attempt($formData)) {
            $request->session()->regenerate();
            return redirect()->route("home")->with("success", "User logged in successfully");
        }

        // If authentication fails, redirect back with errors and old input
        return back()->withErrors(["email" => "Invalid credentials"])->onlyInput('email');
    }


    // Logout
    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerate();
        return redirect()->route("login")->with("success", "Logout Successfully.");
    }
}
