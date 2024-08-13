@extends('layout.admin_master')

@section('title', 'Photo - Update')
@section('header', 'Update Photo')

@section('content')

    <div class="p-3 bg-white">

        <h5 class="fw-bold">Update Photo</h5>

        <div class="pt-5">
            <form action="{{ route('admin.media-center.photo.update', $photo->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('patch')

                <div class="d-flex">
                    <div class="form-group col-md-6">
                        <label for="images">Image </label>
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
                                    {{ old('status', $photo->status) == $status['value'] ? 'selected' : '' }}>
                                    {{ $status['name'] }}
                                </option>
                            @endforeach
                        </select>

                        @error('status')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group col-md-12">
                    @if ($photo->name)
                        <div class="editImgWrapper_" img_row_url="{{ $photo->name }}">
                            <input type="hidden" name="old_image" value="{{ $photo->name }}">
                            <img class="li_img_ pop_up_image" src="{{ asset('storage/' . $photo->name) }}" width="500px">
                        </div>
                    @else
                        <p class="text-danger">No Image</p>
                    @endif
                </div>

                <div class="form-group col-md-12 text-right">
                    <button class="btn btn-sm btn-custom" type="submit">Update Photo</button>
                </div>
            </form>
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
