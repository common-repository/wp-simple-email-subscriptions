<?php
    function wseswc_subc_form_display(){
        wp_enqueue_style("siesstyle",plugins_url('wseswc-style.css',__FILE__));
        wp_enqueue_script('sies-form-validate', plugins_url('wseswc_form_validate.js',__FILE__));
        $error="";
        $msg="";
        
        if(!session_id())
            session_start();
                                
        
        if(isset($_REQUEST['sies_submit']) && $_REQUEST['sies_submit']!='')
        {   
            if($_SESSION['answer'] == $_REQUEST['answer']) 
            {                
                if(trim($_REQUEST['fullname'])=='')
                {
                    $error="Name is required";
                }
                elseif(trim($_REQUEST['email'])=='')
                {
                    $error="Email is required";
                }
                else
                {
                    global $wpdb;            
                    $table=$wpdb->prefix."wseswc_emails";            
                    $sies_email=$wpdb->get_results('select * from '.$table.' where email="'.$_REQUEST['email'].'" ',ARRAY_A);               

                    if(empty($sies_email))
                    {                    
                        $data=array('fullname'=>$_REQUEST['fullname'],'email'=>$_REQUEST['email']);
                        $wpdb->flush();
                        $wpdb->insert( $table,array('fullname'=>$_REQUEST['fullname'],'email'=>$_REQUEST['email'],'reg_date'=>current_time('mysql',1),'ipaddress'=>$_SERVER['REMOTE_ADDR']),array('%s','%s'));                

                        if($wpdb->insert_id==false)
                        {
                            $error="Error registering email";
                        }                       
                        else
                        {    
                            $msg="<b>Subscribed Successfully !...</b>"; 
                        }    
                    }   
                    else
                    {                      
                        $error="Email already registered";                
                    }    
                }
            }
            else
            {
                $error="Entered captcha is wrong value";
            }    
        }   
            $digit1 = mt_rand(1,20);
            $digit2 = mt_rand(1,20);
            if( mt_rand(0,1) === 1 ) {
                $math = "$digit1 + $digit2";
                $_SESSION['answer'] = $digit1 + $digit2;
            } else {
                $math = "$digit1 - $digit2";
                $_SESSION['answer'] = $digit1 - $digit2;
            }
	?>
            <span class="sies_error"><?php echo $error; ?></span>
            <span class="sies_msg"><?php echo $msg; ?></span>
            
            <form name="sies_form" id="sies_form" action="" class="siesform" method="POST">
                <p class="siesformpara">
                    <label>Full Name *</label> 
                    <input type="text" name="fullname" id="fullname" class="siesinput"><br>
                    <span class="vlderrormsg"></span>
                </p>
                <p class="siesformpara">
                    <label>Email *</label>
                    <input type="text" name="email" id="email" class="siesinput"><br>
                    <span class="vlderrormsg"></span>
                </p>
                <p class="captchapara">
                   <!-- <div class="captchalabel">Enter below captcha</div> -->
                    <div class="captchabox">
                        <span class="captchaqt"><?php echo $math; ?></span> = &nbsp;<input name="answer" id="answer" type="text" class="siesinput" size="8"/><br>
                        <span class="vlderrormsg"></span>
                    </div>
                </p>
                <p class="sies_submit" >
                    <input type="submit" name="sies_submit" id="sies_submit" value="Subscribe" class="sies_submit_btn">
                </p>    
            </form>
        <?php
                
    }
    add_shortcode( 'wseswc_subc_form', 'wseswc_subc_form_display' );