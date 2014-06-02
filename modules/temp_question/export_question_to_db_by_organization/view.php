<?php // prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

$breadcrumb='<a href="/organization/index.php">Home</a> &raquo; <a href="/organization/exports.php?importid="'.$mytempquestion->question_import_id.'">Exports</a>'; 
?>


<div class="innercontainer-blk">
					<p class="heading">Update Questions to DB</p>
					<form name="frmupdate" id="frmupdate" method="POST" action="<?php echo $current_url;?>">
						
						<div class="one-third column">
							<div class="form-box">
								<label>Import Id </label>
								 <input type="hidden" name="txtimport_id" value="<?php if(isset($_POST['txtimport_id'])){echo $_POST['txtimport_id'];}else if(isset($_GET['importid'])){echo $_GET['importid'];} ?>">
								</div><!-- End Box -->
						</div>
						<div class="one-third column">
							<div class="form-box">
								<label>: <?php echo $myquestionimports->id; ?></label>
								 
								</div><!-- End Box -->
						</div>
						<div class="clear"></div>
						<div class="one-third column">
							<div class="form-box">
								<label>Created  </label>
								
							</div><!-- End Box -->
						</div>
						<div class="one-third column">
							<div class="form-box">
								<label>: <?php echo $myquestionimports->created?></label>
								
							</div><!-- End Box -->
						</div>
						<div class="clear"></div>
						<div class="one-third column">
							<div class="form-box">
								<label>Csv File </label>
								
							</div><!-- End Box -->
						</div>
						<div class="one-third column">
							<div class="form-box">
								<label>: <?php echo $myquestionimports->csv_file?></label>
								
							</div><!-- End Box -->
						</div>
						<div class="clear"></div>
						<div class="one-third column">
							<div class="form-box">
								<label>Date Of Import </label>
								
							</div><!-- End Box -->
						</div>
						<div class="one-third column">
							<div class="form-box">
								<label>: <?php echo $myquestionimports->date?></label>
								
							</div><!-- End Box -->
						</div>
						<div class="clear"></div>
						<div class="one-third column">
							<div class="form-box">
								<label>Total Question </label>
								
							</div><!-- End Box -->
						</div>
						<div class="one-third column">
							<div class="form-box">
								<label>: <?php echo $myquestionimports->total_questions?></label>
								
							</div><!-- End Box -->
						</div>
						<div class="clear"></div>
						<div class="one-third column">
							<div class="form-box">
								<label>Verified Question</label>
								
							</div><!-- End Box -->
						</div>
						<div class="one-third column">
							<div class="form-box">
								<label>: <?php echo $myquestionimports->total_verified_questions?></label>
								
							</div><!-- End Box -->
						</div>
						<div class="clear"></div>
						<div class="one-third column" >
							<div class="form-box">
								<input name="submit" value="submit" type="submit" class="button" >
								<?php if($chk_existence!=true) { ?><input name="delete" value="delete" type="submit" class="button" > <?php  } ?>
							</div>
						
						</div>
						<div class="one-third column">
							<div class="form-box">
								 
						
							</div>
						
						</div>

					</form>
				</div>















