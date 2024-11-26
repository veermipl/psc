@extends('layout.admin_master')

@section('title', 'Web Hits - List')
@section('header', 'Web Hits')

@section('content')

    <div class="page-breadcrumb d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Web Hits</div>
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
