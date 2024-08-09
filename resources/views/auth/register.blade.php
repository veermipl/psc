@extends('layout.master')

@section('title', 'Register')
@section('content')

    <style>
        .why-choose-right-content-1 {
            background: #ffffff;
            box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
            padding: 15px 30px;
            border-radius: 10px;

        }

        .vs-btn {
            background-color: rgb(239, 241, 245);
            color: var(--thm-primary);
            position: relative;
            bottom: 20px;
        }

        .pg-dowload h3 {
            color: #072d74;
            font-size: 30px;
            font-weight: 500;
            margin-bottom: 40px;
        }

        .vs-btn-2 {
            background-color: rgb(7 45 116);
            color: #ffffff;
            position: relative;
            bottom: 20px;
        }

        .text-box {
            height: 40px;
            width: 40px;
            border-radius: 50%;
            background-color: #fff;
            color: #072d74;
        }

        .text-box {
            height: 40px;
            min-width: 40px;
            border-radius: 50%;
            background-color: #fff;
            color: #072d74;
            box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            margin-right: 10px;
        }

        .Corporate-membership h3 {
            font-size: 20px;
            font-weight: 800;
            line-height: 30px;
            margin-top: 18px;
            margin-bottom: 15px;
            -webkit-transition: all 500ms ease;
            transition: all 500ms ease;
            text-transform: capitalize;
        }

        .Corporate-membership p {
            text-align: justify;
        }

        .alert-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: .25rem;
        }

        .hidden {
            display: none;
        }

        .login-box {

            width: 100%;
        }

        .main_thank {
            padding: 30px 30px 0px 30px;
        }
    </style>
    <section class="log-sect">

        <div class="container ">

            <div class="row" id="join-now-row">
                <div class="col-lg-12">
                    <div class="thm-section-title text-center">
                        <h4 class="sub-title-shape-left section_title-subheading">

                        </h4>
                        <h2>Join Now</h2>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-1"></div>
                <div class="col-lg-10">

                    @if (session('status'))
                        <div class="alert alert-success main_thank">
                            {{ session('status') }}
                            <div class=" text-center my-4 pt-4">
                                <a href="{{ route('login') }}" class="btn btn-primary vs-btn vs-btn-2 mx-3">Login <i
                                        class="far fa-long-arrow-right"></i></a>
                                <a href="{{ route('home') }}" class="btn btn-secondary vs-btn">Back to Home Page <i
                                        class="far fa-long-arrow-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-1"></div>
                </div>
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    // Hides the specific rows using their IDs
                    // document.getElementById('join-now-row').classList.add('hidden');
                    document.getElementById('register-row').classList.add('hidden');
                });
            </script>
            @endif
            <div class="row" id="register-row">

                <div class="col-md-6">
                    <div class="login-box">
                        <h1> <span class="text-box">1</span> Download Form</h1>


                        <div class="download-box">
                            <div class="Corporate-membership ">
                                <h3>
                                    Corporate Membership</h3>
                                <p>A Corporate Member is any private sector company, or any firm, establishment,
                                    partnership, group, or private sector incorporated or registered in Guyana, and
                                    affiliated to a minimum of two (2) Sectoral or Representative Associations that are
                                    members of the Commission.</p>
                                <a href="{{ asset('forms/psc-application-form-new.pdf') }}" download>
                                    <button class="vs-btn vs-btn-2 style3 view-btns mt-4">Download <i
                                            class="far fa-long-arrow-right"></i></button>
                                </a>
                            </div>

                            <div class="Corporate-membership ">
                                <h3>
                                    Sectoral Corporate Membership</h3>
                                <p>A Sectoral or Representative Association is any agency, organization or institution
                                    registered in Guyana which represents particular categories of Private Sector endeavors
                                    such as (but not limited to) Agriculture, Aquaculture, Commerce, Engineering, Forestry,
                                    Industry, Insurance, Manufacturing, Mining, Services, Small Businesses and Trade.</p>
                                <a href="{{ asset('forms/psc-application-form-new.pdf') }}" download>
                                    <button class=" vs-btn style3 vs-btn-2 view-btn  mt-4">Download <i
                                            class="far fa-long-arrow-right"></i></button>
                                </a>
                                <div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 loginn">
                    <div class="login-box">
                        <h1> <span class="text-box">2</span>Register</h1>

                        <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data" class="dropzone" id="my-dropzone">
                            @csrf
                            @method('post')

                            <div class="row">

                                <div class="col-lg-12">
                                    <div class="textbox">
                                        <label for="name">Name <span class="text-danger">*</span></label>
                                        <input type="text" id="name" class="form-control" name="name"
                                            placeholder="Enter your name" value="{{ old('name') }}" maxlength="50"
                                            required>
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="textbox">
                                        <label for="email">Email <span class="text-danger">*</span></label>
                                        <input type="email" id="email" class="form-control" name="email"
                                            value="{{ old('email') }}" placeholder=" Your email" maxlength="50" required>
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="textbox">
                                        <label for="number">Contact Number <span class="text-danger">*</span></label>
                                        <input type="text" id="number" class="form-control" name="number"
                                            value="{{ old('number') }}" placeholder="Enter Your Contact Number"
                                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                            required>
                                        @error('number')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="textbox">
                                        <label for="password">Password <span class="text-danger">*</span></label>
                                        <input type="password" id="password" class="form-control" name="password"
                                            maxlength="50" value="{{ old('password') }}" placeholder="********" required>
                                        @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="textbox">
                                        <label for="confirmed">Confirmation Password<span
                                                class="text-danger">*</span></label>
                                        <input type="password" id="confirmed" class="form-control"
                                            name="password_confirmation" value="{{ old('confirm_password') }}"
                                            placeholder="*******" maxlength="50" required>
                                        @error('confirmed')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="textbox">
                                        <label for="membership_type">Membership Type <span
                                                class="text-danger">*</span></label>
                                        <select id="membership_type" class="form-control" name="membership_type"
                                            required>
                                            <option value="" disabled selected>Select Membership Type</option>
                                            @foreach ($membershipList as $membership)
                                                <option value="{{ $membership['id'] }}"
                                                    {{ old('membership_type') == $membership['id'] ? 'selected' : '' }}>
                                                    {{ $membership['name'] }}
                                                </option>
                                            @endforeach
                                        </select>

                                        @error('membership_type')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-12 mb-2">
                                    <div class="textbox mb-0">
                                        <label for="form_pdf">Upload filled form <span
                                                class="text-danger">*</span></label>
                                        <input type="file" id="form_pdf" class="form-control" name="form_pdf"
                                            accept="application/pdf" required>
                                        @error('form_pdf')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="textbox mb-0">
                                        <label for="supported_files">Upload Supporting Documents <span class="text-danger">*</span></label>
                                        <input type="file" id="supporting_document" class="form-control" name="supporting_document[]" accept="application/pdf" multiple>

                                        @error('supporting_document')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <p class="text-danger "
                                        style="font-size: 14px; font-size: 14px;line-height: 20px;padding-top: 10px;">
                                        Downloaded desired membership type form from section 1 and after filling it upload
                                        that form here.
                                    </p>
                                </div>

                            </div>

                            <button type="submit" class="btn">Apply Now</button>
                            <a href="{{ route('login') }}" class="forgot">Already Registered?</a>
                        </form>
                    </div>
                </div>
            </div>
    </section>
@endsection
