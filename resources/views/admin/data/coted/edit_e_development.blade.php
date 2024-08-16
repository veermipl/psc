@extends('layout.admin_master')

@section('title', 'COTED - Update Entrepreneurship Development')
@section('header', 'COTED - Entrepreneurship Development')

@section('content')

    <div class="p-3 bg-white">

        <h5 class="fw-bold">Update COTED - Entrepreneurship Development</h5>

        <div class="pt-5">
            <form action="{{ route('admin.data.coted.update-entrepreneurship-development') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('post')

                <input type="hidden" name="type" value="entrepreneurship_development">
                <input type="hidden" name="source_id" value="{{ $source->id }}">
                <input type="hidden" name="old_file" value="{{ $source->file }}">

                <div class="d-flex">
                    <div class="form-group col-md-6">
                        <label for="title">Title <span class="text-danger">*</span></label>
                        <input type="text" id="title" class="form-control" name="title" placeholder="Enter title"
                            value="{{ old('title', $source->title) }}" maxlength="50">

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
                    <textarea name="content" id="editor" cols="5" rows="5" class="form-control">{{ old('content', $source->content) }}</textarea>

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
                                    {{ old('status', $source->status) == $status['value'] ? 'selected' : '' }}>
                                    {{ $status['name'] }}
                                </option>
                            @endforeach
                        </select>

                        @error('status')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                    </div>
                </div>

                <div class="d-flex">
                    <div class="form-group col-md-12">
                        @if ($source->file)
                            <img class="ge_img pop_up_image" src="{{ asset('storage/' . $source->file) }}">
                        @endif
                    </div>
                </div>

                <div class="form-group col-md-12 text-right">
                    <button class="btn btn-sm btn-custom" type="submit">Update Entrepreneurship Development</button>
                </div>
            </form>
        </div>
    </div>

@endsection



@section('scripts')

    <script type="text/javascript">
        $(document).ready(function() {
        });
    </script>

@endsection