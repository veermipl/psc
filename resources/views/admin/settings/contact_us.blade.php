@extends('layout.admin_master')

@section('title', 'CMS - Contact Us')

@section('content')

    <div class="p-3 bg-white">

        <h5 class="fw-bold">Contact Us</h5>

        <div class="pt-5">
            <form action="{{ route('admin.settings.contact-us') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('patch')

                <div class="form-group col-md-12">
                    <label for="content">Content <span class="text-danger">*</span></label>
                    <textarea name="content" id="editor" cols="5" rows="5" class="form-control">{{ old('content', @$settings['content']) }}</textarea>

                    @error('content')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="d-flex">
                    <div class="form-group col-md-6">
                        <label for="name">Opening Hours <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="opening_hours" placeholder="Opening Hours"
                            value="{{ old('opening_hours', @$settings['opening_hours']) }}" maxlength="50">

                        @error('opening_hours')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="name">Phone <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="phone" placeholder="Phone"
                            value="{{ old('phone', @$settings['phone']) }}" maxlength="50">

                        @error('phone')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="d-flex">
                    <div class="form-group col-md-6">
                        <label for="name">Address <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="address" placeholder="Address"
                            value="{{ old('address', @$settings['address']) }}" maxlength="50">

                        @error('address')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="name">Email <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="email" placeholder="Email"
                            value="{{ old('email', @$settings['email']) }}" maxlength="50">

                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <h6 class="fw-bold py-4">Connect with us:</h6>

                <div class="d-flex">
                    <div class="form-group col-md-6">
                        <label for="name">Facebook <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="facebook" placeholder="Facebook"
                            value="{{ old('facebook', @$settings['facebook']) }}" maxlength="50">

                        @error('facebook')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="name">Twitter <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="twitter" placeholder="Twitter"
                            value="{{ old('twitter', @$settings['twitter']) }}" maxlength="50">

                        @error('twitter')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="d-flex">
                    <div class="form-group col-md-6">
                        <label for="name">Instagram <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="instagram" placeholder="Instagram"
                            value="{{ old('instagram', @$settings['instagram']) }}" maxlength="50">

                        @error('instagram')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="name">Youtube <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="youtube" placeholder="Youtube"
                            value="{{ old('youtube', @$settings['youtube']) }}" maxlength="50">

                        @error('youtube')
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
