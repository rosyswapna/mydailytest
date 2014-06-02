<?php // prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}
if(isset($myuser)) { echo $myuser->error_description; echo $passwd_error ; }
$breadcrumb='<a href="/organization/index.php">Home</a> &raquo; <a href="/organization/forgot_password.php">Forgot Password</a>'; ?>
	
			<div class="innercontainer-blk">
					<p class="heading"><?php echo $CAP_page_caption?></p>
					<form  target="_self" method="post" action="<?php echo $current_url?>" name="frmforgot_passwd" id="ajax-contact-form">
						<div class="one-third column">
							<div class="form-box">
								<label><?php echo $CAP_username ?> <small>*</small></label>
								<input type="text" name="username" class="text">
							</div><!-- End Box -->
						</div>
						<div class="sixteen columns"></div>
						<div class="one-third column">
							<div class="form-box">
								<label><?php $digits = 1;
$rand_number1 =str_pad(rand(0, pow(10, $digits)-1), $digits, '00', STR_PAD_LEFT);$rand_number2 =str_pad(rand(0, pow(10, $digits)-1), $digits, '00', STR_PAD_LEFT); echo $rand_number1.' + '.$rand_number2.' : ';$randome_number=$rand_number1+$rand_number2;$_SESSION[SESSION_TITLE.'captcha']=$randome_number; ?><small>*</small></label>
								<input  type="text" name="randome_expression" id="randome_expression" class="text" >
							</div><!-- End Box -->
						</div>
						<div class="sixteen columns">
							<div class="form-box">
								<input value="<?php echo $CAP_reset; ?>" type="submit" name="submit" onClick="return validate_email();" class="button">
								<input type="reset" class="button gray" value="Cancel">
							</div>
						</div>
					</form>
				</div>



<script language="javascript" type="text/javascript">
    //<!--
            document.getElementById("username").focus();
   //-->
    </script>



