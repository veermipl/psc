@extends('layout.admin_master')

@section('title', 'Press Release - Create')
@section('header', 'Create Press Release')

@section('content')

    <div class="page-breadcrumb d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Create Press Release</div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="p-4 border rounded">
                        <form action="{{ route('admin.media-center.press-release.store') }}" method="post"
                            enctype="multipart/form-data" class="row g-3 needs-validation">
                            @csrf
                            @method('post')

                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip01" class="form-label">Title <span
                                        class="text-danger">*</span></label>
                                <input type="text" id="name" class="form-control" name="title"
                                    placeholder="Enter title" value="{{ old('title') }}" maxlength="50">

                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip01" class="form-label">Files </label>
                                <input type="file" class="form-control" name="files[]" accept="image/*,application/pdf"
                                    multiple>

                                @if ($errors->has('files.*'))
                                    @foreach ($errors->get('files.*') as $error)
                                        @foreach ($error as $message)
                                            <span class="text-danger">{{ $message }}</span><br>
                                        @endforeach
                                    @endforeach
                                @endif
                            </div>

                            <div class="col-md-12 position-relative">
                                <label for="validationTooltip01" class="form-label">Content</label>
                                <textarea name="content" id="editor" cols="5" rows="5" class="form-control">{{ old('content') }}</textarea>

                                @error('content')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip01" class="form-label">Status <span
                                        class="text-danger">*</span></label>
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

                            <div class="col-12 text-end mt-5">
                                <button class="btn btn-sm btn-primary" type="submit">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
