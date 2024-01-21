@extends('layout.app')

@section('title', 'Howl | Register')

@section('content')

<div class="container m-5">
    <div class="text-center">
        <img src="{{asset('logo.svg')}}" width="100" alt="">
    </div>
    <h1 class="text-primary text-center my-3">Create new account</h1>
    <div class="d-flex justify-content-center align-items-center">
        <div class="card shadow-sm border-primary p-5 w-50">
            <form action="{{route('create.user')}}" method="POST">
                @csrf
                @method('POST')
                <div class="form-group mb-3">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" value="{{old('name')}}">
                    @error('name')
                        <p class="text-danger text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" value="{{old('email')}}">
                    @error('email')
                        <p class="text-danger text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group mb-5">
                    <label for="name">Password</label>
                    <input type="password" class="form-control" name="password" value="{{old('password')}}">
                    @error('password')
                        <p class="text-danger text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
                <button class="btn btn-primary w-100 mb-3">Register</button>
                <span>Already have an account? <a href="{{route('login')}}">Login</a></span>
            </form>
        </div>
    </div>
</div>

@endsection