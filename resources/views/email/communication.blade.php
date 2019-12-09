
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Adnlist</title>
</head>

<body style="background:#f1f1f1;padding-top:20px;padding-bottom:20px;">
    <center>
        <table class="" border="0" cellspacing="0" cellpadding="0" width="600"
            style="width:6.25in;background:#ffffff;border-collapse:collapse">
            <tbody>
                <tr>
                    <td height="10"></td>
                </tr>
                
                <tr>
                    <td style="padding-left:20px;" align="center">
                        <p style="margin:5px 0px 5px 0px;font-weight:600;font-size:36px;"><span style="color:#004000;">Ad</span><span style="color:#99d9ea;">n</span><span style="color:#5fa659">List</span></p>
                    </td>
                </tr>
                <tr>
                    <td height="10"></td>
                </tr>
                <tr>
                    <td height="35" style="padding-left:20px;">
                        <p style="margin:5px 0px 5px 0px;font-size:20px;color:#222;font-family: Montserrat;">Dear {{ $data['name'] }}!</p>
                    </td>
                </tr>
                <tr>
                    <td height="35" style="padding-left:20px;">
                    <p style="margin:5px 0px 5px 0px;font-size:18px;color:#222;font-family: Montserrat;">You received message from: @if(Auth::check())<span style="font-weight:bold;">{{ Auth::user()->name }}</span><span style="color:#0000ee;">({{ Auth::user()->email }})</span>
                        @else <span style="font-weight:bold;">{{ $data["name"] }}</span><span style="color:#0000ee;">({{ $data["from"] }})</span> @endif</p>
                    </td>
                </tr>
               
                <tr>
                    <td height="20"></td>
                </tr>
                <tr>
                    <td height="35" style="padding-left:20px;">
                        <p style="margin:5px 0px 5px 0px;font-size:18px;color:#222;font-family: Montserrat;">Message:</p>
                    </td>
                </tr>
                <tr>
                    <td height="" style="padding-left:20px;padding-right:20px;">
                        <table>
                            <tr>
                                <td width="50"></td>
                                <td border="1">
                                    <p style="margin:5px 0px 5px 0px;font-size:18px;color:#222;font-family: Montserrat;">{{ $data['content'] }}</p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td height="10"></td>
                </tr>
                @if(!empty($data["fileName"]))
                <tr>
                    <td height="35" style="padding-left:20px;">
                        <p style="margin:5px 0px 5px 0px;font-size:18px;color:#222;font-family: Montserrat;">Attachment:</p>
                    </td>
                </tr>
                <tr>
                    <td style="padding-left:50px;">
                        <a href="{{ asset('/upload/attachment/'.$data['fileName']) }}" style="font-size:18px;color:#0000ee;font-family: Montserrat;" download>{{ $data['fileName'] }}</a>
                    </td>
                </tr>
                @endif


                <tr>
                    <td height="10"></td>
                </tr>
                <tr>
                    <td style="padding-left:20px;">
                        <p style="margin:5px 0px 5px 0px;font-size:18px;color:#fe2323;font-family: Montserrat;">*Please do not reply to this email directly.Replies to this email can not be monitored.</p>
                    </td>
                </tr>
                <tr>
                    <td height="10"></td>
                </tr>
            </tbody>
        </table>


    </center>
</body>

</html>