@extends('layout.admin_master')

@section('title', 'CMS - Guyana Economy')

@section('content')

    <div class="p-3 bg-white">
        <h5 class="fw-bold">Guyana Economy</h5>

        <div class="filter-wrapper my-3 p-3">
            <form action="{{ route('admin.cms.guyana-economy.filter') }}" method="post">
                @csrf
                @method('post')

                <div class="row">
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control" name="title" placeholder="Title"
                            value="{{ $filterValues['title'] }}">
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

                    <div class="form-group col-md-4 d-none">
                        <input type="date" class="form-control" name="created_at" value="{{ $filterValues['created_at'] }}">
                    </div>
                </div>

                <div class="text-right">
                    <a href="{{ route('admin.cms.guyana-economy') }}" class="btn btn-danger btn-sm">Reset</a>
                    <button class="btn btn-custom btn-sm" type="submit">Filter</button>
                </div>
            </form>
        </div>

        <div class="d-flex justify-content-between py-3 d-none">
            <a href="{{ route('admin.cms.guyana-economy.create') }}">
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
            <table id="memberTable" class="table table-sm table-borderless table-light" data-toggle="table" data-search="true"
                data-buttons-prefix="btn-md btn" data-pagination="true">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col" data-sortable="true">Title</th>
                        <th scope="col" data-sortable="true">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($dataList && count($dataList) > 0)
                        @foreach ($dataList as $listKey => $list)
                            <tr class="tr_row_{{ $listKey }}">

                                <th scope="row">{{ $listKey + 1 }}</th>

                                <td>
                                    <a href="{{ route('admin.cms.guyana-economy.show', $list->id) }}" class="text-secondary">
                                        {{ $list->title }}
                                    </a>
                                </td>

                                <td>
                                    @if ($list->status == 1)
                                        <span class="badge badge-success status" id="{{ $list->id }}"
                                            status="{{ $list->status }}" row="{{ $listKey }}">
                                            Active
                                        </span>
                                    @else
                                        <span class="badge badge-danger status" id="{{ $list->id }}"
                                            status="{{ $list->status }}" row="{{ $listKey }}">
                                            In Active
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    <div class="tableOptions">
                                        <span class="text-dark" title="Edit">
                                            <a href="{{ route('admin.cms.guyana-economy.edit', $list->id) }}"><i
                                                    class="fa fa-edit"></i></a>
                                        </span>
                                        <span class="text-danger delete" title="Delete" id="{{ $list->id }}" row="{{ $listKey }}">
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

            $(document).on('click', '.status', function(e) {
                e.preventDefault();

                var id = $(this).attr('id');
                var status = $(this).attr('status');
                var row = $(this).attr('row');

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
                            url: "{{ route('admin.cms.guyana-economy.status') }}",
                            method: 'POST',
                            data: {
                                _method: 'post',
                                _token: '{{ csrf_token() }}',
                                id: id,
                                status: status,
                            },
                            dataType: "json",
                            beforeSend: function() {
                                // $('.preloader').show();
                                $('span.status[row="'+row+'"]').prop('disabled', true).css({
                                    'cursor':'not-allowed'
                                });
                            },
                            success: function(response) {
                                if (response.error === false) {
                                    toastr.success(response.msg);

                                    if(parseInt(status) == 1){
                                        $('span.status[row="'+row+'"]').attr('status', 0).removeClass('badge-success').addClass('badge-danger').html('In Active');
                                    }else{
                                        $('span.status[row="'+row+'"]').attr('status', 1).removeClass('badge-danger').addClass('badge-success').html('Active');
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
                                $('span.status[row="'+row+'"]').prop('disabled', false).css({
                                    'cursor':'pointer'
                                });
                            }
                        });
                    }
                });
            });

            $(document).on('click', '.delete', function(e) {
                e.preventDefault();

                var id = $(this).attr('id');
                var row = $(this).attr('row');
                var url = `{{ url('/admin/cms/guyana-economy/delete/${id}') }}`;

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
                                $('span.delete[row="'+row+'"]').prop('disabled', true).css({
                                    'cursor':'not-allowed'
                                });
                            },
                            success: function(response) {
                                if (response.error === false) {
                                    $('tr.tr_row_'+row+'').remove();

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
                                $('span.delete[row="'+row+'"]').prop('disabled', false).css({
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
