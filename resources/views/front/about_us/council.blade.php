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
    <!--Start Blog One Section -->
    <section class="blog-one-section">

        @if ($council)
            <div class="container">
                <div class="thm-section-title text-center">
                    <h4 class="sub-title-shape-left section_title-subheading">
                        Our
                    </h4>
                    <h2>{{ @$council->title }}</h2>
                </div>

                <div class="row">
                    <div class="col-xl-12">
                        <div class="about-two-right-content">
                            <div class="about-two-title text-justify">

                                <p class=" mt-30">
                                    {!! @$council->contant !!}

                                    <!-- The Council of the Private Sector Commission (PSC) of Guyana is a key body that represents and advocates for the interests of the private sector in Guyana. The PSC serves as a platform for dialogue between the business community and the government, aiming to foster economic growth and development in the country. Here’s an overview of the typical content and functions of the PSC: -->
                                </p>
                            </div>



                        </div>
                    </div>
                </div>
            </div>
        @else
            <p class="text-center">No Data Found !</p>
        @endif

    </section>
@endsection
