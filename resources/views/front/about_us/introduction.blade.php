@extends('layout.master')

@section('content')
<!-- <section class="why-choose-two-section">
        <div class="container">
            <div class="thm-section-title text-center">
                <h4 class="sub-title-shape-left section_title-subheading">
                    About Us
                </h4>
                <h2>Introduction</h2>
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
                    <h2>About Us</h2>
                    <div class="breadcrumbs text-center wow animate__ animate__fadeInUp animate__delay-1s animated"
                        style="visibility: visible; animation-name: fadeInUp;">
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <span class="slash"> /</span>
                            <li><a href="about.html">About Us</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>




<!-- ----introduction-- -->
<section class="about-tow-section about-page">
    @if($introduction)
    <div class="container">
        <div class="row">
            <div class="col-xl-6">
                <div class="about-two-left-content wow slideInLeft" data-wow-delay="100ms">
                    <div class="about-two-sec-image">
                        <div class="about-two-sec-image-bg-1" style="background-image: url('{{ asset('images/about/about-2--pattern-1.png') }}');"></div>
                        <div class="about-two-sec-image-bg-2" style="background-image: url('{{ asset('images/about/about-2--pattern-2.png') }}');"></div>
                        <img src="{{ asset('storage/'.@$introduction->image) }}" alt="" />
                    </div>
                </div>
               
            </div>
            <div class="col-xl-6">
                <div class="about-two-right-content">
                    <div class="about-two-title">
                        <h4 class="sub-title-shape-left section_title-subheading">
                            Our
                        </h4>
                        <h2>{{ @$introduction->title	}}</h2>
                        <p class="about-two-title-text mb-2">
                        {!! @$introduction->contant !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
        <p class="text-center">NO Data Found !</p>
    @endif
</section>
<!-- -----introduction -->
<!-- ----Mission-statement------ -->
<section class="blog-one-section">
    @if($mission)
    <div class="container">
        <div class="row">
            <div class="col-xl-6">
                <div class="about-two-right-content">
                    <div class="about-two-title">
                        <h4 class="sub-title-shape-left section_title-subheading">
                            Our
                        </h4>
                        <h2>{{ @$mission->title	}}</h2>
                        <p class="about-two-title-text mb-2">
                        {!! @$mission->contant !!}
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
            <div class="col-xl-6">
                <div class="about-two-left-content wow slideInRight" data-wow-delay="100ms">
                    <div class="mission-two-sec-image">
                        <div class="about-two-sec-image-bg-1" style="
                        background-image:url('{{ asset('images/about/about-2--pattern-1.png') }}');
                      "></div>
                        <div class="about-two-sec-image-bg-2" style="
                        background-image: url('{{ asset('images/about/about-2--pattern-2.png') }}');
                      "></div>
                        <img src="{{ asset('storage/'.@$introduction->image) }}" alt="mission-statement" />
                    </div>
                </div>
            </div>

        </div>
    </div>
    @else
        <p class="text-center">NO Data Found !</p>
    @endif
</section>
<!-- ----Mission-statement------ -->




<!--Start Testimonials One Section -->
@if(count(@$strategic)> 0)
<section class="testimonials-one-section two" style="background-image: url('{{ asset('images/testimonial/bg-back.png')}}');">
  

<div class="container">
        <div class="thm-section-title text-center">
            <h4 class="sub-title-shape-left section_title-subheading" style="color: #fff">
                Our
            </h4>
            <h2>
                Strategic Priority Areas
            </h2>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="testimonials-one-carousel owl-theme owl-carousel">
                    <!--Testimonials One Single-->

                    @if( @$strategic && count(@$strategic)> 0 )
                    
                        @foreach($strategic as $areas )
                        <div class="testimonials-one-single stragy">
                            <div class="client-info">
                                <div class="client-img">
                                    <img src="{{ asset('storage/'.@$areas->image) }}" alt="" />
                                </div>
                                <div class="client-content">
                                    <h3>
                                        {{$areas->title	}}
                                        </h3>
                                </div>
                            </div>
                            <div class="text-box">
                                     {!! $areas->contant !!}
                                <!-- <p>
                                    To advocate for, provide leadership and promote activities and projects for all members
                                    and stakeholders that will create a platform to foster development in Guyana.
                                </p> -->
                            </div>
                            <div class="testimonials-quote">
                                <i class="fa fa-quote-left"></i>
                            </div>
                        </div>
                        @endforeach
                    @endif


                </div>
            </div>
        </div>
    </div>

    @else
        <p class="text-center">NO Data Found !</p>
    @endif

</section>


<section class="why-choose-two-section">
@if(isset($corevalue) && count(@$corevalue)> 0)
    <div class="container">
        <div class="thm-section-title text-center">
            <h4 class="sub-title-shape-left section_title-subheading">
                Our
            </h4>
            <h2>Core Value</h2>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="c-features-con">
                    <ul>
                        @if(@$corevalue && count(@$corevalue)> 0)
                            @foreach($corevalue as $listKey => $core)
                            <li><span>{{ $listKey + 1 }}</span>
                                <div class="c-features-list">
                                    <p>
                                     {{ $core->title }}
                                    </p>
                                </div>
                            </li>
                            @endforeach

                        @endif


                    </ul>
                </div>
            </div>
        </div>
    </div>
    @else
        <p class="text-center">NO Data Found !</p>
    @endif

</section>


<section class="blog-one-section section-back">
@if(isset($performance) && count($performance) > 0 )
    <div class="container">
        <div class="thm-section-title text-center">
            <h4 class="sub-title-shape-left section_title-subheading">
                Our
            </h4>
            <h2>Performance Drivers</h2>
        </div>
        <div class="row">

        @if(isset($performance) && count($performance) > 0 )
            @foreach($performance as $countkey => $Drivers)

            <div class="col-md-4 col-lg-4 process-style2">
                <div class="process-icon">
                    <img src="{{ asset('storage/'.@$areas->image) }}" alt="icon">
                    <span class="process-number">{{$countkey + 1}}</span>
                </div>
                <h3 class="process-title h5">{{$Drivers->title	}}</h3>
                <p class="process-text">
                 {{$Drivers->contant}}

                </p>
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