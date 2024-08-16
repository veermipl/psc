@extends('layout.admin_master')

@section('title', 'Video - Create')
@section('header', 'Create Video')

@section('content')

    <div class="p-3 bg-white">

        <h5 class="fw-bold">Create Video</h5>

        <div class="pt-5">
            <form action="{{ route('admin.media-center.video.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('post')

                <div class="d-flex">
                    <div class="form-group col-md-6">
                        <label for="status">Type <span class="text-danger">*</span></label>
                        <select name="type" id="type" class="form-control">
                            <option hidden value="">Type</option>
                            <option value="external" {{ old('type') == 'external' ? 'selected' : '' }}>External</option>
                            <option value="internal" {{ old('type') == 'internal' ? 'selected' : '' }}>Internal</option>
                        </select>

                        @error('type')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="status">Status <span class="text-danger">*</span></label>
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
                </div>

                <div class="d-flex" id="typeWrapper">
                    <div class="form-group col-md-6" id="internal">
                        <label for="images">Video <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" name="video" accept="video/*">

                        @error('video')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6" id="external">
                        <label for="images">Link <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="link" placeholder="Enter video link" value="{{ old('link') }}">

                        @error('link')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group col-md-12 text-right">
                    <button class="btn btn-sm btn-custom" type="submit">Create Video</button>
                </div>
            </form>
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
