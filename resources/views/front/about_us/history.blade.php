@extends('layout.master')

@section('content')

    <section class="banner-section wow bg-about">
       <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="back-ground">
                    <h2>Historical overview</h2>
                    <div class="breadcrumbs text-center wow animate__ animate__fadeInUp animate__delay-1s animated" style="visibility: visible; animation-name: fadeInUp;">
                        <ul>
                            <li><a href="{{url('/')}}">Home</a></li>
                             <span class="slash">   /</span>
                            <li><a href="#">Historical overview</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
       </div>
      </section>
      <!-- End Bnner Section -->
       <!-- ----Historical-- -->
      
       <section class="historic-tow-section ">
       @if($history )
        <div class="container">
          <div class="row">
          
            <div class="col-xl-12">
              <div class="about-two-right-content">
                <div class="about-two-title text-justify">

                 {!! @$history-> contant !!}
                
                  
                </div>
              </div>
            </div>
          </div>
        </div>
        @else
        <p class="text-center">NO Data Found !</p>
    @endif
      </section>

  
        <!-- -----Historical -->



@endsection