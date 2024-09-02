@extends('layout.admin_master')

@section('title', 'CMS - Guyana Economy')

@section('content')

    <div class="page-breadcrumb d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Guyana Economy</div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="p-4 border rounded">
                        <h5 class="text-center fw-bold p-0 m-0">{{ $ge_data->title }}</h5>

                        <div class="card-body">
                            <p class="">{!! $ge_data->content !!}</p>
                        </div>

                        <div class="text-end">
                            <span class="text-danger">{{ $ge_data->created_at }}</span>
                        </div>

                        @if ($ge_data->images)
                            @php
                                $ge_data_images = explode(',', $ge_data->images);
                            @endphp

                            <div class="allImgWrapper d-flex mt-5">
                                @foreach ($ge_data_images as $imgKey => $imgName)
                                    @if ($imgName)
                                        <div class="imgWrapper">
                                            <img class="ge_img pop_up_image" src="{{ asset('storage/' . $imgName) }}">
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @endif
                </div>
            </div>
        </div>
    </div>

@endsection
