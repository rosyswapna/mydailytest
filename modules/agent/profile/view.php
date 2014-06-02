<?php // prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}
if(isset( $myagent->error_description)) {$_SESSION[SESSION_TITLE.'flash'] = $myagent->error_description;} 
$breadcrumb='<a href="/organization/index.php">Home</a> &raquo; <a href="/organization/profile.php">Profile</a>';
?>
<div class="two-thirds column mright8 bottom-1">			
					<div class="innercontainer-blk">
						<p class="heading">My Profile </p>
						<form name="frmupdate" method="post" action="<?php echo $current_url; ?>" enctype="multipart/form-data" id="ajax-contact-form">
						<div class="one-third column mright4">
							<div class="form-box">
								<label><?php echo $CAP_username; ?>(Email Id)<small>*</small></label>
								<input  type="text" name="txtusername" value="<?php echo $myagent->username; ?>" class="text"><input  type="hidden" name="hiddenusername" value="<?php if(isset($_POST['hiddenusername'])){echo $_POST['hiddenusername'];}else{ echo $myagent->username; }?>"  > 
							</div><!-- End Box -->
						</div>
						<div class="clear"></div>
						<div class="one-third column mright4">
							<div class="form-box">
								<label><?php echo $CAP_name; ?><small>*</small></label>
								<input  type="text" name="txtname" value="<?php if(isset($_POST['txtname'])){echo $_POST['txtname'];}else{ echo $myagent->name;} ?>" class="text">
							</div><!-- End Box -->
						</div>
						<div class="clear"></div>
						<div class="one-third column mright4">
							<div class="form-box">
								<label><?php echo $CAP_email; ?><small></small></label>
								<input  type="text" name="txtemail" value="<?php if(isset($_POST['txtemail'])){echo $_POST['txtemail'];}else{ echo $myagent->email;}?>"  class="text" >
							</div><!-- End Box -->
						</div>
						<div class="clear"></div>
						<div class="one-third column mright4">
							<div class="form-box">
								<label><?php echo $CAP_phone; ?><small></small></label>
								<input  type="text" name="txtphone" value="<?php if(isset($_POST['txtphone'])){echo $_POST['txtphone'];}else{ echo $myagent->phone;}?>" class="text">
							</div><!-- End Box -->
						</div>
						<div class="one-third column mright4">
							<div class="form-box">
								<label> <?php echo $CAP_cphone; ?> <small></small></label>
								<input  type="text" name="txtcphone" value="<?php  if(isset($_POST['txtcphone'])){echo $_POST['txtcphone'];}else{ echo $myagent->contact_phone;}?>" class="text" >
							</div><!-- End Box -->
						</div>
						<div class="one-third column mright4">
							<div class="form-box big">
								<label><?php echo $CAP_address; ?><small>*</small></label>
								<textarea name="txtaddress"><?php if(isset($_POST['txtaddress'])){echo $_POST['txtaddress'];}else{ echo $myagent->address;}?></textarea> 
							</div><!-- End Box -->
						</div>
						
						<div class="clear"></div>
						<div class="one-third column mright4">
							<div class="form-box">
 <input type="submit" name="submit" value="<?php echo $CAP_update?>" onClick="return validate_member_update();" class="button">
								
								<input type="reset" class="button gray" value="Cancel">
							</div>
						</div>
					</form>
					</div>
				</div>

				<div class="one-third column mright8 bottom-1">
					<div class="credit-balance">
						<p class="head"></p>
						<div class="dblk">
							<p class="fleft"></p>
							<p class="fright"></p>
						</div>
					</div>
					<div class="history-blk">
						<p class="head bottom-1"></p>
						<p class="subhead"></p>
						<p class="description bottom-2"> </p>
						<p class="subhead"></p>
						<p class="description bottom-2"> </p>
						<p class="subhead"></p>
						<p class="description bottom-2"></p>
						<p class="subhead"></p>
						<p class="description bottom-2"></p>
					</div>
				</div>



