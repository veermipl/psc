@php
    $notifications = helper_getUnreadNotifications();
    $user_details = helper_getUserDetails(auth()->user()->id);
    $settings_app_name = helper_getSettings('app_name');
    $settings_app_logo = helper_getSettings('app_logo');
@endphp


<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title')</title>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon" />

    <!-- loader-->
    <link href="{{ asset('admin/css/pace.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('admin/js/pace.min.js') }}"></script>

    <!--plugins-->
    <link href="{{ asset('admin/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />

    <!-- CSS Files -->
    <link href="{{ asset('admin/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/bootstrap-extended.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/icons.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">

    <!--Theme Styles-->
    <link href="{{ asset('admin/css/dark-theme.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/css/semi-dark.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/css/header-colors.css') }}" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.1.2/css/dataTables.dataTables.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-table@1.23.2/dist/bootstrap-table.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/43.0.0/ckeditor5.css" />

    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/dropzone.min.css" rel="stylesheet"> --}}
    {{-- <link href="{{ asset('css/dropzone.css') }}" rel="stylesheet" /> --}}

    @yield('css')
</head>

<body>


    <!--start wrapper-->
    <div class="wrapper">
        <!--start sidebar -->
        <aside class="sidebar-wrapper" data-simplebar="true">
            <div class="sidebar-header">
                <div>
                    <img src="{{ asset('storage/' . ($settings_app_logo ? $settings_app_logo : 'default/logo.png'))}}" class="logo-icon" alt="">
                </div>
                <div>
                    <h6 class="logo-text">{{ $settings_app_name }}</h6>
                </div>
                <div class="toggle-icon ms-auto"><ion-icon name="menu-sharp"></ion-icon>
                </div>
            </div>
            <!--navigation-->
            <ul class="metismenu" id="menu">
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="">
                        <div class="parent-icon"><ion-icon name="home-sharp"></ion-icon></div>
                        <div class="menu-title">Dashboard</div>
                    </a>
                </li>

                <li class="{{ request()->is('admin/user') || request()->is('admin/user/*') ? 'mm-active' : '' }}">
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><ion-icon name="people-sharp"></ion-icon></div>
                        <div class="menu-title">Users</div>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('admin.user.index') }}"><ion-icon name="ellipse-outline"></ion-icon>List</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.user.create') }}"><ion-icon name="ellipse-outline"></ion-icon>Create User</a>
                        </li>

                    </ul>
                </li>

                <li class="{{ request()->is('admin/member') || request()->is('admin/member/*') ? 'mm-active' : '' }}">
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><ion-icon name="people-sharp"></ion-icon></div>
                        <div class="menu-title">Members</div>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('admin.member.index') }}"><ion-icon name="ellipse-outline"></ion-icon>List</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.member.create') }}"><ion-icon name="ellipse-outline"></ion-icon>Create Member</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.member.import') }}"><ion-icon name="ellipse-outline"></ion-icon>Import Members</a>
                        </li>
                    </ul>
                </li>

                <li class="{{ request()->is('admin/data/*') ? 'mm-active' : '' }}">
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><ion-icon name="bar-chart-sharp"></ion-icon></div>
                        <div class="menu-title">Data</div>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('admin.data.national-budget') }}"><ion-icon name="ellipse-outline"></ion-icon>National Budgets</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.data.trade-data') }}"><ion-icon name="ellipse-outline"></ion-icon>Trade Data</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.data.coted') }}"><ion-icon name="ellipse-outline"></ion-icon>COTED</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.data.caricom-cet') }}"><ion-icon name="ellipse-outline"></ion-icon>Caricom CET</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a class="has-arrow" href="javascript:;">
                        <div class="parent-icon"><ion-icon name="document-sharp"></ion-icon></div>
                        <div class="menu-title">Resources</div>
                    </a>
                    <ul>
                        <li>
                            <a href="#"><ion-icon name="ellipse-outline"></ion-icon>
                                Business Readinedss Desk
                            </a>
                        </li>
                        <li>
                            <a href="#"><ion-icon name="ellipse-outline"></ion-icon>
                                Go Invest
                            </a>
                        </li>
                        <li>
                            <a href="#"><ion-icon name="ellipse-outline"></ion-icon>
                                IDB Invest
                            </a>
                        </li>
                        <li>
                            <a href="#"><ion-icon name="ellipse-outline"></ion-icon>
                                Procurement Process In Guyana
                            </a>
                        </li>
                        <li>
                            <a href="#"><ion-icon name="ellipse-outline"></ion-icon>
                                Certificate Of Origins
                            </a>
                        </li>
                        <li>
                            <a href="#"><ion-icon name="ellipse-outline"></ion-icon>
                                Annual Reports
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="{{ request()->is('admin/media-center/*') ? 'mm-active' : '' }}">
                    <a class="has-arrow" href="javascript:;">
                        <div class="parent-icon"><ion-icon name="play-circle-sharp"></ion-icon>
                        </div>
                        <div class="menu-title">Media Center</div>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('admin.media-center.news.index') }}"><ion-icon name="ellipse-outline"></ion-icon>
                                News
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.media-center.press-release.index') }}"><ion-icon name="ellipse-outline"></ion-icon>
                                Press Release
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.media-center.social-media.index') }}"><ion-icon name="ellipse-outline"></ion-icon>
                                Social Media
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.media-center.photo.index') }}"><ion-icon name="ellipse-outline"></ion-icon>
                                Photos
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.media-center.video.index') }}"><ion-icon name="ellipse-outline"></ion-icon>
                                Videos
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="{{ request()->is('admin/membership/*') ? 'mm-active' : '' }}">
                    <a class="has-arrow" href="javascript:;">
                        <div class="parent-icon"><ion-icon name="key-sharp"></ion-icon></div>
                        <div class="menu-title">Membership</div>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('admin.membership.type.index') }}"><ion-icon name="ellipse-outline"></ion-icon>
                                Type
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.membership.business-directory.index') }}"><ion-icon name="ellipse-outline"></ion-icon>
                                Business Directory
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.membership.member-benefit') }}"><ion-icon name="ellipse-outline"></ion-icon>
                                Member Benefits
                            </a>
                        </li>

                    </ul>
                </li>

                <li>
                    <a class="has-arrow" href="javascript:;">
                        <div class="parent-icon"><ion-icon name="server-sharp"></ion-icon></div>
                        <div class="menu-title">About us</div>
                    </a>
                    <ul>
                        <li>
                            <a href="#"><ion-icon name="ellipse-outline"></ion-icon>
                                Staff
                            </a>
                        </li>
                        <li>
                            <a href="#"><ion-icon name="ellipse-outline"></ion-icon>
                                Council
                            </a>
                        </li>
                        <li>
                            <a href="#"><ion-icon name="ellipse-outline"></ion-icon>
                                History
                            </a>
                        </li>
                        <li>
                            <a href="#"><ion-icon name="ellipse-outline"></ion-icon>
                                Committees
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="{{ request()->is('admin/cms/*') ? 'mm-active' : '' }}">
                    <a class="has-arrow" href="javascript:;">
                        <div class="parent-icon"><ion-icon name="create-sharp"></ion-icon></div>
                        <div class="menu-title">CMS</div>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('admin.cms.guyana-economy') }}"><ion-icon name="ellipse-outline"></ion-icon>
                                Guyana Economy
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="{{ request()->is('admin/authorization/*') ? 'mm-active' : '' }}">
                    <a class="has-arrow" href="javascript:;">
                        <div class="parent-icon"><ion-icon name="lock-closed-sharp"></ion-icon></div>
                        <div class="menu-title">Authorization</div>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('admin.authorization.role.index') }}"><ion-icon name="ellipse-outline"></ion-icon>
                                Roles
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.authorization.permission.index') }}"><ion-icon name="ellipse-outline"></ion-icon>
                                Permissions
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="{{ request()->is('admin/settings/*') ? 'mm-active' : '' }}">
                    <a class="has-arrow" href="javascript:;">
                        <div class="parent-icon"><ion-icon name="settings-sharp"></ion-icon></div>
                        <div class="menu-title">Settings</div>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('admin.settings.general') }}"><ion-icon name="ellipse-outline"></ion-icon>General</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.settings.email') }}"><ion-icon name="ellipse-outline"></ion-icon>Email</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.settings.contact-us') }}"><ion-icon name="ellipse-outline"></ion-icon>Contact Us</a>
                        </li>
                    </ul>
                </li>

                <li class="{{ request()->is('admin/system/*') ? 'mm-active' : '' }}">
                    <a class="has-arrow" href="javascript:;">
                        <div class="parent-icon"><ion-icon name="hammer-sharp"></ion-icon></div>
                        <div class="menu-title">System</div>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('admin.system.notification.index') }}"><ion-icon name="ellipse-outline"></ion-icon>Notifications</a>
                        </li>
                        <li>
                            <a href="#"><ion-icon name="ellipse-outline"></ion-icon>Recover Account</a>
                        </li>
                    </ul>
                </li>

        </aside>
        <!--end sidebar -->

        <!--start top header-->
        <header class="top-header">
            <nav class="navbar navbar-expand gap-3">
                <div class="mobile-menu-button"><ion-icon name="menu-sharp"></ion-icon></div>
                <form class="searchbar">
                    <div class="position-absolute top-50 translate-middle-y search-icon ms-3"><ion-icon
                            name="search-sharp"></ion-icon></div>
                    <input class="form-control" type="text" placeholder="Search for anything">
                    <div class="position-absolute top-45 translate-middle-y search-close-icon"><ion-icon
                            name="close-sharp"></ion-icon></div>
                </form>
                <div class="top-navbar-right ms-auto">
                    <ul class="navbar-nav align-items-center">
                        <li class="nav-item mobile-search-button">
                            <a class="nav-link" href="javascript:;">
                                <div class="">
                                    <ion-icon name="search-sharp"></ion-icon>
                                </div>
                            </a>
                        </li>

                        <li class="nav-item dropdown dropdown-large">
                            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;"
                                data-bs-toggle="dropdown">
                                <div class="position-relative">
                                    @if (count($notifications) > 0)
                                        <span class="notify-badge">{{ count($notifications) }}</span>
                                    @endif
                                    <ion-icon name="notifications-sharp"></ion-icon>
                                </div>
                            </a>
                            @if (count($notifications) > 0)
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a href="javascript:;">
                                        <div class="msg-header">
                                            <p class="msg-header-title">Notifications</p>
                                            <a href="{{ route('admin.system.notification.mark-all-as-read') }}" class="msg-header-clear ms-auto">
                                                Marks all as read
                                            </a>
                                        </div>
                                    </a>
                                    <div class="header-notifications-list">
                                        @foreach($notifications as $notKey => $notVal)
                                            @php
                                                $notVal_time = $notVal->created_at->diffForHumans();
                                            @endphp
                                            <a class="dropdown-item notification_link" href="{{ $notVal['link'] }}">
                                                <div class="d-flex align-items-center">
                                                    @if(in_array($notVal['type'], ['user_created', 'member_created', 'member_registration']))
                                                        <div class="notify text-danger">
                                                            <ion-icon name="person-outline"></ion-icon>
                                                        </div>
                                                    @endif
                                                    <div class="flex-grow-1">
                                                        <h6 class="msg-name">{{ $notVal['title'] }}
                                                            <span class="msg-time float-end">{{ $notVal_time }}</span>
                                                        </h6>
                                                        <p class="msg-info">{{ $notVal['message'] }}</p>
                                                    </div>
                                                </div>
                                            </a>
                                        @endforeach
                                    </div>
                                    <a href="{{ route('admin.system.notification.index') }}">
                                        <div class="text-center msg-footer">View All Notifications</div>
                                    </a>
                                </div>
                            @else
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a href="javascript:;">
                                        <div class="msg-header">
                                            <p class="msg-header-title">Notifications</p>
                                        </div>
                                    </a>
                                    <div class="header-notifications-list">
                                        <div class="text-center mt-3">
                                            <p class="m-0 p-0">No Notifications</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </li>

                        <li class="nav-item dropdown dropdown-user-setting">
                            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;"
                                data-bs-toggle="dropdown">
                                <div class="user-setting">
                                    <img src="{{ asset('storage/' . ($user_details ? $user_details['profile_image'] : 'default/user.png'))}}" class="user-img" alt="">
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="{{ route('profile') }}">
                                        <div class="d-flex align-items-center">
                                            <div class=""><ion-icon name="person-outline"></ion-icon></div>
                                            <div class="ms-3"><span>Profile</span></div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                        <div class="d-flex align-items-center">
                                            <div class=""><ion-icon name="speedometer-outline"></ion-icon></div>
                                            <div class="ms-3"><span>Dashboard</span></div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <span class="dropdown-item">
                                        <div class="d-flex align-items-center">
                                            <div class=""><ion-icon name="log-out-outline"></ion-icon></div>
                                            <div class="ms-3">
                                                <form action="{{ route('logout') }}" method="post">
                                                    @csrf
                                                    @method('post')
                                                    <button class="btn-sm btn btn-light p-0"><span>Logout</span></button>
                                                </form>
                                            </div>
                                        </div>
                                    </span>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </div>
            </nav>
        </header>
        <!--end top header-->

        <!-- start page content wrapper-->
        <div class="page-content-wrapper">
            <!-- start page content-->
            <div class="page-content">
                @yield('content')
            </div>
            <!-- end page content-->
        </div>
        <!--end page content wrapper-->

        <!--start footer-->
        <footer class="footer">
            <div class="footer-text">
                Copyright © 2024. All right reserved.
            </div>
        </footer>
        <!--end footer-->

        <!--Start Back To Top Button-->
        <a href="javaScript:;" class="back-to-top"><ion-icon name="arrow-up-outline"></ion-icon></a>
        <!--End Back To Top Button-->

        <!--start overlay-->
        <div class="overlay"></div>
        <!--end overlay-->

    </div>
    <!--end wrapper-->


    <!-- JS Files-->
    <script src="{{ asset('admin/js/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/simplebar/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/metismenu/js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('admin/js/bootstrap.bundle.min.js') }}"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <!--plugins-->
    <script src="{{ asset('admin/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('admin/plugins/chartjs/chart.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/apexcharts-bundle/js/apexcharts.min.js') }}"></script>
    <script src="{{ asset('admin/js/index2.js') }}"></script>
    <!-- Main JS-->
    <script src="{{ asset('admin/js/main.js') }}"></script>

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

    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script> --}}
    <script type="text/javascript" src="https://cdn.datatables.net/2.1.2/js/dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-table@1.23.2/dist/bootstrap-table.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/min/dropzone.min.js"></script> --}}
    {{-- <script src="{{ asset('js/dropzone.js') }}"></script> --}}

    <script type="importmap">
        {
            "imports": {
                "ckeditor5": "https://cdn.ckeditor.com/ckeditor5/43.0.0/ckeditor5.js",
                "ckeditor5/": "https://cdn.ckeditor.com/ckeditor5/43.0.0/"
            }
        }
    </script>
    <script type="module">
        import {
            ClassicEditor,
            Essentials,
            Bold,
            Italic,
            Font,
            Paragraph
        } from 'ckeditor5';

        ClassicEditor
            .create(document.querySelector('#editor'), {
                plugins: [Essentials, Bold, Italic, Font, Paragraph],
                toolbar: {
                    items: [
                        'undo', 'redo', '|', 'bold', 'italic', '|',
                        'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor'
                    ]
                }
            })
            .then( /* ... */ )
            .catch( /* ... */ );
    </script>


    @if (session('success'))
        <script>
            toastr.success("{{ session('success') }}");
        </script>
    @endif

    @if (session('error'))
        <script>
            toastr.error("{{ session('error') }}");
        </script>
    @endif

    @if (session('status'))
    <script>
        toastr.success("{{ session('status') }}");
    </script>
    @endif

    <script>
        //sub_page_body
        $(document).on('click', '.sub_page_link', function(e) {
            e.preventDefault();

            var target_id = $(this).data('target');
            console.log(target_id);

            if (target_id) {
                toggle_sub_page(target_id);
            }

        });

        //sub_page_body_toggle
        function toggle_sub_page(target_id = null) {
            if (target_id) {
                //btn
                $('.sub_page_link').removeClass('btn-custom').addClass('btn-outline-custom');
                $('#sub_page_link_' + target_id + '').removeClass('btn-outline-custom').addClass('btn-custom');

                //body
                $('.sub_page_body').removeClass('show').addClass('hide');
                $('#sub_page_body_' + target_id + '').removeClass('hide').addClass('show');
            }
        }
    </script>

    @yield('scripts')

</body>

</html>
