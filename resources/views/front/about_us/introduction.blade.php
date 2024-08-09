@extends('layout.master')

@section('content')
<!-- <section class="why-choose-two-section">
        <div class="container">
            <div class="thm-section-title text-center">
                <h4 class="sub-title-shape-left section_title-subheading">
                    About Us
                </h4>
                <h2>Introduction</h2>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque atque, libero ut repudiandae quas voluptatem. Quo ut natus sapiente eos sunt, laborum eius, in, atque dolore quod harum odit amet.
                </div>
            </div>
        </div>
    </section> -->


<section class="banner-section wow bg-about">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="back-ground">
                    <h2>About Us</h2>
                    <div class="breadcrumbs text-center wow animate__ animate__fadeInUp animate__delay-1s animated"
                        style="visibility: visible; animation-name: fadeInUp;">
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <span class="slash"> /</span>
                            <li><a href="about.html">About Us</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>




<!-- ----introduction-- -->
<section class="about-tow-section about-page">
    <div class="container">
        <div class="row">
            <div class="col-xl-6">
                <div class="about-two-left-content wow slideInLeft" data-wow-delay="100ms">
                    <div class="about-two-sec-image">
                        <div class="about-two-sec-image-bg-1" style="background-image: url('{{ asset('images/about/about-2--pattern-1.png') }}');"></div>
                        <div class="about-two-sec-image-bg-2" style="background-image: url('{{ asset('images/about/about-2--pattern-2.png') }}');"></div>
                        <img src="{{asset('images/about/about-page-img-1.png')}}" alt="" />
                    </div>
                </div>
               
            </div>
            <div class="col-xl-6">
                <div class="about-two-right-content">
                    <div class="about-two-title">
                        <h4 class="sub-title-shape-left section_title-subheading">
                            Our
                        </h4>
                        <h2>Introduction</h2>
                        <p class="about-two-title-text mb-2">
                            The Private Sector Commission of Guyana was established in 1992 by five Private Sector
                            Associations with the aim of bringing together all Private Sector Organs and Business
                            Entities under the purview of being one national body.
                        </p>
                        <p>
                            The Commission is governed by a Council which is comprised of the Heads of all Sectoral
                            Member Organizations and a number of elected corporate members. The Council is headed by the
                            Chairman who can serve a maximum of two consecutive one-year terms. Any Chairman who has
                            served two consecutive terms may be eligible for subsequent re-election after a three-year
                            period.
                        </p>
                        <p>
                            The overall activities of the Commission are coordinated by an Executive Management
                            Committee which comprises the following elected officials: Chairman, Vice Chairman, Honorary
                            Secretary, and Honorary Treasurer. The Executive Director is a member of the Committee by
                            appointment.
                        </p>
                    </div>


                    <!-- <div class="about-two-bottom-content">
                  <h3>John Franclin - <span>CEO & Founder</span></h3>
                  <div class="signature">
                    <img src="images/about/signature-1.png" alt="" />
                  </div>
                </div> -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- -----introduction -->
<!-- ----Mission-statement------ -->
<section class="blog-one-section">
    <div class="container">
        <div class="row">
            <div class="col-xl-6">
                <div class="about-two-right-content">
                    <div class="about-two-title">
                        <h4 class="sub-title-shape-left section_title-subheading">
                            Our
                        </h4>
                        <h2>Mission Statement</h2>
                        <p class="about-two-title-text mb-2">
                            “To be the leading advocate for the private sector on articulated and shared positions on
                            national issues which will promote socio-economic growth and development through the
                            creation of strategic partnerships with the Government and other stakeholders.”
                        </p>

                    </div>


                    <!-- <div class="about-two-bottom-content">
                    <h3>John Franclin - <span>CEO & Founder</span></h3>
                    <div class="signature">
                      <img src="images/about/signature-1.png" alt="" />
                    </div>
                  </div> -->
                </div>
            </div>
            <div class="col-xl-6">
                <div class="about-two-left-content wow slideInRight" data-wow-delay="100ms">
                    <div class="mission-two-sec-image">
                        <div class="about-two-sec-image-bg-1" style="
                        background-image:url('{{ asset('images/about/about-2--pattern-1.png') }}');
                      "></div>
                        <div class="about-two-sec-image-bg-2" style="
                        background-image: url('{{ asset('images/about/about-2--pattern-2.png') }}');
                      "></div>
                        <img src="{{asset('images/about/mission.png')}}" alt="mission-statement" />
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- ----Mission-statement------ -->




<!--Start Testimonials One Section -->
<section class="testimonials-one-section two" style="background-image: url('{{ asset('images/testimonial/bg-back.png')}}');">
    <div class="container">
        <div class="thm-section-title text-center">
            <h4 class="sub-title-shape-left section_title-subheading" style="color: #fff">
                Our
            </h4>
            <h2>
                Strategic Priority Areas
            </h2>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="testimonials-one-carousel owl-theme owl-carousel">
                    <!--Testimonials One Single-->
                    <div class="testimonials-one-single stragy">
                        <div class="client-info">
                            <div class="client-img">
                                <img src="{{asset('images/testimonial/trade-invesment.png')}}" alt="" />
                            </div>
                            <div class="client-content">
                                <h3>
                                    Economic Growth and Development</h3>
                            </div>
                        </div>
                        <div class="text-box">
                            <p>
                                To advocate for, provide leadership and promote activities and projects for all members
                                and stakeholders that will create a platform to foster development in Guyana.
                            </p>
                        </div>
                        <div class="testimonials-quote">
                            <i class="fa fa-quote-left"></i>
                        </div>
                    </div>
                    <!--Testimonials One Single-->
                    <div class="testimonials-one-single stragy">
                        <div class="client-info">
                            <div class="client-img">
                                <img src="{{asset('images/testimonial/government-security.png')}}" alt="" />
                            </div>
                            <div class="client-content">
                                <h3>Exports and Investments</h3>
                            </div>
                        </div>
                        <div class="text-box">
                            <p>
                                To partner with all members and stakeholders to develop and sustain plans for increasing
                                the competitiveness of Guyanese products and Guyana with the CSME and the related global
                                arrangements.
                            </p>
                        </div>
                        <div class="testimonials-quote">
                            <i class="fa fa-quote-left"></i>
                        </div>
                    </div>
                    <!--Testimonials One Single-->
                    <div class="testimonials-one-single stragy">
                        <div class="client-info">
                            <div class="client-img">
                                <img src="{{asset('images/testimonial/Finance-economic.png')}}" alt="" />
                            </div>
                            <div class="client-content">
                                <h3>Information and Communication</h3>
                            </div>
                        </div>
                        <div class="text-box">
                            <p>
                                To collect and share information to better inform the private sector.
                            </p>
                        </div>
                        <div class="testimonials-quote">
                            <i class="fa fa-quote-left"></i>
                        </div>
                    </div>
                    <!--Testimonials One Single-->
                    <div class="testimonials-one-single stragy">
                        <div class="client-info">
                            <div class="client-img">
                                <img src="{{asset('images/testimonial/natural-resources.png')}}" alt="" />
                            </div>
                            <div class="client-content">
                                <h3>Governance and Security</h3>
                            </div>
                        </div>
                        <div class="text-box">
                            <p>
                                To work towards ensuring that proper systems of governance and security are in place to
                                encourage investments.
                            </p>
                        </div>
                        <div class="testimonials-quote">
                            <i class="fa fa-quote-left"></i>
                        </div>
                    </div>
                    <!--Testimonials One Single-->
                    <div class="testimonials-one-single stragy">
                        <div class="client-info">
                            <div class="client-img">
                                <img src="images/testimonial/energy.png" alt="" />
                            </div>
                            <div class="client-content">
                                <h3>
                                    Harmonizing and Creating Alliances</h3>
                            </div>
                        </div>
                        <div class="text-box">
                            <p>
                                To create the environment necessary to encourage and facilitate harmonization among
                                members and to continue to build alliances nationally, regionally, and internationally,
                                including with the donor agencies.
                            </p>
                        </div>
                        <div class="testimonials-quote">
                            <i class="fa fa-quote-left"></i>
                        </div>
                    </div>
                    <!--Testimonials One Single-->
                    <div class="testimonials-one-single stragy">
                        <div class="client-info">
                            <div class="client-img">
                                <img src="{{asset('images/testimonial/Human Capital.png')}}" alt="" />
                            </div>
                            <div class="client-content">
                                <h3>Human Resources Retention and Development</h3>
                            </div>
                        </div>
                        <div class="text-box">
                            <p>
                                To work with all stakeholders to develop policies and procedures that will reverse brain
                                drain and provide adequate training to better serve the needs of the country.
                            </p>
                        </div>
                        <div class="testimonials-quote">
                            <i class="fa fa-quote-left"></i>
                        </div>
                    </div>
                    <!--Testimonials One Single-->

                </div>
            </div>
        </div>
    </div>
</section>
<!--End Testimonials One Section -->
<!--Start Why Choose Two Section -->
<section class="why-choose-two-section">
    <div class="container">
        <div class="thm-section-title text-center">
            <h4 class="sub-title-shape-left section_title-subheading">
                Our
            </h4>
            <h2>Core Value</h2>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="c-features-con">
                    <ul>
                        <li><span>1</span>
                            <div class="c-features-list">
                                <p>
                                    Value our members
                                </p>
                            </div>
                        </li>
                        <li><span>2</span>
                            <div class="c-features-list">
                                <p>
                                    Cohesion and unity amongst members and other stakeholders, including the wider
                                    society.
                                </p>
                            </div>
                        </li>
                        <li><span>3</span>
                            <div class="c-features-list">
                                <p>
                                    Respect all stakeholders
                                </p>
                            </div>
                        </li>
                        <li><span>4</span>
                            <div class="c-features-list">
                                <p>
                                    Professionalism and high ethical standards
                                </p>
                            </div>
                        </li>
                        <li><span>5</span>
                            <div class="c-features-list">
                                <p>
                                    Self discipline and structure to achieve results
                                </p>
                            </div>
                        </li>
                        <li><span>6</span>
                            <div class="c-features-list">
                                <p>
                                    Embrace initiatives to mitigate climate change
                                </p>
                            </div>
                        </li>
                        <li><span>7</span>
                            <div class="c-features-list">
                                <p>

                                    Regular communication and collaboration with all stakeholders.
                                </p>
                            </div>
                        </li>
                        <li><span>8</span>
                            <div class="c-features-list">
                                <p>
                                    Commit to excellence and competence
                                </p>
                            </div>
                        </li>
                        <li><span>9</span>
                            <div class="c-features-list">
                                <p>
                                    Honesty, integrity and independence in all matters.
                                </p>
                            </div>
                        </li>
                        <li><span>10</span>
                            <div class="c-features-list">
                                <p>
                                    Honesty, integrity and independence in all matters.

                                </p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!--End Why Choose Two Section -->
<!--Start Blog One Section -->
<section class="blog-one-section section-back">
    <div class="container">
        <div class="thm-section-title text-center">
            <h4 class="sub-title-shape-left section_title-subheading">
                Our
            </h4>
            <h2>Performance Drivers</h2>
        </div>
        <div class="row">
            <div class="col-md-4 col-lg-4 process-style2">

                <div class="process-icon">
                    <img src="{{asset('images/arrow-icon/team.png')}}" alt="icon">
                    <span class="process-number">01</span>
                </div>
                <h3 class="process-title h5">Member Satisfaction</h3>
                <p class="process-text">The PSC strives to provide an efficient and effective service to satisfy the
                    needs of its members.</p>
            </div>
            <div class="col-md-4 col-lg-4 process-style2">
                <div class="process-arrow"><img src="{{asset('images/arrow-icon/process-arrow-2-1.png')}}" alt="arrow"></div>
                <div class="process-icon">
                    <img src="{{asset('images/arrow-icon/proactive.png')}}" alt="icon">
                    <span class="process-number">02</span>
                </div>
                <h3 class="process-title h5">Proactivity</h3>
                <p class="process-text">The PSC strives to ensure that opportunities are capitalized upon, and solutions
                    and remedies are developed to mitigate threats.</p>
            </div>
            <div class="col-md-4 col-lg-4 process-style2">
                <div class="process-arrow"><img src="{{asset('images/arrow-icon/process-arrow-2-1.png')}}" alt="arrow"></div>
                <div class="process-icon">
                    <img src="{{asset('images/arrow-icon/Advocacy.png')}}" alt="icon">
                    <span class="process-number">02</span>
                </div>
                <h3 class="process-title h5">Advocacy</h3>
                <p class="process-text">The PSC takes a leading role in advocating the interests of its members and the
                    private sector, with a view to fostering socioeconomic growth and development in Guyana.</p>
            </div>
        </div>
    </div>
</section>




@endsection