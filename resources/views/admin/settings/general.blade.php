@extends('layout.admin_master')

@section('title', 'Settings - General')

@section('content')

    <div class="p-3 bg-white">
        <h5 class="fw-bold">General Settings</h5>

        <div class="pt-5">
            <form action="{{ route('admin.settings.general') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('patch')

                <div class="d-flex">
                    <div class="form-group col-md-6">
                        <label for="name">App Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="app_name" placeholder="Application Name"
                            value="{{ old('app_name', @$settings['app_name']) }}" maxlength="50">

                        @error('app_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="name">App Logo </label>
                        @if (isset($settings['app_logo']))
                            <input type="hidden" name="app_logo_old" value="{{ $settings['app_logo']  }}">
                            <a href="{{ $settings['app_logo'] ? asset('storage/' . $settings['app_logo']) : '' }}" class="badge badge-dark" target="_blank">
                                View Logo
                            </a>
                        @endif

                        <input type="file" class="form-control" name="app_logo">

                        @error('app_logo')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="d-flex">
                    <div class="form-group col-md-6">
                        <label for="name">Admin Mail <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" name="admin_mail" placeholder="Admin Mail"
                            value="{{ old('admin_mail', @$settings['admin_mail']) }}" maxlength="50">

                        @error('admin_mail')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                    </div>
                </div>

                <div class="form-group col-md-12 text-right">
                    <button class="btn btn-sm btn-custom" type="submit">Update</button>
                </div>
            </form>
        </div>
    </div>

@endsection
