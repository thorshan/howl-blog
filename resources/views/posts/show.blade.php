@extends('layout.app')

@section('title', 'Howl | Account')

@include('partials._nav')

@section('content')
    <div class="container">
        <div class="d-flex flex-column">
            <h3 class="text-primary my-3">Post Details</h3>
            <br>
            <img src="{{ asset($post->image) }}" width="200" alt="Post picture">
            <br>
            <h4 class="text-secondary fw-bold my-3">{{ $post->title }}</h4>
            <small class="text-primary mb-3">{{ $post->category->name }}</small>
            <a href="#" class="text-decoration-none text-secondary mb-3">{{ $post->user->name }}</a>
            <q class="text-warp mb-5">{{$post->content}}</q>
        </div>
    </div>
@endsection
