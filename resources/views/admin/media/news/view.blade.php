@extends('layout.admin_master')

@section('title', 'News - View')
@section('header', 'View News')

@section('content')

    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">View News</div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="p-4 border rounded">
                        <h5 class="text-center fw-bold p-0 m-0">{{ $news->title }}</h5>

                        <div class="card-body">
                            <p class="">{!! $news->content !!}</p>
                        </div>

                        <div class="text-end">
                            <span class="text-danger">{{ $news->created_at }}</span>
                        </div>

                        @if ($news->files)
                            @php
                                $news_files = explode(',', $news->files);
                            @endphp

                            <div class="allFileWrapper d-flex mt-5">
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
        </div>
    </div>

@endsection
