<?php // prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}
?><form  name="frmupdate" id="frmupdate" method="post" action="<?php echo $current_url; ?>" enctype="multipart/form-data">
      <!--<html> --> 
            <table border="0" cellpadding="0" cellspacing="2"  >
                <tr>
                    <td colspan="2" class="page_caption">
                    <?php if ( isset($_GET['id']) || isset($_POST['h_id']) ){?>
                    <?php echo $CAP_page_caption_update?>
                    <?php }else{?>
                    <?php echo $CAP_page_caption_add?>
                    <?php }?>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;&nbsp;</td>    
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="2" class="errormessage">
                    <?php if(isset( $myuser->error_description)) echo $myuser->error_description; ?>
                    </td>
                </tr>
                
                <tr>
                    <td>
                        <?php echo$CAP_username?>
                    </td>   
                    <td>
                        <input type="text" name="txtusername" id="txtusername" value="<?php if(isset($_POST['txtusername'])){echo $_POST['txtusername'];}elseif(isset($_GET['id'])){echo $myuser->username;}?>"  ><div id='username_availability_result'></div></td><td><?php if(!isset($_GET['id']) && !isset($_POST['h_id'])){ ?><input type="button" name="check_availability" id="check_availability" value="<?php echo$CAP_available?>" /><?php } if(isset($_GET['id']) || isset($_POST['h_id'])){?><input  type="hidden" name="hiddenusername" value="<?php if(isset($_POST['hiddenusername'])){echo $_POST['hiddenusername'];}elseif(isset($_GET['id'])){echo $myuser->username;}?>"  ><?php } ?>
                    </td>
                </tr>

                </tr>
		<?php if(!isset($_GET['id']) && !isset($_POST['h_id'])){ ?>
		<tr>
                    <td>
                        <?php echo $CAP_password?>
                    </td>   
                    <td>
                         <input type="password" name="txtpassword">   
                    </td>
                </tr>

		
                    </td>
                </tr>
                
                <tr>
                    <td>
                        <?php echo $CAP_repassword?>
                    </td>   
                    <td>
                        <input type="password" name="txtrepassword">
                    </td>
                </tr>

                <?php }?>
                <tr>
                    <td>
                        <?php echo $CAP_firstname?>
                    </td>   
                    <td>
                    <input type="text" name="txtfirstname" value="<?php if(isset($_POST['txtfirstname'])){echo $_POST['txtfirstname'];}elseif(isset($_GET['id'])){echo $myuser->first_name;}?>"  >
                    </td>
                </tr>

		
                    </td>
                </tr>
                
                <tr>
                    <td>
                        <?php echo $CAP_lastname?>
                    </td>   
                    <td>
                        <input type="text" name="txtlastname" value="<?php if(isset($_POST['txtlastname'])){echo $_POST['txtlastname'];}elseif(isset($_GET['id'])){echo $myuser->last_name;}?>"  >
                    </td>
                </tr>

		
		<tr>
                    <td>
                        <?php echo $CAP_userstatus?>
                    </td>   
                    <td><?php 
			if(isset($_POST['txtuserstatus'])){
				$user_status_id=$_POST['txtuserstatus'];
			}else{
				$user_status_id=$myuser->user_status_id;
			}
			populate_list_array("txtuserstatus", $user_statuses, "id", "name",$user_status_id,$disable=false); ?>  
                    </td>
                </tr>
		

                <tr>
                    <td>
                        <?php echo $CAP_email?>
                    </td>   
                    <td>
                        <input  type="text" name="txtemail" value="<?php if(isset($_POST['txtemail'])){echo $_POST['txtemail'];}elseif(isset($_GET['id'])){echo $myuser->email;}?>"  />
                    </td>
                </tr>

                
                <tr>
                    <td>
                        <?php echo $CAP_phone ?>
                    </td>   
                    <td>
                        <input   type="text" name="txtphone" value="<?php if(isset($_POST['txtphone'])){echo $_POST['txtphone'];}elseif(isset($_GET['id'])){echo $myuser->phone;}?>" />
                    </td>
                </tr>
		
		<tr>
                    <td>
                        <?php echo $CAP_address ?>
                    </td>   
                    <td>
                        <input  type="text" name="txtaddress" id="txtaddress" value="<?php if(isset($_POST['txtaddress'])){echo $_POST['txtaddress'];}elseif(isset($_GET['id'])){echo $myuser->address;}?>" />
                    </td>
                </tr>

		<tr>
                    <td>
                        <?php echo $CAP_occupation ?>
                    </td>   
                    <td>
                        <input  type="text" name="txtoccupation" id="txtoccupation" value="<?php if(isset($_POST['txtoccupation'])){echo $_POST['txtoccupation'];}elseif(isset($_GET['id'])){echo $myuser->occupation;}?>" />
                    </td>
                </tr>
                
                <tr>
                    <td>&nbsp;</td>    
                    <td>&nbsp;</td>
                </tr>


                <tr>
					<td>&nbsp;</td>
                    <td><br />
                    <?php if ( isset($_GET['id']) || isset($_POST['h_id']) ){?>
                    <input type="submit" name="submit" value="<?php echo $CAP_update?>" onClick="return validate_member_update();" >
                    <input type="Submit" name="submit" value="<?php echo $CAP_delete?>" onClick="return delete_member();">
<input type="hidden" name="h_id" value="<?php if( isset($_GET['id']) ){echo $myuser->id;}elseif ( isset($_POST['h_id']) ){ echo $_POST['h_id'];}?>">
                    <?php }else{ ?>
                    <input type="submit" name="submit" value="<?php echo$CAP_add?>" onClick="return validate_member_update();">
                    <?php }?>
                    
                   
                    </td>
                </tr>

                <tr>
                    <td colspan="2" align="center"><br />
                    
                    </td>
                </tr>
            </table>
            </form>
