@extends('layout.master')

@section('content')
    

<section class="banner-section wow bg-about">
        <div class="container">
         <div class="row">
             <div class="col-lg-12">
                 <div class="back-ground">
                     <h2>IDB Invest</h2>
                     <div class="breadcrumbs text-center wow animate__ animate__fadeInUp animate__delay-1s animated" style="visibility: visible; animation-name: fadeInUp;">
                         <ul>
                             <li><a href="{{url('/')}}">Home</a></li>
                              <span class="slash">   /</span>
                             <li><a href="#">IDB Invest</a></li>
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
                  <img src="{{ asset('storage/'.@$invest->image) }}" alt="" />
                </div>
              </div>
            </div>
            <div class="col-xl-6">
              <div class="about-two-right-content">
                <div class="about-two-title">
                  <h4 class="sub-title-shape-left section_title-subheading">
                    About
                  </h4>
                  <h2>{{@$invest->title}}</h2>

                  {{@$invest->contant}}

                  <!-- <p class="about-two-title-text">
                    IDB Invest is a member of the Inter-American Development
                    Bank (IDB) Group, dedicated to advancing economic
                    development through the private sector in Latin America and
                    the Caribbean. By partnering with private sector entities,
                    IDB Invest aims to provide innovative financing solutions,
                    advisory services, and strategic investments that foster
                    sustainable growth and development.
                  </p>
                  <h5 class="pt-3"><b>Our Mission</b></h5>
                  <p>
                    IDB Invest's mission is to create opportunities for private
                    sector investment that generate inclusive economic growth,
                    improve social conditions, and protect the environment. We
                    work with businesses, financial institutions, and
                    governments to develop and implement projects that have a
                    positive impact on communities and the broader economy.
                  </p> -->
                </div>
                
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="blog-one-section">
        <div class="container">
          <div class="thm-section-title text-center">
            <h4 class="sub-title-shape-left section_title-subheading">Key</h4>
            <h2>Key Areas of Focus</h2>
          </div>

          <div class="row">

          @if(isset($about) && @$about)

          @foreach($about as $focus)
              <div class="col-xl-4 col-lg-4">
            
                <div class="blog-one-single guyana-wrap wow fadeInUp"
                  data-wow-delay="100ms">
                  <div class="blog-one-img guyana-imgg">
                    <img src="{{ asset('storage/'.@$focus->image) }}" alt="" />
                  </div>
                  <div class="blog-one-content">
                    
                    <div class="blog-one-title">
                      <h3><a href="#"> {{$focus->title}} </a></h3>
                    </div>
                    <div class="blog-one-text">

                    {{$focus->contant}}

                      <!-- <p>
                        Supporting projects in transportation, energy, water, and
                        sanitation.
                      </p>
                      <p>
                        Enhancing connectivity and accessibility to spur economic
                        activities.
                      </p> -->


                    </div>
                    <a href="#" class="vs-btn1 style5 mt-3" tabindex="0"
                      >Read More <i class="far fa-long-arrow-right"></i
                    ></a>
                  </div>
                </div>
              </div>

            @endforeach
          @endif


            <!-- <div class="col-xl-4 col-lg-4">
              
              <div
                class="blog-one-single guyana-wrap wow fadeInUp"
                data-wow-delay="100ms">
                <div class="blog-one-img guyana-imgg">
                  <div class="blog-one-img guyana-imgg">
                    <img src="{{asset('images/about/oil-7.png')}}" alt="" />
                  </div>
                </div>
                <div class="blog-one-content">
                 
                  <div class="blog-one-title">
                    <h3><a href="#"> Sustainable Agriculture</a></h3>
                  </div>
                  <div class="blog-one-text">
                    <p>
                      Promoting agricultural practices that increase
                      productivity and sustainability.
                    </p>
                    <p>
                      Investing in agribusiness value chains and rural
                      development.
                    </p>
                  </div>
                  <a href="#" class="vs-btn1 style5 mt-3" tabindex="0"
                    >Read More <i class="far fa-long-arrow-right"></i
                  ></a>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-lg-4">
          
              <div
                class="blog-one-single guyana-wrap wow fadeInUp"
                data-wow-delay="200ms">
                <div class="blog-one-img guyana-imgg">
                  <div class="blog-one-img guyana-imgg">
                    <img src="{{asset('images/about/oil-8.png')}}" alt="" />
                  </div>
                </div>
                <div class="blog-one-content">
                  
                  <div class="blog-one-title">
                    <h3>
                      <a href="#">Renewable Energy</a>
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
                  <a href="#" class="vs-btn1 style5 mt-3" tabindex="0"
                    >Read More <i class="far fa-long-arrow-right"></i
                  ></a>
                </div>
              </div>
            </div> -->
           
          </div>
        </div>
      </section>

      <section class="why-choose-two-section">
        <div class="container">
          <div class="thm-section-title text-center">
            <h4 class="sub-title-shape-left section_title-subheading">
              Services
            </h4>
            <h2>IDB Investment Services</h2>
          </div>
          <div class="row">


          @if(isset($services) && @$services)

          @foreach($services as $ids )
            <div class="col-md-6 col-lg-4 py-2">
              <div class="widget h-100">
                <h3 class="widget_title">{{$ids->title}}</h3>
                <div class="recent-post-wrap">
                  <div class="recent-post">
                    <!-- <div class="media-img"><a href="#"><img src="assets/img/blog/recent-post-1-1.jpg" alt="Blog Image"></a></div> -->
                    <div class="media-body">
                      <!-- <h4 class="post-title">
                        <a class="text-inherit" href="#"
                          > IDB Invest offers a range of investment services
                          designed to meet the diverse needs of private sector
                          clients:</a>
                      </h4> -->
                      <div class="recent-post-meta">
                        <ul class="table-list">

                          <li>
                            <p>

                           {{$ids->contant}}
                          </li>

                          <!-- <li>
                            <p>
                              <b> Equity Investments:</b> Investing in companies
                              to support their development and scalability.
                            </p>
                          </li>
                          <li>
                            <p>
                              <b>Syndicated Loans:</b> Coordinating with other
                              financial institutions to provide larger financing
                              packages.
                            </p>
                          </li>
                          <li>
                            <p>
                              <b>Guarantees:</b> Offering credit guarantees to
                              reduce investment risks and enhance
                              creditworthiness.
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


<!--             
            <div class="col-md-6 col-lg-4 py-2">
              <div class="widget h-100">
                <h3 class="widget_title">Advisory Services</h3>
                <div class="recent-post-wrap">
                  <div class="recent-post">
                  
                    <div class="media-body">
                      <h4 class="post-title">
                        <a class="text-inherit" href="#"
                          >Our advisory services are tailored to help businesses
                          achieve their goals and address challenges:</a
                        >
                      </h4>
                      <div class="recent-post-meta">
                        <ul class="table-list">
                          <li>
                            <p>
                              <b>Technical Assistance:</b> Offering expertise in
                              project design, implementation, and management.
                            </p>
                          </li>
                          <li>
                            <p>
                              <b>Capacity Building:</b> Strengthening the skills
                              and capabilities of businesses and institutions.
                            </p>
                          </li>
                          <li>
                            <p>
                              <b>Sustainability Advisory:</b> Guiding companies
                              in adopting sustainable practices and
                              technologies.
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
                <h3 class="widget_title">Success Stories</h3>
                <div class="recent-post-wrap">
                  <div class="recent-post">
                 
                    <div class="media-body">
                      <h4 class="post-title">
                        <a class="text-inherit" href="#">
                          IDB Invest has a proven track record of successful
                          projects across various sectors in Guyana and the
                          region. Some notable examples include:</a
                        >
                      </h4>
                      <div class="recent-post-meta">
                        <ul class="table-list">
                          <li>
                            <p>
                              <b>Renewable Energy Projects:</b> Financing solar
                              and wind energy initiatives that reduce carbon
                              emissions and provide clean energy.
                            </p>
                          </li>
                          <li>
                            <p>
                              <b> Agricultural Innovations: </b>Supporting
                              agribusinesses in implementing modern farming
                              techniques and improving supply chains.
                            </p>
                          </li>
                          <li>
                            <p>
                              <b> Infrastructure Improvements: </b>Investing in
                              transportation and logistics infrastructure to
                              enhance trade and connectivity.
                            </p>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
        
              </div>
            </div> -->


          </div>
        </div>
      </section>

@endsection