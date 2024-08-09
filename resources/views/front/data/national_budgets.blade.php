@extends('layout.master')

@section('content')
    <!-- <section class="why-choose-two-section">
        <div class="container">
            <div class="thm-section-title text-center">
                <h4 class="sub-title-shape-left section_title-subheading">
                    Data
                </h4>
                <h2>National Budgets</h2>
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
                     <h2>National Budgets</h2>
                     <div class="breadcrumbs text-center wow animate__ animate__fadeInUp animate__delay-1s animated" style="visibility: visible; animation-name: fadeInUp;">
                         <ul>
                             <li><a href="{{url('/')}}">Home</a></li>
                              <span class="slash">   /</span>
                             <li><a href="#">National Budgets</a></li>
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
                    style=" background-image: url('{{asset('/images/about/about-2--pattern-1.png')}}');"></div>
                  <div
                    class="about-two-sec-image-bg-2"
                    style=" background-image: url('{{asset('/images/about/about-2--pattern-2.png')}}');"></div>
                  <img src="{{asset('images/Trade/trade-data.png')}}" alt="" />
                </div>
              </div>
            </div>
            <div class="col-xl-6">
              <div class="about-two-right-content">
                <div class="about-two-title">
                  <h4 class="sub-title-shape-left section_title-subheading">
                     National 
                  </h4>
                  <h2>Budgets Overview</h2>
                  <p class=" mb-2">
                    Guyana's national budget outlines the government's planned revenue and expenditure for the fiscal year. It reflects the country’s economic priorities, investment strategies, and financial health, aimed at promoting sustainable growth and development.
                  </p>
                  <p>
                    Guyana's national budget outlines the government's planned revenue and expenditure for the fiscal year, focusing on economic growth and sustainable development.
                  </p>
                  <p>
                    Key revenue sources include taxes, natural resource exports (notably gold and the burgeoning oil sector), and foreign aid. The budget allocates funds to critical sectors: infrastructure development (roads, bridges, ports), education (schools, teacher training), healthcare (hospitals, public health programs), social services (welfare, social security), security (police, military), and economic diversification (agriculture, tourism).
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

     
     
      <!--End Blog One Section -->

      <section class="main-service-one-section two pt-0 mb-0">
        <div class="thm-section-title text-center">
          <h4 class="sub-title-shape-left section_title-subheading">
            Revenue 
          </h4>
          <h2>Sources</h2>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-lg-4">
                    <!--Blog One Single-->
                    <div class="blog-one-single guyana-wrap wow fadeInUp animated" data-wow-delay="100ms" style="visibility: visible; animation-delay: 100ms; animation-name: fadeInUp;">
                      <div class="blog-one-img  guyana-imgg">
                        <img src="{{asset('images/budget/tax.png')}}" alt="">
                      </div>
                      <div class="blog-one-content">
                      
                        <div class="blog-one-title ">
                          <h3><a href="#">Taxes</a></h3>
                        </div>
                        <div class="blog-one-text">
                          <p>
                            Including income tax, value-added tax (VAT), and corporate tax.
                          </p>
                        </div>
                        <a href="#" class="vs-btn1 style5 mt-3" tabindex="0">Read More <i class="far fa-long-arrow-right"></i></a>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-4 col-lg-4">
                    <!--Blog One Single-->
                    <div class="blog-one-single guyana-wrap wow fadeInUp animated" data-wow-delay="100ms" style="visibility: visible; animation-delay: 100ms; animation-name: fadeInUp;">
                      <div class="blog-one-img  guyana-imgg">
                        <img src="{{asset('images/budget/natural.png')}}" alt="">
                      </div>
                      <div class="blog-one-content">
                   
                        <div class="blog-one-title ">
                          <h3><a href="#">Natural Resources</a></h3>
                        </div>
                        <div class="blog-one-text">
                          <p>
                            Significant contributions from gold, bauxite, and the emerging oil and gas sector.

                          </p>
                        </div>
                        <a href="#" class="vs-btn1 style5 mt-3" tabindex="0">Read More <i class="far fa-long-arrow-right"></i></a>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-4 col-lg-4">
                    <!--Blog One Single-->
                    <div class="blog-one-single guyana-wrap wow fadeInUp animated" data-wow-delay="100ms" style="visibility: visible; animation-delay: 100ms; animation-name: fadeInUp;">
                      <div class="blog-one-img  guyana-imgg">
                        <img src="{{asset('images/budget/other.png')}}" alt="">
                      </div>
                      <div class="blog-one-content">
                   
                        <div class="blog-one-title ">
                          <h3><a href="#">Other Income</a></h3>
                        </div>
                        <div class="blog-one-text">
                          <p>
                            Licensing fees, customs duties, and service charges.

                          </p>
                        </div>
                        <a href="#" class="vs-btn1 style5 mt-3" tabindex="0">Read More <i class="far fa-long-arrow-right"></i></a>
                      </div>
                    </div>
                  </div>
              
              
            </div>
        </div>
    </section>



@endsection
