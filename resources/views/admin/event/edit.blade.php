@extends('layout.admin_master')

@section('title', 'Event - Edit')
@section('header', 'Edit Event')

@section('content')

    <div class="page-breadcrumb d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Edit Event</div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="p-4 border rounded">
                        <form action="{{ route('admin.event.update', $data->id ) }}" method="post" enctype="multipart/form-data"
                            class="row g-3 needs-validation">
                            @csrf
                            @method('post')

                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip01" class="form-label">Title <span
                                        class="text-danger">*</span></label>
                                <input type="text" id="title" class="form-control" name="title"
                                    placeholder="Enter Title" value="{{ old('title', @$data->title) }}" maxlength="50">

                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip01" class="form-label">Location </label>
                                <input type="text" id="location" class="form-control" name="location"
                                    value="{{ old('location', @$data->location) }}" placeholder="Enter location" maxlength="100">

                                @error('location')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip01" class="form-label">Date and time </label>
                                <input type="datetime-local" id="date_time" class="form-control" name="date_time"
                                    value="{{ old('date_time', @$data->date_time) }}" placeholder="Enter date_time"  max="2999-12-31T23:59">

                                @error('location')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip01" class="form-label">Upload Image  <span
                                        class="text-danger">*</span></label>
                                <input type="file" id="image" class="form-control" name="image"  accept="image/*">

                                @if (@$data->image)
                                      <img class="ge_img pop_up_image mt-3" src="{{ asset('storage/' . @$data->image) }}">
                                  @endif

                                @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>

                            <div class="col-md-6 position-relative">

                                <label for="validationTooltip01" class="form-label">Upload Gallery Image<span
                                        class="text-danger">*</span></label>
                                <input type="file" id="files" class="form-control"
                                    name="files[]" accept="image/*" multiple>

                                @error('files')
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
                                        {{ old('status', $data->status) == $status['value'] ? 'selected' : '' }}>
                                            {{ $status['name'] }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>




                            <div class="col-md-12 position-relative">
                            @if ($data->files)
                                @php
                                    $files = explode(',', $data->files);
                                @endphp
                            <div class="row ">
                            @foreach ($files as $fileKey => $fileValue)
                                    @if ($fileValue)
                                        @php
                                            $fileInfo = pathinfo($fileValue);
                                            $extension = $fileInfo['extension'];
                                        @endphp
                                            <div class="col-md-1 mb-3">
                                            <input type="hidden" name="old_files[]" value="{{ $fileValue }}">
                                                        @if (in_array($extension, ['jpg', 'jpeg', 'gif', 'png']))
                                                            <img class="li_img pop_up_image" src="{{ asset('storage/' . $fileValue) }}">
                                                        @endif
                                                        <button class="btn btn-sm btn-outline-danger mt-2 deleteFileBtn"
                                                            type="button" data-id="{{ $data->id }}" file_url="{{ $fileValue }}">
                                                            Delete
                                                        </button>

                                            </div>
                                         @endif
                                    @endforeach

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

        $(document).on('click', '.deleteFileBtn', function(e) {
            e.preventDefault();

            var id = $(this).data('id'); // Using `data` instead of `attr`
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
                        url: "{{ route('admin.event.deleteFile') }}",
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
                                $('div.editFileWrapper[file_row_url="' + file_url + '"]').remove();
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
