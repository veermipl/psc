@extends('layout.master')

@section('content')
    <!-- <section class="why-choose-two-section">
        <div class="container">
            <div class="thm-section-title text-center">
                <h4 class="sub-title-shape-left section_title-subheading">
                    Resources
                </h4>
                <h2>Business Readiness Desk</h2>
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
                <h2>Business Readiness Desk</h2>
                <div
                  class="breadcrumbs text-center wow animate__ animate__fadeInUp animate__delay-1s animated"
                  style="visibility: visible; animation-name: fadeInUp">
                  <ul>
                    <li><a href="{{url('/')}}">Home</a></li>
                    <span class="slash"> /</span>
                    <li><a href="#">Business Readiness Desk</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

    <section class="about-tow-section about-page">
        <div class="container">
          <div class="row">
            <div class="col-xl-6">
              <div
                class="about-two-left-content wow slideInLeft animated"
                data-wow-delay="100ms"
                style="
                  visibility: visible;
                  animation-delay: 100ms;
                  animation-name: slideInLeft;
                ">
                <div class="about-two-sec-image">
                  <div
                    class="about-two-sec-image-bg-1"
                    style="
                      background-image: url('{{asset('/images/about/about-2--pattern-1.png')}}');
                    "></div>
                  <div
                    class="about-two-sec-image-bg-2"
                    style="
                      background-image: url('{{asset('/images/about/about-2--pattern-2.png')}}');
                    "></div>
                  <img src="{{asset('images/about/about-page-img-1a.png')}}" alt="" />
                </div>
              </div>
            </div>
            <div class="col-xl-6">
              <div class="about-two-right-content">
                <div class="about-two-title">
                  <h4 class="sub-title-shape-left section_title-subheading">
                    Certificate
                  </h4>
                  <h2>of Origin</h2>
                  <p class="about-two-title-text">
                    A Certificate of Origin (COO) is a crucial document in
                    international trade that certifies the country where a
                    product was manufactured or processed. It is required by
                    customs authorities in the importing country to determine
                    the appropriate tariffs, duties, and eligibility for
                    preferential trade agreements.
                  </p>
                  <h5 class="pt-3 pb-2">
                    <b>Types of Certificates of Origin</b>
                  </h5>
                  <p>
                    <b class="text-dark">Preferential Certificate of Origin</b>

                    Used for goods eligible for reduced tariffs under trade
                    agreements. Examples include the CARICOM Certificate of
                    Origin and the EUR1 Certificate.
                  </p>
                  <p>
                    <b class="text-dark">Non-Preferential Certificate of Origin</b >
                    Used for goods that do not qualify for any preferential
                    treatment. Provides standard information required by customs
                    authorities worldwide.
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

      <section class="features-two-section">
        <div class="container">
          <div class="thm-section-title text-center">
            <h4 class="sub-title-shape-left section_title-subheading">
              Certificate of
            </h4>
            <h2>Origin</h2>
          </div>
          <div class="row">
            <div class="col-lg-4 col-md-6">
              <!--Features One Sec Single-->
              <div
                class="features-two-sec-single wow fadeInUp h-100 animated active"
                data-wow-delay="300ms"
                style="
                  visibility: visible;
                  animation-delay: 300ms;
                  animation-name: fadeInUp;
                ">
                <div class="features-two-sec-icon">
                  <img src="{{asset('images/about/custom-clearance.png')}}" alt="" />
                  <!-- <span class="flaticon-robotic"></span> -->
                </div>
                <h3>Customs Clearance</h3>
                <p>
                  The COO helps customs authorities verify the origin of the
                  goods and apply the correct tariff rates.
                </p>
                <p>
                  It is a necessary document for the smooth clearance of goods
                  at international borders.
                </p>

                <a href="#" class="vs-btn style3 mt-4" tabindex="0"
                  >Read More<i class="far fa-long-arrow-right"></i
                ></a>
              </div>
            </div>
            <div class="col-lg-4 col-md-6">
              <!--Features One Sec Single-->
              <div
                class="features-two-sec-single wow fadeInUp h-100 animated"
                data-wow-delay="600ms"
                style="
                  visibility: visible;
                  animation-delay: 600ms;
                  animation-name: fadeInUp;
                ">
                <div class="features-two-sec-icon">
                  <img src="{{asset('images/about/custom-clearance-2.png')}}" alt="" />
                  <!-- <span class="flaticon-robotic"></span> -->
                </div>
                <h3>Preferential Trade Agreements</h3>
                <p>
                  The COO enables exporters to benefit from reduced tariffs
                  under various trade agreements.
                </p>
                <p>
                  It ensures compliance with the rules of origin criteria set
                  out in these agreements.
                </p>
                <a href="#" class="vs-btn style3 mt-4" tabindex="0"
                  >Read More<i class="far fa-long-arrow-right"></i
                ></a>
              </div>
            </div>
            <div class="col-lg-4 col-md-6">
              <!--Features One Sec Single-->
              <div
                class="features-two-sec-single wow fadeInUp h-100 animated"
                data-wow-delay="900ms"
                style="
                  visibility: visible;
                  animation-delay: 900ms;
                  animation-name: fadeInUp;
                ">
                <div class="features-two-sec-icon">
                  <img src="{{asset('images/about/custom-clearance-3.png')}}" alt="" />
                  <!-- <span class="flaticon-robotic"></span> -->
                </div>
                <h3>Market Access</h3>
                <p>
                  Facilitates easier access to international markets by
                  providing proof of origin.
                </p>
                <p>
                  Enhances the credibility and legitimacy of exported products.
                </p>
                <a href="#" class="vs-btn style3 mt-4" tabindex="0"
                  >Read More<i class="far fa-long-arrow-right"></i
                ></a>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="why-choose-two-section">
        <div class="container">
          <div class="thm-section-title text-center">
            <h4 class="sub-title-shape-left section_title-subheading">
              Benefits of a
            </h4>
            <h2>Certificate of Origin</h2>
          </div>
          <div class="row">
            <div class="col-md-6 col-lg-3 py-2">
              <div class="widget h-100">
                <h3 class="widget_title">Cost Savings</h3>
                <div class="recent-post-wrap">
                  <div class="recent-post">
                    <!-- <div class="media-img"><a href="#"><img src="assets/img/blog/recent-post-1-1.jpg" alt="Blog Image"></a></div> -->
                    <div class="media-body">
                      <div class="recent-post-meta">
                        <ul class="table-list">
                          <li>
                            <p>
                              Enables reduced import duties under preferential
                              trade agreements.
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
            <div class="col-md-6 col-lg-3 py-2">
              <div class="widget h-100">
                <h3 class="widget_title">Compliance</h3>
                <div class="recent-post-wrap">
                  <div class="recent-post">
                    <!-- <div class="media-img"><a href="#"><img src="assets/img/blog/recent-post-1-1.jpg" alt="Blog Image"></a></div> -->
                    <div class="media-body">
                      <div class="recent-post-meta">
                        <ul class="table-list">
                          <li>
                            <p>
                              Ensures adherence to international trade
                              regulations and standards.
                            </p>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-lg-3 py-2">
              <div class="widget h-100">
                <h3 class="widget_title">Credibility</h3>
                <div class="recent-post-wrap">
                  <div class="recent-post">
                    <!-- <div class="media-img"><a href="#"><img src="assets/img/blog/recent-post-1-1.jpg" alt="Blog Image"></a></div> -->
                    <div class="media-body">
                      <div class="recent-post-meta">
                        <ul class="table-list">
                          <li>
                            <p>
                              Enhances the reputation of the exporter by
                              providing authentic proof of origin.
                            </p>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-lg-3 py-2">
              <div class="widget h-100">
                <h3 class="widget_title">Efficiency</h3>
                <div class="recent-post-wrap">
                  <div class="recent-post">
                    <!-- <div class="media-img"><a href="#"><img src="assets/img/blog/recent-post-1-1.jpg" alt="Blog Image"></a></div> -->
                    <div class="media-body">
                      <div class="recent-post-meta">
                        <ul class="table-list">
                          <li>
                            <p>
                              Facilitates faster customs clearance and reduces
                              shipping delays.
                            </p>
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



@endsection
