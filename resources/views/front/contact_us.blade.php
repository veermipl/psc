@extends('layout.master')

@section('content')
<!-- Bnner Section -->
<section class="banner-section wow bg-about">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="back-ground">
                    <h2>Contact Us</h2>
                    <div class="breadcrumbs text-center wow animate__ animate__fadeInUp animate__delay-1s animated" style="visibility: visible; animation-name: fadeInUp;">
                        <ul>
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <span class="slash"> /</span>
                            <li><a href="{{ route('contact-us') }}">Contact Us</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Bnner Section -->
<!-- ----Contact Us-- -->
<section class="historic-tow-section wow fadeInUp ">

    <div class="contactus">
        <span class="big-circle"></span>
        <img src="img/shape.png" class="square" alt="" />
        <div class="form-conatct">
            <div class="contact-info">
                <h3 class="title">Let's get in touch</h3>
                <p class="text">{!! @$settings['content'] !!}</p>

                <div class="info">
                    <p class="contact-add">Opening hours</p>
                    <div class="information">
                        <i class="fas fa-clock"></i>&nbsp&nbsp
                        <p>{{ @$settings['opening_hours'] ? $settings['opening_hours'] : '-' }}</p>
                    </div>

                    <p class="contact-add">Phone</p>
                    <div class="information">
                        <i class="fas fa-phone"></i>&nbsp&nbsp
                        {{ @$settings['phone'] ? $settings['phone'] : '-' }}
                    </div>

                    <p class="contact-add">Email</p>
                    <div class="information">
                        <i class="fas fa-envelope"></i> &nbsp &nbsp
                        {{ @$settings['email'] ? $settings['email'] : '-' }}
                    </div>

                    <p class="contact-add">Address</p>
                    <div class="information">
                        <i class="fas fa-map-marker-alt"></i> &nbsp &nbsp
                        {{ @$settings['address'] ? $settings['address'] : '-' }}
                    </div>
                </div>

                <div class="social-media">
                    <p>Connect with us :</p>
                    <div class="social-icons">
                        <a href="{{ @$settings['facebook'] ? $settings['facebook'] : '' }}" target="{{ @$settings['facebook'] ? '_blank' : '' }}">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    
                        <a href="{{ @$settings['twitter'] ? $settings['twitter'] : '' }}" target="{{ @$settings['twitter'] ? '_blank' : '' }}">
                            <i class="fab fa-twitter"></i>
                        </a>

                        <a href="{{ @$settings['instagram'] ? $settings['instagram'] : '' }}" target="{{ @$settings['instagram'] ? '_blank' : '' }}">
                            <i class="fab fa-instagram"></i>
                        </a>

                        <a href="{{ @$settings['youtube'] ? $settings['youtube'] : '' }}" target="{{ @$settings['youtube'] ? '_blank' : '' }}">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="contact-form">
                <span class="circle one"></span>
                <span class="circle two"></span>

                <form class="inputs-form" action="{{ route('contact-us-save') }}" autocomplete="off" method="post">
                    @csrf
                    @method('post')

                    <input type="hidden" name="type" value="contact_us">

                    <h3 class="title">Contact us</h3>

                    <div class="input-container mb-1">
                        <input type="text" name="name" class="input" value="{{ old('message') }}" />
                        <label for="">Username</label>
                        <span>Username</span>
                    </div>

                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <div class="input-container mb-1">
                        <input type="email" name="email" class="input" value="{{ old('email') }}"  />
                        <label for="">Email</label>
                        <span>Email</span>
                    </div>

                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <div class="input-container mb-1">
                        <input type="tel" name="phone" class="input" value="{{ old('phone') }}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" />
                        <label for="">Phone</label>
                        <span>Phone</span>
                    </div>

                    @error('phone')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <div class="input-container textarea mb-0">
                        <textarea name="message" class="input">{{ old('message') }}</textarea>
                        <label for="">Message</label>
                        <span>Message</span>
                    </div>

                    @error('message')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <input type="submit" value="Submit" class="btn-conatact mt-4" />
                </form>
            </div>
        </div>
    </div>
</section>
<!-- -----Contact us -->
@endsection