@extends('layout.master')

@section('content')
    <!-- <section class="why-choose-two-section">
            <div class="container">
                <div class="thm-section-title text-center">
                    <h4 class="sub-title-shape-left section_title-subheading">
                        About Us
                    </h4>
                    <h2>History</h2>
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
                        <h2>Historical overview</h2>
                        <div class="breadcrumbs text-center wow animate__ animate__fadeInUp animate__delay-1s animated"
                            style="visibility: visible; animation-name: fadeInUp;">
                            <ul>
                                <li><a href="{{ route('home') }}">Home</a></li>
                                <span class="slash"> /</span>
                                <li><a href="#">Historical overview</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Bnner Section -->
    <!-- ----Historical-- -->
    <section class="historic-tow-section ">
        <div class="container">
            <div class="row">

                <div class="col-xl-12">
                    <div class="about-two-right-content">
                        <div class="about-two-title text-justify">

                            <p class=" mt-30">
                                The Private Sector Commission (PSC) indirectly grew out of the Economic Recovery Programme
                                introduced in the late nineteen eighties by President Desmond Hoyte. This programme led to
                                what was virtually a renaissance period for private sector business in Guyana as the focus
                                shifted from state hegemony of the economic environment to divestment of state enterprises
                                and incentives to boost private enterprise.
                            </p>
                            <p class="">
                                The need, therefore, arose for associations and chambers to represent the fledgling private
                                sector. By early 1992, a grouping of small business support organisations came to the
                                realization that, while they adequately handled sector-specific issues, there was no
                                overarching body to deal with the cross-cutting issues which affected the private sector.
                            </p>
                            <p class="">
                                Five of these businesses came together and created the Private Sector Commission with a
                                clearly laid out mandate. From this small beginning with five Sectoral Members, the Private
                                Sector has grown to represent organisations of diverse focus and membership and wide
                                geographical reach. Sectoral Members now represent the gamut of enterprises from aviation,
                                manufacturing, and large-scale agriculture to craft production and tourism.
                            </p>
                            <p class="">
                                When Corporate Membership was introduced, the Constitution of the Commission was changed to
                                ensure that these new members, with their bigger asset bases, did not dominate the
                                decision-making Council of the body.
                            </p>
                            <p class="">
                                Whereas each Sectoral Member was guaranteed a seat on the Council, the collective Corporate
                                Members were constrained to elect from among themselves a number of representatives
                                determined as a percentage of the number of seats held by the Sectoral Members.
                            </p>
                            <p class="">
                                Though constrained by these requirements, the Corporate Members brought new perspectives to
                                the dialogue and lifted the bar for advocacy.
                            </p>
                            <p class="">
                                The Commission now has Corporate Members representing a wide range of industries from
                                large-scale gold and bauxite mining to aviation, construction and agriculture.
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
    <!-- -----Historical -->
@endsection
