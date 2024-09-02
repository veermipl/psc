@extends('layout.master')
@section('content')

<section class="banner-section wow bg-about">
        <div class="container">
         <div class="row">
             <div class="col-lg-12">
                 <div class="back-ground">
                     <h2>Annual Reports </h2>
                     <div class="breadcrumbs text-center wow animate__ animate__fadeInUp animate__delay-1s animated" style="visibility: visible; animation-name: fadeInUp;">
                         <ul>
                             <li><a href="{{url('/')}}">Home</a></li>
                              <span class="slash">   /</span>
                             <li><a href="#">Annual Reports </a></li>
                         </ul>
                     </div>
                 </div>
             </div>
         </div>
        </div>
       </section>
    
      <!--Start Blog One Section -->
      <section class="blog-one-section">
        <div class="container">
         
          <div class="row">

          @if(isset($data) && count(@$data)> 0)
            @foreach($data as $reports )

            <div class="col-xl-4 col-lg-4">
              <div class="blog-one-single guyana-wrap wow fadeInUp" data-wow-delay="100ms">
                <div class="blog-one-img  guyana-imgg">
                  <img src="{{asset('storage/'.$reports->image)}}" alt="" />
                </div>
                <div class="blog-one-content">
                  <ul class="blog-classic-meta">

                    <li>
                      <a href="#"><i class="fas fa-clock"></i> {{ $reports->created_at->format('g:i A') }}</a>
                    </li>

                    <li>
                      <a href="#"><i class="fas fa-calendar-alt"></i> {{ $reports->created_at->format('M d, Y') }}</a >
                    </li>
                  </ul>
                  <div class="blog-one-title hei-65">
                    <h3><a href="#">{{$reports->title}}</a></h3>
                  </div>
                  <div class="blog-one-text">
                      {!! Str::limit($reports->contant, 100)!!}
                  </div>
                  <a href="{{route('resources.annual.report.details', $reports->id)}}" class="vs-btn1 style5 mt-3" tabindex="0">Read More <i class="far fa-long-arrow-right"></i></a>
                </div>
              </div>
            </div>
            @endforeach
         @endif
            </div>
        </div>
      </section>

@endsection