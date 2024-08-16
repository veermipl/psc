@extends('layout.admin_master')

@section('title', 'Pemission- List')
@section('header', 'Pemission')

@section('content')

    <div class="p-3 bg-white">
        <h5 class="fw-bold">Pemission List</h5>

        <div class="pt-5" id="accordion">
            @foreach($permissionModule as $key => $module)
                @php
                    $module_str = Str::of($module)->replace([' ', '-'], '_')->lower();
                @endphp
                <div class="card">
                    <div class="card-header" id="heading{{ $module_str }}">
                        <h5 class="mb-0">
                            <button class="btn btn-sm btn-link" data-toggle="collapse" data-target="#collapse{{ $module_str }}"
                                aria-expanded="true" aria-controls="collapse{{ $module_str }}" type="button">
                                {{ $module }}
                            </button>
                        </h5>
                    </div>

                    <div id="collapse{{ $module_str }}" class="collapse {{ $key == 0 ? 'show' : '' }}" aria-labelledby="heading{{ $module_str }}"
                        data-parent="#accordion">
                        <div class="card-body">
                            <div class="persWrapper row">
                                @foreach ($permissionList as $permissionKey => $permissionValue)
                                    @if ($permissionValue['module'] === $module)
                                        <div class="perWrapper col-md-4">
                                            <i class="fa fa-circle text-success"></i>
                                            <label>{{ $permissionValue['name'] }}</label>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
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
