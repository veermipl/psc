@extends('layout.admin_master')

@section('title', 'Role - List')
@section('header', 'Role')

@section('content')

    <div class="p-3 bg-white">
        <h5 class="fw-bold">Role List</h5>

        <div class="filter-wrapper my-3 p-3">
            <form action="{{ route('admin.authorization.role.filter') }}" method="post">
                @csrf
                @method('post')

                <div class="row">
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control" name="name" placeholder="Name"
                            value="{{ $filterValues['name'] }}">
                    </div>

                    <div class="form-group col-md-6">
                        <select name="type" class="form-control">
                            <option hidden value="">Type</option>
                            <option value="custom" {{ $filterValues['type'] == 'custom' ? 'selected' : '' }}>Custom</option>
                            <option value="default" {{ $filterValues['type'] == 'default' ? 'selected' : '' }}>Default</option>
                        </select>
                    </div>
                </div>

                <div class="text-right">
                    <a href="{{ route('admin.authorization.role.index') }}" class="btn btn-danger btn-sm">Reset</a>
                    <button class="btn btn-custom btn-sm" type="submit">Filter</button>
                </div>
            </form>
        </div>

        <div class="d-flex justify-content-between py-3 d-none">
            <a href="{{ route('admin.authorization.role.create') }}">
                <button class="btn btn-custom btn-sm">
                    <i class="fa fa-plus pr-1"></i>Create
                </button>
            </a>

            @if ($export_id && count($export_id) > 0)
                <form action="" method="post" class="d-none">
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
            <table id="roleTable" class="table table-sm table-borderless table-light" data-toggle="table" data-search="true"
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
                                    <a href="{{ route('admin.authorization.role.show', $listValue->id) }}" class="text-secondary">
                                        {{ $listValue->name }}
                                    </a>
                                </td>

                                <td>
                                    {{ ucwords($listValue->type) }}
                                </td>

                                <td>
                                    <div class="tableOptions">
                                        <span class="text-dark" title="Edit">
                                            <a href="{{ route('admin.authorization.role.edit', $listValue->id) }}"><i
                                                    class="fa fa-edit"></i></a>
                                        </span>
                                        @if ($listValue->type === 'custom')
                                            <span class="text-danger" title="Delete" lid="{{ $listValue->id }}" lrow="{{ $listKey }}"
                                                id="deleteListBtn">
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
                                $('span#deleteListBtn[lrow="'+lrow+'"]').prop('disabled', true).css({
                                    'cursor':'not-allowed'
                                });
                            },
                            success: function(response) {
                                if (response.error === false) {
                                    $('tr.tr_row_'+lrow+'').remove();

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
                                $('span#deleteListBtn[lrow="'+lrow+'"]').prop('disabled', false).css({
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
