@extends('layout.admin_master')

@section('title', 'CMS - Guyana Economy')

@section('content')

    <div class="p-3 bg-white">
        <h5 class="fw-bold">Guyana Economy</h5>

        <div class="pt-5">
            <div class="list-group-item mb-3">
                <h4 class="text-center fw-bold pb-2">{{ $ge_data->title }}</h4>

                <p class="">{!! $ge_data->content !!}</p>

                <hr>
                <div class="d-flex text-right" style="justify-content: space-between">
                    @if ($ge_data->status == 1)
                        <span><i class="fa fa-circle text-success" title="Active"></i></span>
                    @else
                        <span><i class="fa fa-circle text-danger" title="In Active"></i></span>
                    @endif

                    <span class="text-danger">{{ $ge_data->created_at }}</span>
                </div>

                @if ($ge_data->images)
                    @php
                        $ge_data_images = explode(',', $ge_data->images);
                    @endphp
                    <hr>

                    <div class="allImgWrapper d-flex">
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

@endsection
