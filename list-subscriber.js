
jQuery(function(){
    // actionurl_pass is Localized variable passed from wp_localize_script() 
    var actionurl = actionurl_pass;
    jQuery(".dellink").click(function(){                                                                       

        if(confirm("Are You sure want to delete this record"))
        {    
            var uid=jQuery(this).attr('delid');
            window.location=actionurl+"&uid="+uid;
        }
    });

    jQuery("#pagilimit").change(function(){
        jQuery("#sies_settings_form").submit();
    });

    jQuery("#sies_deleteall_form").submit(function(){                                                        
        if(confirm("Deleting all subscribers will not be restored. Are You sure?")==false) 
        {
            return false;
        }    
    });


});