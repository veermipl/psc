@extends('layout.admin_master')

@section('title', 'Role - View')
@section('header', 'View Role')

@section('content')

    <div class="p-3 bg-white">

        <h5 class="fw-bold">View Role</h5>

        <div class="pt-5">
            <h5 class="fw-bold">{{ $role->name }}</h5>

            <h6 class="fw-bold py-4">Permissions:</h6>
            <div class="row">
                @foreach ($permissions as $key => $permission)
                    {{-- <p class="mx-3 btn btn-outline-custom">{{ $permission->name }}</p> --}}
                @endforeach
            </div>

        </div>
    </div>

@endsection
