@extends('layout.master')

@section('content')

    <section class="banner-section wow bg-about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="back-ground">
                        <h2>CARICOM CET</h2>
                        <div class="breadcrumbs text-center wow animate__ animate__fadeInUp animate__delay-1s animated"
                            style="visibility: visible; animation-name: fadeInUp;">
                            <ul>
                                <li><a href="{{ route('home') }}">Home</a></li>
                                <span class="slash"> /</span>
                                <li><a href="{{ route('data.caricom-cet') }}">CARICOM CET</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Start Blog One Section -->
    <section class="about-tow-section about-page">
        <div class="container">
            @if(@$main)
                <div class="row">
                    <div class="col-xl-6">
                        <div class="about-two-left-content wow slideInLeft animated" data-wow-delay="100ms"
                            style="
                    visibility: visible;
                    animation-delay: 100ms;
                    animation-name: slideInLeft;
                    ">
                            <div class="about-two-sec-image">
                                <div class="about-two-sec-image-bg-1"
                                    style="
                        background-image: url('{{ asset('/images/about/about-2--pattern-1.png') }}');
                        ">
                                </div>
                                <div class="about-two-sec-image-bg-2"
                                    style="
                        background-image: url('{{ asset('/images/about/about-2--pattern-2.png') }}');
                        ">
                                </div>
                                @if ($main['file'])
                                    <img src="{{ asset('storage/' . $main['file']) }}">
                                @else
                                    <img src="{{ asset('storage/default/no_image.png') }}">
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="about-two-right-content">
                            <div class="about-two-title">
                                <h4 class="sub-title-shape-left section_title-subheading">
                                    Describe the
                                </h4>
                                <h2>{{ $main['title'] }}</h2>
                                <p class="">{!! $main['content'] !!} </p>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <h6 class="text-center">No Data Found !</h6>
            @endif
        </div>
    </section>

    <section class="features-two-section">
        <div class="container">
            <div class="thm-section-title text-center">
                <h4 class="sub-title-shape-left section_title-subheading">
                    Purpose
                </h4>
                <h2>And Objectives</h2>
            </div>
            <div class="container">
                @if(count($objectives) > 0)
                    <div class="row">
                        @foreach($objectives as $sourceKey => $sourceVal)
                            <div class="col-lg-4 col-md-6">
                                <div class="features-two-sec-single wow fadeInUp h-100 animated active" data-wow-delay="300ms"
                                    style="visibility: visible;animation-delay: 300ms;animation-name: fadeInUp;">
                                    <div class="features-two-sec-icon">
                                        @if ($sourceVal['file'])
                                            <img src="{{ asset('storage/' . $sourceVal['file']) }}">
                                        @else
                                            <img src="{{ asset('storage/default/no_image.png') }}">
                                        @endif
                                    </div>
                                    <h3>{{ $sourceVal['title'] }}</h3>
                                    @php
                                        $limitedContent = Str::limit($sourceVal['content'], 150);
                                    @endphp
                                    <p>{!! $limitedContent !!}</p>

                                    <a href="{{ route('data.caricom-cet-objective-show', $sourceVal['id']) }}" class="vs-btn style3 mt-4" tabindex="0">Read More<i
                                            class="far fa-long-arrow-right"></i></a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <h6 class="text-center">No Data Found !</h6>
                @endif
            </div>
        </div>
    </section>

    <section class="why-choose-two-section">
        <div class="container">
            <div class="thm-section-title text-center">
                <h4 class="sub-title-shape-left section_title-subheading">
                    How the
                </h4>
                <h2>CARICOM CET Works</h2>
            </div>
            <div class="container">
                @if(count($how_it_works) > 0)
                    <div class="row">
                        @foreach($how_it_works as $sourceKey => $sourceVal)
                            <div class="col-md-6 col-lg-4 py-2">
                                <div class="widget h-100">
                                    <h3 class="widget_title">{{ $sourceVal['title'] }}</h3>
                                    <div class="recent-post-wrap">
                                        <div class="recent-post">
                                            <!-- <div class="media-img"><a href="#"><img src="assets/img/blog/recent-post-1-1.jpg" alt="Blog Image"></a></div> -->
                                            <div class="media-body">
                                                <div class="recent-post-meta">
                                                    <ul class="table-list">
                                                        <li>
                                                            <p>{!! $sourceVal['content'] !!}</p>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
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
        </div>
    </section>
    <!--End Blog One Section -->
@endsection
