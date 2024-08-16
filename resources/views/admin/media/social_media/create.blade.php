@extends('layout.admin_master')

@section('title', 'Social Media - Create')
@section('header', 'Create Social Media')

@section('content')

    <div class="p-3 bg-white">

        <h5 class="fw-bold">Create Social Media</h5>

        <div class="pt-5">
            <form action="{{ route('admin.media-center.social-media.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('post')

                <div class="form-group col-md-12 text-right">
                    <button class="btn btn-sm btn-custom" type="submit">Create Social Media</button>
                </div>
            </form>
        </div>
    </div>

@endsection
