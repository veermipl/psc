@extends('layout.master')

@section('content')
    

<section class="banner-section wow bg-about">
        <div class="container">
         <div class="row">
             <div class="col-lg-12">
                 <div class="back-ground">
                     <h2>COTED</h2>
                     <div class="breadcrumbs text-center wow animate__ animate__fadeInUp animate__delay-1s animated" style="visibility: visible; animation-name: fadeInUp;">
                         <ul>
                             <li><a href="{{url('/')}}">Home</a></li>
                              <span class="slash">   /</span>
                             <li><a href="#">COTED</a></li>
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
                class="about-two-left-content wow slideInLeft"
                data-wow-delay="100ms"
              >
                <div class="about-two-sec-image">
                  <div
                    class="about-two-sec-image-bg-1"
                    style="
                      background-image: url('{{asset('/images/about/about-2--pattern-1.png')}}');
                    "
                  ></div>
                  <div
                    class="about-two-sec-image-bg-2"
                    style="
                      background-image: url('{{asset('images/about/about-2--pattern-2.png')}}');
                    "
                  ></div>
                  <img src="{{asset('images/about/coted.png')}}" alt="" />
                </div>
              </div>
            </div>
            <div class="col-xl-6">
              <div class="about-two-right-content">
                <div class="about-two-title">
                  <h4 class="sub-title-shape-left section_title-subheading">
                    Center of Talent in
                  </h4>
                  <h2>Entrepreneurship Development</h2>
                  <p class=" mb-2">
                    The Center of Talent in Entrepreneurship Development (COTED) in Guyana is a pivotal initiative aimed at fostering the growth and development of entrepreneurship within the country. As Guyana experiences rapid economic changes and opportunities, COTED plays a crucial role in equipping individuals with the skills, knowledge, and resources needed to start and grow successful businesses.
                  </p>
                  <h5 class="pt-3"><b>Core Programs</b></h5>
                  <p>
                    COTED offers a variety of programs tailored to meet the needs of different segments of the population, from aspiring young entrepreneurs to seasoned business professionals looking to scale their ventures.
                  </p>
                 
                </div>
              

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

     
      <section class="main-service-one-section two pt-3">
        <div class="thm-section-title text-center">
          <h4 class="sub-title-shape-left section_title-subheading">
            Center of Talent in
          </h4>
          <h2>Entrepreneurship Development</h2>
        </div>
        <div class="container">
            <div class="row">
              <div class="col-xl-4 col-lg-4">
                <!--Blog One Single-->
                <div class="blog-one-single guyana-wrap wow fadeInUp" data-wow-delay="100ms" style="visibility: visible;">
                  <div class="blog-one-img guyana-imgg">
                    <img src="{{asset('images/coted/enterprenurhip.png')}}" alt="">
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
                      <h3><a href="#">Entrepreneurship Training Workshops</a></h3>
                    </div>
                    <div class="blog-one-text">
                      <p>
                        These workshops cover essential topics such as business planning, financial management, marketing strategies, and legal requirements specific
                      </p>
                    
                    </div>
                    <a href="#" class="vs-btn1 style5 mt-3" tabindex="0">Read More <i class="far fa-long-arrow-right"></i></a>
                  </div>
                </div>
              </div>
              <div class="col-xl-4 col-lg-4">
                <!--Blog One Single-->
                <div class="blog-one-single guyana-wrap wow fadeInUp" data-wow-delay="100ms" style="visibility: visible;">
                  <div class="blog-one-img guyana-imgg">
                    <img src="{{asset('images/coted/mentorship.png')}}" alt="">
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
                      <h3><a href="#">Mentorship and Coaching</a></h3>
                    </div>
                    <div class="blog-one-text">
                      <p>
                        COTED connects budding entrepreneurs with experienced mentors who provide personalized guidance, helping them navigate challenges and seize opportunities.
                      </p>
                     
                    </div>
                    <a href="#" class="vs-btn1 style5 mt-3" tabindex="0">Read More <i class="far fa-long-arrow-right"></i></a>
                  </div>
                </div>
              </div>
              <div class="col-xl-4 col-lg-4">
                <!--Blog One Single-->
                <div class="blog-one-single guyana-wrap wow fadeInUp" data-wow-delay="100ms" style="visibility: visible;">
                  <div class="blog-one-img guyana-imgg">
                    <img src="{{asset('images/coted/acceslaration.png')}}" alt="">
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
                      <h3><a href="#">Startup Incubation and Acceleration</a></h3>
                    </div>
                    <div class="blog-one-text">
                      <p>
                        For early-stage startups, COTED offers incubation programs that provide workspace, technical support, and access to funding opportunities.
                      </p>
                     
                    </div>
                    <a href="#" class="vs-btn1 style5 mt-3" tabindex="0">Read More <i class="far fa-long-arrow-right"></i></a>
                  </div>
                </div>
              </div>
                
            </div>
        </div>
    </section>
      <!--End Blog One Section -->


@endsection
