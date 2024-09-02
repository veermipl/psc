@extends('layout.admin_master')

@section('title', 'Role - Update')
@section('header', 'Update Role')

@section('content')

    <div class="page-breadcrumb d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Update Role</div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="p-4 border rounded">
                        <form action="{{ route('admin.authorization.role.update', $role->id) }}" method="post" enctype="multipart/form-data" class="row g-3 needs-validation">
                            @csrf
                            @method('patch')

                            <div class="col-md-12 position-relative">
                                <label for="validationTooltip01" class="form-label">Name <span class="text-danger">*</span></label>
                                <input type="text" id="name" class="form-control" name="name" placeholder="Enter name" value="{{ old('name', $role->name) }}" maxlength="50">

                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-12 position-relative">
                                <label for="validationTooltip01" class="form-label">Permissions <span class="text-danger">*</span></label><br>
                                @error('permissions')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                                <div class="accordion" id="accordionExample">
                                    @foreach($permissionModule as $key => $module)
                                        @php
                                            $module_str = Str::of($module)->replace([' ', '-'], '_')->lower();
                                        @endphp

                                        <div class="accordion-item">
                                            <h5 class="accordion-header" id="heading{{ $module_str }}">
                                                <button class="accordion-button {{ $key !== 0 ? 'collapsed' : '' }}" type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#collapse{{ $module_str }}" aria-expanded="{{ $key == 0 ? 'true' : 'false' }}"
                                                    aria-controls="collapse{{ $module_str }}">
                                                    {{ $module }}
                                                </button>
                                            </h5>

                                            <div id="collapse{{ $module_str }}" class="accordion-collapse collapse {{ $key == 0 ? 'show' : '' }}" aria-labelledby="heading{{ $module_str }}" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
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
        });
    </script>

@endsection