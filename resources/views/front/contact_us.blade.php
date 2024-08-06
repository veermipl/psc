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
                            <li><a href="index.html">Home</a></li>
                            <span class="slash"> /</span>
                            <li><a href="about.html">Contact Us</a></li>
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
                <p class="text">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe
                    dolorum adipisci recusandae praesentium dicta!
                </p>

                <div class="info">
                    <p class="contact-add">Opening hours</p>
                    <div class="information">

                        <i class="fas fa-clock"></i>&nbsp&nbsp
                        Monday – Friday 08.00 – 16.00
                    </div>
                    <p class="contact-add">Phone</p>
                    <div class="information">

                        <i class="fas fa-phone"></i>&nbsp&nbsp
                        <p>(+592) 225-0977</p>
                    </div>
                    <p class="contact-add">Email</p>
                    <div class="information">

                        <i class="fas fa-envelope"></i> &nbsp &nbsp
                        <p>office@psc.org.gy</p>
                    </div>
                    <p class="contact-add">Address</p>
                    <div class="information">

                        <i class="fas fa-map-marker-alt"></i> &nbsp &nbsp

                        <p>157 Waterloo St, Georgetown, Guyana</p>
                    </div>
                </div>

                <div class="social-media">
                    <p>Connect with us :</p>
                    <div class="social-icons">
                        <a href="#">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="contact-form">
                <span class="circle one"></span>
                <span class="circle two"></span>

                <form class="inputs-form" action="index.html" autocomplete="off">
                    <h3 class="title">Contact us</h3>
                    <div class="input-container">
                        <input type="text" name="name" class="input" />
                        <label for="">Username</label>
                        <span>Username</span>
                    </div>
                    <div class="input-container">
                        <input type="email" name="email" class="input" />
                        <label for="">Email</label>
                        <span>Email</span>
                    </div>
                    <div class="input-container">
                        <input type="tel" name="phone" class="input" />
                        <label for="">Phone</label>
                        <span>Phone</span>
                    </div>
                    <div class="input-container textarea">
                        <textarea name="message" class="input"></textarea>
                        <label for="">Message</label>
                        <span>Message</span>
                    </div>
                    <input type="submit" value="Submit" class="btn-conatact" />
                </form>
            </div>
        </div>
    </div>
</section>
<!-- -----Contact us -->
@endsection