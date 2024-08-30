@extends('layout.master')
@section('content')
    <section class="banner-section wow bg-about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="back-ground">
                        <h2>Go Invest</h2>
                        <div class="breadcrumbs text-center wow animate__ animate__fadeInUp animate__delay-1s animated"
                            style="visibility: visible; animation-name: fadeInUp;">
                            <ul>
                                <li><a href="{{ route('home') }}">Home</a></li>
                                <span class="slash"> /</span>
                                <li><a href="#">Go Invest</a></li>
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
            <div class="row">
                <div class="col-xl-6">
                    <div class="about-two-left-content wow slideInLeft animated" data-wow-delay="100ms"
                        style="
                  visibility: visible;
                  animation-delay: 100ms;
                  animation-name: slideInLeft;
                ">
                        <div class="about-two-sec-image">
                            <div class="about-two-sec-image-bg-1"
                                style="
                      background-image: url('{{ asset('/images/about/about-2--pattern-1.png') }}');
                    ">
                            </div>
                            <div class="about-two-sec-image-bg-2"
                                style="
                      background-image: url('{{ asset('/images/about/about-2--pattern-2.png') }}');
                    ">
                            </div>
                            <img src="{{ asset('images/about/about-page-img-1b.png') }}" alt="" />
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="about-two-right-content">
                        <div class="about-two-title">
                            <h4 class="sub-title-shape-left section_title-subheading">
                                Why?
                            </h4>
                            <h2>Invest in Guyana</h2>
                            <p class="about-two-title-text">
                                Guyana, located on the northeastern coast of South America,
                                is an emerging hub for investment with vast potential and
                                opportunities.
                            </p>
                            <p class="about-two-title-text">
                                With its rich natural resources, strategic location, and
                                pro-business government policies, Guyana is poised to become
                                a key player in the global economy.
                            </p>
                            <p class="about-two-title-text">
                                The Guyana Office for Investment (Go-Invest) serves as the
                                gateway for investors looking to capitalize on the country's
                                economic growth and development.
                            </p>
                        </div>
                        <!-- <div class="row">
                      <div class="col-md-6">
                        <div class="about-tow-experience-years">
                          <div class="about-tow-experience-years-icon">
                            <span class="flaticon-check"></span>
                          </div>
                          <div class="about-tow-experience-years-text">
                            <h2>
                              30+ Years of <br />
                              excellence
                            </h2>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="about-tow-experience-years">
                          <div class="about-tow-experience-years-icon">
                            <span class="flaticon-check"></span>
                          </div>
                          <div class="about-tow-experience-years-text">
                            <h2>
                              Operating <br />
                              in 9 Sectors
                            </h2>
                          </div>
                        </div>
                      </div>
                    </div> -->

                        <!-- <div class="about-two-bottom-content">
                      <h3>John Franclin - <span>CEO & Founder</span></h3>
                      <div class="signature">
                        <img src="images/about/signature-1.png" alt="" />
                      </div>
                    </div> -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="blog-one-section">
        <div class="container">
            <div class="thm-section-title text-center">
                <h4 class="sub-title-shape-left section_title-subheading">Key</h4>
                <h2>Investment Sectors</h2>
            </div>

            <div class="row">
                <div class="col-xl-4 col-lg-4">
                    <!--Blog One Single-->
                    <div class="blog-one-single guyana-wrap wow fadeInUp" data-wow-delay="100ms">
                        <div class="blog-one-img guyana-imgg">
                            <img src="{{ asset('images/about/oil-1.png') }}" alt="" />
                        </div>
                        <div class="blog-one-content">
                            <!-- <ul class="blog-classic-meta">
                        <li>
                          <a href="#"><i class="fas fa-clock"></i> 07:10 AM</a>
                        </li>
                        <li>
                          <a href="#"
                            ><i class="fas fa-calendar-alt"></i> Mar 28, 2023</a
                          >
                        </li>
                      </ul> -->
                            <div class="blog-one-title">
                                <h3><a href="#">Oil </a></h3>
                            </div>
                            <div class="blog-one-text">
                                <p>
                                    Guyana has discovered significant oil reserves, attracting
                                    major international oil companies.
                                </p>
                                <p>
                                    Opportunities exist in exploration, production, and
                                    support services.
                                </p>
                            </div>
                            <a href="#" class="vs-btn1 style5 mt-3" tabindex="0">Read More <i
                                    class="far fa-long-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4">
                    <!--Blog One Single-->
                    <div class="blog-one-single guyana-wrap wow fadeInUp" data-wow-delay="100ms">
                        <div class="blog-one-img guyana-imgg">
                            <img src="{{ asset('images/about/oil-2.png') }}" alt="" />
                        </div>
                        <div class="blog-one-content">
                            <!-- <ul class="blog-classic-meta">
                        <li>
                          <a href="#"><i class="fas fa-clock"></i> 07:10 AM</a>
                        </li>
                        <li>
                          <a href="#"
                            ><i class="fas fa-calendar-alt"></i> Mar 28, 2023</a
                          >
                        </li>
                      </ul> -->
                            <div class="blog-one-title">
                                <h3><a href="#"> Gas</a></h3>
                            </div>
                            <div class="blog-one-text">
                                <p>
                                    Guyana has discovered significant oil reserves, attracting
                                    major international oil companies.
                                </p>
                                <p>
                                    Opportunities exist in exploration, production, and
                                    support services.
                                </p>
                            </div>
                            <a href="#" class="vs-btn1 style5 mt-3" tabindex="0">Read More <i
                                    class="far fa-long-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4">
                    <!--Blog One Single-->
                    <div class="blog-one-single guyana-wrap wow fadeInUp" data-wow-delay="200ms">
                        <div class="blog-one-img guyana-imgg">
                            <img src="{{ asset('images/about/oil-3.png') }}" alt="" />
                        </div>
                        <div class="blog-one-content">
                            <!-- <ul class="blog-classic-meta">
                        <li>
                          <a href="#"><i class="fas fa-clock"></i> 09:10 AM</a>
                        </li>
                        <li>
                          <a href="#"
                            ><i class="fas fa-calendar-alt"></i> Mar 28, 2023</a
                          >
                        </li>
                      </ul> -->
                            <div class="blog-one-title">
                                <h3>
                                    <a href="#">Agriculture</a>
                                </h3>
                            </div>
                            <div class="blog-one-text">
                                <p>
                                    Fertile lands and a favorable climate make Guyana ideal
                                    for agriculture.
                                </p>
                                <p>
                                    Investment opportunities in rice, sugar, fruits,
                                    vegetables, and agro-processing.
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
                        <div class="blog-one-img guyana-imgg">
                            <img src="{{ asset('images/about/oil-4.png') }}" alt="" />
                        </div>
                        <div class="blog-one-content">
                            <!-- <ul class="blog-classic-meta">
                        <li>
                          <a href="#"><i class="fas fa-clock"></i> 10:10 AM</a>
                        </li>
                        <li>
                          <a href="#"
                            ><i class="fas fa-calendar-alt"></i>Jan 25, 2024</a
                          >
                        </li>
                      </ul> -->
                            <div class="blog-one-title">
                                <h3>
                                    <a href="#">Mining</a>
                                </h3>
                            </div>
                            <div class="blog-one-text">
                                <p>Rich in minerals like gold, bauxite, and diamonds.</p>
                                <p>
                                    Potential for investment in extraction, processing, and
                                    value-added <br />
                                    services.
                                </p>
                            </div>
                            <a href="#" class="vs-btn1 style5 mt-3" tabindex="0">Read More <i
                                    class="far fa-long-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4">
                    <!--Blog One Single-->
                    <div class="blog-one-single guyana-wrap wow fadeInUp" data-wow-delay="100ms">
                        <div class="blog-one-img guyana-imgg">
                            <img src="{{ asset('images/about/oil-5.png') }}" alt="" />
                        </div>
                        <div class="blog-one-content">
                            <!-- <ul class="blog-classic-meta">
                        <li>
                          <a href="#"><i class="fas fa-clock"></i> 07:10 AM</a>
                        </li>
                        <li>
                          <a href="#"
                            ><i class="fas fa-calendar-alt"></i> Mar 28, 2023</a
                          >
                        </li>
                      </ul> -->
                            <div class="blog-one-title">
                                <h3><a href="#">Tourism</a></h3>
                            </div>
                            <div class="blog-one-text">
                                <p>
                                    Guyana’s pristine rainforests, waterfalls, and diverse
                                    wildlife offer unique tourism opportunities.
                                </p>
                                <p>
                                    Investment opportunities in eco-tourism, hotels, resorts,
                                    and adventure tourism.
                                </p>
                            </div>
                            <a href="#" class="vs-btn1 style5 mt-3" tabindex="0">Read More <i
                                    class="far fa-long-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4">
                    <!--Blog One Single-->
                    <div class="blog-one-single guyana-wrap wow fadeInUp" data-wow-delay="200ms">
                        <div class="blog-one-img guyana-imgg">
                            <img src="{{ asset('images/about/oil-6.png') }}" alt="" />
                        </div>
                        <div class="blog-one-content">
                            <!-- <ul class="blog-classic-meta">
                        <li>
                          <a href="#"><i class="fas fa-clock"></i> 09:10 AM</a>
                        </li>
                        <li>
                          <a href="#"
                            ><i class="fas fa-calendar-alt"></i> Mar 28, 2023</a
                          >
                        </li>
                      </ul> -->
                            <div class="blog-one-title">
                                <h3>
                                    <a href="#">Infrastructure</a>
                                </h3>
                            </div>
                            <div class="blog-one-text">
                                <p>Development of roads, bridges, ports, and airports.</p>
                                <p>
                                    Public-private partnerships in urban development and
                                    renewable energy <br />
                                    projects.
                                </p>
                            </div>
                            <a href="#" class="vs-btn1 style5 mt-3" tabindex="0">Read More <i
                                    class="far fa-long-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End Blog One Section -->
@endsection
