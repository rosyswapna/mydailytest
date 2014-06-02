<?php // prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}
$breadcrumb='<a href="/organization/index.php">Home</a> &raquo; <a href="/organization/user.php';if(isset($_GET['id'])){
$breadcrumb.='?id='.$_GET['id'].'">User</a>'; 
}else{
$breadcrumb.='">User</a>'; 
}
if(isset( $myuser->error_description)) echo $myuser->error_description; 
?>




		<div class="innercontainer-blk">
					<p class="heading"><?php if ( isset($_GET['id']) || isset($_POST['h_id']) ){?>
                    <?php echo $CAP_page_caption_update?>
                    <?php }else{?>
                    <?php echo $CAP_page_caption_add?>
                    <?php }?></p>
					<form  name="frmupdate" id="frmupdate" method="post" action="<?php echo $current_url; ?>" enctype="multipart/form-data">
						<div class="one-third column">
							<div class="form-box">
								<label> <?php echo$CAP_username?>:<small>*</small></label>
								<input type="text" name="txtusername" class="text" id="txtusername" value="<?php if(isset($_POST['txtusername'])){echo $_POST['txtusername'];}elseif(isset($_GET['id'])){echo $myuser->username;}?>"  ><div id='username_availability_result'></div><?php if(!isset($_GET['id']) && !isset($_POST['h_id'])){ ?><br><input type="button" class="button" name="check_availability" id="check_availability" value="<?php echo$CAP_available?>" /><?php } if(isset($_GET['id']) || isset($_POST['h_id'])){?><input  type="hidden" name="hiddenusername" value="<?php if(isset($_POST['hiddenusername'])){echo $_POST['hiddenusername'];}elseif(isset($_GET['id'])){echo $myuser->username;}?>"  ><?php } ?>
							</div><!-- End Box -->
						</div>
					<?php if(!isset($_GET['id']) && !isset($_POST['h_id'])){ ?>
						<div class="one-third column">
							<div class="form-box">
								<label> <?php echo $CAP_password?><small>*</small> :</label>
								<input type="password" name="txtpassword" class="text"> <br><br>  <br><br> <br> 
							</div><!-- End Box -->
						</div>
						<div class="one-third column">
							<div class="form-box">
								<label> <?php echo $CAP_repassword?> <small>*</small>:</label>
								 <input type="password" name="txtrepassword" class="text">
							</div><!-- End Box -->
						</div>
						
                		<?php }?>
						<div class="one-third column">
							<div class="form-box">
								<label><?php echo $CAP_firstname?> : </label>
								<input type="text" name="txtfirstname" value="<?php if(isset($_POST['txtfirstname'])){echo $_POST['txtfirstname'];}elseif(isset($_GET['id'])){echo $myuser->first_name;}?>" class="text" >
							</div><!-- End Box -->
						</div>
						<div class="one-third column">
							<div class="form-box">
								<label><?php echo $CAP_lastname?> : </label>
								 <input type="text" name="txtlastname" value="<?php if(isset($_POST['txtlastname'])){echo $_POST['txtlastname'];}elseif(isset($_GET['id'])){echo $myuser->last_name;}?>" class="text" >
							</div><!-- End Box -->
						</div>
						<div class="one-third column">
							<div class="form-box">
								<label> <?php echo $CAP_email?>:</label>
								<input  type="text" name="txtemail" value="<?php if(isset($_POST['txtemail'])){echo $_POST['txtemail'];}elseif(isset($_GET['id'])){echo $myuser->email;}?>" class="text" />
							</div><!-- End Box -->
						</div>

						<div class="one-third column">
							<div class="form-box">
								<label> <?php echo $CAP_phone ?> :</label>
								<input   type="text" name="txtphone" value="<?php if(isset($_POST['txtphone'])){echo $_POST['txtphone'];}elseif(isset($_GET['id'])){echo $myuser->phone;}?>" class="text"/>
							</div><!-- End Box -->
						</div>
						<div class="one-third column">
							<div class="form-box">
								<label> <?php echo $CAP_address ?> :</label>
								<input  type="text" name="txtaddress" id="txtaddress" value="<?php if(isset($_POST['txtaddress'])){echo $_POST['txtaddress'];}elseif(isset($_GET['id'])){echo $myuser->address;}?>" class="text" />
							</div><!-- End Box -->
						</div>
						<div class="one-third column">
							<div class="form-box">
								<label> <?php echo $CAP_occupation ?>:</label>
								 <input  type="text" name="txtoccupation" id="txtoccupation" value="<?php if(isset($_POST['txtoccupation'])){echo $_POST['txtoccupation'];}elseif(isset($_GET['id'])){echo $myuser->occupation;}?>" class="text"/>
							</div><!-- End Box -->
						</div>

						
						<div class="one-third column">
							<div class="form-box">
								<label>  <?php echo $CAP_userstatus?></label>
								<?php 
			if(isset($_POST['txtuserstatus'])){
				$user_status_id=$_POST['txtuserstatus'];
			}else{
				$user_status_id=$myuser->user_status_id;
			}
			populate_list_array("txtuserstatus", $user_statuses, "id", "name",$user_status_id,$disable=false); ?>  
							</div><!-- End Box -->
						</div>
				<?php if(!isset($_GET['id']) && !isset($_POST['h_id'])){ ?>
						<div class="one-third column">
							<div class="form-box">
								<label> <?php echo $CAP_credit ?> :</label>
								 <input   type="text" name="txtcredit" value="<?php if(isset($_POST['txtcredit'])){echo $_POST['txtcredit'];}?>" class="text" id="txtcredit"/>
								 	<span id="sp_org_credit"></span>
							</div><!-- End Box -->
						</div>
						<?php } ?>
						<div class="sixteen columns">
							<div class="form-box">
								<?php if ( isset($_GET['id']) || isset($_POST['h_id']) ){?>
                    <input type="submit" name="submit" value="<?php echo $CAP_update?>" onClick="return validate_member_update();" class="button">
                   <div style="overflow:hidden;display:none;"> <input type="Submit" name="submit" value="<?php echo $CAP_delete?>"  class="button deleteuser"></div>
					<input type="button" name="delete" value="<?php echo $CAP_delete?>" class="button delete">
<input type="hidden" name="h_id" value="<?php if( isset($_GET['id']) ){echo $myuser->id;}elseif ( isset($_POST['h_id']) ){ echo $_POST['h_id'];}?>">
                    <?php }else{ ?>
                    <input type="submit" name="submit" value="<?php echo$CAP_add?>" onClick="return validate_member_update();" class="button">
                    <?php }?>
                    
								
							</div>
						</div>
					</form>
				</div>

























     
                        
     
              
