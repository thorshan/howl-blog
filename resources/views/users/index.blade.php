@extends('layout.app')

@section('title', 'Howl | Account')

@include('partials._nav')

@section('content')
    <div class="container">
        @foreach ($posts as $post)
            <p>{{$post->content}}</p>
        @endforeach
    </div>

    <form action="{{route('logout')}}" method="POST">
        @csrf
        <button class="btn btn-danger">Logout</button>
    </form>
@endsection