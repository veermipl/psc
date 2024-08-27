@extends('layout.admin_master')

@section('title', 'Update Profile')
@section('header', 'Update Profile')

@section('content')

    <div class="page-breadcrumb d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Update Profile</div> {{ print_r($errors->all()) }}
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="p-4 border rounded">
                        <form action="{{ route('profile.update') }}" method="post"
                            enctype="multipart/form-data" class="row g-3 needs-validation">
                            @csrf
                            @method('post')

                            <input type="hidden" name="user_id" value="{{ $user->id }}">

                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip01" class="form-label">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" placeholder="Enter name" value="{{ old('name', $user->name) }}" maxlength="50">

                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip01" class="form-label">Profile Image </label>
                                <input type="file" class="form-control" name="profile_image">

                                @error('profile_image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip01" class="form-label">Email </label>
                                <input type="email" class="form-control" name="email" placeholder="Enter email" value="{{ old('email', $user->email) }}" readonly disabled>

                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip01" class="form-label">Mobile </label>
                                <input type="text" class="form-control" name="mobile_number" placeholder="Enter mobile number" value="{{ old('mobile_number', $user->mobile_number) }}" maxlength="50">

                                @error('mobile_number')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-12 position-relative">
                                <label for="validationTooltip01" class="form-label">About Me</label>
                                <textarea name="about_me" id="editor" cols="2" rows="2" class="form-control">{{ old('about_me', @$UserDetails['about_me']) }}</textarea>

                                @error('about_me')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip01" class="form-label">Address </label>
                                <input type="text" class="form-control" name="address" placeholder="Enter address" value="{{ old('address', @$UserDetails['address']) }}" maxlength="50">

                                @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip01" class="form-label">Location </label>
                                <input type="text" class="form-control" name="location" placeholder="Enter location" value="{{ old('location', @$UserDetails['location']) }}" maxlength="50">

                                @error('location')
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
        $(document).ready(function() {});
    </script>

@endsection
