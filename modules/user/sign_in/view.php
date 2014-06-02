<?php // prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}
$breadcrumb='<a href="/index.php">Home</a> &raquo; <a href="/login.php">Login</a>';
?><div class="innercontainer-blk">
					<p class="heading">Login &nbsp;&nbsp;  <?php if($login_error!="") echo $login_error;?></p>
					<form  id="ajax-contact-form" target="_self" method="post" action="<?php echo $current_url?>" name="frmlogin">
						<div class="one-third column">
							<div class="form-box">
								<label>User Name <small>*</small></label>
								<input name="loginname"  type="text" class="text " id="loginname"  title=""  value="" placeholder="Enter your name" >
							</div><!-- End Box -->
						</div>
						<div class="one-third column">
							<div class="form-box">
								<label>Password <small>*</small></label>
								<input name="passwd"  type="password" class="text " id="passwd" >
							</div><!-- End Box -->
						</div>
						<div class="sixteen columns">
							<div class="form-box">
								<input  value="<?php echo $capSIGNIN; ?>" type="submit" name="submit" class="button" >
         					    <input name="h_id" value="" type="hidden"><input name="h_login" value="pass" type="hidden">
								<a href="forgot_password.php" class="button-link">Forgot Password?</a>
							</div>
						</div>
					</form>
				</div>	
	
