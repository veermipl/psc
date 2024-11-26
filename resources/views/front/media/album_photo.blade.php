@extends('layout.master')

@section('content')

    <section class="banner-section wow bg-about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="back-ground">
                        <h2>{{ $album ? $album->name : 'Album'}} Photos</h2>
                        <div class="breadcrumbs text-center wow animate__ animate__fadeInUp animate__delay-1s animated"
                            style="visibility: visible; animation-name: fadeInUp;">
                            <ul>
                                <li><a href="{{ route('home') }}">Home</a></li>
                                <span class="slash"> /</span>
                                <li><a href="{{ route('media.albums') }}">Albums</a></li>
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
                    @if (count($album_photo_list) > 0)
                        <div class="row items-container" style="position: relative; height: 870px;">
                            @foreach ($album_photo_list as $listKey => $list)
                                <div class="col-xl-4 col-lg-3 col-md-6 masonry-item all mechanical chemical material"
                                    style="position: absolute; left: 0px; top: 0px;">
                                    <div class="portfolio-one-single">
                                        <div class="portfolio-one-img-box">
                                            @if ($list->name)
                                                <img src="{{ asset('storage/' . $list->name) }}">
                                            @else
                                                <img src="{{ asset('storage/default/no_image.png') }}">
                                            @endif
                                            <div class="portfolio-two-icon-box">
                                                @if ($list->name)
                                                    <a href="{{ asset('storage/' . $list->name) }}" class="img-popup">
                                                        <i class="fa fa-search"></i>
                                                    </a>
                                                @else
                                                    <a href="{{ asset('storage/default/no_image.png') }}" class="img-popup">
                                                        <i class="fa fa-search"></i>
                                                    </a>
                                                @endif
                                            </div>
                                            <div class="portfolio-text">
                                                <h4> {{ Str::limit($list->title, 50) }}</h4>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <h6 class="text-center">No Photo(s) Found !</h6>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <!--End Blog One Section -->
@endsection
