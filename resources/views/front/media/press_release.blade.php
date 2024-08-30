@extends('layout.master')

@section('content')
    <!-- <section class="why-choose-two-section">
            <div class="container">
                <div class="thm-section-title text-center">
                    <h4 class="sub-title-shape-left section_title-subheading">
                        Media Center
                    </h4>
                    <h2>Press Release</h2>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque atque, libero ut repudiandae quas voluptatem. Quo ut natus sapiente eos sunt, laborum eius, in, atque dolore quod harum odit amet.
                    </div>
                </div>
            </div>
        </section> -->

    <!-- End Main Header -->
    <section class="banner-section wow bg-about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="back-ground">
                        <h2>Press Release</h2>
                        <div class="breadcrumbs text-center wow animate__ animate__fadeInUp animate__delay-1s animated"
                            style="visibility: visible; animation-name: fadeInUp;">
                            <ul>
                                <li><a href="{{ route('home') }}">Home</a></li>
                                <span class="slash"> /</span>
                                <li><a href="#">Press Release</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--Start Blog One Section -->
    <section class="blog-one-section" style="background-color: #fff;">
        <div class="container">

            <div class="row">
                <div class="col-lg-9">
                    <div class="row">
                        <div class="col-xl-4 col-lg-4">
                            <!--Blog One Single-->
                            <div class="blog-one-single guyana-wrap wow fadeInUp" data-wow-delay="100ms">
                                <div class="blog-one-img  guyana-imgg">
                                    <img src="{{ asset('images/Blog/LU3.jpg') }}" alt="" />
                                </div>
                                <div class="blog-one-content">
                                    <ul class="blog-classic-meta">
                                        <li>
                                            <a href="#"><i class="fas fa-clock"></i> 07:10 AM</a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="fas fa-calendar-alt"></i> Mar 28, 2023</a>
                                        </li>
                                    </ul>
                                    <div class="blog-one-title hei-65">
                                        <h3><a href="#">VACANCY – EXECUTIVE ASSISTANT</a></h3>
                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4">
                            <!--Blog One Single-->
                            <div class="blog-one-single guyana-wrap wow fadeInUp" data-wow-delay="200ms">
                                <div class="blog-one-img  guyana-imgg">
                                    <img src="https://psc.gy/wp-content/uploads/2023/04/CET-Ad-400x250.jpg"
                                        alt="" />
                                </div>
                                <div class="blog-one-content">
                                    <ul class="blog-classic-meta">
                                        <li>
                                            <a href="#"><i class="fas fa-clock"></i> 09:10 AM</a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="fas fa-calendar-alt"></i> Mar 28, 2023</a>
                                        </li>
                                    </ul>
                                    <div class="blog-one-title hei-65">
                                        <h3>
                                            <a href="#">VIRTUAL SESSION ON REVIEW OF CET & RoO</a>
                                        </h3>
                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4">
                            <!--Blog One Single-->
                            <div class="blog-one-single guyana-wrap wow fadeInUp" data-wow-delay="300ms">
                                <div class="blog-one-img  guyana-imgg">
                                    <img src="https://psc.gy/wp-content/uploads/2023/04/Review-400x250.jpg"
                                        alt="" />
                                </div>
                                <div class="blog-one-content">
                                    <ul class="blog-classic-meta">
                                        <li>
                                            <a href="#"><i class="fas fa-clock"></i> 10:10 AM</a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="fas fa-calendar-alt"></i>Jan 25, 2024</a>
                                        </li>
                                    </ul>
                                    <div class="blog-one-title hei-65">
                                        <h3>
                                            <a href="#">VIRTUAL REVIEW</a>
                                        </h3>
                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4">
                            <!--Blog One Single-->
                            <div class="blog-one-single guyana-wrap wow fadeInUp" data-wow-delay="300ms">
                                <div class="blog-one-img  guyana-imgg">
                                    <img src="https://psc.gy/wp-content/uploads/2023/04/Blog-Thumbnail-400x250.jpg"
                                        alt="" />
                                </div>
                                <div class="blog-one-content">
                                    <ul class="blog-classic-meta">
                                        <li>
                                            <a href="#"><i class="fas fa-clock"></i> 10:10 AM</a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="fas fa-calendar-alt"></i>Jan 25, 2024</a>
                                        </li>
                                    </ul>
                                    <div class="blog-one-title hei-65">
                                        <h3>
                                            <a href="#">PSC in solidarity with fisherfolks in Corentyne</a>
                                        </h3>
                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4">
                            <!--Blog One Single-->
                            <div class="blog-one-single guyana-wrap wow fadeInUp" data-wow-delay="300ms">
                                <div class="blog-one-img  guyana-imgg">
                                    <img src="https://psc.gy/wp-content/uploads/2023/04/LC-400x250.jpg" alt="" />
                                </div>
                                <div class="blog-one-content">
                                    <ul class="blog-classic-meta">
                                        <li>
                                            <a href="#"><i class="fas fa-clock"></i> 10:10 AM</a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="fas fa-calendar-alt"></i>Jan 25, 2024</a>
                                        </li>
                                    </ul>
                                    <div class="blog-one-title hei-65">
                                        <h3>
                                            <a href="#">MNR and PSC aligned on key local content issues</a>
                                        </h3>
                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4">
                            <!--Blog One Single-->
                            <div class="blog-one-single guyana-wrap wow fadeInUp" data-wow-delay="300ms">
                                <div class="blog-one-img  guyana-imgg">
                                    <img src="https://psc.gy/wp-content/uploads/2023/04/psc3-400x250.jpg" alt="" />
                                </div>
                                <div class="blog-one-content">
                                    <ul class="blog-classic-meta">
                                        <li>
                                            <a href="#"><i class="fas fa-clock"></i> 10:10 AM</a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="fas fa-calendar-alt"></i>Jan 25, 2024</a>
                                        </li>
                                    </ul>
                                    <div class="blog-one-title hei-65">
                                        <h3>
                                            <a href="#">H.E. Minister Vickram Bharrat Witnesses MoU Signing</a>
                                        </h3>
                                    </div>


                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-xl-3 col-lg-5">
                    <div class="sidebar">
                        <div class="sidebar-single sidebar-search p-3">
                            <h3 class="sidebar-title">Search</h3>
                            <form action="#" class="sidebar-search-form">
                                <input type="search" placeholder="Search">
                                <button type="submit"><i class="fa fa-search"></i></button>
                            </form>
                        </div>

                        <div class="sidebar-single sidebar-latest-news p-3">
                            <h3 class="sidebar-title">Recent Press Release</h3>
                            <ul class="sidebar-latest-news-list">
                                <li>
                                    <div class="sidebar-latest-news-image">
                                        <img src="https://psc.gy/wp-content/uploads/2023/04/LC-400x250.jpg"
                                            alt="">
                                    </div>
                                    <div class="sidebar-latest-news-content">
                                        <h3><a href="#">VACANCY – EXECUTIVE ASSISTANT</a></h3>
                                        <p>02 May, 2020</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="sidebar-latest-news-image">
                                        <img src="https://psc.gy/wp-content/uploads/2023/04/LC-400x250.jpg"
                                            alt="">
                                    </div>
                                    <div class="sidebar-latest-news-content">
                                        <h3><a href="#">VIRTUAL SESSION ON REVIEW OF CET & RoO</a></h3>
                                        <p>02 May, 2020</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="sidebar-latest-news-image">
                                        <img src="https://psc.gy/wp-content/uploads/2023/04/LC-400x250.jpg"
                                            alt="">
                                    </div>
                                    <div class="sidebar-latest-news-content">
                                        <h3><a href="#">VIRTUAL REVIEW</a></h3>
                                        <p>02 May, 2020</p>
                                    </div>
                                </li>
                            </ul>
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End Blog One Section -->
@endsection
