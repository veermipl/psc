@extends('layout.master')

@section('content')
    <section class="banner-section wow bg-about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="back-ground">
                        <h2>Staff</h2>
                        <div class="breadcrumbs text-center wow animate__ animate__fadeInUp animate__delay-1s animated"
                            style="visibility: visible; animation-name: fadeInUp;">
                            <ul>
                                <li><a href="{{ url('/') }}">Home</a></li>
                                <span class="slash"> /</span>
                                <li><a href="{{ route('about-us.staff') }}">Staff</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="blog-one-section">
        <div class="container">
            <div class="thm-section-title text-center">
                <h4 class="sub-title-shape-left section_title-subheading">
                    Our
                </h4>
                <h2>Staff </h2>
            </div>

            @if (count(@$staff) > 0)
                <div class="row">
                    @foreach ($staff as $members)
                        <div class="col-xl-3 col-lg-3 col-md-6">
                            <div class="team-one-single wow fadeInLeft animated" data-wow-delay="100ms"
                                style="visibility: visible; animation-delay: 100ms; animation-name: fadeInLeft;">
                                <div class="team-one-img">
                                    @if ($members->image)
                                        <img src="{{ asset('storage/' . $members->image) }}" alt="">
                                    @else
                                        <img src="{{ asset('images/team/commeties.png') }}" alt="">
                                    @endif
                                </div>
                                <div class="team-one-content team-one-content-2">
                                    <h3>{{ $members->name }}</h3>
                                    <p>{{ $members->office }}</p>
                                </div>
                                <div class="team-one-content pt-0 d-none">
                                    <a href="{{ route('about-us.staff-show', $members->id) }}" class="vs-btn1 style5 mt-3"
                                        tabindex="0">
                                        Read More <i class="far fa-long-arrow-right"></i>
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
@endsection
