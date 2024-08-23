@extends('layout.admin_master')

@section('title', 'User - Create')
@section('header', 'Create User')

@section('content')

    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Create User</div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="p-4 border rounded">
                        <form action="{{ route('admin.user.store') }}" method="post" enctype="multipart/form-data" class="row g-3 needs-validation">
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
                                <label for="validationTooltip01" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" id="email" class="form-control" name="email" value="{{ old('email') }}"
                                    placeholder="Enter email" maxlength="50">

                                @error('email')
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
                                <label for="validationTooltip01" class="form-label">Role <span class="text-danger">*</span></label>
                                <select name="role" class="form-control">
                                    <option hidden value="">Role</option>
                                    @foreach ($roleList as $role)
                                        <option value="{{ $role['id'] }}" {{ old('role') == $role['id'] ? 'selected' : '' }}>
                                            {{ $role['name'] }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('role')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
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
