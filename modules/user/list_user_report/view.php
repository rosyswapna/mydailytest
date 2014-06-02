<form name="frmsearch" id="frmsearch" method="POST" action="<?php echo $current_url;?>">
<table align="center">
<tr>
    <td colspan="2" class="page_caption">
    <?php echo $CAP_page_caption?>
    </td>
</tr>
    <tr>
      <td><?php echo $CAP_user_id;?></td>
      <td><input name="txtid" value="<?php if(isset($_POST['txtid'])){echo $_POST['txtid'];}?>" id="txtid" /></td>
</tr>
    <tr>
      <td><?php echo $CAP_username ?></td>
      <td><input name="txtusername" value="<?php if(isset($_POST['txtusername'])){echo $_POST['txtusername'];}?>" /></td>
</tr>
<tr>
	<td><?php echo $CAP_name ?></td>
      <td><input name="txtname"  value="<?php if(isset($_POST['txtname'])){echo $_POST['txtname'];}?>"></td>
</tr>
<tr>
	<td><?php echo $CAP_email ?></td>
      <td><input name="txtemail" value="<?php if(isset($_POST['txtemail'])){echo $_POST['txtemail'];}?>" ></td>
</tr>
<tr>
<td><?php echo $CAP_phone ?></td>
      <td><input name="txtphone" value="<?php if(isset($_POST['txtphone'])){echo $_POST['txtphone'];}?>"  ></td>
    </tr> 

<tr>
                    <td>
                        <?php echo $CAP_user_status_id?>
                    </td>   
                    <td><?php populate_array("txtuserstatus", $user_statuses,$myuser->user_status_id,$disable=false); ?> 
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
     <tr><td colspan="6">&nbsp;</td></tr>
    <?php
    if ( $data_bylimit == false ){?>
     <tr><td colspan="6">&nbsp;</td></tr>
     <tr><td colspan="6" align="center" class="message" ><?php echo $MSG_mesg ?></td></tr>
     <tr><td colspan="6">&nbsp;</td></tr>
 </table>
    <?php
     }
     else{?>
    <tr>
        <th class="slno">User Id</th>
        <th><?php echo $CAP_username?></th>
        <th><?php echo $CAP_email?></th>
        <th><?php echo $CAP_group?></th>
	 <th><?php echo $CAP_exam?></th>
	<th><?php echo $CAP_registration_date?></th>
    <th><?php echo $CAP_Action?></th> 

    </tr>

     <?php
     //to number each record in a page
    
     $style = "row_lite";
     $index = 0;
     $slno = ($Mypagination->page_num*$Mypagination->max_records)+1;

     while ( $count_data_bylimit > $index ){
        $link = "user.php?id=".$data_bylimit[$index]["id"]."";
	    $link_reset_pswd="update_user_password.php?id=".$data_bylimit[$index]["id"]."";
        $link_credit = "set_credit.php?id=".$data_bylimit[$index]["id"]."";

         if ( $style == "row_lite" ){
            $style="row_dark";
        }
        else{
            $style="row_lite";
        }

        ?>
    <tr onmouseover="this.className='row_highlight'" onmouseout="this.className='<?php echo $style; ?>'"  class="<?php echo $style; ?>" >
        <td><?php echo $data_bylimit[$index]["id"]; ?></td>
        <td><a href="<?php echo $link; ?>"><?php echo $data_bylimit[$index]["username"]; ?></a></td>
         <td><?php echo $data_bylimit[$index]["email"]; ?></td>
        <td><?php  ?></td>
	
	<td><?php //echo $user_statuses[$data_bylimit[$index]["id"]]; ?></td>
	<td><?php echo date("d/m/Y H:i:s",strtotime($data_bylimit[$index]["registration_date"])); ?></td>
	<td><a href="user_report_details.php"><?php echo $CAP_Action;?></a></td>

    </tr><?php
         $index++;
    }
    ?>
    <tr><td colspan="5">&nbsp;</td></tr>
  </table>

        <!--For pagination. we can create a  diff style  & use-->
		<div align="center">
        <?php $Mypagination->pagination_style2(); ?>
		</div>
      <?php } ?>
<div id="credit_holder"> 
<a id="search_button" href="#">By User Id</a><br /><br />
<a id="search_button" href="#">By Email Id</a><br /><br />
<a id="search_button" href="#">By Group</a><br /><br />
<a id="search_button" href="#">By Date</a><br /><br />
</div>