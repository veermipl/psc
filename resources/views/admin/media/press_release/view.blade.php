@extends('layout.admin_master')

@section('title', 'Press Release - View')
@section('header', 'View Press Release')

@section('content')

    <div class="p-3 bg-white">

        <h5 class="fw-bold">View Press Release</h5>

        <div class="pt-5">
            <div class="list-group-item mb-3">
                <h4 class="text-center fw-bold pb-2">{{ $press_release->title }}</h4>

                <p class="">{!! $press_release->content !!}</p>

                <hr>
                <div class="d-flex text-right" style="justify-content: space-between">
                    @if ($press_release->status == 1)
                        <span><i class="fa fa-circle text-success" title="Active"></i></span>
                    @else
                        <span><i class="fa fa-circle text-danger" title="In Active"></i></span>
                    @endif

                    <span class="text-danger">{{ $press_release->created_at }}</span>
                </div>

                @if ($press_release->files)
                    @php
                        $press_release_files = explode(',', $press_release->files);
                    @endphp
                    <hr>

                    <div class="allFileWrapper d-flex">
                        @foreach ($press_release_files as $fileKey => $fileValue)
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
