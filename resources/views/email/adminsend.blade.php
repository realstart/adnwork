<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Adnlist</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600,700,800,900" rel="stylesheet">

</head>

<body style="background:#f1f1f1;padding-top:20px;padding-bottom:20px;">
    <center>
        <table class="" border="0" cellspacing="0" cellpadding="0" width="600"
            style="width:6.25in;background:#ffffff; border-collapse:collapse">
            <tbody>
                <tr>
                    <td height="10"></td>
                </tr>
                
                <tr>
                    <td style="padding-left:20px;" align="center">
                        <p style="font-weight:600;font-size:36px;"><span style="color:#004000;">Ad</span><span style="color:#99d9ea;">n</span><span style="color:#5fa659">List</span></p>
                    </td>
                </tr>
                <tr>
                    <td height="10"></td>
                </tr>
                @if($feedback['task_status'] == "1")
                <tr>
                    <td>
                        <table>
                            <tr>
                                <td style="padding-left:20px;">
                                    <p style="margin:5px 0px 5px 0px;font-size:20px;color:#222;font-family: Montserrat;font-weight:700;">Dear {{ $feedback['name'] }}!</p>
                                </td>
                            </tr>                                        
                            <tr>
                                <td style="padding-left: 20px;">
                                    <table>                                       
                                        <tr>
                                            <td>
                                                <p style="margin:5px 0px 5px 0px;font-size:16px;color:#222;font-family: Montserrat;font-weight:500;">
                                                    <span style="color:#00a651;font-weight:600;font-size:18px;">Good news!</span>  Your post successfully approved.
                                                </p>
                                                <p style="margin:5px 0px 5px 0px;font-size:16px;color:#222;font-family: Montserrat;font-weight:500;">
                                                    It will be live now for next 30 days from the date you received this mail or we approved your post.
                                                </p>
                                                <p style="margin:5px 0px 5px 0px;font-size:16px;color:#222;font-family: Montserrat;font-weight:500;">
                                                    For any further assistance contact our support team at  <a
                                                        href="#" style="color:#0000ee;font-size:18px">support@adnlist.com</a>
                                                </p>
                                                <p style="margin:5px 0px 5px 0px;font-size:16px;color:#222;font-family: Montserrat;font-weight:500;">
                                                    Check your post using below link.
                                                </p>
                                            </td>
                                        </tr>
                                       
                                        
                                        <tr>
                                            <td height="10"></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr> 
                            <tr>
                                <td align="center">
                                    <a href="{{ url('category_view/detail',[$feedback['task_id'], 'all']) }}" style=""><span style="font-family:Montserrat;font-weight:500;font-size:16px;color:#0000ee;">{{ url('category_view/detail',[$feedback['task_id'], 'all']) }}</span></a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                @elseif($feedback['task_status'] > 1)
                <tr>
                    <td style="padding-left:20px;">
                        <table>
                            <tr>
                                <td>
                                    <p style="margin:5px 0px 5px 0px;font-size:16px;color:#222222;font-family: Montserrat;font-weight:500;">
                                        Your recently submitted post on AdnList is flagged by admin.There could be many reasons for removing your post from our platform. 
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p style="margin:5px 0px 5px 0px;font-size:16px;color:#222222;font-family: Montserrat;font-weight:500;">
                                        The most commonly seen reason is voilating our <a href="{{ url('posting_tips') }}" target="_blank" style="color:#0000ee;">guidelines</a>. Please check our <a href="{{ route('prohibited') }}" target="_blank" style="color:#0000ee;">prohibited list</a> before submitting my content.
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p style="margin:5px 0px 5px 0px;font-size:16px;color:#222222;font-family: Montserrat;font-weight:500;">
                                        For any further assistance contact our surport team at <a href="mailto:{{ $feedback['adminmail'] }}" style="color:#0000ee;">{{ $feedback["adminmail"] }}</a>
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                @elseif($feedback['task_status'] == "del")
                <tr>
                    <td style="padding-left:20px;">
                        <table>
                            <tr>
                                <td>
                                    <p style="margin:5px 0px 5px 0px;font-size:16px;color:#222222;font-family: Montserrat;font-weight:500;">
                                        Your post on AdnList is expired! <a href="http://adnlist.com" style="color:#0000ee;">Click here</a> to repost.
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td height="10"></td>
                            </tr>
                            <tr>
                                <td>
                                    <p style="margin:5px 0px 5px 0px;font-size:16px;color:#222222;font-family: Montserrat;font-weight:500;">
                                        For any further assistance contact our surport team at <a href="mailto:{{ $feedback['adminmail'] }}" style="color:#0000ee;">{{ $feedback["adminmail"] }}</a>
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                @endif
                <tr>
                    <td height="10"></td>
                </tr>

                <tr>
                    <td style="padding-left:20px;">
                        <p style="margin:5px 0px 5px 0px;font-size:18px;color:#222;font-family: Montserrat;font-weight:600;">
                            Sincerely
                        </p>
                    </td>
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
                    <td height="30"></td>
                </tr>
            </tbody>
        </table>


    </center>
</body>

</html>
