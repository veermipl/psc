@extends('layout.admin_master')

@section('title', 'Photo - Update')
@section('header', 'Update Photo')

@section('content')

    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Update Photo</div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="p-4 border rounded">
                        <form action="{{ route('admin.media-center.photo.update', $photo->id) }}" method="post" enctype="multipart/form-data" class="row g-3 needs-validation">
                            @csrf
                            @method('patch')

                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip01" class="form-label">Image </label>
                                <input type="file" class="form-control" name="image" accept="image/*">

                                @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip01" class="form-label">Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="title" placeholder="Image title" value="{{ old('title', $photo->title) }}">

                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip01" class="form-label">Status <span class="text-danger">*</span></label>
                                <select name="status" class="form-control">
                                    <option hidden value="">Status</option>
                                    @foreach (config('site.status') as $status)
                                        <option value="{{ $status['value'] }}"
                                            {{ old('status', $photo->status) == $status['value'] ? 'selected' : '' }}>
                                            {{ $status['name'] }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-12 position-relative">
                                @if ($photo->name)
                                    <div class="editImgWrapper_" img_row_url="{{ $photo->name }}">
                                        <input type="hidden" name="old_image" value="{{ $photo->name }}">
                                        <img class="li_img_ pop_up_image" src="{{ asset('storage/' . $photo->name) }}" width="500px">
                                    </div>
                                @else
                                    <p class="text-danger">No Image</p>
                                @endif
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

        $(document).on('click', '.deleteImgBtn', function(e) {
            e.preventDefault();

        });

    });
</script>

@endsection
