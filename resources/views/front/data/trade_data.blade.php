@extends('layout.master')

@section('content')

    <section class="banner-section wow bg-about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="back-ground">
                        <h2>Trade Data</h2>
                        <div class="breadcrumbs text-center wow animate__ animate__fadeInUp animate__delay-1s animated"
                            style="visibility: visible; animation-name: fadeInUp;">
                            <ul>
                                <li><a href="{{ route('home') }}">Home</a></li>
                                <span class="slash"> /</span>
                                <li><a href="{{ route('data.trade-data') }}">Trade Data</a></li>
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
                        background-image: url('{{ asset('/images/about/about-2--pattern-2.png') }}');">
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
                                    Our
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


    <section class="main-service-one-section two">
        <div class="thm-section-title text-center">
            <h4 class="sub-title-shape-left section_title-subheading">
                Top Trading
            </h4>
            <h2>Partner</h2>
        </div>
        <div class="container">
            @if(count($top_partner) > 0)
            <div class="row">
                @foreach($top_partner as $sourceKey => $sourceVal)
                    <div class="col-xl-4 col-lg-4">
                        <div class="main-service-one-sec-single wow fadeInUp animated" data-wow-delay="100ms"
                            style="visibility: visible; animation-delay: 100ms; animation-name: fadeInUp;">
                            <div class="main-service-one-sec-img">
                                @if ($sourceVal['file'])
                                    <img src="{{ asset('storage/' . $sourceVal['file']) }}">
                                @else
                                    <img src="{{ asset('storage/default/no_image.png') }}">
                                @endif
                            </div>
                            <div class="main-service-one-sec-content">
                                <h4>{{ $sourceVal['title'] }}</h4>
                                @php
                                    $limitedContent = Str::limit($sourceVal['content'], 200);
                                @endphp
                                <p>{!! $limitedContent !!}</p>
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

    <section class="main-service-one-section two pt-0 mb-0">
        <div class="thm-section-title text-center">
            <h4 class="sub-title-shape-left section_title-subheading">
                Top Trading
            </h4>
            <h2>Country</h2>
        </div>
        <div class="container">
            @if(count($top_country) > 0)
                <div class="row">
                    @foreach($top_country as $sourceKey => $sourceVal)
                        <div class="col-xl-4 col-lg-4">
                            <div class="main-service-one-sec-single wow fadeInUp animated" data-wow-delay="100ms"
                                style="visibility: visible; animation-delay: 100ms; animation-name: fadeInUp;">
                                <div class="main-service-one-sec-img">
                                    @if ($sourceVal['file'])
                                        <img src="{{ asset('storage/' . $sourceVal['file']) }}">
                                    @else
                                        <img src="{{ asset('storage/default/no_image.png') }}">
                                    @endif
                                </div>
                                <div class="main-service-one-sec-content">
                                    <h4>{{ $sourceVal['title'] }}</h4>
                                    @php
                                        $limitedContent = Str::limit($sourceVal['content'], 200);
                                    @endphp
                                    <p>{!! $limitedContent !!}</p>
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
@endsection
