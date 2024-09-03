@extends('layout.master')

@section('title', '503 Service Unavailable')

@section('content')
    <div class="p-5 bg-white text-center">

        <h1>500 - Internal Server Error</h1>
        <p class="text-danger py-3">Something went wrong on our end. Please try again later.</p>
        <a href="{{ route('home') }}" class="btn btn-primary mt-3">Go to Homepage</a>

    </div>
@endsection
