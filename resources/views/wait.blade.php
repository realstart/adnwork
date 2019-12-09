<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <title>AdnList</title>

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" type="text/css">   
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon-icon/favicon.png') }}">			
   
	<script src="{{ asset('assets/js/jquery.min.js') }}"></script>	
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script> 
    <style>
        .resp_mt_120{
            margin-top:100px;
        }
        .resp_mt_70{
            margin-top:40px;
        }
        .box_style{
            width:60px;height:60px;border:2px solid black;margin:10px auto;padding: 10px 0px;
        }
        @media(max-width:767px)
        {
            .resp_logo{width:80%;}
            .resp_mt_120{
                margin-top:50px;
            }
            .resp_mt_70{
                margin-top:30px;
            }
            }
    </style>
</head>

<body> 
    <section class="">
        <div class="text-center resp_mt_120">
            <img class="" style="height:50px;" src="{{ asset('assets/images/logo.png') }}" style="" alt="">
            <h2 class="resp_mt_70">Landing on</h2>
        </div>
        <div class="container">
            <div class="row resp_mt_70">
                <div class="col-md-2"></div>
                <div class="col-xs-6 col-md-2 text-center">
                    <label for="" style="font-size:16px;color:#048a0e;">Days</label>
                    <div class="box_style">
                        <span class="delay_day" style="font-size:25px;"></span>
                    </div>
                </div>
                <div class="col-xs-6 col-md-2 text-center">
                    <label for="" style="font-size:16px;color:#048a0e;">Hours</label>
                    <div class="box_style">
                        <span class="delay_hr" style="font-size:25px;"></span>
                    </div>
                </div>
                <div class="col-xs-6 col-md-2 text-center">
                    <label for="" style="font-size:16px;color:#048a0e;">Minutes</label>
                    <div class="box_style">
                        <span class="delay_min" style="font-size:25px;"></span>
                    </div>
                </div>
                <div class="col-xs-6 col-md-2 text-center">
                    <label for="" style="font-size:16px;color:#048a0e;">Seconds</label>
                    <div class="box_style">
                        <span class="delay_sec" style="font-size:25px;"></span>
                    </div>
                </div>
            </div>
        </div>        
	</section>	
</body>
<script>
    var delay = {{ $different_time }};
    function countdown(){
        delay_temp = delay;
        var day = Math.floor(delay_temp/86400);
        delay_temp -= day*86400;    
        var hour = Math.floor(delay_temp/3600);    
        delay_temp -= hour*3600;   
        var min = Math.floor(delay_temp/60);
        delay_temp -= min*60;
        $(".delay_day").html(day);
        $(".delay_hr").html(hour);
        $(".delay_min").html(min);
        $(".delay_sec").html(delay_temp);
        if(delay < 1)
        {
            delay = 0;
        }
        else
        {
            delay--;
        }
        if(delay < 1)
        {
            location.reload();
        }
    }
    
    setInterval(function(){ countdown(); }, 1000);
</script>
</html>
