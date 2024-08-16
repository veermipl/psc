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

                @if ($news->files)
                    @php
                        $news_files = explode(',', $news->files);
                    @endphp
                    <hr>

                    <div class="allFileWrapper d-flex">
                        @foreach ($news_files as $fileKey => $fileValue)
                            @if ($fileValue)
                                @php
                                    $fileInfo = pathinfo($fileValue);
                                    $extension = $fileInfo['extension'];
                                @endphp

                                @if (in_array($extension, ['jpg', 'jpeg', 'gif', 'png']))
                                    <div class="fileWrapper">
                                        <img class="li_img pop_up_image" src="{{ asset('storage/' . $fileValue) }}">
                                    </div>
                                @endif

                                @if (in_array($extension, ['pdf']))
                                    <div class="fileWrapper">
                                        <img class="li_img pop_up_doc" src="{{ asset('storage/default/pdf.png') }}">
                                    </div>
                                @endif
                            @endif
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection
