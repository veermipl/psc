@extends('layout.admin_master')

@section('title', 'Queries - Contact Us')
@section('header', 'Queries - Contact Us')

@section('content')

    <div class="page-breadcrumb d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Queries - Contact Us</div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="p-4 border rounded">
                        <form action="{{ route('admin.queries.contact-us.filter') }}" method="post"
                            class="row g-3 needs-validation">
                            @csrf
                            @method('post')

                            <div class="col-md-4 position-relative">
                                <input type="text" class="form-control" name="name" placeholder="Name" value="{{ $filterValues['name'] }}">
                            </div>

                            <div class="col-md-4 position-relative">
                                <input type="text" class="form-control" name="email" placeholder="Email" value="{{ $filterValues['email'] }}">
                            </div>
                            
                            <div class="col-md-4 position-relative">
                                <input type="text" class="form-control" name="phone" placeholder="Phone" value="{{ $filterValues['phone'] }}">
                            </div>

                            <div class="col-12 text-end">
                                <a href="{{ route('admin.queries.contact-us') }}"
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
                    <form action="{{ route('admin.queries.export') }}" method="post" class="d-none-">
                        @csrf
                        @method('post')

                        <input type="hidden" value="{{ implode(',', $export_id) }}" name="export_id">
                        <input type="hidden" value="contact_us_queries" name="file_name">

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
                        <table id="queryContactUsTable" class="table table-sm table-borderless table-light"
                            data-toggle="table" data-search="true" data-buttons-prefix="btn-md btn" data-pagination="true">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col" data-sortable="true">Name</th>
                                    <th scope="col" data-sortable="true">Email</th>
                                    <th scope="col" data-sortable="true">Phone</th>
                                    <th scope="col" data-sortable="true">Message</th>
                                    <th scope="col" data-sortable="true">Date</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($dataList && count($dataList) > 0)
                                    @foreach ($dataList as $listKey => $listValue)
                                        <tr class="tr_row_{{ $listKey }}">

                                            <th scope="row">{{ $listKey + 1 }}</th>

                                            <td>
                                                <a href="{{ route('admin.queries.contact-us.view', $listValue->id) }}"
                                                    class="text-secondary">
                                                    {{ $listValue->name }}
                                                </a>
                                            </td>

                                            <td>
                                                {{ $listValue->email }}
                                            </td>

                                            <td>
                                                {{ $listValue->phone }}
                                            </td>

                                            <td>
                                                {{ Str::limit($listValue->message, 20) }}
                                            </td>

                                            <td>
                                                {{ date('jS \o\f F Y', strtotime($listValue->created_at)) }}
                                            </td>

                                            <td>
                                                <div class="tableOptions">
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
                            url: "{{ route('admin.queries.delete') }}",
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
