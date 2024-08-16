@extends('layout.admin_master')

@section('title', 'Member Benefit - Update')
@section('header', 'Member Benefit')

@section('content')

    <div class="p-3 bg-white">
        <h5 class="fw-bold">Update Member Benefit</h5>

        <div class="pt-5">
            <form action="{{ route('admin.membership.member-benefit.update') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('post')

                <input type="hidden" name="type" value="main">
                <input type="hidden" name="old_file" value="{{ @$main->file }}">

                <div class="d-flex">
                    <div class="form-group col-md-6">
                        <label for="title">Title <span class="text-danger">*</span></label>
                        <input type="text" id="title" class="form-control" name="title" placeholder="Enter title"
                            value="{{ old('title', @$main->title) }}" maxlength="50">

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
                    <textarea name="content" id="editor" cols="5" rows="5" class="form-control">{{ old('content', @$main->content) }}</textarea>

                    @error('content')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="d-flex">
                    <div class="form-group col-md-12">
                        @if (@$main->file)
                            <img class="ge_img pop_up_image" src="{{ asset('storage/' . $main->file) }}">
                        @endif
                    </div>
                </div>

                <div class="form-group col-md-12 text-right">
                    <button class="btn btn-sm btn-custom" type="submit">Update</button>
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
