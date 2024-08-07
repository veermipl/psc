@extends('layout.master')

@section('title', 'Profile')
@section('header', 'Profile')

@section('content')

    <div class="p-3 bg-white">

        <h5 class="fw-bold">Profile</h5>

        <div class="pt-5">
            Name: {{ $user['name'] }}
        </div>

    </div>

@endsection
