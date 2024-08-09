@extends('layout.master')

@section('content')
<!-- Bnner Section -->
<section class="banner-section wow bg-about">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="back-ground">
                    <h2>Member Benefits</h2>
                    <div class="breadcrumbs text-center wow animate__ animate__fadeInUp animate__delay-1s animated" style="visibility: visible; animation-name: fadeInUp;">
                        <ul>
                            <li><a href="{{url('/')}}">Home</a></li>
                            <span class="slash"> /</span>
                            <li><a href="#">Member Benefits</a></li>
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
              <div class="about-two-left-content wow slideInLeft animated" data-wow-delay="100ms" style="visibility: visible; animation-delay: 100ms; animation-name: slideInLeft;">
                <div class="about-two-sec-image">
                  <div class="about-two-sec-image-bg-1" style="
                      background-image: url('{{asset('/images/about/about-2--pattern-1.png')}}');
                    "></div>
                  <div class="about-two-sec-image-bg-2" style="
                      background-image: url('{{asset('images/about/about-2--pattern-2.png')}}');
                    "></div>
                  <img src="{{asset('images/about/about-page-img-1.png')}}" alt="">
                </div>
              </div>
            </div>
            <div class="col-xl-6">
              <div class="about-two-right-content">
                <div class="about-two-title">
                  <h4 class="sub-title-shape-left section_title-subheading">
                    Benefits of 
                  </h4>
                  <h2>Becoming A Member</h2>
                  <p class="">
                    The Private Sector Commission of Guyana Limited, the umbrella organization for Guyana’s private sector businesses, is committed to the promotion of a vibrant and dynamic private sector as the engine of growth in Guyana, the achievement of a welfare standard for citizens on par with that of advanced countries, and the address of pertinent issues in the national interest. The achievement of these objectives is accomplished through the harnessing of skills and talents of its members.
                  </p>
                  <p>
                    The Commission actively engages its members through meetings and other forms of dialogue to arrive at common positions on the spectrum of current and unfolding issues.
                  </p>
                  <p>
                    Sub-committees which may comprise member representatives and other competent resource persons who are elected/appointed to serve, oversee specific issues on an ongoing basis. This may be through the facilitation of dialogue with relevant government organs, interaction with local and international stakeholders, as well as with counterpart regional and international private sector organizations.
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
    
    <!-- -----Become a member-start--- -->
    <section class="video-two-section" style="background-image: url('{{asset('/images/main-slider/become.png')}}')">
        <div class="container">
          <div class="row">
            <div class="col-xl-12">
              <div class="video-two-sec-inner">
                <div class="video-two-sec-content text-center">
                  <h2 class="text-center">Benefits of Becoming A Member</h2>
                  <h2 style="
                  font-size: 20px;
                  margin-bottom: 10px;
                  text-align: center;
                ">
                                GET STARTED WITH OUR MEMBERSHIP APPLICATION
                            </h2>

                  <a href="{{url('register')}}" class="vs-btn style3 mt-4" tabindex="0" style="
                      position: unset;
                      text-align: center;
                      margin-top: 60px !important;
                    ">Become A Member<i class="far fa-long-arrow-right"></i></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>



@endsection