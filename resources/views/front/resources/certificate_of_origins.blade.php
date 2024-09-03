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
        @if($origin)
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
      @if(isset($types) && count(@$types) > 0)
        <div class="container">
          <div class="thm-section-title text-center">
            <h4 class="sub-title-shape-left section_title-subheading">
              Types of
            </h4>
            <h2>Certificates of Origin</h2>
          </div>

          <div class="row">
    
              @foreach(@$types as $type)

    

                  <div class="col-xl-6 col-lg-6">
                  
                    <div
                      class="blog-one-single guyana-wrap wow fadeInUp"
                      data-wow-delay="100ms">
                      <div class="blog-one-img guyana-imgg">
                        <img src="{{asset('storage/'.$type->image) }}" alt="" />
                      </div>
                      <div class="blog-one-content">
                        <div class="blog-one-title">
                          <h3><a href="{{route('resources.certificate-of-origins.deatils',base64_encode($type->id) )}}">{{$type->title}}</a></h3>
                        </div>
                        <div class="blog-one-text">

                        {!! Str::limit($type->contant, 200)!!}
                       
                         
                        </div>
                        <a href="{{route('resources.certificate-of-origins.deatils', base64_encode($type->id)  )}}" class="vs-btn1 style5 mt-3" tabindex="0"
                          >Read More <i class="far fa-long-arrow-right"></i
                        ></a>
                      </div>
                    </div>
                  </div>
              @endforeach



          </div>
        </div>
        @else
        <p class="text-center">NO Data Found !</p>
      @endif
      </section>

      <section class="why-choose-two-section">
      @if(isset($certificate) && count(@$certificate)> 0)

        <div class="container">
          <div class="thm-section-title text-center">
            <h4 class="sub-title-shape-left section_title-subheading">
              Certificate
            </h4>
            <h2>of Origin</h2>
          </div>
          <div class="row">

        @if(isset($certificate) && count(@$certificate)> 0)

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