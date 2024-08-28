@extends('layout.admin_master')

@section('title', 'Settings - General')

@section('content')

    <div class="page-breadcrumb d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">General Settings</div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="p-4 border rounded">
                        <form action="{{ route('admin.settings.general') }}" method="post" enctype="multipart/form-data"
                            class="row g-3 needs-validation">
                            @csrf
                            @method('patch')

                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip01" class="form-label">App Name <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="app_name" placeholder="Application Name"
                                    value="{{ old('app_name', @$settings['app_name']) }}" maxlength="50">

                                @error('app_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip01" class="form-label">App Logo </label>
                                @if (isset($settings['app_logo']))
                                    <input type="hidden" name="app_logo_old" value="{{ $settings['app_logo'] }}">
                                    <a href="{{ $settings['app_logo'] ? asset('storage/' . $settings['app_logo']) : '' }}"
                                        class="badge alert-primary text-dark" target="_blank">
                                        View Logo
                                    </a>
                                @else
                                    <a href="{{ asset('storage/default/logo.png')  }}" class="badge alert-primary text-dark" target="_blank">
                                        View Logo
                                    </a>
                                @endif

                                <input type="file" class="form-control" name="app_logo">

                                @error('app_logo')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip01" class="form-label">Admin Mail <span
                                        class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="admin_mail" placeholder="Admin Mail"
                                    value="{{ old('admin_mail', @$settings['admin_mail']) }}" maxlength="50">

                                @error('admin_mail')
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


@section('scripts')

    <script type="text/javascript">
        var loadFile = function(event) {
            $('#output').show()
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
    </script>

@endsection
