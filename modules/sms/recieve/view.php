<?php // prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}
?><form  name="frmupdate" id="frmupdate" method="post" action="<?php echo $current_url; ?>" enctype="multipart/form-data">
      <!--<html> --> 
            <table border="0" cellpadding="0" cellspacing="2"  >
                
                <tr>
                    <td colspan="2" class="errormessage">
                    <?php if(isset( $myuser->error_description)) echo $myuser->error_description; ?>
                    </td>
                </tr>
             </table>
            </form>
