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
                    <?php if(isset( $myagent->error_description)) echo $myagent->error_description; ?>
                    </td>
                </tr>
                
                <tr>
                    <td>
                        <?php echo$CAP_username?>
                    </td>   
                    <td>
                        <input type="text" name="txtusername" id="txtusername" value="<?php if(isset($_POST['txtusername'])){echo $_POST['txtusername'];}elseif(isset($_GET['id'])){echo $myagent->username;}?>"  ><div id='username_availability_result'></div></td><td><?php if(!isset($_GET['id']) && !isset($_POST['h_id'])){ ?><input type="button" name="check_availability" id="check_availability" value="<?php echo$CAP_available?>" /><?php } if(isset($_GET['id']) || isset($_POST['h_id'])){?><input  type="hidden" name="hiddenusername" value="<?php if(isset($_POST['hiddenusername'])){echo $_POST['hiddenusername'];}elseif(isset($_GET['id'])){echo $myagent->username;}?>"  ><?php } ?>
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
                        <?php echo $CAP_name?>
                    </td>   
                    <td>
                    <input type="text" name="txtname" value="<?php if(isset($_POST['txtname'])){echo $_POST['txtname'];}elseif(isset($_GET['id'])){echo $myagent->name;}?>"  >
                    </td>
                </tr>

		
                    </td>
                </tr>

			<tr>
                    <td>
			<?php 
			if(isset($_POST['txtagent_status'])){
				$agent_status_id=$_POST['txtagent_status'];
			}elseif(isset($_GET['id'])){
				$agent_status_id=$myagent->agent_status_id;
			}else{ $agent_status_id=gINVALID;
			}
                        echo $CAP_agentstatus?>
                    </td>   
                    <td><?php populate_array("txtagent_status",$agent_statuses,$agent_status_id,$disable=false); ?>
                    </td>
                </tr>
		

                <tr>
                    <td>
                        <?php echo $CAP_email?>
                    </td>   
                    <td>
                        <input  type="text" name="txtemail" value="<?php if(isset($_POST['txtemail'])){echo $_POST['txtemail'];}elseif(isset($_GET['id'])){echo $myagent->email;}?>"  />
                    </td>
                </tr>

                
                <tr>
                    <td>
                        <?php echo $CAP_phone ?>
                    </td>   
                    <td>
                        <input   type="text" name="txtphone" value="<?php if(isset($_POST['txtphone'])){echo $_POST['txtphone'];}elseif(isset($_GET['id'])){echo $myagent->phone;}?>" />
                    </td>
                </tr>
		
		<tr>
                    <td>
                        <?php echo $CAP_address ?>
                    </td>   
                    <td>
                        <input  type="text" name="txtaddress" id="txtaddress" value="<?php if(isset($_POST['txtaddress'])){echo $_POST['txtaddress'];}elseif(isset($_GET['id'])){echo $myagent->address;}?>" />
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
<input type="hidden" name="h_id" value="<?php if( isset($_GET['id']) ){echo $myagent->id;}elseif ( isset($_POST['h_id']) ){ echo $_POST['h_id'];}?>">

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
