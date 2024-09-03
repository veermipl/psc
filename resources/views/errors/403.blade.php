@extends('layout.master')

@section('title', '403')

@section('content')

    <div class="p-5 bg-white text-center">

        <h1>403 - Forbidden</h1>
        <p class="text-danger py-2">You do not have permission to access this page.</p>
        <a href="{{ route('home') }}" class="btn btn-primary mt-3">Go to Homepage</a>
        
    </div>

@endsection
