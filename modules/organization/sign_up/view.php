<?php // prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

if(isset( $myorganization->error_description)) echo $myorganization->error_description;
$breadcrumb='<a href="/organization/index.php">Home</a> &raquo; <a href="/organization/sign_up.php">Register</a>'; ?>




		<div class="innercontainer-blk">
					<p class="heading"> <?php echo $CAP_page_caption ?></p>
					<form  name="frmsignup" id="frmsignup" method="post" action="<?php echo $current_url; ?>" enctype="multipart/form-data" id="ajax-contact-form">
						<div class="one-third column">
							<div class="form-box">
								<label><?php echo $CAP_username; ?>(Email Id)<small>*</small></label>
								<input type="text" name="txtusername" id="txtusername" value="<?php if(isset($_POST['txtusername'])){ echo $_POST['txtusername']; }?>" class="text">
							<label><div id='username_availability_result'></div></label>
							</div><!-- End Box -->
						</div>
						
						<div class="one-third column">
							<div class="form-box"><br><br>
								<label></label>
								<input type="button" name="check_availability" id="check_availability" value="<?php echo$CAP_available?>" class="button" />
								
							</div><!-- End Box -->
						</div>
						<div class="sixteen columns"></div>
						<div class="one-third column">
							<div class="form-box">
								<label><?php echo $CAP_password; ?><small>*</small></label>
								<input type="password" name="txtpassword" value="" class="text">						<div style="color:#F00;display:inline;font-size:10px;" id="error_pass"></div>
							</div><!-- End Box -->
						</div>
						<div class="one-third column">
							<div class="form-box">
								<label><?php echo $CAP_confirm_password; ?><small>*</small></label>
								<input type="password" name="txtconfirm" value=""  onBlur="confirmPassword()" class="text">
							</div><!-- End Box -->
						</div>
						<div class="sixteen columns"></div>
						<div class="one-third column">
							<div class="form-box">
								<label><?php echo$CAP_name; ?><small>*</small></label>
								<input type="text" name="txtorganizationname" value="<?php if(isset($_POST['txtorganizationname'])){ echo $_POST['txtorganizationname']; }?>"  class="text" >
							</div><!-- End Box -->
						</div>
						<div class="sixteen columns"></div>
						<div class="one-third column">
							<div class="form-box">
								<label>Alternate <?php echo$CAP_email; ?> <small>*</small></label>
								<input type="text" name="txtemail" value="<?php if(isset($_POST['txtemail'])){ echo $_POST['txtemail']; }?>"  class="text">
							</div><!-- End Box -->
						</div>
						<div class="sixteen columns"></div>
						<div class="one-third column">
							<div class="form-box">
								<label><?php echo$CAP_phone; ?><small></small></label>
								<input type="text" name="txtphone" value="<?php if(isset($_POST['txtphone'])){ echo $_POST['txtphone']; }?>"  class="text">
							</div><!-- End Box -->
						</div>
						<div class="one-third column">
							<div class="form-box">
								<label><?php echo $CAP_weburl; ?> <small></small></label>
								<input type="text" name="txtweburl" value="<?php if(isset($_POST['txtweburl'])){ echo $_POST['txtweburl']; }?>" class="text" >
							</div><!-- End Box -->
						</div>
						<div class="sixteen columns">
							<div class="form-box big">
								<label><?php echo $CAP_address; ?> <small></small></label>
								<textarea name="txtaddress"><?php if(isset($_POST['txtaddress'])){ echo $_POST['txtaddress']; }?></textarea>
							</div><!-- End Box -->
						</div>
						<div class="one-third column">
							<div class="form-box">
								<label><?php echo $CAP_type;
			if(isset($_POST['txtorganizationtype'])){
				$organization_type_id=$_POST['txtorganizationtype'];
			}else{
				$organization_type_id=$myorganization->organization_type_id;
			}?> <small>*</small></label>
								<?php populate_array("txttype",$types,$organization_type_id,$disable=false); ?>
							</div><!-- End Box -->
						</div>
						<div class="sixteen columns">
							<div class="form-box">
								 <input type="submit" name="submit" value="<?php echo$CAP_add?>" onClick="return validate_signup();" class="button" >
								<input type="reset" class="button gray" value="Cancel">
							</div>
						</div>
					</form>
				</div>



            
