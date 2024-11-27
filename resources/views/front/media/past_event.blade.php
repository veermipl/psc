@extends('layout.master')

@section('content')
    <!-- End Main Header -->
    <section class="banner-section wow bg-about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="back-ground">
                        <h2>Past Event</h2>
                        <div class="breadcrumbs text-center wow animate__ animate__fadeInUp animate__delay-1s animated"
                            style="visibility: visible; animation-name: fadeInUp;">
                            <ul>
                                <li><a href="{{ route('home') }}">Home</a></li>
                                <span class="slash"> /</span>
                                <li><a href="{{ route('event.past-event') }}">Past Event</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="blog-one-section">
        <div class="container">
            <div class="row">
                @if (isset($data) && count($data) > 0)
                    @foreach ($data as $event)
                        <div class="col-xl-4 col-lg-4">
                            <div class="blog-one-single guyana-wrap wow fadeInUp" data-wow-delay="100ms">
                                <div class="blog-one-img  guyana-imgg">
                                    <img src="{{ asset('storage/' . $event->image) }}" alt="" />
                                </div>
                                <div class="blog-one-content h-165">
                                    <ul class="blog-classic-meta">
                                        @if ($event->date_time != '')
                                            <li>
                                                <a href="{{ route('event.event_details', base64_encode($event->id)) }}"> <i
                                                        class="fas fa-clock"></i>
                                                    {{ date('H:i A', strtotime($event->date_time)) }}</a>
                                            </li>

                                            <li>
                                                <a href="{{ route('event.event_details', base64_encode($event->id)) }}"> <i
                                                        class="fas fa-calendar-alt"></i>
                                                    {{ date('M d,Y', strtotime($event->date_time)) }}</a>
                                            </li>
                                        @endif
                                    </ul>
                                    <div class="blog-one-title hei-65">
                                        <h3><a
                                                href="{{ route('event.event_details', base64_encode($event->id)) }}">{{ $event->title }}</a>
                                        </h3>
                                    </div>

                                    <a href="{{ route('event.event_details', base64_encode($event->id)) }}"
                                        class="vs-btn1 style5 " tabindex="0">Read More <i
                                            class="far fa-long-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <h5>
                        <span class="badge badge-danger" style="font-size: 19px">No Data Found !</span>
                    </h5>
                @endif
            </div>
    </section>


@endsection
