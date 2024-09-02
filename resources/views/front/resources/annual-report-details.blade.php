@extends('layout.master')
@section('content')

<section class="banner-section wow bg-about">
        <div class="container">
         <div class="row">
             <div class="col-lg-12">
                 <div class="back-ground">
                     <h2>Annual Reports
                     </h2>
                     <div class="breadcrumbs text-center wow animate__ animate__fadeInUp animate__delay-1s animated" style="visibility: visible; animation-name: fadeInUp;">
                         <ul>
                             <li><a href="url('/')">Home</a></li>
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
       <section class="blog-classic-section">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-7">
                    <div class="blog-classic-content">
                        <!--Blog Classic Single-->
                        <div class="blog-classic-single">
                            <div class="blog-classic-image">
                                <!-- <img src="{{asset('storage/'.@$details->image)}}" alt=""> -->
                                <div class="blog-classic-date">
                                    <a href="#">{{ @$details->created_at->format('M d, Y') }} </a>
                                </div>
                            </div>
                            <div class="blog-classic-content-box">
                                <ul class="blog-classic-meta">
                                    <li><a href="#"><i class="far fa-user-circle"></i> Admin</a></li>
                                    <li><a href="#"><i class="far fa-comments"></i> 2 Comments</a>
                                    </li>
                                </ul>
                                <div class="blog-classic-title">
                                    <h3>{{@$details->title}}</h3>
                                </div>
                                <div class="blog-classic-text">
                                   {!!@$details->contant !!}
                                </div>
                                <!-- <div class="blog-classic-btn">
                                    <a href="#">Read More <i class="fa fa-arrow-circle-right"></i></a>
                                </div> -->
                            </div>
                        </div>
                    
                    </div>
                </div>
                <div class="col-xl-4 col-lg-5">
                    <div class="sidebar">
                        <div class="sidebar-single sidebar-search">
                           <h3 class="sidebar-title">Search</h3>
                            <form action="#" class="sidebar-search-form">
                                <input type="search" placeholder="Search">
                                <button type="submit"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                    
                        <div class="sidebar-single sidebar-latest-news">
                            <h3 class="sidebar-title">Latest Posts</h3>
                            <ul class="sidebar-latest-news-list">

                            @if(isset($data) && count(@$data)> 0 )
                             @foreach($data as $posts)
                                <li>
                                    <div class="sidebar-latest-news-image">
                                        <img src="{{asset('storage/'.$posts->image)}}" alt="">
                                    </div>
                                    <div class="sidebar-latest-news-content">
                                       <h3><a href="#">{{$posts->title}}</a></h3>
                                       <p>{{ @$posts->created_at->format('d M, Y') }}</p> 
                                    </div>
                                </li>
                                @endforeach

                            @endif

                                
                            </ul>
                        </div>
                        
                      
                       
                    </div>
                </div>
            </div>
        
        </div>
      </section>

@endsection