@extends('layout.admin_master')

@section('title', 'Member - Import')
@section('header', 'Import Member')

@section('content')

    <div class="p-3 bg-white">

        <h5 class="fw-bold">Import Member</h5>

        <div class="pt-5">
            <form method="post" id="excelImportMemberForm">
                @csrf
                @method('post')

                <div class="row align-items-center">
                    <div class="col-md-9 custom-file">
                        <input type="file" name="excelDoc" accept=".xls, .xlsx, .csv" class="form-control_">
                    </div>
                    <div class="col-md-3 text-right">
                        <button type="submit" class="btn btn-outline-custom btn-sm" id="excelImportMemberBtn">
                            <i class="fa fa-download pr-1"></i>Import
                        </button>
                        <a href="{{ route('admin.member.import-sample') }}" class="btn btn-outline-custom btn-sm align-content-center">
                            <i class="fa fa-file pr-1"></i>Sample
                        </a>
                    </div>
                </div>

                <div class="mt-2">
                    <h6 class="text-danger fw-bold">Allowed file types .csv, .xls</h6>
                    <h6 class="text-danger fw-bold">Max file size of 5MB</h6>
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
                            </tr>
                        </thead>
                    </table>
                </div>

                <div class="errWrapper text-center">
                    <span class="error" id="importMemberErr"></span>
                    <div class="error" id="importMemberRowErr"></div>
                </div>

                <div class="form-group text-right mt-3">
                    <button type="submit" class="btn btn-custom text-light disabled" disabled id="excelAddMemberBtn">
                        Add
                    </button>
                </div>
            </form>
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
                        $('#excelImportMemberBtn').removeClass('btn-outline-custom').addClass('btn-danger disabled').text('Importing...').prop('disabled', true);
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
                        $('#excelImportMemberBtn').removeClass('btn-danger disabled').addClass('btn-outline-custom').text('Import').prop('disabled', false);
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
