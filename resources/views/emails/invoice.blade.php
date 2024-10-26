<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Cuba admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Cuba admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="{{asset('assets/images/favicon.png')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.png')}}" type="image/x-icon">
    <title>loomyedu.com Invoice</title>
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <style type="text/css">
        body{
            text-align: center;
            margin: 0 auto;
            width: 650px;
            font-family: work-Sans, sans-serif;
            background-color: #f6f7fb;
            display: block;
        }
        ul{
            margin:0;
            padding: 0;
        }
        li{
            display: inline-block;
            text-decoration: unset;
        }
        a{
            text-decoration: none;
        }
        p{
            margin: 15px 0;
        }
        h5{
            color:#444;
            text-align:left;
            font-weight:400;
        }
        .text-center{
            text-align: center
        }
        .main-bg-light{
            background-color: #fafafa;
            box-shadow: 0px 0px 14px -4px rgba(0, 0, 0, 0.2705882353);
        }
        .title{
            color: #444444;
            font-size: 22px;
            font-weight: bold;
            margin-top: 10px;
            margin-bottom: 10px;
            padding-bottom: 0;
            text-transform: uppercase;
            display: inline-block;
            line-height: 1;
        }
        table{
            margin-top:30px
        }
        table.top-0{
            margin-top:0;
        }
        table.order-detail , .order-detail th , .order-detail td {
            border: 1px solid #ddd;
            border-collapse: collapse;
        }
        .order-detail th{
            font-size:16px;
            padding:15px;
            text-align:center;
        }
        .footer-social-icon tr td img{
            margin-left:5px;
            margin-right:5px;
        }
    </style>
</head>
<body style="margin: 20px auto;">
<table align="center" border="0" cellpadding="0" cellspacing="0" style="padding: 0 30px;background-color: #fff; -webkit-box-shadow: 0px 0px 14px -4px rgba(0, 0, 0, 0.2705882353);box-shadow: 0px 0px 14px -4px rgba(0, 0, 0, 0.2705882353);width: 100%;">
    <tbody>
    <tr>
        <td>
            <table align="center" border="0" cellpadding="0" cellspacing="0">
                <tbody>
                <tr>
                    <td><img src="{{asset('build/img/logo.svg')}}" alt="" style=";margin-bottom: 30px;"></td>
                </tr>
                <tr>
                    <td><img src="{{asset('assets/images/email-template/success.png')}}" alt=""></td>
                </tr>
                <tr>
                    <td>
                        <h2 class="title">thank you</h2>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>Payment Is Successfully Processed And Your Courses Enrolled</p>
                        <p>Invoice ID:{{ $data->serial }}</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div style="border-top:1px solid #777;height:1px;margin-top: 30px;"></div>
                    </td>
                </tr>
                </tbody>
            </table>
            <table border="0" cellpadding="0" cellspacing="0">
                <tbody>
                <tr>
                    <td>
                        <h2 class="title">YOUR ORDER DETAILS ( {{ $data->itemCount }} )</h2>
                    </td>
                </tr>
                </tbody>
            </table>
            <table class="order-detail" border="0" cellpadding="0" cellspacing="0" align="left">
                <tbody>
                <tr align="left">
                    <th>Course</th>
                    <th style="padding-left: 15px;">title</th>
                    <th>teacher</th>
                    <th>PRICE </th>
                </tr>

                @foreach($data->payments as $payment)
                    <tr>
                        <td><img src="{{ URL::asset(isset($payment->course->image['file']) ? 'uploads/'.$payment->course->image['file'] : '/build/img/course.png') }}" alt="" width="130"></td>
                        <td valign="top" style="padding-left: 5px;">
                            <h5 style="margin-top: 15px;">{{ $payment->course->titleTranslate->translates[app()->getLocale()] }}</h5>
                            <h5 style="margin-top: 15px;">{{ $payment->course->curriculum->curriculumTranslate->translates[app()->getLocale()] }}</h5>
                            <h5 style="margin-top: 15px;">{{ $payment->course->curriculum->subject->subject->subjectTranslate->translates[app()->getLocale()] }}</h5>
                            <h5 style="margin-top: 15px;">{{ $payment->course->curriculum->subject->year->yearTranslate->translates[app()->getLocale()] }}</h5>
                            <h5 style="margin-top: 15px;">{{ $payment->course->curriculum->subject->year->stage->stageTranslate->translates[app()->getLocale()] }}</h5>
                        </td>
                        <td valign="top" style="padding-left: 15px;">
                            <h5 style="font-size: 14px; color:#444;margin-top:15px;    margin-bottom: 0px;">{{ __($payment->course->teacher->prefix->title()) }}/ {{ $payment->course->teacher->name }}</h5>
                        </td>
                        <td valign="top" style="padding-left: 15px;">
                            <h5 style="font-size: 14px; color:#444;margin-top:15px"><b>{{ $payment->cost }}</b></h5>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="2" style="line-height: 49px;font-size: 13px;color: #000000;padding-left: 20px;text-align:left;border-right: unset;">item count:</td>
                    <td class="price" colspan="3" style="line-height: 49px;text-align: right;padding-right: 28px;font-size: 13px;color: #000000;text-align:right;border-left: unset;"><b>{{ $data->itemCount }} items</b></td>
                </tr>
                <tr>
                    <td colspan="2" style="line-height: 49px;font-size: 13px;color: #000000;padding-left: 20px;text-align:left;border-right: unset;">Cost:</td>
                    <td class="price" colspan="3" style="line-height: 49px;text-align: right;padding-right: 28px;font-size: 13px;color: #000000;text-align:right;border-left: unset;"><b>{{ $data->totalCost }} LE</b></td>
                </tr>
                <tr>
                    <td colspan="2" style="line-height: 49px;font-size: 13px;color: #000000;padding-left: 20px;text-align:left;border-right: unset;">Discount :</td>
                    <td class="price" colspan="3" style="line-height: 49px;text-align: right;padding-right: 28px;font-size: 13px;color: #000000;text-align:right;border-left: unset;"><b>0 LE</b></td>
                </tr>
                <tr>
                    <td colspan="2" style="line-height: 49px;font-size: 13px;color: #000000; padding-left: 20px;text-align:left;border-right: unset;">TOTAL PAID :</td>
                    <td class="price" colspan="3" style="line-height: 49px;text-align: right;padding-right: 28px;font-size: 13px;color: #000000;text-align:right;border-left: unset;"><b>{{ $data->totalCost }} LE</b></td>
                </tr>
                </tbody>
            </table>
            <table cellpadding="0" cellspacing="0" border="0" align="left" style="width: 100%;margin-top: 30px;    margin-bottom: 30px;">
                <tbody>
                <tr>
                    <td style="font-size: 13px; font-weight: 400; color: #444444; letter-spacing: 0.2px;width: 50%;">
                        <h5 style="font-size: 16px; font-weight: 500;color: #000; line-height: 16px; padding-bottom: 13px; border-bottom: 1px solid #e6e8eb; letter-spacing: -0.65px; margin-top:0; margin-bottom: 13px;">Student details</h5>
                        <p style="text-align: left;font-weight: normal; font-size: 14px; color: #000000;line-height: 21px;    margin-top: 0;">{{ $user->name }}<br> {{ $user->email }} <br>{{ $user->phone }}</p>
                    </td>
                    <td class="user-info" width="57" height="25"><img src="{{asset('assets/images/email-template/space.jpg')}}" alt=" " height="25" width="57"></td>
                    <td class="user-info" style="font-size: 13px; font-weight: 400; color: #444444; letter-spacing: 0.2px;width: 50%;">
                        <h5 style="font-size: 16px;font-weight: 500;color: #000; line-height: 16px; padding-bottom: 13px; border-bottom: 1px solid #e6e8eb; letter-spacing: -0.65px; margin-top:0; margin-bottom: 13px;">www.loomyedu.com</h5>
                        <p style="text-align: left;font-weight: normal; font-size: 14px; color: #000000;line-height: 21px;    margin-top: 0;">35 Omer ibn alkhatab Street, <br> Cairo, Egypt, <br> EG 94108</p>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>
<table class="main-bg-light text-center top-0" align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
    <tbody>
    <tr>
        <td style="padding: 30px;">
            <div>
                <h4 class="title" style="margin:0;text-align: center;">Follow us</h4>
            </div>
            <table class="footer-social-icon" border="0" cellpadding="0" cellspacing="0" align="center" style="margin-top:20px;">
                <tbody>
                <tr>
                    <td><a href="https://web.facebook.com/profile.php?id=61565693950861"><img src="{{asset('assets/images/email-template/facebook.png')}}" alt=""></a></td>
                    <td><a href="https://www.youtube.com/@Loomy-Edu"><img src="{{asset('assets/images/email-template/youtube.png')}}" alt=""></a></td>
                    <td><a href="#"><img src="{{asset('assets/images/email-template/twitter.png')}}" alt=""></a></td>
                    <td><a href="#"><img src="{{asset('assets/images/email-template/gplus.png')}}" alt=""></a></td>
                    <td><a href="#"><img src="{{asset('assets/images/email-template/linkedin.png')}}" alt=""></a></td>
                    <td><a href="#"><img src="{{asset('assets/images/email-template/pinterest.png')}}" alt=""></a></td>
                </tr>
                </tbody>
            </table>
            <div style="border-top: 1px solid #ddd; margin: 20px auto 0;"></div>
        </td>
    </tr>
    </tbody>
</table>
</body>
</html>
