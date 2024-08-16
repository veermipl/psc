@extends('layout.admin_master')

@section('title', 'Business - investment')
@section('header', 'Business')

@section('content')

    <div class="p-3 bg-white">
        <h5 class="fw-bold">investment List</h5>

        <div class="filter-wrapper my-3 p-3">
            <form action="#" method="post">
                @csrf
                @method('post')

                <div class="row">
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control" name="name" placeholder="Name"
                            value="{{ @$filterValues['name'] }}">
                    </div>

                    <div class="form-group col-md-6">
                        <select name="status" class="form-control">
                            <option hidden value="">Status</option>
                            @foreach (config('site.status') as $status)
                                <option value="{{ $status['value'] }}"
                                    {{ @$filterValues['status'] == $status['value'] ? 'selected' : '' }}>
                                    {{ $status['name'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="text-right">
                    <a href="{{ route('admin.readines.key_areas') }}" class="btn btn-danger btn-sm">Reset</a>
                    <button class="btn btn-custom btn-sm" type="submit">Filter</button>
                </div>
            </form>
        </div>

        <div class="d-flex justify-content-between py-3 d-none">
            <a href="{{ route('admin.readines.areas.add') }}">
                <button class="btn btn-custom btn-sm">
                    <i class="fa fa-plus pr-1"></i>Create
                </button>
            </a>

        </div>

        <div class="table-responsive">
            <table id="userTable" class="table table-sm table-borderless table-light" data-toggle="table" data-search="true"
                data-buttons-prefix="btn-md btn" data-pagination="true">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col" data-sortable="true">Image</th>
                        <th scope="col" data-sortable="true">Title</th>
                        <th scope="col" data-sortable="true">Contact</th>
                        <th scope="col" data-sortable="true">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($data && count($data) > 0)
                        @foreach ($data as $userKey => $user)
                           
                            <tr class="tr_row_{{ $userKey }}">
                                <th scope="row">{{ $userKey + 1 }}</th>
                                <td><img style="height:40px; width:50px" src="{{asset('storage/'.$user->image)}}" > </td>
                                <td>
                                    
                                        {{ $user->title }}
                                    
                                </td>
                                <td>{!! strip_tags(substr($user->contant, 0,40)) !!}....</td>
                                <td>
                                    @if ($user->status == 1)
                                        <span class="badge badge-success" id="userStatus" uid="{{ $user->id }}"
                                            ustatus="{{ $user->status }}" urow="{{ $userKey }}">
                                            Active
                                        </span>
                                    @else
                                        <span class="badge badge-danger" id="userStatus" uid="{{ $user->id }}"
                                            ustatus="{{ $user->status }}" urow="{{ $userKey }}">
                                            In Active
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    <div class="tableOptions">
                                        <span class="text-dark" title="Edit">
                                            <a href="{{ route('admin.readines.areas.edit', $user->id) }}"><i
                                                    class="fa fa-edit"></i></a>
                                        </span>
                                        <span class="text-danger" title="Delete" uid="{{ $user->id }}" urow="{{ $userKey }}"
                                            id="deleteUserBtn">
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

            $(document).on('click', '#userStatus', function(e) {
                e.preventDefault();

                var uid = $(this).attr('uid');
                var ustatus = $(this).attr('ustatus');
                var urow = $(this).attr('urow');

                Swal.fire({
                    title: 'Are you sure ?',
                    showCancelButton: true,
                    confirmButtonColor: '#24695c',
                    cancelButtonColor: '#d22d3d',
                    confirmButtonText: 'Yes, Change it !'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('admin.readines.areas.status') }}",
                            method: 'POST',
                            data: {
                                _method: 'post',
                                _token: '{{ csrf_token() }}',
                                uid: uid,
                                ustatus: ustatus,
                            },
                            dataType: "json",
                            beforeSend: function() {
                                // $('.preloader').show();
                                $('span#userStatus[urow="'+urow+'"]').prop('disabled', true).css({
                                    'cursor':'not-allowed'
                                });
                            },
                            success: function(response) {
                                if (response.error === false) {
                                    toastr.success(response.msg);

                                    if(parseInt(ustatus) == 1){
                                        $('span#userStatus[urow="'+urow+'"]').attr('ustatus', 0).removeClass('badge-success').addClass('badge-danger').html('In Active');
                                    }else{
                                        $('span#userStatus[urow="'+urow+'"]').attr('ustatus', 1).removeClass('badge-danger').addClass('badge-success').html('Active');
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
                                $('span#userStatus[urow="'+urow+'"]').prop('disabled', false).css({
                                    'cursor':'pointer'
                                });
                            }
                        });
                    }
                });
            });

            $(document).on('click', '#deleteUserBtn', function(e) {
                e.preventDefault();

                var uid = $(this).attr('uid');
                var urow = $(this).attr('urow');
                var url = `{{ url('/admin/readines/key-areas-destroy/${uid}') }}`;

                Swal.fire({
                    title: 'Are you sure ?',
                    showCancelButton: true,
                    confirmButtonColor: '#24695c',
                    cancelButtonColor: '#d22d3d',
                    confirmButtonText: 'Yes, Delete it !'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url,
                            method: 'get',
                            data: {
                                _method: 'delete',
                                _token: '{{ csrf_token() }}',
                            },
                            dataType: "json",
                            beforeSend: function() {
                                // $('.preloader').show();
                                $('span#deleteUserBtn[urow="'+urow+'"]').prop('disabled', true).css({
                                    'cursor':'not-allowed'
                                });
                            },
                            success: function(response) {
                                if (response.error === false) {
                                    $('tr.tr_row_'+urow+'').remove();
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
                                $('span#deleteUserBtn[urow="'+urow+'"]').prop('disabled', false).css({
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
