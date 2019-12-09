$(document).ready(function(){    
    $(".service_state").css("display","none");
    $("#service_country").change(function(){
        var country = $("#service_country").val();
        if(country == 'USA')
        {
            $.ajax({
                url:"/get_state",
                data:{country:country},
                dataType: "json",
                type: "get",
                success: function(data){                    
                    for (let index = 0; index < data.length; index++) {
                        
                        $("#service_state").append(`
                            <option value="${data[index]['state_code']}">${data[index]['state_name']}</option>
                        `);
                    }
                }
            });
            
        }
    });
});