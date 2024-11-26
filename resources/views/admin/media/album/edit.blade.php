@extends('layout.admin_master')

@section('title', 'Album - Update')
@section('header', 'Update Album')

@section('content')

    <div class="page-breadcrumb d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Update Album</div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="p-4 border rounded">
                        <form action="{{ route('admin.media-center.album.update', $album->id) }}" method="post"
                            enctype="multipart/form-data" class="row g-3 needs-validation">
                            @csrf
                            @method('patch')

                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip01" class="form-label">Album Name <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="title" placeholder="Album Name"
                                    value="{{ old('title', $album->name) }}"  maxlength="100">

                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip01" class="form-label">Album Cover</label>

                                @if ($album->image)
                                    <input type="hidden" name="old_image" value="{{ $album->image }}">
                                    <a href="{{ $album->image ? asset('storage/' . $album->image) : '' }}"
                                        class="badge alert-primary text-dark" target="_blank">
                                        View Album Cover
                                    </a>
                                @else
                                    <a href="{{ asset('storage/default/logo.png')  }}" class="badge alert-primary text-dark" target="_blank">
                                        View Logo
                                    </a>
                                @endif

                                <input type="file" class="form-control" name="image" accept="image/*">

                                @error('image')
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
                                            {{ old('status', $album->status) == $status['value'] ? 'selected' : '' }}>
                                            {{ $status['name'] }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
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
