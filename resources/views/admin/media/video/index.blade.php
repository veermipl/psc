@extends('layout.admin_master')

@section('title', 'Video - List')
@section('header', 'Video')

@section('content')

    <div class="page-breadcrumb d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Video</div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="p-4 border rounded">
                        <form action="{{ route('admin.media-center.video.filter') }}" method="post"
                            class="row g-3 needs-validation">
                            @csrf
                            @method('post')

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

                            <div class="col-12 text-end">
                                <a href="{{ route('admin.media-center.video.index') }}" class="btn btn-danger btn-sm">
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
                <a href="{{ route('admin.media-center.video.create') }}" class="btn btn-primary btn-sm">
                    <ion-icon name="add" role="img" class="md hydrated" aria-label="person add"></ion-icon>Create
                    Video
                </a>

                @if ($export_id && count($export_id) > 0)
                    <form action="" method="post" class="d-none">
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
                        <table id="videoTable" class="table table-sm table-borderless table-light" data-toggle="table"
                            data-search="true" data-buttons-prefix="btn-md btn" data-pagination="true">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col" data-sortable="true">Video</th>
                                    <th scope="col" data-sortable="true">Type</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($list && count($list) > 0)
                                    @foreach ($list as $listKey => $listValue)
                                        <tr class="tr_row_{{ $listKey }}">

                                            <th scope="row">{{ $listKey + 1 }}</th>

                                            <td>
                                                @if ($listValue->type == 'external')
                                                    <a href="{{ $listValue->link }}" target="_blank"
                                                        class="text-dark pop_up_video">
                                                        <ion-icon name="videocam-outline"></ion-icon>
                                                    </a>
                                                @endif

                                                @if ($listValue->type == 'internal')
                                                    <a href="{{ asset('storage/' . $listValue->name) }}" target="_blank"
                                                        class="text-dark pop_up_video">
                                                        <ion-icon name="videocam-outline"></ion-icon>
                                                    </a>
                                                @endif
                                            </td>

                                            <td>
                                                {{ ucwords($listValue->type) }}
                                            </td>

                                            <td>
                                                @if ($listValue->status == 1)
                                                    <span class="badge alert-success" id="listStatus"
                                                        lid="{{ $listValue->id }}" lstatus="{{ $listValue->status }}"
                                                        lrow="{{ $listKey }}">
                                                        Active
                                                    </span>
                                                @else
                                                    <span class="badge alert-danger" id="listStatus"
                                                        lid="{{ $listValue->id }}" lstatus="{{ $listValue->status }}"
                                                        lrow="{{ $listKey }}">
                                                        In Active
                                                    </span>
                                                @endif
                                            </td>

                                            <td>
                                                <div class="tableOptions">
                                                    <span class="text-dark" title="Edit">
                                                        <a
                                                            href="{{ route('admin.media-center.video.edit', $listValue->id) }}"><i
                                                                class="fa fa-pencil"></i></a>
                                                    </span>
                                                    <span class="text-danger" title="Delete" lid="{{ $listValue->id }}"
                                                        lrow="{{ $listKey }}" id="deleteListBtn">
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
                            url: "{{ route('admin.media-center.video.status') }}",
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
                                $('span#listStatus[urow="' + lrow + '"]').prop(
                                    'disabled', true).css({
                                    'cursor': 'not-allowed'
                                });
                            },
                            success: function(response) {
                                if (response.error === false) {
                                    toastr.success(response.msg);

                                    if (parseInt(lstatus) == 1) {
                                        $('span#listStatus[lrow="' + lrow + '"]').attr(
                                            'lstatus', 0).removeClass(
                                            'alert-success').addClass(
                                            'alert-danger').html('In Active');
                                    } else {
                                        $('span#listStatus[lrow="' + lrow + '"]').attr(
                                            'lstatus', 1).removeClass(
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
                                $('span#listStatus[urow="' + lrow + '"]').prop(
                                    'disabled', false).css({
                                    'cursor': 'pointer'
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
                var url = `{{ url('/admin/media-center/video/${lid}') }}`;

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
