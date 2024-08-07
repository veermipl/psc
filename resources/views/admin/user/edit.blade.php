@extends('layout.admin_master')

@section('title', 'User - Update')
@section('header', 'Update User')

@section('content')

    <div class="p-3 bg-white">

        <h5 class="fw-bold">Update User</h5>

        <div class="pt-5">
            <form action="{{ route('admin.user.update', $user->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('patch')

                <div class="d-flex">
                    <div class="form-group col-md-6">
                        <label for="name">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" placeholder="Enter name"
                            value="{{ old('name', $user->name) }}" maxlength="50">

                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="email">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}"
                            placeholder="Enter email" maxlength="50" readonly disabled>

                        @error('email')
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
                                    {{ old('status', $user->status) == $status['value'] ? 'selected' : '' }}>
                                    {{ $status['name'] }}
                                </option>
                            @endforeach
                        </select>

                        @error('status')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="confirmed">Role <span class="text-danger">*</span></label>
                        <select name="role" class="form-control">
                            <option hidden value="">Role</option>
                            @foreach ($roleList as $role)
                                <option value="{{ $role['id'] }}" {{ in_array($role['id'], $userRoles) ? 'selected' : '' }}>
                                    {{ $role['name'] }}
                                </option>
                            @endforeach
                        </select>

                        @error('role')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="d-flex">
                    <div class="form-group col-md-6">
                        <label for="confirmed">Password </label>
                        <input type="password" id="password" class="form-control" name="password" value=""
                            placeholder="Change password" maxlength="50">

                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group col-md-12 text-right">
                    <button class="btn btn-sm btn-custom" type="submit">Update User</button>
                </div>
            </form>
        </div>
    </div>

@endsection
