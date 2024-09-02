@extends('layout.master')

@section('content')    
    <section class="banner-section wow bg-about">
        <div class="container">
         <div class="row">
             <div class="col-lg-12">
                 <div class="back-ground">
                     <h2>Committees</h2>
                     <div class="breadcrumbs text-center wow animate__ animate__fadeInUp animate__delay-1s animated" style="visibility: visible; animation-name: fadeInUp;">
                         <ul>
                             <li><a href="{{url('/')}}">Home</a></li>
                              <span class="slash">   /</span>
                             <li><a href="{{ route('about-us.committeess') }}">Committees</a></li>
                         </ul>
                     </div>
                 </div>
             </div>
         </div>
        </div>
       </section>


      <section class="blog-one-section">
        <div class="container">
            <div class="thm-section-title text-center">
                <h4 class="sub-title-shape-left section_title-subheading">
                    Our
                </h4>
                <h2>Committees Members</h2>
            </div>

            @if(count(@$committees) > 0)
                <div class="row">
                    @foreach($committees as $members)
                        <div class="col-xl-3 col-lg-3 col-md-6">
                            <div class="team-one-single wow fadeInLeft animated" data-wow-delay="100ms" style="visibility: visible; animation-delay: 100ms; animation-name: fadeInLeft;">
                                <div class="team-one-img">
                                    @if($members->image)
                                        <img src="{{ asset('storage/'.$members->image) }}" alt="">
                                    @else
                                        <img src="{{asset('images/team/commeties.png')}}" alt="">
                                    @endif

                                    <div class="team-one-hover">
                                        <div class="team-one-social">
                                            @if($members->facebook != '')
                                                <a href="{{$members->facebook}}"><i class="fab fa-facebook-square"></i></a>
                                            @endif
                                            @if($members->twitter != '')
                                                <a href="{{$members->twitter}}"><i class="fab fa-twitter"></i></a>
                                            @endif
                                            @if($members->instra != '')
                                                <a href="{{$members->instra}}"><i class="fab fa-dribbble"></i></a>
                                            @endif
                                            @if($members->dribbble != '')
                                                <a href="{{$members->dribbble}}"><i class="fab fa-instagram"></i></a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="team-one-content">
                                    <h3>{{$members->name}}</h3>
                                    <p>{{$members->office}}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <h6 class="text-center">No Data Found !</h6>
            @endif
        </div>
      </section>


@endsection