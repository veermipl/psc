@extends('layout.master')
@section('content')

    <section class="banner-section wow bg-about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="back-ground">
                        <h2>News</h2>
                        <div class="breadcrumbs text-center wow animate__ animate__fadeInUp animate__delay-1s animated"
                            style="visibility: visible; animation-name: fadeInUp;">
                            <ul>
                                <li><a href="{{ route('home') }}">Home</a></li>
                                <span class="slash"> /</span>
                                <li><a href="{{ route('media.news') }}">News</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="blog-classic-section">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-7">
                    <div class="blog-classic-content">

                        <div class="blog-classic-single">
                            <div class="blog-classic-image">
                                <div class="col-xl-12">
                                    <div class="brand-one-carousel-1 owl-carousel">
                                        @if ($details->files)
                                            @php
                                                $p_images = explode(',', $details->files);
                                            @endphp
                                            @foreach ($p_images as $pImgKey => $pImg)
                                                <div class="single_brand_item detail-slide">
                                                    <img src="{{ asset('storage/' .$pImg) }}">
                                                </div>
                                            @endforeach
                                        @else
                                            <img src="{{ asset('storage/default/no_image.png') }}">
                                        @endif
                                    </div>
                                </div>
                                <div class="blog-classic-date">
                                    <a class="btn-primary text-light">{{ @$details->created_at->format('M d, Y') }} </a>
                                </div>
                            </div>
                            <div class="blog-classic-content-box">
                                <ul class="blog-classic-meta">
                                    <li><a><i class="far fa-user-circle"></i> Admin</a></li>
                                    {{-- <li><a href="#"><i class="far fa-comments"></i> 2 Comments</a> --}}
                                    </li>
                                </ul>
                                <div class="blog-classic-title">
                                    <h3>{{ @$details->title }}</h3>
                                </div>
                                <div class="blog-classic-text">
                                    {!! @$details->content !!}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-xl-4 col-lg-5">
                    <div class="sidebar">
                        <div class="sidebar-single sidebar-search pt-0">
                            <h3 class="sidebar-title">Search</h3>
                            <form action="#" class="sidebar-search-form">
                                <input type="search" placeholder="Search">
                                <button type="submit"><i class="fa fa-search"></i></button>
                            </form>
                        </div>

                        <div class="sidebar-single sidebar-latest-news m-0">
                            <h3 class="sidebar-title">Latest Posts</h3>
                            @if (count(@$latest_list) > 0)
                                <ul class="sidebar-latest-news-list">
                                    @foreach ($latest_list as $postKey => $post)
                                        <li>
                                            <div class="sidebar-latest-news-image">
                                                @if ($post->files)
                                                    @php
                                                        $p_images = explode(',', $post->files);
                                                    @endphp
                                                    <img src="{{ asset('storage/' . $p_images[0]) }}">
                                                @else
                                                    <img src="{{ asset('storage/default/no_image.png') }}">
                                                @endif
                                            </div>
                                            <div class="sidebar-latest-news-content">
                                                <h3>
                                                    <a href="{{ route('media.news-show', base64_encode($post->id)) }}">{{ $post->title }}</a>
                                                </h3>
                                                <p>{{ $post->created_at->format('d M, Y') }}</p>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

@endsection
