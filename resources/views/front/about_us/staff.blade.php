@extends('layout.master')

@section('content')


    <section class="banner-section wow bg-about">
        <div class="container">
         <div class="row">
             <div class="col-lg-12">
                 <div class="back-ground">
                     <h2>Staff</h2>
                     <div class="breadcrumbs text-center wow animate__ animate__fadeInUp animate__delay-1s animated" style="visibility: visible; animation-name: fadeInUp;">
                         <ul>
                             <li><a href="{{url('/')}}">Home</a></li>
                              <span class="slash">   /</span>
                             <li><a href="{{ route('about-us.staff') }}">Staff</a></li>
                         </ul>
                     </div>
                 </div>
             </div>
         </div>
        </div>
       </section>


      <section class="blog-one-section-staff">
        <!-- tree design start -->
    <div class="tree">
      <ul>
        <li>
          <a href="{{ route('about-us.staff-show', 8) }}">
            <div class="mx-auto mb-2">
              <img
                src="https://psc.digitalnoticeboard.biz/storage/images/team/V5fVLGFUg3dKfyJPWAxJbIYT86hLmm4gQ29KwMNj.jpg"
                alt="Sample avatar"
              />
            </div>
            <p class="font-weight-bold"><span>Name: </span>Leah Alves</p>
            <p class="font-weight-bold"><span>Designation: </span>CEO</p>
          </a>
          <ul class="inn_line">
            
            <li>
              <a href="#">
                <div class="mx-auto mb-2">
                  <img
                    src="https://psc.digitalnoticeboard.biz/storage/images/team/TN51nNu2sicbFpOl8R7iXoNm8FKnMZBAN5pd4bAE.jpg"
                    alt="Sample avatar"
                  />
                </div>
                <p class="font-weight-bold"><span>Name: </span>Nayteram Ramnarine</p>
                <p class="font-weight-bold"><span>Designation: </span>Manager</p>
              </a>
              <ul class="inn_line">
                <li>
                  <a href="#">
                    <div class="mx-auto mb-2">
                      <img
                        src="https://psc.digitalnoticeboard.biz/storage/images/team/XM1TBxACP8aiRzfhz15ixGgaUDWWrDuDw39BjTzj.jpg"
                        alt="Sample avatar"
                      />
                    </div>
                    <p class="font-weight-bold"><span>Name: </span>Nelissa Singh</p>
                 <p class="font-weight-bold"><span>Designation: </span>Team Lead</p>
                  </a>
                  <ul class="inn_line">
                    <li>
                      <a href="#">
                        <div class="mx-auto mb-2">
                          <img
                            src="https://psc.digitalnoticeboard.biz/storage/images/team/QNo7OUGTFDidlg9cE7u1vu0T879uNbyG7X7IvpwA.jpg"
                            alt="Sample avatar"
                          />
                        </div>
                        <p class="font-weight-bold">Team member</p>
                      </a>
                      
                    </li>
                  </ul>
                </li>
                <li>
                  <a href="#">
                    <div class="mx-auto mb-2">
                      <img
                        src="https://psc.digitalnoticeboard.biz/storage/images/team/XM1TBxACP8aiRzfhz15ixGgaUDWWrDuDw39BjTzj.jpg"
                        alt="Sample avatar"
                      />
                    </div>
                    <p class="font-weight-bold"><span>Name: </span>Nelissa Singh</p>
                      <p class="font-weight-bold"><span>Designation: </span>Team Lead</p>
                  </a>
                  <ul class="inn_line">
                    <li>
                      <a href="#">
                        <div class="mx-auto mb-2">
                          <img
                            src="https://psc.digitalnoticeboard.biz/storage/images/team/QNo7OUGTFDidlg9cE7u1vu0T879uNbyG7X7IvpwA.jpg"
                            alt="Sample avatar"
                          />
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
                  <img
                    src="https://psc.digitalnoticeboard.biz/storage/images/team/TN51nNu2sicbFpOl8R7iXoNm8FKnMZBAN5pd4bAE.jpg"
                    alt="Sample avatar"
                  />
                </div>
                <p class="font-weight-bold"><span>Name: </span>Nayteram Ramnarine</p>
              <p class="font-weight-bold"><span>Designation: </span>Manager</p>
              </a>
              <ul class="inn_line">
                <li>
                  <a href="#">
                    <div class="mx-auto mb-2">
                      <img
                        src="https://psc.digitalnoticeboard.biz/storage/images/team/XM1TBxACP8aiRzfhz15ixGgaUDWWrDuDw39BjTzj.jpg"
                        alt="Sample avatar"
                      />
                    </div>
                    <p class="font-weight-bold"><span>Name: </span>Nelissa Singh</p>
                    <p class="font-weight-bold"><span>Designation: </span>Team Lead</p>
                  </a>
                  <ul class="inn_line">
                    <li>
                      <a href="#">
                        <div class="mx-auto mb-2">
                          <img
                            src="https://psc.digitalnoticeboard.biz/storage/images/team/QNo7OUGTFDidlg9cE7u1vu0T879uNbyG7X7IvpwA.jpg"
                            alt="Sample avatar"
                          />
                        </div>
                        <p class="font-weight-bold">Team member</p>
                      </a>
                      
                    </li>
                  </ul>
                </li>
                <li>
                  <a href="#">
                    <div class="mx-auto mb-2">
                      <img
                        src="https://psc.digitalnoticeboard.biz/storage/images/team/XM1TBxACP8aiRzfhz15ixGgaUDWWrDuDw39BjTzj.jpg"
                        alt="Sample avatar"
                      />
                    </div>
                    <p class="font-weight-bold"><span>Name: </span>Nelissa Singh</p>
                    <p class="font-weight-bold"><span>Designation: </span>Team Lead</p>
                  </a>
                  <ul class="inn_line">
                    <li>
                      <a href="#">
                        <div class="mx-auto mb-2">
                          <img
                            src="https://psc.digitalnoticeboard.biz/storage/images/team/QNo7OUGTFDidlg9cE7u1vu0T879uNbyG7X7IvpwA.jpg"
                            alt="Sample avatar"
                          />
                        </div>
                        <p class="font-weight-bold">Team member</p>
                      </a>
                      
                    </li>
                  </ul>
                </li>
                <li>
                  <a href="#">
                    <div class="mx-auto mb-2">
                      <img
                        src="https://psc.digitalnoticeboard.biz/storage/images/team/XM1TBxACP8aiRzfhz15ixGgaUDWWrDuDw39BjTzj.jpg"
                        alt="Sample avatar"
                      />
                    </div>
                    <p class="font-weight-bold"><span>Name: </span>Nelissa Singh</p>
                       <p class="font-weight-bold"><span>Designation: </span>Team Lead</p>
                  </a>
                  <ul class="inn_line">
                    <li>
                      <a href="#">
                        <div class="mx-auto mb-2">
                          <img
                            src="https://psc.digitalnoticeboard.biz/storage/images/team/QNo7OUGTFDidlg9cE7u1vu0T879uNbyG7X7IvpwA.jpg"
                            alt="Sample avatar"
                          />
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
                  <img
                    src="https://psc.digitalnoticeboard.biz/storage/images/team/TN51nNu2sicbFpOl8R7iXoNm8FKnMZBAN5pd4bAE.jpg"
                    alt="Sample avatar"
                  />
                </div>
                <p class="font-weight-bold"><span>Name: </span>Nayteram Ramnarine</p>
            <p class="font-weight-bold"><span>Designation: </span>Manager</p>
              </a>
              <ul class="inn_line">
                <li>
                  <a href="#">
                    <div class="mx-auto mb-2">
                      <img
                        src="https://psc.digitalnoticeboard.biz/storage/images/team/XM1TBxACP8aiRzfhz15ixGgaUDWWrDuDw39BjTzj.jpg"
                        alt="Sample avatar"
                      />
                    </div>
                    <p class="font-weight-bold"><span>Name: </span>Nelissa Singh</p>
            <p class="font-weight-bold"><span>Designation: </span>Team Lead</p>
                  </a>
                  <ul class="inn_line">
                    <li>
                      <a href="#">
                        <div class="mx-auto mb-2">
                          <img
                            src="https://psc.digitalnoticeboard.biz/storage/images/team/QNo7OUGTFDidlg9cE7u1vu0T879uNbyG7X7IvpwA.jpg"
                            alt="Sample avatar"
                          />
                        </div>
                        <p class="font-weight-bold">Team member</p>
                      </a>
                      
                    </li>
                  </ul>
                </li>
                <li>
                  <a href="#">
                    <div class="mx-auto mb-2">
                      <img
                        src="https://psc.digitalnoticeboard.biz/storage/images/team/XM1TBxACP8aiRzfhz15ixGgaUDWWrDuDw39BjTzj.jpg"
                        alt="Sample avatar"
                      />
                    </div>
                    <p class="font-weight-bold"><span>Name: </span>Nelissa Singh</p>
            <p class="font-weight-bold"><span>Designation: </span>Team Lead</p>
                  </a>
                  <ul class="inn_line">
                    <li>
                      <a href="#">
                        <div class="mx-auto mb-2">
                          <img
                            src="https://psc.digitalnoticeboard.biz/storage/images/team/QNo7OUGTFDidlg9cE7u1vu0T879uNbyG7X7IvpwA.jpg"
                            alt="Sample avatar"
                          />
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
    </section>

@endsection