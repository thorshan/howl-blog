<?php

namespace App\Http\Controllers\users;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Models\Post;

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
        $user->password = $formData["password"];

        $user->save();

        auth()->login($user);

        return redirect()->route('home')->with("success", "User created successfully.");
    }

    // Login
    public function authenticate(Request $request)
    {
        $formData = $request->validate([
            "email" => ['required', 'email', Rule::unique('users')->ignore($request->email)],
            "password" => "required|min:5",
        ]);

        if (auth()->attempt($formData)) {
            $request->session()->regenerate();
            return redirect()->route("home")->with("success", "User logged in successfully");
        }

        return back()->withErrors(["email" => "Invalid Credentials"])->onlyInput('email');
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
