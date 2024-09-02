@extends('layout.admin_master')

@section('title', 'Queries - View Contact Us')
@section('header', 'Queries - View Contact Us')

@section('content')

    <div class="page-breadcrumb d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">View Contact Us</div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="p-4 border rounded">
                        <div class="row g-3 needs-validation">
                            <div class="col-md-4 position-relative">
                                <label for="">Name</label>
                                <h6>{{ $query_data->name }}</h6>
                            </div>

                            <div class="col-md-4 position-relative">
                                <label for="">Email</label>
                                <h6>{{ $query_data->email }}</h6>
                            </div>

                            <div class="col-md-4 position-relative">
                                <label for="">Phone</label>
                                <h6>{{ $query_data->phone }}</h6>
                            </div>

                            <div class="col-md-12 position-relative">
                                <label for="">Message</label>
                                <h6>{{ $query_data->message }}</h6>
                            </div>

                            <div class="col-md-12 position-relative">
                                <label for="">Date</label>
                                <h6>{{ date('jS \o\f F Y', strtotime($query_data->created_at)) }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
