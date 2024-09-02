
@extends('layout.admin_master')

@section('title', 'Historical overview')
@section('header', 'Historical overview')

@section('content')

    <div class="page-breadcrumb d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3"> Historical overview   </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="p-4 border rounded">
                        <div id="" class="pt-4">
                            <div class="collapse sub_page_body {{ $tab == 'About' ? 'show' : 'hide' }}"  id="sub_page_body_About">
                                <form action="{{ route('admin.about.history_update') }}" method="post" enctype="multipart/form-data" class="row g-3 needs-validation">
                                    @csrf
                                    @method('post')

                                    <div class="col-md-12 position-relative">
                                        <label for="validationTooltip01" class="form-label">Title <span
                                                class="text-danger">*</span></label>
                                        <input type="text" id="title" class="form-control" name="title"
                                            placeholder="Enter title" value="{{ old('title', @$About->title) }}"
                                            maxlength="50"> {{ old('title', @$About->title) }}

                                        @error('title')
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
                                    <input type="hidden" name="type" value="History">
                                    <div class="col-12 text-end mt-5">
                                        <button class="btn btn-sm btn-primary" type="submit">Update</button>
                                    </div>
                                </form>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection