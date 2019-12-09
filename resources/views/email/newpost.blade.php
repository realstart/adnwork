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
                        <p style="margin:5px 0px 5px 0px;font-size:16px;color:#222;font-family: Montserrat;font-weight:500;">
                            You received new post! Waiting for review!
                        </p>
                   </td>
               </tr>              
               <tr>
                    <td style="padding-left:20px;">
                        <p style="margin:5px 0px 5px 0px;font-size:16px;color:#222;font-family: Montserrat;font-weight:500;">
                            User: <span style="color:#0000ee;">{{ $feedback["name"] }}</span>
                        </p>
                    </td>
                </tr>
                
                <tr>
                    <td style="padding-left:20px;">
                        <p style="margin:5px 0px 5px 0px;font-size:16px;color:#222;font-family: Montserrat;font-weight:500;">
                            Location: <span style="color:#0000ee;">{{ $feedback['location'] }}</span>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td height="10"></td>
                </tr>
                <tr>
                    <td style="padding-left:20px;">
                        <p style="margin:5px 0px 5px 0px;font-size:16px;color:#222;font-family: Montserrat;font-weight:500;">
                            Category: <span style="color:#0000ee;">{{ $feedback['category'] }}</span>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td height="10"></td>
                </tr>
                <tr>
                    <td style="padding-left:20px;">
                        <p style="margin:5px 0px 5px 0px;font-size:16px;color:#222;font-family: Montserrat;font-weight:500;">
                            Sub-Categories: 
                            @foreach($feedback['subcategory'] as $item)
                                <span style="color:#0000ee;">{{ $item->getsubcategory->name }}</span>&nbsp;&nbsp;
                            @endforeach
                        </p>
                    </td>
                </tr>
                <tr>
                    <td height="10"></td>
                </tr>
                <tr>
                    <td style="padding-left:20px;">
                        <p style="margin:5px 0px 5px 0px;font-size:16px;color:#222;font-family: Montserrat;font-weight:500;">
                            Link: <a target="_blank" href="{{ url('category_view/detail',[$feedback['postID'], 'all']) }}"><span style="color:#0000ee;">{{ url('category_view/detail',[$feedback['postID'], 'all']) }}</span></a>
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