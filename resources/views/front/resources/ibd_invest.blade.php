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

      @if($invest)
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

                  {!! @$invest->contant !!}

                </div>
                
              </div>
            </div>
          </div>
        </div>
        @else
        <p class="text-center">NO Data Found !</p>
      @endif
      </section>

      <section class="blog-one-section">
      @if(isset($about) && count(@$about)> 0)
        <div class="container">
          <div class="thm-section-title text-center">
            <h4 class="sub-title-shape-left section_title-subheading">Key</h4>
            <h2>Key Areas of Focus</h2>
          </div>

          <div class="row">
          @if(isset($about) && count(@$about)> 0)

          @foreach($about as $focus)

              <div class="col-xl-4 col-lg-4">
            
                <div class="blog-one-single guyana-wrap wow fadeInUp"
                  data-wow-delay="100ms">
                  <div class="blog-one-img guyana-imgg">
                    <img src="{{ asset('storage/'.$focus->image) }}" alt="" />
                  </div>
                  <div class="blog-one-content">
                    
                    <div class="blog-one-title">
                      <h3><a href="{{route('resources.idb-invest.details',base64_encode($focus->id) )}}"> {{$focus->title}} </a></h3>
                    </div>
                    <div class="blog-one-text">
                    {!! Str::limit($focus->contant, 200)!!}
               
                    </div>
                    <a href="{{route('resources.idb-invest.details',base64_encode($focus->id) )}}" class="vs-btn1 style5 mt-3" tabindex="0"
                      >Read More <i class="far fa-long-arrow-right"></i
                    ></a>
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

      <section class="why-choose-two-section">
      @if(isset($services) && count(@$services)> 0)
        <div class="container">
          <div class="thm-section-title text-center">
            <h4 class="sub-title-shape-left section_title-subheading">
              Services
            </h4>
            <h2>IDB Investment Services</h2>
          </div>
          <div class="row">


          @if(isset($services) && count(@$services)> 0)

          @foreach($services as $ids )
            <div class="col-md-6 col-lg-4 py-2">
              <div class="widget h-100">
                <h3 class="widget_title">{{$ids->title}}</h3>
                <div class="recent-post-wrap">
                  <div class="recent-post">
                
                    <div class="media-body">

                      <div class="recent-post-meta">
                        <ul class="table-list">

                          <li>
                            <p>

                           {!! $ids->contant !!}
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