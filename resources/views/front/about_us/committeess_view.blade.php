@extends('layout.master')

@section('content')
    <section class="banner-section wow bg-about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="back-ground">
                        <h2>Committees</h2>
                        <div class="breadcrumbs text-center wow animate__ animate__fadeInUp animate__delay-1s animated"
                            style="visibility: visible; animation-name: fadeInUp;">
                            <ul>
                                <li><a href="{{ url('/') }}">Home</a></li>
                                <span class="slash"> /</span>
                                <li><a href="{{ route('about-us.committeess') }}">Committees</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="blog-one-section">
        <div class="container">
            @if ($details)
                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-6">
                        <div class="team-one-single wow fadeInLeft animated" data-wow-delay="100ms"
                            style="visibility: visible; animation-delay: 100ms; animation-name: fadeInLeft;">
                        </div>
                    </div>
                </div>
            @else
                <h6 class="text-center">No Data Found !</h6>
            @endif
        </div>
    </section>
@endsection
