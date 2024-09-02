@extends('layout.admin_master')

@section('title', 'Member - List')
@section('header', 'Members')

@section('content')

    <div class="page-breadcrumb d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Member List</div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="p-4 border rounded">
                        <form class="row g-3 needs-validation" action="{{ route('admin.member.filter') }}" method="post">
                            @csrf
                            @method('post')

                            <div class="col-md-4 position-relative">
                                <input type="text" class="form-control" name="name" placeholder="Name"
                                    value="{{ $filterValues['name'] }}">
                            </div>

                            {{-- <div class="col-md-4 position-relative">
                                <input type="email" class="form-control" name="email" placeholder="Email"  value="{{ $filterValues['email'] }}">
                            </div> --}}

                            <div class="col-md-4 position-relative">
                                <select name="membership_type" class="form-control">
                                    <option hidden value="">Membership</option>
                                    @foreach ($membershipList as $membership)
                                        <option value="{{ $membership['id'] }}"
                                            {{ $filterValues['membership_type'] == $membership['id'] ? 'selected' : '' }}>
                                            {{ $membership['name'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4 position-relative">
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

                            <div class="col-12 text-end">
                                <a href="{{ route('admin.member.index') }}" class="btn btn-danger btn-sm">
                                    <ion-icon name="reload" role="img" class="md hydrated"
                                        aria-label="reload"></ion-icon>
                                    Reset
                                </a>
                                <button class="btn btn-primary btn-sm"><ion-icon name="funnel" role="img"
                                        class="md hydrated" aria-label="funnel"></ion-icon>Filter</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 mb-3">
            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.member.create') }}" class="btn btn-primary btn-sm">
                    <ion-icon name="person-add-outline" role="img" class="md hydrated"
                        aria-label="person add"></ion-icon>Create Member
                </a>

                @if ($export_id && count($export_id) > 0)
                    <form action="{{ route('admin.member.export') }}" method="post" class="d-none_">
                        @csrf
                        @method('post')

                        <input type="hidden" value="{{ implode(',', $export_id) }}" name="export_id">

                        <button class="btn btn-primary btn-sm" type="submit">
                            <ion-icon name="document-outline"></ion-icon>Export
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card radius-10 w-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h6 class="mb-0">Recent List</h6>
                    </div>

                    <div class="table-responsive">
                        <table id="memberTable" class="table table-sm" data-toggle="table" data-search="true"
                            data-buttons-prefix="btn-md btn" data-pagination="true">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col" data-sortable="true">Name</th>
                                    <th scope="col" data-sortable="true">Email</th>
                                    <th scope="col" data-sortable="true">Membership</th>
                                    <th scope="col" data-sortable="false">Form</th>
                                    <th scope="col" data-sortable="false">Sup. Docs</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($userList && count($userList) > 0)
                                    @foreach ($userList as $userKey => $user)
                                        <tr class="tr_row_{{ $userKey }}">

                                            <th scope="row">{{ $userKey + 1 }}</th>

                                            <td>
                                                <a href="{{ route('admin.member.show', $user->id) }}"
                                                    class="text-secondary">
                                                    {{ $user->name }}
                                                </a>
                                            </td>

                                            <td>{{ $user->email }}</td>

                                            <td>
                                                {{ $user->membership ? $user->membership->name : '' }}
                                            </td>

                                            <td>
                                                @if ($user->form_pdf)
                                                    <a href="{{ $user->form_pdf ? asset('storage/' . $user->form_pdf) : '' }}"
                                                        target="_blank" title="Filled Form">
                                                        <ion-icon name="document" role="img" class="md hydrated"
                                                            aria-label="document"></ion-icon>
                                                    </a>
                                                @else
                                                @endif
                                            </td>

                                            <td>
                                                @if ($user->supportingDoc)
                                                    @php
                                                        $docsArr = $user->supportingDoc->pluck('file_name')->toArray();
                                                    @endphp

                                                    @foreach ($docsArr as $docKey => $docVal)
                                                        <a href="{{ $docVal ? asset('storage/' . $docVal) : '' }}"
                                                            target="_blank" title="Supporting Documents">
                                                            <ion-icon name="document" role="img" class="md hydrated"
                                                                aria-label="document"></ion-icon>
                                                        </a>
                                                    @endforeach
                                                @else
                                                @endif
                                            </td>

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
                                                        <a href="{{ route('admin.member.edit', $user->id) }}"><i
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
                            url: "{{ route('admin.member.status') }}",
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
                var url = `{{ url('/admin/member/${uid}') }}`;

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
