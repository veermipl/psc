
@extends('layout.admin_master')

@section('title', 'About - List')
@section('header', 'Introduction')

@section('content')

    <div class="page-breadcrumb d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3"> About Us </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="p-4 border rounded">
                        <div id="">
                            <button
                                class="btn btn-sm sub_page_link {{ $tab == 'About' ? 'btn-custom' : 'btn-outline-custom' }}"
                                id="sub_page_link_About" type="button" data-target="About">
                                Introduction
                            </button>
                            <button
                                class="btn btn-sm sub_page_link {{ $tab == 'Mission' ? 'btn-custom' : 'btn-outline-custom' }}"
                                id="sub_page_link_Mission" type="button" data-target="Mission">
                                Mission Statement
                            </button>

                            <button
                                class="btn btn-sm sub_page_link {{ $tab == 'strategic' ? 'btn-custom' : 'btn-outline-custom' }}"
                                id="sub_page_link_strategic" type="button" data-target="strategic">
                                Strategic Priority Areas
                            </button>
                            <button
                                class="btn btn-sm sub_page_link {{ $tab == 'top_partner' ? 'btn-custom' : 'btn-outline-custom' }}"
                                id="sub_page_link_top_partner" type="button" data-target="top_partner">
                                 Core Value
                            </button>

                            <button
                                class="btn btn-sm sub_page_link {{ $tab == 'top_country' ? 'btn-custom' : 'btn-outline-custom' }}"
                                id="sub_page_link_top_country" type="button" data-target="top_country">
                                Performance Drivers
                            </button>

                        </div>

                        <div id="" class="pt-4">
                            <div class="collapse sub_page_body {{ $tab == 'About' ? 'show' : 'hide' }}"  id="sub_page_body_About">
                                <form action="{{ route('admin.about.introduction_update') }}" method="post" enctype="multipart/form-data" class="row g-3 needs-validation">
                                    @csrf
                                    @method('post')

                                    <input type="hidden" name="type" value="About">
                                    <!-- <input type="hidden" name="old_file" value="{{ @$main->file }}"> -->

                                    <div class="col-md-6 position-relative">
                                        <label for="validationTooltip01" class="form-label">Title <span
                                                class="text-danger">*</span></label>
                                        <input type="text" id="title" class="form-control" name="title"
                                            placeholder="Enter title" value="{{ old('title', @$About->title) }}"
                                            maxlength="50"> {{ old('title', @$About->title) }}

                                        @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 position-relative">
                                        <label for="validationTooltip01" class="form-label">Image <span
                                                class="text-danger">*</span></label>
                                        <input type="file" class="form-control" name="images" accept="image/*">

                                        @error('images')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-12 position-relative">
                                        <label for="validationTooltip01" class="form-label">Content <span
                                                class="text-danger">*</span></label>
                                        <textarea name="content" id="editor" cols="5" rows="5" class="form-control">{{ old('content', @$About->contant) }}</textarea>

                                        @error('content')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-12 position-relative">
                                  
                                        @if (@$About->image)
                                            <img class="ge_img pop_up_image" src="{{ asset('storage/' . $About->image) }}">
                                        @endif
                                    </div>
                                    <input type="hidden" name="type" value="About">
                                    <div class="col-12 text-end mt-5">
                                        <button class="btn btn-sm btn-primary" type="submit">Update</button>
                                    </div>
                                </form>
                            </div>


                            <div class="collapse sub_page_body {{ $tab == 'Mission' ? 'show' : 'hide' }}"
                                id="sub_page_body_Mission">
                                <form action="{{ route('admin.about.mission_update') }}" method="post" enctype="multipart/form-data" class="row g-3 needs-validation">
                                    @csrf
                                    @method('post')

                                    <input type="hidden" name="type" value="Mission">

                                    <div class="col-md-6 position-relative">
                                        <label for="validationTooltip01" class="form-label">Title <span
                                                class="text-danger">*</span></label>
                                        <input type="text" id="title" class="form-control" name="title"
                                            placeholder="Enter title" value="{{ old('title', @$mission->title) }}"
                                            maxlength="50"> {{ old('title', @$mission->title) }}

                                        @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 position-relative">
                                        <label for="validationTooltip01" class="form-label">Image <span
                                                class="text-danger">*</span></label>
                                        <input type="file" class="form-control" name="images" accept="image/*">

                                        @error('images')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-12 position-relative">
                                        <label for="validationTooltip01" class="form-label">Content <span
                                                class="text-danger">*</span></label>
                                        <textarea name="content" id="editor" cols="5" rows="5" class="form-control">{{ old('content', @$mission->contant) }}</textarea>

                                        @error('content')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-12 position-relative">
                                  
                                        @if (@$mission->image)
                                            <img class="ge_img pop_up_image" src="{{ asset('storage/' . $mission->image) }}">
                                        @endif
                                    </div>
                                    <input type="hidden" name="type" value="Mission">
                                    <div class="col-12 text-end mt-5">
                                        <button class="btn btn-sm btn-primary" type="submit">Update</button>
                                    </div>
                                </form>
                            </div>


                            <div class="collapse sub_page_body {{ $tab == 'strategic' ? 'show' : 'hide' }}"
                                id="sub_page_body_strategic">
                                <div class="row">
                                    <div class="col-lg-12 mb-3">
                                        <div class="d-flex justify-content-between">
                                            <a href="{{ route('admin.testimonial.create') }}"
                                                class="btn btn-primary btn-sm">
                                                <ion-icon name="add" role="img" class="md hydrated"
                                                    aria-label="person add"></ion-icon>Strategic Priority Areas
                                            </a>

                                            
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


                                            @if ($strategic && count($strategic) > 0)
                                                    @foreach ($strategic as $listKey => $listValue)
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
                                                                            href="{{ route('admin.testimonial.edit', $listValue->id) }}">
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


                            <div class="collapse sub_page_body {{ $tab == 'top_partner' ? 'show' : 'hide' }}"
                                id="sub_page_body_top_partner">
                                <div class="row">
                                    <div class="col-lg-12 mb-3">
                                        <div class="d-flex justify-content-between">
                                            <a href="{{ route('admin.add_corevalue') }}"
                                                class="btn btn-primary btn-sm">
                                                <ion-icon name="add" role="img" class="md hydrated"
                                                    aria-label="person add"></ion-icon>Create Core value 
                                            </a>

                                           
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
                                                                            href="{{ route('admin.edit_corevalue', $listValue->id) }}">
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
                                            <a href="{{ route('admin.add_performance') }}"
                                                class="btn btn-primary btn-sm">
                                                <ion-icon name="add" role="img" class="md hydrated"
                                                    aria-label="person add"></ion-icon>Create Performance Drivers
                                            </a>

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
                                                                            href="{{ route('admin.performance_edit', $listValue->id) }}">
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

                // alert(ltype);
                var url = null;
                if (ltype == 'testimonials') {
                    url = "{{ route('admin.testimonial.status') }}";
                }
                if (ltype == 'core_value') {
                    url = "{{ route('admin.status_corevalue') }}";
                }
                if (ltype == 'performance_driverss') {
                    url = "{{ route('admin.performance_status') }}";
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

                if (ltype == 'testimonials') {
                    url = "{{ route('admin.testimonial.destroy') }}";
                }
                
                if (ltype == 'core_value') {
                    url = "{{ route('admin.destroy_corevalue') }}";
                }

                if (ltype == 'performance_driverss') {
                    url = "{{ route('admin.performance_destroy') }}";
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