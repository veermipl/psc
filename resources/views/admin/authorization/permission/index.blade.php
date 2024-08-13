@extends('layout.admin_master')

@section('title', 'Pemission- List')
@section('header', 'Pemission')

@section('content')

    <div class="p-3 bg-white">
        <h5 class="fw-bold">Pemission List</h5>

        <div class="table-responsive">
            <table id="permissionTable" class="table table-sm table-borderless table-light" data-toggle="table" data-search="true"
                data-buttons-prefix="btn-md btn" data-pagination="true">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col" data-sortable="true">Name</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($list && count($list) > 0)
                        @foreach ($list as $listKey => $listValue)

                            <tr class="tr_row_{{ $listKey }}">

                                <th scope="row">{{ $listKey + 1 }}</th>

                                <td>
                                    {{ $listValue->name }}
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
