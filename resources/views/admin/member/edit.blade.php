@extends('layout.admin_master')

@section('title', 'Member - Update')
@section('header', 'Update Member')

@section('content')

    <div class="p-3 bg-white">

        <h5 class="fw-bold">Update Member</h5>

        <div class="pt-5">
            <form action="{{ route('admin.member.update', $user->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('patch')

                <div class="d-flex">
                    <div class="form-group col-md-6">
                        <label for="name">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" placeholder="Enter name"
                            value="{{ old('name', $user->name) }}" maxlength="50">

                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="membership_type">Membership Type <span class="text-danger">*</span></label>
                        <select name="membership_type" class="form-control">
                            <option hidden value="">Select Membership Type</option>
                            @foreach ($membershipList as $membership)
                                <option value="{{ $membership['id'] }}"
                                    {{ old('membership_type', $user->membership_type) == $membership['id'] ? 'selected' : '' }}>
                                    {{ $membership['name'] }}
                                </option>
                            @endforeach
                        </select>

                        @error('membership_type')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="d-flex">
                    <div class="form-group col-md-6">
                        <label for="email">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}"
                            placeholder="Enter email" maxlength="50" readonly disabled>

                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="number">Contact Number <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="contact"
                            value="{{ old('contact', $user->mobile_number) }}" placeholder="Enter contact"
                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">

                        @error('contact')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="d-flex">
                    <div class="form-group col-md-6">
                        <label for="form_pdf">Upload Filled Form</label>
                        <input type="file" id="form_pdf" class="form-control" name="form_pdf" accept="application/pdf">

                        @error('form_pdf')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="supported_files">Upload Supporting Documents</label>
                        <input type="file" id="supporting_document" class="form-control" name="supporting_document[]" accept="application/pdf" multiple>

                        @error('supported_files')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="d-flex">
                    <div class="form-group col-md-6">
                        @if ($user->form_pdf)
                            <div class="editDocWrapper" doc_row_url="{{ $user->form_pdf }}">
                                <input type="hidden" name="old_form" value="{{ $user->form_pdf }}">
                                <span class="text-center">
                                    <a href="{{ $user->form_pdf ? asset('storage/' . $user->form_pdf) : '' }}"
                                        target="_blank" title="Filled Form">
                                        <i class="fa fa-file-pdf text-danger"></i>
                                    </a>
                                </span>
                                <button class="btn btn-sm btn-outline-danger mt-2 deleteDocBtn" type="button" id="{{ $user->id }}" doc_url="{{ $user->form_pdf }}" doc_type="form">
                                    Delete
                                </button>
                            </div>
                        @endif
                    </div>

                    <div class="form-group col-md-6">
                        @if ($user->supportingDoc)
                            @php
                                $docsArr = $user->supportingDoc->pluck('file_name')->toArray();
                            @endphp
                            <div class="allDocWrapper d-flex">
                                @foreach ($docsArr as $docKey => $docVal)
                                    @if ($docVal)
                                        <div class="editDocWrapper" doc_row_url="{{ $docVal }}">
                                            <input type="hidden" name="old_doc[]" value="{{ $docVal }}">
                                            <span class="text-center">
                                                <a href="{{ $docVal ? asset('storage/' . $docVal) : '' }}"
                                                target="_blank" title="Filled Form">
                                                    <i class="fa fa-file-pdf text-danger"></i>
                                                </a>
                                            </span>
                                            <button class="btn btn-sm btn-outline-danger mt-2 deleteDocBtn" type="button" id="{{ $user->id }}" doc_url="{{ $docVal }}" doc_type="supporting">
                                                Delete
                                            </button>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <div class="d-flex">
                    <div class="form-group col-md-6">
                        <label for="membership_type">Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-control">
                            <option hidden value="">Status</option>
                            @foreach (config('site.status') as $status)
                                <option value="{{ $status['value'] }}"
                                    {{ old('status', $user->status) == $status['value'] ? 'selected' : '' }}>
                                    {{ $status['name'] }}
                                </option>
                            @endforeach
                        </select>

                        @error('status')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="confirmed">Update Password </label>
                        <input type="password" id="password" class="form-control" name="password" value=""
                            placeholder="Update password" maxlength="50">

                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group col-md-12 text-right">
                    <button class="btn btn-sm btn-custom" type="submit">Update Member</button>
                </div>
            </form>
        </div>
    </div>

@endsection



@section('scripts')

    <script type="text/javascript">
        $(document).ready(function() {

            $(document).on('click', '.deleteDocBtn', function(e) {
                e.preventDefault();

                var id = $(this).attr('id');
                var doc_url = $(this).attr('doc_url');
                var doc_type = $(this).attr('doc_type');

                Swal.fire({
                    title: 'Are you sure ?',
                    showCancelButton: true,
                    confirmButtonColor: '#24695c',
                    cancelButtonColor: '#d22d3d',
                    confirmButtonText: 'Yes, Delete it !'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('admin.member.delete-doc') }}",
                            method: 'POST',
                            data: {
                                _method: 'post',
                                _token: '{{ csrf_token() }}',
                                id: id,
                                doc_url: doc_url,
                                doc_type: doc_type,
                            },
                            dataType: "json",
                            beforeSend: function() {
                                // $('.preloader').show();
                            },
                            success: function(response) {
                                if (response.error === false) {
                                    $('div.editDocWrapper[doc_row_url="'+doc_url+'"]').remove();

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
                            }
                        });
                    }
                });

            });
        });
    </script>

@endsection