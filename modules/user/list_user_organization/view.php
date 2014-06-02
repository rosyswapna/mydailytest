<?php
  // prevent execution of this code by direct call from browser
  if ( !defined('CHECK_INCLUDED') ){
    exit();
  }

$breadcrumb='<a href="/organization/index.php">Home</a> &raquo; <a href="/organization/users.php">Users</a>'; 
?>


<div class="innercontainer-blk">
					<p class="heading"><?php echo $CAP_page_caption?></p>
					<form name="frmsearch" id="frmsearch" method="POST" action="<?php echo $current_url;?>" id="ajax-contact-form"><div class="sixteen columns">
						<div class="one-third column">
							<div class="form-box">
								<label><?php echo $CAP_username ?></label>
								<input  name="txtusername" value="<?php if(isset($_POST['txtusername'])){echo $_POST['txtusername'];}?>" class="text" >
							</div><!-- End Box -->
						</div>
						
						<div class="one-third column">
							<div class="form-box">
								<label><?php echo $CAP_name ?></label>
								<input name="txtname" value="<?php if(isset($_POST['txtname'])){echo $_POST['txtname'];}?>" class="text">
							</div><!-- End Box -->
						</div>
						
						<div class="one-third column">
							<div class="form-box">
								<label><?php echo $CAP_email ?></label>
								<input name="txtemail" value="<?php if(isset($_POST['txtemail'])){echo $_POST['txtemail'];}?>" class="text">
							</div><!-- End Box -->
						</div>
						<div class="one-third column">
							<div class="form-box">
								<label><?php echo $CAP_phone ?></label>
								<input name="txtphone" value="<?php if(isset($_POST['txtphone'])){echo $_POST['txtphone'];}?>" class="text">
							</div><!-- End Box -->
						</div>
						<div class="one-third column">
							<div class="form-box">
								<label><?php
			if(isset($_POST['txtuserstatus'])){
				$userstatus_id=$_POST['txtuserstatus'];
			}else{
				$userstatus_id=$myuser->user_status_id;
			}
                     echo $CAP_user_status_id?></label>
								<?php populate_array("txtuserstatus", $user_statuses, $userstatus_id,$disable=false); ?> <input type ="hidden" name="h_id" value="<?php echo $myuser->organization_id;?>" >
							</div><!-- End Box -->
						</div><br>
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
	}
    	 else
	{ ?>


<div class="innercontainer-blk">
					<p class="heading">
						<span class="fleft">Users</span>
						<span class="pagination fright">
							 <?php $Mypagination->pagination_style_number_with_button(); ?>
						</span>
					</p>
					<div class="sixteen columns mright8 bottom-1">
						<div class="tablestyle">
							<table>
								<thead>
								<tr>	
									<th>Slno</th>
									<th><?php echo $CAP_username?></th>
									<th><?php echo $CAP_firstname?></th>
									<th><?php echo $CAP_lastname?></th>
									<th><?php echo $CAP_user_status_id?></th>
									<th><?php echo $CAP_email?></th>
									<th><?php echo $CAP_phone?></th>
									<th><?php echo $CAP_credit?></th>
								</tr>
								</thead>
								<tbody>
						<?php $index=0;$slno =($Mypagination->page_num*$Mypagination->max_records)+1;

     while ( $count_data_bylimit > $index ){
        $link = "user.php?id=".$data_bylimit[$index]["id"]."";
	
        ?>
								<tr>
				<td><?php echo $slno++ ?></td>
				<td><a href="<?php echo $link; ?>"><?php echo $data_bylimit[$index]["username"]; ?></a></td>
				<td><?php echo $data_bylimit[$index]["first_name"]; ?></td>
				<td><?php echo $data_bylimit[$index]["last_name"]; ?></td>
				<td><?php echo $user_statuses[$data_bylimit[$index]["user_status_id"]]; ?></td>
				<td><?php echo $data_bylimit[$index]["email"]; ?></td>
				<td><?php echo $data_bylimit[$index]["phone"]; ?></td>
			    <td><a href="get_credit_from_org.php?slno=<?php echo $data_bylimit[$index]["id"]; ?>">Credit</a></td>  
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
	<div align="center">* You can Click on a user name to "view details"</div>







