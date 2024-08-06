@extends('layout.admin_master')

@section('title', 'User - List')
@section('header', 'Users')

@section('content')

    <div class="p-3 bg-white">
        <h5 class="fw-bold">User List</h5>

        <div class="filter-wrapper my-3 p-3">
            <form action="{{ route('admin.user.filter') }}" method="post">
                @csrf
                @method('post')

                <div class="row">
                    <div class="form-group col-md-4">
                        <input type="text" class="form-control" name="name" placeholder="Name" value="{{ $filterValues['name'] }}">
                    </div>

                    <div class="form-group col-md-4">
                        <input type="email" class="form-control" name="email" placeholder="Email" value="{{ $filterValues['email'] }}">
                    </div>

                    <div class="form-group col-md-4">
                        <select name="membership_type" class="form-control">
                            <option hidden value="">Membership Type</option>
                            @foreach ($membershipList as $membership)
                                <option value="{{ $membership['id'] }}" {{ ($filterValues['membership_type'] == $membership['id']) ? 'selected' : '' }}>
                                    {{ $membership['name'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <select name="role" class="form-control">
                            <option hidden value="">Role</option>
                            @foreach ($roleList as $role)
                                <option value="{{ $role['id'] }}" {{ ($filterValues['role'] == $role['id']) ? 'selected' : '' }}>
                                    {{ $role['name'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <select name="status" class="form-control">
                            <option hidden value="">Status</option>
                            @foreach (config('site.status') as $status)
                                <option value="{{ $status['value'] }}" {{ ($filterValues['status'] == $status['value']) ? 'selected' : '' }}>
                                    {{ $status['name'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="text-right">
                    <a href="{{ route('admin.user.index') }}" class="btn btn-danger btn-sm">Reset</a>
                    <button class="btn btn-custom btn-sm" type="submit">Filter</button>
                </div>
            </form>
        </div>

        <div class="d-flex justify-content-between py-3 d-none">
            <a href="{{ route('admin.user.create') }}">
                <button class="btn btn-custom btn-sm">
                    <i class="fa fa-plus pr-1"></i>Create
                </button>
            </a>

            @if ($export_id && count($export_id) > 0)
                <form action="{{ route('admin.user.export') }}" method="post">
                    @csrf
                    @method('post')

                    <input type="hidden" value="{{ implode(',', $export_id) }}" name="export_id">

                    <button class="btn btn-custom btn-sm" type="submit">
                        <i class="fa fa-file pr-1"></i>Export
                    </button>
                </form>
            @endif
        </div>

        <div class="table-responsive">
            <table id="userTable" class="table table-sm table-borderless table-light" data-toggle="table" data-search="true"
                data-buttons-prefix="btn-md btn" data-pagination="true">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col" data-sortable="true">Name</th>
                        <th scope="col" data-sortable="true">Email</th>
                        <th scope="col" data-sortable="true">Membership</th>
                        <th scope="col" data-sortable="true">Form</th>
                        <th scope="col" data-sortable="true">Status</th>
                        <th scope="col" data-sortable="true">Role</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($userList && count($userList) > 0)
                        @foreach ($userList as $userKey => $user)
                            @php
                                $userRoles = $user->role ? $user->role->pluck('name')->toArray() : [];
                            @endphp
                            <tr>
                                <th scope="row">{{ $userKey + 1 }}</th>
                                <td>
                                    <a href="{{ route('admin.user.show', $user->id) }}" class="text-secondary">
                                        {{ $user->name }}
                                    </a>
                                </td>

                                <td>{{ $user->email }}</td>

                                <td>
                                    {{ $user->membership ? $user->membership->name : '' }}
                                </td>

                                <td>
                                    <a href=""><button class="btn btn-sm btn-outline-custom">Complete Form</button></a>
                                </td>

                                <td>
                                    @if ($user->status == 1)
                                        <span class="badge badge-success" id="userStatus">Active</span>
                                    @else
                                        <span class="badge badge-danger" id="userStatus">In Active</span>
                                    @endif
                                </td>
                                <td>{{ implode(', ', $userRoles) }}</td>
                                <td>
                                    <div class="tableOptions">
                                        <span class="text-dark" title="Edit">
                                            <a href="{{ route('admin.user.edit', $user->id) }}"><i
                                                    class="fa fa-edit"></i></a>
                                        </span>
                                        <span class="text-danger" title="Delete" user_id="{{ $user->id }}"
                                            id="deleteUserBtn">
                                            <i class="fa fa-trash"></i>
                                        </span>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>

@endsection
