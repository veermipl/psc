<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>@yield('title')</title>

    <!-- Responsive -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />

    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/magnific-popup.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/sidebars.css') }}" rel="stylesheet" />

    <link rel="icon" href="images/favicon.png" type="image/x-icon" />

    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&amp;display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@300;400;500;600;700;800;900&amp;display=swap"
        rel="stylesheet" />
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
            <div class="preloader">
                <i class="fa fa-spinner fa-spin"></i>
            </div>
        </div>
        <!-- End Preloader -->

        <!-- Main Header-->
        <header class="main-header">
            <div class="header_top">
                <div class="auto-container p-0">
                    <div class="row">
                        <div class="col-xl-12 p-0">
                            <div class="header_top_inner clearfix">
                                <div class="header_top_one_box pull-left">
                                    <ul>
                                        <li class="desk_logo">
                                            <a href="{{ route('home') }}">
                                                <img src="{{ asset('images/Gover-website/logo-other.png') }}"
                                                    alt="logo" />
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="header_top_two_box pull-right">
                                    <div class="opening_hour">
                                        <div class="js">
                                            <div class="language-picker js-language-picker"
                                                data-trigger-class="btn btn--subtle">
                                                <div id="google_translate_element"></div>
                                            </div>
                                        </div>
                                    </div>
                                    @auth
                                        <div class="d-flex">
                                            <a href="{{ route('admin.dashboard') }}"
                                                class="btn btn-sm btn-outline-light">Dashboard</a>

                                            <div class="ml-2">
                                                <form action="{{ route('logout') }}" method="post">
                                                    @csrf
                                                    <button type="btn" class="btn btn-danger btn-sm">
                                                        <i class="far fa-lock"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    @endauth
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


        <div class="flex-shrink-0 p-3 bg-light" id="side-bar">
            <div class="d-flex_ text-right" id="close_side_bar_wrapper">
                {{-- <a href="{{ route('home') }}">
                    <img src="{{ asset('images/Gover-website/logo-other.png') }}" alt="logo" width="50" height="50" />
                </a> --}}
                <button id="close_side_bar" toggle="open">
                    <i class="fa fa-bars"></i>
                </button>
            </div>
            <li class="border-top my-3"></li>

            <ul class="list-unstyled p-0" id="side-bar-full">
                <li class="mb-1 rounded {{ request()->is('admin/dashboard') ? 'link-active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}" class="btn">
                        <i class="fa fa-home pr-2"></i>Dashboard
                    </a>
                </li>
                <li class="mb-1">
                    <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse"
                        data-bs-target="#users-collapse" aria-expanded="false">
                        Users
                    </button>
                    <div class="collapse {{ request()->is('admin/user') || request()->is('admin/user/*') ? 'show' : '' }}"
                        id="users-collapse">
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                            <li class="rounded {{ request()->is('admin/user') ? 'link-active' : 'no' }}">
                                <a href="{{ route('admin.user.index') }}" class="link-dark rounded">List</a>
                            </li>
                            <li class="rounded {{ request()->is('admin/user/create') ? 'link-active' : 'no' }}">
                                <a href="{{ route('admin.user.create') }}" class="link-dark rounded">Create</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="mb-1">
                    <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse"
                        data-bs-target="#membership-collapse" aria-expanded="false">
                        Membership
                    </button>
                    <div class="collapse {{ request()->is('admin/membership/*') ? 'show' : '' }}"
                        id="membership-collapse">
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                            <li class="rounded {{ request()->is('admin/') ? 'link-active' : 'no' }}">
                                <a href="#" class="link-dark rounded">Business Directory</a>
                            </li>
                            <li class="rounded {{ request()->is('admin/') ? 'link-active' : 'no' }}">
                                <a href="#" class="link-dark rounded">Member Benefits</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="mb-1">
                    <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse"
                        data-bs-target="#data-collapse" aria-expanded="false">
                        Data
                    </button>
                    <div class="collapse {{ request()->is('admin/data/*') ? 'show' : '' }}" id="data-collapse">
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                            <li class="rounded {{ request()->is('admin/') ? 'link-active' : 'no' }}">
                                <a href="#" class="link-dark rounded">National Budgets</a>
                            </li>
                            <li class="rounded {{ request()->is('admin/') ? 'link-active' : 'no' }}">
                                <a href="#" class="link-dark rounded">Trade Data</a>
                            </li>
                            <li class="rounded {{ request()->is('admin/') ? 'link-active' : 'no' }}">
                                <a href="#" class="link-dark rounded">COTED</a>
                            </li>
                            <li class="rounded {{ request()->is('admin/') ? 'link-active' : 'no' }}">
                                <a href="#" class="link-dark rounded">Caricom CET</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="mb-1">
                    <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse"
                        data-bs-target="#resources-collapse" aria-expanded="false">
                        Resources
                    </button>
                    <div class="collapse {{ request()->is('admin/resources/*') ? 'show' : '' }}"
                        id="resources-collapse">
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                            <li class="rounded {{ request()->is('admin/') ? 'link-active' : 'no' }}">
                                <a href="#" class="link-dark rounded">Business Readinedss Desk</a>
                            </li>
                            <li class="rounded {{ request()->is('admin/') ? 'link-active' : 'no' }}">
                                <a href="#" class="link-dark rounded">Go Invest</a>
                            </li>
                            <li class="rounded {{ request()->is('admin/') ? 'link-active' : 'no' }}">
                                <a href="#" class="link-dark rounded">IDB Invest</a>
                            </li>
                            <li class="rounded {{ request()->is('admin/') ? 'link-active' : 'no' }}">
                                <a href="#" class="link-dark rounded">Procurement Process In Guyana</a>
                            </li>
                            <li class="rounded {{ request()->is('admin/') ? 'link-active' : 'no' }}">
                                <a href="#" class="link-dark rounded">Certificate Of Origins</a>
                            </li>
                            <li class="rounded {{ request()->is('admin/') ? 'link-active' : 'no' }}">
                                <a href="#" class="link-dark rounded">Annual Reports</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="mb-1">
                    <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse"
                        data-bs-target="#media-collapse" aria-expanded="false">
                        Media
                    </button>
                    <div class="collapse {{ request()->is('admin/media/*') ? 'show' : '' }}" id="media-collapse">
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                            <li class="rounded {{ request()->is('admin/') ? 'link-active' : 'no' }}">
                                <a href="#" class="link-dark rounded">News</a>
                            </li>
                            <li class="rounded {{ request()->is('admin/') ? 'link-active' : 'no' }}">
                                <a href="#" class="link-dark rounded">Press Release</a>
                            </li>
                            <li class="rounded {{ request()->is('admin/') ? 'link-active' : 'no' }}">
                                <a href="#" class="link-dark rounded">Social Media</a>
                            </li>
                            <li class="rounded {{ request()->is('admin/') ? 'link-active' : 'no' }}">
                                <a href="#" class="link-dark rounded">Photos</a>
                            </li>
                            <li class="rounded {{ request()->is('admin/') ? 'link-active' : 'no' }}">
                                <a href="#" class="link-dark rounded">Videos</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="mb-1">
                    <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse"
                        data-bs-target="#about_us-collapse" aria-expanded="false">
                        About Us
                    </button>
                    <div class="collapse {{ request()->is('admin/about-us/*') ? 'show' : '' }}"
                        id="about_us-collapse">
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                            <li class="rounded {{ request()->is('admin/') ? 'link-active' : 'no' }}">
                                <a href="#" class="link-dark rounded">Staff</a>
                            </li>
                            <li class="rounded {{ request()->is('admin/') ? 'link-active' : 'no' }}">
                                <a href="#" class="link-dark rounded">Council</a>
                            </li>
                            <li class="rounded {{ request()->is('admin/') ? 'link-active' : 'no' }}">
                                <a href="#" class="link-dark rounded">History</a>
                            </li>
                            <li class="rounded {{ request()->is('admin/') ? 'link-active' : 'no' }}">
                                <a href="#" class="link-dark rounded">Committees</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="mb-1">
                    <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse"
                        data-bs-target="#cms-collapse" aria-expanded="false">
                        CMS
                    </button>
                    <div class="collapse {{ request()->is('admin/cms/*') ? 'show' : '' }}" id="cms-collapse">
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                            <li class="rounded {{ request()->is('admin/') ? 'link-active' : 'no' }}">
                                <a href="#" class="link-dark rounded">Guyana Economy</a>
                            </li>
                            <li class="rounded {{ request()->is('admin/cms/contact-us') ? 'link-active' : 'no' }}">
                                <a href="{{ route('admin.cms.contact-us') }}" class="link-dark rounded">Contact
                                    Us</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="mb-1 pb-5">
                    <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse"
                        data-bs-target="#settings-collapse" aria-expanded="false">
                        Settings
                    </button>
                    <div class="collapse {{ request()->is('admin/settings/*') ? 'show' : '' }}"
                        id="settings-collapse">
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                            <li class="rounded {{ request()->is('admin/') ? 'link-active' : 'no' }}">
                                <a href="#" class="link-dark rounded">General Settings</a>
                            </li>
                            <li class="rounded">
                                <a href="#" class="link-danger rounded">Sign out</a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>

            <ul class="list-unstyled p-0" id="side-bar-half">
                <li class="mb-1 rounded {{ request()->is('admin/dashboard') ? 'link-active' : '' }}">
                    <a href="#" class="btn" aria-current="page" title="Home"
                        data-bs-toggle="tooltip" data-bs-placement="right">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li class="mb-1 rounded {{ request()->is('admin/user') ? 'show' : '' }}">
                    <a href="#" class="btn" aria-current="page" title="Users"
                        data-bs-toggle="tooltip" data-bs-placement="right">
                        <i class="fa fa-users"></i>
                    </a>
                </li>
                <li class="mb-1 rounded {{ request()->is('admin/user') ? 'show' : '' }}">
                    <a href="#" class="btn" aria-current="page" title="Membership"
                        data-bs-toggle="tooltip" data-bs-placement="right">
                        <i class="fa fa-bell"></i>
                    </a>
                </li>
                <li class="mb-1 rounded {{ request()->is('admin/user') ? 'show' : '' }}">
                    <a href="#" class="btn" aria-current="page" title="Data"
                        data-bs-toggle="tooltip" data-bs-placement="right">
                        <i class="fa fa-server"></i>
                    </a>
                </li>
                <li class="mb-1 rounded {{ request()->is('admin/user') ? 'show' : '' }}">
                    <a href="#" class="btn" aria-current="page" title="Resources"
                        data-bs-toggle="tooltip" data-bs-placement="right">
                        <i class="fa fa-database"></i>
                    </a>
                </li>
                <li class="mb-1 rounded {{ request()->is('admin/user') ? 'show' : '' }}">
                    <a href="#" class="btn" aria-current="page" title="Media"
                        data-bs-toggle="tooltip" data-bs-placement="right">
                        <i class="fa fa-rss"></i>
                    </a>
                </li>
                <li class="mb-1 rounded {{ request()->is('admin/user') ? 'show' : '' }}">
                    <a href="#" class="btn" aria-current="page" title="About Us"
                        data-bs-toggle="tooltip" data-bs-placement="right">
                        <i class="fa fa-info"></i>
                    </a>
                </li>
                <li class="mb-1 rounded {{ request()->is('admin/user') ? 'show' : '' }}">
                    <a href="#" class="btn" aria-current="page" title="CMS"
                        data-bs-toggle="tooltip" data-bs-placement="right">
                        <i class="fa fa-cogs"></i>
                    </a>
                </li>
                <li class="mb-1 rounded {{ request()->is('admin/user') ? 'show' : '' }}">
                    <a href="#" class="btn" aria-current="page" title="Settings"
                        data-bs-toggle="tooltip" data-bs-placement="right">
                        <i class="fa fa-cog"></i> 
                    </a>
                </li>
            </ul>
        </div>



        <div id="content">
            {{-- <header class="bg-white shadow mb-3">
                <div class="py-3 px-4">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">@yield('header')</h2>
                </div>
            </header> --}}

            @yield('content')
        </div>



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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/sidebars.js') }}"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/2.1.2/js/dataTables.js"></script>

    @yield('scripts')

</body>

</html>
