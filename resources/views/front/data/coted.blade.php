@extends('layout.master')

@section('content')

    <section class="banner-section wow bg-about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="back-ground">
                        <h2>COTED</h2>
                        <div class="breadcrumbs text-center wow animate__ animate__fadeInUp animate__delay-1s animated"
                            style="visibility: visible; animation-name: fadeInUp;">
                            <ul>
                                <li><a href="{{ route('home') }}">Home</a></li>
                                <span class="slash"> /</span>
                                <li><a href="{{ route('data.coted') }}">COTED</a></li>
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
                        <div class="about-two-left-content wow slideInLeft" data-wow-delay="100ms">
                            <div class="about-two-sec-image">
                                <div class="about-two-sec-image-bg-1"
                                    style="
                        background-image: url('{{ asset('/images/about/about-2--pattern-1.png') }}');
                        ">
                                </div>
                                <div class="about-two-sec-image-bg-2"
                                    style="
                        background-image: url('{{ asset('images/about/about-2--pattern-2.png') }}');
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
                                    Center of Talent in
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


    <section class="main-service-one-section two pt-3">
        <div class="thm-section-title text-center">
            <h4 class="sub-title-shape-left section_title-subheading">
                Center of Talent in
            </h4>
            <h2>Entrepreneurship Development</h2>
        </div>
        <div class="container">
            @if(count($entrepreneurship_development) > 0)
                <div class="row">
                    @foreach($entrepreneurship_development as $sourceKey => $sourceVal)
                        <div class="col-xl-4 col-lg-4">
                            <div class="blog-one-single guyana-wrap wow fadeInUp" data-wow-delay="100ms"
                                style="visibility: visible;">
                                <div class="blog-one-img guyana-imgg">
                                    @if ($sourceVal['file'])
                                        <img src="{{ asset('storage/' . $sourceVal['file']) }}">
                                    @else
                                        <img src="{{ asset('storage/default/no_image.png') }}">
                                    @endif
                                </div>
                                <div class="blog-one-content">
                                    <div class="blog-one-title ">
                                        <h3><a href="{{ route('data.coted-entrepreneurship-development-show', $sourceVal['id']) }}">{{ $sourceVal['title'] }}</a></h3>
                                    </div>
                                    <div class="blog-one-text">
                                        @php
                                            $limitedContent = Str::limit($sourceVal['content'], 150);
                                        @endphp
                                        <p>{!! $limitedContent !!}</p>
                                    </div>
                                    <a href="{{ route('data.coted-entrepreneurship-development-show', $sourceVal['id']) }}" class="vs-btn1 style5 mt-3" tabindex="0">Read More <i
                                            class="far fa-long-arrow-right"></i></a>
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
