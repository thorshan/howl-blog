@extends('layout.app')

@section('title', 'Howl | Account')

@include('partials._nav')

@section('content')

    <div class="container">
        <h3 class="text-primary my-3">Edit <span>{{ auth()->user()->name }}</span></h3>
        <br>
        <form action="{{ route('update.user') }}" method="post" enctype="multipart/form-data" class="w-50">
            @csrf
            <div class="form-group mb-3">
                <label for="img">Image</label>
                <input type="file" class="form-control custom-input" name="img" value="{{ $user->img }}">
                @error('img')
                    <p class="text-danger text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" value="{{ $user->name }}">
                @error('name')
                    <p class="text-danger text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="summary">Summary</label>
                <textarea class="form-control" name="summary">{{ $user->summary }}</textarea>
                @error('summary')
                    <p class="text-danger text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" value="{{ $user->email }}">
                @error('email')
                    <p class="text-danger text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group mb-5" hidden>
                <label for="name">Password</label>
                <input type="password" class="form-control" name="password" value="{{ $user->password }}">
                @error('password')
                    <p class="text-danger text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <button class="btn btn-primary w-25 mb-3">Update</button>
        </form>
    </div>

@endsection
