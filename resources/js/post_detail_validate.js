$(document).ready(function(){    
    var skillarray = [];
    var missing = false;
    var missing_count = 0;
    $(".added_item").each(function(){
        missing = true;        
    });
    $('.btn-addmore').click(function(){
        var checkflag = true;       
        var skill_name = $('.skill_name').val();
        var skill_exp = $('.skill_exp').val();
        var skill_level = $('.skill_level').val();
        if(skill_name == "")
        {
            $(".skill_name").addClass("red_border");
            return false;
        }else if(skill_exp == "")
        {
            $(".skill_exp").addClass("red_border");
            return false;
        }else if(skill_level == "")
        {
            $(".skill_level").addClass("red_border");
            return false;
        }    
        for(var i=0;i < skillarray.length;i++)
        {
            if(skillarray[i].toLowerCase() == skill_name.toLowerCase())
            {
                checkflag = false;
                break;
            }
        }
        
        if(checkflag)
        {  
            skillarray.push(skill_name);
            $('.added_skill').append(`
            <tr>
                <td style="padding:10px;width:35%" align="center">                    
                    <span class="skill_name_span">${skill_name}</span>
                    <input type="text" style="display:none;" class="form-control" name="skill_name[]" value="${skill_name}">
                </td>
                <td style="padding:10px;width:25%" align="center">
                    <span class="skill_exp_span">${skill_exp}</span>                 
                    <input type="text" style="display:none;" class="form-control" name="skill_exp[]" value="${skill_exp}">
                </td>
                <td style="padding:10px;width:25%" align="center">
                    <span class="skill_level_span">${skill_level}</span>                    
                    <input type="text" style="display:none;" class="form-control" name="skill_level[]" value="${skill_level}">
                </td>
                <td style="padding:10px;" align="center">
                    <button type="button" class="btn-remove">
                        <span class="subcategory-right-delete"><i class="fa fa-trash color-red"></i></span>
                    </button>
                </td>
            </tr>
            `);
        }
        else
        {
            $(".skill_name").addClass("red_border");
            return false;
        }
        $(".skill_name").val('');
        $(".skill_exp").val('');
        $(".skill_level").val('');
    });
    $('.btn-item').click(function(){
        var item_sel = $('.item_sel').val();
        var item_name = $('.item_name').val();
        var item_value = $('.item_value').val();
        var item_date = $('.item_date').val();
        var item_location = $('.item_location').val();
  
        if(item_sel == "")
        {
            $(".item_sel").addClass("red_border");
            return false;
        }else if(item_name == "")
        {
            $(".item_name").addClass("red_border");
            return false;
        }else if(item_value == "")
        {
            $(".item_value").addClass("red_border");
            return false;
        }else if(item_date == "")
        {
            $(".item_date").addClass("red_border");
            return false;
        }else if(item_location == "")
        {
            $(".item_location").addClass("red_border");
            return false;
        }     
        
        $('.added_item').append(`
        <tr class="missing_item">
            <td style="padding:10px;width:15%" align="center">                    
                <span class="skill_name_span">${item_sel}</span>
                <input type="text" style="display:none;" class="form-control" name="item_sel[]" value="${item_sel}">
            </td>
            <td style="padding:10px;width:20%" align="center">
                <span class="skill_exp_span">${item_name}</span>                 
                <input type="text" style="display:none;" class="form-control" name="item_name[]" value="${item_name}">
            </td>
            <td style="padding:10px;width:20%" align="center">
                <span class="skill_level_span">${item_value}</span>                    
                <input type="text" style="display:none;" class="form-control" name="item_value[]" value="${item_value}">
            </td>
            <td style="padding:10px;width:20%" align="center">
                <span class="skill_level_span">${item_date}</span>                    
                <input type="text" style="display:none;" class="form-control" name="item_date[]" value="${item_date}">
            </td>
            <td style="padding:10px;width:20%" align="center">
                <span class="skill_level_span">${item_location}</span>                    
                <input type="text" style="display:none;" class="form-control" name="item_location[]" value="${item_location}">
            </td>
            <td style="padding:10px;" align="center">
                <button type="button" class="btn-remove btn-missing-item">
                    <span class="subcategory-right-delete"><i class="fa fa-trash color-red"></i></span>
                </button>
            </td>
        </tr>
        `);
        $(".item_sel").val('');
        $(".item_name").val('');
        $(".item_value").val('');
        $(".item_date").val('');
        $(".item_location").val('');
        $(".missing_item").each(function(){
            missing_count++;
        });
    });
        
    
    $('.btn-addmore-edu').click(function(){
        var degree = $('.degree').val();
        var area = $('.area').val();
        var years = $('.years').val();
        if(degree == "")
        {
            $(".degree").addClass("red_border");
            return false;
        }else if(area == "")
        {
            $(".area").addClass("red_border");
            return false;
        }else if(years == "")
        {
            $(".years").addClass("red_border");
            return false;
        }            
        
        $('.added_education').append(`
        <tr>
            <td style="padding:10px;width:35%" align="center">                    
                <span class="skill_name_span">${degree}</span>
                <input type="text" style="display:none;" class="form-control" name="degree[]" value="${degree}">
            </td>
            <td style="padding:10px;width:25%" align="center">
                <span class="skill_exp_span">${area}</span>                 
                <input type="text" style="display:none;" class="form-control" name="area[]" value="${area}">
            </td>
            <td style="padding:10px;width:25%" align="center">
                <span class="skill_level_span">${years}</span>                    
                <input type="text" style="display:none;" class="form-control" name="years[]" value="${years}">
            </td>
            <td style="padding:10px;" align="center">
                <button type="button" class="btn-remove">
                    <span class="subcategory-right-delete"><i class="fa fa-trash color-red"></i></span>
                </button>
            </td>
        </tr>
        `);
        $(".degree").val('');
        $(".area").val('');
        $(".years").val('');
    });
    
  
    $("#tn_departure").keydown(function(e){   
        if(e.keyCode == 13)
        {
            var temp = $("#tn_departure").val();        
            var location = temp.split(',');           
            if(location.length > 2)
            {            
                $("#tn_departure").val(location[0]);
                $("#service_state").val(location[1]);
                $("#service_country").val(location[2]);
            }
            else
            {            
                $("#service_state").val("");
                $("#service_country").val("");
                $("#tn_departure").addClass("red_border");
                // alert("Please use the auto address input function. And confirm city name.");
                $("#tn_departure").val("");
            }
        }
        $("#tn_departure").removeClass("red_border");
    });
    
    $("#in_service_city").keydown(function(e){     
        if(e.keyCode == 13)
        {
            var temp = $("#in_service_city").val();
            var location = temp.split(',');        
            if(location.length > 2)
            {            
                $("#in_service_city").val(location[0]);
                $("#in_service_state").val(location[1]);
                $("#in_service_country").val(location[2]);
            }
            else
            {            
                $("#in_service_state").val("");
                $("#in_service_country").val("");
                $("#in_service_city").addClass("red_border");
                // alert("Please use the auto address input function. And confirm city name.");
                $("#in_service_city").val("");
            }
        }       
        $("#in_service_city").removeClass("red_border");
    });
    
  
    $(".skill_name").keydown(function(){
        $(this).removeClass('red_border');   
    });
    $(".normal_edu").keydown(function(){
        $(this).removeClass('red_border');   
    });
    $(".skill_exp").keydown(function(){
        $(this).removeClass('red_border');   
    });
    $(".common_change").keydown(function(){
        $(this).removeClass('red_border');   
    });
    $(".common_change").change(function(){
        $(this).removeClass('red_border');   
    });
    $(document).on('click','.btn-remove',function(){
        $(this).parent().parent().remove();
    });
    $(document).on('click','.btn-missing-item',function(){
        if(missing_count > 0)
        {
            missing_count--;
        }
        else{
            missing_count = 0;
        }
    });
    
    $("#title").keydown(function(){
        var title = $("#title").val();
        
        if(title.length > 99)
        {                
            $("#title").val(title.substring(0,100));
            return true;
        }
         
    });
    $("#service_address").keydown(function(){
        var address = $("#service_address").val();
        
        if(address.length > 149)
        {                
            $("#service_address").val(address.substring(0,150));
            return true;
        }
         
    });
  
    var checkarray = [];
    var checkarrayC = [];
    var checkarrayL = [];
    var checkbenefit = [];
    $(".btn-add-provider").click(function(){
        var checkflag = true;
        var value = $(".add_provider").val();
        
        if(value == "" || $.trim(value).length < 1)
        {
            $(".add_provider").addClass("red_border");
            return false;
        }
                
        for(var i=0;i < checkarray.length;i++)
        {
            if(checkarray[i].toLowerCase() == value.toLowerCase())
            {
                checkflag = false;
                break;
            }
        }
        if(checkflag)
        {
            checkarray.push(value);
            $(".added_provider").append(`
                <div class="col-sm-4 text-center m-t-10">                                                    
                    <div class="input-group">
                        <input type="text" class="p-l-10 post_provider_val" name="provider_item[]" readonly value="${value}">
                        <span class="input-group-addon"><i class="fa fa-times"></i></span>
                    </div>
                </div>                
            `);
            $(".add_provider").val("");
        }
        else
        {
            $(".add_provider").addClass("red_border");
            return false;
        }
    });
  
    $(".btn-add-life").click(function(){
        var checkflag = true;
        var value = $(".add_provider_life").val();
        
        if(value == "" || $.trim(value).length < 1)
        {
            $(".add_provider_life").addClass("red_border");
            return false;
        }
                
        for(var i=0;i < checkarrayL.length;i++)
        {
            if(checkarrayL[i].toLowerCase() == value.toLowerCase())
            {
                checkflag = false;
                break;
            }
        }
        if(checkflag)
        {
            checkarrayL.push(value);
            $(".added_life").append(`
                <div class="col-sm-4 text-center m-t-10">                                                    
                    <div class="input-group">
                        <input type="text" class="p-l-10 post_provider_val" name="life_item[]" readonly value="${value}">
                        <span class="input-group-addon"><i class="fa fa-times"></i></span>
                    </div>
                </div>                
            `);
            $(".add_provider_life").val("");
        }
        else
        {
            $(".add_provider_life").addClass("red_border");
            return false;
        }
        
        
    });
    
    $(document).on('click','.benefit_check',function(){
        if($(this).is(":checked"))
        {
            $(this).parent().find(".benefit_checked").val('1');
        }
        else
        {
            $(this).parent().find(".benefit_checked").val('0');
        }
    });
    
    $(".btn-benefit").click(function(){
        var checkflag = true;
        var value = $(".benefit_name").val();
        if(value == "")
        {
            $(".benefit_name").addClass("red_border");
            return false;
        }
        
        for(var i=0;i < checkbenefit.length;i++)
        {
            if(checkbenefit[i].toLowerCase() == value.toLowerCase())
            {
                checkflag = false;
                break;
            }
        }
        if(checkflag)
        {
            checkbenefit.push(value);
            $(".add_benefit_group").append(`
                <div class="col-xs-6">                   
                    <p class=""><input type="checkbox" class="benefit_check" id="" style="display:inline-block;margin-right:5px;"><span class="fs-13 f-w-600">${value}</span><input type="hidden" value="${value}" name="benefit_name[]"><input type="hidden" class="benefit_default" name="benefit_default[]" value="0"><input type="hidden" class="benefit_checked" name="benefit_checked[]" value="0"></p>
                </div>      
            `);
            $(".benefit_name").val("");
        }
        else
        {
            $(".benefit_name").addClass("red_border");
            return false;
        }
    });
  
  
    $(".btn-add-position").click(function(){
        var checkflag = true;
        var value = $(".add_position").val();
        var distance = $(".add_distance").val();
        if(value == "")
        {
            $(".add_position").addClass("red_border");
            return false;
        }
        // if(distance == "")
        // {
        //     $(".add_distance").addClass("red_border");
        //     return false;
        // }
        for(var i=0;i < checkarrayC.length;i++)
        {
            if(checkarrayC[i].toLowerCase() == value.toLowerCase())
            {
                checkflag = false;
                break;
            }
        }
        if(checkflag)
        {
            checkarrayC.push(value);
            if(distance != null)
            {
                value = value + '-' + distance;
            }
            $(".added_complex").append(`
                <div class="col-sm-4 text-center m-t-10">                                                    
                    <div class="input-group">
                        <input type="text" class="p-l-10 post_complex_val" name="complex_item[]" readonly value="${value}">
                        <span class="input-group-addon"><i class="fa fa-times"></i></span>
                    </div>
                </div>                
            `);
            $(".add_position").val("");
            $(".add_distance").val("");
        }
        else
        {
            $(".add_position").addClass("red_border");
            return false;
        }
        
        
    });
    $(".benefit_name").keydown(function(){
        $(this).removeClass('red_border');   
    });
    $(".add_provider").keydown(function(){
        $(this).removeClass('red_border');   
    });
    $(".add_distance").keydown(function(){
        $(this).removeClass('red_border');   
    });
    $(".add_position").keydown(function(){
        $(this).removeClass('red_border');   
    });
    $(".add_provider1").keydown(function(){
        $(this).removeClass('red_border');   
    });
    $(".add_provider_life").keydown(function(){
        $(this).removeClass('red_border');   
    });
    
    $(document).on('click','.input-group-addon',function(){
        $(this).parent().parent().remove();
        checkarray = [];
        checkarrayC = [];
        $('.post_provider_val').each(function(){
            checkarray.push($(this).val());
        });  
        $('.post_complex_val').each(function(){
            checkarrayC.push($(this).val());
        });  
              
    });    
    
       
    var reply_check_var=1;
    var subcategory_check_var=1;
    var field_check_var;
    var reply_con = true;
    var agree_con = false;
    $(".reply_check").change(function(){
        reply_check_var = 0;
        $(".reply_check").each(function(){
           if($(this).prop('checked'))
            {
                reply_check_var++;                
            }
        });
        if(reply_check_var < 1)
        {
            $(".reply_frame").addClass("red_border");
        }
        else
        {
            $(".reply_frame").removeClass("red_border");
        }
    
    });
    $(".subcategory_check").change(function(){       
        subcategory_check_var = 0;
        $(".subcategory_check").each(function(){
           if($(this).prop('checked'))
            {
                subcategory_check_var++;                
            }
        });
        
        if(subcategory_check_var < 1)
        {
            $("#multi-categorys").addClass("red_border");
        }
        else
        {
            $("#multi-categorys").removeClass("red_border");
        }
    
    });
    $(".btn-post-submit").click(function(){
        
        field_check_var = 0;
  
        $(".required_field").each(function(){
            if(!$(this).val())
            {
                $(this).addClass("red_border");  
                field_check_var++;                
            }
            if($(this).hasClass("zip_code"))
            {
                if($(this).val().length != 5)
                {
                    $(this).addClass("red_border");  
                    field_check_var++;
                }
            }            
        });
        
        if(missing)
        {
            if(missing_count < 1)
            {
                $(".alert_missing").css("display","block");
                return false;
            }
        }
        
        //console.log(reply_check_var +','+ subcategory_check_var +','+ field_check_var);
        if(reply_check_var > 0 && subcategory_check_var > 0 && field_check_var < 1)
        {
            $('.form_post_detail').submit();            
        }          
    });
  
    $("#signing").click(function(){
        if($(this).prop('checked'))
        {
            agree_con = true;
        }
        else
        {
            agree_con = false;
        }
    });
  
    $(".required_field").keydown(function(){
        if($(this).hasClass('red_border'))
        {
            $(this).removeClass("red_border");
        }
        if(!$(this).val())
        {
            $(this).addClass("red_border");
        }
    });
    $(".required_field").change(function(){
        if($(this).hasClass('red_border'))
        {
            $(this).removeClass("red_border");
        }
        if(!$(this).val())
        {
            $(this).addClass("red_border");
        }
    });
  
    $("#dont_reply").click(function(){
        reply_con = false;
        $(".reply_input_field").removeClass("required_field");
        $(".reply_input_field").attr("disabled","disabled");            
        $(".reply_input_field").val('');
        $(".reply_check_on").each(function(){            
            $(this).prop('checked',false);
        });
    });
    $(".reply_check_on").click(function(){     
        reply_con = true;          
        
        $("#dont_reply").prop('checked',false);
        
    });
    $("#preferred_email").change(function(){       
      const checked = $(this).prop("checked");   
        if(!checked)
        {
            $("#contact_email").removeClass("required_field");
            $("#contact_email").removeClass("red_border");
            $("#contact_email").val("");
            $("#contact_email").attr("disabled","disabled");
            $("#contact_email").attr("disabled");
        }
        else
        {                 
            $("#contact_email").addClass("required_field");
            $("#contact_email").removeAttr("disabled");
        }
    });
    $("#preferred_phone").click(function(){
      const checked = $(this).prop("checked");
        if(!checked)
        {
            $("#contact_phone").removeClass("required_field");
            $("#contact_phone").removeClass("red_border");
            $("#contact_phone").val("");
            $("#contact_phone").attr("disabled","disabled");
            $("#contact_phone").attr("disabled");
        }
        else
        {
            $("#contact_phone").addClass("required_field");
            $("#contact_phone").removeAttr("disabled");
        }
    });
    $("#preferred_url").click(function(){
      const checked = $(this).prop("checked");
        if(!checked)
        {
            $("#contact_url").removeClass("required_field");
            $("#contact_url").removeClass("red_border");
            $("#contact_url").val("");
            $("#contact_url").attr("disabled","disabled");
            $("#contact_url").attr("disabled");
        }
        else
        {            
            $("#contact_url").addClass("required_field");
            $("#contact_url").removeAttr("disabled");
        }
    });
    
    
    $(".zip_code").on("keypress keyup blur",function (event) {    
        $(this).val($(this).val().replace(/[^\d].+/, ""));
         if ((event.which < 48 || event.which > 57)) {
             event.preventDefault();
        }
        $(this).removeClass("red_border");
    });
  
    $(".number_field").on("keypress keyup blur",function (event) {    
        $(this).val($(this).val().replace(/[^\d].+/, ""));
         if ((event.which < 48 || event.which > 57)) {
             event.preventDefault();
        }        
    }); 
    $(".stay_avail").change(function(){
        if($(this).hasClass("stay_until"))
        {            
            $(".stay_until_date").removeAttr("disabled");
        }
        else
        {            
            $(".stay_until_date").attr("disabled","disabled");
        }
    });  
  
    var now = new Date();
    maxDate = now.toISOString().substring(0,10);
    $(".restrict_date").prop('max',maxDate);
  });