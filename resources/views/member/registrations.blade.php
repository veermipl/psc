@extends('layout.master')
@section('content')

<?php

use App\Models\Sector;
use App\Models\LegalStatus;
use App\Models\MembershipType;
use App\Models\CorporateMemnership;
use App\Models\MemberRole;

// use App\Models\MembershipTypeModel;

$business_type = MembershipType::where('status', '1')->get();
$legal = LegalStatus::where('status', '1')->get();
$sector = Sector::where('status', '1')->get();
$members = CorporateMemnership::where('status', '1')->get();
$member_role = MemberRole::where('status', '1')->get();
?>

        <style>
        .hr-border {
            border-bottom: 1px solid #bca6a6 !important;
            width: 100%;
            margin: 0px;
        }   
        .hidden {
            display: none;
        }
        heading-butum-border2 {
            color: #072d74;
            /* border-bottom: 2px solid #072d74; */
        }

        </style>

    @if (session('statuss'))
            <div class="row">
             <div class="col-lg-1"></div>
                <div class="col-lg-10">
                    <div class="alert alert-success main_thank">
                        {{ session('statuss') }}

                        <!-- <div class=" text-center my-4 pt-4">
                            <a href="{{ route('login') }}" class="btn btn-primary vs-btn vs-btn-2 mx-3">Login <i
                                    class="far fa-long-arrow-right"></i></a>
                            <a href="{{ route('home') }}" class="btn btn-secondary vs-btn">Back to Home Page <i
                                    class="far fa-long-arrow-right"></i></a>
                        </div> -->
                        <div class=" row  my-4 pt-4">
                             <div class="col-md-6 text-center mb-3">
                            <a href="{{ route('login') }}" class="btn btn-primary  vs-btn-2 mx-3">Login <i class="far fa-long-arrow-right"></i></a>  </div>
                                <div class="col-md-6 text-center  mb-3 ">
                            <a href="{{ route('home') }}" class="btn btn-secondary ">Back to Home Page <i class="far fa-long-arrow-right"></i></a>
                        </div>
                      </div>


                    </div>
                    <div class="col-lg-1"></div>
                </div>
            </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('register-row').classList.add('hidden');
        });
    </script>
    @endif


<section class="why-choose-two-section  widget mb-0" >
    <div class="container" id="register-row">

        <div class="row d-flex justify-content-center">
            <div class="col-lg-12  recent-post-wrap my-form-registration ">
                <div class="widget my-form-bg h-100 p-3">
                    <div class="registration-my-h2 text-center">
                        <h2>Registration</h2>

                    </div>

                    <form action="{{ route('register') }}" method="post" class="language-picker__form mb-5" enctype="multipart/form-data" >
                       @csrf
                        <div class="row mb-3">
                        <div class="col-md-12 text-right pb-1"> <b> Already have an Account ? </b>
                            <a href="{{ route('login') }}"> <b class="heading-butum-border2" style="color:#072d74;"> Login in Now </b>  </a> 
                         </div>
                            <div class="col-md-12 py-4 ">
                                <h5><b class="heading-butum-border">Application for Membership</b> </h5>
                            </div>

                            <!-- <a href="{{route('login')}}"> <b class="heading-butum-border"> Already Registered</b>  </a> -->

                        

                            
                            <div class="col-xs-12 col-sm-6 col-md-4 py-2">
                                <label for="fname" class="mb-0"> Application Type <span
                                        class="my-form-star">*</span></label>

                                <select name="applicationtypeid" id="language-picker-select">
                                    <option lang="en" hidden value="">Select </option>

                                    @if(isset($business_type)&& count($business_type)> '0')
                                    @foreach($business_type as $type)
                                    <option lang="fr" value="{{$type->id}}"
                                        {{ old('applicationtypeid') == $type->id ? 'selected' : '' }}>
                                        {{$type->name}}
                                    </option>
                                    @endforeach
                                    @endif
                                </select>
                                @error('applicationtypeid')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-xs-12 col-sm-6 col-md-4 py-2">
                                <label for="fname" class="mb-0">Name of Business/
                                    Association/Chamber <span class="my-form-star">*</span></label>

                                <div class="input-container-2">
                                    <input type="text" name="name_of_business" value="{{ old('name_of_business') }}"
                                        class="input" placeholder="Name of Business" maxlength="100" >
                                </div>
                                @error('name_of_business')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-xs-12 col-sm-6 col-md-4 py-2">
                                <label for="fname" class="mb-0">Legal Status <span class="my-form-star">*</span>
                                </label>

                                <select name="legal_status" id="language-picker-select">
                                    <option lang="en" hidden value="">
                                    Select
                                    </option>
                                    @if(isset($legal) && count($legal)> 0)
                                    @foreach($legal as $legals)
                                    <option lang="fr" value="{{$legals->id}}"
                                        {{ old('legal_status') == $legals['id'] ? 'selected' : '' }}>
                                        {{$legals->name}}
                                    </option>
                                    @endforeach
                                    @endif

                                </select>
                                @error('legal_status')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-xs-12 col-sm-6 col-md-4 py-2">
                                <div class="row">
                                    <div class="col-12">
                                        <label for="fname" class="mb-0">Date of Registration (DD/MM/YYYY) <span class="my-form-star">*</span></label>
                                        <input type="date" class="input" name="date_of_egistration" value="{{ old('date_of_egistration') }}"  max="{{ date('Y-m-d') }}" 
                                            placeholder="">
                                    </div>
                                </div>
                                @error('date_of_egistration')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-4 py-2">
                                <label for="fname" class="mb-0">Type of Business or State <span class="my-form-star">*</span>
                                    <select name="sector" id="language-picker-select">
                                        <option lang="en" hidden value=""> Select</option>

                                        @if(isset($sector) && count($sector)>0)
                                        @foreach($sector as $sectors)
                                        <option lang="fr" value="{{$sectors->id}}"
                                            {{ old('sector') == $sectors->id ? 'selected' : '' }}>
                                            {{$sectors->name}}
                                        </option>
                                        @endforeach
                                        @endif
                                    </select>
                                    @error('sector')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-4 py-2">
                                <label for="fname" class="mb-0"> No. of
                                    Employees/
                                    Members <span class="my-form-star">*</span>
                                    <select name="No_of_employees" name="No_of_employees" id="language-picker-select">
                                        <option lang="en" value="" hidden> Select</option>

                                        <option lang="fr" value="1"
                                            {{ old('No_of_employees') == '1' ? 'selected' : '' }}>
                                            1
                                        </option>
                                        <option lang="it" value="2"
                                            {{ old('No_of_employees') == '2' ? 'selected' : '' }}>
                                            2
                                        </option>
                                        <option lang="it" value="3"
                                            {{ old('No_of_employees') == '3' ? 'selected' : '' }}>
                                            3
                                        </option>
                                        <option lang="it" value="4"
                                            {{ old('No_of_employees') == '4' ? 'selected' : '' }}>
                                            4
                                        </option>
                                        <option lang="it" value="5"
                                            {{ old('No_of_employees') == '5' ? 'selected' : '' }}>
                                            5
                                        </option>
                                    </select>
                                    @error('No_of_employees')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6 py-2">
                                <label for="fname" class="mb-0">Registered Office
                                    Address <span class="my-form-star">*</span></label>
                                <div class="input-container-2">
                                    <textarea name="registered_office_address" class="input-2"
                                        placeholder=" Registered Office Address"   maxlength="150"> {{old('registered_office_address')}}</textarea>
                                </div>
                                @error('registered_office_address')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6 py-2">
                                <label for="fname" class="mb-0">Business/
                                    Operation
                                    Address <span class="my-form-star">*</span></label>
                                <div class="input-container-2">
                                    <textarea name="type_of_business" class="input-2"
                                        placeholder=" Business/ Operation Address(es)" maxlength="150">  {{old('type_of_business')}}</textarea>
                                </div>
                                @error('type_of_business')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                        <div class="row mb-4">

                            <div class="col-md-12 py-4 ">
                                <h5><b class="heading-butum-border">Name the Sector(s) you Represent</b>
                                </h5>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-4 py-2">
                            <label for="fname" class="mb-0">Telephone Number <span  class="my-form-star">*</span></label>
                                <div class="input-container-2">
                                    <input type="text" name="telephone_no" value="{{old('telephone_no')}}" class="input"
                                        placeholder="Telephone Number" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" maxlength="12">
                                </div>
                                @error('telephone_no')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-xs-12 col-sm-6 col-md-4 py-2">
                                <label for="fname" class="mb-0">Fax Number <span class="my-form-star">*</span></label>
                                <div class="input-container-2">
                                    <input type="text" name="fax_no" value="{{old('fax_no')}}" class="input"
                                        placeholder=" Fax Number" maxlength="20" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                </div>
                                @error('fax_no')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-xs-12 col-sm-6 col-md-4 py-2">
                                <label for="fname" class="mb-0">Email Address <span
                                        class="my-form-star">*</span></label>
                                <div class="input-container-2">
                                    <input type="email" name="email" class="input" value="{{old('email')}}"
                                        placeholder="Email Address" maxlength="150">
                                </div>
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-xs-12 col-sm-6 col-md-4     py-2">
                                <label for="fname" class="mb-0">Website <span class="my-form-star">*</span></label>
                                <div class="input-container-2">
                                    <input type="url" name="website" class="input" value="{{old('website')}}"
                                        placeholder="https://www.example.com" maxlength="150">
                                </div>
                                @error('website')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>

                            <div class="col-xs-12 col-sm-6 col-md-8 py-2">
                                <label for="fname" class="mb-0">Select
                                    Membership (for Corporate Membership only) <span class="my-form-star">*</span></label>
                                <select name="membership_id" id="language-picker-select">
                                    <option lang="en" hidden value=""> Select </option>

                                    @if(isset($members) && count($members)> 0)
                                    @foreach($members as $member)
                                    <option lang="fr" value="{{$member->id}} "
                                        {{ old('membership_id') == $member->id ? 'selected' : '' }}>
                                        {!! $member->name !!}
                                    </option>
                                    @endforeach
                                    @endif
                                </select>
                                @error('membership_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="col-xs-12 col-sm-6 col-md-6 py-2">
                            <label for="fname" class="mb-0">List what is your expectation(s) from being a member of the PSC. <span class="my-form-star">*</span></label>
                            <div class="input-container-2">
                                <!-- Your Expectations -->
                                @if(old('your_expectation'))
                                @foreach(old('your_expectation') as $key => $value)
                                <div class='item my-add-btn-p' id="your_exp_field_{{$key}}">
                                    <input type="text" name="your_expectation[]" value="{{ $value }}" class="input mb-2"
                                        placeholder="List What is Your Expectation From Being a Member" maxlength="150">
                                    <button type="button" class="remove-btn {{ ($key == '0') ? '' : 'old' }}" row_id="{{$key}}" row_type="your_exp_field" ><i class="fa fa-trash"></i></button>
                                    @error('your_expectation.' . $key)
                                   <span class="text-danger">{{ $message }}</span><br>
                                 @enderror
                                </div>
                                @endforeach
                                @else
                                <div class='item my-add-btn-p'>
                                    <input type="text" name="your_expectation[]" class="input mb-2"
                                        placeholder="List What is your Expectation From Being a Member" maxlength="150">
                                    <button type="button" class="remove-btn" ><i class="fa fa-trash"></i></button>
                                </div>
                                @endif
                                
                                <div id="expectations"></div>
                                <div class="my-add-btn">
                                    <button id="expectation-add" type="button" class="my-add-btn-type">Add +</button>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-6 py-2">
                            <label for="fname" class="mb-0">How can contribute towards the objectives of the PSC by being a member <span class="my-form-star">*</span></label>
                            <div class="input-container-2">
                                <!-- Contributions Towards Objectives -->
                                @if(old('contribute_towards'))
                                @foreach(old('contribute_towards') as $key => $value)
                                <div class='item my-add-btn-p' id="cont_twd_field_{{$key}}">
                                    <input type="text" name="contribute_towards[]" value="{{ $value }}" class="input mb-2"
                                        placeholder="List how you can contribute towards the objectives" maxlength="150">
                                    <button type="button" class="remove-btn  {{ ($key == '0') ? '' : 'old' }}" row_id="{{$key}}" row_type="cont_twd_field" ><i class="fa fa-trash"></i></button>
                                    @error('contribute_towards.' . $key)
                                   <span class="text-danger">{{ $message }}</span><br>
                                 @enderror
                                </div>

                                @endforeach
                                @else
                                <div class='item my-add-btn-p'>
                                    <input type="text" name="contribute_towards[]" class="input mb-2"
                                        placeholder="List how you can contribute towards the objectives...">
                                    <button type="button" class="remove-btn" ><i class="fa fa-trash"></i></button>
                                </div>
                                @endif

                                <!-- Display validation errors for contributions -->
                                <div id="objectives"></div>
                                <div class="my-add-btn">
                                    <button id="contribute-add" type="button" class="my-add-btn-type">Add +</button>
                                </div>
                            </div>
                        </div>


                         <div class="col-xs-12 col-sm-6 col-md-4 py-2">
                                <label for="fname" class="mb-0">Wish to Become a Member of the PSC. <span class="my-form-star">*</span> </label>
                                <div class="input-container-2">
                                    <input type="text" name="state_briefly" class="input"
                                        value="{{old('state_briefly')}}"
                                        placeholder="Wish to Become a Member of the PSC" maxlength="150">
                                </div>
                                @error('state_briefly')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>

                            <div class="col-xs-12 col-sm-6 col-md-4 py-2">
                                <label for="fname" class="mb-0">How do you
                                    know about the
                                    PSC? <span class="my-form-star">*</span>
                                </label>
                                <div class="input-container-2">

                                    <input type="text" name="you_know_about" class="input"
                                        value="{{old('you_know_about')}}" placeholder="How do You know About the PSC?" maxlength="150">
                                </div>
                                @error('you_know_about')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                        <div class="row mb-4">
                            <div class="col-md-12 py-4">
                                <h5><b class="heading-butum-border"> Names of Two References</b> </h5>
                            </div>

                               @if(old('references_address'))
                                    @foreach (old('references_address') as $index => $address)
                                   <hr class="hr-border">
                                    <div class="row Referencesss" id="ref_add_{{$index}}">

                                        <!-- Name Field -->
                                        <div class="col-xs-12 col-sm-6 col-md-3 py-2">
                                            <label for="fname" class="mb-0">Name<span class="my-form-star">*</span></label>
                                            <div class="input-container-2">
                                                <input type="text" name="references_name[]" class="input" placeholder="Name" value="{{ old('references_name.' . $index) }}" maxlength="150">
                                            </div>
                                            @error('references_name.' . $index)
                                                <span class="text-danger">{{ $message }}</span><br>
                                            @enderror
                                        </div>

                                        <!-- Address Field -->
                                        <div class="col-xs-12 col-sm-6 col-md-3 py-2">
                                            <label for="fname" class="mb-0">Address <span class="my-form-star">*</span></label>
                                            <div class="input-container-2">
                                                <input type="text" name="references_address[]" class="input" placeholder="Address" value="{{ $address }}" maxlength="150">
                                            </div>
                                            @error('references_address.' . $index)
                                                <span class="text-danger">{{ $message }}</span><br>
                                            @enderror
                                        </div>

                                        <!-- Name of Business Field -->
                                        <div class="col-xs-12 col-sm-6 col-md-6 py-2">
                                            <label for="fname" class="mb-0">Name of Business/Profession <span class="my-form-star">*</span></label>
                                            <div class="input-container-2">
                                                <input type="text" name="references_name_of_business[]" class="input" placeholder="Name of Business/Profession" value="{{ old('references_name_of_business.' . $index) }}" maxlength="150">
                                            </div>
                                            @error('references_name_of_business.' . $index)
                                                <span class="text-danger">{{ $message }}</span><br>
                                            @enderror
                                        </div>

                                        <!-- Telephone Numbers Field -->
                                        <div class="col-xs-12 col-sm-6 col-md-3 py-2">
                                            <label for="fname" class="mb-0">Tel Nos. <span class="my-form-star">*</span></label>
                                            <div class="input-container-2">
                                                <input type="text" name="references_tel_nos[]" class="input" placeholder="Tel Nos." value="{{ old('references_tel_nos.' . $index) }}" maxlength="12" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                            </div>
                                            @error('references_tel_nos.' . $index)
                                                <span class="text-danger">{{ $message }}</span><br>
                                            @enderror
                                        </div>

                                        <!-- Email Field -->
                                        <div class="col-xs-12 col-sm-6 col-md-3 py-2">
                                            <label for="fname" class="mb-0">Email <span class="my-form-star">*</span></label>
                                            <div class="input-container-2">
                                                <input type="email" name="references_email[]" class="input" placeholder="Email" value="{{ old('references_email.' . $index) }}" maxlength="150">
                                            </div>
                                            @error('references_email.' . $index)
                                                <span class="text-danger">{{ $message }}</span><br>
                                            @enderror
                                        </div>

                                        <!-- Website Field -->
                                        <div class="col-xs-12 col-sm-6 col-md-6 py-2">
                                            <label for="fname" class="mb-0">Website <span class="my-form-star">*</span></label>
                                            <div class="input-container-2">
                                                <input type="url" name="references_website[]" class="input" placeholder="https://www.example.com" value="{{ old('references_website.' . $index) }}" maxlength="150">
                                            </div>
                                            @error('references_website.' . $index)
                                                <span class="text-danger">{{ $message }}</span><br>
                                            @enderror
                                        </div>

                                        <!-- Remove Button -->
                                        <div class="col-md-12 text-center">
                                            <button type="button" class="my-add-btn-type-2 remove-btn {{ ($index == '0') ? '' : 'old' }}" row_id="{{$index}}" row_type="ref_add" ><i class="fa fa-trash"></i></button>
                                        </div>
                                    </div> 
                             @endforeach

                             <div class="col-md-12">
                                <div id= "members2"> </div>
                            </div>

                             <div class="col-md-12">
                                 <div class="add-new-btn">
                                  <button id="members" class="my-add-btns-type add-new-btn">Add New +</button>
                                 </div>
                            </div>
                        </div>
                        
          
                    @else
                        <!-- Name Field -->
                        <div class="col-xs-12 col-sm-6 col-md-3 py-2">
                            <label for="fname" class="mb-0">Name<span class="my-form-star">*</span></label>
                            <div class="input-container-2">
                                <input type="text" name="references_name[]" class="input" placeholder="Name" maxlength="150">
                            </div>
                        </div>

                        <!-- Address Field -->
                        <div class="col-xs-12 col-sm-6 col-md-3 py-2">
                            <label for="fname" class="mb-0">Address <span class="my-form-star">*</span></label>
                            <div class="input-container-2">
                                <input type="text" name="references_address[]" class="input" placeholder="Address" maxlength="150">
                            </div>
                        </div>

                        <!-- Name of Business Field -->
                        <div class="col-xs-12 col-sm-6 col-md-6 py-2">
                            <label for="fname" class="mb-0">Name of Business/Profession <span class="my-form-star">*</span></label>
                            <div class="input-container-2">
                                <input type="text" name="references_name_of_business[]" class="input" placeholder="Name of Business/Profession" maxlength="150">
                            </div>
                        </div>

                        <!-- Telephone Numbers Field -->
                        <div class="col-xs-12 col-sm-6 col-md-3 py-2">
                            <label for="fname" class="mb-0">Telephone Number <span class="my-form-star">*</span></label>
                            <div class="input-container-2">
                                <input type="text" name="references_tel_nos[]" class="input" placeholder="Telephone Number"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" maxlength="12">
                            </div>
                        </div>

                        <!-- Email Field -->
                        <div class="col-xs-12 col-sm-6 col-md-3 py-2">
                            <label for="fname" class="mb-0">Email <span class="my-form-star">*</span></label>
                            <div class="input-container-2">
                                <input type="email" name="references_email[]" class="input" placeholder="Email" maxlength="150">
                            </div>
                        </div>

                        <!-- Website Field -->
                        <div class="col-xs-12 col-sm-6 col-md-6 py-2">
                            <label for="fname" class="mb-0">Website <span class="my-form-star">*</span></label>
                            <div class="input-container-2">
                                <input type="url" name="references_website[]" class="input" placeholder="https://www.example.com" maxlength="150">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div id= "members2"> </div>
                        </div>

                        <div class="col-md-12">
                            <div class="add-new-btn">
                                <button id="members" class="my-add-btns-type add-new-btn">Add New +</button>
                            </div>
                        </div>
                    </div>

                @endif

                        <div class="row mb-4">
                            <div class="col-md-12 py-4">
                                <h5><b class="heading-butum-border"> Names of two Principal Officers</b>
                                </h5>
                            </div>

                            <div class="col-xs-12 col-sm-6 col-md-3 py-2">
                                <label for="fname" class="mb-0">Name
                                    <span class="my-form-star">*</span></label>

                                <div class="input-container-2">
                                    <input type="text" name="principal_name" class="input" placeholder="Name"
                                        value="{{old('principal_name')}}">
                                </div>
                                @error('principal_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-3 py-2">
                                <label for="fname" class="mb-0">Designation
                                    <span class="my-form-star">*</span></label>
                                <div class="input-container-2">
                                    <input type="text" name="principal_designation" class="input"
                                        placeholder="Designation" value="{{old('principal_designation')}}">
                                </div>
                                @error('principal_designation')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-3 py-2">
                                <label for="fname" class="mb-0">Signature
                                    <span class="my-form-star">*</span></label>
                                <div class="input-container-2">
                                    <input type="text" name="principal_signature" class="input"
                                        value="{{old('principal_signature')}}" placeholder="Signature" maxlength="100">
                                </div>
                                @error('principal_signature')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-3 py-2">
                                <label for="fname" class="mb-0">Date (DD/MM/YYYY) <span class="my-form-star">*</span></label>
                                <div class="input-container-2">
                                    <input type="date" name="principal_date" value="{{old('principal_date')}}"
                                        class="input" placeholder="Date">
                                </div>
                                @error('principal_date')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-xs-12 col-sm-6 col-md-3 py-2">
                                <label for="fname" class="mb-0">File Upload <span class="my-form-star">*</span></label>
                                <div class="input-container-2">
                                    <input type="file" name="supporting_document[]" class="input p-0" placeholder="Date" multiple>
                                </div>
                                @error('supporting_document')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                                @error('supporting_document.*')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="text-right">
                         
                            <button class="my-save-btn-type" type="submit" tabindex="0">Submit </button>

                            <a href="{{route('register')}}" class="my-refresh-btn-type-2 "> Refresh </a>
                            
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>

@endsection

@section('scripts')


<script>
        // Function to hide remove buttons on page load
        function hideRemoveButtons() {
            document.querySelectorAll('.remove-btn').forEach(function (button) {
                // console.log(button);
                if (button.classList.contains('old')) {
                    button.style.display = 'block';
                } else {
                    button.style.display = 'none';
                }
            });
        }

        // Function to enable inputs and hide remove buttons on page load
        document.addEventListener('DOMContentLoaded', function () {
            hideRemoveButtons();
        });

        // Function to add a new input field for expectations
        document.getElementById('expectation-add').addEventListener('click', function () {
            let container = document.getElementById('expectations');
            let newField = document.createElement('div');
            newField.classList.add('item', 'my-add-btn-p');
            newField.innerHTML = `
                <input type="text" name="your_expectation[]" class="input mb-2" placeholder="List your Expectation">
                <button type="button" class="remove-btn"><i class="fa fa-trash"></i></button>
            `;
            container.appendChild(newField);

            // Show the remove button for the new input field
            newField.querySelector('.remove-btn').style.display = 'inline-block';

            // Add remove functionality to the new button
            newField.querySelector('.remove-btn').addEventListener('click', function () {
                newField.remove(); // Remove the input field
            });
        });

        // Function to add a new input field for contributions
        document.getElementById('contribute-add').addEventListener('click', function () {
            let container = document.getElementById('objectives');
            let newField = document.createElement('div');
            newField.classList.add('item', 'my-add-btn-p');
            newField.innerHTML = `
                <input type="text" name="contribute_towards[]" class="input mb-2" placeholder="List Your Contributions">
                <button type="button" class="remove-btn"><i class="fa fa-trash"></i></button>
            `;
            container.appendChild(newField);

            // Show the remove button for the new input field
            newField.querySelector('.remove-btn').style.display = 'inline-block';

            // Add remove functionality to the new button
            newField.querySelector('.remove-btn').addEventListener('click', function () {
                newField.remove(); // Remove the input field
            });
        });

        //function to remove old fields
        $(document).on('click', 'button.old', function(e){
            e.preventDefault();
            var btn_row_id = $(this).attr('row_id');
            var btn_row_type = $(this).attr('row_type');

            removeField(btn_row_id, btn_row_type);
        });

        function removeField(row_id = null, row_type = null){
            if(row_id && row_type){
                // console.log(row_id);
                // console.log(row_type);
                $('div#'+row_type+'_'+row_id).remove();
            }

            return true;
        }

        // Function to handle form submission
        document.getElementById('myForm').addEventListener('submit', function (event) {
            event.preventDefault(); // Prevent the default form submission

            // Show all remove buttons after form submission
            document.querySelectorAll('.remove-btn').forEach(function (button) {
                button.style.display = 'inline-block'; // Show the remove buttons
            });

            // You can also add logic to send form data here (e.g., via AJAX)
            // console.log("Form submitted!"); // Debugging log
        });
    </script>

<script>
let detailedTemplate = `<div class="reference-block">
    <hr class="hr-border">  
    <div class="row References mb-5"> 
        <div class="col-xs-12 col-sm-6 col-md-3 py-2">
            <label for="fname" class="mb-0">Name<span class="my-form-star">*</span></label>
            <div class="input-container-2">
                <input type="text" name="references_name[]" class="input" placeholder="Name" maxlength="100">
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-3 py-2">
            <label for="fname" class="mb-0">Address <span class="my-form-star">*</span></label>
            <div class="input-container-2"> 
                <input type="text" name="references_address[]" class="input" placeholder="Address" maxlength="100">
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 py-2">
            <label for="fname" class="mb-0">Name of Business/Profession <span class="my-form-star">*</span></label>
            <div class="input-container-2">
                <input type="text" name="references_name_of_business[]" class="input" placeholder="Name of Business/Profession" maxlength="100">
            </div>
        </div>
       <div class="col-xs-12 col-sm-6 col-md-3 py-2">
    <label for="fname" class="mb-0">Telephone Nos. <span class="my-form-star">*</span></label>
    <div class="input-container-2">
        <input type="text" name="references_tel_nos[]" class="input" placeholder="Telephone Nos.*" oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="12">
    </div>
</div>
        <div class="col-xs-12 col-sm-6 col-md-3 py-2">
            <label for="fname" class="mb-0">Email <span class="my-form-star">*</span></label>
            <div class="input-container-2">
                <input type="email" name="references_email[]" class="input" placeholder="Email">
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 py-2">
            <label for="fname" class="mb-0">Website <span class="my-form-star">*</span></label>
            <div class="input-container-2">
                <input type="url" name="references_website[]" class="input" placeholder="https://www.example.com.">
            </div>
        </div>
        <div class="col-md-12 text-center">
            <button type="button" class="removell my-add-btn-type-2"> <i class="fa fa-trash"></i></button>
        </div>
    </div>
</div>`;

$("#members").on("click", (e) => {
    e.preventDefault();
    $("#members2").append(detailedTemplate); // Appending detailed template
});

$("body").on("click", ".removell", function() {
    $(this).closest('.reference-block').remove(); // Removing the entire block including <hr>
});

</script>

@endsection