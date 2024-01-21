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
        return view("users.index", ["posts" => $posts]);
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
