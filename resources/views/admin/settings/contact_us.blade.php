@extends('layout.admin_master')

@section('title', 'CMS - Contact Us')

@section('content')

    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Contact Us</div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="p-4 border rounded">
                        <form action="{{ route('admin.settings.contact-us') }}" method="post" enctype="multipart/form-data" class="row g-3 needs-validation">
                            @csrf
                            @method('patch')

                            <div class="col-md-12 position-relative">
                                <label for="validationTooltip01" class="form-label">Content <span class="text-danger">*</span></label>
                                <textarea name="content" id="editor" cols="5" rows="5" class="form-control">{{ old('content', @$settings['content']) }}</textarea>

                                @error('content')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip01" class="form-label">Opening Hours <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="opening_hours" placeholder="Opening Hours"
                                    value="{{ old('opening_hours', @$settings['opening_hours']) }}" maxlength="50">

                                @error('opening_hours')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip01" class="form-label">Phone <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="phone" placeholder="Phone"
                                    value="{{ old('phone', @$settings['phone']) }}" maxlength="50">

                                @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip01" class="form-label">Address <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="address" placeholder="Address"
                                    value="{{ old('address', @$settings['address']) }}" maxlength="50">

                                @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip01" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="email" placeholder="Email"
                                    value="{{ old('email', @$settings['email']) }}" maxlength="50">

                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <h6 class="fw-bold mt-5 mb-0">Connect with us</h6>

                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip01" class="form-label">Facebook <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="facebook" placeholder="Facebook"
                                    value="{{ old('facebook', @$settings['facebook']) }}" maxlength="50">

                                @error('facebook')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip01" class="form-label">Twitter <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="twitter" placeholder="Twitter"
                                    value="{{ old('twitter', @$settings['twitter']) }}" maxlength="50">

                                @error('twitter')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip01" class="form-label">Instagram <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="instagram" placeholder="Instagram"
                                    value="{{ old('instagram', @$settings['instagram']) }}" maxlength="50">

                                @error('instagram')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip01" class="form-label">Youtube <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="youtube" placeholder="Youtube"
                                    value="{{ old('youtube', @$settings['youtube']) }}" maxlength="50">

                                @error('youtube')
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
