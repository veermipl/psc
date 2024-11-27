@extends('layout.master')

@section('content')
    <section class="banner-section wow bg-about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="back-ground">
                        <h2>Council</h2>
                        <div class="breadcrumbs text-center wow animate__ animate__fadeInUp animate__delay-1s animated"
                            style="visibility: visible; animation-name: fadeInUp;">
                            <ul>
                                <li><a href="{{ url('/') }}">Home</a></li>
                                <span class="slash"> /</span>
                                <li><a href="{{ route('about-us.council') }}">Council</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="blog-one-section-staff">
        <div class="container">
            <div class="text-right">
                <a href="{{ route('about-us.council-details') }}" class="btn btn-primary btn-sm">
                    {{-- <ion-icon name="book-outline" role="img" class="md hydrated" aria-label="book-outline"></ion-icon> --}}
                    About Council
                </a>
            </div>
        </div>

        <!-- tree design start-for-desktop -->
        <div class="tree staff-desk">
            <ul>
                <li>
                    <a href="{{ route('about-us.council-show', 8) }}">
                        <div class="mx-auto mb-2">
                            <img src="https://psc.digitalnoticeboard.biz/storage/images/team/V5fVLGFUg3dKfyJPWAxJbIYT86hLmm4gQ29KwMNj.jpg"
                                alt="Sample avatar" />
                        </div>
                        <p class="font-weight-bold"><span>Name: </span>Leah Alves</p>
                        <p class="font-weight-bold"><span>Designation: </span>CEO</p>
                    </a>
                    <ul class="inn_line">

                        <li>
                            <a href="#">
                                <div class="mx-auto mb-2">
                                    <img src="https://psc.digitalnoticeboard.biz/storage/images/team/TN51nNu2sicbFpOl8R7iXoNm8FKnMZBAN5pd4bAE.jpg"
                                        alt="Sample avatar" />
                                </div>
                                <p class="font-weight-bold"><span>Name: </span>Nayteram Ramnarine</p>
                                <p class="font-weight-bold"><span>Designation: </span>Manager</p>
                            </a>
                            <ul class="inn_line">
                                <li>
                                    <a href="#">
                                        <div class="mx-auto mb-2">
                                            <img src="https://psc.digitalnoticeboard.biz/storage/images/team/XM1TBxACP8aiRzfhz15ixGgaUDWWrDuDw39BjTzj.jpg"
                                                alt="Sample avatar" />
                                        </div>
                                        <p class="font-weight-bold"><span>Name: </span>Nelissa Singh</p>
                                        <p class="font-weight-bold"><span>Designation: </span>Team Lead</p>
                                    </a>
                                    <ul class="inn_line">
                                        <li>
                                            <a href="#">
                                                <div class="mx-auto mb-2">
                                                    <img src="https://psc.digitalnoticeboard.biz/storage/images/team/QNo7OUGTFDidlg9cE7u1vu0T879uNbyG7X7IvpwA.jpg"
                                                        alt="Sample avatar" />
                                                </div>
                                                <p class="font-weight-bold">Team member</p>
                                            </a>

                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="mx-auto mb-2">
                                            <img src="https://psc.digitalnoticeboard.biz/storage/images/team/XM1TBxACP8aiRzfhz15ixGgaUDWWrDuDw39BjTzj.jpg"
                                                alt="Sample avatar" />
                                        </div>
                                        <p class="font-weight-bold"><span>Name: </span>Nelissa Singh</p>
                                        <p class="font-weight-bold"><span>Designation: </span>Team Lead</p>
                                    </a>
                                    <ul class="inn_line">
                                        <li>
                                            <a href="#">
                                                <div class="mx-auto mb-2">
                                                    <img src="https://psc.digitalnoticeboard.biz/storage/images/team/QNo7OUGTFDidlg9cE7u1vu0T879uNbyG7X7IvpwA.jpg"
                                                        alt="Sample avatar" />
                                                </div>
                                                <p class="font-weight-bold">Team member</p>
                                            </a>

                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">
                                <div class="mx-auto mb-2">
                                    <img src="https://psc.digitalnoticeboard.biz/storage/images/team/TN51nNu2sicbFpOl8R7iXoNm8FKnMZBAN5pd4bAE.jpg"
                                        alt="Sample avatar" />
                                </div>
                                <p class="font-weight-bold"><span>Name: </span>Nayteram Ramnarine</p>
                                <p class="font-weight-bold"><span>Designation: </span>Manager</p>
                            </a>
                            <ul class="inn_line">
                                <li>
                                    <a href="#">
                                        <div class="mx-auto mb-2">
                                            <img src="https://psc.digitalnoticeboard.biz/storage/images/team/XM1TBxACP8aiRzfhz15ixGgaUDWWrDuDw39BjTzj.jpg"
                                                alt="Sample avatar" />
                                        </div>
                                        <p class="font-weight-bold"><span>Name: </span>Nelissa Singh</p>
                                        <p class="font-weight-bold"><span>Designation: </span>Team Lead</p>
                                    </a>
                                    <ul class="inn_line">
                                        <li>
                                            <a href="#">
                                                <div class="mx-auto mb-2">
                                                    <img src="https://psc.digitalnoticeboard.biz/storage/images/team/QNo7OUGTFDidlg9cE7u1vu0T879uNbyG7X7IvpwA.jpg"
                                                        alt="Sample avatar" />
                                                </div>
                                                <p class="font-weight-bold">Team member</p>
                                            </a>

                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="mx-auto mb-2">
                                            <img src="https://psc.digitalnoticeboard.biz/storage/images/team/XM1TBxACP8aiRzfhz15ixGgaUDWWrDuDw39BjTzj.jpg"
                                                alt="Sample avatar" />
                                        </div>
                                        <p class="font-weight-bold"><span>Name: </span>Nelissa Singh</p>
                                        <p class="font-weight-bold"><span>Designation: </span>Team Lead</p>
                                    </a>
                                    <ul class="inn_line">
                                        <li>
                                            <a href="#">
                                                <div class="mx-auto mb-2">
                                                    <img src="https://psc.digitalnoticeboard.biz/storage/images/team/QNo7OUGTFDidlg9cE7u1vu0T879uNbyG7X7IvpwA.jpg"
                                                        alt="Sample avatar" />
                                                </div>
                                                <p class="font-weight-bold">Team member</p>
                                            </a>

                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="mx-auto mb-2">
                                            <img src="https://psc.digitalnoticeboard.biz/storage/images/team/XM1TBxACP8aiRzfhz15ixGgaUDWWrDuDw39BjTzj.jpg"
                                                alt="Sample avatar" />
                                        </div>
                                        <p class="font-weight-bold"><span>Name: </span>Nelissa Singh</p>
                                        <p class="font-weight-bold"><span>Designation: </span>Team Lead</p>
                                    </a>
                                    <ul class="inn_line">
                                        <li>
                                            <a href="#">
                                                <div class="mx-auto mb-2">
                                                    <img src="https://psc.digitalnoticeboard.biz/storage/images/team/QNo7OUGTFDidlg9cE7u1vu0T879uNbyG7X7IvpwA.jpg"
                                                        alt="Sample avatar" />
                                                </div>
                                                <p class="font-weight-bold">Team member</p>
                                            </a>

                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">
                                <div class="mx-auto mb-2">
                                    <img src="https://psc.digitalnoticeboard.biz/storage/images/team/TN51nNu2sicbFpOl8R7iXoNm8FKnMZBAN5pd4bAE.jpg"
                                        alt="Sample avatar" />
                                </div>
                                <p class="font-weight-bold"><span>Name: </span>Nayteram Ramnarine</p>
                                <p class="font-weight-bold"><span>Designation: </span>Manager</p>
                            </a>
                            <ul class="inn_line">
                                <li>
                                    <a href="#">
                                        <div class="mx-auto mb-2">
                                            <img src="https://psc.digitalnoticeboard.biz/storage/images/team/XM1TBxACP8aiRzfhz15ixGgaUDWWrDuDw39BjTzj.jpg"
                                                alt="Sample avatar" />
                                        </div>
                                        <p class="font-weight-bold"><span>Name: </span>Nelissa Singh</p>
                                        <p class="font-weight-bold"><span>Designation: </span>Team Lead</p>
                                    </a>
                                    <ul class="inn_line">
                                        <li>
                                            <a href="#">
                                                <div class="mx-auto mb-2">
                                                    <img src="https://psc.digitalnoticeboard.biz/storage/images/team/QNo7OUGTFDidlg9cE7u1vu0T879uNbyG7X7IvpwA.jpg"
                                                        alt="Sample avatar" />
                                                </div>
                                                <p class="font-weight-bold">Team member</p>
                                            </a>

                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="mx-auto mb-2">
                                            <img src="https://psc.digitalnoticeboard.biz/storage/images/team/XM1TBxACP8aiRzfhz15ixGgaUDWWrDuDw39BjTzj.jpg"
                                                alt="Sample avatar" />
                                        </div>
                                        <p class="font-weight-bold"><span>Name: </span>Nelissa Singh</p>
                                        <p class="font-weight-bold"><span>Designation: </span>Team Lead</p>
                                    </a>
                                    <ul class="inn_line">
                                        <li>
                                            <a href="#">
                                                <div class="mx-auto mb-2">
                                                    <img src="https://psc.digitalnoticeboard.biz/storage/images/team/QNo7OUGTFDidlg9cE7u1vu0T879uNbyG7X7IvpwA.jpg"
                                                        alt="Sample avatar" />
                                                </div>
                                                <p class="font-weight-bold">Team member</p>
                                            </a>

                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </li>
            </ul>
        </div>
        <!-- tree design end -->

        {{-- for mobile start --}}
        <div class="hierarchy staff-mob">
            <!-- CEO -->
            <div class="level">
                <div class="person">
                    <a href="https://psc-dev.digitalnoticeboard.biz/about-us/staff-show/8">
                        <div class="mx-auto mb-2">
                            <img src="https://psc.digitalnoticeboard.biz/storage/images/team/V5fVLGFUg3dKfyJPWAxJbIYT86hLmm4gQ29KwMNj.jpg"
                                alt="Sample avatar">
                        </div>
                        <p class="font-weight-bold"><span>Name: Leah Alves</span></p>
                        <p class="font-weight-bold">Designation: CEO</p>
                    </a>
                </div>
                <div class="line"></div>
            </div>

            <!-- Managers -->
            <div class="level">
                <div class="person">
                    <a href="https://psc-dev.digitalnoticeboard.biz/about-us/staff-show/8">
                        <div class="mx-auto mb-2">
                            <img src="https://psc.digitalnoticeboard.biz/storage/images/team/V5fVLGFUg3dKfyJPWAxJbIYT86hLmm4gQ29KwMNj.jpg"
                                alt="Sample avatar">
                        </div>
                        <p class="font-weight-bold"><span>Name: Leah Alves</span></p>
                        <p class="font-weight-bold">Designation: CEO</p>
                    </a>
                    <button class="toggle" onclick="toggleSection('team-leaders-1')">+</button>
                </div>
                <div id="team-leaders-1" class="hidden">
                    <div class="line"></div>
                    <div class="person">
                        <a href="https://psc-dev.digitalnoticeboard.biz/about-us/staff-show/8">
                            <div class="mx-auto mb-2">
                                <img src="https://psc.digitalnoticeboard.biz/storage/images/team/V5fVLGFUg3dKfyJPWAxJbIYT86hLmm4gQ29KwMNj.jpg"
                                    alt="Sample avatar">
                            </div>
                            <p class="font-weight-bold"><span>Name: Leah Alves</span></p>
                            <p class="font-weight-bold">Designation: CEO</p>
                        </a>
                        <button class="toggle" onclick="toggleSection('team-members-1-1')">+</button>
                    </div>
                    <div id="team-members-1-1" class="hidden">
                        <div class="line"></div>
                        <div class="person">
                            <a href="https://psc-dev.digitalnoticeboard.biz/about-us/staff-show/8">
                                <div class="mx-auto mb-2">
                                    <img src="https://psc.digitalnoticeboard.biz/storage/images/team/V5fVLGFUg3dKfyJPWAxJbIYT86hLmm4gQ29KwMNj.jpg"
                                        alt="Sample avatar">
                                </div>
                                <p class="font-weight-bold"><span>Name: Leah Alves</span></p>
                                <p class="font-weight-bold">Designation: CEO</p>
                            </a>
                        </div>
                    </div>
                    <div class="person">
                        <a href="https://psc-dev.digitalnoticeboard.biz/about-us/staff-show/8">
                            <div class="mx-auto mb-2">
                                <img src="https://psc.digitalnoticeboard.biz/storage/images/team/V5fVLGFUg3dKfyJPWAxJbIYT86hLmm4gQ29KwMNj.jpg"
                                    alt="Sample avatar">
                            </div>
                            <p class="font-weight-bold"><span>Name: Leah Alves</span></p>
                            <p class="font-weight-bold">Designation: CEO</p>
                        </a>
                        <button class="toggle" onclick="toggleSection('team-members-1-2')">+</button>
                    </div>
                    <div id="team-members-1-2" class="hidden">
                        <div class="line"></div>
                        <div class="person">
                            <a href="https://psc-dev.digitalnoticeboard.biz/about-us/staff-show/8">
                                <div class="mx-auto mb-2">
                                    <img src="https://psc.digitalnoticeboard.biz/storage/images/team/V5fVLGFUg3dKfyJPWAxJbIYT86hLmm4gQ29KwMNj.jpg"
                                        alt="Sample avatar">
                                </div>
                                <p class="font-weight-bold"><span>Name: Leah Alves</span></p>
                                <p class="font-weight-bold">Designation: CEO</p>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="line"></div>
                <div class="person">
                    <a href="https://psc-dev.digitalnoticeboard.biz/about-us/staff-show/8">
                        <div class="mx-auto mb-2">
                            <img src="https://psc.digitalnoticeboard.biz/storage/images/team/V5fVLGFUg3dKfyJPWAxJbIYT86hLmm4gQ29KwMNj.jpg"
                                alt="Sample avatar">
                        </div>
                        <p class="font-weight-bold"><span>Name: Leah Alves</span></p>
                        <p class="font-weight-bold">Designation: CEO</p>
                    </a>
                    <button class="toggle" onclick="toggleSection('team-leaders-2')">+</button>
                </div>
                <div id="team-leaders-2" class="hidden">
                    <div class="line"></div>
                    <div class="person">
                        <a href="https://psc-dev.digitalnoticeboard.biz/about-us/staff-show/8">
                            <div class="mx-auto mb-2">
                                <img src="https://psc.digitalnoticeboard.biz/storage/images/team/V5fVLGFUg3dKfyJPWAxJbIYT86hLmm4gQ29KwMNj.jpg"
                                    alt="Sample avatar">
                            </div>
                            <p class="font-weight-bold"><span>Name: Leah Alves</span></p>
                            <p class="font-weight-bold">Designation: CEO</p>
                        </a>
                        <button class="toggle" onclick="toggleSection('team-members-2-1')">+</button>
                    </div>
                    <div id="team-members-2-1" class="hidden">
                        <div class="line"></div>
                        <div class="person">
                            <a href="https://psc-dev.digitalnoticeboard.biz/about-us/staff-show/8">
                                <div class="mx-auto mb-2">
                                    <img src="https://psc.digitalnoticeboard.biz/storage/images/team/V5fVLGFUg3dKfyJPWAxJbIYT86hLmm4gQ29KwMNj.jpg"
                                        alt="Sample avatar">
                                </div>
                                <p class="font-weight-bold"><span>Name: Leah Alves</span></p>
                                <p class="font-weight-bold">Designation: CEO</p>
                            </a>
                        </div>
                    </div>
                    <div class="person">
                        <a href="https://psc-dev.digitalnoticeboard.biz/about-us/staff-show/8">
                            <div class="mx-auto mb-2">
                                <img src="https://psc.digitalnoticeboard.biz/storage/images/team/V5fVLGFUg3dKfyJPWAxJbIYT86hLmm4gQ29KwMNj.jpg"
                                    alt="Sample avatar">
                            </div>
                            <p class="font-weight-bold"><span>Name: Leah Alves</span></p>
                            <p class="font-weight-bold">Designation: CEO</p>
                        </a>
                        <button class="toggle" onclick="toggleSection('team-members-2-2')">+</button>
                    </div>
                    <div id="team-members-2-2" class="hidden">
                        <div class="line"></div>
                        <div class="person">
                            <a href="https://psc-dev.digitalnoticeboard.biz/about-us/staff-show/8">
                                <div class="mx-auto mb-2">
                                    <img src="https://psc.digitalnoticeboard.biz/storage/images/team/V5fVLGFUg3dKfyJPWAxJbIYT86hLmm4gQ29KwMNj.jpg"
                                        alt="Sample avatar">
                                </div>
                                <p class="font-weight-bold"><span>Name: Leah Alves</span></p>
                                <p class="font-weight-bold">Designation: CEO</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- for mobile end --}}
    </section>

    <script>
        function toggleSection(id) {
            const section = document.getElementById(id);
            const isHidden = section.classList.contains("hidden");
            section.classList.toggle("hidden", !isHidden);
            const button = section.previousElementSibling.querySelector(".toggle");
            button.textContent = isHidden ? "-" : "+";
        }
    </script>
@endsection
