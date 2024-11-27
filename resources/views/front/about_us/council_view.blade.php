@extends('layout.master')

@section('content')
    <section class="banner-section wow bg-about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="back-ground">
                        <h2>{{ $council ? $council->name : 'Council' }}</h2>
                        <div class="breadcrumbs text-center wow animate__ animate__fadeInUp animate__delay-1s animated"
                            style="visibility: visible; animation-name: fadeInUp;">
                            <ul>
                                <li><a href="{{ url('/') }}">Home</a></li>
                                <span class="slash"> /</span>
                                <li><a href="{{ route('about-us.council') }}">Council</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="blog-one-section">
        <div class="container">
            @if ($council)
                <div class="row">
                    <div class="col-xl-6">
                        <div class="about-two-left-content wow slideInLeft animated" data-wow-delay="100ms"
                            style="visibility: visible; animation-delay: 100ms; animation-name: slideInLeft;">
                            <div class="about-two-sec-image commi-img">
                                <div class="about-two-sec-image-bg-1"
                                    style="background-image: url('https://psc-dev.digitalnoticeboard.biz/images/about/about-2--pattern-1.png');">
                                </div>
                                @if ($council->image)
                                    <img src="{{ asset('storage/' . $council->image) }}" alt="">
                                @else
                                    <img src="{{ asset('images/team/commeties.png') }}" alt="">
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="mar-left-20">
                            <div class="about-two-title commi-detail">
                                <h2>{{ $council->name }}</h2>
                                <h4><span>Designation: </span>{{ $council->designattion }}</h4>
                                <p>{!! $council->terms_of_reference !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <h6 class="text-center">No Data Found !</h6>
            @endif
        </div>
    </section>
@endsection
