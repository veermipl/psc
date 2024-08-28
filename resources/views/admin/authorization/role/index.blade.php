@extends('layout.admin_master')

@section('title', 'Role - List')
@section('header', 'Role')

@section('content')

    <div class="page-breadcrumb d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Role List</div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="p-4 border rounded">
                        <form action="{{ route('admin.authorization.role.filter') }}" method="post"
                            class="row g-3 needs-validation">
                            @csrf
                            @method('post')

                            <div class="row">
                                <div class="col-md-6 position-relative">
                                    <input type="text" class="form-control" name="name" placeholder="Name"
                                        value="{{ $filterValues['name'] }}">
                                </div>

                                <div class="col-md-6 position-relative">
                                    <select name="type" class="form-control">
                                        <option hidden value="">Type</option>
                                        <option value="custom" {{ $filterValues['type'] == 'custom' ? 'selected' : '' }}>
                                            Custom</option>
                                        <option value="default" {{ $filterValues['type'] == 'default' ? 'selected' : '' }}>
                                            Default</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 text-end">
                                <a href="{{ route('admin.authorization.role.index') }}" class="btn btn-danger btn-sm">
                                    <ion-icon name="reload" role="img" class="md hydrated"
                                        aria-label="reload"></ion-icon>
                                    Reset
                                </a>
                                <button class="btn btn-primary btn-sm">
                                    <ion-icon name="funnel" role="img" class="md hydrated"
                                        aria-label="funnel"></ion-icon>Filter
                                </button>
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
                <a href="{{ route('admin.authorization.role.create') }}" class="btn btn-primary btn-sm d-none_">
                    <ion-icon name="add-outline" role="img" class="md hydrated"
                        aria-label="person add"></ion-icon>Create Role
                </a>

                @if ($export_id && count($export_id) > 0)
                    <form action="{{ route('admin.authorization.role.export') }}" method="post" class="">
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
                        <table id="roleTable" class="table table-sm table-borderless" data-toggle="table" data-search="true"
                            data-buttons-prefix="btn-md btn" data-pagination="true">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col" data-sortable="true">Name</th>
                                    <th scope="col" data-sortable="true">Type</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($list && count($list) > 0)
                                    @foreach ($list as $listKey => $listValue)
                                        <tr class="tr_row_{{ $listKey }}">

                                            <th scope="row">{{ $listKey + 1 }}</th>

                                            <td>
                                                <a href="{{ route('admin.authorization.role.show', $listValue->id) }}"
                                                    class="text-secondary">
                                                    {{ $listValue->name }}
                                                </a>
                                            </td>

                                            <td>
                                                {{ ucwords($listValue->type) }}
                                            </td>

                                            <td>
                                                <div class="tableOptions">
                                                    @if ($listValue->id !== 1)
                                                        <span class="text-dark" title="Edit">
                                                            <a
                                                                href="{{ route('admin.authorization.role.edit', $listValue->id) }}">
                                                                <i class="fa fa-pencil"></i>
                                                            </a>
                                                        </span>
                                                    @endif
                                                    @if ($listValue->type === 'custom')
                                                        <span class="text-danger" title="Delete" lid="{{ $listValue->id }}"
                                                            lrow="{{ $listKey }}" id="deleteListBtn">
                                                            <i class="fa fa-trash"></i>
                                                        </span>
                                                    @endif
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

            $(document).on('click', '#deleteListBtn', function(e) {
                e.preventDefault();

                var lid = $(this).attr('lid');
                var lrow = $(this).attr('lrow');
                var url = `{{ url('/admin/authorization/role/${lid}') }}`;

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
                                $('span#deleteListBtn[lrow="' + lrow + '"]').prop(
                                    'disabled', true).css({
                                    'cursor': 'not-allowed'
                                });
                            },
                            success: function(response) {
                                if (response.error === false) {
                                    $('tr.tr_row_' + lrow + '').remove();

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
                                $('span#deleteListBtn[lrow="' + lrow + '"]').prop(
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
