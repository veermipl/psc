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
                        <input type="text" class="form-control" name="name" placeholder="Name"
                            value="{{ $filterValues['name'] }}">
                    </div>

                    <div class="form-group col-md-4">
                        <select name="role" class="form-control">
                            <option hidden value="">Role</option>
                            @foreach ($roleList as $role)
                                <option value="{{ $role['id'] }}"
                                    {{ $filterValues['role'] == $role['id'] ? 'selected' : '' }}>
                                    {{ $role['name'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <select name="status" class="form-control">
                            <option hidden value="">Status</option>
                            @foreach (config('site.status') as $status)
                                <option value="{{ $status['value'] }}"
                                    {{ $filterValues['status'] == $status['value'] ? 'selected' : '' }}>
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
                <form action="{{ route('admin.user.export') }}" method="post" class="d-none">
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
                            <tr class="tr_row_{{ $userKey }}">

                                <th scope="row">{{ $userKey + 1 }}</th>

                                <td>
                                    <a href="{{ route('admin.user.show', $user->id) }}" class="text-secondary">
                                        {{ $user->name }}
                                    </a>
                                </td>

                                <td>{{ $user->email }}</td>

                                <td>
                                    @if ($user->status == 1)
                                        <span class="badge badge-success" id="userStatus" uid="{{ $user->id }}"
                                            ustatus="{{ $user->status }}" urow="{{ $userKey }}">
                                            Active
                                        </span>
                                    @else
                                        <span class="badge badge-danger" id="userStatus" uid="{{ $user->id }}"
                                            ustatus="{{ $user->status }}" urow="{{ $userKey }}">
                                            In Active
                                        </span>
                                    @endif
                                </td>

                                <td>{{ implode(', ', $userRoles) }}</td>

                                <td>
                                    <div class="tableOptions">
                                        <span class="text-dark" title="Edit">
                                            <a href="{{ route('admin.user.edit', $user->id) }}"><i
                                                    class="fa fa-edit"></i></a>
                                        </span>
                                        <span class="text-danger" title="Delete" uid="{{ $user->id }}" urow="{{ $userKey }}"
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


@section('scripts')

    <script type="text/javascript">
        $(document).ready(function() {

            $(document).on('click', '#userStatus', function(e) {
                e.preventDefault();

                var uid = $(this).attr('uid');
                var ustatus = $(this).attr('ustatus');
                var urow = $(this).attr('urow');

                Swal.fire({
                    title: "Are you sure?",
                    // text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Yes, change it!",
                    cancelButtonText: "No, cancel!",
                    reverseButtons: true,
                    confirmButtonColor: '#24695c',
                    cancelButtonColor: '#d22d3d',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('admin.user.status') }}",
                            method: 'POST',
                            data: {
                                _method: 'post',
                                _token: '{{ csrf_token() }}',
                                uid: uid,
                                ustatus: ustatus,
                            },
                            dataType: "json",
                            beforeSend: function() {
                                // $('.preloader').show();
                                $('span#userStatus[urow="'+urow+'"]').prop('disabled', true).css({
                                    'cursor':'not-allowed'
                                });
                            },
                            success: function(response) {
                                if (response.error === false) {
                                    toastr.success(response.msg);

                                    if(parseInt(ustatus) == 1){
                                        $('span#userStatus[urow="'+urow+'"]').attr('ustatus', 0).removeClass('badge-success').addClass('badge-danger').html('In Active');
                                    }else{
                                        $('span#userStatus[urow="'+urow+'"]').attr('ustatus', 1).removeClass('badge-danger').addClass('badge-success').html('Active');
                                    }
                                } else {
                                    toastr.error(response.msg);
                                }
                            },
                            error: function(xhr, status, error) {
                                toastr.error(error);
                            },
                            complete: function(xhr, status) {
                                // $('.preloader').hide();
                                $('span#userStatus[urow="'+urow+'"]').prop('disabled', false).css({
                                    'cursor':'pointer'
                                });
                            }
                        });
                    }
                });
            });

            $(document).on('click', '#deleteUserBtn', function(e) {
                e.preventDefault();

                var uid = $(this).attr('uid');
                var urow = $(this).attr('urow');
                var url = `{{ url('/admin/user/${uid}') }}`;

                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel!",
                    reverseButtons: true,
                    confirmButtonColor: '#24695c',
                    cancelButtonColor: '#d22d3d',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url,
                            method: 'POST',
                            data: {
                                _method: 'delete',
                                _token: '{{ csrf_token() }}',
                            },
                            dataType: "json",
                            beforeSend: function() {
                                // $('.preloader').show();
                                $('span#deleteUserBtn[urow="'+urow+'"]').prop('disabled', true).css({
                                    'cursor':'not-allowed'
                                });
                            },
                            success: function(response) {
                                if (response.error === false) {
                                    $('tr.tr_row_'+urow+'').remove();

                                    toastr.success(response.msg);
                                } else {
                                    toastr.error(response.msg);
                                }
                            },
                            error: function(xhr, status, error) {
                                toastr.error(error);
                            },
                            complete: function(xhr, status) {
                                // $('.preloader').hide();
                                $('span#deleteUserBtn[urow="'+urow+'"]').prop('disabled', false).css({
                                    'cursor':'pointer'
                                });
                            }
                        });
                    }
                });

            });
        });
    </script>

@endsection
