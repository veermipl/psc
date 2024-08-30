@extends('layout.master')

@section('content')
    <!-- <section class="why-choose-two-section">
            <div class="container">
                <div class="thm-section-title text-center">
                    <h4 class="sub-title-shape-left section_title-subheading">
                        Media Center
                    </h4>
                    <h2>Social Media</h2>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque atque, libero ut repudiandae quas voluptatem. Quo ut natus sapiente eos sunt, laborum eius, in, atque dolore quod harum odit amet.
                    </div>
                </div>
            </div>
        </section> -->

    <section class="banner-section wow bg-about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="back-ground">
                        <h2>Photos</h2>
                        <div class="breadcrumbs text-center wow animate__ animate__fadeInUp animate__delay-1s animated"
                            style="visibility: visible; animation-name: fadeInUp;">
                            <ul>
                                <li><a href="{{ route('home') }}">Home</a></li>
                                <span class="slash"> /</span>
                                <li><a href="#">Photos</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Start Blog One Section -->


    <section class="portfolio-one-section-photo">
        <div class="container">
            <div class="portfolio-one-content">
                <div class="sortable-masonry">
                    <div class="row items-container" style="position: relative; height: 870px;">
                        <!--Single Case One-->
                        <div class="col-xl-4 col-lg-3 col-md-6 masonry-item all mechanical chemical material"
                            style="position: absolute; left: 0px; top: 0px;">
                            <div class="portfolio-one-single">
                                <div class="portfolio-one-img-box">
                                    <img src="{{ asset('images/photo/photo7.jpg') }}" alt="">
                                    <div class="portfolio-two-icon-box">
                                        <a href="{{ asset('images/photo/photo7.jpg') }}" class="img-popup"><i
                                                class="fa fa-search"></i></a>

                                    </div>
                                    <div class="portfolio-text">
                                        <h4>Annual Report</h4>
                                        <p>Private Sector Commission</p>
                                    </div>

                                </div>

                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-3 col-md-6 masonry-item all mechanical chemical material"
                            style="position: absolute; left: 400px; top: 0px;">
                            <div class="portfolio-one-single">
                                <div class="portfolio-one-img-box">
                                    <img src="{{ asset('images/Blog/LU1.jpg') }}" alt="">
                                    <div class="portfolio-two-icon-box">
                                        <a href="{{ asset('images/Blog/LU1.jpg') }}" class="img-popup"><i
                                                class="fa fa-search"></i></a>

                                    </div>
                                    <div class="portfolio-text">
                                        <h4>Leadership Team Discusses</h4>
                                        <p>Private Sector Commission</p>
                                    </div>

                                </div>

                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-3 col-md-6 masonry-item all mechanical chemical material"
                            style="position: absolute; left: 800px; top: 0px;">
                            <div class="portfolio-one-single">
                                <div class="portfolio-one-img-box">
                                    <img src="{{ asset('images/photo/photo6.jpg') }}" alt="">
                                    <div class="portfolio-two-icon-box">
                                        <a href="{{ asset('images/photo/photo6.jpg') }}" class="img-popup"><i
                                                class="fa fa-search"></i></a>

                                    </div>
                                    <div class="portfolio-text">
                                        <h4>Team Members</h4>
                                        <p>Private Sector Commission</p>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-3 col-md-6 masonry-item all mechanical chemical material"
                            style="position: absolute; left: 0px; top: 280px;">
                            <div class="portfolio-one-single">
                                <div class="portfolio-one-img-box">
                                    <img src="{{ asset('images/photo/photo3.jpg') }}" alt="">
                                    <div class="portfolio-two-icon-box">
                                        <a href="{{ asset('images/photo/photo3.jpg') }}" class="img-popup"><i
                                                class="fa fa-search"></i></a>

                                    </div>
                                    <div class="portfolio-text">
                                        <h4>International Chamber</h4>
                                        <p>Private Sector Commission</p>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-3 col-md-6 masonry-item all mechanical chemical material"
                            style="position: absolute; left: 400px; top: 280px;">
                            <div class="portfolio-one-single">
                                <div class="portfolio-one-img-box">
                                    <img src="{{ asset('images/photo/photo4.jpg') }}" alt="">
                                    <div class="portfolio-two-icon-box">
                                        <a href="{{ asset('images/photo/photo4.jpg') }}" class="img-popup"><i
                                                class="fa fa-search"></i></a>

                                    </div>
                                    <div class="portfolio-text">
                                        <h4>Team Members</h4>
                                        <p>Private Sector Commission</p>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-3 col-md-6 masonry-item all mechanical chemical material"
                            style="position: absolute; left: 800px; top: 280px;">
                            <div class="portfolio-one-single">
                                <div class="portfolio-one-img-box">
                                    <img src="{{ asset('images/photo/photo5.jpg') }}" alt="">
                                    <div class="portfolio-two-icon-box">
                                        <a href="{{ asset('images/photo/photo5.jpg') }}" class="img-popup"><i
                                                class="fa fa-search"></i></a>

                                    </div>
                                    <div class="portfolio-text">
                                        <h4>Team Members</h4>
                                        <p>Private Sector Commission</p>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-3 col-md-6 masonry-item all mechanical chemical material"
                            style="position: absolute; left: 0px; top: 560px;">
                            <div class="portfolio-one-single">
                                <div class="portfolio-one-single">
                                    <div class="portfolio-one-img-box">
                                        <img src="{{ asset('images/photo/photo6.jpg') }}" alt="">
                                        <div class="portfolio-two-icon-box">
                                            <a href="{{ asset('images/photo/photo6.jpg') }}" class="img-popup"><i
                                                    class="fa fa-search"></i></a>

                                        </div>
                                        <div class="portfolio-text">
                                            <h4>Team Members</h4>
                                            <p>Private Sector Commission</p>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-3 col-md-6 masonry-item all mechanical chemical material"
                            style="position: absolute; left: 400px; top: 560px;">
                            <div class="portfolio-one-single">
                                <div class="portfolio-one-img-box">
                                    <img src="{{ asset('images/photo/photo8.jpg') }}" alt="">
                                    <div class="portfolio-two-icon-box">
                                        <a href="{{ asset('images/photo/photo8.jpg') }}" class="img-popup"><i
                                                class="fa fa-search"></i></a>

                                    </div>
                                    <div class="portfolio-text">
                                        <h4>Team Members</h4>
                                        <p>Private Sector Commission</p>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-3 col-md-6 masonry-item all mechanical chemical material"
                            style="position: absolute; left: 800px; top: 560px;">
                            <div class="portfolio-one-single">
                                <div class="portfolio-one-img-box">
                                    <img src="{{ asset('images/Blog/LU1.jpg') }}" alt="">
                                    <div class="portfolio-two-icon-box">
                                        <a href="{{ asset('images/Blog/LU1.jpg') }}" class="img-popup"><i
                                                class="fa fa-search"></i></a>

                                    </div>
                                    <div class="portfolio-text">
                                        <h4>Leadership Team Discusses</h4>
                                        <p>Private Sector Commission</p>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End Blog One Section -->
@endsection
