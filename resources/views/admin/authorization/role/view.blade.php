@extends('layout.admin_master')

@section('title', 'Role - View')
@section('header', 'View Role')

@section('content')

    <div class="p-3 bg-white">

        <h5 class="fw-bold">View Role</h5>

        <div class="pt-5">
            <div class="form-group col-md-12">
                <label for="role" class="fw-bold">Role</label><br>
                <input type="text" id="role" class="form-control" name="role" placeholder="Enter role" value="{{ $role->name }}" maxlength="50" disabled readonly>
            </div>

            <div class="form-group col-md-12">
                <label for="permission" class="fw-bold">Permissions</label>
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
                                                    <i class="fa fa-circle text-success"></i>
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

        </div>
    </div>

@endsection
