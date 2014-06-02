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
      <td><?php echo $CAP_created ?></td>
      <td><input name="txtcreated" value="<?php if(isset($_POST['txtcreated'])){echo $_POST['txtcreated'];}?>" /></td>
</tr>
<tr>
	<td><?php echo $CAP_csvfile ?></td>
      <td><input name="txtcsvfile"  value="<?php if(isset($_POST['txtcsvfile'])){echo $_POST['txtcsvfile'];}?>"></td>
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
        <th class="slno"></th>
        <th><?php echo $CAP_created?></th>
        <th><?php echo $CAP_csvfile?></th>
    	<th><?php echo $CAP_view_action?></th>
	<th><?php echo $CAP_update_question?></th>
	<th><?php echo $CAP_delete_question?></th>
   

    </tr>

     <?php
     //to number each record in a page
    
     $style = "row_lite";
     $index = 0;
     $slno = ($Mypagination->page_num*$Mypagination->max_records)+1;

     while ( $count_data_bylimit > $index ){
        $link = "temp_questions.php?importid=".$data_bylimit[$index]["id"]."";
	$link_update="exports.php?importid=".$data_bylimit[$index]["id"]."";
	$link_delete="delete_questions.php?importid=".$data_bylimit[$index]["id"]."";
	    if ( $style == "row_lite" ){
            $style="row_dark";
        }
        else{
            $style="row_lite";
        }

        ?>
    <tr onmouseover="this.className='row_highlight'" onmouseout="this.className='<?php echo $style; ?>'"  class="<?php echo $style; ?>" >
        <td><?php echo $slno++ ?></td>
        <td><a href="<?php echo $link; ?>"><?php echo $data_bylimit[$index]["created"]; ?></a></td>
        <td><?php echo $data_bylimit[$index]["csv_file"]; ?></td>
	<td><a href="<?php echo $link; ?>"><?php echo $CAP_view ?></a></td>
	<td><a href="<?php echo $link_update; ?>"><?php echo $CAP_update ?></a></td>
	<td><a href="<?php echo $link_delete; ?>"><?php echo $CAP_delete ?></a></td>
    </tr><?php
         $index++;
    }
    ?>
    <tr><td colspan="5">&nbsp;</td></tr>
  </table>

        <!--For pagination. we can create a  diff style  & use-->
        <?php $Mypagination->pagination_style2(); ?>

      <?php } ?>



