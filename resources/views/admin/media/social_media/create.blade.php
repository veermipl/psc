@extends('layout.admin_master')

@section('title', 'Social Media - Create')
@section('header', 'Create Social Media')

@section('content')

    <div class="page-breadcrumb d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Create Social Media</div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="p-4 border rounded">
                        <form action="{{ route('admin.media-center.social-media.store') }}" method="post"
                            enctype="multipart/form-data" class="row g-3 needs-validation">
                            @csrf
                            @method('post')

                            <div class="col-12 text-end mt-5">
                                <button class="btn btn-sm btn-primary" type="submit">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
