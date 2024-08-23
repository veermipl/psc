@extends('layout.admin_master')

@section('title', 'Role - View')
@section('header', 'View Role')

@section('content')

    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">View Role</div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="p-4 border rounded">
                        <div class="row g-3 needs-validation">
                            <div class="col-md-12 position-relative">
                                <label for="validationTooltip01" class="form-label">Role</label><br>
                                <input type="text" id="role" class="form-control" name="role" placeholder="Enter role" value="{{ $role->name }}" maxlength="50" disabled readonly>
                            </div>

                            <div class="col-md-12 position-relative">
                                <label for="validationTooltip01" class="form-label">Permissions</label>
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
                                                                    <i class="fa fa-circle text-success"></i>
                                                                    <label>{{ $permissionValue['name'] }}</label>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
