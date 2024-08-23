@extends('layout.admin_master')

@section('title', 'Member - Create')
@section('header', 'Create Member')

@section('content')

    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Create Member</div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="p-4 border rounded">
                        <form action="{{ route('admin.member.store') }}" method="post" enctype="multipart/form-data" class="row g-3 needs-validation">
                            @csrf
                            @method('post')

                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip01" class="form-label">Name <span class="text-danger">*</span></label>
                                <input type="text" id="name" class="form-control" name="name" placeholder="Enter name"
                                    value="{{ old('name') }}" maxlength="50">

                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip01" class="form-label">Membership Type <span class="text-danger">*</span></label>
                                <select name="membership_type" class="form-control">
                                    <option hidden value="">Select Membership Type</option>
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

                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip01" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" id="email" class="form-control" name="email" value="{{ old('email') }}"
                                    placeholder="Enter email" maxlength="50">

                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip01" class="form-label">Contact Number <span class="text-danger">*</span></label>
                                <input type="text" id="contact" class="form-control" name="contact"
                                    value="{{ old('contact') }}" placeholder="Enter contact"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">

                                @error('contact')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip01" class="form-label">Upload Filled Form <span class="text-danger">*</span></label>
                                <input type="file" id="form" class="form-control" name="form" accept="application/pdf">

                                @error('form')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip01" class="form-label">Upload Supporting Documents <span class="text-danger">*</span></label>
                                <input type="file" id="supporting_document" class="form-control" name="supporting_document[]" accept="application/pdf" multiple>

                                @error('supporting_document')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip01" class="form-label">Password <span class="text-danger">*</span></label>
                                <input type="password" id="password" class="form-control" name="password" maxlength="50"
                                    value="{{ old('password') }}" placeholder="Enter password">

                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip01" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                                <input type="password" id="confirmed" class="form-control" name="password_confirmation"
                                    value="{{ old('confirm_password') }}" placeholder="Confirm password" maxlength="50">

                                @error('password_confirmation')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip01" class="form-label">Status <span class="text-danger">*</span></label>
                                <select name="status" class="form-control">
                                    <option hidden value="">Status</option>
                                    @foreach (config('site.status') as $status)
                                        <option value="{{ $status['value'] }}"
                                            {{ old('status') == $status['value'] ? 'selected' : '' }}>
                                            {{ $status['name'] }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 position-relative">
                            </div>

                            <div class="col-12 text-end mt-5">
                                <button class="btn btn-sm btn-primary" type="submit">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
