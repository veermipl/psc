@extends('layout.master')

@section('content')

    <!-- End Main Header -->
    <section class="banner-section wow bg-about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="back-ground">
                        <h2>Press Release</h2>
                        <div class="breadcrumbs text-center wow animate__ animate__fadeInUp animate__delay-1s animated"
                            style="visibility: visible; animation-name: fadeInUp;">
                            <ul>
                                <li><a href="{{ route('media.press-release') }}">Home</a></li>
                                <span class="slash"> /</span>
                                <li><a href="#">Press Release</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--Start Blog One Section -->
    <section class="blog-one-section" style="background-color: #fff;">
        <div class="container">
            <div class="row">

                <div class="col-lg-9">
                    @if(count($press_release_list) > 0)
                        <div class="row">
                            @foreach ($press_release_list as $listKey => $list )
                                <div class="col-xl-4 col-lg-4">
                                    <div class="blog-one-single guyana-wrap wow fadeInUp" data-wow-delay="100ms">
                                        <div class="blog-one-img  guyana-imgg">
                                            @if ($list->files)
                                                @php
                                                    $files = explode(',', $list->files);
                                                @endphp
                                                <img src="{{ asset('storage/' . $files[0]) }}">
                                            @else
                                                <img src="{{ asset('storage/default/no_image.png') }}">
                                            @endif
                                        </div>
                                        <div class="blog-one-content">
                                            <ul class="blog-classic-meta">
                                                <li>
                                                    <a href="#"><i class="fas fa-clock"></i> {{ date('h:i A', strtotime($list->created_at)) }}</a>
                                                </li>
                                                <li>
                                                    <a href="#"><i class="fas fa-calendar-alt"></i> {{ date('M d, Y', strtotime($list->created_at)) }}</a>
                                                </li>
                                            </ul>
                                            <div class="blog-one-title hei-65">
                                                <h3><a href="#">{{ $list->title }}</a></h3>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <h6 class="text-center">No Data Found !</h6>
                    @endif
                </div>

                <div class="col-xl-3 col-lg-5">
                    <div class="sidebar">
                        <div class="sidebar-single sidebar-latest-news p-3">
                            <h3 class="sidebar-title">Recent Press Release</h3>
                            @if(count($recent_press_release_list) > 0)
                                <ul class="sidebar-latest-news-list">
                                    @foreach ($recent_press_release_list as $listKey => $list )
                                        <li>
                                            <div class="sidebar-latest-news-image">
                                                @if ($list->files)
                                                    @php
                                                        $files = explode(',', $list->files);
                                                    @endphp
                                                    <img src="{{ asset('storage/' . $files[0]) }}">
                                                @else
                                                    <img src="{{ asset('storage/default/no_image.png') }}">
                                            @endif
                                            </div>
                                            <div class="sidebar-latest-news-content">
                                                <h3><a href="#">{{ $list->title }}</a></h3>
                                                <p>{{ date('M d, Y', strtotime($list->created_at)) }}</p>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <h6 class="text-center">No Data Found !</h6>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!--End Blog One Section -->
@endsection
