@extends('layout.admin_master')

@section('title', 'Member - Update')
@section('header', 'Update Member')

@section('content')

    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Update Member</div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="p-4 border rounded">
                        <form action="{{ route('admin.member.update', $user->id) }}" method="post" enctype="multipart/form-data" class="row g-3 needs-validation">
                            @csrf
                            @method('patch')

                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip01" class="form-label">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" placeholder="Enter name"
                                    value="{{ old('name', $user->name) }}" maxlength="50">

                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip01" class="form-label">Membership Type <span class="text-danger">*</span></label>
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

                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip01" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}"
                                    placeholder="Enter email" maxlength="50" readonly disabled>

                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip01" class="form-label">Contact Number <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="contact"
                                    value="{{ old('contact', $user->mobile_number) }}" placeholder="Enter contact"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">

                                @error('contact')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip01" class="form-label">Upload Filled Form</label>
                                <input type="file" id="form_pdf" class="form-control" name="form_pdf" accept="application/pdf">

                                @error('form_pdf')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip01" class="form-label">Upload Supporting Documents</label>
                                <input type="file" id="supporting_document" class="form-control" name="supporting_document[]" accept="application/pdf" multiple>

                                @error('supported_files')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 position-relative">
                                @if ($user->form_pdf)
                                    <div class="editFileWrapper" doc_row_url="{{ $user->form_pdf }}">
                                        <input type="hidden" name="old_form" value="{{ $user->form_pdf }}">
                                        <span class="text-center pdf-files">
                                            <a href="{{ $user->form_pdf ? asset('storage/' . $user->form_pdf) : '' }}"
                                                target="_blank" title="Filled Form">
                                                <i class="fa fa-file text-dark"></i>
                                            </a>
                                        </span>
                                        {{-- <button class="btn btn-sm btn-outline-danger mt-2 deleteDocBtn" type="button" id="{{ $user->id }}" doc_url="{{ $user->form_pdf }}" doc_type="form">
                                            Delete
                                        </button> --}}
                                       <div class="ghy deleteDocBtn" id="{{ $user->id }}" doc_url="{{ $user->form_pdf }}" doc_type="form">
                                            <div class="cross-m"><i class="fa fa-close bg-danger"></i></div>
                                       </div>
                                    </div>
                                @endif
                            </div>

                            <div class="col-md-6 position-relative">
                                @if ($user->supportingDoc)
                                    @php
                                        $docsArr = $user->supportingDoc->pluck('file_name')->toArray();
                                    @endphp
                                    <div class="allDocWrapper d-flex">
                                        @foreach ($docsArr as $docKey => $docVal)
                                            @if ($docVal)
                                                <div class="editFileWrapper" doc_row_url="{{ $docVal }}">
                                                    <input type="hidden" name="old_doc[]" value="{{ $docVal }}">
                                                    <span class="text-center pdf-files">
                                                        <a href="{{ $docVal ? asset('storage/' . $docVal) : '' }}"
                                                        target="_blank" title="Filled Form">
                                                            <i class="fa fa-file text-dark"></i>
                                                        </a>
                                                    </span>
                                                    {{-- <button class="btn btn-sm btn-outline-danger mt-2 deleteDocBtn" type="button" id="{{ $user->id }}" doc_url="{{ $docVal }}" doc_type="supporting">
                                                        Delete
                                                    </button> --}}
                                                   <div class="ghy deleteDocBtn" id="{{ $user->id }}" doc_url="{{ $docVal }}" doc_type="supporting">
                                                        <div class="cross-m"><i class="fa fa-close bg-danger"></i></div>
                                                   </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                @endif
                            </div>

                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip01" class="form-label">Status <span class="text-danger">*</span></label>
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

                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip01" class="form-label">Update Password </label>
                                <input type="password" id="password" class="form-control" name="password" value=""
                                    placeholder="Update password" maxlength="50">

                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-12 text-end mt-5">
                                <button class="btn btn-sm btn-primary" type="submit">Update</button>
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

            $(document).on('click', '.deleteDocBtn', function(e) {
                e.preventDefault();

                var id = $(this).attr('id');
                var doc_url = $(this).attr('doc_url');
                var doc_type = $(this).attr('doc_type');

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
                                    $('div.editFileWrapper[doc_row_url="'+doc_url+'"]').remove();

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