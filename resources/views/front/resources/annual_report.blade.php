@extends('layout.master')
@section('content')
    <section class="banner-section wow bg-about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="back-ground">
                        <h2>News</h2>
                        <div class="breadcrumbs text-center wow animate__ animate__fadeInUp animate__delay-1s animated"
                            style="visibility: visible; animation-name: fadeInUp;">
                            <ul>
                                <li><a href="{{ route('home') }}">Home</a></li>
                                <span class="slash"> /</span>
                                <li><a href="#">News</a></li>
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
                            <div class="blog-one-text">
                                <p>
                                    The incumbent will be required to coordinate the executive functions and
                                    support to the Private Sector Commission.Reconciling the accounts and follow up
                                    outstanding payments.
                                </p>
                            </div>
                            <a href="./news-details.html" class="vs-btn1 style5 mt-3" tabindex="0">Read More <i
                                    class="far fa-long-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4">
                    <!--Blog One Single-->
                    <div class="blog-one-single guyana-wrap wow fadeInUp" data-wow-delay="200ms">
                        <div class="blog-one-img  guyana-imgg">
                            <img src="https://psc.gy/wp-content/uploads/2023/04/CET-Ad-400x250.jpg" alt="" />
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
                            <div class="blog-one-text">
                                <p>
                                    The Private Sector Commission (PSC) in collaboration with the Ministry of Foreign
                                    Affairs and International Cooperation (MOFA), the Guyana Revenue Authority (GRA).
                                </p>
                            </div>
                            <a href="./news-details.html" class="vs-btn1 style5 mt-3" tabindex="0">Read More <i
                                    class="far fa-long-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4">
                    <!--Blog One Single-->
                    <div class="blog-one-single guyana-wrap wow fadeInUp" data-wow-delay="300ms">
                        <div class="blog-one-img  guyana-imgg">
                            <img src="https://psc.gy/wp-content/uploads/2023/04/Review-400x250.jpg" alt="" />
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
                            <div class="blog-one-text">
                                <p>
                                    The Private Sector Commission (PSC) in collaboration with the Ministry of Foreign
                                    Affairs and International Cooperation (MOFA), the Guyana Revenue Authority (GRA).
                                </p>
                            </div>
                            <a href="./news-details.html" class="vs-btn1 style5 mt-3" tabindex="0">Read More <i
                                    class="far fa-long-arrow-right"></i></a>
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
                            <div class="blog-one-text">
                                <p>
                                    The Private Sector recognizes that this has been a challenge over many years, and we
                                    stand behind our fishermen in finding an equitable solution to this challenge.


                                </p>
                            </div>
                            <a href="#" class="vs-btn1 style5 mt-3" tabindex="0">Read More <i
                                    class="far fa-long-arrow-right"></i></a>
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
                            <div class="blog-one-text">
                                <p>
                                    A team from the Private Sector Commission engaged Minister of Natural Resources, Hon.
                                    Vickram Bharrat and representatives of the Local Content Secretariat.
                                </p>
                            </div>
                            <a href="./news-details.html" class="vs-btn1 style5 mt-3" tabindex="0">Read More <i
                                    class="far fa-long-arrow-right"></i></a>
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
                            <div class="blog-one-text">
                                <p>
                                    The Bilateral Chamber of Commerce and the Private Sector Commission (PSC) have pledged
                                    to leverage their combined resources to strengthen economic relations.
                                </p>
                            </div>
                            <a href="./news-details.html" class="vs-btn1 style5 mt-3" tabindex="0">Read More <i
                                    class="far fa-long-arrow-right"></i></a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
