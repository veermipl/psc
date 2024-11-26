@extends('layout.admin_master')

@section('title', 'Web Hits - List')
@section('header', 'Web Hits')

@section('content')

    <div class="page-breadcrumb d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Web Hits</div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="p-4 border rounded">
                        <form action="{{ route('admin.system.web-hits.filter') }}" method="post"
                            class="row g-3 needs-validation">
                            @csrf
                            @method('post')

                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip01" class="form-label">Date From</label>
                                <input type="date" class="form-control" name="date_from" placeholder="" value="{{ $filterValues['date_from'] }}">
                            </div>

                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip01" class="form-label">Date To</label>
                                <input type="date" class="form-control" name="date_to" placeholder="Date To" value="{{ $filterValues['date_to'] }}">
                            </div>

                            <div class="col-12 text-end">
                                <a href="{{ route('admin.system.web-hits.index') }}"
                                    class="btn btn-danger btn-sm">
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
                @if ($export_id && count($export_id) > 0)
                    <form action="{{ route('admin.system.web-hits.export') }}" method="post" class="d-none">
                        @csrf
                        @method('post')

                        <input type="hidden" value="{{ implode(',', $export_id) }}" name="export_id">
                        <input type="hidden" value="contact_us_queries" name="file_name">

                        <button class="btn btn-primary btn-sm" type="submit">
                            <ion-icon name="document-outline"></ion-icon>Export
                        </button>
                    </form>

                    <a href="{{ route('admin.system.web-hits.truncate') }}" class="btn btn-danger btn-sm">
                        <ion-icon name="trash-outline"></ion-icon>Truncate
                    </a>
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
                        <table id="webHitsTable" class="table table-sm table-borderless table-light" data-toggle="table"
                            data-search="true" data-buttons-prefix="btn-md btn" data-pagination="true">
                            <thead>
                                <tr>
                                    <th scope="col" data-field="key">#</th>
                                    <th scope="col" data-sortable="true" data-field="ip_address">IP Address</th>
                                    <th scope="col" data-sortable="true" data-field="visited_url">Visited URL</th>
                                    <th scope="col" data-sortable="true" data-field="date">Date</th>
                                    {{-- <th scope="col" data-field="action">Action</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @if ($list && count($list) > 0)
                                    @foreach ($list as $listKey => $listValue)
                                        <tr class="tr_row_{{ $listKey }}">

                                            <th scope="row">{{ $listKey + 1 }}</th>
                                            
                                            <td>
                                                {{ $listValue->ip_address }}
                                            </td>

                                            <td>
                                                {{ $listValue->url }}
                                            </td>

                                            <td>
                                                {{ date('jS M Y', strtotime($listValue->created_at)) }}
                                            </td>

                                            {{-- <td>
                                                <div class="tableOptions">
                                                    <span class="text-danger" title="Delete" lid="{{ $listValue->id }}"
                                                        lrow="{{ $listKey }}" id="deleteListBtn">
                                                        <i class="fa fa-trash"></i>
                                                    </span>
                                                </div>
                                            </td> --}}
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

            // $(document).on('click', '#deleteListBtn', function(e) {
            //     e.preventDefault();

            //     var lid = $(this).attr('lid');
            //     var lrow = $(this).attr('lrow');
            //     var url = `{{ url('/admin/system/notification/${lid}') }}`;

            //     Swal.fire({
            //         title: "Are you sure?",
            //         text: "You won't be able to revert this!",
            //         icon: "warning",
            //         showCancelButton: true,
            //         confirmButtonText: "Yes, delete it!",
            //         cancelButtonText: "No, cancel!",
            //         reverseButtons: true,
            //         confirmButtonColor: '#24695c',
            //         cancelButtonColor: '#d22d3d',
            //     }).then((result) => {
            //         if (result.isConfirmed) {
            //             $.ajax({
            //                 url: url,
            //                 method: 'POST',
            //                 data: {
            //                     _method: 'delete',
            //                     _token: '{{ csrf_token() }}',
            //                 },
            //                 dataType: "json",
            //                 beforeSend: function() {
            //                     // $('.preloader').show();
            //                     $('span#deleteListBtn[lrow="' + lrow + '"]').prop(
            //                         'disabled', true).css({
            //                         'cursor': 'not-allowed'
            //                     });
            //                 },
            //                 success: function(response) {
            //                     if (response.error === false) {
            //                         $('tr.tr_row_' + lrow + '').remove();

            //                         $('#notificationTable').bootstrapTable('refresh', {
            //                             url: '{{ route("admin.system.notification.reload-table") }}'
            //                         });

            //                         toastr.success(response.msg);
            //                     } else {
            //                         toastr.error(response.msg);
            //                     }
            //                 },
            //                 error: function(xhr, status, error) {
            //                     toastr.error(error);
            //                 },
            //                 complete: function(xhr, status) {
            //                     // $('.preloader').hide();
            //                     $('span#deleteListBtn[lrow="' + lrow + '"]').prop(
            //                         'disabled', false).css({
            //                         'cursor': 'pointer'
            //                     });
            //                 }
            //             });
            //         }
            //     });

            // });

        });
    </script>

@endsection
