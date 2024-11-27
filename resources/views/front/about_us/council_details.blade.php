@extends('layout.master')

@section('content')
    <section class="banner-section wow bg-about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="back-ground">
                        <h2>Council</h2>
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
        @if ($details)
            <div class="container">
                <div class="thm-section-title text-center">
                    <h4 class="sub-title-shape-left section_title-subheading">
                        Our
                    </h4>
                    <h2>{{ @$details->title }}</h2>
                </div>

                <div class="row">
                    <div class="col-xl-12">
                        <div class="about-two-right-content">
                            <div class="about-two-title text-justify">
                                {!! @$details->contant !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <p class="text-center">No Information Found !</p>
        @endif
    </section>
@endsection
