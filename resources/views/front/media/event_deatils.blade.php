@extends('layout.master')

@section('content')
    <!-- End Main Header -->
    <section class="banner-section wow bg-about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="back-ground">
                        <h2>{{ $details ? $details->title : 'Event Details' }}</h2>
                        <div class="breadcrumbs text-center wow animate__ animate__fadeInUp animate__delay-1s animated"
                            style="visibility: visible; animation-name: fadeInUp;">
                            <ul>
                                <li><a href="{{ route('home') }}">Home</a></li>
                                <span class="slash"> /</span>
                                <li><a href="#">Event</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="blog-classic-section pb-40">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-7">
                    <div class="blog-classic-content">
                        <!--Blog Classic Single-->
                        <div class="blog-classic-single mb-30">
                            <div class="blog-classic-image">
                                <img src="{{ asset('storage/' . @$details->image) }}" alt="">
                                @if (@$details->loaction)
                                    <div class="blog-classic-date">
                                        {{ $details->loaction }}
                                    </div>
                                @endif
                            </div>
                            <div class="blog-classic-content-box mb-15">
                                <ul class="blog-classic-meta">
                                    @if ($details->loaction != '')
                                        <li>
                                            <a href="#">
                                                <i class="far fa-calendar" aria-hidden="true"></i> 17/09/2024 &nbsp;
                                                04:12pm
                                            </a>
                                        </li>
                                    @endif

                                </ul>
                                <div class="blog-classic-title">
                                    <h3><a href="#"> {{ $details->title }}</a></h3>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>
                <div class="col-xl-4 col-lg-5">
                    <div class="sidebar">
                        @if (isset($events) && count($events) > 0)
                            <div class="sidebar-single sidebar-latest-news">
                                <h3 class="sidebar-title">Event List</h3>
                                <ul class="sidebar-latest-news-list">
                                    @foreach ($events as $data)
                                        <li>
                                            <div class="sidebar-latest-news-image">
                                                <img src="{{ asset('storage/' . $data->image) }}" alt="">
                                            </div>
                                            <div class="sidebar-latest-news-content">
                                                <h3><a
                                                        href="{{ route('event.event_details', base64_encode($data->id)) }}">{{ $data->title }}</a>
                                                </h3>
                                                <p>02 May, 2020</p>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif



                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="blog-classic-title">
                        <h3>Gallery</h3>
                    </div>
                </div>
                <div class="container">
                    <div class="portfolio-one-content">
                        <div class="sortable-masonry">
                            <div class="row items-container" style="position: relative; height: 590px;">
                                <!--Single Case One-->
                                @if ($details->files)
                                    @php
                                        $files = explode(',', $details->files);
                                    @endphp


                                    @foreach ($files as $fileKey => $fileValue)
                                        @if ($fileValue)
                                            @php
                                                $fileInfo = pathinfo($fileValue);
                                                $extension = $fileInfo['extension'];
                                            @endphp

                                            <div class="col-xl-3 col-lg-3 col-md-6 masonry-item all mechanical chemical material"
                                                style="position: absolute; left: 0px; top: 0px;">
                                                <div class="portfolio-one-single">
                                                    <div class="portfolio-one-img-box">
                                                        <img src="{{ asset('storage/' . $fileValue) }}" alt="">
                                                        <div class="portfolio-two-icon-box">
                                                            <a href="{{ asset('storage/' . $fileValue) }}"
                                                                class="img-popup"><i class="fa fa-search"></i></a>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </section>




@endsection
