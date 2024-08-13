@extends('layout.admin_master')

@section('title', 'Photo - Create')
@section('header', 'Create Photo')

@section('content')

    <div class="p-3 bg-white">

        <h5 class="fw-bold">Create Photo</h5>

        <div class="pt-5">
            <form action="{{ route('admin.media-center.photo.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('post')

                <div class="d-flex">
                    <div class="form-group col-md-6">
                        <label for="image">Image <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" name="image" accept="image/*">

                        @error('image')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="status">Status <span class="text-danger">*</span></label>
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
                    <button class="btn btn-sm btn-custom" type="submit">Create Photo</button>
                </div>
            </form>
        </div>
    </div>

@endsection
