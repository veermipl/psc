@extends('layout.admin_master')

@section('title', 'Member - Update')
@section('header', 'Update Member')

@section('content')

    <div class="p-3 bg-white">

        <h5 class="fw-bold">Update Member</h5>

        <div class="pt-5">
            <form action="{{ route('admin.member.update', $user->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('patch')

                <div class="d-flex">
                    <div class="form-group col-md-6">
                        <label for="name">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" placeholder="Enter name"
                            value="{{ old('name', $user->name) }}" maxlength="50">

                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="membership_type">Membership Type <span class="text-danger">*</span></label>
                        <select name="membership_type" class="form-control">
                            <option hidden value="">Select Membership Type</option>
                            @foreach ($membershipList as $membership)
                                <option value="{{ $membership['id'] }}"
                                    {{ old('membership_type', $user->membership_type) == $membership['id'] ? 'selected' : '' }}>
                                    {{ $membership['name'] }}
                                </option>
                            @endforeach
                        </select>

                        @error('membership_type')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="d-flex">
                    <div class="form-group col-md-6">
                        <label for="email">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}"
                            placeholder="Enter email" maxlength="50" readonly disabled>

                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="number">Contact Number <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="contact"
                            value="{{ old('contact', $user->mobile_number) }}" placeholder="Enter contact"
                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">

                        @error('contact')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="d-flex">
                    <div class="form-group col-md-6">
                        <label for="form_pdf">Upload filled form</label>
                        <input type="file" id="form_pdf" class="form-control" name="form_pdf" accept="application/pdf">
                        @error('form_pdf')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="supported_files">Supported Files</label>

                        @error('supported_files')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="d-flex">
                    <div class="form-group col-md-6">
                        <label for="membership_type">Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-control">
                            <option hidden value="">Status</option>
                            @foreach (config('site.status') as $status)
                                <option value="{{ $status['value'] }}"
                                    {{ old('status', $user->status) == $status['value'] ? 'selected' : '' }}>
                                    {{ $status['name'] }}
                                </option>
                            @endforeach
                        </select>

                        @error('status')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="confirmed">Password </label>
                        <input type="password" id="password" class="form-control" name="password" value=""
                            placeholder="Change password" maxlength="50">

                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group col-md-12 text-right">
                    <button class="btn btn-sm btn-custom" type="submit">Update Member</button>
                </div>
            </form>
        </div>
    </div>

@endsection
