<?php // prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}
?>

	
    <?php   /*
    This forms most of the HTML contents of User Login page
    On clicking the Login Button
    the page is called by itself
    If successful user is redirected to the concerned Logged in page
    Else
    Invalid Login information is displayed
    */

    ?>
      
<?php $breadcrumb='<a href="/index.php">Home</a> &raquo; <a href="/update_password.php">Change Password</a>';?>
<div class="innercontainer-blk">
					<p class="heading"><?php echo $CAP_page_caption?>      <?php if(isset($myuser)) { echo $myuser->error_description; echo $passwd_error ; }?></p>
					<form  target="_self" method="post" action="<?php echo $current_url?>" name="frmchange_passwd" id="ajax-contact-form" >
						<div class="one-third column">
							<div class="form-box">
								<label><?php echo $CAP_password ?> <small>*</small></label>
								<input type="password" name="passwd" id="passwd" value="" class="text">
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
						<div class="sixteen columns">
							<div class="form-box">
							<input value="<?php echo $CAP_update ?>" type="submit" name="submit" class="button" onClick="return validate_change_passwd();" />
								<input type="reset" class="button gray" value="Cancel">
							</div>
						</div>
					</form>
				</div>
				
				
            <!-- form end-->
    <script language="javascript" type="text/javascript">
    //<!--
            document.getElementById("passwd").focus();
   //-->
    </script>