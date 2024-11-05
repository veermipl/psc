@extends('layout.admin_master')

@section('title', 'council - Edit')
@section('header', 'Edit council')

@section('content')

    <div class="page-breadcrumb d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Edit Council </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="p-4 border rounded">
                        <form action="{{ route('admin.council.update', $data->id) }}" method="post" enctype="multipart/form-data"
                            class="row g-3 needs-validation">
                            @csrf
                              @method('Post')

                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip01" class="form-label">Name <span
                                        class="text-danger">*</span></label>
                                <input type="text" id="name" class="form-control" name="name"
                                    placeholder="Enter name" value="{{ old('name', @$data->name) }}" maxlength="100">

                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 position-relative">
                                    <label for="validationTooltip01" class="form-label">Designattion </label>
                                        <input type="text" id="designattion" class="form-control" name="designattion"
                                            placeholder="Enter Designattion" value="{{ old('designattion', @$data->designattion) }}" maxlength="100">

                                        @error('designattion')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                            </div>
                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip01" class="form-label">Upload Profile Image <span
                                        class="text-danger">*</span></label>
                                <input type="file" id="profile" class="form-control" name="profile" accept="application/jpge/jig/png">

                                @error('profile')
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
                                        {{ $data->status == $status['value'] ? 'selected' : '' }}>
                                            {{ $status['name'] }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 position-relative">
                            @if (@$data->image)
                                      <img class="ge_img pop_up_image" src="{{ asset('storage/' . $data->image) }}">
                                  @endif
                            </div>

                            <div class="col-12 text-end mt-5">
                                <button class="btn btn-sm btn-primary" type="submit">update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
