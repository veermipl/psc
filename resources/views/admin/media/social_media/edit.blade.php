@extends('layout.admin_master')

@section('title', 'Social Media - Update')
@section('header', 'Update Social Media')

@section('content')

    <div class="p-3 bg-white">

        <h5 class="fw-bold">Update Social Media</h5>

        <div class="pt-5">
            <form action="{{ route('admin.media-center.social-media.update', $social_media->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('patch')

                <div class="form-group col-md-12 text-right">
                    <button class="btn btn-sm btn-custom" type="submit">Update Social Media</button>
                </div>
            </form>
        </div>
    </div>

@endsection



@section('scripts')

<script type="text/javascript">
    $(document).ready(function() {

        $(document).on('click', '.deleteImgBtn', function(e) {
            e.preventDefault();

        });

    });
</script>

@endsection
