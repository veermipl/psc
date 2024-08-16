@extends('layout.admin_master')

@section('title', 'Role - Create')
@section('header', 'Create Role')

@section('content')

    <div class="p-3 bg-white">

        <h5 class="fw-bold">Create Role</h5>

        <div class="pt-5">
            <form action="{{ route('admin.authorization.role.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('post')

                <div class="form-group col-md-12">
                    <label for="name">Name <span class="text-danger">*</span></label>
                    <input type="text" id="name" class="form-control" name="name" placeholder="Enter name"
                        value="{{ old('name') }}" maxlength="50">

                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group col-md-12">
                    <label for="permission">Permissions <span class="text-danger">*</span></label><br>
                    @error('permissions')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <div id="accordion">
                        @foreach($permissionModule as $key => $module)
                            @php
                                $module_str = Str::of($module)->replace([' ', '-'], '_')->lower();
                            @endphp
                            <div class="card">
                                <div class="card-header" id="heading{{ $module_str }}">
                                    <h5 class="mb-0">
                                        <button class="btn btn-sm btn-link" data-toggle="collapse" data-target="#collapse{{ $module_str }}"
                                            aria-expanded="true" aria-controls="collapse{{ $module_str }}" type="button">
                                            {{ $module }}
                                        </button>
                                    </h5>
                                </div>

                                <div id="collapse{{ $module_str }}" class="collapse {{ $key == 0 ? 'show' : '' }}" aria-labelledby="heading{{ $module_str }}"
                                    data-parent="#accordion">
                                    <div class="card-body">
                                        <div class="persWrapper row">
                                            @foreach ($permissionList as $permissionKey => $permissionValue)
                                                @if ($permissionValue['module'] === $module)
                                                    <div class="perWrapper col-md-4">
                                                        <input type="checkbox" name="permissions[{{ $permissionValue['name_key'] }}]">
                                                        <label for="">{{ $permissionValue['name'] }}</label>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>

                <div class="form-group col-md-12 text-right">
                    <button class="btn btn-sm btn-custom" type="submit">Create Role</button>
                </div>
            </form>
        </div>
    </div>

@endsection
