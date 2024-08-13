@extends('layout.admin_master')

@section('title', 'CMS - Guyana Economy')

@section('content')

    <div class="p-3 bg-white">
        <h5 class="fw-bold">Guyana Economy</h5>

        <div class="pt-5">
            <form action="{{ route('admin.cms.guyana-economy.update') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('patch')

                <input type="hidden" name="id" value="{{ $ge_data->id }}">

                <div class="d-flex">
                    <div class="form-group col-md-6">
                        <label for="name">Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="title" placeholder="Title"
                            value="{{ old('title', $ge_data->title) }}" maxlength="50">

                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="name">Images </label>
                        <input type="file" class="form-control" name="images[]" accept="image/*" multiple>

                        @error('images')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group col-md-12">
                    <label for="content">Content <span class="text-danger">*</span></label>
                    <textarea name="content" id="editor" cols="5" rows="5" class="form-control">{{ old('content', $ge_data->content) }}</textarea>

                    @error('content')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="d-flex">
                    <div class="form-group col-md-12">
                        @if ($ge_data->images)
                            @php
                                $ge_data_images = explode(',', $ge_data->images);
                            @endphp

                            <div class="allImgWrapper d-flex">
                                @foreach ($ge_data_images as $imgKey => $imgName)
                                    @if ($imgName)
                                        <div class="editImgWrapper" img_row_url="{{ $imgName }}">
                                            <input type="hidden" name="old_images[]" value="{{ $imgName }}">
                                            <img class="ge_img pop_up_image" src="{{ asset('storage/' . $imgName) }}">
                                            <button class="btn btn-sm btn-outline-danger mt-2 deleteImgBtn" type="button" id="{{ $ge_data->id }}" img_url="{{ $imgName }}">
                                                Delete
                                            </button>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <div class="d-flex">
                    <div class="form-group col-md-6">
                        <label for="membership_type">Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-control">
                            <option hidden value="">Status</option>
                            @foreach (config('site.status') as $status)
                                <option value="{{ $status['value'] }}"
                                    {{ old('status', $ge_data->status) == $status['value'] ? 'selected' : '' }}>
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

            $(document).on('click', '.deleteImgBtn', function(e) {
                e.preventDefault();

                var id = $(this).attr('id');
                var img_url = $(this).attr('img_url');

                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel!",
                    reverseButtons: true,
                    confirmButtonColor: '#24695c',
                    cancelButtonColor: '#d22d3d',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('admin.cms.guyana-economy.delete-image') }}",
                            method: 'POST',
                            data: {
                                _method: 'post',
                                _token: '{{ csrf_token() }}',
                                id: id,
                                img_url: img_url,
                            },
                            dataType: "json",
                            beforeSend: function() {
                                // $('.preloader').show();
                            },
                            success: function(response) {
                                if (response.error === false) {
                                    $('div.editImgWrapper[img_row_url="'+img_url+'"]').remove();

                                    toastr.success(response.msg);
                                } else {
                                    toastr.error(response.msg);
                                }
                            },
                            error: function(xhr, status, error) {
                                toastr.error(error);
                            },
                            complete: function(xhr, status) {
                                // $('.preloader').hide();
                            }
                        });
                    }
                });

            });
        });
    </script>

@endsection
