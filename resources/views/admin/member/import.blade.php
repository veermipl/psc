@extends('layout.admin_master')

@section('title', 'Member - Import')
@section('header', 'Import Member')

@section('content')

    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Import Member</div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="p-4 border rounded">
                        <form method="post" id="excelImportMemberForm">
                            @csrf
                            @method('post')

                            <div class="row align-items-center">
                                <div class="col-md-9 custom-file">
                                    <input type="file" name="excelDoc" accept=".xls, .xlsx, .csv" class="form-control_">
                                </div>
                                <div class="col-md-3 text-right">
                                    <button type="submit" class="btn btn-primary btn-sm" id="excelImportMemberBtn">
                                        <ion-icon name="document-outline" role="img" class="md hydrated" aria-label="document"></ion-icon>Import
                                    </button>
                                    <a href="{{ route('admin.member.import-sample') }}" class="btn btn-primary btn-sm align-content-center">
                                        <ion-icon name="download-outline" role="img" class="md hydrated" aria-label="document"></ion-icon>Sample
                                    </a>
                                </div>
                            </div>

                            <div class="mt-2">
                                <p class="text-danger fw-bold_ m-0">Allowed file types .csv, .xls</p>
                                <p class="text-danger fw-bold_ m-0">Max file size of 5MB</p>
                            </div>
                        </form>

                        <hr>

                        <form method="post" id="excelAddMemberForm">
                            @csrf
                            @method('post')

                            <div class="table-responsive">
                                <table id="excelAddMemberTable" class="table table-sm table-borderless table-light" data-toggle="table" data-search="true" data-pagination="true">
                                    <thead>
                                        <tr>
                                            <th data-field="id" data-sortable="true">#</th>
                                            <th data-field="name" data-sortable="true">Name</th>
                                            <th data-field="email" data-sortable="true">Email</th>
                                            <th data-field="mobile" data-sortable="true">Mobile</th>
                                            <th data-field="membership_type" data-sortable="true">Membership Type</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>

                            <div class="errWrapper text-center">
                                <span class="error" id="importMemberErr"></span>
                                <div class="error" id="importMemberRowErr"></div>
                            </div>

                            <div class="col-12 text-end">
                                <button type="submit" class="btn btn-primary btn-sm text-light disabled" disabled id="excelAddMemberBtn">
                                    Create
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('scripts')

    <script type="text/javascript">
        $(document).ready(function() {

            $(document).on('submit', 'form#excelImportMemberForm', function(e) {
                e.preventDefault();

                var formData = new FormData(this);
                var excelDoc = $('input[name="excelDoc"]').val();

                if (!excelDoc || excelDoc == "" || excelDoc == null || excelDoc == undefined) {
                    Swal.fire({
                        html: 'No file selected',
                        icon: 'warning'
                    });

                    $("#importMemberErr").text("").fadeIn();
                    $("#importMemberRowErr").children().remove();
                    $("#importMemberRowErr").fadeOut();
                    $('#excelAddMemberTable').bootstrapTable('destroy');
                    $('#excelAddMemberBtn').addClass('disabled').prop('disabled', true);
                    return false;
                } else {}

                $.ajax({
                    url: "{{ route('admin.member.import-excel') }}",
                    method: 'post',
                    dataType: 'json',
                    data: formData,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $('#excelImportMemberBtn').removeClass('btn-primary').addClass('btn-danger disabled').text('Importing...').prop('disabled', true);
                        $("#importMemberErr").text("").fadeOut();
                        $("#importMemberRowErr").children().remove();
                        $("#importMemberRowErr").fadeOut();
                        $('#excelAddMemberTable').bootstrapTable('destroy');
                        $('#excelAddMemberBtn').addClass('disabled').prop('disabled', true);
                    },
                    success: function(res) {
                        if (res.error === true) {
                            $("#importMemberErr").text(res.msg).fadeIn();

                            if (res.invalidRow) {
                                var invalidRowArr = res.invalidRow;
                                var invalidRowStr = '';

                                for (let index = 0; index < invalidRowArr.length; index++) {
                                    $("#importMemberRowErr").append('<p>' + invalidRowArr[index] + '</p>');
                                    invalidRowStr +='<h6 class="pb-1">' + invalidRowArr[index] + '</h6>';
                                }

                                // $("#importMemberRowErr").fadeIn();

                                Swal.fire({
                                    title: 'Invalid Fields Found',
                                    html: invalidRowStr,
                                    icon: "warning",
                                    customClass: {
                                        popup: 'custom-width-popup' // Apply the custom class here
                                    }
                                });
                            }

                            $('#excelAddMemberBtn').addClass('disabled').prop('disabled', true);
                        }
                        if (res.error === false) {

                            if (res.importedData.length > 0) {
                                var data = res.importedData;
								$('#excelAddMemberTable').bootstrapTable({
									data: data
								});

                                $('#excelAddMemberBtn').removeClass('disabled').prop('disabled', false);
                            } else {
                                $('#excelAddMemberBtn').addClass('disabled').prop('disabled', true);
                            }
                        }
                    },
                    error: function(xhr, status, error) {
                        if(error == 'Forbidden'){
                            toastr.error(error);
                        }else{
                            Swal.fire({
                                title: 'Required Fields',
                                html: error.responseJSON.errors.excelDoc,
                                icon: "warning",
                            });
                        }
                    },
                    complete: function(xhr, status) {
                        $('#excelImportMemberBtn').removeClass('btn-danger disabled').addClass('btn-primary').html('<ion-icon name="download" role="img" class="md hydrated" aria-label="document"></ion-icon>Import').prop('disabled', false);
                    }
                });
            });

            $(document).on('submit', 'form#excelAddMemberForm', function(e) {
                e.preventDefault();

                var formData = new FormData(this);
                var table = $('#excelAddMemberTable').bootstrapTable('getData');

                formData.append('tableData', JSON.stringify(table));

                $.ajax({
                    url: "{{ route('admin.member.import-excel-add') }}",
                    method: 'post',
                    dataType: 'json',
                    data: formData,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $('#excelAddMemberBtn').removeClass('btn-custom').addClass('btn-danger disabled').text('Adding...').prop('disabled', true);
                        $("#importMemberErr").text("").fadeOut();
                    },
                    success: function(res) {
                        if (res.error === true) {
                            Swal.fire({
                                text: res.msg,
                                icon: "warning",
                            });
                        }
                        if (res.error === false) {
                            window.location.assign(res.redirect);
                        }
                    },
                    error: function(xhr, status, error) {
                        if(error == 'Forbidden'){
                            toastr.error(error);
                        }else{
                            Swal.fire({
                                title: 'Required Fields',
                                html: error.responseJSON.errors.excelDoc,
                                icon: "warning",
                            });
                        }
                    },
                    complete: function(xhr, status) {
                        $('#excelAddMemberBtn').removeClass('btn-danger disabled').addClass('btn-custom').text('Add').prop('disabled', false);
                    }
                });
            });

        });
    </script>

@endsection
