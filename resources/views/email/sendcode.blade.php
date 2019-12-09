
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Adnlist</title>
</head>

<body style="background:#f1f1f1;padding-top:20px;padding-bottom:20px;">
    <center>
        <table class="" border="0" cellspacing="0" cellpadding="0" width="600"
            style="max-width:600px;background-color:#ffffff; border-collapse:collapse">
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
                        <p style="margin:5px 0px 5px 0px;font-size:18px;color:#ee0000;font-family: Montserrat;font-weight:700;">
                            YOUR ATTENTION REQUIRED TO PUBLISH YOUR DRAFT POST RECENTLY SUBMITTED ON ADNLIST.
                        </p>
                    </td>
                </tr>
                
                <tr>
                    <td style="padding-left:20px;">
                        <table>
                            <tr>
                                <td width="30%">
                                    <p style="margin:5px 0px 5px 0px;font-size:16px;color:#222;font-family: Montserrat;font-weight:500;">Subject:
                                    </p>    
                                    </td>
                                <td width="70%" style="padding-left:20px;">{{ $data['subject'] }}</td>                                
                            </tr>
                            <tr>
                                <td width="30%">
                                    <p style="margin:5px 0px 5px 0px;font-size:16px;color:#222;font-family: Montserrat;font-weight:500;">Category:
                                    </p>    
                                    </td>
                                <td width="70%" style="padding-left:20px;">{{ $data['category'] }}</td>                                
                            </tr>
                            @php
                                $i=1;
                            @endphp                            
                            @foreach($data['subcategory'] as $item)                                
                                <tr>
                                    <td width="30%">
                                        @if($i == 1)
                                        <p style="margin:5px 0px 5px 0px;font-size:16px;color:#222;font-family: Montserrat;font-weight:500;">
                                            Sub-categories
                                        </p>    
                                        @endif
                                    </td>
                                    <td width="70%" style="padding-left:20px;"><p style="margin:5px 0px 5px 0px;font-size:16px;color:#222;">{{ $item->getsubcategory->name }}</p></td>
                                </tr>
                                @php
                                    $i++;
                                @endphp
                            @endforeach                                         
                        </table>
                    </td>
                </tr>
                <tr>
                    <td height="10"></td>
                </tr>
                <tr>
                    <td style="padding-left:20px;">
                        <p style="margin:5px 0px 5px 0px;font-size:18px;color:#ee0000;font-family: Montserrat;font-weight:500;">
                            Click link to publish your draft post : 
                        </p>  
                        <a style="color:#222222;max-width:500px;overflow: hidden;box-sizing: border-box;overflow-wrap: break-word;display: block;font-size:14px;" href="{{ url('user_create',$data['code']) }}">{{ url('user_create',$data['code']) }}</a>                         
                    </td>
                </tr>
                <tr>
                    <td style="padding-left:20px;">
                        <p style="margin:5px 0px 5px 0px;font-size:16px;color:#222;font-family: Montserrat;font-weight:500;">
                            For any further assistance contact our support team at &nbsp;&nbsp; <a
                                href="#" style="color:#0000ee;font-size:18px">support@adnlist.com</a>
                        </p>
                    </td>
                </tr>
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
