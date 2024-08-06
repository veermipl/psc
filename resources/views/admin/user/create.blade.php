@extends('layout.admin_master')

@section('title', 'User - Create')
@section('header', 'Create User')

@section('content')

    <div class="p-3 bg-white">

        <h5 class="fw-bold">Add User</h5>

        <div class="py-3">
            <form action="{{ route('admin.user.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('post')

                <div class="form-group col-md-12">
                    <label for="name">Name <span class="text-danger">*</span></label>
                    <input type="text" id="name" class="form-control" name="name" placeholder="Enter name"
                        value="{{ old('name') }}" maxlength="50">

                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="d-flex">
                    <div class="form-group col-md-6">
                        <label for="email">Email <span class="text-danger">*</span></label>
                        <input type="email" id="email" class="form-control" name="email" value="{{ old('email') }}"
                            placeholder="Enter email" maxlength="50">

                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="number">Contact Number <span class="text-danger">*</span></label>
                        <input type="text" id="contact" class="form-control" name="contact" value="{{ old('contact') }}"
                            placeholder="Enter contact"
                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">

                        @error('contact')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="d-flex">
                    <div class="form-group col-md-6">
                        <label for="password">Password <span class="text-danger">*</span></label>
                        <input type="password" id="password" class="form-control" name="password" maxlength="50"
                            value="{{ old('password') }}" placeholder="Enter password" required>

                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="confirmed">Confirm Password <span class="text-danger">*</span></label>
                        <input type="password" id="confirmed" class="form-control" name="password_confirmation"
                            value="{{ old('confirm_password') }}" placeholder="Confirm password" maxlength="50" required>

                        @error('password_confirmation')
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
                                <option value="{{ $status['value'] }}" {{ (old('status') == $status['value']) ? 'selected' : '' }}>
                                    {{ $status['name'] }}
                                </option>
                            @endforeach
                        </select>

                        @error('status')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="confirmed">Role <span class="text-danger">*</span></label>
                        <select name="role" class="form-control">
                            <option hidden value="">Role</option>
                            @foreach ($roleList as $role)
                                <option value="{{ $role['id'] }}" {{ (old('role') == $role['id']) ? 'selected' : '' }}>
                                    {{ $role['name'] }}
                                </option>
                            @endforeach
                        </select>

                        @error('role')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group col-md-12 text-right">
                    <button class="btn btn-sm btn-custom" type="submit">Create</button>
                </div>
        </form>
    </div>
    </div>

@endsection
