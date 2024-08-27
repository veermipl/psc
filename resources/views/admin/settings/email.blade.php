@extends('layout.admin_master')

@section('title', 'Settings - Email')

@section('content')

    <div class="page-breadcrumb d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Email Settings</div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="p-4 border rounded">
                        <form action="{{ route('admin.settings.email') }}" method="post" enctype="multipart/form-data"
                            class="row g-3 needs-validation">
                            @csrf
                            @method('patch')

                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip01" class="form-label">Email Address <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="email_address" placeholder="Email Address"
                                    value="{{ old('email_address', @$settings['email_address']) }}" maxlength="50">

                                @error('email_address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip01" class="form-label">Password <span
                                        class="text-danger">*</span></label>
                                <input type="password" class="form-control" name="password" placeholder="Password"
                                    value="{{ old('password', @$settings['password']) }}" maxlength="50">

                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip01" class="form-label">Host <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="host" placeholder="Host"
                                    value="{{ old('host', @$settings['host']) }}" maxlength="50">

                                @error('host')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip01" class="form-label">Port <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="port" placeholder="Port"
                                    value="{{ old('port', @$settings['port']) }}" maxlength="50">

                                @error('port')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
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
