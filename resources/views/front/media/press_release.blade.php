@extends('layout.master')

@section('content')

    <!-- End Main Header -->
    <section class="banner-section wow bg-about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="back-ground">
                        <h2>Press Release</h2>
                        <div class="breadcrumbs text-center wow animate__ animate__fadeInUp animate__delay-1s animated"
                            style="visibility: visible; animation-name: fadeInUp;">
                            <ul>
                                <li><a href="{{ url('/') }}">Home</a></li>
                                <span class="slash"> /</span>
                                <li><a href="{{ route('media.press-release') }}">Press Release</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>





    <section class="why-choose-two-section my-lorem-pdf-two-section">
        <div class="container">
          <!-- <div class="thm-section-title text-center">
            <h4 class="sub-title-shape-left section_title-subheading">
              Our Reports
            </h4>
            <h2>2024</h2>
          </div>
          <ul
            class="nav nav-pills mb-3 my-tab d-flex justify-content-center"
            id="pills-tab"
            role="tablist">
            <li class="nav-item" role="presentation">
              <button
                class="nav-link active"
                id="pills-home-tab"
                data-toggle="pill"
                data-target="#pills-home"
                type="button"
                role="tab"
                aria-controls="pills-home"
                aria-selected="true">
                2002
              </button>
            </li>
            <li class="nav-item" role="presentation">
              <button
                class="nav-link"
                id="pills-profile-tab"
                data-toggle="pill"
                data-target="#pills-profile"
                type="button"
                role="tab"
                aria-controls="pills-profile"
                aria-selected="false">
                2003
              </button>
            </li>
            <li class="nav-item" role="presentation">
              <button
                class="nav-link"
                id="pills-contact-tab"
                data-toggle="pill"
                data-target="#pills-contact"
                type="button"
                role="tab"
                aria-controls="pills-contact"
                aria-selected="false">
                2004
              </button>
            </li>
          </ul> -->
          <div class="tab-content" id="pills-tabContent">
            <div
              class="tab-pane fade show active"
              id="pills-home"
              role="tabpanel"
              aria-labelledby="pills-home-tab">
              @if(count($press_release_list) > 0)
              <div class="row">
            
              @foreach ($press_release_list as $listKey => $list )
                <div class="col-md-6">
                @php
                  $files = explode(',', $list->files);
              @endphp
                  <a target="_blank" href="{{ asset('storage/' . $files[0]) }}">
                    <div class="row mb-3">
                      <div class="col-md-2">
                        <div class="my-lorem-pdf">
                          
                          <img src="{{asset('images/download-pdf.png')}}" alt="" />
                        </div>
                      </div>
                      <div class="col-md-10">
                        <h5 class="newslatter-2">{{ $list->title }}</h5>
                        <!-- <p>Lorem</p> -->
                      </div>
                    </div>
                  </a>
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
   
   
   
      <!--Start Blog One Section -->
   

    <!--End Blog One Section -->
@endsection
