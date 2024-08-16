@extends('layout.admin_master')

@section('title', 'Trade Data - Create Top Country')
@section('header', 'Trade Data - Source')

@section('content')

    <div class="p-3 bg-white">

        <h5 class="fw-bold">Create Trade Data - Top Country</h5>

        <div class="pt-5">
            <form action="{{ route('admin.data.trade-data.save-top-country') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('post')

                <input type="hidden" name="type" value="top_country">

                <div class="d-flex">
                    <div class="form-group col-md-6">
                        <label for="title">Title <span class="text-danger">*</span></label>
                        <input type="text" id="title" class="form-control" name="title" placeholder="Enter title"
                            value="{{ old('title') }}" maxlength="50">

                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="files">Image <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" name="file" accept="image/*">

                        @error('file')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group col-md-12">
                    <label for="content">Content <span class="text-danger">*</span></label>
                    <textarea name="content" id="editor" cols="5" rows="5" class="form-control">{{ old('content') }}</textarea>

                    @error('content')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="d-flex">
                    <div class="form-group col-md-6">
                        <label for="membership_type">Status <span class="text-danger">*</span></label>
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
                </div>

                <div class="form-group col-md-12 text-right">
                    <button class="btn btn-sm btn-custom" type="submit">Create Top Country</button>
                </div>
            </form>
        </div>
    </div>

@endsection
