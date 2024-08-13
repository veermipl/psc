@extends('layout.master')

@section('content')
<section class="banner-section wow bg-about">
        <div class="container">
         <div class="row">
             <div class="col-lg-12">
                 <div class="back-ground">
                     <h2>CARICOM CET</h2>
                     <div class="breadcrumbs text-center wow animate__ animate__fadeInUp animate__delay-1s animated" style="visibility: visible; animation-name: fadeInUp;">
                         <ul>
                             <li><a href="{{url('/')}}">Home</a></li>
                              <span class="slash">   /</span>
                             <li><a href="#">CARICOM CET</a></li>
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
                  <img src="{{asset('images/about/about-page-img-1f.png')}}" alt="" />
                </div>
              </div>
            </div>
            <div class="col-xl-6">
              <div class="about-two-right-content">
                <div class="about-two-title">
                  <h4 class="sub-title-shape-left section_title-subheading">
                    Describe the
                  </h4>
                  <h2>Caricom Cet</h2>
                  <p class="about-two-title-text">
                    The CARICOM Common External Tariff (CET) is a unified tariff
                    system established by the Caribbean Community (CARICOM) to
                    regulate imports into the region from non-member countries.
                  </p>
                  <p>
                    The CET is designed to protect local industries, promote
                    regional integration, and ensure equitable trade practices
                    across CARICOM member states.
                  </p>
                  <h5 class="pb-2">
                    <b>Benefits of the Caricom Cet</b>
                  </h5>
                  <p>
                    <b class="text-dark">Economic Stability</b>

                    By protecting local industries, the CET contributes to
                    economic stability and job creation within the region.
                  </p>
                  <p>
                    <b class="text-dark">Market Access</b>

                    The CET ensures that CARICOM-produced goods have
                    preferential access to regional markets, fostering economic
                    growth.
                  </p>
                  <p>
                    <b class="text-dark">Simplified Trade</b>

                    A unified tariff system reduces complexity in trade
                    negotiations and facilitates easier movement of goods across
                    member states.
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
              Purpose
            </h4>
            <h2>And Objectives</h2>
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
                  <img src="{{asset('images/about/custom-clearance-4.png')}}" alt="" />
                  <!-- <span class="flaticon-robotic"></span> -->
                </div>
                <h3>Protection of Local Industries</h3>
                <p>
                  The CET provides a structured approach to shielding domestic
                  industries from external competition.
                </p>
                <p>
                  By imposing uniform tariff rates on imported goods, the CET
                  helps maintain competitive pricing for locally produced goods.
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
                  <img src="{{asset('images/about/custom-clearance-5.png')}}" alt="" />
                  <!-- <span class="flaticon-robotic"></span> -->
                </div>
                <h3>Regional Economic Integration</h3>
                <p>
                  The CET fosters deeper economic ties among CARICOM member
                  states.
                </p>
                <p>
                  It encourages intra-regional trade by establishing a common
                  framework for external trade policies.
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
                  <img src="{{asset('images/about/custom-clearance-6.png')}}" alt="" />
                  <!-- <span class="flaticon-robotic"></span> -->
                </div>
                <h3>Harmonized Trade Policies</h3>
                <p>
                  The CET ensures that all member states apply consistent tariff
                  rates on imports from outside the region.
                </p>
                <p>
                  It simplifies trade negotiations and agreements with external
                  partners.
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
              How the
            </h4>
            <h2>CARICOM CET Works</h2>
          </div>
          <div class="row">
            <div class="col-md-6 col-lg-4 py-2">
              <div class="widget h-100">
                <h3 class="widget_title">Tariff Classifications</h3>
                <div class="recent-post-wrap">
                  <div class="recent-post">
                    <!-- <div class="media-img"><a href="#"><img src="assets/img/blog/recent-post-1-1.jpg" alt="Blog Image"></a></div> -->
                    <div class="media-body">
                      <div class="recent-post-meta">
                        <ul class="table-list">
                          <li>
                            <p>
                              Goods are categorized under specific tariff
                              headings, each with a corresponding duty rate.
                            </p>
                            <p>
                              Tariff rates vary based on the type of product,
                              with higher rates typically applied to goods that
                              compete directly with local industries.
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
                <h3 class="widget_title">Exemptions and Suspensions</h3>
                <div class="recent-post-wrap">
                  <div class="recent-post">
                    <!-- <div class="media-img"><a href="#"><img src="assets/img/blog/recent-post-1-1.jpg" alt="Blog Image"></a></div> -->
                    <div class="media-body">
                      <div class="recent-post-meta">
                        <ul class="table-list">
                          <li>
                            <p>
                              Certain goods may qualify for tariff exemptions or
                              reductions under specific conditions, such as raw
                              materials or goods critical to public health and
                              safety.
                            </p>
                            <p>
                              Member states can apply for temporary suspensions
                              of the CET on certain imports to address supply
                              shortages or other economic challenges.
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
                <h3 class="widget_title">Revenue Collection</h3>
                <div class="recent-post-wrap">
                  <div class="recent-post">
                    <!-- <div class="media-img"><a href="#"><img src="assets/img/blog/recent-post-1-1.jpg" alt="Blog Image"></a></div> -->
                    <div class="media-body">
                      <div class="recent-post-meta">
                        <ul class="table-list">
                          <li>
                            <p>
                              Tariffs collected under the CET contribute to
                              national revenue and support public sector
                              development.
                            </p>
                            <p>
                              Customs authorities in each member state are
                              responsible for enforcing and collecting CET
                              tariffs on imported goods.
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
      <!--End Blog One Section -->
      
@endsection
