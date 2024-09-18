$(document).ready(function() { 

    
    $('.client-js-district').change(function() {
        select_district_code= $('.client-js-district').val();
        var htmlOption='<option value="">--Select--</option>';
        $.each(assemblies, function (key, value) {
            if(value.district_code==select_district_code){
                htmlOption+='<option value="'+value.id+'">'+value.text+'</option>';
            }
        });
        $('.client-js-assembly').html(htmlOption);
    });

    $('.client-js-urban').change(function() {
        //alert('ok');
        select_district_code= $('.client-js-district').val();
        select_body_type= $('.client-js-urban').val();
        var htmlOption='<option value="">--Select--</option>';
        if(select_body_type==2){
            $.each(blocks, function (key, value) {
                if(value.district_code==select_district_code){
                    htmlOption+='<option value="'+value.id+'">'+value.text+'</option>';
                }
            });
        }else if(select_body_type==1){
            $.each(ulbs, function (key, value) {
                if(value.district_code==select_district_code){
                    htmlOption+='<option value="'+value.id+'">'+value.text+'</option>';
                }
            });
        }    
        
        $('.client-js-localbody').html(htmlOption);
    });

    $('.client-js-localbody').change(function() {
        select_district_code= $('.client-js-district').val();
        select_body_type= $('.client-js-urban').val();
        selected_body_code= $('.client-js-localbody').val();
        var htmlOption='<option value="">--Select--</option>';
        if(select_body_type==2){
            $.each(gps, function (key, value) {
                if((value.district_code==select_district_code)&&(value.block_code==selected_body_code)){
                    htmlOption+='<option value="'+value.id+'">'+value.text+'</option>';
                }
            });
        }else if(select_body_type==1){
            $.each(ulb_wards, function (key, value) {
                if((value.urban_body_code==selected_body_code)){
                    htmlOption+='<option value="'+value.id+'">'+value.text+'</option>';
                }
            });
        }
        $('.client-js-gpward').html(htmlOption);
    });

});