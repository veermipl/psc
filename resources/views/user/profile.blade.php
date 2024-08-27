@extends('layout.admin_master')

@section('title', 'Profile')
@section('header', 'Profile')

@section('content')

    <div class="page-breadcrumb d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Profile</div>
    </div>

    <div class="row">
        <div class="col-12 col-lg-8 col-xl-9">
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
                            <p class="mb-1">{{ @$UserDetails['gender'] }}</p>
                            <p class="mb-1">{{ @$UserDetails['address'] }}</p>
                        </div>
                        <div class="d-none-">
                            <a href="{{ route('profile.edit') }}" class="btn btn-primary btn-sm"><ion-icon
                                    name="pencil"></ion-icon>
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
        <div class="col-12 col-lg-4 col-xl-3">
            <div class="card radius-10">
                <div class="card-body">
                    <h5 class="mb-3">Location</h5>
                    @if (@$UserDetails['location'])
                        <p class="mb-0"><ion-icon name="compass-sharp" class="me-2"></ion-icon>{{ $UserDetails['location'] }}</p>
                    @endif
                </div>
            </div>

            <div class="card radius-10">
                <div class="card-body">
                    <h5 class="mb-3">Connect</h5>
                    @if (@$user['email'])
                        <p class="mb-0"><ion-icon name="mail-outline" class="me-2"></ion-icon>{{ @$user['email'] }}</p>
                    @endif
                    @if (@$user['mobile_number'])
                        <p class="mb-0"><ion-icon name="call-outline" class="me-2"></ion-icon>{{ @$user['mobile_number'] }}</p>
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
                        <button class="btn btn-danger btn-sm text-light mb-3" id="statusProfileBtn"><ion-icon
                                name="close"></ion-icon>
                            De-active Account
                        </button>
                        <button class="btn btn-danger btn-sm text-light mb-3" id="deleteProfileBtn"><ion-icon
                                name="trash"></ion-icon>
                            Delete Account
                        </button>
                    </div>
                </div>
            @endif

        </div>
    </div>

@endsection
