@extends('layout.master')

@section('content')

<section class="banner-section wow bg-about">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="back-ground">
                    <h2>Guyana Economy</h2>
                    <div class="breadcrumbs text-center wow animate__ animate__fadeInUp animate__delay-1s animated" style="visibility: visible; animation-name: fadeInUp;">
                        <ul>
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <span class="slash"> /</span>
                            <li><a href="{{ route('guyana-economy') }}">Guyana Economy</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!--Start Blog One Section -->
<section class="blog-one-section">
    <div class="container">
        @if(count($guyana_list) > 0)
            <div class="row">
                @foreach ($guyana_list as $listKey => $list )
                    <div class="col-xl-4 col-lg-4">
                        <div class="blog-one-single guyana-wrap wow fadeInUp" data-wow-delay="100ms">
                            <div class="blog-one-img  guyana-imgg">
                                @if ($list->images)
                                    @php
                                        $ge_images = explode(',', $list->images);
                                    @endphp
                                    <img src="{{ asset('storage/' . $ge_images[0]) }}">
                                @else
                                    <img src="{{ asset('storage/default/no_image.png') }}">
                                @endif
                            </div>
                            <div class="blog-one-content">
                                <ul class="blog-classic-meta">
                                    <li>
                                        <a><i class="fas fa-clock"></i> {{ date('h:i A', strtotime($list->created_at)) }}</a>
                                    </li>
                                    <li>
                                        <a><i class="fas fa-calendar-alt"></i> {{ date('M d, Y', strtotime($list->created_at)) }}</a>
                                    </li>
                                </ul>
                                <div class="blog-one-title">
                                    <h3><a href="{{ route('guyana-economy-show', $list->id) }}">{{ $list->title }}</a></h3>
                                </div>
                                <div class="blog-one-text">
                                    @php
                                        $limitedContent = Str::limit($list->content, 100);
                                    @endphp
                                    <p>{!! $limitedContent !!}</p>
                                </div>
                                <a href="{{ route('guyana-economy-show', $list->id) }}" class="vs-btn1 style5 mt-3" tabindex="0">Read More
                                    <i class="far fa-long-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <h6 class="text-center">No Data Found !</h6>
        @endif
    </div>
</section>
<!--End Blog One Section -->
@endsection