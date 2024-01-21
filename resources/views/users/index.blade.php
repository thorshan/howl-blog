@extends('layout.app')

@section('title', 'Howl | Account')

@include('partials._nav')

@section('content')
    <div class="container">

        {{-- Side Nav --}}
        <div class="row my-3">
            <div class="col-2">
                <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <button class="nav-link mb-3 border border-start-0 border-end-0 rounded-0 active" id="v-pills-home-tab"
                        data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab"
                        aria-controls="v-pills-home" aria-selected="true">Profile</button>
                    <button class="nav-link mb-3 border border-start-0 border-end-0 rounded-0" id="v-pills-profile-tab"
                        data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab"
                        aria-controls="v-pills-profile" aria-selected="false">Posts</button>
                    <button class="nav-link mb-3 border border-start-0 border-end-0 rounded-0" id="v-pills-messages-tab"
                        data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab"
                        aria-controls="v-pills-messages" aria-selected="false">Privacy</button>
                </div>

            </div>
            <div class="col-10">
                {{-- Alert Box Function --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show my-3" role="alert">
                        <strong>{{ session('success') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                        aria-labelledby="v-pills-home-tab" tabindex="0">
                        {{-- Profile Section --}}
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="text-primary">Profile</h3>
                            <a href="{{ route('edit.user', $user->id) }}" class="btn btn-primary">Edit</a>
                        </div>
                        <br>
                        <div class="card border-primary p-3 my-3">
                            <div class="row my-3 align-items-center">
                                <div class="col-3">
                                    <img src="{{ asset($user->img) }}" class="image-fluid" width="200"
                                        alt="Profile Photo">
                                </div>
                                <div class="col-7 mx-5">
                                    <h1 class="text-secondary fw-bold fs-3">{{ auth()->user()->name }}</h1>
                                    <small class="text-primary">{{ $user->email }}</small>
                                </div>
                            </div>
                        </div>
                        <div class="card border-primary p-3 my-3">
                            <div class="row">
                                <div class="col">
                                    <blockquote class="blockquote">
                                        <p class="mb-3 text-primary">Summary</p>
                                        <footer class="blockquote-footer">{{ $user->summary }}</footer>
                                    </blockquote>
                                </div>
                            </div>
                        </div>
                        <h3 class="text-primary my-3">Posts</h3>
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
                                                <small>By : <a href="#"
                                                        class="text-primary text-decoration-none">{{ $post->user->name }}</a></small>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Post Section --}}
                    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab"
                        tabindex="0">
                        <h3 class="text-primary">Posts</h3>
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
                                                <small>By : <a href="#"
                                                        class="text-primary text-decoration-none">{{ $post->user->name }}</a></small>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Privacy Section --}}
                    <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab"
                        tabindex="0">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="btn btn-danger">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
