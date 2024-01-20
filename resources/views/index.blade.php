@extends('layout.app')

@section('title', 'Howl | Blog Feeds')

@include('partials._nav')

@section('content')
    <div class="container">

        {{-- Alert Box Function --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show my-3" role="alert">
                <strong>{{ session('success') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif


        {{-- Blog Create Form Control --}}
        <div class="d-flex justify-content-between align-items-center my-4">
            <h4 class="text-primary fw-bold">Blog Feeds</h4>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Add New
            </button>

            <!-- Modal -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Create new blog</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
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
                                <a type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</a>
                                <button type="submit" class="btn btn-primary">Post</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- Blog Search --}}
        <form class="form">
            <input type="search" class="form-control" placeholder="Search blog ...">
        </form>


        {{-- Side Nav --}}
        <div class="row">
            <div class="col-2">
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Category
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                Category List
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Genere
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                Genere List
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Author
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                Author
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Blog Feeds --}}
            @if ($posts)
                <div class="col-8">
                    @foreach ($posts as $post)
                        <div class="card mb-3">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <a href="{{ route('posts.show', $post->id) }}" class="text-decoration-none">
                                        <img src="{{ asset($post->image) }}" class="img-fluid rounded-start"
                                            alt="Post Image">
                                    </a>
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <a href="{{ route('posts.show', $post->id) }}" class="text-decoration-none">
                                            <h5 class="card-title text-secondary fw-bold fs-6">{{ $post->title }}</h5>
                                        </a>
                                        <p class="card-text"><small
                                                class="text-primary">{{ $post->category->name }}</small></p>
                                        <p class="card-text">{{ Str::limit($post->content, 70, '  ...') }}</p>
                                        <p class="card-text d-flex justify-content-between align-items-center">
                                            <small
                                                class="text-body-secondary">{{ $post->created_at->format('M d, Y') }}</small>
                                            <small>By : <a href="#" class="text-primary text-decoration-none">{{$post->user->name}}</a></small>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <small>Nothing to show</small>
            @endif
        </div>
    </div>
@endsection
