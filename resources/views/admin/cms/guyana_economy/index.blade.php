@extends('layout.admin_master')

@section('title', 'CMS - Guyana Economy')

@section('content')

    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Guyana Economy</div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="p-4 border rounded">
                        <form action="{{ route('admin.cms.guyana-economy.filter') }}" method="post" class="row g-3 needs-validation">
                            @csrf
                            @method('post')

                            <div class="col-md-6 position-relative">
                                <input type="text" class="form-control" name="title" placeholder="Title" value="{{ $filterValues['title'] }}">
                            </div>

                            <div class="col-md-6 position-relative">
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

                            <div class="col-md-4 position-relative d-none">
                                <input type="date" class="form-control" name="created_at" value="{{ $filterValues['created_at'] }}">
                            </div>

                            <div class="col-12 text-end">
                                <a href="{{ route('admin.cms.guyana-economy') }}" class="btn btn-danger btn-sm">
                                    <ion-icon name="reload" role="img" class="md hydrated" aria-label="reload"></ion-icon>
                                    Reset
                                </a>
                                <button class="btn btn-primary btn-sm">
                                    <ion-icon name="funnel" role="img" class="md hydrated" aria-label="funnel"></ion-icon>Filter
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
                <a href="{{ route('admin.cms.guyana-economy.create') }}" class="btn btn-primary btn-sm">
                    <ion-icon name="add" role="img" class="md hydrated" aria-label="person add"></ion-icon>Create Guyana Economy
                </a>

                @if ($export_id && count($export_id) > 0)
                    <form action="{{ route('admin.cms.guyana-economy.export') }}" method="post" class="d-none-">
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
                        <table id="cmsGuyanaEconomyTable" class="table table-sm" data-toggle="table" data-search="true"
                            data-buttons-prefix="btn-md btn" data-pagination="true">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col" data-sortable="true">Title</th>
                                    <th scope="col">Status</th>
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
                                                    <span class="badge alert-success status" id="{{ $list->id }}"
                                                        status="{{ $list->status }}" row="{{ $listKey }}">
                                                        Active
                                                    </span>
                                                @else
                                                    <span class="badge alert-danger status" id="{{ $list->id }}"
                                                        status="{{ $list->status }}" row="{{ $listKey }}">
                                                        In Active
                                                    </span>
                                                @endif
                                            </td>

                                            <td>
                                                <div class="tableOptions">
                                                    <span class="text-dark" title="Edit">
                                                        <a href="{{ route('admin.cms.guyana-economy.edit', $list->id) }}">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>
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
            </div>
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
                                        $('span.status[row="'+row+'"]').attr('status', 0).removeClass('alert-success').addClass('alert-danger').html('In Active');
                                    }else{
                                        $('span.status[row="'+row+'"]').attr('status', 1).removeClass('alert-danger').addClass('alert-success').html('Active');
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
