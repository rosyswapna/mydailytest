<?php // prevent execution of this page by direct call by browser

if ( !defined('CHECK_INCLUDED') ){
    exit();
}
?>
<div class="two-thirds column mright8 bottom-1">
					<div class="innercontainer-blk">
						<p class="heading">My Profile <span class="s-18"></span>  <?php if(isset( $myuser->error_description)) echo $myuser->error_description; ?></p>
						<form  name="frmupdate" id="frmupdate" method="post" action="<?php echo $current_url; ?>" enctype="multipart/form-data">
						<div class="one-third column mright4">
							<div class="form-box">
								<label><?php echo $CAP_username ?> (Email Id)<small>*</small></label>
<input  type="text" name="txtusername" class="text" value="<?php echo $myuser->username; ?>" ><input  type="hidden" name="hiddenusername" value="<?php echo $myuser->username; ?>"  >						
							
							</div><!-- End Box -->
						</div>
						<div class="clear"></div>
						<div class="one-third column mright4">
							<div class="form-box">
								<label><?php echo $CAP_first_name ?> </label>
							<input  type="text" class="text" name="txtfirst_name" value="<?php echo $myuser->first_name; ?>"  >	
							</div><!-- End Box -->
						</div>
						<div class="one-third column mright4">
							<div class="form-box">
								<label><?php echo $CAP_last_name ?> </label>
								<input  type="text" name="txtlast_name" class="text" value="<?php echo $myuser->last_name; ?>"  >
							</div><!-- End Box -->
						</div>
						<div class="clear"></div>
						<div class="one-third column mright4">
							<div class="form-box">
								<label><?php echo $CAP_email ?></label>
								<input  type="text" name="txtemail" class="text" value="<?php echo $myuser->email;?>"  >
							</div><!-- End Box -->
						</div>
						<div class="clear"></div>
						<div class="one-third column mright4">
							<div class="form-box">
								<label><?php echo $CAP_occupation ?></label>
								<input  type="text" name="txtoccupation" class="text" value="<?php echo $myuser->occupation;?>"  >
							</div><!-- End Box -->
						</div>
						<div class="one-third column mright4">
							<div class="form-box">
								<label><?php echo $CAP_phone?></label>
								<input  type="text" name="txtphone" class="text" value="<?php echo $myuser->phone;?>"  >
							</div><!-- End Box -->
						</div>
						<div class="one-third column mright4">
							<div class="form-box big">
								<label><?php echo $CAP_address ?> </label>
								<textarea name="txtaddress"><?php echo $myuser->address;?></textarea>
							</div><!-- End Box -->
						</div>

						<div class="clear"></div>
						<div class="one-third column mright4">
							<div class="form-box">
							 <input type="submit" name="submit" class="button" value="<?php echo $CAP_update?>" onClick="return validate_member_update();" >
								<input type="reset" class="button gray" value="Cancel">
							</div>
						</div>
					
					</div>
				</div>
				
				<div class="one-third column mright8 bottom-1">
					<div class="credit-balance">
						<p class="head">Credit Balance:</p>
						<div class="dblk">
							<p class="fleft"><?php if(isset($_SESSION[SESSION_TITLE.'user_credit'])) echo $_SESSION[SESSION_TITLE.'user_credit']; ?></p>
							<p class="fright">
							
							</p>
						</div>
					</div>
					
				</div>
				
			   <h4>Exam Preferences</h4>
               <?php 
                if($my_exams== false){
                    echo "No Records found";
                }
                else{
                     $i=0;
                     $user_exam_preferences = explode(DEFAULT_IDS_DELIMITER, $myuser->exam_ids);
                     while(count($my_exams) > $i){
                        (in_array($my_exams[$i]['id'], $user_exam_preferences))?$checked="checked":$checked="";
                    ?>
                    <p class="exam_checkboxs">
                        <input type="checkbox" value="<?php echo $my_exams[$i]['id'];?>" name="chk_exam[]" <?php echo $checked; ?>>
                        <?php echo $my_exams[$i]['name'];?>
                    </p>
                    <?php
                        $i++;
                     }
                 }
                ?>
</form>
