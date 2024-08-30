@extends('layout.master')

@section('content')
    <section class="banner-section wow bg-about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="back-ground">
                        <h2>Procurement Process in Guyana</h2>
                        <div class="breadcrumbs text-center wow animate__ animate__fadeInUp animate__delay-1s animated"
                            style="visibility: visible; animation-name: fadeInUp;">
                            <ul>
                                <li><a href="{{ route('home') }}">Home</a></li>
                                <span class="slash"> /</span>
                                <li><a href="#">Procurement Process in Guyana</a></li>
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
                            <img src="{{ asset('images/about/about-page-img-1d.png') }}" alt="" />
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="about-two-right-content">
                        <div class="about-two-title">
                            <h4 class="sub-title-shape-left section_title-subheading">
                                Overview
                            </h4>
                            <h2>Procurement Process in Guyana</h2>
                            <p class="about-two-title-text">
                                The procurement process in Guyana is governed by the
                                Procurement Act, which establishes the framework for the
                                acquisition of goods, services, and works by public sector
                                entities. The process aims to ensure transparency, fairness,
                                and efficiency in the use of public funds, fostering a
                                competitive environment for businesses.
                            </p>
                            <h5 class="pt-3"><b>Key Principles</b></h5>
                            <p>
                                <b> 1 Transparency:</b> All procurement activities are
                                conducted in an open manner, providing equal opportunity for
                                all eligible suppliers and contractors.
                            </p>
                            <p>
                                <b>2 Fairness:</b> The process ensures non-discrimination
                                and equitable treatment of all participants.
                            </p>
                            <!-- <p>
                        <b>3 FEfficiency:</b> Procurement procedures are designed to
                        achieve the best value for money, balancing cost, quality,
                        and timeliness.
                      </p>
                      <p>
                        <b>4 Accountability:</b> Public officials involved in
                        procurement are accountable for their decisions and actions.
                      </p> -->
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
                <h4 class="sub-title-shape-left section_title-subheading">
                    Procurement
                </h4>
                <h2>Methods</h2>
            </div>

            <div class="row">
                <div class="col-xl-4 col-lg-4">
                    <!--Blog One Single-->
                    <div class="blog-one-single guyana-wrap wow fadeInUp" data-wow-delay="100ms">
                        <div class="blog-one-img guyana-imgg">
                            <img src="{{ asset('images/about/oil-9.png') }}" alt="" />
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
                                <h3><a href="#">Open Tendering</a></h3>
                            </div>
                            <div class="blog-one-text">
                                <p>
                                    The most common method, involving public invitations to
                                    bid.
                                </p>
                                <p>Ensures maximum competition and transparency.</p>
                                <p>
                                    Advertisements are placed in local and international
                                    media.
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
                            <img src="{{ asset('images/about/oil-10.png') }}" alt="" />
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
                                <h3><a href="#"> Restricted Tendering</a></h3>
                            </div>
                            <div class="blog-one-text">
                                <p>Used when the number of suppliers is limited.</p>
                                <p>
                                    Invitations are sent to a pre-selected list of qualified
                                    suppliers.
                                </p>
                                <p>Ensures quality and specialization in procurement.</p>
                            </div>
                            <br />
                            <a href="#" class="vs-btn1 style5 mt-3" tabindex="0">Read More <i
                                    class="far fa-long-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4">
                    <!--Blog One Single-->
                    <div class="blog-one-single guyana-wrap wow fadeInUp" data-wow-delay="200ms">
                        <div class="blog-one-img guyana-imgg">
                            <img src="{{ asset('images/about/oil-11.png') }}" alt="" />
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
                                    <a href="#">Request for Proposals (RFP)</a>
                                </h3>
                            </div>
                            <div class="blog-one-text">
                                <p>
                                    Financing renewable energy projects such as solar, wind,
                                    and hydroelectric power.
                                </p>
                                <p>
                                    Advancing energy efficiency and sustainability
                                    initiatives.
                                </p>
                            </div>
                            <br />
                            <br />
                            <a href="#" class="vs-btn1 style5 mt-3" tabindex="0">Read More <i
                                    class="far fa-long-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="why-choose-two-section">
        <div class="container">
            <div class="thm-section-title text-center">
                <h4 class="sub-title-shape-left section_title-subheading">
                    Services
                </h4>
                <h2>Procurement Procedures</h2>
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-4 py-2">
                    <div class="widget h-100">
                        <h3 class="widget_title">Planning and Preparation</h3>
                        <div class="recent-post-wrap">
                            <div class="recent-post">
                                <!-- <div class="media-img"><a href="#"><img src="assets/img/blog/recent-post-1-1.jpg" alt="Blog Image"></a></div> -->
                                <div class="media-body">
                                    <div class="recent-post-meta">
                                        <ul class="table-list">
                                            <li>
                                                <p>Identifying needs and defining requirements.</p>
                                            </li>
                                            <li>
                                                <p>Preparing procurement plans and budgets.</p>
                                            </li>
                                            <li>
                                                <p>
                                                    Developing specifications and terms of reference.
                                                </p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <a href="#" class="vs-btn style5 mt-4" tabindex="0"
                      >Read More<i class="far fa-long-arrow-right"></i
                    ></a> -->
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 py-2">
                    <div class="widget h-100">
                        <h3 class="widget_title">Solicitation and Advertisement</h3>
                        <div class="recent-post-wrap">
                            <div class="recent-post">
                                <!-- <div class="media-img"><a href="#"><img src="assets/img/blog/recent-post-1-1.jpg" alt="Blog Image"></a></div> -->
                                <div class="media-body">
                                    <div class="recent-post-meta">
                                        <ul class="table-list">
                                            <li>
                                                <p>
                                                    Preparing and publishing bid invitations or RFPs.
                                                </p>
                                            </li>
                                            <li>
                                                <p>
                                                    Providing clear instructions and deadlines for
                                                    submission.
                                                </p>
                                            </li>
                                            <li>
                                                <p>
                                                    Hosting pre-bid meetings or site visits if
                                                    necessary.
                                                </p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 py-2">
                    <div class="widget h-100">
                        <h3 class="widget_title">Submission and Opening of Bids</h3>
                        <div class="recent-post-wrap">
                            <div class="recent-post">
                                <!-- <div class="media-img"><a href="#"><img src="assets/img/blog/recent-post-1-1.jpg" alt="Blog Image"></a></div> -->
                                <div class="media-body">
                                    <div class="recent-post-meta">
                                        <ul class="table-list">
                                            <li>
                                                <p>Receiving bids by the specified deadline.</p>
                                            </li>
                                            <li>
                                                <p>
                                                    Opening bids in a public session to ensure
                                                    transparency.
                                                </p>
                                            </li>
                                            <li>
                                                <p>Recording and safeguarding all submissions.</p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End Blog -->
@endsection
