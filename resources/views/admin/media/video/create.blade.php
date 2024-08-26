@extends('layout.admin_master')

@section('title', 'Video - Create')
@section('header', 'Create Video')

@section('content')

    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Create Video</div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="p-4 border rounded">
                        <form action="{{ route('admin.media-center.video.store') }}" method="post" enctype="multipart/form-data" class="row g-3 needs-validation">
                            @csrf
                            @method('post')

                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip01" class="form-label">Type <span class="text-danger">*</span></label>
                                <select name="type" id="type" class="form-control">
                                    <option hidden value="">Type</option>
                                    <option value="external" {{ old('type') == 'external' ? 'selected' : '' }}>External</option>
                                    <option value="internal" {{ old('type') == 'internal' ? 'selected' : '' }}>Internal</option>
                                </select>

                                @error('type')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip01" class="form-label">Status <span class="text-danger">*</span></label>
                                <select name="status" class="form-control">
                                    <option hidden value="">Status</option>
                                    @foreach (config('site.status') as $status)
                                        <option value="{{ $status['value'] }}"
                                            {{ old('status') == $status['value'] ? 'selected' : '' }}>
                                            {{ $status['name'] }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="d-flex" id="typeWrapper">
                                <div class="col-md-6 position-relative" id="internal">
                                    <label for="images">Video <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" name="video" accept="video/*">

                                    @error('video')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 position-relative" id="external">
                                    <label for="images">Link <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="link" placeholder="Enter video link" value="{{ old('link') }}">

                                    @error('link')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 text-end mt-5">
                                <button class="btn btn-sm btn-primary" type="submit">Create</button>
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
            const oldSelType = "{{ old('type') ?? null }}";
            if(oldSelType){
                $('#typeWrapper').children().hide();
                $('div#' + oldSelType + '').show();
            }

            $(document).on('change', 'select#type', function(e) {
                e.preventDefault();

                var selType = $(this).val();

                $('#typeWrapper').children().hide();
                $('div#' + selType + '').show();

            });
        });
    </script>

@endsection
