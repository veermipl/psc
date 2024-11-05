@extends('layout.master')

@section('content')

    <style>
        .why-choose-two-section{
            padding: 0 0 40px;
        }
        
        .cor-padd{
            padding-top: 60px
        }
    </style>
    <section class="banner-section wow bg-about">
        <div class="container">
         <div class="row">
             <div class="col-lg-12">
                 <div class="back-ground">
                     <h2>Business Directory</h2>
                     <div class="breadcrumbs text-center wow animate__ animate__fadeInUp animate__delay-1s animated" style="visibility: visible; animation-name: fadeInUp;">
                         <ul>
                            <li><a href="{{ route('home') }}">Home</a></li>
                              <span class="slash">   /</span>
                             <li><a href="{{ route('membership.business-directory') }}">Business Directory</a></li>
                         </ul>
                     </div>
                 </div>
             </div>
         </div>
        </div>
       </section>

<section class="why-choose-two-section">
    <div class="container">
    @if(count($membershipList) > 0)
    @foreach($membershipList as $listKey => $list)
        <div class="thm-section-title cor-padd text-center" id="{{ strtolower($list->name) }}">  <!-- ID added here -->
            <h4 class="sub-title-shape-left section_title-subheading">
                Our
            </h4>
            <h2>{{ $list->name }} Members</h2>
        </div>
        @if(count($business_directory_list) > 0)
            <div class="row">
                @foreach($business_directory_list as $listChildKey => $listChild)
                    @if($list->id == $listChild->type)
                    <div class="col-md-6">
                        <div class="service-details-sidebar">
                            <div class="service-details-sidebar-single view-all-services p-0">
                                <ul>
                                    <li>
                                        <div class="icon">
                                            <i class="fa fa-angle-right"></i>
                                        </div>
                                        <div class="text">
                                            <a  @if($listChild->link != '') target="_blank" href=" {!! $listChild->link ?? '#' !!}"  @endif >
                                                {{ $listChild->name}}
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>
        @else
        <p>No business directories found for {{ $list->name }} members.</p>
        @endif
    @endforeach
@else
    <h6 class="text-center">No Data Found!</h6>
@endif
    </div>
</section>
  <!--Start Why Choose Two Section -->

<!--End Why Choose Two Section -->
<!-- -----Become a member-start--- -->
<!-- <section class="video-two-section" style="background-image: url('{{asset('/images/main-slider/become.png')}}')">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="video-two-sec-inner">
                    <div class="video-two-sec-content text-center">
                        <h2 class="text-center">Benefits of Becoming A Member</h2>


                        <p class="mb-3">
                            The Private Sector Commission of Guyana Limited, the umbrella organization for Guyana’s private sector businesses, is committed to the promotion of a vibrant and dynamic private sector as the engine of growth in Guyana, the achievement of a welfare standard for citizens on par with that of advanced countries, and the address of pertinent issues in the national interest. The achievement of these objectives is accomplished through the harnessing of skills and talents of its members.
                        </p>
                        <p class="mb-3">
                            The Commission actively engages its members through meetings and other forms of dialogue to arrive at common positions on the spectrum of current and unfolding issues.
                        </p>
                        <p class="mb-3">
                            Sub-committees which may comprise member representatives and other competent resource persons who are elected/appointed to serve, oversee specific issues on an ongoing basis. This may be through the facilitation of dialogue with relevant government organs, interaction with local and international stakeholders, as well as with counterpart regional and international private sector organizations.
                        </p>
                        <p class="mb-3">
                            On becoming a Member, private sector firms and associations are eligible for appointment to Council, the governing body of the Commission, and thus contribute directly to the Mission and Objectives of the Private Sector Commission. They can materially contribute to the effective representation of private sector interests at various fora, participate on sub-committees, and guide the work of the Secretariat.
                        </p>
                        <a href="#" class="vs-btn style3 mt-4" tabindex="0" style="
                      position: unset;
                      text-align: center;
                      margin-top: 60px !important;
                    ">Become A Member<i class="far fa-long-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->
      




@endsection
