@extends('layout.app')

@section('title', 'Howl | Account')

@include('partials._nav')

@section('content')
    <div class="container">

        <h3 class="text-primary my-3">Create new blog</h3>
        <form action="{{ route('posts.store') }}" enctype="multipart/form-data" method="POST">
            @csrf
            <div class="modal-body">
                <div class="form-group mb-3">
                    <label for="title">Blog Title</label>
                    <input type="text" name="title" class="form-control">
                    @error('title')
                        <span class="text-danger mt-1">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="category">Select Category</label>
                    <select name="category_id" id="category" class="custom-select form-control">
                        <option value=""> -- Select -- </option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <span class="text-danger mt-1">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="image">Image</label>
                    <input type="file" name="image" class="custom-input form-control">
                    @error('image')
                        <span class="text-danger mt-1">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="content">Content</label>
                    <textarea name="content" id="" rows="10" class="form-control" placeholder="What's on your mind ..."></textarea>
                    @error('content')
                        <p class="text-danger mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="modal-footer">
                <a href="{{route('dashboard')}}" type="button" class="btn btn-secondary me-3">Cancel</a>
                <button type="submit" class="btn btn-primary">Publish</button>
            </div>
        </form>
    </div>

@endsection
