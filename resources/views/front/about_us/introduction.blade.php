@extends('layout.master')

@section('content')

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
                                <li><a href="{{ route('about-us.introduction') }}">About Us</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- ----introduction-- -->
    <section class="about-tow-section about-page">
        @if ($introduction)
            <div class="container">
                <div class="row">
                    <div class="col-xl-6">
                        <div class="about-two-left-content wow slideInLeft" data-wow-delay="100ms">
                            <div class="about-two-sec-image">
                                <div class="about-two-sec-image-bg-1"
                                    style="background-image: url('{{ asset('images/about/about-2--pattern-1.png') }}');">
                                </div>
                                @if ($introduction['image'])
                                    <img src="{{ asset('storage/' . $introduction['image']) }}">
                                @else
                                    <img src="{{ asset('storage/default/no_image.png') }}">
                                @endif
                            </div>
                        </div>

                    </div>
                    <div class="col-xl-6">
                        <div class="about-two-right-content">
                            <div class="about-two-title">
                                <h4 class="sub-title-shape-left section_title-subheading">
                                    Our
                                </h4>
                                <h2>{{ @$introduction->title }}</h2>
                                <p class="about-two-title-text mb-2">
                                    {!! @$introduction->contant !!}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <p class="text-center">No Data Found !</p>
        @endif
    </section>
    <!-- -----introduction -->

    <!-- ----Mission-statement------ -->
    <section class="blog-one-section">
        @if ($mission)
            <div class="container">
                <div class="row">
                    <div class="col-xl-6">
                        <div class="about-two-right-content">
                            <div class="about-two-title">
                                <h4 class="sub-title-shape-left section_title-subheading">
                                    Our
                                </h4>
                                <h2>{{ @$mission->title }}</h2>
                                <p class="about-two-title-text mb-2">
                                    {!! @$mission->contant !!}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="about-two-left-content wow slideInRight" data-wow-delay="100ms">
                            <div class="mission-two-sec-image about-two-sec-image">
                                <div class="about-two-sec-image-bg-1"
                                    style="background-image:url('{{ asset('images/about/about-2--pattern-1.png') }}');">
                                </div>
                                <div class="about-two-sec-image-bg-2"
                                    style="background-image: url('{{ asset('images/about/about-2--pattern-2.png') }}');">
                                </div>
                                @if ($mission['image'])
                                    <img src="{{ asset('storage/' . $mission['image']) }}">
                                @else
                                    <img src="{{ asset('storage/default/no_image.png') }}">
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        @else
            <p class="text-center">No Data Found !</p>
        @endif
    </section>
    <!-- ----Mission-statement------ -->




    <!--Start Testimonials One Section -->
    <section class="testimonials-one-section two" style="background-image: url('{{ asset('images/testimonial/bg-back.png') }}');">
        
        <div class="container">
            <div class="thm-section-title text-center">
                <h4 class="sub-title-shape-left section_title-subheading" style="color: #fff">
                    Our
                </h4>
                <h2>
                    Strategic Priority Areas
                </h2>
            </div>
            @if (count(@$strategic) > 0)
                <div class="row">
                    <div class="col-xl-12">
                        <div class="testimonials-one-carousel owl-theme owl-carousel">
                            @foreach ($strategic as $areas)
                                <div class="testimonials-one-single stragy priority">
                                    <div class="client-info">
                                        <div class="client-img">
                                        @if ($areas['image'] != '')
                                            <img style="height: 64px; width: 64px" src="{{ asset('storage/' . $areas['image']) }}">
                                            @else
                                            <img style="height: 64px; width: 64px" src="{{ asset('storage/default/no_image.png') }}">
                                            @endif
                                        </div>
                                        <div class="client-content">    
                                            <h3>
                                            {!! Str::limit($areas->title, 30) !!}
                                               
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="text-box">
                                    {!! Str::limit($areas->contant, 150) !!}
                                    </div>
                                    <div class="testimonials-quote">
                                        <i class="fa fa-quote-left"></i>
                                    </div>
                                    <button type="button" class="vs-btn1 style5  btn btn-sm mt-3 open_modal" data-id="{{$areas->id}}" href="#" data-toggle="modal" data-target="#exampleModal">Read More</button>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @else
                <p class="text-center">No Data Found !</p>
            @endif
        </div>
    </section>


    <section class="why-choose-two-section">
        <div class="container">
            <div class="thm-section-title text-center">
                <h4 class="sub-title-shape-left section_title-subheading">
                    Our
                </h4>
                <h2>Core Value</h2>
            </div>
            @if (count(@$corevalue) > 0)
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="c-features-con">
                            <ul>
                                @foreach ($corevalue as $listKey => $core)
                                    <li><span>{{ $listKey + 1 }}</span>
                                        <div class="c-features-list">
                                            <p>
                                                {{ $core->title }}
                                            </p>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @else
                <p class="text-center">No Data Found !</p>
            @endif
        </div>
    </section>


    <section class="blog-one-section section-back">
        <div class="container">
            <div class="thm-section-title text-center">
                <h4 class="sub-title-shape-left section_title-subheading">
                    Our
                </h4>
                <h2>Performance Drivers</h2>
            </div>
            @if (isset($performance) && count($performance) > 0)
                <div class="row">
                    @foreach ($performance as $countkey => $Drivers)
                        <div class="col-md-4 col-lg-4 process-style2">
                            <div class="process-icon">
                                <img src="{{ asset('storage/' . $Drivers->image) }}" alt="icon">
                                <span class="process-number">{{ $countkey + 1 }}</span>
                            </div>
                            <h3 class="process-title h5">{{ $Drivers->title }}</h3>
                            <p class="process-text">
                                {!! $Drivers->contant !!}

                            </p>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-center">No Data Found !</p>
            @endif
        </div>
    </section>

@endsection
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" >
        <div class="modal-content" style="width: 135% !important;">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel" ><strong>Learn more </strong></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
            <div class="modal-body">
            
            </div>
        </div>
    </div>
    </div>

    @section('scripts')
    <script type="text/javascript">
       
        $(document).ready(function(){
          
                $('.open_modal').click(function(){
                    let id = $(this).data('id');
                    let url = `{{ url('/about-us/introduction-view/${id}') }}`;
                    $.ajax({
                        type: "GET",
                        url: url,
                        success: function(response) {
                            console.log(response)
                            $('#exampleModalCenter').modal('show');
                            $('.modal-body').html(response)
                        }
                    });
                })
                $('.close').click(function(){
                    $('#exampleModalCenter').modal('hide');

                })
         })
</script>
@endsection