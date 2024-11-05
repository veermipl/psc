@extends('layout.admin_master')

@section('title', 'Member - registration')
@section('header', 'registration')
@section('content')

<?php

use App\Models\Sector;
use App\Models\MemberRole;
use App\Models\LegalStatus;
use App\Models\BusinessTypes;
use App\Models\CorporateMemnership;

$business_type = BusinessTypes::where('status', '1')->get();
$legal = LegalStatus::where('status', '1')->get();
$sector = Sector::where('status', '1')->get();
$members = CorporateMemnership::where('status', '1')->get();
$member_role = MemberRole::where('status', '1')->get();
?>
<style>
    .lora.reference-block{
        padding-top:50px;
        position:relative;
    }
    .m-2 {
    margin: .5rem 0 !important;
}
.doc_imges_des{
    display: flex;
}
</style>
<div class="page-breadcrumb d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Update Registration</div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="p-4 border rounded">
                        <form action="{{ route('admin.member.registration.update', $data->id) }}" method="post"
                            enctype="multipart/form-data" class="row g-3 needs-validation">
                            @csrf
                            @method('patch')

                            @foreach ($docVal as $docKey => $docVal1)
                            @if ($docVal1)
                            <input type="hidden" name="old_doc[]" value="{{ $docVal1 }}">
                            @endif
                            @endforeach

                            <div class="breadcrumb-title pe-3">
                            Application for Membership </div>

                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip01" class="form-label">Application Type <span
                                        class="text-danger">*</span></label>
                                <select name="applicationtypeid" class="form-control">
                                    <option hidden value="">Select Application Type</option>
                                    @foreach ($business_type as $membership)
                                        <option value="{{ $membership['id'] }}"
                                            {{ old('applicationtypeid', $data->application_type_id) == $membership['id'] ? 'selected' : '' }}>
                                            {{ $membership['name'] }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('applicationtypeid')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                     

                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip01" class="form-label">Name of Business <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name_of_business" placeholder="Enter name of business"
                                    value="{{ old('name_of_business', $data->name_of_business) }}" maxlength="50">

                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip01" class="form-label">Legal Status <span
                                        class="text-danger">*</span></label>
                                        <select name="legal_status" class="form-control">
                                            <option hidden value="">Select Application Type</option>
                                            @foreach ($legal as $membership)
                                                <option value="{{ $membership['id'] }}"
                                                    {{ old('legal_status', $data->legal_status) == $membership['id'] ? 'selected' : '' }}>
                                                    {{ $membership['name'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                @error('legal_status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip01" class="form-label">Date of Registration<span
                                        class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="date_of_egistration" placeholder="Enter name"
                                    value="{{ old('date_of_egistration', $data->date_of_egistration) }}" maxlength="50" >

                                @error('date_of_egistration')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip01" class="form-label">Type of Business or State <span
                                        class="text-danger">*</span></label>
                                        <select name="sector" class="form-control">
                                            <option hidden value="">Select Type of Business </option>
                                                @foreach ($sector as $membership)
                                                    <option value="{{ $membership['id'] }}"
                                                        {{ old('sector', $data->sector) == $membership['id'] ? 'selected' : '' }}>
                                                        {{ $membership['name'] }}
                                                    </option>
                                                @endforeach
                                        </select>
                                @error('sector')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip01" class="form-label">No. of Employees/Members <span
                                        class="text-danger">*</span></label>
                                        <select name="no_of_employees" class="form-control">
                                            <option hidden value="">Select No. of Employees</option>
                                            <option  value="1" {{ old('sector', $data->No_of_employees) == '1' ? 'selected' : '' }} >1</option>
                                            <option  value="2" {{ old('sector', $data->No_of_employees) == '2' ? 'selected' : '' }}>2</option>
                                            <option  value="3" {{ old('sector', $data->No_of_employees) == '3' ? 'selected' : '' }} >3</option>
                                            <option  value="4" {{ old('sector', $data->No_of_employees) == '4' ? 'selected' : '' }} >4</option>
                                            <option  value="5" {{ old('sector', $data->No_of_employees) == '5' ? 'selected' : '' }} >5</option>
                                        </select>
                                @error('no_of_employees')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip01" class="form-label">Registered Office Address <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="registered_office_address" placeholder="Enter registered office address"
                                    value="{{ old('registered_office_address', $data->registered_office_address) }}" maxlength="100">

                                @error('registered_office_address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip01" class="form-label"> Business/ Operation Address(es)<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="type_of_business" placeholder="Enter Business Address"
                                    value="{{ old('type_of_business', $data->type_of_business) }}" maxlength="100">

                                @error('type_of_business')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="breadcrumb-title pe-3">
                                Name the Sector(s) you Represent </div>

                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip01" class="form-label"> Telephone Number <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="telephone_no" placeholder="Enter telephone no."
                                    value="{{ old('telephone_no', $data->telephone_no) }}" maxlength="12" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">

                                @error('telephone_no')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip01" class="form-label"> Fax Number <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="fax_no" placeholder="Enter fax number."
                                    value="{{ old('fax_no', $data->fax_no) }}" maxlength="15" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">

                                @error('fax_no')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip01" class="form-label"> Email Address <span
                                        class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="email" placeholder="Enter Email"
                                    value="{{ old('email', $data->email) }}" maxlength="100">

                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            

                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip01" class="form-label">  Sectoral Membership(for Corporate Membership only) <span
                                        class="text-danger">*</span></label>

                                        <select name="membership_id" class="form-control">
                                            <option hidden value="">Select you Membership</option>
                                                @foreach ($members as $membership)
                                                    <option value="{{ $membership['id'] }}"
                                                        {{ old('membership_id', $data->membership_id) == $membership['id'] ? 'selected' : '' }}>
                                                        {!! $membership['name'] !!}
                                                    </option>
                                                @endforeach
                                        </select>
                                

                                @error('membership_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            @if ($data->your_expectation)
                                @php
                                    $your_exp = explode(',', $data->your_expectation);
                                @endphp
                                <div  class="col-md-6 position-relative" id="expectations">
                                    <label for="expectations" class="form-label">
                                        List what is your expectation(s) from being a member <span class="text-danger">*</span>
                                    </label>
                                    @foreach($your_exp as $key => $value)
                                        <div class="item" class="expectation_{{ $key }}" id="expectation_{{ $key }}" style="position:relative;">
                                            <input type="text" class="form-control m-2" name="your_expectation[{{ $key }}]" placeholder="Enter expectation"
                                                value="{{ old('your_expectation.' . $key, $value) }}" maxlength="100">
                                                <button type="button" class="remove-btn  {{ ($key == '0') ? '' : 'old' }}" row_id="{{$key}}" row_type="expectation" style="position: absolute; display: block; top: 0px; right: 0px;" > <i class="fa fa-trash" aria-hidden="true"></i> </button>
                                          
                                        </div>
                                        @error('your_expectation.' . $key)
                                         <span class="text-danger">{{ $message }}</span><br>
                                        @enderror

                                    @endforeach
                                    <button type="button" id="expectation-add" class="add_buttons_but" ><i class="fa fa-plus" aria-hidden="true"></i></button>
                                </div>

                            @endif

                            <!-- Contributions Section -->
                            @if ($data->contribute_towards)
                                @php
                                    $contributions = explode(',', $data->contribute_towards);
                                @endphp
                                <div  class="col-md-6 position-relative" id="objectives">
                                    <label for="contribute_towards" class="form-label">
                                        List how you can contribute towards the objectives <span class="text-danger">*</span>
                                    </label>
                                    
                                    @foreach($contributions as $key => $value)
                                        <div class="item" id="contribute_{{ $key }}" style="position:relative;">
                                            <input type="text" class="form-control m-2" name="contribute_towards[{{ $key }}]" placeholder="Enter name"   value="{{ old('contribute_towards.' . $key, $value) }}" maxlength="100">
                                                <button type="button" class="remove-btn  {{ ($key == '0') ? '' : 'old' }}" row_id="{{$key}}" row_type="contribute"  style="position: absolute; display: block; top: 0px; right: 0px;"  ><i class="fa fa-trash" aria-hidden="true"></i></button>

                                        </div>
                                        @error('contribute_towards.' . $key)
                                         <span class="text-danger">{{ $message }}</span><br>
                                        @enderror
                                    @endforeach
                                    <button type="button" id="contribute-add" class="add_buttons_but" ><i class="fa fa-plus" aria-hidden="true"></i></button>
                                </div>
                            @endif

                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip01" class="form-label"> Website <span
                                        class="text-danger">*</span></label>
                                <input type="url" class="form-control" name="website" placeholder="Enter website"
                                    value="{{ old('website', $data->website) }}" maxlength="50">

                                @error('website')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip01" class="form-label">Wish to Become a Member of the PSC <span 
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="state_briefly" placeholder="Wish to Become a Member of the PSC"
                                    value="{{ old('state_briefly', $data->state_briefly) }}" maxlength="100">

                                @error('state_briefly')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip01" class="form-label">How do you know about the PSC<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="you_know_about" placeholder="Enter name"
                                    value="{{ old('you_know_about', $data->you_know_about) }}" maxlength="50">

                                @error('you_know_about')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="breadcrumb-title pe-3">
                                Names of two References 
                            </div>


                            @php
                        $references_name = explode(',', $data->references_name);
                        $references_address = explode(',', $data->references_address);
                        $references_business = explode(',', $data->references_name_of_business);
                        $references_tel = explode(',', $data->references_tel_nos);
                        $refereemail = explode(',', $data->references_email);
                        $references_web = explode(',', $data->references_website);
                    @endphp

        @if(!empty($references_name))
            @foreach($references_name as $key => $references)
            <hr class="hr-border">
            <div class="row Referencesss" id="ref_add_{{$key}}">

            <div >
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="validationTooltip01" class="form-label">Name<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="references_name[{{ $key }}]" placeholder="Name"
                            value="{{ old('references_name.'. $key, $references) }}" maxlength="100">
                        @error('references_name.' . $key)
                            <span class="text-danger">{{ $message }}</span><br>
                        @enderror

                    </div>
                    <div class="col-md-4">
                        <label for="validationTooltip01" class="form-label">Address<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="references_address[{{ $key }}]" placeholder="Address"
                            value="{{ old('references_address.'. $key, $references_address[$key]) }}" maxlength="100">

                        @error('references_address.' . $key)
                            <span class="text-danger">{{ $message }}</span><br>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="validationTooltip01" class="form-label">Name of Business/Profession<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="references_name_of_business[{{ $key }}]" placeholder="Name of Business/Profession"
                            value="{{ old('references_name_of_business.'. $key, $references_business[$key]) }}" maxlength="50">
                        @error('references_name_of_business.' . $key)
                            <span class="text-danger">{{ $message }}</span><br>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    
            <div class="col-md-12 text-center">
            <button type="button" class="my-add-btn-type-2 remove-btn {{ ($key == '0') ? '' : 'old' }}" row_id="{{$key}}" row_type="ref_add" ><i class="fa fa-trash"></i></button>
        </div>
                    <div class="col-md-4">
                        <label for="validationTooltip01" class="form-label">Telephone Number<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="references_tel_nos[{{ $key }}]" placeholder="Telephone No."
                            value="{{ old('references_tel_nos.'. $key, $references_tel[$key]) }}" maxlength="12" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                        @error('references_tel_nos.' . $key)
                        <span class="text-danger">{{ $message }}</span><br>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="validationTooltip01" class="form-label">Email<span class="text-danger">*</span></label>
                        <input type="email" class="form-control" name="references_email[{{ $key }}]" placeholder="Email"
                            value="{{ old('references_email.'. $key, $refereemail[$key]) }}" maxlength="100">
                            @error('references_email.' . $key)
                            <span class="text-danger">{{ $message }}</span><br>
                            @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="validationTooltip01" class="form-label">Website<span class="text-danger">*</span></label>
                        <input type="url" class="form-control" name="references_website[{{ $key }}]" placeholder="Website"
                            value="{{ old('references_website.'. $key, $references_web[$key]) }}" maxlength="100">
                        @error('references_website.' . $key)
                        <span class="text-danger">{{ $message }}</span><br>
                        @enderror
                    </div>
                </div>
            </div>

    </div>


            @endforeach
        @endif

            <div id="members2"></div>

        <div class="row mb-3">
            <div class="col-md-12">
                <button id="members" type="button" class="btn btn-primary">Add New +</button>
            </div>
        </div>

                        <div class="breadcrumb-title pe-3">
                              Names of two Principal Officers 
                        </div>

                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip01" class="form-label">Name<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="principal_name" placeholder="Enter name"
                                    value="{{ old('principal_name', $data->principal_name) }}" maxlength="50">

                                @error('principal_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip01" class="form-label">Designation<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="principal_designation" placeholder="Enter designation"
                                    value="{{ old('principal_designation', $data->principal_designation) }}" maxlength="50">

                                @error('principal_designation')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip01" class="form-label">Signature<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="principal_signature" placeholder="Enter signature"
                                    value="{{ old('principal_signature', $data->principal_signature) }}" maxlength="100">

                                @error('principal_signature')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip01" class="form-label">Date<span
                                        class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="principal_date" placeholder="Enter name"
                                    value="{{ old('principal_date', $data->principal_date) }}" maxlength="50">

                                @error('principal_date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
 
                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip01" class="form-label">Status <span
                                        class="text-danger">*</span></label>
                                <select name="status" class="form-control">
                                    <option hidden value="">Status</option>
                                    @foreach (config('site.status') as $status)
                                        <option value="{{ $status['value'] }}"
                                            {{ old('status', $data->user->status) == $status['value'] ? 'selected' : '' }}>
                                            {{ $status['name'] }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip01" class="form-label">Role  <span
                                        class="text-danger">*</span></label>
                                        <select name="role" class="form-control">
                                        <option hidden value="">Select member role</option>

                                        @foreach($member_role as $role)
                                            <option value="{{ $role->id }}" {{ old('role', $data->user->member_role) == $role->id ? 'selected' : '' }}>
                                                {{ $role->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                @error('role')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-3 py-2">
                                    <label for="fname" class="mb-0">File Upload <span class="my-form-star">*</span></label>
                                    <div class="input-container-2">
                                        <input type="file" name="supporting_document[]" class="input p-0" accept="application" multiple>
                                    </div>

                                    @error('supporting_document')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <div class="docs-sapn">
                                    @if($docVal && count($docVal) > 0)
                                            @foreach ($docVal as $docKey => $docsArr)

                                            <!-- <div class="doc_imges_des">  -->
                                                <span class="text-center pdf-files">
                                                                <a href="{{ $docsArr ? asset('storage/' . $docsArr) : '' }}"
                                                                    target="_blank" title="Filled Form">
                                                                    <i class="fa fa-file text-dark"></i>
                                                                </a>
                                                                <div class=" deleteDocBtn" id="{{ $data->user->id }}" doc_url="{{ $docsArr }}" doc_type="supporting">
                                                                <div class="cross-m"><i class="fa fa-close bg-danger"></i></div>
                                                            </div>
                                                </span>
                                            <!-- </div> -->
                                               
                                                        
                                            @endforeach
                                        @endif
                                    </div>

                                </div>
                                
                             <div class="col-12 text-end mt-5">
                              <button class="btn btn-sm btn-primary" type="submit">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('scripts')
<script>

    document.addEventListener('DOMContentLoaded', function () {
        // Function to hide remove buttons for old fields on page load
        function hideRemoveButtons() {
            document.querySelectorAll('.remove-btn').forEach(function (button) {
                if (button.classList.contains('old')) {
                    button.style.display = 'block'; // Keep old remove buttons visible
                } else {
                    button.style.display = 'none'; // Hide new remove buttons on page load
                }
            });
        }
        hideRemoveButtons(); // Call function on page load

        // Add a new expectation input field
        document.getElementById('expectation-add').addEventListener('click', function () {
            let container = document.getElementById('expectations');
            let newField = document.createElement('div');
            newField.classList.add('item', 'my-add-btn-p','add_but_more');
            newField.innerHTML = `
             <input type="text" class="form-control mb-2" name="your_expectation[]" placeholder="your expectation...">
                <button type="button" class="remove-btn" style="position: absolute; display: block; top: 0px; right: 0px;" ><i class="fa fa-trash" aria-hidden="true"></i></button>
            `;
            container.appendChild(newField);

            // Show remove button for new input field and add functionality to remove it
            newField.querySelector('.remove-btn').style.display = 'inline-block';
            newField.querySelector('.remove-btn').addEventListener('click', function () {
                newField.remove(); // Remove the new input field
            });
        });

        // Add a new contribution input field
        document.getElementById('contribute-add').addEventListener('click', function () {
            let container = document.getElementById('objectives');
            let newField = document.createElement('div');
            newField.classList.add('item', 'my-add-btn-p', 'add_but_more');
            newField.innerHTML = `
                <input type="text" class="form-control m-2" name="contribute_towards[]" placeholder="contribute towards...">
                <button type="button" class="remove-btn" style="position: absolute; display: block; top: 0px; right: 0px;" ><i class="fa fa-trash" aria-hidden="true"></i></button>
            `;
            container.appendChild(newField);

            // Show remove button for new input field and add functionality to remove it
            newField.querySelector('.remove-btn').style.display = 'inline-block';
            newField.querySelector('.remove-btn').addEventListener('click', function () {
                newField.remove(); // Remove the new input field
            });
        });

        // Function to remove old fields (pre-populated)
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
        // Function to remove fields dynamically
        function removeField(row_id = null, row_type = null) {
            if (row_id && row_type) {
                $('div#' + row_type + '_' + row_id).remove(); // Remove the element with the specified ID
            }
        }
    });

</script>

<script>
let detailedTemplate = ` <div class="lora-wrapper mt-2"> <hr/>
    <div class="lora reference-block"> 
        <div class="col-md-12 text-center">
        <button type="button" class="removell my-add-btn-type-2">
            <i class="fa fa-trash" aria-hidden="true"></i>
        </button>
    </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <label for="validationTooltip01" class="form-label">Name<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="references_name[]" placeholder="Name" maxlength="100">
            </div>
            <div class="col-md-4">
                <label for="validationTooltip01" class="form-label">Address<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="references_address[]" placeholder="Address" maxlength="100">
            </div>
            <div class="col-md-4">
                <label for="validationTooltip01" class="form-label">Name of Business/Profession<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="references_name_of_business[]" placeholder="Name of Business/Profession" maxlength="50">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4">
                <label for="validationTooltip01" class="form-label">Tel Nos.<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="references_tel_nos[]" placeholder="Tel Nos." maxlength="100">
            </div>
            <div class="col-md-4">
                <label for="validationTooltip01" class="form-label">Email<span class="text-danger">*</span></label>
                <input type="email" class="form-control" name="references_email[]" placeholder="Email" maxlength="100">
            </div>
            <div class="col-md-4">
                <label for="validationTooltip01" class="form-label">Website<span class="text-danger">*</span></label>
                <input type="url" class="form-control" name="references_website[]" placeholder="Website" maxlength="100">
            </div>
        </div>
    </div>
   
</div>`;

$(document).ready(function() {
    // Make sure the remove button works for dynamically added content
    $(document).on('click', '.removell', function() {
        $(this).closest('.lora-wrapper').remove();
    });

    // Add new reference block on button click
    $("#members").on("click", (e) => {
        e.preventDefault();
        $("#members2").append(detailedTemplate); // Appending detailed template
    });
});

$(document).on('click', '.removell', function() {
    console.log('Remove button clicked');
    $(this).closest('.lora-wrapper').remove();
});

</script>

<script type="text/javascript">
        $(document).ready(function() {

            $(document).on('click', '.deleteDocBtn', function(e) {
                e.preventDefault();

                var id = $(this).attr('id');
                var doc_url = $(this).attr('doc_url');
                var doc_type = $(this).attr('doc_type');

                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel!",
                    reverseButtons: true,
                    confirmButtonColor: '#24695c',
                    cancelButtonColor: '#d22d3d',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('admin.member.delete-doc') }}",
                            method: 'POST',
                            data: {
                                _method: 'post',
                                _token: '{{ csrf_token() }}',
                                id: id,
                                doc_url: doc_url,
                                doc_type: doc_type,
                            },
                            dataType: "json",
                            beforeSend: function() {
                                // $('.preloader').show();
                            },
                            success: function(response) {
                                if (response.error === false) {
                                    $('div.editFileWrapper[doc_row_url="' + doc_url +
                                        '"]').remove();

                                    toastr.success(response.msg);
                                } else {
                                    toastr.error(response.msg);
                                }
                            },
                            error: function(xhr, status, error) {
                                toastr.error(error);
                            },
                            complete: function(xhr, status) {
                                // $('.preloader').hide();
                            }
                        });
                    }
                });

            });
        });
    </script>


    @endsection