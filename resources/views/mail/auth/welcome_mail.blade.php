<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
</head>

<body>
    <!doctype html>
    <html lang="en-US">

    <head>
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
        <title>Registration Template</title>
        <meta name="description" content="Appointment Reminder Email Template">
    </head>
    <style>
        a:hover {
            text-decoration: underline !important;
        }
    </style>



    <body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #f2f3f8;" leftmargin="0">
        <table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#f2f3f8"
            style="@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700); font-family: 'Open Sans', sans-serif;">
            <tr>
                <td>
                    <table style="background-color: #f2f3f8; max-width:600px; margin:0 auto;" width="100%" border="0"
                        align="center" cellpadding="0" cellspacing="0">
                        <tr>
                            <td style="height:80px;">&nbsp;</td>
                        </tr>
                        <!-- Logo -->

                        <tr>
                            <td style="height:20px;">&nbsp;</td>
                        </tr>
                        <!-- Email Content -->
                        <tr>
                            <td>
                                <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"
                                    style="max-width:670px; background:#fff; border-radius:3px; height:100%;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06);padding:0 40px;">
                                    <tr>
                                        <td style="height:40px;">&nbsp;</td>
                                    </tr>
                                    <!-- Title -->
                                    <tr>
                                        <td rowspan="1" colspan="2" class="m_8166789041881124062bg_white"
                                            style="text-align:center">
                                            <img src="https://psc-dev.digitalnoticeboard.biz/images/Gover-website/logo-other.png" style="width:250px"
                                                class="CToWUd" data-bit="iit">
                                               
                                        </td>
                                    </tr>
                                 
                                    <tr>
                                        <td rowspan="1" colspan="2">
                                            <p style="margin-top: 10px; text-align: start; font-size: 16px;"> Dear {{ $user->name }},</p>
                                            <p style="margin-top: 0px; text-align: start; font-size: 13px;">
                                            Congratulations! Your registration with the Public Service Commission (PSC) has been successfully completed.
                                               <!-- <a href="#"> here</a> -->
                                            </p>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <p style="font-weight:bold;font-size:13px">Your account details are as follows: </p>
                                           
                                        </td>
                                    </tr>
                                    <tr>
                                        <td rowspan="1" colspan="2">
                                            <div >
                                                <table width="100%" cellspacing="0" cellpadding="0" style="margin:0px;padding:0px">
                                                    
                                                    <tbody style="margin:0px;padding:0px">
                                                    <tr>
                                                        <td><span>
                                                        </span></td></tr><tr style="margin:0px;padding:0px">
                                                            <td style="vertical-align:top;margin:0px;padding:10px;font-weight:normal;font-size:13px">Your Role :- {{$role->name}} </td>
                                                            <td style="margin:0px;text-align:right;padding:10px 200px 10px 10px;font-weight:normal;font-size:13px">Test</td>
                                                        </tr>
                                                        
                                                        
                                                    <tr><td><span>
                                                        </span></td></tr>
                                                        <tr style="margin:0px;padding:0px">
                                                            <td style="vertical-align:top;margin:0px;padding:10px;font-weight:normal;font-size:13px">User Name:-</td>
                                                            <td style="margin:0px;text-align:right;padding:10px 200px 10px 10px;font-weight:normal;font-size:13px">{{$user->name}} </td>

                                                        </tr>

                                                        <tr><td><span>
                                                        </span></td></tr>
                                                        <tr style="margin:0px;padding:0px">
                                                            <td style="vertical-align:top;margin:0px;padding:10px;font-weight:normal;font-size:13px">Password:-</td>
                                                            <td style="margin:0px;text-align:right;padding:10px 200px 10px 10px;font-weight:normal;font-size:13px">{{$password}} </td>
                                                            
                                                        </tr>

                                                        <tr><td><span>
                                                        </span></td></tr>
                                                        <tr style="margin:0px;padding:0px">
                                                            <td style="vertical-align:top;margin:0px;padding:10px;font-weight:normal;font-size:13px">Login link:-</td>
                                                            <td style="margin:0px;text-align:right;padding:10px 200px 10px 10px;font-weight:normal;font-size:13px"><a href="{{route('login')}}"> Click here </a>  </td>

                                                        </tr>


                                                    <tr><td><span>
                                                        
                                                    </span>
                                                    
                                                    </td></tr></tbody>
                                                </table>
                                            </div>
                                        </td>
                                    </tr >
                                    <tr>
                                        <td rowspan="1" colspan="2">
                                            <p style="color:rgb(88,88,88);font-size:13px;"> We are pleased to inform you that your registration with the PSC has been successfully updated. Your membership details, including your business information and status, are now current in our records. Please review the information in your account to ensure accuracy.</p>

                                            <p style="color:rgb(88,88,88);font-size:13px;">If you have any questions or need further assistance, do not hesitate to reach out to us at [support email] or visit our website at [website link].</p>

                                            <p style="color:rgb(88,88,88);font-size:13px;">Thank you for being an esteemed member of our organization, and we look forward to your continued participation and support.</p>


                                        </td>
                                        <!-- <td>  </td> -->

                                    </tr>
                                    <tr>
                                        <td
                                            style="padding:0;Margin:0;border-bottom:1px dashed #cccccc;background:none;height:1px;width:100%;margin:0px">
                                        </td>
                                        <td
                                            style="padding:0;Margin:0;border-bottom:1px dashed #cccccc;background:none;height:1px;width:100%;margin:0px">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p style="margin-bottom: 25px;"></p>
                                        </td>
                                    </tr>
                        </tr>



                    </table>
                </td>
            </tr>""

            <tr>
                <td bgcolor="#ff7400" style="padding:30px 30px">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse">
                        <tbody>
                            <tr>
                                <td style="color:#ffffff;font-family:Arial,sans-serif;font-size:14px">
                                    <p style="margin:0">©2024 PSC - All Rights
                                        Reserved.<br>
                                    </p>
                                </td>
                                <td align="right">
                                    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <a href="" target="_blank">
                                                        <img src="https://ci4.googleusercontent.com/proxy/yTZoXdTqxTGlk1_gGOShlfqA5nZQqc6fiGri4umVAwEOz2eaZmTleRTIO9IbHGMjqlG7PJUxoxt62-GPs0Lz=s0-d-e1-ft#http://mishainfotech.com/images/tw-icon1.png" border="0" class="CToWUd" data-bit="iit">
                                                    </a>
                                                </td>
                                                <td style="font-size:0;line-height:0" width="5">&nbsp;</td>
                                                <td>
                                                    <a href="" target="_blank">
                                                        <img src="https://ci6.googleusercontent.com/proxy/dbgYOIU8BoBp1WZID7ochlWv74gpw1i4-_yDMvLwOw5ikSQgnejN8CBNChHn6hI6GJFzcswlmPwM3O-9LjIk=s0-d-e1-ft#http://mishainfotech.com/images/fb-icon1.png" alt="Facebook." style="display:block;width:24px;height:24px" border="0" class="CToWUd" data-bit="iit">
                                                    </a>
                                                </td>
                                                <td style="font-size:0;line-height:0" width="5">&nbsp;</td>
                                                <td>
                                                    <a href="" target="_blank">
                                                        <img src="https://ci5.googleusercontent.com/proxy/MXS5z-v0yaYhjPOn8nPAU2RCecPRa1xzEozQ3m03_GYkcPJFki3WT16WtC_Tgn90IL6cg7D7UsmNzNPY5A=s0-d-e1-ft#http://mishainfotech.com/images/lindin.png" alt="linkedin" style="display:block;width:24px;height:24px" border="0" class="CToWUd" data-bit="iit">
                                                    </a>
                                                </td>
                                                <td style="font-size:0;line-height:0" width="5">&nbsp;</td>
                                                <td>
                                                    <a href="" target="_blank">
                                                        <img src="https://ci6.googleusercontent.com/proxy/zKg6IKYJVL-lZ2fVvZdTMZnZe7S0Qbcw4uRuGb2N4C67akggkUbTDqXgoh7IINHNEcAD1wvJKLk_hq1-=s0-d-e1-ft#http://mishainfotech.com/images/pinst.png" alt="linkedin" style="display:block;width:24px;height:24px" border="0" class="CToWUd" data-bit="iit">
                                                    </a>
                                                </td>

                                                <td style="font-size:0;line-height:0" width="5">&nbsp;</td>

                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>

        </table>
        </td>
        </tr>
        </table>
    </body>

    </html>
    <!-- partial -->