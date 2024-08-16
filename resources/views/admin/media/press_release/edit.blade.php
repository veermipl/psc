@extends('layout.admin_master')

@section('title', 'Press Release - Update')
@section('header', 'Update Press Release')

@section('content')

    <div class="p-3 bg-white">

        <h5 class="fw-bold">Update Press Release</h5>

        <div class="pt-5">
            <form action="{{ route('admin.media-center.press-release.update', $press_release->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('patch')

                <div class="d-flex">
                    <div class="form-group col-md-6">
                        <label for="title">Title <span class="text-danger">*</span></label>
                        <input type="text" id="name" class="form-control" name="title" placeholder="Enter title"
                            value="{{ old('title', $press_release->title) }}" maxlength="50">

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
                    <textarea name="content" id="editor" cols="5" rows="5" class="form-control">{{ old('content', $press_release->content) }}</textarea>

                    @error('content')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="d-flex">
                    <div class="form-group col-md-12">
                        @if ($press_release->files)
                            @php
                                $press_release_files = explode(',', $press_release->files);
                            @endphp

                            <div class="allFileWrapper d-flex">
                                @foreach ($press_release_files as $fileKey => $fileValue)
                                    @if ($fileValue)
                                        @php
                                            $fileInfo = pathinfo($fileValue);
                                            $extension = $fileInfo['extension'];
                                        @endphp

                                        <div class="editFileWrapper" file_row_url="{{ $fileValue }}">
                                            <input type="hidden" name="old_files[]" value="{{ $fileValue }}">
                                            @if (in_array($extension, ['jpg', 'jpeg', 'gif', 'png']))
                                                <img class="li_img pop_up_image" src="{{ asset('storage/' . $fileValue) }}">
                                            @endif
                                            @if (in_array($extension, ['pdf']))
                                                <img class="li_img pop_up_doc" src="{{ asset('storage/default/pdf.png') }}">
                                            @endif
                                            <button class="btn btn-sm btn-outline-danger mt-2 deleteFileBtn" type="button" id="{{ $press_release->id }}" file_url="{{ $fileValue }}">
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
                        <label for="status">Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-control">
                            <option hidden value="">Status</option>
                            @foreach (config('site.status') as $status)
                                <option value="{{ $status['value'] }}"
                                    {{ old('status', $press_release->status) == $status['value'] ? 'selected' : '' }}>
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
                    <button class="btn btn-sm btn-custom" type="submit">Update Press Release</button>
                </div>
            </form>
        </div>
    </div>

@endsection



@section('scripts')

<script type="text/javascript">
    $(document).ready(function() {

        $(document).on('click', '.deleteFileBtn', function(e) {
            e.preventDefault();

            var id = $(this).attr('id');
            var file_url = $(this).attr('file_url');

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
                        url: "{{ route('admin.media-center.press-release.delete-file') }}",
                        method: 'POST',
                        data: {
                            _method: 'post',
                            _token: '{{ csrf_token() }}',
                            id: id,
                            file_url: file_url,
                        },
                        dataType: "json",
                        beforeSend: function() {
                            // $('.preloader').show();
                        },
                        success: function(response) {
                            if (response.error === false) {
                                $('div.editFileWrapper[file_row_url="'+file_url+'"]').remove();

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
