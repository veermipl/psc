@extends('layout.admin_master')

@section('title', 'Settings - Email')

@section('content')

    <div class="p-3 bg-white">
        <h5 class="fw-bold">Email Settings</h5>

        <div class="pt-5">
            <form action="{{ route('admin.settings.email') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('patch')

                <div class="d-flex">
                    <div class="form-group col-md-6">
                        <label for="name">Email Address <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="email_address" placeholder="Email Address"
                            value="{{ old('email_address', @$settings['email_address']) }}" maxlength="50">

                        @error('email_address')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="name">Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" name="password" placeholder="Password"
                            value="{{ old('password', @$settings['password']) }}" maxlength="50">

                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="d-flex">
                    <div class="form-group col-md-6">
                        <label for="name">Host <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="host" placeholder="Host"
                            value="{{ old('host', @$settings['host']) }}" maxlength="50">

                        @error('host')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="name">Port <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="port" placeholder="Port"
                            value="{{ old('port', @$settings['port']) }}" maxlength="50">

                        @error('port')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group col-md-12 text-right">
                    <button class="btn btn-sm btn-custom" type="submit">Update</button>
                </div>
            </form>
        </div>
    </div>

@endsection
