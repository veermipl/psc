@extends('layout.admin_master')

@section('title', 'Services Procurement Procedures')

@section('content')

    <div class="p-3 bg-white">
        <h5 class="fw-bold">Create Services Procurement Procedures</h5>

        <div class="pt-5">
            <form action="{{ route('admin.readines.services.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('post')
                <div class="d-flex">
                    <div class="form-group col-md-6">
                        <label for="name">Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="title" placeholder="Title"
                            value="{{ old('title', @$data->title) }}" maxlength="50">

                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="name">Images  </label>
                        <input type="file" class="form-control" name="images"  accept="image/*" multiple>

                        @error('images')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- <div class="form-group col-md-2">
                        @if(@$data->image != '')
                        <img style="width: 50px; height: 58px;  margin-top: 15px;" src="{{asset('storage/'.@$data->image)}}">
                        @else
                        <img style="width: 50px; height: 58px;  margin-top: 15px;" src="{{asset('images/team/commeties.png')}}">
                        @endif
                    </div> -->
                </div>

                <div class="form-group col-md-12">
                    <label for="content">Content <span class="text-danger">*</span></label>
                    <textarea name="content" id="editor" cols="5" rows="5" class="form-control">{{ old('content', @$data->contant) }}</textarea>

                    @error('content')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="d-flex">
                    <div class="form-group col-md-6">
                        <label for="membership_type">Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-control">
                            <option hidden value="">Status</option>
                            @foreach (config('site.status') as $status)
                                <option value="{{ $status['value'] }}"
                                    {{ old('status', @$data->status) == $status['value'] ? 'selected' : '' }}>
                                    {{ $status['name'] }}
                                </option>
                            @endforeach
                        </select>

                        @error('status')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                    </div>
                </div>

                <div class="form-group col-md-12 text-right">
                    <button class="btn btn-sm btn-custom" type="submit">Create</button>
                </div>
            </form>
        </div>
    </div>

@endsection