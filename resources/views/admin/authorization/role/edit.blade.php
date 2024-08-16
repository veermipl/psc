@extends('layout.admin_master')

@section('title', 'Role - Update')
@section('header', 'Update Role')

@section('content')

    <div class="p-3 bg-white">

        <h5 class="fw-bold">Update Role</h5>

        <div class="pt-5">
            <form action="{{ route('admin.authorization.role.update', $role->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('patch')

                <div class="form-group col-md-12">
                    <label for="name">Name <span class="text-danger">*</span></label>
                    <input type="text" id="name" class="form-control" name="name" placeholder="Enter name"
                        value="{{ old('name', $role->name) }}" maxlength="50">

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
                                                        <input type="checkbox" name="permissions[{{ $permissionValue['name_key'] }}]" {{ in_array($permissionValue['name_key'], $rolePermissionList) ? 'checked' : '' }}>
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
                    <button class="btn btn-sm btn-custom" type="submit">Update Role</button>
                </div>
            </form>
        </div>
    </div>

@endsection



@section('scripts')

    <script type="text/javascript">
        $(document).ready(function() {
        });
    </script>

@endsection