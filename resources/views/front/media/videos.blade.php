@extends('layout.master')

@section('content')
    <section class="banner-section wow bg-about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="back-ground">
                        <h2>Videos</h2>
                        <div class="breadcrumbs text-center wow animate__ animate__fadeInUp animate__delay-1s animated"
                            style="visibility: visible; animation-name: fadeInUp;">
                            <ul>
                                <li><a href="{{ route('home') }}">Home</a></li>
                                <span class="slash"> /</span>
                                <li><a href="{{ route('media.videos') }}">Videos</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Start Blog One Section -->
    <section class="portfolio-one-section-photo">
        <div class="container">
            <div class="portfolio-one-content">
                <div class="sortable-masonry">
                    @if(count($video_list) > 0)
                        <div class="row items-container">
                            @foreach ($video_list as $listKey => $list )
                                <div class="col-xl-3 col-lg-3 col-md-6 masonry-item all mechanical chemical material">
                                    <div class="portfolio-one-single">
                                        <div class="portfolio-one-img-box">
                                            <img src="{{ asset('storage/default/video.png') }}"></img>
                                            <div class="portfolio-two-icon-box">
                                                <a href="{{ ($list['type'] == 'internal') ? asset('storage/'. $list['name']) : $list['link'] }}" target="_blank">
                                                    <i class="fa fa-link"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <h6 class="text-center">No Data Found !</h6>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <!--End Blog One Section -->
@endsection
