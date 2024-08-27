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
                    </div>
                </div>
                <div class="card-body">
                    <div class="mt-5 d-flex align-items-start justify-content-between">
                        <div class="">
                            <h3 class="mb-2">{{ auth()->user()->name }}</h3>
                            <p class="mb-1">Private Sector Commission</p>
                            <p>157 Waterloo St, Georgetown, Guyana</p>
                        </div>
                        <div class="d-none">
                            <a href="{{ route('profile') }}" class="btn btn-primary btn-sm"><ion-icon
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
                        Private Sector Commission (PSC) involves a strategic approach to communicating the
                        organization's goals, policies, and initiatives to diverse stakeholders, including businesses,
                        government bodies, and the general public. Effective content must reflect the PSC's mission to
                        advocate for private sector interests while fostering economic growth and sustainable development.
                    </p>
                    <p>
                        Key skills in this area include the ability to craft compelling narratives that resonate with target
                        audiences, whether through reports, press releases, social media posts, or multimedia content.
                    </p>

                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4 col-xl-3">
            <div class="card radius-10">
                <div class="card-body">
                    <h5 class="mb-3">Location</h5>
                    <p class="mb-0"><ion-icon name="compass-sharp" class="me-2"></ion-icon>Guyana's</p>
                </div>
            </div>

            <div class="card radius-10">
                <div class="card-body">
                    <h5 class="mb-3">Connect</h5>
                    <p class=""><ion-icon name="globe-sharp" class="me-2"></ion-icon>www.psc.gy.com</p>
                    <p class=""><ion-icon name="logo-facebook" class="me-2"></ion-icon>Facebook</p>
                    <p class=""><ion-icon name="logo-twitter" class="me-2"></ion-icon>Twitter</p>
                    <p class="mb-0"><ion-icon name="logo-linkedin" class="me-2"></ion-icon>LinkedIn</p>
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
