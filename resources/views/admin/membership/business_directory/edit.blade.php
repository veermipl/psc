@extends('layout.admin_master')

@section('title', 'Business Directory - Update')
@section('header', 'Update Business Directory')

@section('content')

    <div class="page-breadcrumb d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Update Business Directory</div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="p-4 border rounded">
                        <form action="{{ route('admin.membership.business-directory.update', $business_directory->id) }}"
                            method="post" enctype="multipart/form-data" class="row g-3 needs-validation">
                            @csrf
                            @method('patch')

                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip01" class="form-label">Name <span
                                        class="text-danger">*</span></label>
                                <input type="text" id="name" class="form-control" name="name"
                                    placeholder="Enter name" value="{{ old('name', $business_directory->name) }}"
                                    maxlength="100">

                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip01" class="form-label">Membership Type <span
                                        class="text-danger">*</span></label>
                                <select name="type" class="form-control">
                                    <option hidden value="">Membership Type</option>
                                    @foreach ($membershipList as $mKey => $mType)
                                        <option value="{{ $mType['id'] }}"
                                            {{ old('type', $business_directory->type) == $mType['id'] ? 'selected' : '' }}>
                                            {{ $mType['name'] }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('type')
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
                                            {{ old('status', $business_directory->status) == $status['value'] ? 'selected' : '' }}>
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
        $(document).ready(function() {});
    </script>

@endsection
