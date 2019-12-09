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
                    <td height="10"></td>
                </tr>
                
                <tr>
                    <td style="padding-left:20px;" align="center">
                        <p style="font-weight:600;font-size:36px;"><span style="color:#004000;">Ad</span><span style="color:#99d9ea;">n</span><span style="color:#5fa659">List</span></p>
                    </td>
                </tr>
                <tr>
                    <td height="30"></td>
                </tr>
                <tr>
                    <td style="padding-left:20px;">
                        @if(!empty($data['status']))
                            <p style="margin:5px 0px 5px 0px;font-size:20px;color:#222;font-family: Montserrat;font-weight:700;">Dear <span style="color:#0000ee"></span>{{ $data['name'] }}!</p>
                        @else
                            <p style="margin:5px 0px 5px 0px;font-size:20px;color:#222;font-family: Montserrat;font-weight:700;">Dear <span style="color:#0000ee"></span> {{ $data['fnameC'] }}&nbsp;{{ $data['lnameC'] }}!</p>
                        @endif
                    </td>
                </tr>              
                <tr>
                    <td style="padding-left:50px;">
                        <table>
                            <tr>
                                <td style="padding-left: 20px;">
                                    <table>
                                        <tr>
                                            <td height="10"></td>
                                        </tr>
                                        @if(!empty($data['status']))
                                            @if($data['status'] == '2')
                                                <tr>
                                                    <td>
                                                        <p style="margin:5px 0px 5px 0px;font-size:18px;color:#222222;font-family: Montserrat;font-weight:600;">                                                                                
                                                            Your account on AdnList was <span style="color:#ff7a47;"><b>Deactivated!</b></span>.                                      
                                                        </p>                                   
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td height="10"></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <p style="margin:5px 0px 5px 0px;font-size:16px;color:#222222;font-family: Montserrat;font-weight:500;">
                                                            For any further assistance cantact our support team at <a href="mailto:" style="color:#0000ee;font-size:18px">{{ $data["adminmail"] }}</a> for any queries.
                                                        </p>
                                                    </td>
                                                </tr>
                                            @elseif($data['status'] == '1')
                                                <tr>
                                                    <td>
                                                        <p style="margin:5px 0px 5px 0px;font-size:16px;color:#222222;font-family: Montserrat;font-weight:500;">                                                                                
                                                            Your account on AdnList was <span style="color:blue;"><b>re-activated successfully!</b></span>                                     
                                                        </p>                                   
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td height="10"></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <p style="margin:5px 0px 5px 0px;font-size:16px;color:#222222;font-family: Montserrat;font-weight:500;">
                                                            For any further assistance cantact our support team at <a href="mailto:" style="color:#0000ee;font-size:18px">{{ $data["adminmail"] }}</a> for any queries.
                                                        </p>
                                                    </td>
                                                </tr>
                                            @elseif($data['status'] == 'del')
                                                <tr>
                                                    <td>
                                                        <p style="margin:5px 0px 5px 0px;font-size:16px;color:#222222;font-family: Montserrat;font-weight:500;">                                                                                
                                                            Your post deleted successfully!                                     
                                                        </p>                                   
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td height="10"></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <p style="margin:5px 0px 5px 0px;font-size:16px;color:#222222;font-family: Montserrat;font-weight:500;">
                                                            For any further assistance please contact support at<a href="mailto:" style="color:#ff7a47;font-size:18px">{{ $data["adminmail"] }}</a>.
                                                        </p>
                                                    </td>
                                                </tr>
                                            @elseif($data['status'] == 'postup')
                                                <tr>
                                                    <td>
                                                        <p style="margin:5px 0px 5px 0px;font-size:16px;color:#222222;font-family: Montserrat;font-weight:500;">                                                                                
                                                            Your pending approval post is updated successfully!                                  
                                                        </p>                                   
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td height="10"></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <p style="margin:5px 0px 5px 0px;font-size:16px;color:#222222;font-family: Montserrat;font-weight:500;">
                                                            For any further assistance please contact support at &nbsp;<a href="mailto:" style="color:#0000ee;font-size:18px">{{ $data["adminmail"] }}</a>.
                                                        </p>
                                                    </td>
                                                </tr>  
                                            @elseif($data['status'] == 'verify')
                                                <tr>
                                                    <td>
                                                        <p style="margin:5px 0px 5px 0px;font-size:18px;color:#222222;font-family: Montserrat;font-weight:600;">                                                                                
                                                            Your email verified successfully! Thank you for joining AdnList.                                  
                                                        </p>                                   
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td height="10"></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <p style="margin:5px 0px 5px 0px;font-size:16px;color:#222222;font-family: Montserrat;font-weight:500;">
                                                            For any further assistance please contact support at<a href="mailto:" style="color:#0000ee;font-size:18px">{{ $data["adminmail"] }}</a>.
                                                        </p>
                                                    </td>
                                                </tr>
                                            @elseif($data['status'] == 'sendlink')
                                                <tr>
                                                    <td>
                                                        <p style="margin:5px 0px 5px 0px;font-size:18px;color:#222222;font-family: Montserrat;font-weight:600;">                                                                                
                                                            Click link to verify your email:                              
                                                        </p>  
                                                        <a style="color:#222222;max-width:500px;overflow: hidden;box-sizing: border-box;overflow-wrap: break-word;display: block;font-size:14px;" href="{{ url('user_verify',$data['link']) }}">{{ url('user_verify',$data['link']) }}</a>                                                          
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td height="10"></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <p style="margin:5px 0px 5px 0px;font-size:16px;color:#222222;font-family: Montserrat;font-weight:500;">
                                                            For any further assistance please contact support at<a href="mailto:" style="color:#0000ee;font-size:18px">{{ $data["adminmail"] }}</a>.
                                                        </p>
                                                    </td>
                                                </tr>                           
                                            @endif
                                        @else  
                                            <tr>
                                                <td>
                                                    <p style="margin:5px 0px 5px 0px;font-size:16px;color:#222222;font-family: Montserrat;font-weight:600;">                                                                                
                                                        Your account following informations was updated on({{ date('m/d/Y h:i:s a', time()) }})                                      
                                                    </p>                                   
                                                </td>
                                            </tr>
                                            <tr>
                                                <td height="10"></td>
                                            </tr>
                                            <tr>
                                                <td style="padding-left:30px;">
                                                    @if(!empty($data["p_image"]))
                                                        <p style="margin:5px 0px 5px 0px;font-size:16px;color:#222222;font-family: Montserrat;font-weight:500;">                                                                                
                                                            &ndash;&rsaquo;{{ $data["p_image"] }}                                       
                                                        </p> 
                                                    @endif  
                                                    @if(!empty($data["fname"]))
                                                        <p style="margin:5px 0px 5px 0px;font-size:16px;color:#222222;font-family: Montserrat;font-weight:500;">                                                                                
                                                            &ndash;&rsaquo;{{ $data["fname"] }}                                       
                                                        </p> 
                                                    @endif   
                                                    @if(!empty($data["lname"]))
                                                        <p style="margin:5px 0px 5px 0px;font-size:16px;color:#222222;font-family: Montserrat;font-weight:500;">                                                                                
                                                            &ndash;&rsaquo;{{ $data["lname"] }}                                       
                                                        </p> 
                                                    @endif    
                                                    @if(!empty($data["p_phone"]))
                                                        <p style="margin:5px 0px 5px 0px;font-size:16px;color:#222222;font-family: Montserrat;font-weight:500;">                                                                                
                                                            &ndash;&rsaquo;{{ $data["p_phone"] }}                                       
                                                        </p> 
                                                    @endif       
                                                    @if(!empty($data["p_location"]))
                                                        <p style="margin:5px 0px 5px 0px;font-size:16px;color:#222222;font-family: Montserrat;font-weight:500;">                                                                                
                                                            &ndash;&rsaquo;{{ $data["p_location"] }}                                       
                                                        </p> 
                                                    @endif       
                                                    @if(!empty($data["p_zip"]))
                                                        <p style="margin:5px 0px 5px 0px;font-size:16px;color:#222222;font-family: Montserrat;font-weight:500;">                                                                                
                                                            &ndash;&rsaquo;{{ $data["p_zip"] }}                                       
                                                        </p> 
                                                    @endif       
                                                    @if(!empty($data["p_type"]))
                                                        <p style="margin:5px 0px 5px 0px;font-size:16px;color:#222222;font-family: Montserrat;font-weight:500;">                                                                                
                                                            &ndash;&rsaquo;{{ $data["p_type"] }}                                       
                                                        </p> 
                                                    @endif       
                                                    @if(!empty($data["p_phonecode"]))
                                                        <p style="margin:5px 0px 5px 0px;font-size:16px;color:#222222;font-family: Montserrat;font-weight:500;">                                                                                
                                                            &ndash;&rsaquo;{{ $data["p_phonecode"] }}                                       
                                                        </p> 
                                                    @endif                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td height="10"></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <p style="margin:5px 0px 5px 0px;font-size:16px;color:#222222;font-family: Montserrat;font-weight:500;">
                                                        For any further assistance please contact support at  <a href="mailto:" style="color:#0000ee;font-size:18px">{{ $data["adminmail"] }}</a>.
                                                    </p>
                                                </td>
                                            </tr>
                                        @endif
                                       
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                
                <tr>
                    <td height="10"></td>
                </tr>
                <tr>
                    <td style="padding-left:20px;">
                        <p style="font-size:18px;color:#222;font-family: Montserrat;font-weight:600;">
                            Sincerely
                        </p>
                    </td>
                </tr>

                <tr>
                    <td height="10"></td>
                </tr>
                <tr>
                    <td style="padding-left:20px;">
                        <p style="font-size:18px;color:#222;font-family: Montserrat;font-weight:600;">
                            Adnlist team
                        </p>
                        <p style="font-size:18px;color: #0738ca;font-family: Montserrat;font-weight:600;">
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
