@extends('layout.admin_master')

@section('title', 'National Budget - List')
@section('header', 'National Budget')

@section('content')

    <div class="p-3 bg-white">
        <h5 class="fw-bold">National Budget</h5>

        <div class="pt-5">
            <div id="">
                <button class="btn btn-sm sub_page_link {{ ($tab == 'main') ? 'btn-custom' : 'btn-outline-custom' }}" id="sub_page_link_main" type="button" data-target="main">
                    Main
                </button>
                <button class="btn btn-sm sub_page_link {{ ($tab == 'source') ? 'btn-custom' : 'btn-outline-custom' }}" id="sub_page_link_source" type="button" data-target="source">
                    Sources
                </button>
            </div>

            <div id="" class="pt-3">
                <div class="collapse sub_page_body {{ ($tab == 'main') ? 'show' : 'hide' }}" id="sub_page_body_main">
                    <div class="card card-body">
                        <form action="{{ route('admin.data.national-budget.update') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('post')
            
                            <input type="hidden" name="type" value="main">
                            <input type="hidden" name="old_file" value="{{ @$main->file }}">
            
                            <div class="d-flex">
                                <div class="form-group col-md-6">
                                    <label for="title">Title <span class="text-danger">*</span></label>
                                    <input type="text" id="title" class="form-control" name="title" placeholder="Enter title"
                                        value="{{ old('title', @$main->title) }}" maxlength="50">
            
                                    @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
            
                                <div class="form-group col-md-6">
                                    <label for="files">Image <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" name="file" accept="image/*">

                                    @error('file')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
            
                            <div class="form-group col-md-12">
                                <label for="content">Content <span class="text-danger">*</span></label>
                                <textarea name="content" id="editor" cols="5" rows="5" class="form-control">{{ old('content', @$main->content) }}</textarea>
            
                                @error('content')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
            
                            <div class="d-flex">
                                <div class="form-group col-md-12">
                                    @if (@$main->file)
                                        <img class="ge_img pop_up_image" src="{{ asset('storage/' . $main->file) }}">
                                    @endif
                                </div>
                            </div>
            
                            <div class="form-group col-md-12 text-right">
                                <button class="btn btn-sm btn-custom" type="submit">Update</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="collapse sub_page_body {{ ($tab == 'source') ? 'show' : 'hide' }}" id="sub_page_body_source">
                    <div class="card card-body">
                        <div class="d-flex justify-content-between py-3 d-none">
                            <a href="{{ route('admin.data.national-budget.create-source') }}">
                                <button class="btn btn-custom btn-sm">
                                    <i class="fa fa-plus pr-1"></i>Create
                                </button>
                            </a>
                
                            @if ($source_export_id && count($source_export_id) > 0)
                                <form action="" method="post" class="d-none">
                                    @csrf
                                    @method('post')
                
                                    <input type="hidden" value="{{ implode(',', $source_export_id) }}" name="export_id">
                
                                    <button class="btn btn-custom btn-sm" type="submit">
                                        <i class="fa fa-file pr-1"></i>Export
                                    </button>
                                </form>
                            @endif
                        </div>

                        <div class="table-responsive">
                            <table id="nationaBudgetSourcesTable" class="table table-sm table-borderless table-light" data-toggle="table" data-search="true"
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
                                    @if ($sources && count($sources) > 0)
                                        @foreach ($sources as $listKey => $listValue)
                
                                            <tr class="tr_row_{{ $listKey }}">
                
                                                <th scope="row">{{ $listKey + 1 }}</th>
                
                                                <td>
                                                    <a href="#" class="text-secondary">
                                                        {{ $listValue->title }}
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
                                                            <a href="{{ route('admin.data.national-budget.edit-source', $listValue->id) }}"><i
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
                            url: "{{ route('admin.data.national-budget.update-source-status') }}",
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
                                            'badge-success').addClass(
                                            'badge-danger').html('In Active');
                                    } else {
                                        $('span#listStatus[lrow="' + lrow + '"]').attr(
                                            'lstatus', 1).removeClass(
                                            'badge-danger').addClass(
                                            'badge-success').html('Active');
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
                            url: "{{ route('admin.data.national-budget.delete-source') }}",
                            method: 'POST',
                            data: {
                                _method: 'post',
                                _token: '{{ csrf_token() }}',
                                lid: lid,
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
