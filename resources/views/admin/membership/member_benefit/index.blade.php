@extends('layout.admin_master')

@section('title', 'Member Benefit - Update')
@section('header', 'Member Benefit')

@section('content')

    <div class="page-breadcrumb d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Member Benefits</div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="p-4 border rounded">
                        <form action="{{ route('admin.membership.member-benefit.update') }}" method="post"
                            enctype="multipart/form-data" class="row g-3 needs-validation">
                            @csrf
                            @method('post')

                            <input type="hidden" name="type" value="main">
                            <input type="hidden" name="old_file" value="{{ @$main->file }}">

                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip01" class="form-label">Title <span
                                        class="text-danger">*</span></label>
                                <input type="text" id="title" class="form-control" name="title"
                                    placeholder="Enter title" value="{{ old('title', @$main->title) }}" maxlength="50">

                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip01" class="form-label">Image <span
                                        class="text-danger">*</span></label>
                                <input type="file" class="form-control" name="file" accept="image/*">

                                @error('file')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-12 position-relative">
                                <label for="validationTooltip01" class="form-label">Content <span
                                        class="text-danger">*</span></label>
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


@section('scripts')

    <script type="text/javascript">
        $(document).ready(function() {

        });
    </script>

@endsection
