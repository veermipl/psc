<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>
        @hasSection('title')
            {{ config('app.name') }} - @yield('title')
        @else
            {{ config('app.name') }}
        @endif
    </title>

    <!-- Responsive -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />

    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/magnific-popup.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet" />

    <link rel="icon" href="images/favicon.png" type="image/x-icon" />

    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.1.2/css/dataTables.dataTables.css">

    <style>
        body {
            top: 0 !important;
        }

        .goog-logo-link {
            display: none !important;
        }

        .goog-te-gadget {
            font-size: 0px !important;
        }




        #google_translate_element img {
            display: none !important;
        }

        .VIpgJd-ZVi9od-l4eHX-hSRGPd,
        .VIpgJd-ZVi9od-TvD9Pc-hSRGPd,
        .VIpgJd-ZVi9od-ORHb-OEVmcd {
            display: none !important;
        }

        .VIpgJd-ZVi9od-ORHb {
            display: none !important;
        }

        .goog-te-combo {
            padding: 6px;
            border-radius: 5px;
        }

        .goog-te-combo option {
            font-size: 15px;
        }

        .language-btn {
            min-width: 130px;
            position: relative;
            top: 12px;
        }
    </style>
    @yield('css')
</head>

<body>

    <div class="wrapper_box">
        <!-- Preloader -->
        <div class="loader-wrap">
            <div class="preloader"></div>
            <div class="layer layer-one"><span class="overlay"></span></div>
            <div class="layer layer-two"><span class="overlay"></span></div>
            <div class="layer layer-three"><span class="overlay"></span></div>
        </div>

        <!-- Main Header-->
        <header class="main-header">
            <div class="header_top">
                <div class="auto-container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="header_top_inner clearfix">
                                <div class="header_top_one_box pull-left">
                                    <ul>
                                        <li class="desk_logo">
                                            <a href="{{ route('home') }}">
                                                <img src="{{ asset('images/Gover-website/logo-other.png') }}" alt="logo" />
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="header_top_two_box pull-right">
                                    <div class="opening_hour">
                                        <div class="js">
                                            <div class="language-picker js-language-picker" data-trigger-class="btn btn--subtle">
                                                <div id="google_translate_element"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="opening_hour social_links_1">
                                        <div class="topbar-one__right">
                                            <a href="#" class="topbar-one__guide-btn" id="btn-increase" title="Increase font size" style="font-size: 17px">
                                                +A</a>
                                            <a href="#" class="topbar-one__guide-btn" id="btn-origs" title="Reset font size" style="font-size: 17px">A
                                            </a>
                                            <a href="#" class="topbar-one__guide-btn" id="btn-decrease" title="Decrease font size" style="font-size: 17px">
                                                -A</a>
                                        </div>
                                    </div>
                                    @auth
                                    <div class="d-flex">
                                        <div class="ml-2">
                                            <div class="dropdownt">
                                                <div class="drop-img dropbtnt" id="myBtnt">
                                                    <img src="https://i.postimg.cc/ydFvrvbN/slider3.png" alt="user-picture">
                                                    <i class="fas fa-chevron-down"></i>
                                                </div>
                                                <div id="myDropdownt" class="dropdown-contentt">
                                                    <a href="{{ route('profile') }}"> <i class="far fa-user"></i> Profile</a>
                                                    @if (auth()->user()->hasPermission('admin_dashboard'))
                                                        <a href="{{ route('admin.dashboard') }}"> <i class="far fa-dashboard"></i> Dashboard</a>
                                                    @endif
                                                    @if (auth()->user()->hasPermission('member_dashboard'))
                                                        <a href="{{ route('member.dashboard') }}"> <i class="far fa-dashboard"></i> Dashboard</a>
                                                    @endif

                                                    <form action="{{ route('logout') }}" method="post">
                                                        @csrf
                                                        @method('post')
                                                        <button class=" btn-sm btn-block" style="padding-left: 15px; text-align:start;">
                                                            <i class="far fa-lock"></i> Logout
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Header Upper -->
            <div class="header_upper">
                <div class="auto-container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="header_upper_inner clearfix">
                                <div class="header_upper_one_box pull-left m-show">
                                    <div class="logo">
                                        <a href="{{ route('home') }}"><img src="{{ asset('images/Gover-website/logo-other.png') }}" alt="" title="" /></a>
                                    </div>
                                </div>
                                <div class="header_upper_two_box one pull-right">
                                    <div class="nav-outer">
                                        <!--Mobile Navigation Toggler-->
                                        <div class="mobile-nav-toggler">
                                            <span class="icon flaticon-menu"></span>
                                        </div>
                                        <div class="nav-inner">
                                            <!-- Main Menu -->
                                            <nav class="main-menu navbar-expand-xl navbar-dark">
                                                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                                    <ul class="navigation">
                                                        <li class="current">
                                                            <a href="{{ route('home') }}">Home</a>
                                                        </li>
                                                        <li class="dropdown">
                                                            <a href="index.html">About Us <i class="fas fa-chevron-down"></i></a>
                                                            <ul>

<<<<<<< Updated upstream
                                                                <li><a  href="{{ route('about-us.introduction') }}">Introduction</a>
                                                                </li>
                                                                <li><a  href="{{ route('about-us.staff') }}">Staff</a>
                                                                </li>
                                                                <li>
                                                                    <a  href="{{ route('about-us.council') }}">Council</a>
=======
                                                                <li><a href="{{ route('about-us.introduction') }}">Introduction</a>
                                                                </li>
                                                                <li><a href="{{ route('about-us.staff') }}">Staff</a>
                                                                </li>
                                                                <li>
                                                                    <a href="{{ route('about-us.council') }}">Council</a>
>>>>>>> Stashed changes
                                                                </li>
                                                                <li>
                                                                    <a href="{{ route('about-us.history') }}">History</a>
                                                                </li>

                                                                <li>
                                                                    <a href="{{ route('about-us.committeess') }}">Committeess</a>
                                                                </li>

                                                            </ul>
                                                        </li>

                                                        <!-- <li><a href="#">Members</a></li> -->
                                                        <li class="dropdown">
                                                            <a href="#">Membership
                                                                <i class="fas fa-chevron-down"></i></a>
                                                            <ul>
                                                                @guest
                                                                <li>
                                                                    <a href="{{ route('login') }}">Members Sign-in</a>
                                                                </li>
                                                                @endguest
                                                                <li>
                                                                    <a href="{{ route('membership.business-directory') }}">Business
                                                                        Directory</a>
                                                                </li>
                                                                @guest
                                                                <li>
                                                                    <a href="{{ route('register') }}">Join Now</a>
                                                                </li>
                                                                @endguest
                                                                <li>
                                                                    <a href="{{ route('membership.member-benefits') }}">Member
                                                                        Benefits</a>
                                                                </li>

                                                            </ul>
                                                        </li>
                                                        <!-- <li class="dropdown">
                                                            <a href="#"
                                                            >Sector Committees
                                                            <i class="fas fa-chevron-down"></i
                                                            ></a>
                                                            <ul>
                                                            <li>
                                                                <a href="#"
                                                                >Governance & Security</a
                                                                >
                                                            </li>
                                                            <li>
                                                                <a href="#">Agriculture</a>
                                                            </li>
                                                            <li>
                                                                <a href="#"
                                                                >Trade & Investment</a
                                                                >
                                                            </li>
                                                            <li>
                                                                <a href="#"
                                                                >Natural Resoures</a
                                                                >
                                                            </li>
                                                            <li>
                                                                <a href="#">Financial & Economics</a>
                                                            </li>
                                                            <li><a href="#">Energy</a></li>
                                                            <li>
                                                                <a href="#">Infrastructure</a>
                                                            </li>
                                                            <li><a href="#">Enviroment</a></li>
                                                            <li><a href="#">Regional</a></li>
                                                            </ul>
                                                        </li> -->
                                                        <li>
                                                            <a href="{{ route('guyana-economy') }}"> Guyana's Economy
                                                            </a>
                                                        </li>
                                                        <li class="dropdown">
                                                            <a href="#">Data
                                                                <i class="fas fa-chevron-down"></i>
                                                            </a>
                                                            <ul>
                                                                <li>
                                                                    <a href="{{ route('data.national_budgets') }}">National
                                                                        Budgets</a>
                                                                </li>
                                                                <li>
                                                                    <a href="{{ route('data.trade-data') }}">Trade
                                                                        Data</a>
                                                                </li>
                                                                <li>
                                                                    <a href="{{ route('data.coted') }}">COTED</a>
                                                                </li>
                                                                <li>
                                                                    <a href="{{ route('data.caricom-cet') }}">CARICOM
                                                                        CET</a>
                                                                </li>

                                                            </ul>
                                                        </li>
                                                        <li class="dropdown">
                                                            <a href="#">Resources
                                                                <i class="fas fa-chevron-down"></i>
                                                            </a>
                                                            <ul>
                                                                <li><a href="{{ route('resources.business-readiness-desk') }}">Business
                                                                        Readiness Desk </a></li>
                                                                <li>
                                                                    <a href="{{ route('resources.go-invest') }}">Go-Invest</a>
                                                                </li>
                                                                <li>
                                                                    <a href="{{ route('resources.idb-invest') }}">IDB
                                                                        Invest</a>
                                                                </li>
                                                                <li>
                                                                    <a href="{{ route('resources.procurement-process-in-guyana') }}">Procurement
                                                                        Process in Guyana</a>
                                                                </li>
                                                                <li>
                                                                    <a href="{{ route('resources.certificate-of-origins') }}">Certificate
                                                                        of Origins</a>
                                                                </li>
                                                                <li>
                                                                    <a href="{{ route('resources.annual-report') }}">Annual
                                                                        Reports</a>
                                                                </li>
                                                            </ul>
                                                        </li>
                                                        <!-- <li><a href="#">News</a></li> -->
                                                        <li class="dropdown">
                                                            <a href="index.html">Media Center
                                                                <i class="fas fa-chevron-down"></i>
                                                            </a>
                                                            <ul>
                                                                <li><a href="{{ route('media.news') }}">News</a></li>
                                                                <li>
                                                                    <a href="{{ route('media.press-release') }}">Press
                                                                        Releases</a>
                                                                </li>
                                                                <li>
                                                                    <a href="{{ route('media.social-media') }}">Social
                                                                        Media</a>
                                                                </li>
                                                                <li>
                                                                    <a href="{{ route('media.photos') }}">Photos</a>
                                                                </li>
                                                                <li>
                                                                    <a href="{{ route('media.videos') }}">Videos</a>
                                                                </li>

                                                            </ul>
                                                        </li>
                                                        <li><a href="{{ route('contact-us') }}">Contact Us</a></li>
                                                    </ul>
                                                </div>
                                            </nav>
                                            <!-- Main Menu End-->
                                        </div>
                                    </div>
                                    <div class="icon-search-box">
                                        <button class="dropdown-toggle" id="searchDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-search" aria-hidden="true"></i>
                                        </button>
                                        <form action="#" class="dropdown-menu" aria-labelledby="searchDropdown">
                                            <input type="text" placeholder="Search..." />
                                            <button>
                                                <i class="fa fa-search" aria-hidden="true"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--End Header Upper-->

            <!--End Header Upper-->
            <div class="sticky-header">
                <div class="auto-container">
                    <div class="outer-container">
                        <div class="header-column">
                            <div class="logo-box">
                                <div class="logo">
                                    <a href="{{url('/')}}"><img src="{{asset('images/Gover-website/logo-other.png')}}" alt="" title="" /></a>
                                </div>
                            </div>
                        </div>
                        <div class="header-column">
                            <div class="nav-outer">
                                <!--Mobile Navigation Toggler-->
                                <div class="mobile-nav-toggler">
                                    <span class="icon flaticon-menu"></span>
                                </div>

                                <div class="nav-inner">
                                    <!-- Main Menu -->
                                    <nav class="main-menu navbar-expand-xl navbar-dark">
                                        <div class="collapse navbar-collapse">
                                            <ul class="navigation"></ul>
                                        </div>
                                    </nav>
                                    <!-- Main Menu End-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mobile Menu  -->
            <div class="mobile-menu close-menu">
                <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
                <nav class="menu-box">
                    <ul class="navigation"></ul>
                </nav>
            </div>
            <!-- End Mobile Menu -->

            <div class="nav-overlay"></div>
        </header>
        <!-- End Main Header -->

        @if (session('status') == 'verification-link-sent')
        <div class="flashMsg alertSuccess">
            <strong>A new verification link has been sent to the email address you provided during
                registration.</strong>
        </div>
        @endif


        @yield('content')

        <!--Start Footer Section -->
        <footer class="footer-section">
            <div class="container">
                <div class="row mb-3">
                    <div class="col-xl-4 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="100ms">
                        <div class="footer-widget-single footer-widget-about">
                            <div class="footer-widget-title">
                                <h3>About Us</h3>
                            </div>
                            <div class="footer-widget-about-text">
                                <p>
                                    The Commission is governed by a Council which is comprised
                                    of the Heads of all Sectoral Member Organizations and a
                                    number of elected corporate members.
                                </p>
                            </div>
                            <div class="footer-widget-about-social">
                                <a href="#"><i class="fab fa-facebook"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"> <i class="fab fa-youtube"></i></a>
                                <a href="#"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="200ms">
                        <div class="footer-widget-single footer-widget-useful-links">
                            <div class="footer-widget-title">
                                <h3>Useful Links</h3>
                            </div>
                            <ul class="footer-widget-useful-links-list list-unstyled">
                                <li><a href="{{url('about-us/introduction')}}">Introduction</a></li>
                                <li><a href="{{url('membership/business-directory')}}">Member Benefits</a></li>
                                <li><a href="{{url('guyana-economy')}}">Guyana's Economy</a></li>
                                <li><a href="{{url('media/news')}}">News</a></li>
                              
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="300ms">
                        <div class="footer-widget-single footer-widget-contact">
                            <div class="footer-widget-title">
                                <h3>Contact Us</h3>
                            </div>
                            <div class="footer-widget_contact-info">
                                <p style="display: flex; align-items: baseline">
                                    <i class="fas fa-map-marker-alt" style="margin-right: 10px"></i>
                                    157 Waterloo St, Georgetown, Guyana
                                </p>
                                <a href="tel:+592-223-0875"><i class="fas fa-phone" style="margin-right: 10px"></i>+592-223-0875</a>
                                <br />
                                <a href="mailto:office@psc.org.gy">
                                    <i class="fas fa-envelope" style="margin-right: 10px"></i>office@psc.org.gy</a><br />
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="400ms">
                        <div class="footer-widget-single">
                            <div class="footer-widget-title">
                                <h3>Private Sector Commission</h3>
                            </div>
                            <ul class="footer-widget-gallery-list list-unstyled">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.6022967381095!2d-58.160602499999996!3d6.818129600000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8dafef0e7ef8479b%3A0x7bf69734452f5a55!2sPrivate%20Sector%20Commission!5e0!3m2!1sen!2sin!4v1707730504072!5m2!1sen!2sin" width="100%" height="170" style="border: 0" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <hr / style="border-bottom: 1px solid #fff;"> -->
            <div class="bottom-footer">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="footer-bottom">
                                <p>
                                    Copyright 2024©. All Rights Reserved. Designed By Latitude Infotech Inc.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!--End Footer Section -->

        <!--Scroll to top-->
        <div class="scroll-to-top scroll-to-target" data-target="html">
            <span class="icon fas fa-arrow-up"></span>
        </div>

    </div>


    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'en',
                includedLanguages: 'en,es,de,fr,it'
            }, 'google_translate_element');


        }
    </script>
    <script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit">
    </script>

    {{-- script --}}
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/swiper.min.js') }}"></script>
    <script src="{{ asset('js/appear.js') }}"></script>
    <script src="{{ asset('js/jquery.countTo.js') }}"></script>
    <script src="{{ asset('js/isotope.js') }}"></script>
    <script src="{{ asset('js/owl.js') }}"></script>
    <script src="{{ asset('js/wow.js') }}"></script>
    <script src="{{ asset('js/jquery.fancybox.js') }}"></script>
    <script src="{{ asset('js/TweenMax.min.js') }}"></script>
    <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('js/parallax.min.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/2.1.2/js/dataTables.js"></script>

    <script>
        // Get the button, and when the user clicks on it, execute myFunction
        document.getElementById("myBtnt").onclick = function() {
            myFunction()
        };

        /* myFunction toggles between adding and removing the show class, which is used to hide and show the dropdown content */
        function myFunction() {
            document.getElementById("myDropdownt").classList.toggle("showt");
        }

        // Close the dropdown if the user clicks outside of it
        window.onclick = function(event) {

            if (!event.target.matches('.dropbtnt')) {

                var dropdowns = document.getElementsByClassName("dropdown-contentt");

                for (let i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('showt')) {
                        openDropdown.classList.remove('showt');
                    }
                }
            }
        }
    </script>

    @yield('scripts')

</body>

</html>