@extends('layout.master')

@section('title', '403')

@section('content')

    <div class="p-5 bg-white text-center">

        <h1>419 - Page Expired</h2>
        <p class="text-danger py-3">Your session has expired. Please refresh the page or login again!</p>
        <a href="{{ route('home') }}" class="btn btn-primary">Home</a>
        <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
    </div>

@endsection
