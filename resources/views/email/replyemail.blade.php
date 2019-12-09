
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
                    <td style="padding-left:20px;">
                        <p style="margin:5px 0px 5px 0px;font-size:20px;color:#222;font-family: Montserrat;font-weight:700;">Dear {{ $data['name'] }}!</p>
                    </td>
                </tr>
                <tr>
                    <td height="10"></td>
                </tr>
               
                <tr>
                    <td style="padding-left: 50px;">
                        <table>
                            <tr>
                                <td height="10"></td>
                            </tr>
                            <tr>
                                <td>
                                    @if(!empty($data['status']) && ($data['status'] == 'send_accept'))
                                        <p style="margin:5px 0px 5px 0px;font-size:16px;color:#222222;font-family: Montserrat;font-weight:500;">
                                            You received a message from : <span style="color:#ff7a47;font-weight:600;">{{ $data["nameS"] }}</span> 
                                        </p>
                                    @else
                                        <p style="margin:5px 0px 5px 0px;font-size:16px;color:#222222;font-family: Montserrat;font-weight:500;">
                                            You received a message from : {{ $data['from'] }}
                                        </p>
                                    @endif                                 
                                </td>
                            </tr>
                            <tr>
                                <td height="10"></td>
                            </tr>
                            @if(!empty($data['status']) && ($data['status'] == 're_contact'))
                                <tr>
                                    <td>                                       
                                        <p  style="margin:5px 0px 5px 0px;color:#222222;font-size:16px;">
                                            <span style="color:#ff7a47;">{{ $data['nameS'] }}</span> {{ $data['content'] }}
                                        </p>
                                    </td>
                                </tr>
                            @elseif(!empty($data['status']) && ($data['status'] == 'send_accept'))
                                <tr>
                                    <td>                                       
                                        <p style="margin:5px 0px 5px 0px;color:#222222;font-size:16px;">
                                            {{ $data['content'] }}
                                        </p>                                        
                                        <a href="{{ url('category_view/details',[$data['post_id'],'all']) }}" style="color:#ff7a47;">{{ url('category_view/details',[$data['post_id'],'all']) }}</a>
                                    </td>
                                </tr>
                            @else
                                <tr>
                                    <td>
                                        <p style="margin:5px 0px 5px 0px;color:#222222;font-weight:500;font-size:18px;">
                                            Subject: <span style="color:white;">{{ $data['title'] }}</span>
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td height="10"></td>
                                </tr>
                                <tr>
                                    <td>
                                        <p  style="margin:5px 0px 5px 0px;color:#ff7a47;font-weight:500;font-size:18px;">
                                            Message: 
                                        </p>
                                        <p  style="margin:5px 0px 5px 0px;color:white;font-size:16px;">
                                            {{ $data['content'] }}
                                        </p>
                                    </td>
                                </tr>
                            @endif
                            <tr>
                                <td height="10"></td>
                            </tr>
                        </table>
                    </td>
                </tr>
               
                <tr>
                    <td style="padding-left:20px;">
                        <p style="margin:5px 0px 5px 0px;font-size:18px;color:#222;font-family: Montserrat;font-weight:600;">
                            Sincerely
                        </p>
                    </td>
                </tr>

                <tr>
                    <td height="10"></td>
                </tr>
                <tr>
                    <td style="padding-left:20px;">
                        <p style="margin:5px 0px 5px 0px;font-size:18px;color:#222;font-family: Montserrat;font-weight:600;">
                            Adnlist team
                        </p>
                        <p style="margin:5px 0px 5px 0px;font-size:18px;color: #0738ca;font-family: Montserrat;font-weight:600;">
                            Sacramento,CA,USA
                        </p>
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