@extends('layout.master')

@section('content')
    <section class="banner-section wow bg-about">
        <div class="container">
         <div class="row">
             <div class="col-lg-12">
                 <div class="back-ground">
                     <h2>Certificate of Origins</h2>
                     <div class="breadcrumbs text-center wow animate__ animate__fadeInUp animate__delay-1s animated" style="visibility: visible; animation-name: fadeInUp;">
                         <ul>
                             <li><a href="{{url('/')}}">Home</a></li>
                              <span class="slash">   /</span>
                             <li><a href="#">Certificate of Origins</a></li>
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
                  <img src="{{ asset('storage/'.@$origin->image) }}" alt="" />
                </div>
              </div>
            </div>
            <div class="col-xl-6">
              <div class="about-two-right-content">
                <div class="about-two-title">
                  <h4 class="sub-title-shape-left section_title-subheading">
                    Certificate
                  </h4>
                  <h2>{{@$origin->title}}</h2>
                      {!! @$origin->contant !!}

                  <!-- <p class="about-two-title-text">
                    A Certificate of Origin (COO) is an essential document in
                    international trade that certifies the country in which a
                    product was manufactured or processed. This document is
                    crucial for customs clearance and trade compliance, ensuring
                    that goods meet the specific requirements of the importing
                    country.
                  </p>
                  <h5 class="pt-3"><b>Customs Clearance</b></h5>
                  <p>
                    The COO helps customs authorities determine the duty rates
                    and eligibility for preferential trade agreements.
                  </p>
                  <p>
                    It is a key document required for the importation process.
                  </p>
                  <h5 class="pt-3"><b>Trade Agreements</b></h5>
                  <p>
                    The COO allows businesses to benefit from trade agreements
                    that reduce or eliminate tariffs on goods from certain
                    countries.
                  </p> -->
                  <!-- <p>
                    It ensures compliance with rules of origin under various
                    trade agreements.
                  </p>
                  <h5 class="pt-3"><b>Market Access</b></h5>
                  <p>
                    Facilitates smoother access to international markets by
                    providing proof of origin.
                  </p>
                  <p>
                    Enhances the credibility and legitimacy of the exported
                    products.
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
              Types of
            </h4>
            <h2>Certificates of Origin</h2>
          </div>

          <div class="row">
            @if(isset($types) && count(@$types) > 0)

              @foreach(@types as $type)
                  <div class="col-xl-6 col-lg-6">
                  
                    <div
                      class="blog-one-single guyana-wrap wow fadeInUp"
                      data-wow-delay="100ms">
                      <div class="blog-one-img guyana-imgg">
                        <img src="{{asset('storage/'.$type->image) }}" alt="" />
                      </div>
                      <div class="blog-one-content">
                        <div class="blog-one-title">
                          <h3><a href="#">{{$type->title}}</a></h3>
                        </div>
                        <div class="blog-one-text">

                        {!! $type->contant !!}
                         
                        </div>
                        <a href="#" class="vs-btn1 style5 mt-3" tabindex="0"
                          >Read More <i class="far fa-long-arrow-right"></i
                        ></a>
                      </div>
                    </div>
                  </div>
              @endforeach

            @endif


          </div>
        </div>
      </section>

      <section class="why-choose-two-section">
        <div class="container">
          <div class="thm-section-title text-center">
            <h4 class="sub-title-shape-left section_title-subheading">
              Certificate
            </h4>
            <h2>of Origin</h2>
          </div>
          <div class="row">

        @if(isset($certificate) && count(@$certificate))

          @foreach($certificate as $cert)
            <div class="col-md-6 col-lg-4 py-2">
              <div class="widget h-100">
                <h3 class="widget_title">{{$cert->title}}</h3>
                <div class="recent-post-wrap">
                  <div class="recent-post">
                    <div class="media-body">
                      <div class="recent-post-meta">
                        <ul class="table-list">

                        {!! $cert->contant !!}

                          <!-- <li>
                            <p>Identifying needs and defining requirements.</p>
                          </li>
                          <li>
                            <p>Preparing procurement plans and budgets.</p>
                          </li>
                          <li>
                            <p>
                              Developing specifications and terms of reference.
                            </p>
                          </li> -->

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

          @endforeach
        @endif


          </div>
        </div>
      </section>
   

@endsection
