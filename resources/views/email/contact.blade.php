
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Adnlist</title>
</head>

<body style="background:#f1f1f1;padding-top:20px;padding-bottom:20px;">
    <center>
        <table class="" border="0" cellspacing="0" cellpadding="0" width="600"
            style="width:6.25in;background:#ffffff; border-collapse:collapse">
            <tbody>
                <tr>
                    <td style="padding-left:20px;padding-right:20px;">
                        <table>
                            
                            <tr>
                                <td style="padding-left:20px;" align="center">
                                    <p style="font-weight:600;font-size:36px;margin-bottom:0px;"><span style="color:#004000;">Ad</span><span style="color:#99d9ea;">n</span><span style="color:#5fa659">List</span></p>
                                </td>
                            </tr>
                            @if(!empty($data['name']))
                            <tr>
                                <td>
                                    <p style="margin:5px 0px 5px 0px;font-size:16px;color:#222222;font-family: Montserrat;font-weight:600;">
                                        Message from : <b>{{ $data['name'] }}</b> 
                                        (<a href="mailto:{{ $data['email'] }}" style="color:#0000ee;font-size:18px">{{ $data['email'] }}</a>)
                                    </p>                                   
                                </td>
                            </tr>
                            @endif
                            <tr>
                                <td height="10"></td>
                            </tr>
                            <tr>
                                <td>
                                    <p style="margin:5px 0px 5px 0px;">
                                        <span style="color:#222222;"><b>Subject:</b></span> 
                                    </p>
                                    <span>{{ $data['title'] }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td height="10"></td>
                            </tr>
                            @if(!empty($data['post_id']))
                                <tr>
                                    <td>
                                        <p style="margin:5px 0px 5px 0px;">
                                            <span style="color:#222222;"><b>Post_ID:</b></span> {{ $data['post_id'] }}
                                        </p>
                                    </td>
                                </tr>
                            @endif
                            <tr>
                                <td height="10"></td>
                            </tr>
                            <tr>
                                <td>
                                    <p style="margin:5px 0px 5px 0px;">
                                        <span style="color:#222222;"><b>Message:</b></span> 
                                    </p>                        
                                </td>
                            </tr>
                            <tr>
                                <td height="10"></td>
                            </tr>
                            <tr>
                                <td style="">                        
                                    <p style="margin:5px 0px 5px 0px;">{{ $data['content'] }}</p>
                                </td>
                            </tr> 
                        </table>
                    </td>
                </tr>                
            </tbody>
        </table>


    </center>
</body>

</html>