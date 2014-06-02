<?php // prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

$breadcrumb='<a href="/organization/index.php">Home</a> &raquo; <a href="/organization/update_password.php">Change Password</a>';
 if(isset($myorganization)) {  $_SESSION[SESSION_TITLE.'flash'] =$myorganization->error_description.$passwd_error; }?>
			<div class="innercontainer-blk">
					<p class="heading"><?php echo $CAP_page_caption?></p>
					<form  target="_self" method="post" action="<?php echo $current_url?>" name="frmchange_passwd" id="ajax-contact-form">
						<div class="one-third column">
							<div class="form-box">
								<label><?php echo $CAP_password ?><small>*</small></label>
								<input type="password" name="passwd" id="passwd" class="text">
							</div><!-- End Box -->
						</div>
						<div class="sixteen columns"></div>
						<div class="one-third column">
							<div class="form-box">
								<label><?php echo $CAP_new_password ?> <small>*</small></label>
								<input  type="password" name="new_passwd" id="new_passwd" class="text" >
							</div><!-- End Box -->
						</div>
						<div class="one-third column">
							<div class="form-box">
								<label><?php echo $CAP_retype_password ?> <small>*</small></label>
								<input type="password" name="retype_passwd" id="retype_passwd" class="text">
							</div><!-- End Box -->
						</div>
						<div class="sixteen columns"></div>
						<div class="one-third column">
							<div class="form-box">
								<input value="<?php echo $CAP_update ?>" type="submit" name="submit" onClick="return validate_change_passwd();"class="button">
								<input type="reset" class="button gray" value="Cancel">
							</div>
						</div>
					</form>
				</div>


<script language="javascript" type="text/javascript">
    //<!--
            document.getElementById("passwd").focus();
   //-->
    </script>

                    
