jQuery(function ($) {

    'use strict';
    var subCategoryData = [];
    var postImage = [];
    var checkarray = [];
    var checkarrayC = [];
    var checkarrayL = [];
    var checkbenefit = [];
    var skillarray = [];
    var missing = false;
    var missing_count = 0;
    var reply_check_var=1;
    var check_reply_item_num=0;
    var subcategory_check_var=1;
    var field_check_var;
    var reply_con = true;
    var agree_con = false;
    var categoryName = "";
    var post_edit_status = false;
    var common_title = "";
    var common_description = "";
    var total_price;
    var sel_categoryID;
    var sel_categorySlug = "";
    
// ----------------------------------------------------------------
    var address;
    var in_service_city;
    var in_service_state;
    var in_service_country;
    var in_service_zip;
    var contact_email;        
    var contact_phone;        
    var contact_url;      
// ----------------------------------------------------------------
    function isEmail(email)
    {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
    }

    function reDrawMap()
    {    
        var latitude = parseFloat($(".latitude").val());      
        var longitude = parseFloat($(".longitude").val());     
        var uluru= {lat: latitude, lng: longitude};       
        var mapDetail = new google.maps.Map(
            document.getElementById('mapDetail'), {zoom: 15, center: uluru});
        
        var radius = new google.maps.Circle({zoom:15,map: mapDetail,
                radius: 200,
                center: uluru,
                fillColor: '#777',
                fillOpacity: 0.1,
                strokeColor: '#AA0000',
                strokeOpacity: 0.8,
                strokeWeight: 2,
                draggable: true,   
                editable: true     
            });
            
        mapDetail.panTo(new google.maps.LatLng(uluru.lat,uluru.lng));      
    }

    function ScrollTop()
    {
        $('html, body').animate({
            scrollTop: $(".scroll_top_position").offset().top-100
        }, 100, function(){

        });
        return true;
    }
    function initInputPage()
    {        
        postImage = [];
        checkarray = [];
        checkarrayC = [];
        checkarrayL = [];
        checkbenefit = [];
        skillarray = [];

        subcategory_check_var = 0;
        $("#title").val("");
        $("#body").val("");
        $(".upload_post_image").html("");
        $("#county_details").html("");
        $(".classified_details").attr("disabled","disabled");
        $("#service_address").val("");
        $("#tn_departure").val("");
        $("#service_state").val("");
        $("#service_country").val("");
        $("#service_zip").val("");
        $("#service_county").val("");

        var uluru = {lat: 32.715736, lng: -117.161087};			
        map = new google.maps.Map(
        document.getElementById('map'), {zoom: 15, center: uluru});

        $(".latitude").val("");
        $(".longitude").val("");
        return true;
    }

    function showTitleDescprition()
    {
        let htmlBody = '';
        htmlBody += '<h4>Details</h4>';
        htmlBody += '<div>';
        htmlBody += '<textarea style="border:none;box-shadow:none;outline:none;font-family:Arial;line-height:25px;" id="post_detail" readonly>';
        htmlBody += common_description;
        htmlBody += '</textarea>';
        htmlBody += '</div>';   

        // ------------------------------- 
        $("#description").html("");   
        $("#description").append(htmlBody); 
        autosize(document.getElementById("post_detail"));  
        if(total_price > 0)
        {            
            $(".btn_agree_post").html("Submit & Pay");
            $(".btn_unagree").html("Submit & Pay");
        }
    }
    function showMatrimoniesDetail()
    {
        
        $("#description").html("");   
        $("#description").append('<h4>Details</h4><div><textarea style="border:none;box-shadow:none;outline:none;font-family:Arial;line-height:25px;" id="post_detail" readonly>'+ common_description +'</textarea></div>'); 
        var Matrimonies_employedin = $(".Matrimonies_employedin").val();
        var Matrimonies_employment_status = $(".Matrimonies_employment_status").val();
        var Matrimonies_working_field = $(".Matrimonies_working_field").val();
        var Matrimonies_education = $(".Matrimonies_education").val();
        var Matrimonies_specialization = $(".Matrimonies_specialization").val();
        var Matrimonies_school = $(".Matrimonies_school").val();
        var Matrimonies_month = $(".Matrimonies_month").val();
        var Matrimonies_year = $(".Matrimonies_year").val();        
        var Religion_num = 0;

        let htmlBody = '';
        htmlBody += ' <label class="text-color-blue m-t-20 p-l-10" style="font-weight: 600;">Professional Details</label>';
        htmlBody += '<div class="p-l-30 normal_border Matrimonies_professional_details p-t-15 p-b-15">';
        htmlBody += '</div';       
        
        if(Matrimonies_employedin !="" || Matrimonies_employment_status !="" || Matrimonies_working_field !="" || Matrimonies_education !="" || Matrimonies_specialization !="" || Matrimonies_school !="" || Matrimonies_month !="" || Matrimonies_year !="")
        {
            $("#description").append(htmlBody);
        }
        

        if(Matrimonies_employedin !="" || Matrimonies_employment_status !="" || Matrimonies_working_field !="")
        {
            $(".Matrimonies_professional_details").append('<label class="label-title">Occupation</label>'); 
        }

        if(Matrimonies_employedin !="")
        {
            $(".Matrimonies_professional_details").append('<div class="row"><div class="col-sm-4"><p class="p-l-20">Employed in</p></div><div class="col-sm-8"><p class="p-l-20">'+ Matrimonies_employedin +'</p></div></div>'); 
        }
        if(Matrimonies_employment_status !="")
        {
            $(".Matrimonies_professional_details").append('<div class="row"><div class="col-sm-4"><p class="p-l-20">Employment Status</p></div><div class="col-sm-8"><p class="p-l-20">'+ Matrimonies_employment_status +'</p></div></div>'); 
        }
        if(Matrimonies_working_field !="")
        {
            $(".Matrimonies_professional_details").append('<div class="row"><div class="col-sm-4"><p class="p-l-20">Working field</p></div><div class="col-sm-8"><p class="p-l-20">'+ Matrimonies_working_field +'</p></div></div>'); 
        }
        if(Matrimonies_education !="" || Matrimonies_specialization !="" || Matrimonies_school !="" || Matrimonies_year !="")
        {
            $(".Matrimonies_professional_details").append('<label class="label-title">Education</label>'); 
        }
        if(Matrimonies_education !="")
        {
            $(".Matrimonies_professional_details").append('<div class="row"><div class="col-sm-4"><p class="p-l-20">Highest Education</p></div><div class="col-sm-8"><p class="p-l-20">'+ Matrimonies_education +'</p></div></div>'); 
        }
        if(Matrimonies_specialization !="")
        {
            $(".Matrimonies_professional_details").append('<div class="row"><div class="col-sm-4"><p class="p-l-20">Specialization in</p></div><div class="col-sm-8"><p class="p-l-20">'+ Matrimonies_specialization +'</p></div></div>'); 
        }
        if(Matrimonies_school !="")
        {
            $(".Matrimonies_professional_details").append('<div class="row"><div class="col-sm-4"><p class="p-l-20">School/College/University</p></div><div class="col-sm-8"><p class="p-l-20">'+ Matrimonies_school +'</p></div></div>'); 
        }
        if(Matrimonies_year !="")
        {
            $(".Matrimonies_professional_details").append('<div class="row"><div class="col-sm-4"><p class="p-l-20">Graduated in</p></div><div class="col-sm-8"><p class="p-l-20">'+ Matrimonies_year +'-'+ Matrimonies_month +'</p></div></div>'); 
        }
        if(checkarrayL.length > 0)
        {
            $("#description").append('<div class="add-title m-b-15 m-t-20"><label class="text-color-blue">Life Style</label><div class="normal_border Matrimonies_life_warp" style="padding:15px;"></div></div>');
            for (let index = 0; index < checkarrayL.length; index++)
            {                
                $(".Matrimonies_life_warp").append('<span class="provider_item item_border_style_blue">'+ checkarrayL[index] +'</span>'); 
            }      
        }
       
        if(checkarrayC.length > 0 || checkarrayC.length > 0)
        {
            $("#description").append('<div class="add-title m-b-15 m-t-20"><label class="text-color-blue">Interests & Hobbies</label><div class="normal_border Matrimonies_interests_hobbies" style="padding:15px;"></div></div>');
            if(checkarray.length > 0)
            {
                $(".Matrimonies_interests_hobbies").append('<div class="Matrimonies_interests add-title m-b-15"><label class="">Interests</label><br></div>');
                for (let index = 0; index < checkarray.length; index++) {                
                    $(".Matrimonies_interests").append('<span class="provider_item item_border_style_blue">'+ checkarray[index] +'</span>');         
                }              
            }
            if(checkarrayC.length > 0)
            {
                $(".Matrimonies_interests_hobbies").append('<div class="Matrimonies_hobbies m-b-15 add-title"><label class="">Hobbies</label><br></div>');
                $(".added_complex_Matrimonies .post_complex_val").each(function(){
                    $(".Matrimonies_hobbies").append('<span class="provider_item item_border_style_blue">'+ $(this).val() +'</span>');
                });
            }
        }

        $(".Matrimonies_religion").each(function(){
            if(this.checked == true)
            {
                Religion_num++;
            }
        });
        if(Religion_num > 0)
        {
            $("#description").append('<div class="add-title m-b-15 m-t-20"><label class="text-color-blue">Religion Information</label><div class="normal_border Matrimonies_religion" style="padding:15px;"></div></div>');
            $(".Matrimonies_religion").each(function(){
                if(this.checked == true)
                {
                    $(".Matrimonies_religion").append('<span class="provider_item item_border_style_blue">'+ $(this).val() +'</span>');
                }
            });
        }
        
        if(total_price > 0)
        {            
            $(".btn_agree_post").html("Submit & Pay");
            $(".btn_unagree").html("Submit & Pay");
        }
    }
    function showImageSlider()
    {
        if(postImage.length>0)
        {
            $(".pgwSlider").html("");
            for (let index = 0; index < postImage.length; index++)
            {
                $(".pgwSlider").append('<li><img src="upload/img/poster/lg/'+ postImage[index] +'" alt="" data-description=""></li>');
            }
            
            $('.pgwSlider').pgwSlider({
                listPosition:'left',
                displayControls: true,
                selectionMode: 'click'
            });
            if(!$(".slider_part").hasClass("min_h_370"))
            {
                $(".slider_part").addClass("min_h_370");
            }
        }  
        else
        {            
            $("#product-carousel").css("display","none");
            $("#description").removeClass("line-top");
            $("#description").removeClass("m-t-50");
            $(".slider_part").removeClass("min_h_370");
        }  
        return true;
    }

    function showSubCategory(categoryID,thisobj)
    {               
        sel_categorySlug = thisobj.find("a").data('slug'); 
        
        $("#subcategoryList").html("");
        $(".cur_categoryID").val(categoryID);
        $('.select-category.post-option ul li.link-active').removeClass('link-active');
        thisobj.addClass('link-active'); 
        for (let index = 0; index < subCategoryData.length; index++) {             
            if(categoryID == subCategoryData[index].parent_id)
            {
                $("#subcategoryList").append('<li><label class="m-b-3 disp_flex"><input type="checkbox" class="subcategory_check sub_category_check subcategoryselect" style="display:inline-block;" name="subcategoryselect[]" data-price="" value="'+ subCategoryData[index].id +'" >'+ subCategoryData[index].name +'</label></li>');
            }
            
        }
    }
    function showSubCategoryM()
    {               
        $("#categoryList ul li").each(function(){
            if($(this).find("a").data("value") == $.cookie('sel_categoryID'))
            {
                sel_categorySlug = $(this).find("a").data("slug");               
                $(this).addClass('link-active'); 
            }
        });
        $(".cur_categoryID").val($.cookie('sel_categoryID'));
        var categoryID = $.cookie('sel_categoryID');
        
        for (let index = 0; index < subCategoryData.length; index++) {             
            if(categoryID == subCategoryData[index].parent_id)
            {
                $("#subcategoryList").append('<li><label class="m-b-3 disp_flex"><input type="checkbox" class="subcategory_check sub_category_check subcategoryselect" style="display:inline-block;" name="subcategoryselect[]" data-price="" value="'+ subCategoryData[index].id +'" >'+ subCategoryData[index].name +'</label></li>');
            }
            
        }
        $.cookie('sel_categoryID','0');
    }
    function showTitleAddress()
    {
        address = $("#service_address").val();
        in_service_city = $("#tn_departure").val();
        in_service_state = $("#service_state").val();
        in_service_country = $("#service_country").val();
        in_service_zip = $("#service_zip").val();
        contact_email = $("#contact_email").val();        
        contact_phone = $("#contact_phone").val();        
        contact_url = $("#contact_url").val();  

        address = address + " " + in_service_city + " " + in_service_state + " " + in_service_country;
        $(".post_title").html(common_title);
        $(".address").html(address);
        $(".short-info").html("");
        $(".short-info").append('<h3 class="title">Short Info</h3>');
    }
    function showReply()
    {
        $(".reply_detail").html("");
        if(!reply_con)
        {
            $(".reply_detail").append('<h6 style="font-size:14px;" class="text-color-blue">No Reply</h6>');
        }
        else
        {            
            if(contact_phone !="")
            {
                $(".reply_detail").append('<p><span class="m-r-5" style="color:#00a651;"><i class="fa fa-phone-square"></i></span><span class=""> <a href="javascript:;"><span class="text-color-blue">Call me</span></a></span></p>');
            }
            if(contact_email !="")
            {
                $(".reply_detail").append('<p><a href="#" class="" data-toggle="modal" data-target="#myModal"><span class="m-r-5" style="color:#00a651;"><i class="fa fa-envelope-square"></i></span> <span class="text-color-blue">Reply with email</span></a></p>');
            }
            if(contact_url !="")
            {
                $(".reply_detail").append('<p><a href="javascript:;" class="text-color-blue"><span class="m-r-5" style="color:#00a651;"><i class="fa fa-internet-explorer"></i></span>'+ contact_url +'</a> <span class="fs-12 text-color-purple">(Copy Link)</span></p>');
            }
        }   
        return true;
    }
    function addProvider(value)
    {
        var checkflag = true;
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
    
            let html = '';
            html += '<div class="col-sm-4 text-center m-t-10">';
            html += '<div class="input-group">';
            html += '<input type="text" class="p-l-10 post_provider_val" name="provider_item[]" readonly value="';
            html += value;
            html += '" alt="">';
            html += '<span class="input-group-addon"><i class="fa fa-times"></i></span>';
            html += '</div>';       
            html += '</div>';
            $(".added_provider_"+sel_categorySlug).append(html);               
            $(".add_provider_"+sel_categorySlug).val("");
            return true;                
        }
        else
        {
            $(".add_provider_"+sel_categorySlug).addClass("red_border");
            return false;
        }
    }

    function addProviderC(value,distance)
    {
        var checkflag = true;
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
                value = value + ' - ' + distance;
            }
            
            let html = '';
            html += '<div class="col-sm-4 text-center m-t-10">';
            html += '<div class="input-group">';
            html += '<input type="text" class="p-l-10 post_complex_val" name="complex_item[]" readonly value="';
            html += value;
            html += '">';
            html += '<span class="input-group-addon"><i class="fa fa-times"></i></span>';                
            html += '</div>';
            html += '</div>';      

            $(".added_complex_"+sel_categorySlug).append(html);

            $(".add_position_"+sel_categorySlug).val("");
            $(".add_distance_"+sel_categorySlug).val("");
        }
        else
        {
            $(".add_position").addClass("red_border");
            return false;
        }
    }
// ------------------------------Show_Detail_Pages--------------------------
    function LocalService()
    {   
        showTitleDescprition()
        showImageSlider();
        showTitleAddress();
        reDrawMap();    
        showReply();
        var provider_name = $("#provider_name").val();
        var estimated_rent = $("#estimated_rent").val();
        

        if(provider_name != "")
        {
            $(".short-info").append('<div class="add-title m-b-15"><label class="text-color-blue">Service provider</label><br><p>'+ provider_name +'</p></div>');
        }
        
        if(checkarray.length > 0)
        {
            $(".short-info").append('<div class="add-title providerItems m-b-15"><label class="text-color-blue">Services provide</label><br></div>');
            for (let index = 0; index < checkarray.length; index++) {                
                $(".providerItems").append('<span class="provider_item item_border_style">'+ checkarray[index] +'</span>');         
            }
        }
       
        if(estimated_rent != "")
        {
            $(".short-info").append('<div class="add-title"><label class="label-title text-color-blue">Business Hours</label><p>'+ estimated_rent +'</p></div>');
        }             

        if(provider_name == "" && estimated_rent == "" && checkarray.length == 0)
        {
            $(".short-info").append('<div class="add-title"><h6 class="text-color-blue fs-14">Not provided</h6></div>');
        }
    }

    function ForSale()
    {
        showTitleDescprition()
        showImageSlider();
        showTitleAddress();
        reDrawMap(); 
        showReply();
        var price = $("#utilities_sale").val();  
        var condition = $("#condition_sale").val();  
        var saleby = $("#listedby_sale").val();  
        var make = $(".short_jobs_make").val();
        var model = $(".short_jobs_model").val();
        var year = $(".short_jobs_year").val();
        var color = $(".short_jobs_color").val();
        var other = $(".short_jobs_other").val();
        if(saleby != "" || condition != "" || price != "")
        {
            $(".short-info").append('<div class="form-group add-title"><label class="label-title text-color-purple">Item details</label><div class="form-group add-title sale_short_item_price" style="border:1px solid #dedede;padding:10px;"></div></div>');
            if(saleby != "")
            {
                $(".sale_short_item_price").append('<div class=""><label class="label-title text-color-blue">Sale by&nbsp;&nbsp;</label><span>'+ saleby +'</span></div>');
            }
            if(condition != "")
            {
                $(".sale_short_item_price").append('<div class=""><label class="label-title text-color-blue">Condition&nbsp;&nbsp;</label><span>'+ condition +'</span></div>');
            }
        
            if(price != "")
            {
                $(".sale_short_item_price").append('<div class=""><label class="label-title text-color-blue">Price/Cost&nbsp;&nbsp;</label><span>'+ price +'</span></div>');
            }
        }
        if(make != "" || model != "" || year != "" || color != "" || other != "")
        {
            $(".short-info").append('<div class="form-group add-title"><label class="label-title text-color-purple">Additional details</label><div class="form-group add-title sale_short_item_details" style="border:1px solid #dedede;padding:10px;"></div></div>');
            if(make != "")
            {
                $(".sale_short_item_details").append('<p style="display:inline-block;" class="m-r-5"><label class="m-r-5 text-color-blue">Make&nbsp;&nbsp;</label><span class="fw-500">'+ make +'</span></p>');
            }
            if(model != "")
            {
                $(".sale_short_item_details").append('<p style="display:inline-block;" class="m-r-5"><label class="m-r-10 text-color-blue">Model&nbsp;&nbsp;</label><span class="fw-500">'+ model +'</span></p>');
            }
            if(year != "")
            {
                $(".sale_short_item_details").append('<p style="display:inline-block;" class="m-r-5"><label class="m-r-5 text-color-blue">Year&nbsp;&nbsp;</label><span class="fw-500">'+ year +'</span></p>');
            }
            if(color != "")
            {
                $(".sale_short_item_details").append('<p style="display:inline-block;" class="m-r-5"><label class="m-r-5 text-color-blue">Color&nbsp;&nbsp;</label><span class="fw-500">'+ color +'</span></p>');
            }
            if(other != "")
            {
                $(".sale_short_item_details").append('<p style="display:inline-block;" class="m-r-5"><label class="m-r-5 text-color-blue">Other details&nbsp;&nbsp;</label><span class="fw-500">'+ other +'</span></p>');
            }
        }
        return true;       
    }

    function Jobs()
    {
        showTitleDescprition()
        showImageSlider();
        showTitleAddress();
        reDrawMap(); 
        showReply();
        var price = $("#utilities_sale").val();  
        var condition = $("#condition_sale").val();  
        var saleby = $("#listedby_sale").val();  
        var Jobs_inderview_mode = $("#Jobs_inderview_mode").val();       
        var Jobs_client_recruiter = $(".Jobs_client_recruiter").val();
        var Jobs_compensation = $("#Jobs_utilities").val();
        
        
        var Jobs_postedby = $(".Jobs_postedby").val();
        var Jobs_subcategory_check_item_num = 0;
        var Jobs_employeetype_num = 0;
        var Jobs_benefit_num = 0;
        var Jobs_work_authorization_num = 0;

        
        $(".Jobs_subcategory_check_item").each(function(){
            if(this.checked == true)
            {
                Jobs_subcategory_check_item_num++;
            }
        });
        $(".ms-options .selected").each(function(){
            Jobs_employeetype_num++
        });

        if(Jobs_subcategory_check_item_num > 0)
        {
            $("#description").append('<div class="m-t-30"><div class="row Jobs_subcategory_check_item_warp"></div></div>');
            $(".Jobs_subcategory_check_item").each(function(){
                if(this.checked == true)
                {
                    var htmltemp = $(this).data("text");
                    $(".Jobs_subcategory_check_item_warp").append('<p><label><span class="fs-12"><i class="fa fa-check"></i></span>&nbsp;<span class="fs-14" style="font-weight:400;">'+ htmltemp +'</span></label></p>');
                }
            });
        }

        if(Jobs_client_recruiter !="" || Jobs_employeetype_num > 0 || Jobs_inderview_mode !="" || Jobs_compensation !="" || Jobs_postedby !="")
        {
            $(".short-info").append('<div class="form-group add-title"><label class="label-title text-color-purple">Key details</label><div class="form-group add-title short_warp_style"><div class="m-b-10 add-title jobs_key_details"></div></div></div>');
        }
        if(Jobs_client_recruiter !="")
        {
            $(".jobs_key_details").append('<div class="add-title m-b-15"><label class="text-color-blue">Client/Recruiter name</label><br><span>'+ Jobs_client_recruiter +'</span></div>');
        }  
        
        if(Jobs_employeetype_num > 0)
        {
            $(".jobs_key_details").append('<div class="add-title m-b-15"><div class="form-group add-title Jobs_employeetype_warp"><label class="text-color-blue">Employment type</label><br></div></div>');

            $(".ms-options .selected").each(function(){
                $(".Jobs_employeetype_warp").append('<span class="provider_item item_border_style">'+ $(this).attr("data-search-term") +'</span>');                
            });
        }
           
        if(Jobs_inderview_mode !="")
        {
            $(".jobs_key_details").append('<div class="add-title m-b-15"><label class="text-color-blue">Interview mode</label>&nbsp;<span>'+ Jobs_inderview_mode +'</span></div>');
        }
        if(Jobs_compensation !="")
        {
            $(".jobs_key_details").append('<div class="add-title m-b-15"><label class="text-color-blue">Compensation</label><div class=""><p>'+ Jobs_compensation + '</p></div></div>');
        }

        if(Jobs_postedby !="")
        {
            $(".jobs_key_details").append('<div class="add-title m-b-15"><label class="text-color-blue">Posted by </label>&nbsp;<span>'+ Jobs_postedby +'</span></div>');
        }

        $(".benefit_check").each(function(){
            if(this.checked == true)
            {
                Jobs_benefit_num++;
            }            
        });    

        if(Jobs_benefit_num > 0)
        {
            $(".short-info").append('<div class="form-group add-title"><label class="label-title text-color-purple">Employement Benefits</label><div class="form-group add-title short_warp_style"><div class="m-b-10 add-title jobs_short_benefit"></div></div></div>');
        }

        
        if(Jobs_benefit_num > 0)
        {
            $(".jobs_short_benefit").append('<div class="form-group add-title Jobs_benefits_wrap"></div>');
            $(".benefit_check").each(function(){
                if(this.checked == true)
                {
                    $(".Jobs_benefits_wrap").append('<span class="provider_item item_border_style">'+ $(this).data("benefit") +'</span>');
                }            
            });    
        }
        
        $(".Jobs_work_authorization").each(function(){
            if(this.checked == true)
            {
                Jobs_work_authorization_num++;
            }            
        });

        if(Jobs_work_authorization_num > 0)
        {
            $(".short-info").append('<div class="form-group add-title"><label class="label-title text-color-purple">Work Authorization Accept</label><div class="form-group add-title short_warp_style"><div class="m-b-10 add-title jobs_short_work_authorization"></div></div></div>');
        }

        if(Jobs_work_authorization_num > 0)
        {
            $(".jobs_short_work_authorization").append('<div class="form-group add-title Jobs_work_authorization_warp"></div>');
            $(".Jobs_work_authorization").each(function(){
                if(this.checked == true)
                {
                    $(".Jobs_work_authorization_warp").append('<span class="provider_item item_border_style">'+ $(this).data("value") +'</span>');
                }            
            });    
        }
        return true;     
    }

    function Accommodation()
    {
        showTitleDescprition()
        showImageSlider();
        showTitleAddress();
        reDrawMap(); 
        showReply();
        var Acco_AccommodationType = $("#Acco_condition").val();
        var Acco_PostedBy = $(".Acco_listedby").val();
        var Acco_BedRooms = $(".Acco_BedRooms").val();
        var Acco_BathRooms = $(".Acco_BathRooms").val();
        var Acco_StayLength = $(".stay_until_date").val();
        var Acco_EarlyAvailable = $(".Acco_EarlyAvailable").val();

        var Acco_Smoking = "";
        var Acco_PetsAllowed = ""; 

        var Acco_sale_detail = $(".Acco_sale_detail").val();
        var Acco_utilities = $("#Acco_utilities").val();
        var Acco_AvailableFor_num = 0;

        $(".stay_avail").each(function(){
            if(this.checked == true)
            {
                if($(this).val() != "Until")
                {
                    Acco_StayLength = $(this).val();
                }                
            }
        });

        $(".Acco_Smoking").each(function(){
            if(this.checked == true)
            {
                Acco_Smoking = $(this).val();
            }
        });

        $(".Acco_PetsAllowed").each(function(){
            if(this.checked == true)
            {
                Acco_PetsAllowed = $(this).val();
            }
        });

        if(Acco_AccommodationType != "" || Acco_PostedBy != "" || Acco_BedRooms != "" || Acco_BathRooms != "" || Acco_utilities != "" || Acco_sale_detail != "")
        {
            $(".short-info").append('<div class="form-group add-title"><label class="label-title text-color-purple">Accomm/Housing details</label><div class="form-group add-title short_warp_style"><div class="m-b-10 add-title accomm_housing"></div></div></div>');
        }

        if(Acco_AccommodationType != "")
        {
            $(".accomm_housing").append('<div class="m-b-10 add-title"><label class="text-color-blue">Accombodation type</label>&nbsp;&nbsp;<span>'+ Acco_AccommodationType +'</span></div>');
        }

        if(Acco_PostedBy != "")
        {
            $(".accomm_housing").append('<div class="m-b-10 add-title"><label class="text-color-blue">Posted by</label>&nbsp;&nbsp;<span>'+ Acco_PostedBy +'</span></div>');
        }     
        
        if(Acco_BedRooms != "")
        {
            $(".accomm_housing").append('<div class="m-b-10 add-title"><label class="text-color-blue">No.of Bed Rooms</label>&nbsp;&nbsp;<span>'+ Acco_BedRooms +'</span></div>');
        }
        if(Acco_BathRooms != "")
        {
            $(".accomm_housing").append('<div class="m-b-10 add-title"><label class="text-color-blue">No.of Bath Rooms</label>&nbsp;&nbsp;<span>'+ Acco_BathRooms +'</span></div>');
        }
        if(Acco_sale_detail != "")
        {
            $(".accomm_housing").append('<div class="m-b-10 add-title"><label class="text-color-blue">Furnished</label>&nbsp;&nbsp;<span>'+ Acco_sale_detail +'</span></div>');
        }        
        if(Acco_utilities != "")
        {
            $(".accomm_housing").append('<div class="m-b-10 add-title"><label class="text-color-blue">Estimated Rent</label><div class=""><span class="item_border_style" style="width:100%;">'+ Acco_utilities +'</span></div></div>');
        }
        
        

        if(Acco_StayLength != "" || Acco_EarlyAvailable != "")
        {
            $(".short-info").append('<div class="form-group add-title"><label class="label-title text-color-purple">Stay Availability</label><div class="form-group add-title short_warp_style"><div class="m-b-10 add-title accomm_stay_availability"></div></div></div>');
        }
        

        if(Acco_StayLength != "")
        {
            $(".accomm_stay_availability").append('<div class="m-b-10 add-title"><label class="text-color-blue">Stay length&nbsp;&nbsp;</label><span>'+ Acco_StayLength +'</span></div>');
        }
        if(Acco_EarlyAvailable != "")
        {
            $(".accomm_stay_availability").append('<div class="m-b-10 add-title"><label class="text-color-blue">Early available date</label><br><span>'+ Acco_EarlyAvailable +'</span></div>');
        }
        
        if(Acco_Smoking != "" || Acco_PetsAllowed != "")
        {
            $(".short-info").append('<div class="form-group add-title"><label class="label-title text-color-purple">Preferences</label><div class="form-group add-title short_warp_style"><div class="m-b-10 add-title accomm_preferences"></div></div></div>');
        }

        if(Acco_Smoking != "")
        {
            $(".accomm_preferences").append('<div class="m-b-10 add-title"><label class="text-color-blue">Smoking preferances&nbsp;&nbsp;</label><span>'+ Acco_Smoking +'</span></div>');
        }         
        if(Acco_PetsAllowed != "")
        {
            $(".accomm_preferences").append('<div class="m-b-10 add-title"><label class="text-color-blue">Pets allowed</label>&nbsp;&nbsp;<span>'+ Acco_PetsAllowed +'</span></div>');
        }

        if(checkarray.length > 0 || checkarrayC.length > 0)
        {
            $(".short-info").append('<div class="form-group add-title"><label class="label-title text-color-purple">Preferences</label><div class="form-group add-title short_warp_style"><div class="m-b-10 add-title accomm_property_features"></div></div></div>');
        }

        if(checkarray.length > 0)
        {
            $(".accomm_property_features").append('<div class="m-b-10 add-title Acco_amenities_warp"><label class="text-color-blue">Property amenities</label><br></div>');
            for (let index = 0; index < checkarray.length; index++) {                
                $(".Acco_amenities_warp").append('<span class="provider_item item_border_style">'+ checkarray[index] +'</span>');         
            }
        } 

        if(checkarrayC.length > 0)
        {
            $(".accomm_property_features").append('<div class="m-b-10 add-title Acco_nearto_warp"><label class="text-color-blue">Property near to</label><br></div>');
            $(".added_complex_Acco .post_complex_val").each(function(){
                $(".Acco_nearto_warp").append('<span class="provider_item item_border_style">'+ $(this).val() +'</span>');
            });
        }

          
        if(Acco_AccommodationType == "" && Acco_BedRooms == "" && Acco_BathRooms =="" && Acco_utilities =="" && Acco_AvailableFor_num == 0 && Acco_StayLength == "" && Acco_EarlyAvailable == "" && Acco_sale_detail == "" && Acco_Smoking == "" && Acco_PetsAllowed == "" && Acco_PostedBy == "" && checkarray.length == 0 && checkarrayC.length == 0)
        {
            $(".short-info").append('<div class="add-title"><h6 class="text-color-blue fs-14">Not provided</h6></div>');
        }
        return true;
    }

    function  RealEstate()
    {
        showTitleDescprition()
        showImageSlider();
        showTitleAddress();
        reDrawMap(); 
        showReply();   
        var Real_listedby = $("#Real_listedby").val();
        var Real_condition = $("#Real_condition").val();
        var Real_utilities = $("#Real_utilities").val();

        if(Real_listedby != "")
        {
            $(".short-info").append('<div class="add-title m-b-15"><label class="text-color-blue">Listed by</label>&nbsp;<span>'+ Real_listedby +'</span></div>');
        }
        if(Real_condition != "")
        {
            $(".short-info").append('<div class="add-title m-b-15"><label class="text-color-blue">Property type</label>&nbsp;<span>'+ Real_condition +'</span></div>');
        }
        if(Real_utilities != "")
        {
            $(".short-info").append('<div class="add-title m-b-15"><label class="text-color-blue">Property Cost/Sale Price</label><div><p>'+ Real_utilities +'</p></div></div>');
        }

        if(checkarrayC.length > 0)
        {
            $(".short-info").append('<div class="m-b-10 add-title Real_nearto_warp"><label class="text-color-blue">Property near to</label><br></div>');
            $(".added_complex_Real .post_complex_val").each(function(){
                $(".Real_nearto_warp").append('<span class="provider_item item_border_style">'+ $(this).val() +'</span>');
            });
        }

        if(checkarray.length > 0)
        {
            $(".short-info").append('<div class="m-b-15 add-title Real_amenities_warp"><label class="text-color-blue ">Property amenities</label><br></div>');
            for (let index = 0; index < checkarray.length; index++) {                
                $(".Real_amenities_warp").append('<span class="provider_item item_border_style">'+ checkarray[index] +'</span>');         
            }              
        } 

        if(Real_listedby == "" && Real_condition == "" && Real_utilities =="" && checkarrayC.length == 0 && checkarray.length == 0)
        {
            $(".short-info").append('<div class="add-title"><h6 class="text-color-blue fs-14">Not provided</h6></div>');
        }
        return true;
    }

    function LocalContractors()
    {
        showTitleDescprition()
        showImageSlider();
        showTitleAddress();
        reDrawMap(); 
        showReply();   
        var Contractors_provider_name = $("#Contractors_provider_name").val();
        var Contractors_estimated_rent = $("#Contractors_estimated_rent").val();
        
        if(Contractors_provider_name !="")
        {
            $(".short-info").append('<div class="m-b-10 add-title"><label class="text-color-blue">Business/Contractor Name</label><p>'+ Contractors_provider_name +'</p></div>');
        }
        
        if(checkarray.length > 0)
        {
            $(".short-info").append('<div class="m-b-10 add-title Contractors_provide_warp"><label class="text-color-blue">Service provide</label><br></div>');
            for (let index = 0; index < checkarray.length; index++) {                
                $(".Contractors_provide_warp").append('<span class="provider_item item_border_style">'+ checkarray[index] +'</span>');         
            }              
        }

        if(Contractors_estimated_rent !="")
        {
            $(".short-info").append('<div class="m-b-10 add-title"><label class="text-color-blue">Business Hours</label><p>'+ Contractors_estimated_rent +'</p></div>');
        }
        
        if(Contractors_provider_name =="" && Contractors_estimated_rent =="" && Contractors_listedby =="" && checkarray.length < 1)
        {
            $(".short-info").append('<div class="add-title"><h6 class="text-color-blue fs-14">Not provided</h6></div>');
        }
    }

    function Repairs()
    {
        showTitleDescprition()
        showImageSlider();
        showTitleAddress();
        reDrawMap(); 
        showReply();
        var Repairs_provider_name = $("#Repairs_provider_name").val();
        var Repairs_estimated_rent = $("#Repairs_estimated_rent").val();
        
        if(Repairs_provider_name !="")
        {
            $(".short-info").append('<div class="form-group add-title"><label class="text-color-blue">Service provider</label><div><p>'+ Repairs_provider_name +'</p></div></div>');
        }
        if(checkarray.length > 0)
        {
            $(".short-info").append('<div class="m-b-10 add-title Repairs_provide_warp"><label class="text-color-blue">Services Provide</label><br></div>');
            for (let index = 0; index < checkarray.length; index++) {                
                $(".Repairs_provide_warp").append('<span class="provider_item item_border_style">'+ checkarray[index] +'</span>');         
            }              
        }

        if(Repairs_estimated_rent !="")
        {
            $(".short-info").append('<div class="form-group add-title"><label class="text-color-blue">Business Hours</label><div><span>'+ Repairs_estimated_rent +'</span></div></div>');
        }
        
        if(Repairs_provider_name =="" && Repairs_estimated_rent =="" && Repairs_utilities =="" && checkarray.length < 1)
        {
            $(".short-info").append('<div class="add-title"><h6 class="text-color-blue fs-14">Not provided</h6></div>');
        }
    }

    function LocalEvents()
    {
        showTitleDescprition()
        showImageSlider();
        showTitleAddress();
        reDrawMap();
        showReply(); 
        var Community_utilities = $("#Community_utilities").val();
        var Community_event_start_date = $(".Community_event_start_date").val();
        var Community_event_end_date = $(".Community_event_end_date").val();
        var Community_special_guests_attending = $(".Community_special_guests_attending").val();
        var Community_eventfair_tickets = $(".Community_eventfair_tickets").val();

        if(Community_utilities !="")
        {
            $(".short-info").append('<div class="m-b-15 add-title"><label class="text-color-blue">Event/Fair Organizers</label><div><p>'+ Community_utilities +'</p></div></div>');
        }
        if(Community_event_start_date !="")
        {
            $(".short-info").append('<div class="m-b-15 add-title"><label class="text-color-blue">Event Start Date</label>&nbsp;<span>'+ Community_event_start_date +'</span></div>');
        }
        if(Community_event_end_date !="")
        {
            $(".short-info").append('<div class="m-b-15 add-title"><label class="text-color-blue">Event End Date</label>&nbsp;<span>'+ Community_event_end_date +'</span></div>');
        }
        if(Community_special_guests_attending !="")
        {
            $(".short-info").append('<div class="m-b-15 add-title"><label class="text-color-blue">Special Guests Attending</label><div><p>'+ Community_special_guests_attending +'</p></div></div>');
        }
        if(Community_eventfair_tickets !="")
        {
            $(".short-info").append('<div class="m-b-15 add-title"><label class="text-color-blue">Event/Fair tickets cost if any</label><div><p>'+ Community_eventfair_tickets +'</p></div></div>');
        }
        if(Community_utilities =="" && Community_event_start_date =="" && Community_event_end_date =="" && Community_special_guests_attending =="" && Community_eventfair_tickets =="")
        {
            $(".short-info").append('<div class="add-title"><h6 class="text-color-blue fs-14">Not provided</h6></div>');
        }
    }

    function LegalLawyers()
    {
        showTitleDescprition()
        showImageSlider();
        showTitleAddress();
        reDrawMap(); 
        showReply();
        var Legal_firm_name = $("#Legal_firm_name").val();
        var Legal_estimated_rent = $("#Legal_estimated_rent").val();
        if(Legal_firm_name !="")
        {
            $(".short-info").append('<div class="form-group add-title"><label class="text-color-blue">Lawyer/Law Firm Name</label><div><p>'+ Legal_firm_name +'</p></div></div>');
            
        }

        if(checkarray.length > 0)
        {
            $(".short-info").append('<div class="m-b-10 add-title Legal_provide_warp"><label class="text-color-blue">Services provide</label><br></div>');
            for (let index = 0; index < checkarray.length; index++) {                
                $(".Legal_provide_warp").append('<span class="provider_item item_border_style">'+ checkarray[index] +'</span>');         
            }              
        }

        if(Legal_estimated_rent !="")
        {
            $(".short-info").append('<div class="form-group add-title"><label class="text-color-blue">Business Hours</label><div><p>'+ Legal_estimated_rent +'</p></div></div>');
        }

        if(Legal_firm_name =="" && Legal_estimated_rent =="" && checkarray.length < 1)
        {
            $(".short-info").append('<div class="add-title"><h6 class="text-color-blue fs-14">Not provided</h6></div>');
        }
    }

    function InstructorsLessons()
    {
        showTitleDescprition()
        showImageSlider();
        showTitleAddress();
        reDrawMap(); 
        showReply();
        var Tutoring_provider_name = $("#Tutoring_provider_name").val();
        var Tutoring_estimated_rent = $("#Tutoring_estimated_rent").val();
        var Tutoring_utilities = $("#Tutoring_utilities").val();
        var Tutoring_duration = $(".Tutoring_duration").val();
        var Tutoring_start_date = $(".Tutoring_start_date").val();        
        var Tutoring_required = $(".Tutoring_required").val(); 
        var Tutoring_mode_num = 0;      
        if(Tutoring_provider_name !="")
        {
            $(".short-info").append('<div class="m-b-10 add-title"><label class="text-color-blue">Instructor/Institute</label><p>'+ Tutoring_provider_name +'</p></div>');
            
        }

        if(checkarray.length > 0)
        {
            $(".short-info").append('<div class="m-b-10 add-title Tutoring_provide_warp"><label class="text-color-blue">Training/ Courses offer</label><br></div>');
            for (let index = 0; index < checkarray.length; index++) {                
                $(".Tutoring_provide_warp").append('<span class="provider_item item_border_style">'+ checkarray[index] +'</span>');         
            }              
        }

        $(".Tutoring_subcategory_check_item").each(function()
        {            
            if(this.checked == true)
            {
                Tutoring_mode_num++;
            }
        });

        if(Tutoring_mode_num > 0)
        {
            $(".short-info").append('<div class="m-b-10 add-title Tutoring_mode_warp"><label class="text-color-blue">Instruction/Training mode</label><br></div>');
            $(".Tutoring_subcategory_check_item").each(function()
            {                        
                $(".Tutoring_mode_warp").append('<span class="provider_item item_border_style">'+ $(this).val() +'</span>');         
            });      
        }

        if(Tutoring_estimated_rent !="")
        {
            $(".short-info").append('<div class="m-b-10 add-title"><label class="text-color-blue">Instruction/Training times</label><p>'+ Tutoring_estimated_rent +'</p></div>');
            
        }

        if(Tutoring_utilities !="")
        {
            $(".short-info").append('<div class="m-b-10 add-title"><label class="text-color-blue">Instructor/Training fee</label><p>'+ Tutoring_utilities +'</p></div>');
            
        }

        if(Tutoring_start_date !="")
        {
            $(".short-info").append('<div class="m-b-10 add-title"><label class="text-color-blue">Expected Start date</label>&nbsp;<span>'+ Tutoring_start_date +'</span></div>');
            
        }
         if(Tutoring_duration !="")
        {
            $(".short-info").append('<div class="m-b-10 add-title"><label class="text-color-blue">Course/Training Duration</label>&nbsp;<span>'+ Tutoring_duration +'months</span></div>');
            
        }
       
        if(Tutoring_required !="")
        {
            $(".short-info").append('<div class="m-b-10 add-title"><label class="text-color-blue">Any Pre-requisites required</label><p>'+ Tutoring_required +'</p></div>');            
        }

        if(Tutoring_provider_name =="" && Tutoring_estimated_rent =="" && Tutoring_utilities =="" && Tutoring_duration =="" && Tutoring_start_date =="" && Tutoring_required =="" && checkarray.length < 1)
        {
            $(".short-info").append('<div class="add-title"><h6 class="text-color-blue fs-14">Not provided</h6></div>');
        }

    }
    function Research()
    {
        showTitleDescprition()
        showImageSlider();
        showTitleAddress();
        reDrawMap(); 
        showReply();
        var Research_listedby = $(".Research_listedby").val();
        var Research_utilities = $("#Research_utilities").val();
        if(Research_listedby !="")
        {
            $(".short-info").append('<div class="add-title m-b-15"><label class="text-color-blue">Research Sponsers</label><div><p>'+ Research_listedby +'</p></div></div>');
        }
        if(Research_utilities !="")
        {
            $(".short-info").append('<div class="add-title"><label class="text-color-blue">Compensation</label><p>'+ Research_utilities +'</p></div>');
        }
        if(Research_listedby =="" && Research_utilities =="")
        {
            $(".short-info").append('<div class="add-title"><h6 class="text-color-blue fs-14">Not provided</h6></div>');
        }
        return true;
    }

    function Rent()
    {
        showTitleDescprition()
        showImageSlider();
        showTitleAddress();
        reDrawMap();
        showReply();
        var Rent_provider_name = $(".Rent_provider_name").val();
        var Rent_utilities = $("#Rent_utilities").val();
        var Rent_condition = $("#Rent_condition").val();
        var Rent_listedby = $("#Rent_listedby").val();
        if(Rent_provider_name !="")
        {
            $(".short-info").append('<div class="m-b-15 add-title"><label class="text-color-blue">I have</label><div class=""><span>'+ Rent_provider_name +'</span></div></div>');
        }
        if(Rent_utilities !="")
        {
            $(".short-info").append('<div class="m-b-15 add-title"><label class="text-color-blue">Cost</label><div class=""><span>'+ Rent_utilities +'</span></div></div>');
        }
        if(Rent_condition !="")
        {
            $(".short-info").append('<div class="m-b-15 add-title"><label class="text-color-blue">Ready for</label>&nbsp;<span>'+ Rent_condition +'</span></div>');
        }
        if(Rent_listedby !="")
        {
            $(".short-info").append('<div class="m-b-15 add-title"><label class="text-color-blue">Listed by</label>&nbsp;<span>'+ Rent_listedby +'</span></div>');
        }
        return true;
    }

    function Employers()
    {
        showTitleDescprition()
        showImageSlider();
        showTitleAddress();
        reDrawMap();
        showReply();
        var Employers_provider_name = $("#Employers_provider_name").val();
        var Employers_estimated_rent = $("#Employers_estimated_rent").val();
        
        if(Employers_provider_name !="")
        {
            $(".short-info").append('<div class="m-b-15 add-title"><label class="text-color-blue">Client/Recruiter</label><div class=""><span>'+ Employers_provider_name +'</span></div></div>');
        }

        if(checkarray.length > 0)
        {
            $(".short-info").append('<div class="m-b-10 add-title Employers_with_warp"><label class="text-color-blue">Our clients</label><br></div>');
            for (let index = 0; index < checkarray.length; index++) {                
                $(".Employers_with_warp").append('<span class="provider_item item_border_style">'+ checkarray[index] +'</span>');         
            }
        } 

        if(checkarrayC.length > 0)
        {
            $(".short-info").append('<div class="m-b-10 add-title Employers_services_warp"><label class="text-color-blue">Services we provide</label><br></div>');
            $(".added_complex_Employers .post_complex_val").each(function(){
                $(".Employers_services_warp").append('<span class="provider_item item_border_style">'+ $(this).val() +'</span>');
            });
        }
        if(Employers_estimated_rent !="")
        {
            $(".short-info").append('<div class="form-group add-title"><label class="text-color-blue">Business Hours</label><div><p>'+ Employers_estimated_rent +'</p></div></div>');
        }
       
        if(Employers_provider_name =="" && Employers_estimated_rent =="" && checkarray.length < 1 && checkarrayC.length < 1)
        {
            $(".short-info").append('<div class="add-title"><h6 class="text-color-blue fs-14">Not provided</h6></div>');
        }
    }

    function Matrimonies()
    {  
        showImageSlider();
        showTitleDescprition();
        showMatrimoniesDetail();
        showTitleAddress();
        reDrawMap();
        showReply();
        
        var Matrimonies_select_option = $(".Matrimonies_select_option").val();
        var Matrimonies_createdby = $(".Matrimonies_createdby").val();
        var Matrimonies_name = $(".Matrimonies_name").val();
        var Matrimonies_age = $(".Matrimonies_age").val();
        var Matrimonies_sex = $(".Matrimonies_sex").val();
        var Matrimonies_marital_status = $(".Matrimonies_marital_status").val();
        var Matrimonies_weight = $(".Matrimonies_weight").val();
        var Matrimonies_height = $(".Matrimonies_height").val();
        var Matrimonies_skin_color = $(".Matrimonies_skin_color").val();
        var Matrimonies_hair_color = $(".Matrimonies_hair_color").val();
        var Matrimonies_body_style = $(".Matrimonies_body_style").val();
        $(".short-info").append('<div class="m-b-10 add-title"><label class="text-color-blue m-t-20">Basic Information</label><div class="Matrimonies_basic_warp short_warp_style"></div></div>');
        if(Matrimonies_select_option !="")
        {
            $(".Matrimonies_basic_warp").append('<p>'+ Matrimonies_select_option +'</p>');
        }
        if(Matrimonies_createdby !="")
        {
            $(".Matrimonies_basic_warp").append('<p><span class="text-color-blue width-150">Created by</span>'+ Matrimonies_createdby +'</p>');
        }
        if(Matrimonies_name !="")
        {
            $(".Matrimonies_basic_warp").append('<p><span class="text-color-blue width-150">Your Name</span>'+ Matrimonies_name +'</p>');
        }
        if(Matrimonies_age !="")
        {
            $(".Matrimonies_basic_warp").append('<p><span class="text-color-blue width-150">Age</span>'+ Matrimonies_age +'</p>');
        }
        if(Matrimonies_sex !="")
        {
            $(".Matrimonies_basic_warp").append('<p><span class="text-color-blue width-150">Sex</span>'+ Matrimonies_sex +'</p>');
        }
        if(Matrimonies_marital_status !="")
        {
            $(".Matrimonies_basic_warp").append('<p><span class="text-color-blue width-150">Marital Status</span>'+ Matrimonies_marital_status +'</p>');
        }
        if(Matrimonies_weight !="")
        {
            $(".Matrimonies_basic_warp").append('<p><span class="text-color-blue width-150">Weight</span>'+ Matrimonies_weight +'</p>');
        }
        if(Matrimonies_height !="")
        {
            $(".Matrimonies_basic_warp").append('<p><span class="text-color-blue width-150">Height</span>'+ Matrimonies_height +'</p>');
        }
        if(Matrimonies_skin_color !="")
        {
            $(".Matrimonies_basic_warp").append('<p><span class="text-color-blue width-150">Skin Color</span>'+ Matrimonies_skin_color +'</p>');
        }
        if(Matrimonies_hair_color !="")
        {
            $(".Matrimonies_basic_warp").append('<p><span class="text-color-blue width-150">Hair Color</span>'+ Matrimonies_hair_color +'</p>');
        }
        if(Matrimonies_body_style !="")
        {
            $(".Matrimonies_basic_warp").append('<p><span class="text-color-blue width-150">Body Style</span>'+ Matrimonies_body_style +'</p>');
        }
        $(".short-info").append('<div class="add-title m-b-15"><div><label class="text-color-blue">Contact Details</label></div><div class="border_top p-t-10"><a href="javascript:;" class="request_contact btn-disable" data-toggle="tooltip" data-placement="top" title="Please Login">Request Contact</a></div></div>');
    }

    function Missing()
    {
        showTitleDescprition()
        showImageSlider();
        showTitleAddress();
        reDrawMap();
        showReply();
        var missing_num = 0;
        var found_num = 0;
        $(".short-info").append('<div class="add-title missing_part"><label class="text-color-blue">Items Found/Lost</label></div>');
        $(".missing_item").each(function(){           
            if($(this).hasClass("Lost"))
            {
                 missing_num++;                 
            }
            if($(this).hasClass("Found"))
            {
                found_num++;                
            }
        });
        if(found_num > 0)
        {
            $(".missing_part").append('<div class="found_wrap"><p class="m-t-20"><span class="missing_found">Found</span></p><p><span>(Item-Est.Value-Date-Location)</span></p></div>');
            var jj=0;
            $(".missing_item.Found").each(function(){
                jj++;
                $(".found_wrap").append('<div><h3 class="title" style="margin-top:10px;margin-bottom:0px;">Item-'+ jj +'</h3><span class="provider_item item_border_style">'+ $(this).find(".skill_name_span").html() +'</span><span class="provider_item item_border_style">'+ $(this).find(".skill_value_span").html() +'</span><span class="provider_item item_border_style">'+ $(this).find(".skill_date_span").html() +'</span><span class="provider_item item_border_style">'+ $(this).find(".skill_location_span").html() +'</span></div>');
            });
            
        }
        if(missing_num > 0)
        {
            $(".missing_part").append('<div class="missing_wrap"><p class="m-t-20"><span class="missing_lost">Lost</span></p><p><span>(Item-Est.Value-Date-Location)</span></p></div>');
            var ii=0;            
            $(".missing_item.Lost").each(function(){
                ii++;
                $(".missing_part").append('<div><h3 class="title" style="margin-top:10px;margin-bottom:0px;">Item-'+ ii +'</h3><span class="provider_item item_border_style">'+ $(this).find(".skill_name_span").html() +'</span><span class="provider_item item_border_style">'+ $(this).find(".skill_value_span").html() +'</span><span class="provider_item item_border_style">'+ $(this).find(".skill_date_span").html() +'</span><span class="provider_item item_border_style">'+ $(this).find(".skill_location_span").html() +'</span></div>');
            });
        }        
    }

    function Agents()
    {
        showTitleDescprition()
        showImageSlider();
        showTitleAddress();
        reDrawMap();
        showReply();
        var Agents_provider_name = $("#Agents_provider_name").val();
        var Agents_estimated_rent = $("#Agents_estimated_rent").val();
        
        if(Agents_provider_name !="")
        {
            $(".short-info").append('<div class="m-b-15 add-title"><label class="text-color-blue">Agent/Service provider name</label><p>'+ Agents_provider_name +'</p></div>');
        }
        
        if(checkarrayC.length > 0)
        {
            $(".short-info").append('<div class="m-b-10 add-title Agents_services_warp"><label class="text-color-blue">What services you provide?</label><br></div>');
            $(".added_complex_Agents .post_complex_val").each(function(){
                $(".Agents_services_warp").append('<span class="provider_item item_border_style">'+ $(this).val() +'</span>');
            });
        }

        if(Agents_estimated_rent !="")
        {
            $(".short-info").append('<div class="m-b-15 add-title"><label class="text-color-blue">Business Hours</label><p>'+ Agents_estimated_rent +'</p></div>');
        }

        if(Agents_provider_name =="" && Agents_estimated_rent =="" && Agents_listedby =="" && checkarrayC.length < 1)
        {
            $(".short-info").append('<div class="add-title"><h6 class="text-color-blue fs-14">Not provided</h6></div>');
        }

        return true;
    }

    function Fashion()
    {
        showTitleDescprition()
        showImageSlider();
        showTitleAddress();
        reDrawMap();
        showReply();
        var Fashion_provider_name = $("#Fashion_provider_name").val();
        var Fashion_estimated_rent = $("#Fashion_estimated_rent").val();
        if(Fashion_provider_name !="")
        {
            $(".short-info").append('<div class="m-b-15 add-title"><label class="text-color-blue">Shop/Service provider</label><p>'+ Fashion_provider_name +'</p></div>');
        }

        if(checkarray.length > 0)
        {
            $(".short-info").append('<div class="m-b-10 add-title Fashion_service_warp"><label class="text-color-blue">Services we provide</label><br></div>');
            for (let index = 0; index < checkarray.length; index++) {                
                $(".Fashion_service_warp").append('<span class="provider_item item_border_style">'+ checkarray[index] +'</span>');         
            }
        } 

        if(Fashion_estimated_rent !="")
        {
            $(".short-info").append('<div class="m-b-15 add-title"><label class="text-color-blue">Business Hours</label><p>'+ Fashion_estimated_rent +'</p></div>');
        }
        if(Fashion_provider_name =="" && Fashion_estimated_rent && checkarray.length < 1)
        {
            $(".short-info").append('<div class="add-title"><h6 class="text-color-blue fs-14">Not provided</h6></div>');
        }
    }    

    function Accountants()
    {
        showTitleDescprition()
        showImageSlider();
        showTitleAddress();
        reDrawMap();
        showReply();
        var Accountants_provider_name = $("#Accountants_provider_name").val();
        var Accountants_estimated_rent = $("#Accountants_estimated_rent").val();
        var Accountants_utilities = $("#Accountants_utilities").val();
        if(Accountants_provider_name !="")
        {
            $(".short-info").append('<div class="form-group add-title"><label class="text-color-blue">CPA/Accounting firm name</label><p>'+ Accountants_provider_name +'</p></div>');
        }
        
        if(checkarray.length > 0)
        {
            $(".short-info").append('<div class="m-b-10 add-title Accountants_with_warp"><label class="text-color-blue">What services you provide?</label><br></div>');
            for (let index = 0; index < checkarray.length; index++) {                
                $(".Accountants_with_warp").append('<span class="provider_item item_border_style">'+ checkarray[index] +'</span>');         
            }
        } 

        if(Accountants_utilities !="")
        {
            $(".short-info").append('<div class="form-group add-title"><label class="text-color-blue">Business hours</label><p>'+ Accountants_utilities +'</p></div>');
        }

        if(Accountants_estimated_rent !="")
        {
            $(".short-info").append('<div class="form-group add-title"><label class="text-color-blue">Consultation/Service fee</label><p>'+ Accountants_estimated_rent +'</p></div>');
        }        
        
    }

    function Adaption()
    {
        showTitleDescprition()
        showImageSlider();
        showTitleAddress();
        reDrawMap();
        showReply();
        var Adaption_provider_name = $("#Adaption_provider_name").val();
        var Adaption_breed_species = $("#Adaption_breed_species").val();
        var Adaption_age = $("#Adaption_age").val();
        var Adaption_color = $("#Adaption_color").val();
        var Adaption_size = $("#Adaption_size").val();
        var Adaption_weight = $("#Adaption_weight").val();
        var Adaption_sex = $("#Adaption_sex").val();
        var Adaption_num = 0;
        if(Adaption_provider_name !="")
        {
            $(".short-info").append('<div class="m-b-10 add-title"><label class="text-color-blue">Contact Person</label><p>'+ Adaption_provider_name +'</p></div>');            
        }
        $(".Adaption").each(function(){
            if($(this).val() !="")
            {
                Adaption_num++;
            }
        });
        if(Adaption_num > 0)
        {
            $(".short-info").append('<div class="form-group add-title"><label class="label-title text-color-blue">Pet information</label><div class="form-group add-title Adaption_warp" style="border:1px solid #dedede;padding:10px;"></div></div>');      
            if(Adaption_breed_species !="")
            {
                $(".Adaption_warp").append('<p style="display:inline-block;" class="m-r-5"><label class="m-r-5 text-color-blue">Breed/Species</label><span class="fw-500">'+ Adaption_breed_species +'</span></p>&nbsp;&nbsp;');
            }
            if(Adaption_age !="")
            {
                $(".Adaption_warp").append('<p style="display:inline-block;" class="m-r-5"><label class="m-r-5 text-color-blue">Age</label><span class="fw-500">'+ Adaption_age +'</span></p>&nbsp;&nbsp;');
            }
            if(Adaption_color !="")
            {
                $(".Adaption_warp").append('<p style="display:inline-block;" class="m-r-5"><label class="m-r-5 text-color-blue">Color</label><span class="fw-500">'+ Adaption_color +'</span></p>&nbsp;&nbsp;');
            }
            if(Adaption_size !="")
            {
                $(".Adaption_warp").append('<p style="display:inline-block;" class="m-r-5"><label class="m-r-5 text-color-blue">Size</label><span class="fw-500">'+ Adaption_size +'</span></p>&nbsp;&nbsp;');
            }
            if(Adaption_weight !="")
            {
                $(".Adaption_warp").append('<p style="display:inline-block;" class="m-r-5"><label class="m-r-5 text-color-blue">Weight</label><span class="fw-500">'+ Adaption_weight +'</span></p>&nbsp;&nbsp;');
            }
            if(Adaption_sex !="")
            {
                $(".Adaption_warp").append('<p style="display:inline-block;" class="m-r-5"><label class="m-r-5 text-color-blue">Sex</label><span class="fw-500">'+ Adaption_sex +'</span></p>&nbsp;&nbsp;');
            }
        }
        if(Adaption_provider_name =="" && Adaption_num < 1)
        {
            $(".short-info").append('<div class="add-title"><h6 class="text-color-blue fs-14">Not provided</h6></div>');
        }

        return true;
    }
    // -------------------------------------------------------------

    // -------------------------------------------------------------
    //  Placeholder
    // -------------------------------------------------------------

    (function() {

        var textAreas = document.getElementsByTagName('textarea');

        Array.prototype.forEach.call(textAreas, function(elem) {
            elem.placeholder = elem.placeholder.replace(/\\n/g, '\n');
        });

    }());

    

    // -------------------------------------------------------------
    //  Show 
    // -------------------------------------------------------------

    (function() {       

        $("document").ready(function()
            {
                 $(".more-category.one").hide();
                $(".show-more.one").click(function()
                    {
                        $(".more-category.one").show();
                        $(".show-more.one").hide();
                    });
            });

        $("document").ready(function()
            {
                 $(".more-category.two").hide();
                $(".show-more.two").click(function()
                    {
                        $(".more-category.two").show();
                        $(".show-more.two").hide();
                    });
            });

        $("document").ready(function()
            {
                 $(".more-category.three").hide();
                $(".show-more.three").click(function()
                    {
                        $(".more-category.three").show();
                        $(".show-more.three").hide();
                    });
            });       
    }());    
    

    // -------------------------------------------------------------
    //  Slider
    // -------------------------------------------------------------

    (function() {

        // $('#price').slider();

    }());   
	
	
   
    
    // -------------------------------------------------------------
    //  language Select
    // -------------------------------------------------------------

   (function() {

        $('.language-dropdown').on('click', '.language-change a', function(ev) {
            if ("#" === $(this).attr('href')) {
                ev.preventDefault();
                var parent = $(this).parents('.language-dropdown');
                parent.find('.change-text').html($(this).html());
            }
        });

        $('.category-dropdown').on('click', '.category-change a', function(ev) {
            if ("#" === $(this).attr('href')) {
                ev.preventDefault();
                var parent = $(this).parents('.category-dropdown');
                parent.find('.change-text').html($(this).html());
            }
        });

    }());

    (function() {
    
        $(".sub_category").change(function(){
            $(".search-form").submit();
        }); 
        $(".auto_submit").keyup(function(e){
            if(e.keyCode == 13)
            {
                $(".search-form").submit();
            }
        });  
       
    }());
    
    // -------------------------------------------------------------
    //  Tooltip
    // -------------------------------------------------------------

    (function() {

        $('[data-toggle="tooltip"]').tooltip();

    }());


    // -------------------------------------------------------------
    // Accordion
    // -------------------------------------------------------------

        (function () {  
            $('.collapse').on('show.bs.collapse', function() {
                var id = $(this).attr('id');
                $('a[href="#' + id + '"]').closest('.panel-heading').addClass('active-faq');
                $('a[href="#' + id + '"] .panel-title span').html('<i class="fa fa-minus"></i>');
            });

            $('.collapse').on('hide.bs.collapse', function() {
                var id = $(this).attr('id');
                $('a[href="#' + id + '"]').closest('.panel-heading').removeClass('active-faq');
                $('a[href="#' + id + '"] .panel-title span').html('<i class="fa fa-plus"></i>');
            });
        }());


    // -------------------------------------------------------------
    //  Checkbox Icon Change
    // -------------------------------------------------------------

    (function () {

        $('input[type="checkbox"]').change(function(){
            if($(this).is(':checked')){
                $(this).parent("label").addClass("checked");
            } else {
                $(this).parent("label").removeClass("checked");
            }
        });

    }()); 
	
	
	
    // ========================Select_Category_Part=============================
    (function () {
       
        var total = 0;
        
        $(document).on('change','.subcategoryselect', function (){
            
            var this_price = parseFloat($(this).data('price'));
            
            var status = $(this).val();		
            if ($(this).is(":checked"))
            {
                total = parseFloat(total) + this_price;                
            }
            else
            {
                total = parseFloat(total) - this_price;
            }	
            total = total.toFixed(2);            	
            var stotal = "$" + total;
            $("#total").val(stotal);
            var checked_num = 0;
            $(".subcategoryselect").each(function(){
                if(this.checked == true)
                {
                    checked_num++;
                }
            });
            
            if(checked_num > 0)            
            {
                $(".classified_details").removeAttr("disabled");        
            }
            else
            {
                $(".classified_details").attr("disabled","disabled");       

            }
        })	

    }());

    // (function () {
    //     $(document).on("click","#cat-scroll ul li",function(){

    //     });
    // }());
    // -------------------------------------------------------------
    //  select-category Change
    // -------------------------------------------------------------
	$('#categoryList ul li a').on('click', function() {
        
        var cur_categoryID = $(".cur_categoryID").val();
        sel_categoryID = $(this).data('value');
       
        total_price = parseFloat($(this).data('price'));
        var thisobj = $(this).parent();
       
        if(cur_categoryID != sel_categoryID)
        {
            if((cur_categoryID != "") && post_edit_status)
            {
                
                $.confirm({
                    title: 'Confirm!',
                    content: 'If you change category, you will loose the inputted data!',
                    buttons: {
                        confirm: function () { 
                            post_edit_status = false;
                            $.cookie('sel_categoryID',sel_categoryID);
                            location.reload();                            
                        },
                        cancel: function () {
                            return true;
                        }
                    }
                });      
            }  
            else
            {         
                initInputPage();
                showSubCategory(sel_categoryID,thisobj);
            }                    
        }
        else
        {            
            return false;
        } 
	});

	$('.subcategory.post-option ul li a').on('click', function() {
		$('.subcategory.post-option ul li.link-active').removeClass('link-active');
		$(this).closest('li').addClass('link-active');
	});
    
    // --------------------------------------------------------------
    // -------------------------------------------------------------
    //   Show Mobile Number
    // -------------------------------------------------------------  

    (function () {

        $('.show-number').on('click', function() {
            $('.hide-text').fadeIn(500, function() {
              $(this).addClass('hide');
            });  
			$('.hide-number').fadeIn(500, function() {
              $(this).addClass('show');
            }); 			
        });


    }());
    
    // ====================================================================
    (function (){
        var cookieList = function(cookieName) {
                
        var cookie = $.cookie(cookieName);
        
        var items = cookie ? cookie.split(/,/) : new Array();                
        
        return {
            "add": function(val) {                       
                items.push(val);                        
                $.cookie(cookieName, items.join(','));
            },
            "remove": function (val) { 
                
                indx = items.indexOf(val); 
                if(indx!=-1) items.splice(indx, 1); 
                $.cookie(cookieName, items.join(','));        },
            "clear": function() {
                items = null;
                
                $.cookie(cookieName, null);
            },
            "items": function() {
                
                return items;
            }
            }
        }
        var list = new cookieList("MyItems");
        $(".get_pid").on('click',function(){
            $(this).find(".common_post_title").addClass("text-color-purple");
            var pIDtemp = new Array();
            var check_pID = 0;
            var pID = $(this).attr('data_pid');
            
            $("a.get_pid").each(function(){
                var cur_pID = $(this).attr('data_pid');
                    
                if(pID == cur_pID)
                {
                    $(this).find(".common_post_title").addClass("text-color-purple");
                }
                
            });
           
            for (let index = 0; index < list.items().length; index++) {
                
                if(list.items()[index] == pID)
                {
                    check_pID++;
                }
            }
            if(check_pID < 1)
            {
                list.add(pID); 
            }
        });
       
        $("a.get_pid").each(function(){
            var cur_pID = $(this).attr('data_pid');
            for (let index = 0; index < list.items().length; index++) {
                
                if(list.items()[index] == cur_pID)
                {
                    $(this).find(".common_post_title").addClass("text-color-purple");
                }
            }
        });
    }());
    // --------------------------------------------------------------------
    (function (){
        var cur_url      = window.location.href;
        $("#cur_path").val(cur_url);
        $(".btn_report_share").click(function(){           
            
            var copyText = document.getElementById("cur_path");
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            document.execCommand("copy");

            $(".alert_share").fadeIn();
            $(".alert_share").fadeOut(4000);            
        });

        $(".btn-copy-link").click(function(){           
            
            var copyText = document.getElementById("copy_link");
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            document.execCommand("copy");

            $(".alert_copy_link").fadeIn();
            $(".alert_copy_link").fadeOut(4000);            
        });

        $(".btn-show-phone-number").click(function(){
            $("*").css("cursor", "wait");
            var post_id = $(this).data("value");
            var formdata = new FormData;
            formdata.append('post_id',post_id);
            formdata.append('_token',$('input[name=_token]').val());    
            $.ajax({
                url: "/getphonenumber",
                type: "post",
                dataType: "json",
                data: formdata,
                processData: false,
                contentType: false,
                success: function(result){
                    $(".show-phone-number-dot").css("display","inline-block");
                    $(".show-phone-number").html(result.result);
                    $("*").css("cursor", "default");
                }
            });
        });
    }());
    // --------------------------------------------------------------------
    (function () {        
        $('.tablinks').removeClass('text-color-green');
        switch ($.cookie('con')) {
            case "0":
                $(".tabcontent").hide();
                $("#List").css("display","block");     
                $('.view_list').addClass('text-color-green');          
                break;
            case "1":
                $(".tabcontent").hide();
                $("#Grid").css("display","block");    
                $('.view_grid').addClass('text-color-green');           
                break;
            case "2":
                $(".tabcontent").hide();
                $("#Col").css("display","block");
                $('.view_col').addClass('text-color-green');                
                break;
            default:
                $(".tabcontent").hide();
                $("#List").css("display","block");     
                $('.view_list').addClass('text-color-green');         
                break;
        }
        
        $('.tablinks').on('click', function() {
            $('.tablinks').removeClass('text-color-green');
            $(this).addClass('text-color-green');
            var condition = $(this).data('value');
           
            switch (condition) {
                case "list":
                    $(".tabcontent").hide();
                    $("#List").css("display","block");
                    $.cookie('con','0');
                    
                    break;
                case "grid":
                    $(".tabcontent").hide();
                    $("#Grid").css("display","block");
                    $.cookie('con','1');
                   
                    break;
                case "col":
                    $(".tabcontent").hide();
                    $("#Col").css("display","block");
                    $.cookie('con','2');
                   
                    break;
                default:
                    break;
            }
        });
    }());

    // --------------------------------------------------------------------
    (function () {        
        
        
        $('.btn_message_reply').on('click', function() {
            
            var receiver_id = $(this).data('value');
            $('.receiver_id').val(receiver_id);
        });
    }());

    // --------------------------------------------------------------------

    
    (function () {

        $('.country_select').on('change', function() {
            var phonecode = $(this).val();
            phonecode = "+" + phonecode;
            $('.phonecode').val(phonecode);
        });


    }());

    (function () {

        var lon = '32.715736';
        var lat = '-117.161087';
        

    }());
    

    (function () {
        var file = document.getElementById('tg-photogallery1');
        var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp', 'doc', 'docx', 'xls', 'xlsx'];
        var max_file_number = 10;
        
        $("#tg-photogallery1").change(function() 
        {
            var cur_file_number = 0; 
            var available_number = 0;
            $(".upload_post_image_item").each(function(){
                cur_file_number++;
            })
            available_number = max_file_number - cur_file_number;
            var total_file_num = 0;
            var temp_con = 0;
            total_file_num = this.files.length;
            if(total_file_num > available_number)
            {
                if(available_number < 1)
                {
                    alert("Maximum 10 photos allowed !");                    
                }
                else
                {
                    alert("You can upload maximum "+ available_number +" photos!");
                }
                
                return false;
            }
            for (let index = 0; index < this.files.length; index++) {

                if (this.files && this.files[index]) 
                {   
                    if(this.files[index].size > 2000000)
                    {
                        alert("File size should not exceed 2mb !");
                        return false;
                    }
                }
            }            
            
            $(".delay").css("display","block");
            $("body").css("overflow","hidden");
            for (let index = 0; index < this.files.length; index++) {

                if (this.files && this.files[index]) 
                {                    
                    if ($.inArray(this.files[index]['name'].split('.').pop().toLowerCase(), fileExtension) == -1) {
                        alert("Only formats are allowed : "+fileExtension.join(', '));
                        $("#tg-photogallery1").val("");
                        return false;
                    }
                    if(this.files[index].size > 2000000)
                    {
                        alert("File size should be less than 2Mb.");
                        return false;
                    }
                    var formdata = new FormData;
                    formdata.append('postimg',this.files[index]);
                    formdata.append('_token',$('input[name=_token]').val());    
                                  
                    $.ajax({
                        url: "/postimgupload",
                        data: formdata,
                        dataType: "json",
                        type: "post",
                        processData: false,
                        contentType: false,
                        success: function(data){
                            postImage.push(data);
                            let html = '';
                            html += '<li class="upload_post_image_item">';
                            html += '<div class="pos_rel">';
                            html += '<button type="button" class="btn_no_border btn_post_img_delete" data-value="'+ data +'"><i class="fa fa-times text-color-red"></i></button>';
                            html += '<img class="postimage1 sel_img1" src="/upload/img/poster/lg/';
                            html += data;
                            html += '" alt="">';
                            html += '</div>';
                            html += '<input name="image_name[]" type="hidden" value="';
                            html += data;
                            html += '">';
                            html += '</li>';
                            $(".upload_post_image").append(html);                     
                            temp_con++;
                            if(temp_con == total_file_num)
                            {
                                $(".delay").css("display","none");
                                $("body").css("overflow","auto");
                               
                            }
                        }
                    });                    
                }
            }
            
        }); 
        $(document).on('click','.btn_post_img_delete',function()
        {                        
            $(this).parent().parent().remove();
            postImage = [];
            $('.btn_post_img_delete').each(function(){
                postImage.push($(this).data("value"));
            });  
            console.log(postImage);
        });           
        
    }());

    (function () {
        $("#email_attchment").change(function(e){
            var fileName = e.target.files[0].name;
            $(".upload_filename").html(fileName);
        });
    }());    
   
    // register------------------------------------------------------------
    (function () {

        $("#signing").on('change',function()
        {
        var temp = $("#signing").prop("checked");
      
        if(temp)
        {
            $(".btn_agree").removeAttr("disabled");
            $(".btn_agree_post").css("display","inline-block");          
            $(".btn_unagree").css("display","none");          
        }
        else if(!temp){
            $(".btn_agree").attr("disabled","disabled");       
            $(".btn_agree_post").css("display","none");          
            $(".btn_unagree").css("display","inline-block");     
        }
        });

    }());
    
    // --------------------------------------------------------------------
    // Post_detail_register
    (function () {
        $(".total_price").html("");           
        total_price = 0;
        var cur_category_price = parseFloat($(".cur_category_price").val());
        
        
        $("input[type='checkbox'].subcategory_check").each(function(){
            if($(this).prop("checked"))
            {
                total_price = parseFloat(total_price) + cur_category_price;
            }
        });
        total_price = total_price.toFixed(2);
        $(".total_price").html(total_price);
        $("#total_price").val(total_price);
        $('input[type="checkbox"].subcategory_check').change(function(){
            if($(this).is(':checked')){
                total_price = parseFloat(total_price) + cur_category_price;
            } else {
                total_price = parseFloat(total_price) - cur_category_price;
            }
            total_price = total_price.toFixed(2); 
            $(".total_price").html("");
            $(".total_price").html(total_price);
            $("#total_price").val(total_price);
        });

    }());  
   
    (function () {       
        $(".added_item").each(function(){
            missing = true;        
        });
        $(".missing_item").each(function(){
          missing_count++;    
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
                
                let html = '';
                html += '<tr class="skill_row">';
                html += '<td style="padding:10px;width:35%" align="center">';
                html += '<span class="skill_name_span">';
                html += skill_name;
                html += '</span>';
                html += '<input type="text" style="display:none;" class="form-control" name="skill_name[]" value="';
                html += skill_name;
                html += '">';
                html += '</td>';       

                html += '<td style="padding:10px;width:25%" align="center">';
                html += '<span class="skill_exp_span">';
                html += skill_exp;
                html += '</span>';
                html += '<input type="text" style="display:none;" class="form-control" name="skill_exp[]" value="';
                html += skill_exp;
                html += '">';
                html += '</td>';       

                html += '<td style="padding:10px;width:25%" align="center">';
                html += '<span class="skill_level_span">';
                html += skill_level;
                html += '</span>';
                html += '<input type="text" style="display:none;" class="form-control" name="skill_level[]" value="';
                html += skill_level;
                html += '">';
                html += '</td>';       
                
                html += '<td style="padding:10px;" align="center">';
                html += '<button type="button" class="btn-remove">';                
                html += '<span class="subcategory-right-delete"><i class="fa fa-trash color-red"></i></span>';
                html += '</button>';               
                html += '</td>';
                html += '</tr>';       
                $('.added_skill').append(html);
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

            let html = '';
            html += '<tr class="missing_item '+ item_sel +'">';
            html += '<td style="padding:10px;" align="center">';
            html += '<span class="skill_name_span">';
            html += item_sel;
            html += '</span>';
            html += '<input type="text" style="display:none;" class="form-control" name="item_sel[]" value="';
            html += item_sel;
            html += '">';
            html += '</td>';       

            html += '<td style="padding:10px;" align="center">';
            html += '<span class="skill_exp_span">';
            html += item_name;
            html += '</span>';
            html += '<input type="text" style="display:none;" class="form-control" name="item_name[]" value="';
            html += item_name;
            html += '">';
            html += '</td>';       

            html += '<td style="padding:10px;" align="center">';
            html += '<span class="skill_value_span">';
            html += item_value;
            html += '</span>';
            html += '<input type="text" style="display:none;" class="form-control" name="item_value[]" value="';
            html += item_value;
            html += '">';
            html += '</td>';       

            html += '<td style="padding:10px;" align="center">';
            html += '<span class="skill_date_span">';
            html += item_date;
            html += '</span>';
            html += '<input type="text" style="display:none;" class="form-control" name="item_date[]" value="';
            html += item_date;
            html += '">';
            html += '</td>';       

            html += '<td style="padding:10px;" align="center">';
            html += '<span class="skill_location_span">';
            html += item_location;
            html += '</span>';
            html += '<input type="text" style="display:none;" class="form-control" name="item_location[]" value="';
            html += item_location;
            html += '">';
            html += '</td>';       
            
            html += '<td style="padding:10px;" align="center">';
            html += '<button type="button" class="btn-remove btn-missing-item">';                
            html += '<span class="subcategory-right-delete"><i class="fa fa-trash color-red"></i></span>';
            html += '</button>';               
            html += '</td>';
            html += '</tr>';       
            $('.added_item').append(html);


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
                        

            let html = '';
            html += '<tr>';
            html += '<td style="padding:10px;width:35%" align="center">';
            html += '<span class="skill_name_span">';
            html += degree;
            html += '</span>';
            html += '<input type="text" style="display:none;" class="form-control" name="degree[]" value="';
            html += degree;
            html += '">';
            html += '</td>';       

            html += '<td style="padding:10px;width:25%" align="center">';
            html += '<span class="skill_exp_span">';
            html += area;
            html += '</span>';
            html += '<input type="text" style="display:none;" class="form-control" name="area[]" value="';
            html += area;
            html += '">';
            html += '</td>';       

            html += '<td style="padding:10px;width:25%" align="center">';
            html += '<span class="skill_level_span">';
            html += years;
            html += '</span>';
            html += '<input type="text" style="display:none;" class="form-control" name="years[]" value="';
            html += years;
            html += '">';
            html += '</td>';    
            
            html += '<td style="padding:10px;" align="center">';
            html += '<button type="button" class="btn-remove">';                
            html += '<span class="subcategory-right-delete"><i class="fa fa-trash color-red"></i></span>';
            html += '</button>';               
            html += '</td>';
            html += '</tr>';       
            $('.added_education').append(html);

            $(".degree").val('');
            $(".area").val('');
            $(".years").val('');
        });

        $(".btn-add-life").click(function(){
            var checkflag = true;
            var value = $(".add_provider_life").val(); 
            console.log(value);           
            if(value == "" || $.trim(value).length < 1)
            {
                $(".add_provider_life_"+sel_categoryID).addClass("red_border");
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
                
                let html = '';
                html += '<div class="col-sm-4 text-center m-t-10">';
                html += '<div class="input-group">';
                html += '<input type="text" class="p-l-10 post_provider_val" name="life_item[]" readonly value="';
                html += value;
                html += '">';
                html += '<span class="input-group-addon"><i class="fa fa-times"></i></span>';                
                html += '</div>';
                html += '</div>';      

                $(".added_life_"+sel_categorySlug).append(html);
                $(".add_provider_life").val("");
            }
            else
            {
                $(".add_provider_life").addClass("red_border");
                return false;
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

                let html = '';
                html += '<div class="col-xs-6">';
                html += '<p class=""><input type="checkbox" class="benefit_check" data-benefit="'+ value +'" id="" style="display:inline-block;margin-right:5px;"><span class="fs-13 f-w-600">';
                html += value;
                html += '</span><input type="hidden" value="';
                html += value;                
                html += '" name="benefit_name[]"><input type="hidden" class="benefit_default" name="benefit_default[]" value="0"><input type="hidden" class="benefit_checked" name="benefit_checked[]" value="0"></p>';
                html += '</div>';      

                $(".add_benefit_group").append(html);

                $(".benefit_name").val("");
            }
            else
            {
                $(".benefit_name").addClass("red_border");
                return false;
            }
        });

        $(".btn-add-position").click(function(){       
              
            var value = $(".add_position_"+sel_categorySlug).val();
            var distance = $(".add_distance_"+sel_categorySlug).val();            
            if(value == "")
            {
                $(".add_position").addClass("red_border");
                return false;
            }
            
            addProviderC(value,distance);            
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

        $(".btn-add-provider").on('click',function()
        {  
            var value = $(".add_provider_"+sel_categorySlug).val();            
            if(value == "" || $.trim(value).length < 1)
            {
                $(".add_provider_"+sel_categorySlug).addClass("red_border");
                return false;
            }
                   
            addProvider(value);
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

        $(document).on("keydown",".required_field",function(){
            if($(this).hasClass('red_border'))
            {
                $(this).removeClass("red_border");
            }
            if(!$(this).val())
            {
                $(this).addClass("red_border");
            }
        });
        
        $(document).on("change",".required_field",function(){
            if($(this).hasClass('red_border'))
            {
                $(this).removeClass("red_border");
            }
            if(!$(this).val())
            {
                $(this).addClass("red_border");
            }
        });
      
        
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
        $(".btn-post-submitO").click(function()
        {            
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
                        
            if(reply_check_var > 0 && subcategory_check_var > 0 && field_check_var < 1)
            {
                $(".form_post_detail").submit();
            }  
            else
            {                
                $(document).find('.red_border').eq(0).focus();
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
        
        var maxDate;
        var now = new Date();
        maxDate = now.toISOString().substring(0,10);
        $(".restrict_date").prop('max',maxDate);
       
    }());
    
    (function (){
        $(document).ready(function()
        {
            $("#step_post_details").css("display","none");
            $("#step_post_short_info").css("display","none");
            $("#step_post_location").css("display","none");
            $("#step_post_preview").css("display","none");
            $(".contact_email_alert").hide();
            var current_page =$(".current_page").val();
            
            if(current_page == "createpost")
            {
                
                $.ajax({
                    url: "/getcategoryinfo",            
                    dataType: "json",
                    type: "get",
                    processData: false,
                    contentType: false,
                    success: function(data){                
                        subCategoryData = data;
                        console.log(subCategoryData);
                        if($.cookie('sel_categoryID') > 0)
                        {
                            showSubCategoryM();
                        }
                        
                    }
                });
                
            }
            else if(current_page == "editpost")
            {
                sel_categorySlug = $(".sel_categorySlug").val();
            }
            
           
        });
    }());
       
    (function (){
        $(document).on("click",".classified_details",function(){
            $(".setp_sub_page").css("display","none");
            $("#step_post_details").css("display","block");
            $(".post_input_step_nav").removeClass("selected_nav");
            $("#nav_PostDetail").addClass("selected_nav");
            ScrollTop();
        });
        $(document).on("click",".btn_step_post_details",function(){
            
            common_title = $("#title").val();
            common_description = $("#body").val();            
            check_reply_item_num = 0;
            var userEmail = $("#contact_email").val();
            if(common_title == "")
            {
                $("#title").addClass("red_border");
                $("#title").focus();
                return false;
            }
            if(common_description == "")
            {
                $("#body").addClass("red_border");
                $("#body").focus();
                return false;
            }
            
            if(userEmail != "")
            {                
                if(!isEmail(userEmail))
                {
                    $(".contact_email_alert").show();
                    $("#contact_email").addClass("red_border");
                    return false;
                }
            }
            if((reply_check_var < 1))
            {                
                return false;
            }
            $(".check_reply_item").each(function(){
                if($(this).hasClass("required_field"))
                {
                    if($(this).val() == "")
                    {
                        $(this).addClass("red_border");
                        check_reply_item_num++;
                    }                    
                }  
            });
            if(check_reply_item_num > 0)
            {
                return false;
            }
            $(".setp_sub_page").css("display","none");
            $("#step_post_short_info").css("display","block");
            $(".post_input_step_nav").removeClass("selected_nav");
            $("#nav_ShortInfo").addClass("selected_nav");
            $(".mainCategory").each(function(){
                if(!$(this).hasClass("mainCategory"+sel_categorySlug))
                {
                   $(this).remove();
                }
            });
            
            $(".mainCategory"+sel_categorySlug).css("display","block");
            ScrollTop();
        });
        $(document).on("click",".btn_step_post_short_info",function(){
            $(".setp_sub_page").css("display","none");
            $("#step_post_location").css("display","block");
            $(".post_input_step_nav").removeClass("selected_nav");
            $("#nav_YourLocation").addClass("selected_nav");
            ScrollTop();
        });
        $(document).on("click",".btn_step_post_location",function(){
            field_check_var = 0;
            $(".address_required_field").each(function(){
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
            
            if(field_check_var < 1)
            {
                // if($("#service_county").val() != "")
                // {
                    $(".setp_sub_page").css("display","none");
                    $("#step_post_preview").css("display","block");
                    $(".post_input_step_nav").removeClass("selected_nav");
                    $("#nav_PreviewSubmit").addClass("selected_nav");
                    ScrollTop();
                                  
                    if(sel_categorySlug == "Services")
                    {
                        LocalService();
                    }
                    else if(sel_categorySlug == "Sale")
                    {
                        ForSale();
                    }
                    else if(sel_categorySlug == "Jobs")
                    {
                        Jobs();
                    }
                    else if(sel_categorySlug == "Acco")
                    {
                        Accommodation();
                    }   
                    else if(sel_categorySlug == "Real")
                    {
                        RealEstate();
                    }   
                    else if(sel_categorySlug == "Contractors")
                    {
                        LocalContractors();
                    } 
                    else if(sel_categorySlug == "Repairs")
                    {
                        Repairs();
                    }     
                    else if(sel_categorySlug == "Community")
                    {
                        LocalEvents();
                    }     
                    else if(sel_categorySlug == "Legal")
                    {
                        LegalLawyers();
                    }        
                    else if(sel_categorySlug == "Tutoring")
                    {
                        InstructorsLessons();
                    }             
                    else if(sel_categorySlug == "Research")
                    {
                        Research();
                    }    
                    else if(sel_categorySlug == "Rent")
                    {
                        Rent();
                    }             
                    else if(sel_categorySlug == "Employers")
                    {
                        Employers();
                    }  
                    else if(sel_categorySlug == "Matrimonies")
                    {
                        Matrimonies();
                    }  
                    else if(sel_categorySlug == "Missing")
                    {
                        Missing();
                    }  
                    
                    else if(sel_categorySlug == "Agents")
                    {
                        Agents();
                    }  

                    else if(sel_categorySlug == "Fashion")
                    {
                        Fashion();
                    }  

                    else if(sel_categorySlug == "Accountants")
                    {
                        Accountants();
                    }                       
                    else if(sel_categorySlug == "Adaption")
                    {
                        Adaption();
                    }
                // }
                // else
                // {
                //     $.alert({
                //         title: 'Woops!',
                //         content: "The address you entered is incorrect.Please try confrim city.",
                //     });    
                // }                
            }  
            else
            {                
                $(document).find('.red_border').eq(0).focus();
            }        
        });

        $(document).on("click","#post_edit",function(){
            $(".setp_sub_page").css("display","none");
            $("#step_select_category_content").css("display","block");
            $(".post_input_step_nav").removeClass("selected_nav");
            $("#nav_SelectCategory").addClass("selected_nav");
            post_edit_status = true;
            ScrollTop();
        });

        $(document).on("click",".btn_agree_post",function() {
            var userMail = $("#contact_email").val();
            

            $("#btn_login_common_ajax span").html("SUBMIT POST");
            $("#btn_register_common_ajax span").html("SUBMIT POST");
            $(".toggle_register_submit").html("Submit Post");                           
            $(".toggle_register_submit_text").html("you are creating account on AdnList and agreeing to AdnList");
            
            $("*").css("cursor", "wait");
            $.ajax({
                url: "/checkauth",
                dataType: "json",
                type: "get",
                processData: false,
                contentType: false,
                success: function(data)
                {
                    
                    console.log(data);
                    if(data == "on")
                    {
                        $(".form_post_detail").submit();
                    }
                    else
                    {
                        if(userMail != "")
                        {
                            $("#emailMR").val(userMail);
                        }
                        $("#signModal").modal();
                        
                    }
                    $("*").css("cursor", "default");
                }
            });         
            
        });

        $(document).on("keydown","#contact_email",function() {
            $(".contact_email_alert").hide();
        })

        
        
        // ---------------------------------------------------------------
      
       

    }());
   

});


    

