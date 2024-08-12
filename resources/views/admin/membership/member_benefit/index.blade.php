@extends('layout.admin_master')

@section('title', 'Member Benefit - List')
@section('header', 'Member Benefit')

@section('content')

    <div class="p-3 bg-white">
        <h5 class="fw-bold">Member Benefit List</h5>

        <div class="filter-wrapper my-3 p-3">
            <form action="{{ route('admin.membership.member-benefit.filter') }}" method="post">
                @csrf
                @method('post')

                <div class="row">
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control" name="name" placeholder="Name"
                            value="{{ $filterValues['name'] }}">
                    </div>

                    <div class="form-group col-md-6">
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
                    <a href="{{ route('admin.membership.member-benefit.index') }}" class="btn btn-danger btn-sm">Reset</a>
                    <button class="btn btn-custom btn-sm" type="submit">Filter</button>
                </div>
            </form>
        </div>

        <div class="d-flex justify-content-between py-3 d-none">
            <a href="{{ route('admin.membership.member-benefit.create') }}">
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
            <table id="memberBenefitTable" class="table table-sm table-borderless table-light" data-toggle="table" data-search="true"
                data-buttons-prefix="btn-md btn" data-pagination="true">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col" data-sortable="true">Name</th>
                        <th scope="col" data-sortable="true">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($list && count($list) > 0)
                        @foreach ($list as $listKey => $listValue)

                            <tr class="tr_row_{{ $listKey }}">

                                <th scope="row">{{ $listKey + 1 }}</th>

                                <td>
                                    <a href="{{ route('admin.membership.type.show', $listValue->id) }}" class="text-secondary">
                                        {{ $listValue->name }}
                                    </a>
                                </td>

                                <td>
                                    @if ($listValue->status == 1)
                                        <span class="badge badge-success" id="listStatus" lid="{{ $listValue->id }}"
                                            lstatus="{{ $listValue->status }}" lrow="{{ $listKey }}">
                                            Active
                                        </span>
                                    @else
                                        <span class="badge badge-danger" id="listStatus" lid="{{ $listValue->id }}"
                                            lstatus="{{ $listValue->status }}" lrow="{{ $listKey }}">
                                            In Active
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    <div class="tableOptions">
                                        <span class="text-dark" title="Edit">
                                            <a href="{{ route('admin.membership.type.edit', $listValue->id) }}"><i
                                                    class="fa fa-edit"></i></a>
                                        </span>
                                        <span class="text-danger" title="Delete" lid="{{ $listValue->id }}" lrow="{{ $listKey }}"
                                            id="deleteListBtn">
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

            $(document).on('click', '#listStatus', function(e) {
                e.preventDefault();

                var lid = $(this).attr('lid');
                var lstatus = $(this).attr('lstatus');
                var lrow = $(this).attr('lrow');

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
                            url: "{{ route('admin.membership.type.status') }}",
                            method: 'POST',
                            data: {
                                _method: 'post',
                                _token: '{{ csrf_token() }}',
                                lid: lid,
                                lstatus: lstatus,
                            },
                            dataType: "json",
                            beforeSend: function() {
                                // $('.preloader').show();
                                $('span#listStatus[urow="'+lrow+'"]').prop('disabled', true).css({
                                    'cursor':'not-allowed'
                                });
                            },
                            success: function(response) {
                                if (response.error === false) {
                                    toastr.success(response.msg);

                                    if(parseInt(lstatus) == 1){
                                        $('span#listStatus[lrow="'+lrow+'"]').attr('lstatus', 0).removeClass('badge-success').addClass('badge-danger').html('In Active');
                                    }else{
                                        $('span#listStatus[lrow="'+lrow+'"]').attr('lstatus', 1).removeClass('badge-danger').addClass('badge-success').html('Active');
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
                                $('span#listStatus[urow="'+lrow+'"]').prop('disabled', false).css({
                                    'cursor':'pointer'
                                });
                            }
                        });
                    }
                });
            });

            $(document).on('click', '#deleteListBtn', function(e) {
                e.preventDefault();

                var lid = $(this).attr('lid');
                var lrow = $(this).attr('lrow');
                var url = `{{ url('/admin/membership/type/${lid}') }}`;

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
