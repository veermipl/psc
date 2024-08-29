@extends('layout.admin_master')

@section('title', 'Profile')
@section('header', 'Profile')

@section('content')

    <div class="page-breadcrumb d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Profile</div>
    </div>

    <div class="row">
        <div class="col-12 col-lg-7 col-xl-8">
            <div class="card overflow-hidden radius-10">
                <div class="profile-cover bg-dark position-relative mb-4">
                    <div class="user-profile-avatar shadow position-absolute top-50 start-0 translate-middle-x">
                        <img src="{{ asset('storage/' . (@$UserDetails['profile_image'] ? @$UserDetails['profile_image'] : 'default/user.png'))}}" alt="">
                    </div>
                </div>
                <div class="card-body">
                    <div class="mt-5 d-flex align-items-start justify-content-between">
                        <div class="">
                            <h3 class="mb-2">{{ auth()->user()->name }}</h3>
                            @if (@$UserDetails['gender'])
                                <p class="mb-1">{{ ucwords(@$UserDetails['gender']) }}</p> 
                            @endif
                            @if (@$UserDetails['date_of_birth'])
                                <p class="mb-1">{{ date('jS \o\f F Y', strtotime(@$UserDetails['date_of_birth'])) }}</p>
                            @endif
                        </div>
                        <div class="d-none-">
                            <a href="{{ route('profile.edit') }}" class="btn btn-primary btn-sm">
                                Edit
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-2">About Me</h4>
                    <p class="">
                        {{ @$UserDetails['about_me'] }}
                    </p>

                </div>
            </div>
        </div>
        <div class="col-12 col-lg-5 col-xl-4">
            <div class="card radius-10">
                <div class="card-body">
                    <h5 class="mb-3">Location</h5>
                    @if (@$UserDetails['location'])
                        <p class="mb-0"><ion-icon name="compass-sharp" class="me-2"></ion-icon>{{ ucwords($UserDetails['location']) }}</p>
                    @endif
                </div>
            </div>

            <div class="card radius-10">
                <div class="card-body">
                    <h5 class="mb-3">Address</h5>
                    @if (@$UserDetails['address'])
                        <p class="mb-0"><ion-icon name="home-sharp" class="me-2"></ion-icon>{{ ucwords($UserDetails['address']) }}</p>
                    @endif
                </div>
            </div>

            <div class="card radius-10">
                <div class="card-body">
                    <h5 class="mb-3">Connect</h5>
                    @if (@$user['email'])
                        <p class=""><ion-icon name="mail-outline" class="me-2"></ion-icon>{{ @$user['email'] }}</p>
                    @endif
                    @if (@$user['mobile_number'])
                        <p class=""><ion-icon name="call-outline" class="me-2"></ion-icon>{{ @$user['mobile_number'] }}</p>
                    @endif
                    @if (@$UserDetails['connect_url'])
                        <p class=""><ion-icon name="globe-sharp" class="me-2"></ion-icon>{{ @$UserDetails['connect_url'] }}</p>
                    @endif
                    @if (@$UserDetails['connect_fb'])
                        <p class=""><ion-icon name="logo-facebook" class="me-2"></ion-icon>{{ @$UserDetails['connect_fb'] }}</p>
                    @endif
                    @if (@$UserDetails['connect_twitter'])
                        <p class=""><ion-icon name="logo-twitter" class="me-2"></ion-icon>{{ @$UserDetails['connect_twitter'] }}</p>
                    @endif
                    @if (@$UserDetails['connect_linkedin'])
                        <p class="mb-0"><ion-icon name="logo-linkedin" class="me-2"></ion-icon>{{ @$UserDetails['connect_linkedin'] }}</p>
                    @endif
                </div>
            </div>

            @if (auth()->user()->id !== 1)
                <div class="card radius-10">
                    <div class="card-body">
                        <h5 class="mb-3">Settings</h5>
                        <button class="btn btn-danger btn-sm text-light mb-3" id="statusProfileBtn" uid="{{ auth()->user()->id }}">
                            De-active Account
                        </button>
                        <button class="btn btn-danger btn-sm text-light mb-3" id="deleteProfileBtn" uid="{{ auth()->user()->id }}">
                            Delete Account
                        </button>
                    </div>
                </div>
            @endif

        </div>
    </div>

@endsection


@section('scripts')

    <script type="text/javascript">
        $(document).ready(function() {

            $(document).on('click', '#statusProfileBtn', function(e) {
                e.preventDefault();

                var uid = $(this).attr('uid');

                Swal.fire({
                    title: "Are you sure?",
                    text: "You will be logged out and your account will be de-activated",
                    icon: "warning",
                    customClass: {
                        popup: 'custom-width-popup'
                    },
                    showCancelButton: true,
                    confirmButtonText: "Yes, de-activate it!",
                    cancelButtonText: "No, cancel!",
                    reverseButtons: true,
                    confirmButtonColor: '#24695c',
                    cancelButtonColor: '#d22d3d',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('profile.status') }}",
                            method: 'POST',
                            data: {
                                _method: 'post',
                                _token: '{{ csrf_token() }}',
                                uid: uid,
                            },
                            dataType: "json",
                            beforeSend: function() {
                                $('#statusProfileBtn').prop('disabled', true).css({
                                    'cursor': 'not-allowed'
                                });
                            },
                            success: function(response) {
                                if (response.error === false) {
                                    window.location.assign(response.redirect);
                                } else {
                                    toastr.error(response.msg);
                                }
                            },
                            error: function(xhr, status, error) {
                                toastr.error(error);
                            },
                            complete: function(xhr, status) {
                            }
                        });
                    }
                });
            });

            $(document).on('click', '#deleteProfileBtn', function(e) {
                e.preventDefault();

                var uid = $(this).attr('uid');

                Swal.fire({
                    title: "Are you sure?",
                    text: "You will be logged out and your account will be deleted",
                    icon: "warning",
                    customClass: {
                        popup: 'custom-width-popup'
                    },
                    showCancelButton: true,
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel!",
                    reverseButtons: true,
                    confirmButtonColor: '#24695c',
                    cancelButtonColor: '#d22d3d',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('profile.delete') }}",
                            method: 'POST',
                            data: {
                                _method: 'post',
                                _token: '{{ csrf_token() }}',
                                uid: uid,
                            },
                            dataType: "json",
                            beforeSend: function() {
                                $('#deleteProfileBtn').prop('disabled', true).css({
                                    'cursor': 'not-allowed'
                                });
                            },
                            success: function(response) {
                                if (response.error === false) {
                                    window.location.assign(response.redirect);
                                } else {
                                    toastr.error(response.msg);
                                }
                            },
                            error: function(xhr, status, error) {
                                toastr.error(error);
                            },
                            complete: function(xhr, status) {
                            }
                        });
                    }
                });

            });
        });
    </script>

@endsection