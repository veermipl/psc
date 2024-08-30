@extends('layout.master')

@section('content')
    <!-- <section class="why-choose-two-section">
            <div class="container">
                <div class="thm-section-title text-center">
                    <h4 class="sub-title-shape-left section_title-subheading">
                        About Us
                    </h4>
                    <h2>Committeess</h2>
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
                        <h2>Committees</h2>
                        <div class="breadcrumbs text-center wow animate__ animate__fadeInUp animate__delay-1s animated"
                            style="visibility: visible; animation-name: fadeInUp;">
                            <ul>
                                <li><a href="{{ route('home') }}">Home</a></li>
                                <span class="slash"> /</span>
                                <li><a href="#">Committees</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Start Blog One Section -->
    <section class="blog-one-section">
        <div class="container">
            <div class="thm-section-title text-center">
                <h4 class="sub-title-shape-left section_title-subheading">
                    Our
                </h4>
                <h2>Committees Members</h2>
            </div>
            <div class="row">
                <div class="col-xl-3 col-lg-3 col-md-6">
                    <!--Team One Single-->
                    <div class="team-one-single wow fadeInLeft animated" data-wow-delay="100ms"
                        style="visibility: visible; animation-delay: 100ms; animation-name: fadeInLeft;">
                        <div class="team-one-img">
                            <img src="{{ asset('images/team/commeties.png') }}" alt="">
                            <div class="team-one-hover">
                                <div class="team-one-social">
                                    <a href="#"><i class="fab fa-facebook-square"></i></a>
                                    <a href="#"><i class="fab fa-twitter"></i></a>
                                    <a href="#"><i class="fab fa-dribbble"></i></a>
                                    <a href="#"><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="team-one-content">
                            <h3>David Parker</h3>
                            <p>PSC (Officer)</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6">
                    <!--Team One Single-->
                    <div class="team-one-single wow fadeInLeft animated" data-wow-delay="200ms"
                        style="visibility: visible; animation-delay: 200ms; animation-name: fadeInLeft;">
                        <div class="team-one-img">
                            <img src="{{ asset('images/team/commeties.png') }}" alt="">
                            <div class="team-one-hover">
                                <div class="team-one-social">
                                    <a href="#"><i class="fab fa-facebook-square"></i></a>
                                    <a href="#"><i class="fab fa-twitter"></i></a>
                                    <a href="#"><i class="fab fa-dribbble"></i></a>
                                    <a href="#"><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="team-one-content">
                            <h3>Ricardo Gomez</h3>
                            <p>PSC (Officer)</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6">
                    <!--Team One Single-->
                    <div class="team-one-single wow fadeInLeft animated" data-wow-delay="300ms"
                        style="visibility: visible; animation-delay: 300ms; animation-name: fadeInLeft;">
                        <div class="team-one-img">
                            <img src="{{ asset('images/team/commeties.png') }}" alt="">
                            <div class="team-one-hover">
                                <div class="team-one-social">
                                    <a href="#"><i class="fab fa-facebook-square"></i></a>
                                    <a href="#"><i class="fab fa-twitter"></i></a>
                                    <a href="#"><i class="fab fa-dribbble"></i></a>
                                    <a href="#"><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="team-one-content">
                            <h3>Peter Sandler</h3>
                            <p>PSC (Officer)</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6">
                    <!--Team One Single-->
                    <div class="team-one-single wow fadeInLeft animated" data-wow-delay="400ms"
                        style="visibility: visible; animation-delay: 400ms; animation-name: fadeInLeft;">
                        <div class="team-one-img">
                            <img src="{{ asset('images/team/commeties.png') }}" alt="">
                            <div class="team-one-hover">
                                <div class="team-one-social">
                                    <a href="#"><i class="fab fa-facebook-square"></i></a>
                                    <a href="#"><i class="fab fa-twitter"></i></a>
                                    <a href="#"><i class="fab fa-dribbble"></i></a>
                                    <a href="#"><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="team-one-content">
                            <h3>James Smith</h3>
                            <p>PSC (Officer)</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6">
                    <!--Team One Single-->
                    <div class="team-one-single wow fadeInLeft animated" data-wow-delay="100ms"
                        style="visibility: visible; animation-delay: 100ms; animation-name: fadeInLeft;">
                        <div class="team-one-img">
                            <img src="{{ asset('images/team/commeties.png') }}" alt="">
                            <div class="team-one-hover">
                                <div class="team-one-social">
                                    <a href="#"><i class="fab fa-facebook-square"></i></a>
                                    <a href="#"><i class="fab fa-twitter"></i></a>
                                    <a href="#"><i class="fab fa-dribbble"></i></a>
                                    <a href="#"><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="team-one-content">
                            <h3>David Parker</h3>
                            <p>PSC (Officer)</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6">
                    <!--Team One Single-->
                    <div class="team-one-single wow fadeInLeft animated" data-wow-delay="200ms"
                        style="visibility: visible; animation-delay: 200ms; animation-name: fadeInLeft;">
                        <div class="team-one-img">
                            <img src="{{ asset('images/team/commeties.png') }}" alt="">
                            <div class="team-one-hover">
                                <div class="team-one-social">
                                    <a href="#"><i class="fab fa-facebook-square"></i></a>
                                    <a href="#"><i class="fab fa-twitter"></i></a>
                                    <a href="#"><i class="fab fa-dribbble"></i></a>
                                    <a href="#"><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="team-one-content">
                            <h3>Ricardo Gomez</h3>
                            <p>Engineer</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6">
                    <!--Team One Single-->
                    <div class="team-one-single wow fadeInLeft animated" data-wow-delay="300ms"
                        style="visibility: visible; animation-delay: 300ms; animation-name: fadeInLeft;">
                        <div class="team-one-img">
                            <img src="{{ asset('images/team/commeties.png') }}" alt="">
                            <div class="team-one-hover">
                                <div class="team-one-social">
                                    <a href="#"><i class="fab fa-facebook-square"></i></a>
                                    <a href="#"><i class="fab fa-twitter"></i></a>
                                    <a href="#"><i class="fab fa-dribbble"></i></a>
                                    <a href="#"><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="team-one-content">
                            <h3>Peter Sandler</h3>
                            <p>PSC (Officer)</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6">
                    <!--Team One Single-->
                    <div class="team-one-single wow fadeInLeft animated" data-wow-delay="400ms"
                        style="visibility: visible; animation-delay: 400ms; animation-name: fadeInLeft;">
                        <div class="team-one-img">
                            <img src="{{ asset('images/team/commeties.png') }}" alt="">
                            <div class="team-one-hover">
                                <div class="team-one-social">
                                    <a href="#"><i class="fab fa-facebook-square"></i></a>
                                    <a href="#"><i class="fab fa-twitter"></i></a>
                                    <a href="#"><i class="fab fa-dribbble"></i></a>
                                    <a href="#"><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="team-one-content">
                            <h3>James Smith</h3>
                            <p>PSC (Officer)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
