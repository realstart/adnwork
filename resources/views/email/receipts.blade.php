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
                        <p style="margin:5px 0px 5px 0px;font-weight:600;font-size:36px;"><span style="color:#004000;">Ad</span><span style="color:#99d9ea;">n</span><span style="color:#5fa659">List</span></p>
                    </td>
                </tr>
                <tr>
                    <td height="10"></td>
                </tr>
                <tr>
                    <td style="padding-left:20px;">
                        <p style="margin:5px 0px 5px 0px;font-size:20px;color:#222;font-family: Montserrat;font-weight:700;">Dear {{ $receipts['name'] }}!</p>
                    </td>
                </tr>
                <tr>
                    <td height="10"></td>
                </tr>
                <tr>
                    <td>
                        <p style="margin:5px 0px 5px 0px;text-align:center;font-size:24px;color:#222;font-family: Montserrat;font-weight:700;">Payment Receipt</p>
                    </td>
                </tr>
                <tr>
                    <td height="5"></td>
                </tr>
                <tr>
                    <td height="1" style="background:#dedede;"></td>
                </tr>
                <tr>
                    <td style="padding-left: 20px;">
                        <table>
                            <tr>
                                <td height="5"></td>
                            </tr>
                            <tr>
                                <td>
                                    <p style="margin:5px 0px 5px 0px;font-size:18px;color:#222;font-family: Montserrat;font-weight:500;">
                                        Payment successfully submitted for posting in <span style="color:#0000ee;">{{ $receipts['category'] }}</span>!
                                    </p>                                  
                                </td>
                            </tr>

                            <tr>
                                <td height="10"></td>
                            </tr>
                            <tr>
                                <td>
                                    <table>
                                        <tr>
                                            <td width="30%">
                                                <p style="margin:5px 0px 5px 0px;font-size:20px;color:#222;font-family: Montserrat;font-weight:500;">Sub-categories selelcted
                                                </p>    
                                               </td>
                                            <td width="40%"></td>
                                            <td width="30%"></td>
                                        </tr>
                                        @foreach($receipts['subcategory'] as $item)
                                            <tr>
                                                <td width="30%"></td>
                                                <td width="40%"><p style="margin:5px 0px 5px 0px;font-size:18px;color:#222;">{{ $item->getsubcategory->name }}</p></td>
                                                <td width="30%" align="center"><p style="margin:5px 0px 5px 0px;text-align:center;font-size:20px;color:#222;">$ {{ $receipts['category_price'] }}</p></td>
                                            </tr>
                                        @endforeach  
                                        <tr>
                                            <td colspan="3"></td>
                                        </tr>
                                        <tr>
                                            <td width="30%"></td>
                                            <td width="40%">
                                                <p style="margin:5px 0px 5px 0px;font-size:18px;color:#0000ee;margin:5px 0px 5px 0px;">Total Price:</p>
                                            </td>
                                            <td align="center">
                                                <p style="margin:5px 0px 5px 0px;font-size:18px;color:#0000ee;text-align:center;margin:5px 0px 5px 0px;">${{ $receipts['price'] }}</p>
                                            </td>
                                        </tr>                                      
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td height="10"></td>
                            </tr>
                            <tr>
                                <td>
                                    <p style="margin:5px 0px 5px 0px;font-size:16px;color:#222;font-family: Montserrat;font-weight:500;">
                                        For any further assistance contact our support team at <a
                                            href="#" style="color:#0000ee;font-size:18px">{{ $receipts['mail'] }}</a>
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
                    <td height="1" style="background:#dedede;"></td>
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
