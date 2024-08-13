@extends('layout.admin_master')

@section('title', 'Role - Create')
@section('header', 'Create Role')

@section('content')

    <div class="p-3 bg-white">

        <h5 class="fw-bold">Create Role</h5>

        <div class="pt-5">
            <form action="{{ route('admin.authorization.role.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('post')

                <div class="form-group col-md-12">
                    <label for="name">Name <span class="text-danger">*</span></label>
                    <input type="text" id="name" class="form-control" name="name" placeholder="Enter name"
                        value="{{ old('name') }}" maxlength="50">

                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group col-md-12">
                    <label for="permission">Permissions <span class="text-danger">*</span></label><br>
                    @error('permissions')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <div id="accordion">
                        @foreach($permissions as $key => $value)
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne"
                                            aria-expanded="true" aria-controls="collapseOne">
                                            Collapsible Group Item #1
                                        </button>
                                    </h5>
                                </div>

                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                    data-parent="#accordion">
                                    <div class="card-body">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad
                                        squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck
                                        quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it
                                        squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica,
                                        craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur
                                        butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth
                                        nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>

                <div class="form-group col-md-12 text-right">
                    <button class="btn btn-sm btn-custom" type="submit">Create Role</button>
                </div>
            </form>
        </div>
    </div>

@endsection
