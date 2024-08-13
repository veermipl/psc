@extends('layout.admin_master')

@section('title', 'Member Benefit - Update')
@section('header', 'Update Member Benefit')

@section('content')

    <div class="p-3 bg-white">

        <h5 class="fw-bold">Update Member Benefit</h5>

        <div class="pt-5">
            <form action="{{ route('admin.membership.member-benefit.update', $member_benefit->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('patch')

                <div class="d-flex">
                    <div class="form-group col-md-6">
                        <label for="name">Name <span class="text-danger">*</span></label>
                        <input type="text" id="name" class="form-control" name="name" placeholder="Enter name"
                            value="{{ old('name', $member_benefit->name) }}" maxlength="50">

                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="membership_type">Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-control">
                            <option hidden value="">Status</option>
                            @foreach (config('site.status') as $status)
                                <option value="{{ $status['value'] }}"
                                    {{ old('status', $member_benefit->status) == $status['value'] ? 'selected' : '' }}>
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
                    <button class="btn btn-sm btn-custom" type="submit">Update Member Benefit</button>
                </div>
            </form>
        </div>
    </div>

@endsection



@section('scripts')

    <script type="text/javascript">
    </script>

@endsection