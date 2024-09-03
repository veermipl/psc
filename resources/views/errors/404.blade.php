@extends('layout.master')

@section('title', '403')

@section('content')

    <div class="p-5 bg-white text-center">

        <h1>404 - Page Not Found</h1>
        <p class="text-danger py-2">The page you are looking for does not exist.</p>
        <a href="{{ route('home') }}" class="btn btn-primary mt-3">Go to Homepage</a>
        
    </div>

@endsection
