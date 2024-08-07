@extends('layout.admin_master')

@section('title', 'CMS - Contact Us')

@section('content')

    <div class="p-3 bg-white">

        <h5 class="fw-bold">Contact Us</h5>

        <div class="pt-5">
            {{-- <form action="{{ route('admin.settings.contact-us') }}" method="post" enctype="multipart/form-data"> --}}
            <form action="#" method="post" enctype="multipart/form-data">
                @csrf
                @method('post')

                <div class="d-flex">
                    <div class="form-group col-md-6">
                        <label for="name">Opening Hours <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="opening_hours" placeholder="Opening Hours"
                            value="{{ old('title') }}" maxlength="50">

                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="name">Phone <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="title" placeholder="Title"
                            value="{{ old('title') }}" maxlength="50">

                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="d-flex">
                    <div class="form-group col-md-6">
                        <label for="name">Address <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="title" placeholder="Title"
                            value="{{ old('title') }}" maxlength="50">

                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="name">Email <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="title" placeholder="Title"
                            value="{{ old('title') }}" maxlength="50">

                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group col-md-12">
                    <label for="content">Content <span class="text-danger">*</span></label>
                    <textarea name="content" id="" cols="30" rows="10" class="form-control"></textarea>

                    @error('content')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="d-flex">
                    <div class="form-group col-md-6">
                        <label for="name">Facebook <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="title" placeholder="Title"
                            value="{{ old('title') }}" maxlength="50">

                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="name">Twitter <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="title" placeholder="Title"
                            value="{{ old('title') }}" maxlength="50">

                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="d-flex">
                    <div class="form-group col-md-6">
                        <label for="name">Instagram <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="title" placeholder="Title"
                            value="{{ old('title') }}" maxlength="50">

                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="name">Youtube <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="title" placeholder="Title"
                            value="{{ old('title') }}" maxlength="50">

                        @error('title')
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
