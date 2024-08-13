@extends('layout.admin_master')

@section('title', 'Role - Update')
@section('header', 'Update Role')

@section('content')

    <div class="p-3 bg-white">

        <h5 class="fw-bold">Update Role</h5>

        <div class="pt-5">
            <form action="{{ route('admin.authorization.rolee.update', $role->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('patch')

                <div class="form-group col-md-12 text-right">
                    <button class="btn btn-sm btn-custom" type="submit">Update Role</button>
                </div>
            </form>
        </div>
    </div>

@endsection



@section('scripts')

    <script type="text/javascript">
        $(document).ready(function() {
        });
    </script>

@endsection