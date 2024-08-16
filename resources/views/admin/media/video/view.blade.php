@extends('layout.admin_master')

@section('title', 'News - View')
@section('header', 'View News')

@section('content')

    <div class="p-3 bg-white">

        <h5 class="fw-bold">View News</h5>

        <div class="pt-5">
            <div class="list-group-item mb-3">
                <h4 class="text-center fw-bold pb-2">{{ $news->title }}</h4>

                <p class="">{!! $news->content !!}</p>

                <hr>
                <div class="d-flex text-right" style="justify-content: space-between">
                    @if ($news->status == 1)
                        <span><i class="fa fa-circle text-success" title="Active"></i></span>
                    @else
                        <span><i class="fa fa-circle text-danger" title="In Active"></i></span>
                    @endif

                    <span class="text-danger">{{ $news->created_at }}</span>
                </div>

                @if ($news->images)
                    @php
                        $news_images = explode(',', $news->images);
                    @endphp
                    <hr>

                    <div class="allImgWrapper d-flex">
                        @foreach ($news_images as $imgKey => $imgName)
                            @if ($imgName)
                                <div class="imgWrapper">
                                    <img class="li_img pop_up_image" src="{{ asset('storage/' . $imgName) }}">
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection
