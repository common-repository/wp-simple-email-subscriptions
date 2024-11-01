
jQuery(function(){    
    jQuery("#sies_form").submit(function(){        
        var fname=jQuery("#fullname").val();
        var email=jQuery("#email").val();
        var answer=jQuery("#answer").val();
        filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/
        
        if(fname.trim()=='')
        {
            jQuery("#fullname").next().next().html("Please Enter Name");
            //jQuery("#fullname").focus();
            return false;
        }
        else if(email.trim()=='')
        {
            jQuery("#email").next().next().html("Please Enter Email Address");
            //jQuery("#email").focus();
            return false;
        }
        else if(filter.test(email)==false)
        {
            jQuery("#email").next().next().html("Please provide valid Email address");
            //jQuery("#email").focus();
            return false;
        }                            
        else if(answer.trim()=='')
        {
            jQuery("#answer").next().next().html("Please Enter captcha value");
            //jQuery("#email").focus();
            return false;
        }
    });
    
    jQuery("#email").focus(function(){        
        jQuery(this).next().next().html('');        
    });
    
    jQuery("#fullname").focus(function(){
        jQuery(this).next().next().html('');        
    });
});


