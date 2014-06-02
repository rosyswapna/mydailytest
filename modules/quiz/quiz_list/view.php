<?php
  // prevent execution of this code by direct call from browser
  if ( !defined('CHECK_INCLUDED') ){
    exit();
  }
?>

<form name="frmsearch" id="frmsearch" method="get" action="<?php echo $current_url;?>">
<table align="center">
	<tr>
		<td colspan="2" class="page_caption">
		Quizzes
		</td>
	</tr>
		<tr>
		  <td>Search</td>
		  <td><input name="txtname" value="<?php if(isset($_GET['txtname'])){echo $_GET['txtname'];}?>" /></td>
	</tr>


	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>

    <tr>
      <td>&nbsp;&nbsp;</td>
      <td><input name="submit" value="Search" type="submit"></td>
    </tr>

</table>
</form>

<table  border="0" cellpadding="1px" cellspacing="1px">
     <tr><td colspan="6">&nbsp;</td></tr>
    <?php
    if ( $data_bylimit == false ){?>
     <tr><td colspan="6">&nbsp;</td></tr>
     <tr><td colspan="6" align="center" class="message" ><?php echo $mesg ?></td></tr>
     <tr><td colspan="6">&nbsp;</td></tr>
 </table>
    <?php
     }
     else{?>
    <tr>
        <th class="slno">Sl</th>
        <th>Quiz</th>
        <th>Action</th>
    </tr>

     <?php
     //to number each record in a page
    
     $style = "row_lite";
     $index = 0;
     $slno = ($Mypagination->page_num * $Mypagination->max_records)+1;

     while ( $count_data_bylimit > $index ){
        if ( $style == "row_lite" ){
            $style="row_dark";
        }else{
            $style="row_lite";
        }

        ?>
		<tr onmouseover="this.className='row_highlight'" onmouseout="this.className='<?php echo $style; ?>'"  class="<?php echo $style; ?>" >
		    <td><?php echo $slno++ ?></td>
		    <td><?php echo $data_bylimit[$index]["name"]; ?> (<?php echo $data_bylimit[$index]["credit"]; ?> Credits)</td>

			<td><input type="button" value="Take Test" class="button_take_test" quiz_id="<?php echo $data_bylimit[$index]["id"];?>" quiz_name="<?php echo $data_bylimit[$index]["name"];?>"  credit="<?php echo $data_bylimit[$index]["credit"];?>" url="<?php echo WEB_URL;?>"  ></td>		

		</tr>
	<?php  $index++; } ?>
    <tr><td colspan="4">&nbsp;</td></tr>
  </table>

        <!--For pagination. we can create a  diff style  & use-->
        <?php $Mypagination->pagination_style1(); ?>

      <?php } ?>

<input type="hidden" id="h_current_test_id" value="<?php if(isset($_SESSION[SESSION_TITLE.'usertestid'])) { echo $_SESSION[SESSION_TITLE.'usertestid']; } ?>" />
<div align="center">* You can Click on Take Test button to take test</div>
