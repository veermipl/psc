@extends('layout.master')

@section('title', 'Update Profile')
@section('header', 'Update Profile')

@section('content')

<div class="wrapper">
    <div class="page-content-wrapper">
        <div class="page-content">

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
                                    <input type="hidden" name="old_profile_image" value="{{ @$UserDetails['profile_image'] }}">
                                    <input type="hidden" name="old_background_image" value="{{ @$UserDetails['background_image'] }}">

                                    <div class="col-md-6 form-group">
                                        <label for="validationTooltip01" class="form-label">Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="name" placeholder="Enter name" value="{{ old('name', $user->name) }}" maxlength="50">

                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="validationTooltip01" class="form-label">Profile Image </label>
                                        <input type="file" class="form-control" name="profile_image">

                                        @error('profile_image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="validationTooltip01" class="form-label">Email </label>
                                        <input type="email" class="form-control" name="email" placeholder="Enter email" value="{{ old('email', $user->email) }}" readonly disabled>

                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="validationTooltip01" class="form-label">Mobile </label>
                                        <input type="text" class="form-control" name="mobile_number" placeholder="Enter mobile number" value="{{ old('mobile_number', $user->mobile_number) }}" maxlength="50">

                                        @error('mobile_number')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="validationTooltip01" class="form-label">DOB </label>
                                        <input type="date" class="form-control" name="date_of_birth" value="{{ old('date_of_birth', @$UserDetails['date_of_birth']) }}" maxlength="50">

                                        @error('date_of_birth')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="validationTooltip01" class="form-label">Gender </label>
                                        <select name="gender" class="form-control">
                                            <option hidden value="">Gender</option>
                                            @foreach (config('site.gender') as $gender)
                                                <option value="{{ $gender['value'] }}"
                                                    {{ old('gender', @$UserDetails['gender']) == $gender['value'] ? 'selected' : '' }}>
                                                    {{ $gender['name'] }}
                                                </option>
                                            @endforeach
                                        </select>

                                        @error('gender')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="validationTooltip01" class="form-label">Website URL</label>
                                        <input type="text" class="form-control" name="connect_url" placeholder="Enter your website url" value="{{ old('connect_url', @$UserDetails['connect_url']) }}" maxlength="50">

                                        @error('connect_url')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="validationTooltip01" class="form-label">Facebook URL</label>
                                        <input type="text" class="form-control" name="connect_fb" placeholder="Enter your facebook url" value="{{ old('connect_fb', @$UserDetails['connect_fb']) }}" maxlength="50">

                                        @error('connect_fb')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="validationTooltip01" class="form-label">Twitter URL</label>
                                        <input type="text" class="form-control" name="connect_twitter" placeholder="Enter your website url" value="{{ old('connect_twitter', @$UserDetails['connect_twitter']) }}" maxlength="50">

                                        @error('connect_twitter')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="validationTooltip01" class="form-label">Linkedin URL</label>
                                        <input type="text" class="form-control" name="connect_linkedin" placeholder="Enter your linkedin url" value="{{ old('connect_linkedin', @$UserDetails['connect_linkedin']) }}" maxlength="50">

                                        @error('connect_linkedin')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="validationTooltip01" class="form-label">Address </label>
                                        <input type="text" class="form-control" name="address" placeholder="Enter address" value="{{ old('address', @$UserDetails['address']) }}" maxlength="50">

                                        @error('address')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="validationTooltip01" class="form-label">Location </label>
                                        <input type="text" class="form-control" name="location" placeholder="Enter location" value="{{ old('location', @$UserDetails['location']) }}" maxlength="50">

                                        @error('location')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-12 form-group">
                                        <label for="validationTooltip01" class="form-label">About Me</label>
                                        <textarea name="about_me" id="editor" cols="2" rows="2" class="form-control">{{ old('about_me', @$UserDetails['about_me']) }}</textarea>

                                        @error('about_me')
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

        </div>
    </div>
</div>

@endsection



@section('scripts')

    <script type="text/javascript">
        $(document).ready(function() {});
    </script>

@endsection
