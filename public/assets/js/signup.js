jQuery(function ($) {
    'use strict';
    var current_page = "";
    function isEmail(email)
    {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
    }
    function signinModule()
    {
        var userEmail = $("#emailML").val();
        var userPass = $("#passwordML").val();
        
        if(userEmail == "")
        {
            $('#login-email-err strong').html("Fill out this field");
            $('#login-email-err').show();
            return false;
        }
        else
        {
            if(!isEmail(userEmail))
            { 
                $("#emailML").addClass("red_border");
                $('#login-email-err strong').html("Not email type");
                $('#login-email-err').show();
                return false;
            }
        }
        if(userPass == "")
        {
            $("#passwordML").addClass("red_border");
            $('#login-pwd-err strong').html("Fill out this field");
            $('#login-pwd-err').show();
            return false;
        }

        $('#login-email-err').hide();
        $('#login-pwd-err').hide();
        $("*").css("cursor", "wait");
        $.ajax({
            type: 'post',
            url: '/login/inside',
            dataType: 'json',
            data: $('#signin-form-Modal').serialize(),
            success: function(data) {
                if(data.status == 'email_err') {
                    $('#login-email-err').show();
                }
                else if(data.status == 'pwd_err') {
                    $('#login-pwd-err').show();
                }
                else if(data.status == 'deactive') {
                    $('#signModal').modal('hide');
                    $.confirm({
                        title: 'Oops!',
                        content: "Your account has been deactived.",
                        buttons: {
                            specialKey: {
                                text: 'OK',                                       
                                action: function(){
                                    location.reload();
                                }
                            }
                        }
                    });
                }
                else if(data.status == 'true') 
                {   
                    $('#signModal').modal('hide');
                    current_page = $(".current_page").val();
                    if(current_page == "home")
                    {
                        location.reload();
                    }
                    else if(current_page == "createpost")
                    {   
                        if($("#nav_PreviewSubmit").hasClass("selected_nav"))
                        {
                            $(".form_post_detail").submit();
                        } 
                        else
                        {
                            $("*").css("cursor", "default");
                            return true;
                        }                       
                    }
                    else
                    {
                        location.reload();
                    }
                    return true;
                }
                $("*").css("cursor", "default");
            },
            error: function(err) {
                if(data == 'email_err') {
                    $('#login-email-err').show();
                }
                $("*").css("cursor", "default");
            }
        });       
       
    }

    function signupModule()
    {    
        $(".alert_fill_input").hide();
        var passwordCreate = $("#passwordCreate").val();
        var passwordConfirm = $("#passwordConfirm").val();
        current_page = $(".current_page").val();
        $("#current_page").val(current_page);
        $("#signup-form-Modal .J_required_filed").each(function(){
            if(!$(this).val())
            {
                $(this).addClass("red_border");
                $(this).parent().parent().find(".alert_fill_input").show();
            }
        });
        if(!$("#emailMR").val())
        {
            
            return false;
        }
        else
        {
            var userEmail = $("#emailMR").val();
            if(!isEmail(userEmail))
            {
                $("#emailMR").addClass("red_border");
                $(".email_alert").html("Not type email!");
                $(".email_alert").show();
                return false;
            }
        }
        if(!$("#fnameM").val())
        {
            
            return false;
        }
        if(!$("#lnameM").val())
        {
            
            return false;
        }
        if(passwordCreate == passwordConfirm)
        {
            if(passwordCreate == "")
            {
                $("#passwordCreate").addClass("red_border");
                return false;
            }
            $("*").css("cursor", "wait");
            $.ajax({
                type: 'post',
                url: '/register/inside',
                dataType: 'json',
                data: $('#signup-form-Modal').serialize(),
                success: function(data) {                    
                    if(data.status == 'email_err') {
                        $('#register-email-err').removeClass("hide");
                    }                    
                    else if(data.status == 'true')
                    {   
                        $('#signModal').modal('hide');
                        if(current_page == "home")
                        {
                            location.reload();
                        }
                        else if(current_page == "createpost")
                        {                        
                            if($("#nav_PreviewSubmit").hasClass("selected_nav"))
                            {
                                $(".form_post_detail").submit();
                            }
                            else
                            {
                                location.reload();
                            }
                            $("*").css("cursor", "default");
                        }
                        return true;
                    }
                    else if(data.status == 'verify') {   
                        $('#signModal').modal('hide');
                        $.confirm({
                            title: 'Success!',
                            content: "Sent verification link to confirm your mail.",
                            buttons: {
                                specialKey: {
                                    text: 'OK',                                       
                                    action: function(){
                                        location.reload();
                                    }
                                }
                            }
                        });
                    } 
                    $("*").css("cursor", "default");                   
                },
                error: function(err) {
                    
                    $("*").css("cursor", "default");
                }
            }); 
        }
        else
        {
            $("#create-pwd-err").css("display","block");
        }
       
    }

    (function(){
       
        $("#signup-form").submit(function()
        {
            let elem = $(".signup-btn");
            let success_flag = false;
            $('.invalid-feedback').removeClass('show');
            if( elem.hasClass('btn-disable') )
            {
                return false;
            }
            $('.signup-btn-text').hide();
            $('#signup-spinner').addClass('show');
            elem.addClass('btn-disable');
            elem.addClass('dark-red');

            $.ajax({
                url: '/register',
                type: 'post',
                dataType: 'json',
                data: $('#signup-form').serialize(),
                success : function(data) {
                    success_flag = true;
                },
                error: function(data) {
                    console.log(data);
                    console.log(data.responseJSON);
                    if(data.responseJSON) {
                        if(data.responseJSON.message == 'The given data was invalid.') {
                            $('.signup-btn-text').show();
                            $('#signup-spinner').removeClass('show');
                            elem.removeClass('btn-disable');
                            elem.removeClass('dark-red');
                            if(data.responseJSON.errors.email) {
                                $('#up-email-alert').addClass('show');
                                $('#up-email-alert').text(data.responseJSON.errors.email[0]);
                                $('#signModal #email').focus();
                            }
                            if(data.responseJSON.errors.password) {
                                $('#up-pwd-alert').addClass('show');
                                $('#up-pwd-alert').text(data.responseJSON.errors.password[0]);
                            }
                        }
                    }
                    else {
                        location.reload();
                    }
                    success_flag = false;
                }
            });

            if(!success_flag)
            {
                return false;
            }
        })
       
    }());

    (function(){
        $(document).on("click","#btn_login_common_ajax",function(){
            signinModule();            
        });
        $(document).on("click","#btn_register_common_ajax",function(){
            signupModule();            
        });

        $(document).on("click","#btn_publish_ajax",function(){
            $("*").css("cursor", "wait");
            $.ajax({
                type: 'post',
                url: '/publish_verify',
                dataType: 'json',
                data: $('#post_publish_form').serialize(),
                success: function(data) {
                    
                    if(data.status == 'ok') {
                        $("#passwordModal").modal();
                        console.log(data.status);
                    }                    
                    else if(data.status == 'no') 
                    {
                        $("#gofinalpage").css("display","inline-block");
                        $("#btn_publish_ajax").css("display","none");
                    }
                    $("*").css("cursor", "default");
                },
                error: function(err) {
                    if(data.status == 'no') {
                        $("#gofinalpage").css("display","inline-block");
                        $("#btn_publish_ajax").css("display","none");
                    }
                    $("*").css("cursor", "default");
                }
            });             
        });
        
        $(document).on("click","#btn_create_password_ajax",function(){
            var passwordCreate = $("#passwordCreate").val();
            var passwordConfirm = $("#passwordConfirm").val();
            if(passwordCreate == passwordConfirm)
            {
                $("#create-pwd-err").css("display","none");
                $("*").css("cursor", "wait");
                $.ajax({
                    type: 'post',
                    url: '/createpassword',
                    dataType: 'json',
                    data: $('#password-form-Modal').serialize(),
                    success: function(data) {
                        
                        if(data.status == 'success')
                        {
                            $("#gofinalpage").css("display","inline-block");
                            $("#btn_publish_ajax").css("display","none");
                            $("#passwordModal").modal('hide');
                            
                            $.confirm({
                                title: 'Success!',
                                content: "Your account created successfully.",
                                buttons: {
                                    specialKey: {
                                        text: 'OK',                                       
                                        action: function(){
                                            location.reload();
                                        }
                                    }
                                }
                            });
                        }                    
                        else if(data.status == 'faild') 
                        {
                            
                        }
                        $("*").css("cursor", "default");
                    },
                    error: function(err) {
                        if(data == 'faild') {
                            
                        }
                        $("*").css("cursor", "default");
                    }
                });  
            }
            else
            {
                $("#create-pwd-err").css("display","block");
            }
                       
        });
        

        $("#signingM").on('change',function()
        {
        var temp = $("#signingM").prop("checked");
    
        if(temp)
        {
            $("#btn_register_common_ajax").removeAttr("disabled");                      
        }
        else if(!temp){
            $("#btn_register_common_ajax").attr("disabled","disabled");
        }
        });

        $(".modal_signin_form").css("display","none");
        $(".btn_view_signin").click(function(){
            $(".modal_signin_form").css("display","block");
            $(".modal_signup_form").css("display","none");
        });
        
        $(".btn_view_signup").click(function(){
            $(".modal_signin_form").css("display","none");
            $(".modal_signup_form").css("display","block");
        });
            
        $(".email_verify_input").on("focus",function(){
            $(this).removeClass("red_border"); 
            $(".email_verify_input").val("");           
        });

        $(".btn_email_verify").click(function(){
            var code = $(".email_verify_input").val();
            if(code.length < 4)
            {
                $(".email_verify_input").addClass("red_border");                
                return false;
            }
            
            $.ajax({                
                url: '/emailverifytwo',                
                data: {code:code},
                dataType: 'json',
                type: 'get',
                success: function(data) {
                    if(data.status == "ok")
                    {
                        location.reload();
                    }
                    else{
                        $(".email_verify_input").val("Code doesn't matched!");
                        $(".email_verify_input").addClass("red_border"); 
                    }
                },
                error: function(err) {
                    if(data == 'email_err') {
                        $('#login-email-err').show();
                    }
                }
            })
            $(".email_verify_input").val("");
        });
        $(document).on("click",".dropdownAuth",function(){
            var current_page =$(".current_page").val();
            if(current_page == "createpost")
            {
                if($("#nav_PreviewSubmit").hasClass("selected_nav"))
                {
                    $(".toggle_register_submit").html("Submit Post");                           
                    $(".toggle_register_submit_text").html("you are creating account on AdnList and agreeing to AdnList");
                    $("#btn_login_common_ajax span").html("SUBMIT POST");
                    $("#btn_register_common_ajax span").html("SUBMIT POST");
                }                      
            }
            
            var btn_which = $(this).data("value");
            if(btn_which == "login")
            {
                $(".modal_signin_form").css("display","block");
                $(".modal_signup_form").css("display","none");
            }
            else if(btn_which == "signup")
            {
                $(".modal_signin_form").css("display","none");
                $(".modal_signup_form").css("display","block");
            }
        });       
        
        $(".J_required_filed").keydown(function(){
            if($(this).hasClass("red_border"))
            {
                $(this).removeClass("red_border");
                $(this).parent().parent().find(".alert_fill_input").hide();
            }
        });
        $("#emailMR").keydown(function(){
            if($("#emailMR").hasClass("red_border"))
            {
                $("#emailMR").removeClass("red_border");
                $(this).parent().parent().find(".alert_fill_input").show();
            }
        });

        $("#emailML").keydown(function(){
            if($("#emailML").hasClass("red_border"))
            {
                $("#emailML").removeClass("red_border");
            }
            $('#login-email-err').hide();
        });
        
        $(document).on("keydown","#passwordML",function(e)
        {
            if($("#passwordML").hasClass("red_border"))
            {
                $("#passwordML").removeClass("red_border");
            }
            $('#login-pwd-err').hide();
            if(e.keyCode == 13)
            {
                signinModule(); 
               
            }
            
        });
        $(document).ready(function(){
            $(".alert_fill_input").hide();            
        });
    }());

    
});
