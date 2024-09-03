@extends('layout.master')
@section('content')
  
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
      @if($business)
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
                  <img src="{{ asset('storage/'.@$business->image) }}" alt="" />
                </div>
              </div>
            </div>
            <div class="col-xl-6">
              <div class="about-two-right-content">
                <div class="about-two-title">
                  <h4 class="sub-title-shape-left section_title-subheading">
                    Certificate
                  </h4>
                  <h2>{{@$business->title}}</h2>
                  <p class="about-two-title-text">
                  {!! @$business->contant !!}
                </div>
              </div>
            </div>
          </div>
        </div>
        @else
        <p class="text-center">NO Data Found !</p>
       @endif
      </section>

      <section class="features-two-section">
      @if(isset($certificate) && count(@$certificate)> 0)
        <div class="container">
          <div class="thm-section-title text-center">
            <h4 class="sub-title-shape-left section_title-subheading">
              Certificate of
            </h4>
            <h2>Origin</h2>
          </div>
          <div class="row">
            @if(isset($certificate) && count(@$certificate)> 0)
                @foreach($certificate as $origin)

                <div class="col-lg-4 col-md-6">
              
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
                      
                    </div>
                    <h3> {{ $origin->title}} </h3>   

                        {!! Str::limit($origin->contant, 200)!!}
  
                    <a href="{{route('resources.business.details',base64_encode($origin->id) )}}" class="vs-btn style3 mt-4" tabindex="0"
                      >Read More<i class="far fa-long-arrow-right"></i
                    ></a>
                  </div>
                </div>
                @endforeach
            @endif


          </div>
        </div>

        @else
        <p class="text-center">NO Data Found !</p>
    @endif
      </section>

      <section class="why-choose-two-section">
      @if(isset($benefits) && count(@$benefits) > 0)
        <div class="container">
          <div class="thm-section-title text-center">
            <h4 class="sub-title-shape-left section_title-subheading">
              Benefits of a
            </h4>
            <h2>Certificate of Origin</h2>
          </div>
          <div class="row">

          @if(isset($benefits) && count(@$benefits) > 0)
            @foreach($benefits as $origin)
          
              <div class="col-md-6 col-lg-3 py-2">
                  <div class="widget h-100">
                    <h3 class="widget_title">{{$origin->title}}</h3>
                    <div class="recent-post-wrap">
                      <div class="recent-post">
                      
                        <div class="media-body">
                          <div class="recent-post-meta">
                            <ul class="table-list">
                              <li>
                                <p>

                                {!!  $origin->contant!!}
                                  <!-- Enables reduced import duties under preferential
                                  trade agreements. -->
                                </p>
                              </li>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                  </div>
                </div>
            @endforeach

            @endif



          </div>
        </div>
        
        @else
        <p class="text-center">NO Data Found !</p>
    @endif
      </section>



@endsection