@extends('layout.admin_master')

@section('title', 'Dashboard')
@section('header', 'Dashboard')

@section('content')

    <div class="page-breadcrumb d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-0">Dashboard</div>
    </div>

    <div class="row">
        <div class="col-12 col-lg-4 col-xl-4">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div>
                            <p class="mb-2">Total Members</p>
                            <h4 class="mb-0">
                                {{ count($totalMembers) }}
                                <span class="ms-1 font-13 text-success"></span>
                            </h4>
                        </div>
                    </div>
                    {{-- <div class="mt-3" id="chart1"></div> --}}
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4 col-xl-4">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div>
                            <p class="mb-2">Active Members</p>
                            <h4 class="mb-0">
                                {{ count($totalActiveMembers) }}
                                <span class="ms-1 font-13 text-success"></span>
                            </h4>
                        </div>
                    </div>
                    {{-- <div class="mt-3" id="chart2"></div> --}}
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4 col-xl-4">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div>
                            <p class="mb-2">In-active Members</p>
                            <h4 class="mb-0">
                                {{ count($totalInActiveMembers) }}
                                <span class="ms-1 font-13 text-success"></span>
                            </h4>
                        </div>
                    </div>
                    {{-- <div class="mt-3" id="chart3"></div> --}}
                </div>
            </div>
        </div>
    </div>

@endsection
