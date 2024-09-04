@extends('layout.admin_master')

@section('title', 'Caricom CET - Update How It Works')
@section('header', 'Caricom CET - Update How It Works')

@section('content')

    <div class="page-breadcrumb d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Caricom CET - Update How It Works</div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="p-4 border rounded">
                        <form action="{{ route('admin.data.caricom-cet.update-how-it-works') }}" method="post"
                            enctype="multipart/form-data" class="row g-3 needs-validation">
                            @csrf
                            @method('post')

                            <input type="hidden" name="type" value="how_it_works">
                            <input type="hidden" name="how_it_works_id" value="{{ $how_it_works->id }}">
                            <input type="hidden" name="old_file" value="{{ $how_it_works->file }}">

                            <div class="col-md-6 position-relative">
                                <label for="title">Title <span class="text-danger">*</span></label>
                                <input type="text" id="title" class="form-control" name="title"
                                    placeholder="Enter title" value="{{ old('title', $how_it_works->title) }}" maxlength="50">

                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 position-relative">
                                <label for="membership_type">Status <span class="text-danger">*</span></label>
                                <select name="status" class="form-control">
                                    <option hidden value="">Status</option>
                                    @foreach (config('site.status') as $status)
                                        <option value="{{ $status['value'] }}"
                                            {{ old('status', $how_it_works->status) == $status['value'] ? 'selected' : '' }}>
                                            {{ $status['name'] }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-12 position-relative">
                                <label for="content">Content <span class="text-danger">*</span></label>
                                <textarea name="content" id="editor" cols="5" rows="5" class="form-control">{{ old('content', $how_it_works->content) }}</textarea>

                                @error('content')
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
        $(document).ready(function() {});
    </script>

@endsection
