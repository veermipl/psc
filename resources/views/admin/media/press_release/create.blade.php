@extends('layout.admin_master')

@section('title', 'Press Release - Create')
@section('header', 'Create Press Release')

@section('content')

    <div class="p-3 bg-white">

        <h5 class="fw-bold">Create Press Release</h5>

        <div class="pt-5">
            <form action="{{ route('admin.media-center.press-release.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('post')

                <div class="d-flex">
                    <div class="form-group col-md-6">
                        <label for="title">Title <span class="text-danger">*</span></label>
                        <input type="text" id="name" class="form-control" name="title" placeholder="Enter title"
                            value="{{ old('title') }}" maxlength="50">

                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="files">Files </label>
                        <input type="file" class="form-control" name="files[]" accept="image/*,application/pdf" multiple>

                        @if ($errors->has('files.*'))
                            @foreach ($errors->get('files.*') as $error)
                                @foreach ($error as $message)
                                    <span class="text-danger">{{ $message }}</span><br>
                                @endforeach
                            @endforeach
                        @endif
                    </div>
                </div>

                <div class="form-group col-md-12">
                    <label for="content">Content</label>
                    <textarea name="content" id="editor" cols="5" rows="5" class="form-control">{{ old('content') }}</textarea>

                    @error('content')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="d-flex">
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
                    <button class="btn btn-sm btn-custom" type="submit">Create Press Release</button>
                </div>
            </form>
        </div>
    </div>

@endsection
