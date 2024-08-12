@extends('layout.admin_master')
<!-- @section('title', 'Saff - Create')
@section('header', 'Create Saff') -->
@section('content')

<div class="p-3 bg-white">

    <h5 class="fw-bold">Edit Saff</h5>

    <div class="pt-5">
        <form action="{{ route('admin.staff.update', $data->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="d-flex">
                <div class="form-group col-md-6">
                    <label for="name">Name <span class="text-danger">*</span></label>
                    <input type="text" id="name" class="form-control" name="name" placeholder="Enter name"
                        value="{{ old('name', @$data->name) }}" maxlength="50">

                    @error('name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group col-md-6">
                    <label for="office">Office <span class="text-danger">*</span></label>
                    <input type="text" id="office" class="form-control" name="office" placeholder="Office"
                        value="{{ old('office', @$data->office) }}" maxlength="50">

                    @error('office')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="d-flex">
                <div class="form-group col-md-6">
                    <label for="facebook">Facebook link </label>
                    <input type="text" id="facebook" class="form-control" name="facebook" placeholder="Enter Facebook link"
                        value="{{ old('facebook', @$data->facebook) }}" maxlength="50">

                    @error('facebook')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group col-md-6">
                    <label for="twitter">Twitter Link </label>
                    <input type="text" id="twitter" class="form-control" name="twitter" placeholder="Twitter Link"
                        value="{{ old('twitter',  @$data->twitter) }}" maxlength="50">
                    @error('twitter')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="d-flex">
                <div class="form-group col-md-6">
                    <label for="instagram">Instagram Link </label>
                    <input type="text" id="instagram" class="form-control" name="instagram" placeholder="Instagram Link"
                        value="{{ old('instagram', @$data->instra) }}" maxlength="50">

                    @error('instagram')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group col-md-6">
                    <label for="dribbble">Dribbble Link</label>
                    <input type="text" id="dribbble" class="form-control" name="dribbble" placeholder="Dribbble Link"
                        value="{{ old('dribbble', @$data->dribbble) }}" maxlength="50">

                    @error('dribbble')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="d-flex">
                <div class="form-group col-md-6">
                    <label for="form">Upload profile <span class="text-danger">*</span></label>
                    <input type="file" id="profile" class="form-control" name="profile" accept="application/jpge/jig/png">

                    @error('profile')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group col-md-6">
                        <label for="membership_type">Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-control">
                            <option hidden value="">Status</option>
                            @foreach (config('site.status') as $status)
                                <option value="{{ $status['value'] }}"
                                    {{ $data->status == $status['value'] ? 'selected' : '' }}>
                                    {{ $status['name'] }}
                                </option>
                            @endforeach
                        </select>
                        @error('status')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
            </div>

            
    </div>

    <div class="form-group col-md-12 text-right">
        <button class="btn btn-sm btn-custom" type="submit">Update Staff</button>
    </div>
    </form>
</div>
</div>

@endsection