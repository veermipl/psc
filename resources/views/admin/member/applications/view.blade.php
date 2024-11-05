@extends('layout.admin_master')

@section('title', 'Member - Update')
@section('header', 'Update Member')

@section('content')
<style> 

table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}
.padding-membr{
    padding:0 15px;
}
.th-center thead tr th{
  text-align: center;
}
.th-center tbody tr td{
  text-align: center;
}
</style>

<div class="page-breadcrumb d-sm-flex align-items-center mb-3">
  <div class="breadcrumb-title pe-3">View Member </div>
</div>

@if($data == '')
 <h3 style="text-align: center;"> No data found! </h3>
@else


<div class="row">
  <div class="col-lg-12">
    <div class="card radius-10">
      <div class="card-body">
      <div class="page-breadcrumb d-sm-flex align-items-center mt-4 mb-3">
      <div class="breadcrumb-title-2 pe-3"><b> Application for Membership </b> </div>
      </div>
        <div class="p-4 border rounded">
          <div class="row ">
    
            <div class="col-lg-4"> <b>Application Type: </b> {{$data->busibessType->name ?? ''}} </div>
            <div class="col-lg-4"> <b>Business Name: </b> {{$data->name_of_business ?? ''}} </div>
            <div class="col-lg-4"> <b>Legal status: </b>   {{$data->legalStatus->name ?? ''}}</div>
          </div>
        </div>
        <div class="p-4 border rounded">
          <div class="row ">
            
            <div class="col-lg-4"> <b>Date of Registration : </b> {{ date('d-m-Y', strtotime($data->date_of_egistration ?? ''))}} </div>
            <div class="col-lg-4"> <b>Type of Business or State: </b> {{$data->sectors->name ?? ''}} </div>
            <div class="col-lg-4">  <b>No. of empoly: </b> {{$data->No_of_employees ?? ''}}</div>
          </div>
        </div>
        <div class="p-4 border rounded">
          <div class="row ">
           
            <div class="col-lg-4">  <b>Registered Office Address: </b> {{$data->registered_office_address ?? ''}} </div>
            <div class="col-lg-4"> <b> Business/ Operation Address: </b> {{$data->type_of_business ?? ''}} </div>
          </div>
        </div>

        <div class="page-breadcrumb d-sm-flex align-items-center mt-4 mb-3">
            <div class="breadcrumb-title-2 pe-3"><b> Name the Sector(s) you Represent </b></div>
        </div>
        

        <div class="p-4 border rounded">
          <div class="row ">
            <div class="col-lg-4">   <b> Telephone No.: </b> {{$data->telephone_no ?? ''}}</div>
            <div class="col-lg-4">   <b> Fax No.: </b> {{$data->fax_no ?? ''}} </div>
            <div class="col-lg-4">  <b> Email Id: </b> {{$data->email ?? ''}} </div>
          </div>
        </div>

        @if ($data->your_expectation)
    @php
        $your_expectation = explode(',', $data->your_expectation);
        $contribute = explode(',', $data->contribute_towards);
        $max_count = max(count($your_expectation), count($contribute)); // Find the maximum count for looping
    @endphp

    <div class="padding-membr">
        <div class="row">
            <table class="table table-bordered th-center">
                <thead>
                    <tr>
                        <th >Website</th>
                        <th>Expectation from Being a Member</th>
                        <th>Name of Business/Profession</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td rowspan="{{ $max_count }}">{{ $data->website ?? '' }}</td>
                        <td>{{ $your_expectation[0] ?? '' }}</td>
                        <td>{{ $contribute[0] ?? '' }}</td>
                    </tr>
                    @for ($i = 1; $i < $max_count; $i++)
                        <tr>
                            <td>{{ $your_expectation[$i] ?? '' }}</td>
                            <td>{{ $contribute[$i] ?? '' }}</td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div>
@endif




<!-- 
        <div class="p-4 border rounded">
          <div class="row ">
            <div class="col-lg-4">    <b> Website : </b> {{$data->website ?? ''}}</div>

            @if ($data->your_expectation)
                @php
                    $your_expectation = explode(',', $data->your_expectation);
                @endphp

                <div class="col-lg-4"> 

                <table style="width:100%">
                    <tr>
                      <td><b>Expectation from Being a Member:</b></td>
                    </tr>
                    @foreach($your_expectation as $key=>$business )
                    <tr>
                      <td>{{$business ?? ''}} </td>
                    </tr>
                    @endforeach
                  </table>
                </div>
              @endif

              <div class="col-lg-4">   
            @if ($data->your_expectation)
               @php
                    $contribute = explode(',', $data->contribute_towards);
                @endphp

                <table style="width:100%">
                    <tr>
                      <td><b>Contribute  from Being a Member:</b></td>
                    </tr>
                      @foreach($contribute as $key=> $contribute_data)
                  <tr>
                      <td>{{$contribute_data ?? ''}} </td>
                  </tr>

                @endforeach
                </table>
                @endif

          </div>


          </div>
        </div> -->

        <div class="p-4 border rounded">
          <div class="row ">

          <div class="col-lg-4">   <b> Corporate Membership : </b> {!! $data->corporate->name ?? '' !!} </div>
            <div class="col-lg-4">  <b>Wish to Become a Member of the PSC : </b> {{$data->state_briefly ?? ''}} </div>
            <div class="col-lg-4">   <b>How do you know about the PSC: </b> {{$data->you_know_about ?? ''}} </div>
          </div>
        </div>

        

        <div class="page-breadcrumb d-sm-flex align-items-center mt-4 mb-3">
        <div class="breadcrumb-title-2 pe-3"><b> Names of two References </b></div>
        </div>
    
          @if ($data->your_expectation)
               @php
                    $references_name = explode(',', $data->references_name);
                    $references_addre = explode(',', $data->references_address);
                    $references_name_of_business = explode(',', $data->references_name_of_business);
                    $references_tel_no = explode(',', $data->references_tel_nos);
                    $references_email = explode(',', $data->references_email);
                    $references_website = explode(',', $data->references_website);
                @endphp


                <div class="padding-membr">
                  <div class="row">
                      <table class="table table-bordered th-center">
                        <thead>
                          <tr>
                            <th>Name </th>
                            <th>Address </th>
                            <th>Name of Business/Profession</th>
                            <th>Telephone  </th>
                            <th>Email </th>
                            <th>Website</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($references_name as $key => $references_namess)
                          <tr>
                            <td>{{ $references_namess ?? '' }}</td>
                            <td>{{ $references_addre[$key] ?? '' }}</td>
                            <td>{{ $references_name_of_business[$key] ?? '' }}</td>
                            <td>{{ $references_tel_no[$key] ?? '' }}</td>
                            <td>{{ $references_email[$key] ?? '' }}</td>
                            <td>{{ $references_website[$key] ?? '' }}</td>
                          </tr>
                          @endforeach
                          
                        </tbody>
                      </table>
                  </div>
             </div>
<!-- 
             <div class="padding-membr">
                  <div class="row">
                      <table class="table table-bordered th-center">
                        <thead>
                          <tr>
                            <th>Telephone  </th>
                            <th>Email </th>
                            <th>Website</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($references_tel_no as $key => $references_telno)
                          <tr>
                            <td>{{ $references_telno ?? '' }}</td>
                            <td>{{ $references_email[$key] ?? '' }}</td>
                            <td>{{ $references_website[$key] ?? '' }}</td>
                          </tr>
                          @endforeach
                          
                        </tbody>
                      </table>
                  </div>
             </div> -->

        @endif
        <div class="page-breadcrumb d-sm-flex align-items-center mt-4 mb-3">
           <div class="breadcrumb-title-2 pe-3"><b> Names of two Principal Officers </b></div>
        </div>

        <div class="p-4 border rounded">
          <div class="row ">
            <div class="col-lg-4">      <b>Name: </b> {{$data->principal_name ?? ''}}</div>
            <div class="col-lg-4">     <b>Designation: </b> {{$data->principal_designation ?? ''}} </div>
            <div class="col-lg-4">  <b>Signature: </b> {{$data->principal_signature ?? ''}} </div>
          </div>
        </div>
        <div class="p-4 border rounded">
          <div class="row ">
            <div class="col-lg-4">      <b>Date: </b>   {{ date('d-m-Y', strtotime($data->principal_date ?? ''))}} </div>

            <div class="col-lg-4"> 
              <b>Uploaded Files: </b> 
                @foreach($docVal as $key => $docsArr) 
                  <span class="text-center pdf-files">
                  <a href="{{ $docsArr->file_name ? asset('storage/' . $docsArr->file_name) : '' }}" target="_blank" title="Filled Form"> <i class="fa fa-file text-dark"></i>
                                </a>
                  </span>
                  @endforeach  
            </div>
           
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endif

</div>

@endsection