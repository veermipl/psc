@extends('layout.master')

@section('content')
    <!-- <section class="why-choose-two-section">
        <div class="container">
            <div class="thm-section-title text-center">
                <h4 class="sub-title-shape-left section_title-subheading">
                    Data
                </h4>
                <h2>Trade Data</h2>
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
                     <h2>Trade Data</h2>
                     <div class="breadcrumbs text-center wow animate__ animate__fadeInUp animate__delay-1s animated" style="visibility: visible; animation-name: fadeInUp;">
                         <ul>
                             <li><a href="{{url('/')}}">Home</a></li>
                              <span class="slash">   /</span>
                             <li><a href="#">Trade Data</a></li>
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
                      background-image: url('{{asset('/images/about/about-2--pattern-2.png')}}');"
                  ></div>
                  <img src="{{asset('images/Trade/trade-data.png')}}" alt="" />
                </div>
              </div>
            </div>
            <div class="col-xl-6">
              <div class="about-two-right-content">
                <div class="about-two-title">
                  <h4 class="sub-title-shape-left section_title-subheading">
                    Our
                  </h4>
                  <h2>Trade Data</h2>
                  <p class=" mb-2">
                    Guyana's trade data highlights its reliance on key exports like gold, bauxite, rice, and timber, with major trading partners including the United States, Canada, and the UK. Imports mainly consist of machinery, fuel, and foodstuffs.
                  </p>
                  <p>
                    Recent oil discoveries are reshaping its trade dynamics, potentially boosting GDP and foreign investments. However, infrastructure challenges and the need for economic diversification remain critical.
                  </p>
                  <p>
                    Trade policies, including regional agreements like CARICOM, play a significant role. Data from the Bank of Guyana and international organizations offer insights into these trade trends and their impact on the economy.
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

     
      <section class="main-service-one-section two">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-lg-4">
                    <!--Main Service One Sec Single-->
                    <div class="main-service-one-sec-single wow fadeInUp animated" data-wow-delay="100ms" style="visibility: visible; animation-delay: 100ms; animation-name: fadeInUp;">
                        <div class="main-service-one-sec-img">
                            <img src="{{asset('images/Trade/trade.png')}}" alt="">
                        </div>
                        <div class="main-service-one-sec-content">
                            <h4>$1,000,000</h4>
                            <h3>Total Trade Volume</h3>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4">
                    <!--Main Service One Sec Single-->
                    <div class="main-service-one-sec-single wow fadeInUp animated" data-wow-delay="200ms" style="visibility: visible; animation-delay: 200ms; animation-name: fadeInUp;">
                        <div class="main-service-one-sec-img">
                            <img src="{{asset('images/Trade/balance.png')}}" alt="">
                        </div>
                        <div class="main-service-one-sec-content">
                            <h4>$500,000</h4>
                            <h3>Trade Balance</h3>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4">
                    <!--Main Service One Sec Single-->
                    <div class="main-service-one-sec-single wow fadeInUp animated" data-wow-delay="300ms" style="visibility: visible; animation-delay: 300ms; animation-name: fadeInUp;">
                        <div class="main-service-one-sec-img">
                            <img src="{{asset('images/Trade/Top.png')}}" alt="">
                        </div>
                        <div class="main-service-one-sec-content">
                            <h4>Top Trading Partners</h4>
                            <h3>Guyana, USA, India</h3>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </section>
      <!--End Blog One Section -->

      <section class="main-service-one-section two pt-0 mb-0">
        <div class="thm-section-title text-center">
          <h4 class="sub-title-shape-left section_title-subheading">
              Top Trading
          </h4>
          <h2>Country</h2>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-lg-4">
                    <!--Main Service One Sec Single-->
                    <div class="main-service-one-sec-single wow fadeInUp animated" data-wow-delay="100ms" style="visibility: visible; animation-delay: 100ms; animation-name: fadeInUp;">
                        <div class="main-service-one-sec-img">
                          <img src="{{asset('images/Trade/Top.png')}}" alt="">
                        </div>
                        <div class="main-service-one-sec-content">
                            <h4>$1,000,000</h4>
                            <h3>Country A</h3>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4">
                    <!--Main Service One Sec Single-->
                    <div class="main-service-one-sec-single wow fadeInUp animated" data-wow-delay="200ms" style="visibility: visible; animation-delay: 200ms; animation-name: fadeInUp;">
                        <div class="main-service-one-sec-img">
                          <img src="{{asset('images/Trade/Top.png')}}" alt="">
                        </div>
                        <div class="main-service-one-sec-content">
                            <h4>$500,000</h4>
                            <h3>Country B</h3>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4">
                    <!--Main Service One Sec Single-->
                    <div class="main-service-one-sec-single wow fadeInUp animated" data-wow-delay="300ms" style="visibility: visible; animation-delay: 300ms; animation-name: fadeInUp;">
                        <div class="main-service-one-sec-img">
                          <img src="{{asset('images/Trade/Top.png')}}" alt="">
                        </div>
                        <div class="main-service-one-sec-content">
                            <h4>$6500,00</h4>
                            <h3>Country C</h3>
                        </div>
                    </div>
                </div>
              
            </div>
        </div>
    </section>


@endsection
