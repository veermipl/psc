@extends('layout.admin_master')

@section('title', 'Trade Data - List')
@section('header', 'Trade Data')

@section('content')

    <div class="page-breadcrumb d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Trade Data</div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="p-4 border rounded">
                        <div id="">
                            <button
                                class="btn btn-sm sub_page_link {{ $tab == 'main' ? 'btn-custom' : 'btn-outline-custom' }}"
                                id="sub_page_link_main" type="button" data-target="main">
                                Main
                            </button>
                            <button
                                class="btn btn-sm sub_page_link {{ $tab == 'top_partner' ? 'btn-custom' : 'btn-outline-custom' }}"
                                id="sub_page_link_top_partner" type="button" data-target="top_partner">
                                Top Partner
                            </button>
                            <button
                                class="btn btn-sm sub_page_link {{ $tab == 'top_country' ? 'btn-custom' : 'btn-outline-custom' }}"
                                id="sub_page_link_top_country" type="button" data-target="top_country">
                                Top Country
                            </button>
                        </div>

                        <div id="" class="pt-4">
                            <div class="collapse sub_page_body {{ $tab == 'main' ? 'show' : 'hide' }}"
                                id="sub_page_body_main">
                                <form action="{{ route('admin.data.trade-data.update') }}" method="post"
                                    enctype="multipart/form-data" class="row g-3 needs-validation">
                                    @csrf
                                    @method('post')

                                    <input type="hidden" name="type" value="main">
                                    <input type="hidden" name="old_file" value="{{ @$main->file }}">

                                    <div class="col-md-6 position-relative">
                                        <label for="validationTooltip01" class="form-label">Title <span
                                                class="text-danger">*</span></label>
                                        <input type="text" id="title" class="form-control" name="title"
                                            placeholder="Enter title" value="{{ old('title', @$main->title) }}"
                                            maxlength="50">

                                        @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 position-relative">
                                        <label for="validationTooltip01" class="form-label">Image <span
                                                class="text-danger">*</span></label>
                                        <input type="file" class="form-control" name="file" accept="image/*">

                                        @error('file')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-12 position-relative">
                                        <label for="validationTooltip01" class="form-label">Content <span
                                                class="text-danger">*</span></label>
                                        <textarea name="content" id="editor" cols="5" rows="5" class="form-control">{{ old('content', @$main->content) }}</textarea>

                                        @error('content')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-12 position-relative">
                                        @if (@$main->file)
                                            <img class="ge_img pop_up_image" src="{{ asset('storage/' . $main->file) }}">
                                        @endif
                                    </div>

                                    <div class="col-12 text-end mt-5">
                                        <button class="btn btn-sm btn-primary" type="submit">Update</button>
                                    </div>
                                </form>
                            </div>

                            <div class="collapse sub_page_body {{ $tab == 'top_partner' ? 'show' : 'hide' }}"
                                id="sub_page_body_top_partner">
                                <div class="row">
                                    <div class="col-lg-12 mb-3">
                                        <div class="d-flex justify-content-between">
                                            <a href="{{ route('admin.data.trade-data.create-top-partner') }}"
                                                class="btn btn-primary btn-sm">
                                                <ion-icon name="add" role="img" class="md hydrated"
                                                    aria-label="person add"></ion-icon>Create Top Partner
                                            </a>

                                            @if ($top_partner_export_id && count($top_partner_export_id) > 0)
                                                <form action="" method="post" class="d-none">
                                                    @csrf
                                                    @method('post')

                                                    <input type="hidden"
                                                        value="{{ implode(',', $top_partner_export_id) }}"
                                                        name="export_id">

                                                    <button class="btn btn-primary btn-sm" type="submit">
                                                        <ion-icon name="document-outline"></ion-icon>Export
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="table-responsive">
                                        <table id="tradeDataTopPartnerTable"
                                            class="table table-sm table-borderless table-light" data-toggle="table"
                                            data-search="true" data-buttons-prefix="btn-md btn" data-pagination="true">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col" data-sortable="true">Title</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($top_partner && count($top_partner) > 0)
                                                    @foreach ($top_partner as $listKey => $listValue)
                                                        <tr class="tr_row_{{ $listKey }}">

                                                            <th scope="row">{{ $listKey + 1 }}</th>

                                                            <td>
                                                                <a href="#" class="text-secondary">
                                                                    {{ $listValue->title }}
                                                                </a>
                                                            </td>

                                                            <td>
                                                                @if ($listValue->status == 1)
                                                                    <span class="badge alert-success" id="listStatus"
                                                                        lid="{{ $listValue->id }}"
                                                                        lstatus="{{ $listValue->status }}"
                                                                        lrow="{{ $listKey }}"
                                                                        ltype="{{ $listValue->type }}">
                                                                        Active
                                                                    </span>
                                                                @else
                                                                    <span class="badge alert-danger" id="listStatus"
                                                                        lid="{{ $listValue->id }}"
                                                                        lstatus="{{ $listValue->status }}"
                                                                        lrow="{{ $listKey }}"
                                                                        ltype="{{ $listValue->type }}">
                                                                        In Active
                                                                    </span>
                                                                @endif
                                                            </td>

                                                            <td>
                                                                <div class="tableOptions">
                                                                    <span class="text-dark" title="Edit">
                                                                        <a
                                                                            href="{{ route('admin.data.trade-data.edit-top-partner', $listValue->id) }}">
                                                                            <i class="fa fa-pencil"></i>
                                                                        </a>
                                                                    </span>
                                                                    <span class="text-danger" title="Delete"
                                                                        lid="{{ $listValue->id }}"
                                                                        lrow="{{ $listKey }}" id="deleteListBtn"
                                                                        ltype="{{ $listValue->type }}">
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

                            <div class="collapse sub_page_body {{ $tab == 'top_country' ? 'show' : 'hide' }}"
                                id="sub_page_body_top_country">
                                <div class="row">
                                    <div class="col-lg-12 mb-3">
                                        <div class="d-flex justify-content-between">
                                            <a href="{{ route('admin.data.trade-data.create-top-country') }}"
                                                class="btn btn-primary btn-sm">
                                                <ion-icon name="add" role="img" class="md hydrated"
                                                    aria-label="person add"></ion-icon>Create Top Country
                                            </a>

                                            @if ($top_country_export_id && count($top_country_export_id) > 0)
                                                <form action="" method="post" class="d-none">
                                                    @csrf
                                                    @method('post')

                                                    <input type="hidden"
                                                        value="{{ implode(',', $top_country_export_id) }}"
                                                        name="export_id">

                                                    <button class="btn btn-primary btn-sm" type="submit">
                                                        <ion-icon name="document-outline"></ion-icon>Export
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="table-responsive">
                                        <table id="tradeDataTopCountryTable"
                                            class="table table-sm table-borderless table-light" data-toggle="table"
                                            data-search="true" data-buttons-prefix="btn-md btn" data-pagination="true">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col" data-sortable="true">Title</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($top_country && count($top_country) > 0)
                                                    @foreach ($top_country as $listKey => $listValue)
                                                        <tr class="tr_row_{{ $listKey }}">

                                                            <th scope="row">{{ $listKey + 1 }}</th>

                                                            <td>
                                                                <a href="#" class="text-secondary">
                                                                    {{ $listValue->title }}
                                                                </a>
                                                            </td>

                                                            <td>
                                                                @if ($listValue->status == 1)
                                                                    <span class="badge alert-success" id="listStatus"
                                                                        lid="{{ $listValue->id }}"
                                                                        lstatus="{{ $listValue->status }}"
                                                                        lrow="{{ $listKey }}"
                                                                        ltype="{{ $listValue->type }}">
                                                                        Active
                                                                    </span>
                                                                @else
                                                                    <span class="badge alert-danger" id="listStatus"
                                                                        lid="{{ $listValue->id }}"
                                                                        lstatus="{{ $listValue->status }}"
                                                                        lrow="{{ $listKey }}"
                                                                        ltype="{{ $listValue->type }}">
                                                                        In Active
                                                                    </span>
                                                                @endif
                                                            </td>

                                                            <td>
                                                                <div class="tableOptions">
                                                                    <span class="text-dark" title="Edit">
                                                                        <a
                                                                            href="{{ route('admin.data.trade-data.edit-top-country', $listValue->id) }}">
                                                                            <i class="fa fa-pencil"></i>
                                                                        </a>
                                                                    </span>
                                                                    <span class="text-danger" title="Delete"
                                                                        lid="{{ $listValue->id }}"
                                                                        lrow="{{ $listKey }}" id="deleteListBtn"
                                                                        ltype="{{ $listValue->type }}">
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
                var ltype = $(this).attr('ltype');
                var url = null;
                if (ltype == 'top_partner') {
                    url = "{{ route('admin.data.trade-data.update-top-partner-status') }}";
                }
                if (ltype == 'top_country') {
                    url = "{{ route('admin.data.trade-data.update-top-country-status') }}";
                }

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
                            url: url,
                            method: 'POST',
                            data: {
                                _method: 'post',
                                _token: '{{ csrf_token() }}',
                                lid: lid,
                                lstatus: lstatus,
                                ltype: ltype,
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
                var ltype = $(this).attr('ltype');
                var url = null;
                if (ltype == 'top_partner') {
                    url = "{{ route('admin.data.trade-data.delete-top-partner') }}";
                }
                if (ltype == 'top_country') {
                    url = "{{ route('admin.data.trade-data.delete-top-country') }}";
                }

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
                                _method: 'post',
                                _token: '{{ csrf_token() }}',
                                lid: lid,
                                ltype: ltype,
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
