<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Member Registration</title>
</head>

<style>
    p{
        margin: 0;
        padding: 0;
        /* padding-bottom: 5px; */
    }
    table{
        width: 100%;
    }

    table.custom {
        border: 1px solid gray;
        width: 100%;
        border-collapse: collapse;
    }
    table.custom th, table.custom td {
        border: 1px solid #000;
        padding: 8px;
        text-align: center;
    }
    table.custom th {
        background-color: #f2f2f2;
        font-weight: bold;
    }
    .th-center th, .th-center td {
        text-align: center;
    }
    
    a{
        text-decoration: none;
    }
    table.custom td{
        word-break: break-word;
    }
    .m-0{
        margin: 0;
    }
    .p-0{
        padding: 0;
    }
</style>

<body>
    <div class="invoice-box" id="printContent"
        style="max-width: 100%; margin: auto; padding: 10px; border: 1px solid #eee; box-shadow: 0 0 10px rgba(0, 0, 0, .15); font-size: 14px; line-height: 24px; font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; color: #555;">
        <table cellpadding="0" cellspacing="0" style="width: 100%; line-height: inherit; text-align: left;">
            <tr class="top_rw">
                <td style="padding: 7px;text-align: center">
                    <h3 style="margin-bottom: 0px; margin-top: 0; color: #273477;">
                        Member Application
                    </h3>
                </td>
            </tr>

            <tr class="information">
                <td style="width: 100%; color:#222222f7" colspan="2">
                    <table style="width: 100%">
                        <tr style="max-width: 100%">
                            <td style="width: 50%; padding: 0px 7px;">
                                <b>Application Type</b>
                                <p>{{ $data->busibessType->name ?? '' }}</p>

                                <b>Business Name</b>
                                <p>{{ $data->name_of_business ?? '' }}</p>

                                <b>Legal Status</b>
                                <p>{{ $data->legalStatus->name ?? '' }}</p>

                                <b>Registered Office Address</b>
                                <p>{{ $data->registered_office_address ?? '' }}</p>
                            </td>
                            <td style="width: 50%; padding: 0px 7px;">
                                <b>Date Of Registration</b>
                                <p>{{ date('d-m-Y', strtotime($data->date_of_egistration ?? '')) }}</p>

                                <b>Type of Business or State</b>
                                <p>{{ $data->sectors->name ?? '' }}</p>

                                <b>No. Of Employee</b>
                                <p>{{ $data->No_of_employees ?? '' }}</p>

                                <b>Business/Operation Address</b>
                                <p>{{ $data->type_of_business ?? '' }}</p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="top_rw">
                <td style="padding: 15px 7px 7px 7px;">
                    <h3 style="margin-bottom: 0px; margin-top: 0; color: #273477;">
                        Name the Sector(s) you Represent
                    </h3>
                </td>
            </tr>

            <tr class="information">
                <td style="width: 100%; color:#222222f7">
                    <table style="width: 100%">
                        <tr style="max-width: 100%">
                            <td style="width: 50%; padding: 0px 7px;">
                                <b>Telephone No.</b>
                                <p>{{ $data->telephone_no ?? '' }}</p>

                                <b>Fax No.</b>
                                <p>{{ $data->fax_no ?? '' }}</p>
                            </td>
                            <td style="width: 50%; padding: 0px 7px;">
                                <b>Email ID</b>
                                <p>{{ $data->email ?? '' }}</p>

                                <b>Website</b>
                                <p>{{ $data->website ?? '' }}</p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            @if ($data->your_expectation)
                @php
                    $your_expectation = explode(',', $data->your_expectation);
                    $contribute = explode(',', $data->contribute_towards);
                    $max_count = max(count($your_expectation), count($contribute));
                @endphp

                <tr class="information">
                    <td style="padding: 7px;">
                        <table class="table table-bordered th-center m-0 p-0 custom">
                            <thead>
                                <tr>
                                    <th>Expectation from Being a Member</th>
                                    <th>Name of Business/Profession</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
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
                    </td>
                </tr>
            @endif

            <tr>
                <td style="padding: 7px;">
                    <b>Corporate Membership</b>
                    <p> {!! $data->corporate->name ?? '' !!}</p>
                </td>
            </tr>
            <tr>
                <td style="padding: 7px;">
                    <b>Wish to Become a Member of the PSC</b>
                    <p>{{ $data->state_briefly ?? '' }}</p>
                </td>
            </tr>
            <tr>
                <td style="padding: 7px;">
                    <b>How do you know about the PSC</b>
                    <p>{{ $data->you_know_about ?? '' }}</p>
                </td>
            </tr>

            <tr class="top_rw">
                <td style="padding: 15px 7px 7px 7px;">
                    <h3 style="margin-bottom: 0px; margin-top: 0; color: #273477;">
                        Names of two References
                    </h3>
                </td>
            </tr>

            @if ($data->your_expectation)
                @php
                    $references_name = explode(',', $data->references_name);
                    $references_addre = explode(',', $data->references_address);
                    $references_name_of_business = explode(',', $data->references_name_of_business);
                    $references_tel_no = explode(',', $data->references_tel_nos);
                    $references_email = explode(',', $data->references_email);
                    $references_website = explode(',', $data->references_website);
                @endphp

                <tr class="information">
                    <td style="padding: 7px;">
                        <table class="table table-bordered th-center m-0 p-0 custom">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Name of Business/Profession</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($references_name as $key => $references_namess)
                                    <tr>
                                        <td>{{ $references_namess ?? '' }}</td>
                                        <td>{{ $references_addre[$key] ?? '' }}</td>
                                        <td>{{ $references_name_of_business[$key] ?? '' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <table class="table table-bordered th-center m-0 p-0 custom">
                            <thead>
                                <tr>
                                    <th>Telephone</th>
                                    <th>Email</th>
                                    <th>Website</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($references_tel_no as $key => $references_telno)
                                    <tr>
                                        <td>{{ $references_telno ?? '' }}</td>
                                        <td>{{ $references_email[$key] ?? '' }}</td>
                                        <td>{{ $references_website[$key] ?? '' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </td>
                </tr>
            @endif

            <tr class="top_rw">
                <td style="padding: 15px 7px 7px 7px;">
                    <h3 style="margin-bottom: 0px; margin-top: 0; color: #273477;">
                        Names of two Principal Officers
                    </h3>
                </td>
            </tr>

            <tr class="information">
                <td style="width: 100%; color:#222222f7" colspan="3">
                    <table style="width: 100%">
                        <tr style="max-width: 100%">
                            <td style="width: 50%; padding: 0px 7px;">
                                <b>Name</b>
                                <p>{{ $data->principal_name ?? '' }}</p>

                                <b>Designation</b>
                                <p>{{ $data->principal_designation ?? '' }}</p>
                            </td>
                            <td style="width: 50%; padding: 0px 7px;">
                                <b>Signature</b>
                                <p>{{ $data->principal_signature ?? '' }}</p>

                                <b>Date</b>
                                <p>{{ date('d-m-Y', strtotime($data->principal_date ?? '')) }}</p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr>
                <td style="padding: 7px;">
                    <b>Uploaded Files</b>
                    @if($docVal->isNotEmpty())
                        @foreach ($docVal as $key => $docsArr)
                            @if ($docsArr->file_name)
                                <div>
                                    <a href="{{ asset('storage/' . $docsArr->file_name) }}" target="_blank">
                                        {{ basename($docsArr->file_name) }}
                                    </a>
                                </div>
                            @endif
                        @endforeach
                    @else
                        <p>No File(s) uploaded !</p>
                    @endif
                </td>
            </tr>

        </table>
    </div>
</body>


@if($isPrint)
<script>
    window.print();
</script>
@endif

</html>
