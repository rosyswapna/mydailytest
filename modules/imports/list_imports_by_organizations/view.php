<?php
  // prevent execution of this code by direct call from browser
  if ( !defined('CHECK_INCLUDED') ){
    exit();
  }

$breadcrumb='<a href="/organization/index.php">Home</a> &raquo; <a href="/organization/imports.php">Imports</a>'; 
?>

<div class="innercontainer-blk">
					<p class="heading"> <?php echo $CAP_page_caption?></p>
					<form name="frmsearch" id="frmsearch" method="POST" action="<?php echo $current_url;?>">
			<div class="sixteen columns">
						<div class="one-third column">
							<div class="form-box">
								<label><?php echo $CAP_created ?></label>
								<input name="txtcreated" value="<?php if(isset($_POST['txtcreated'])){echo $_POST['txtcreated'];}?>" class="text" >
							</div><!-- End Box -->
						</div>
						
						<div class="one-third column">
							<div class="form-box">
								<label><?php echo $CAP_csvfile ?></label>
								<input name="txtcsvfile"  value="<?php if(isset($_POST['txtcsvfile'])){echo $_POST['txtcsvfile'];}?>"class="text">
							</div><!-- End Box -->
						</div>
						
						<div class="sixteen columns">
							<div class="form-box">
								<input name="submit" value="<?php echo $CAP_submit?>" type="submit" class="button" >
								
							</div>
						</div>
						</div>
					</form>
				</div>

<br><br><br><br>
 <?php
    if ( $data_bylimit == false ){
	$_SESSION[SESSION_TITLE.'flash'] =$MSG_mesg;
	}else
	{ ?>


<div class="innercontainer-blk">
					<p class="heading">
						<span class="fleft">Imports</span>
						<span class="pagination fright">
							 <?php $Mypagination->pagination_style_number_with_button(); ?>
						</span>
					</p>
					<div class="sixteen columns mright8 bottom-1">
						<div class="tablestyle">
							<table>
								<thead>
								<tr>	<th>Slno</th>
									<th><?php echo $CAP_created?></th>
									<th><?php echo $CAP_csvfile?></th>
									<th><?php echo $CAP_view_action?></th>
									 <th><?php echo $CAP_update_question?></th>
									<th><?php echo $CAP_delete_question?></th>
									
								</tr>
								</thead>
								<tbody>
						<?php $index=0;$slno =($Mypagination->page_num*$Mypagination->max_records)+1;

        while ( $count_data_bylimit > $index ){
        $link = "temp_questions.php?importid=".$data_bylimit[$index]["id"]."";
		$link_update="exports.php?importid=".$data_bylimit[$index]["id"]."";
		$link_delete="delete_questions.php?importid=".$data_bylimit[$index]["id"]."";
	
        ?>
								<tr>
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
			</tbody>
			</table>
					   </div>	
					</div>
					
					<div class="sixteen columns bottom-1">
						<span class="pagination fright">
						 <?php $Mypagination->pagination_style_number_with_button(); }?>	
						</span>
					</div>
				</div>

<br><br>
	<div align="center">* You can Click on a imports to "view details"</div>


