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
        <!-- form start--><br><br><br>
            <form  target="_self" method="post" action="<?php echo $current_url?>" name="frmchange_passwd">
                <table border="0" cellpadding="0" cellspacing="2" >
                <tr>
                    <td colspan="2" class="page_caption"><?php echo $CAP_page_caption?></td>
                </tr>
                <tr>
                    <td colspan="2" class="errormessage" >
                       <?php if(isset($myuser)) { echo $myuser->error_description; echo $passwd_error ; }?>
                    </td>
                </tr>

                <tr>
                    <td>&nbsp;</td>    
                    <td>&nbsp;</td>
                </tr>
                       <td><?php echo $CAP_new_password ?></td>
                    <td><input  type="password" name="new_passwd" id="new_passwd" ></td>
                </tr>
                <tr>
                    <td><?php echo $CAP_retype_password ?></td>
                    <td><input type="password" name="retype_passwd" id="retype_passwd" ><input  type="hidden" name="u_id" id="u_id" value="<?php echo $u_id ?>" ></td>
                </tr>
                <tr>
					<td>&nbsp;</td>
                    <td><input value="<?php echo $CAP_update ?>" type="submit" name="submit" onClick="return validate_change_passwd();" />
                    </td>
                </tr>
                </table>
            </form><br><br><br><br><br><br><br><br><br><br>>

            <!-- form end-->
    <script language="javascript" type="text/javascript">
    //<!--
            document.getElementById("new_passwd").focus();
   //-->
    </script>
