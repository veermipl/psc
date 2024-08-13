@extends('layout.admin_master')

@section('title', 'Business Directory - Create')
@section('header', 'Create Business Directory')

@section('content')

    <div class="p-3 bg-white">

        <h5 class="fw-bold">Create Business Directory</h5>

        <div class="pt-5">
            <form action="{{ route('admin.membership.business-directory.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('post')

                <div class="d-flex">
                    <div class="form-group col-md-6">
                        <label for="name">Name <span class="text-danger">*</span></label>
                        <input type="text" id="name" class="form-control" name="name" placeholder="Enter name"
                            value="{{ old('name') }}" maxlength="50">

                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="sub_name">Sub Name</label>
                        <input type="text" id="sub_name" class="form-control" name="sub_name" placeholder="Enter sub name"
                            value="{{ old('sub_name') }}" maxlength="50">

                        @error('sub_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="d-flex">
                    <div class="form-group col-md-6">
                        <label for="membership_type">Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-control">
                            <option hidden value="">Status</option>
                            @foreach (config('site.status') as $status)
                                <option value="{{ $status['value'] }}"
                                    {{ old('status') == $status['value'] ? 'selected' : '' }}>
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
                    <button class="btn btn-sm btn-custom" type="submit">Create Business Directory</button>
                </div>
            </form>
        </div>
    </div>

@endsection
