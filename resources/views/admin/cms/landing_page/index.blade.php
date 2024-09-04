@extends('layout.admin_master')

@section('title', 'CMS - Landing Page')
@section('header', 'CMS - Landing Page')

@section('content')

    <div class="page-breadcrumb d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Landing Page</div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="p-4 border rounded">
                        <div id="">
                            <button
                                class="btn btn-sm sub_page_link {{ $tab == 'header' ? 'btn-primary' : 'btn-outline-custom' }}"
                                id="sub_page_link_header" type="button" data-target="header">
                                Header
                            </button>
                            <button
                                class="btn btn-sm sub_page_link {{ $tab == 'sub_header' ? 'btn-primary' : 'btn-outline-custom' }}"
                                id="sub_page_link_sub_header" type="button" data-target="sub_header">
                                Sub Header
                            </button>
                            <button
                                class="btn btn-sm sub_page_link {{ $tab == 'about_us' ? 'btn-primary' : 'btn-outline-custom' }}"
                                id="sub_page_link_about_us" type="button" data-target="about_us">
                                About Us
                            </button>
                            <button
                                class="btn btn-sm sub_page_link {{ $tab == 'sector_committee' ? 'btn-primary' : 'btn-outline-custom' }}"
                                id="sub_page_link_sector_committee" type="button" data-target="sector_committee">
                                Sector Committees
                            </button>
                            <button
                                class="btn btn-sm sub_page_link {{ $tab == 'report' ? 'btn-primary' : 'btn-outline-custom' }}"
                                id="sub_page_link_report" type="button" data-target="report">
                                Annual Report
                            </button>
                            <button
                                class="btn btn-sm sub_page_link {{ $tab == 'post' ? 'btn-primary' : 'btn-outline-custom' }}"
                                id="sub_page_link_post" type="button" data-target="post">
                                Posts
                            </button>
                        </div>

                        <div id="" class="pt-4">

                            <div class="collapse sub_page_body {{ $tab == 'header' ? 'show' : 'hide' }}"
                                id="sub_page_body_header">
                                <div class="row">
                                    <div class="col-lg-12 mb-3">
                                        <div class="d-flex justify-content-between">
                                            <a href="{{ route('admin.cms.landing-page.create.header') }}" class="btn btn-primary btn-sm">
                                                <ion-icon name="add" role="img" class="md hydrated" aria-label="person add"></ion-icon>
                                                Create Header
                                            </a>

                                            @if ($header_export_id && count($header_export_id) > 0)
                                                <form action="" method="post" class="d-none">
                                                    @csrf
                                                    @method('post')

                                                    <input type="hidden" value="{{ implode(',', $header_export_id) }}" name="export_id">

                                                    <button class="btn btn-primary btn-sm" type="submit">
                                                        <ion-icon name="document-outline"></ion-icon>Export
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="table-responsive">
                                        <table id="headerTable"
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
                                                @if ($header && count($header) > 0)
                                                    @foreach ($header as $listKey => $listValue)
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
                                                                            href="{{ route('admin.cms.landing-page.edit.header', $listValue->id) }}">
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

                            <div class="collapse sub_page_body {{ $tab == 'sub_header' ? 'show' : 'hide' }}"
                                id="sub_page_body_sub_header">
                                <div class="row">
                                    <div class="col-lg-12 mb-3">
                                        <div class="d-flex justify-content-between">
                                            <a href="{{ route('admin.cms.landing-page.create.sub-header') }}" class="btn btn-primary btn-sm">
                                                <ion-icon name="add" role="img" class="md hydrated" aria-label="person add"></ion-icon>
                                                Create Sub Header
                                            </a>

                                            @if ($sub_header_export_id && count($sub_header_export_id) > 0)
                                                <form action="" method="post" class="d-none">
                                                    @csrf
                                                    @method('post')

                                                    <input type="hidden"
                                                        value="{{ implode(',', $sub_header_export_id) }}"
                                                        name="export_id">

                                                    <button class="btn btn-primary btn-sm" type="submit">
                                                        <ion-icon name="document-outline"></ion-icon>Export
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="table-responsive">
                                        <table id="subHeaderTable"
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
                                                @if ($sub_header && count($sub_header) > 0)
                                                    @foreach ($sub_header as $listKey => $listValue)
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
                                                                            href="{{ route('admin.cms.landing-page.edit.sub-header', $listValue->id) }}">
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

                            <div class="collapse sub_page_body {{ $tab == 'about_us' ? 'show' : 'hide' }}"
                                id="sub_page_body_about_us">
                                <div class="row">
                                    <form action="{{ route('admin.cms.landing-page.update.about-us', ['tab' => 'about_us']) }}" method="post" enctype="multipart/form-data" class="row g-3 needs-validation">
                                        @csrf
                                        @method('post')

                                        <input type="hidden" name="type" value="about_us">
                                        <input type="hidden" name="old_file" value="{{ @$about_us->file }}">

                                        <div class="col-md-6 position-relative">
                                            <label for="validationTooltip01" class="form-label">Title <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" id="title" class="form-control" name="title"
                                                placeholder="Enter title" value="{{ old('title', @$about_us->title) }}"
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
                                            <label for="validationTooltip01" class="form-label">Content <span class="text-danger">*</span></label>
                                            <textarea name="content" id="editor" cols="5" rows="5" class="form-control">{{ old('content', @$about_us->content) }}</textarea>

                                            @error('content')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-12 position-relative">
                                            @if (@$about_us->file)
                                                <img class="ge_img pop_up_image" src="{{ asset('storage/' . $about_us->file) }}">
                                            @endif
                                        </div>

                                        <div class="col-12 text-end mt-5">
                                            <button class="btn btn-sm btn-primary" type="submit">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="collapse sub_page_body {{ $tab == 'sector_committee' ? 'show' : 'hide' }}"
                                id="sub_page_body_sector_committee">
                                <div class="row">
                                    <div class="col-lg-12 mb-3">
                                        <div class="d-flex justify-content-between">
                                            <a href="{{ route('admin.cms.landing-page.create.sector-committee') }}" class="btn btn-primary btn-sm">
                                                <ion-icon name="add" role="img" class="md hydrated" aria-label="person add"></ion-icon>
                                                Create Sector Committee
                                            </a>

                                            @if ($sector_committee_export_id && count($sector_committee_export_id) > 0)
                                                <form action="" method="post" class="d-none">
                                                    @csrf
                                                    @method('post')

                                                    <input type="hidden"
                                                        value="{{ implode(',', $sector_committee_export_id) }}"
                                                        name="export_id">

                                                    <button class="btn btn-primary btn-sm" type="submit">
                                                        <ion-icon name="document-outline"></ion-icon>Export
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="table-responsive">
                                        <table id="SectorCommitteeTable"
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
                                                @if ($sector_committees && count($sector_committees) > 0)
                                                    @foreach ($sector_committees as $listKey => $listValue)
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
                                                                            href="{{ route('admin.cms.landing-page.edit.sector-committee', $listValue->id) }}">
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

                            <div class="collapse sub_page_body {{ $tab == 'report' ? 'show' : 'hide' }}"
                                id="sub_page_body_report">
                                <div class="row">
                                    <form action="{{ route('admin.cms.landing-page.update.report') }}" method="post" enctype="multipart/form-data" class="row g-3 needs-validation">
                                        @csrf
                                        @method('post')

                                        <input type="hidden" name="type" value="report">
                                        <input type="hidden" name="old_file" value="{{ @$report->file }}">
                                        <input type="hidden" name="old_icon" value="{{ @$report->icon }}">

                                        <div class="col-md-6 position-relative">
                                            <label for="validationTooltip01" class="form-label">Title <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" id="title" class="form-control" name="title"
                                                placeholder="Enter title" value="{{ old('title', @$report->title) }}"
                                                maxlength="50">

                                            @error('title')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 position-relative">
                                            <label for="validationTooltip01" class="form-label">Link</label>
                                            <input type="text" id="link" class="form-control" name="link"
                                                placeholder="Enter link" value="{{ old('link', @$report->link) }}"
                                                maxlength="50">

                                            @error('link')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 position-relative">
                                            <label for="validationTooltip01" class="form-label">Image <span class="text-danger">*</span></label>
                                            <input type="file" class="form-control" name="file" accept="image/*">

                                            @error('file')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 position-relative">
                                            <label for="validationTooltip01" class="form-label">Icon</label>
                                            <input type="file" class="form-control" name="icon" accept="image/*">

                                            @error('icon')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 position-relative">
                                            @if (@$report->file)
                                                <img class="ge_img pop_up_image" src="{{ asset('storage/' . $report->file) }}">
                                            @endif
                                        </div>

                                        <div class="col-md-6 position-relative">
                                            @if (@$report->icon)
                                                <img class="ge_img pop_up_image" src="{{ asset('storage/' . $report->icon) }}">
                                            @endif
                                        </div>

                                        <div class="col-md-12 position-relative">
                                            <label for="validationTooltip01" class="form-label">Content <span class="text-danger">*</span></label>
                                            <textarea name="content" id="" cols="5" rows="5" class="form-control editor">{{ old('content', @$report->content) }}</textarea>

                                            @error('content')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        

                                        <div class="col-12 text-end mt-5">
                                            <button class="btn btn-sm btn-primary" type="submit">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="collapse sub_page_body {{ $tab == 'post' ? 'show' : 'hide' }}"
                                id="sub_page_body_post">
                                <div class="row">
                                    <div class="col-lg-12 mb-3">
                                        <div class="d-flex justify-content-between">
                                            <a href="{{ route('admin.cms.landing-page.create.post') }}" class="btn btn-primary btn-sm">
                                                <ion-icon name="add" role="img" class="md hydrated" aria-label="person add"></ion-icon>
                                                Create Post
                                            </a>

                                            @if ($posts_export_id && count($posts_export_id) > 0)
                                                <form action="" method="post" class="d-none">
                                                    @csrf
                                                    @method('post')

                                                    <input type="hidden" value="{{ implode(',', $posts_export_id) }}" name="export_id">

                                                    <button class="btn btn-primary btn-sm" type="submit">
                                                        <ion-icon name="document-outline"></ion-icon>Export
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="table-responsive">
                                        <table id="postTable"
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
                                                @if ($posts && count($posts) > 0)
                                                    @foreach ($posts as $listKey => $listValue)
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
                                                                            href="{{ route('admin.cms.landing-page.edit.post', $listValue->id) }}">
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
                var url = "{{ route('admin.cms.landing-page.update-status') }}";

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
                                $('span#listStatus[urow="' + lrow + '"]').prop('disabled', true).css({
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
                var url = "{{ route('admin.cms.landing-page.delete') }}";

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
