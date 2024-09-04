@extends('layout.master')

@section('content')
    @if(count($header) > 0)
    <section class="banner-section wow fadeIn">
        <div class="swiper-container banner-slider">
            <div class="swiper-wrapper">
                @foreach($header as $headerKey => $headerVal)
                    <div class="swiper-slide ab_s" style="background-image: url({{ asset('storage/' .($headerVal['file'] ? $headerVal['file'] : 'default/no_image.png')) }})">
                        <div class="content-outer">
                            <div class="content-box">
                                <div class="inner">
                                    <h1>{{ $headerVal['title'] }}</h1>
                                    @php
                                        $limitedContent = Str::limit($headerVal['content'], 150);
                                    @endphp
                                    <div class="text">{!! $limitedContent !!}</div>
                                    <div class="link-box">
                                        <a href="{{ route('home.banner.show', base64_encode($headerVal['id'])) }}" class="vs-btn style3 view-btns" tabindex="0" style="position: unset; text-align: center">
                                            Read More<i class="far fa-long-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="banner-slider-nav">
            <div class="banner-slider-control banner-slider-button-prev">
                <span><i class="far fa-angle-left"></i></span>
            </div>
            <div class="banner-slider-control banner-slider-button-next">
                <span><i class="far fa-angle-right"></i></span>
            </div>
        </div>
        <div class="banner-shape__left_1"></div>
        <div class="banner-shape__left_2"></div>
        <!-- <div class="banner-big-title" data-parallax='{"x": 200}'>Factory</div> -->
    </section>
    @endif

    @if(count($sub_header) > 0)
    <section class="features-two-section">
        <div class="container">
            <div class="row">
                @foreach($sub_header as $sub_headerKey => $sub_headerVal)
                    <div class="col-lg-3 col-md-6 mb-15">
                        <div class="features-two-sec-single wow fadeInUp h-100" data-wow-delay="300ms">
                            <div class="features-two-sec-icon">
                                @if ($sub_headerVal['file'])
                                    <img src="{{ asset('storage/' . $sub_headerVal['file']) }}">
                                @else
                                    <img src="{{ asset('storage/default/no_image.png') }}">
                                @endif
                            </div>
                            <h3>{{ $sub_headerVal['title'] }}</h3>
                            @php
                                $limitedContent = Str::limit($sub_headerVal['content'], 150);
                            @endphp
                            <p>{!! $limitedContent !!}</p>
                            <a href="{{ route('home.sub-banner.show', base64_encode($sub_headerVal['id'])) }}" class="vs-btn style3 mt-4" tabindex="0">
                                Read More<i class="far fa-long-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    @if($about_us)
    <section class="about-tow-section about-page">
        <div class="container">
            <div class="row">
                <div class="col-xl-6">
                    <div class="about-two-left-content wow slideInLeft" data-wow-delay="100ms">
                        <div class="about-two-sec-image">
                            <div class="about-two-sec-image-bg-1"
                                style="background-image: url(images/about/about-2--pattern-1.png);">
                            </div>
                            <div class="about-two-sec-image-bg-2"
                                style="background-image: url(images/about/about-2--pattern-2.png);">
                            </div>
                            @if ($about_us['file'])
                                <img src="{{ asset('storage/' . $about_us['file']) }}">
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
                                About Us
                            </h4>
                            <h2>{{ $about_us['title'] }}</h2>
                            <p class="about-two-title-text">{!! $about_us['content'] !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <section class="testimonials-one-section two" style="background-image: url(images/testimonial/bg-back.png)">
        <div class="container">
            <div class="thm-section-title text-center">
                <h4 class="sub-title-shape-left section_title-subheading" style="color: #fff">
                    SECTOR COMMITTEES
                </h4>
                <h2>
                    Learn more <br />
                    about Sector Committees
                </h2>
            </div>
            @if(count($sector_committees) > 0)
                <div class="row">
                    <div class="col-xl-12">
                        <div class="testimonials-one-carousel owl-theme owl-carousel">
                            @foreach($sector_committees as $sector_committeesKey => $sector_committeesVal)
                                <div class="testimonials-one-single">
                                    <div class="client-info">
                                        <div class="client-img">
                                            @if ($sector_committeesVal['file'])
                                                <img src="{{ asset('storage/' . $sector_committeesVal['file']) }}">
                                            @else
                                                <img src="{{ asset('storage/default/no_image.png') }}">
                                            @endif
                                        </div>
                                        <div class="client-content">
                                            <h3>{{ $sector_committeesVal['title'] }}</h3>
                                        </div>
                                    </div>
                                    <div class="text-box">
                                        <p>{!! $sector_committeesVal['content'] !!}</p>
                                    </div>
                                    <div class="testimonials-quote">
                                        <i class="fa fa-quote-left"></i>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <section class="why-choose-two-section">
        <div class="container">
            <div class="thm-section-title text-center">
                <h4 class="sub-title-shape-left section_title-subheading">
                    Our Reports
                </h4>
                <h2>Annual Report</h2>
            </div>
            @if($report)
                <div class="row">
                    <div class="col-xl-6">
                        <div class="why-choose-two-image">
                            @if ($report['file'])
                                <img src="{{ asset('storage/' . $report['file']) }}">
                            @else
                                <img src="{{ asset('storage/default/no_image.png') }}">
                            @endif
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="why-choose-right-content">
                            <div class="most-trusted-skill">
                                <div class="most-trusted-text">
                                    <div class="most-trusted-skill-icon">
                                        @if ($report['icon'])
                                            <img src="{{ asset('storage/' . $report['icon']) }}">
                                        @else
                                            <img src="{{ asset('storage/default/no_image.png') }}">
                                        @endif
                                    </div>
                                    <h3>{{ $report['title'] }}</h3>
                                    <p>{!! $report['content'] !!}</p>
                                </div>
                            </div>
                            @if($report['link'])
                                <div class="progress-levels">
                                    <a href="{{ $report['link'] }}" target="_blank" class="vs-btn style3 view-btns mt-4" tabindex="0"
                                        style="position: unset;text-align: center;margin-top: 20px !important;">
                                        Download annual report<i class="far fa-long-arrow-right"></i>
                                    </a>
                                    <a href="{{ $report['link'] }}" target="_blank" class="vs-btn style3 view-btn mt-4" tabindex="0"
                                        style="position: unset;text-align: center;margin-top: 20px !important;">
                                        View older annual reports<i class="far fa-long-arrow-right"></i>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @else
                <h6 class="text-center">No Data Found !</h6>
            @endif
        </div>
    </section>

    <section class="blog-one-section">
        <div class="container">
            <div class="thm-section-title text-center">
                <h4 class="sub-title-shape-left section_title-subheading">
                    Recent Posts
                </h4>
                <h2>Latest Updates</h2>
            </div>
            @if(count($posts) > 0)
                <div class="row">
                    @foreach($posts as $postKey => $postVal)
                        <div class="col-xl-4 col-lg-4">
                            <div class="blog-one-single wow fadeInUp" data-wow-delay="100ms">
                                <div class="blog-one-img">
                                    @if ($postVal['file'])
                                        <img src="{{ asset('storage/' . $postVal['file']) }}">
                                    @else
                                        <img src="{{ asset('storage/default/no_image.png') }}">
                                    @endif
                                </div>
                                <div class="blog-one-content">
                                    <ul class="blog-classic-meta">
                                        <li>
                                            <a><i class="fas fa-clock"></i> {{ date('h:i A', strtotime($postVal['created_at'])) }}</a>
                                        </li>
                                        <li>
                                            <a><i class="fas fa-calendar-alt"></i> {{ date('M d, Y', strtotime($postVal['created_at'])) }}</a>
                                        </li>
                                    </ul>
                                    <div class="blog-one-title">
                                        <h3><a href="{{ route('home.post.show', base64_encode($postVal['id'])) }}">{{ $postVal['title'] }}</a></h3>
                                    </div>
                                    <div class="blog-one-text">
                                        @php
                                            $limitedContent = Str::limit($postVal['content'], 150);
                                        @endphp
                                        <p>{!! $limitedContent !!}</p>
                                    </div>
                                    <a href="{{ route('home.post.show', base64_encode($postVal['id'])) }}" class="vs-btn1 style5 mt-3" tabindex="0">Read More
                                        <i class="far fa-long-arrow-right"></i>
                                    </a>
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

    <!-- ------Media-center-section -->
    <section class="why-choose-two-section">
        <div class="container">
            <div class="thm-section-title text-center">
                <h4 class="sub-title-shape-left section_title-subheading">
                    Our
                </h4>
                <h2>Media Center</h2>
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-4 py-2">
                    <div class="widget h-100">
                        <h3 class="widget_title">Press Release</h3>
                        @if(count($press_release) > 0)
                            @foreach($press_release as $press_releaseKey => $press_releaseVal)
                                <div class="recent-post-wrap">
                                    <div class="recent-post">
                                        <div class="media-body">
                                            <h4 class="post-title">
                                                <a class="text-inherit" href="{{ route('media.press-release-show', base64_encode($press_releaseVal['id'])) }}">{{ $press_releaseVal['title'] }}</a>
                                            </h4>
                                            <div class="recent-post-meta">
                                                <a href="#">{{ date('M d, Y', strtotime($press_releaseVal['created_at'])) }}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <a href="{{ route('media.press-release') }}" class="vs-btn style5 mt-4" tabindex="0">
                                Read More<i class="far fa-long-arrow-right"></i>
                            </a>
                        @else
                            <hr>
                            <h6 class="text-dark">No Data Found !</h6>
                        @endif
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 py-2">
                    <div class="widget h-100">
                        <h3 class="widget_title">News</h3>
                        @if(count($news) > 0)
                            @foreach($news as $newsKey => $newsVal)
                                <div class="recent-post-wrap">
                                    <div class="recent-post">
                                        <div class="media-body">
                                            <h4 class="post-title">
                                                <a class="text-inherit" href="{{ route('media.news-show', base64_encode($newsVal['id'])) }}">{{ $newsVal['title'] }}</a>
                                                </h4>
                                            <div class="recent-post-meta">
                                                <a href="#">{{ date('M d, Y', strtotime($press_releaseVal['created_at'])) }}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <a href="{{ route('media.news') }}" class="vs-btn style5 mt-4" tabindex="0">
                                Read More<i class="far fa-long-arrow-right"></i>
                            </a>
                        @else
                            <hr>
                            <h6 class="text-dark">No Data Found !</h6>
                        @endif
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 py-2">
                    <div class="widget h-100">
                        <h3 class="widget_title">Social Media</h3>
                        @if(count($social_media) > 0)
                            @foreach($social_media as $social_mediaKey => $social_mediaVal)
                                <div class="recent-post-wrap">
                                    <div class="recent-post">
                                        <div class="media-body">
                                            <h4 class="post-title"><a class="text-inherit" href="#"> {{ $social_mediaVal['title'] }}</a></h4>
                                            <div class="recent-post-meta">
                                                <a href="#">{{ date('M d, Y', strtotime($press_releaseVal['created_at'])) }}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <a href="{{ route('media.social-media') }}" class="vs-btn style5 mt-4" tabindex="0">
                                Read More<i class="far fa-long-arrow-right"></i>
                            </a>
                        @else
                            <hr>
                            <h6 class="text-dark">No Data Found !</h6>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- -Media-center-section---- -->

    <!--Start video Two Section -->
    <section class="video-two-section" style="background-image: url(images/main-slider/become.png)">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="video-two-sec-inner">
                        <div class="video-two-sec-content text-center">
                            <h2 class="text-center">Become a Member</h2>
                            <h2
                                style="
                  font-size: 20px;
                  margin-bottom: 10px;
                  text-align: center;
                ">
                                GET STARTED WITH OUR MEMBERSHIP APPLICATION
                            </h2>

                            <p>
                                Learn more about our various types of membership and sign-up
                                today!
                            </p>
                            <a href="{{ route('register') }}" class="vs-btn style3 mt-4" tabindex="0"
                                style="
                  position: unset;
                  text-align: center;
                  margin-top: 60px !important;
                ">Apply
                                For Membership<i class="far fa-long-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End video Two Section -->

@endsection
