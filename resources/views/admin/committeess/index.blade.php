@extends('layout.admin_master')

@section('title', 'Committeess Members - List')
@section('header', 'Committeess Members - List')

@section('content')

    <div class="page-breadcrumb d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Committees Members List</div>
    </div>


    <div class="row">
        <div class="col-lg-12">
            <div class="card radius-10 w-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <!-- <h6 class="mb-0">Recent List</h6> -->
                        <a href="{{ route('admin.committeess.create') }}" class="btn btn-primary btn-sm">
                            <ion-icon name="person-add-outline" role="img" class="md hydrated"
                                aria-label="person add"></ion-icon>Create Committees Member
                        </a>
                    </div>

                    <div class="table-responsive">
                        <table id="memberTable" class="table table-sm" data-toggle="table" data-search="true"
                            data-buttons-prefix="btn-md btn" data-pagination="true">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col" data-sortable="true">Profile</th>
                                    <th scope="col" data-sortable="true">Name</th>
                                    <th scope="col" data-sortable="true">Designation</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (@$data && count(@$data) > 0)
                                    @foreach ($data as $userKey => $user)
                                        @php
                                            $userRoles = $user->role ? $user->role->pluck('name')->toArray() : [];
                                        @endphp
                                        <tr class="tr_row_{{ $userKey }}">
                                            <th scope="row">{{ $userKey + 1 }}</th>
                                            <td><img style="height:40px; width:50px"
                                                    src="{{ asset('storage/' . $user->image) }}"> </td>
                                            <td>
                                                <a href="#" class="text-secondary">
                                                    {{ $user->name }}
                                                </a>
                                            </td>
                                            <td>{{ $user->office }}</td>
                                            <td>
                                                @if ($user->status == 1)
                                                    <span class="badge alert-success" id="userStatus"
                                                        uid="{{ $user->id }}" ustatus="{{ $user->status }}"
                                                        urow="{{ $userKey }}">
                                                        Active
                                                    </span>
                                                @else
                                                    <span class="badge alert-danger" id="userStatus"
                                                        uid="{{ $user->id }}" ustatus="{{ $user->status }}"
                                                        urow="{{ $userKey }}">
                                                        In Active
                                                    </span>
                                                @endif
                                            </td>

                                            <td>
                                                <div class="tableOptions">
                                                    <span class="text-dark" title="Edit">
                                                        <a href="{{ route('admin.committeess.edit', $user->id) }}"><i
                                                                class="fa fa-pencil"></i></a>
                                                    </span>
                                                    <span class="text-danger" title="Delete" uid="{{ $user->id }}"
                                                        urow="{{ $userKey }}" id="deleteUserBtn">
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
            </div>
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
                            url: "{{ route('admin.committeess.status') }}",
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
                                $('span#userStatus[urow="' + urow + '"]').prop(
                                    'disabled', true).css({
                                    'cursor': 'not-allowed'
                                });
                            },
                            success: function(response) {
                                if (response.error === false) {
                                    toastr.success(response.msg);

                                    if (parseInt(ustatus) == 1) {
                                        $('span#userStatus[urow="' + urow + '"]').attr(
                                            'ustatus', 0).removeClass(
                                            'alert-success').addClass(
                                            'alert-danger').html('In Active');
                                    } else {
                                        $('span#userStatus[urow="' + urow + '"]').attr(
                                            'ustatus', 1).removeClass(
                                            'alert-danger').addClass(
                                            'alert-success').html('Active');
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
                                $('span#userStatus[urow="' + urow + '"]').prop(
                                    'disabled', false).css({
                                    'cursor': 'pointer'
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
                var url = `{{ url('/admin/about-us/committeess/destroy/${uid}') }}`;

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
                            method: 'get',
                            data: {
                                _method: 'delete',
                                _token: '{{ csrf_token() }}',
                            },
                            dataType: "json",
                            beforeSend: function() {
                                // $('.preloader').show();
                                $('span#deleteUserBtn[urow="' + urow + '"]').prop(
                                    'disabled', true).css({
                                    'cursor': 'not-allowed'
                                });
                            },
                            success: function(response) {
                                if (response.error === false) {
                                    $('tr.tr_row_' + urow + '').remove();

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
                                $('span#deleteUserBtn[urow="' + urow + '"]').prop(
                                    'disabled', false).css({
                                    'cursor': 'pointer'
                                });
                            }
                        });
                    }
                });

            });
        });
    </script>

@endsection
