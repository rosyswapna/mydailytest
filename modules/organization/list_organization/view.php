<?php
  // prevent execution of this code by direct call from browser
  if ( !defined('CHECK_INCLUDED') ){
    exit();
  }
?>

<form name="frmsearch" id="frmsearch" method="POST" action="<?php echo $current_url;?>">
<table align="center">
<tr>
    <td colspan="2" class="page_caption">
    <?php echo $CAP_page_caption?>
    </td>
</tr>
    <tr>
      <td><?php echo $CAP_username ?></td>
      <td><input  name="txtusername" value="<?php if(isset($_POST['txtusername'])){echo $_POST['txtusername'];}?>"></td>
</tr>
<tr>
	<td><?php echo $CAP_name ?></td>
      <td><input name="txtname" value="<?php if(isset($_POST['txtname'])){echo $_POST['txtname'];}?>"></td>
</tr>
<tr>
	<td><?php echo $CAP_email ?></td>
      <td><input name="txtemail" value="<?php if(isset($_POST['txtemail'])){echo $_POST['txtemail'];}?>"></td>
</tr>
<tr>
<td><?php echo $CAP_phone ?></td>
      <td><input name="txtphone" value="<?php if(isset($_POST['txtphone'])){echo $_POST['txtphone'];}?>" ></td>
    </tr> 

<tr>
                    <td>
                        <?php echo $CAP_organizationtype?>
                    </td>   
                    <td><?php populate_array("txtorganizationtype",$organization_types,$myorganization->organization_type_id,$disable=false); ?>  
                    </td>
                </tr>

<tr>
                    <td>
                        <?php echo $CAP_organization_status_id?>
                    </td>   
                    <td><?php populate_array("txtorganization_status",$organization_statuses,$myorganization->organization_status_id,$disable=false); ?>  
                    </td>
                </tr>
 <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;&nbsp;</td>
      <td><input name="submit" value="<?php echo $CAP_submit?>" type="submit"></td>
    </tr>
</table>
</form>

<table  border="0" cellpadding="1px" cellspacing="1px">
     <tr><td colspan="7">&nbsp;</td></tr>
    <?php
    if ( $data_bylimit == false ){?>
     <tr><td colspan="7">&nbsp;</td></tr>
     <tr><td colspan="7" align="center" class="message" ><?php echo $MSG_mesg ?></td></tr>
     <tr><td colspan="7">&nbsp;</td></tr>
 </table>
    <?php
     }
     else{?>
    <tr>
        <th class="slno"></th>
        <th><?php echo $CAP_username?></th>
        <th><?php echo $CAP_name?></th>
         <th><?php echo $CAP_organization_status_id?></th>
	<th><?php echo $CAP_organization_type_id?></th>
        <th><?php echo $CAP_email?></th>
	<th><?php echo $CAP_phone?></th>
         <th><?php echo $CAP_reset?></th>
         <th><?php echo $CAP_credit?></th>

    </tr>

     <?php
     //to number each record in a page
    
     $style = "row_lite";
     $index = 0;
     $slno = ($Mypagination->page_num*$Mypagination->max_records)+1;

     while ( $count_data_bylimit > $index ){
        $link = "organization.php?id=".$data_bylimit[$index]["id"]."";
	    $link_reset_pswd="update_organization_password.php?id=".$data_bylimit[$index]["id"]."";
        

         if ( $style == "row_lite" ){
            $style="row_dark";
        }
        else{
            $style="row_lite";
        }

        ?>
    <tr onmouseover="this.className='row_highlight'" onmouseout="this.className='<?php echo $style; ?>'"  class="<?php echo $style; ?>" >
        <td><?php echo $slno++ ?></td>
        <td><a href="<?php echo $link; ?>"><?php echo $data_bylimit[$index]["username"]; ?></a></td>
        <td><?php echo $data_bylimit[$index]["name"]; ?></td>
        <td><?php echo $organization_statuses[$data_bylimit[$index]["organization_status_id"]]; ?></td>
	<td><?php echo $organization_types[$data_bylimit[$index]["organization_type_id"]]; ?></td>
        <td><?php echo $data_bylimit[$index]["email"]; ?></td>
	<td><?php echo $data_bylimit[$index]["phone"]; ?></td>
       
	<td><a href="<?php echo $link_reset_pswd; ?>">Reset password</a></td>
    <td><a href="set_credit_org.php?id=<?php echo $data_bylimit[$index]["id"]; ?>">credit</a></td>
    </tr><?php
         $index++;
    }
    ?>
    <tr><td colspan="7"></td></tr>
  </table>

        <!--For pagination. we can create a  diff style  & use-->
        <?php $Mypagination->pagination_style1(); ?>

      <?php } ?>



