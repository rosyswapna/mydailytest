<?php $breadcrumb='<a href="/index.php">Home</a> &raquo; <a href="/result.php?id='.$_GET["id"].'">Results</a>&raquo; <a href="/review.php?id='.$_GET["id"].'">Detailed Analysis</a>'; ?>
	<script type="text/javascript">
	window.onload = function () {
		var chart = new CanvasJS.Chart("chartContainer",
		{
			title:{
				text: "",
				fontFamily: ""

			},
			legend: {
				verticalAlign: "bottom",
				horizontalAlign: "center"
			},
			toolTip:{
				enabled: true
			},
			theme: "theme1",
			data: [
			{        
				type: "pie",
				indexLabelFontFamily: "",       
				indexLabelFontSize: 11,
				lineThickness: 0,
				indexLabelFontWeight: "bold",
				startAngle:0,
				indexLabelFontColor: "black",       
				indexLabelLineColor: "darkgrey", 
				indexLabelPlacement: "inside", 
				toolTipContent: "{name}: {y}",
				showInLegend: true,
				dataPoints: [
				{  y: <?php echo $notattempted?>, <?php if ($notattempted==0) { ?>indexLabel: "" , name: " "}, <?php } else {?> indexLabel: "  <?php echo round($notattempted/$total_questions*100)?> %" , name: " "},<?php }?>
				{  y: <?php echo $total_wrong_answers?>, <?php if ($total_wrong_answers==0) { ?>indexLabel: "" , name: " "}, <?php } else {?> indexLabel: "  <?php echo round($total_wrong_answers/$total_questions*100)?> %", name: " "},  <?php }?>
				{  y: <?php echo $total_correct_answers?>,<?php if ($total_correct_answers==0) { ?>indexLabel: "" , name: " "}, <?php } else {?>  indexLabel: "  <?php echo round($total_correct_answers/$total_questions*100)?> %", name: " "} <?php }?>
				
				]
			}
			]
		});

		chart.render();
	}
	</script>
	<script type="text/javascript" src="script/canvasjs.min.js"></script>


				<div class="innercontainer-blk">
					<p class="heading">
						<span class="fleft">Detailed Analysis : <?php echo $quiz->name; ?>  </span>
						<span class="fright"></span>
					</p>
					<div class="sixteen columns mright8 bottom-4" style="border-bottom:1px solid #ccc">
						<div class="inner-box">
							<p class="description ">Total No. of Questions : <strong><?php echo $total_questions  ?></strong>  |  No. of Questions Answered: <strong><?php echo $total_questions_answered; ?></strong>  |  No. of Correct Answers : <strong><?php echo $total_correct_answers; ?></strong></p>
							<p class="description bottom-1">No. of Wrong Answers : <strong><?php echo $total_wrong_answers; ?></strong>  | </p>
							<p class="description fright"> <a href="/result.php?id=<?php echo $_GET["id"]; ?>"><input value="Back to Result" class="button" type="button" name="finish"  /></a></p>														
						</div>

						<?php if($user_marks==false){}else{?>
						<div class="tablestyle" style="display:none;">
							<table border="0" >
								<thead>
								<tr>
									<th>Subject</th>
									<th>correct</th>
									

									<th>Total Mark</th>
									<th>Maximum Mark</th>
								</tr>
								</thead>
								<tbody>
								<?php 
									$i=0;
									$total_mark = 0;
									$total_user_mark = 0;
									while(count($user_marks) > $i)
									{
										$total_mark = $total_mark + $user_marks[$i]['total_mark'];
										$total_user_mark = $total_user_mark + $user_marks[$i]['total_user_mark'];
								?>
								<tr>
									<td><?php echo $user_marks[$i]['subject']; ?></td>
									<td><?php echo $user_marks[$i]['correct']; ?></td>
									<td><?php echo $user_marks[$i]['total_user_mark']; ?></td>
									<td><?php echo $user_marks[$i]['total_mark']; ?></td>
								</tr>
								
								<?php 
										$i++;
									}
								?>
								<tr>
									<td>Total</td>
									<td><?php echo $total_user_mark; ?></td>
									<td><?php echo $total_mark; ?></td>
								</tr>
								</tbody>
							</table>
						</div>
						<?php }?>


					</div>
		<!--#1 TEST PERFORMANCE PIE CHART (USER TREND)-->
		<div class="sixteen columns acenter bottom-4"><u><strong>Test Performance - %</strong></u><br />			
		<div id="chartContainer" style="height: 300px; margin-right:350px; display:inline-block; position:relative; width: 400px;"></div>		
		<table style="margin-left:100px; margin-bottom:20px;" width="0" border="0" cellspacing="0" cellpadding="0">
				<tr>

						<td> &nbsp;&nbsp;Correct &nbsp;&nbsp;</td>				
						<td width="20" bgcolor="#17C864">&nbsp;</td>				
						<td> &nbsp;&nbsp;Incorrect &nbsp;&nbsp; </td>
						<td width="20" bgcolor="#B40A0A">&nbsp;</td>
						<td>&nbsp;&nbsp;Unaswered &nbsp;&nbsp; </td>
						<td width="20" bgcolor="#F0C500">&nbsp;</td>						
				</tr>
		</table>										
		</div>		<br /><hr /><br />
		<!--#1 END -->
		
		<!--#2 TEST PERFORMANCE BAR GRAPH (USER TREND)-->
		<div class="sixteen columns acenter bottom-4" >&nbsp;&nbsp;&nbsp;&nbsp;<u><strong>Test Performance - Numbers</strong></u><br /><br />
					<div style="margin-right:350px;">
					<?php
					$mychartgraph_usertrend->canvas_height="370";
					$mychartgraph_usertrend->canvas_width="240";
					$mychartgraph_usertrend->canvas="usertrend";
					$mychartgraph_usertrend->graph();
					?>
					</div>
			<table style="margin-left:100px; margin-bottom:20px;" width="0" border="0" cellspacing="0" cellpadding="0">
					<tr>

						<td> &nbsp;&nbsp;Correct &nbsp;&nbsp;</td>				
						<td width="20" bgcolor="#17C864">&nbsp;</td>				
						<td> &nbsp;&nbsp;Incorrect &nbsp;&nbsp; </td>
						<td width="20" bgcolor="#B40A0A">&nbsp;</td>
						<td>&nbsp;&nbsp;Unaswered&nbsp;&nbsp; </td>
						<td width="20" bgcolor="#F0C500">&nbsp;</td>						
					</tr>
			</table>					
		</div><hr /><br />	
		<!--#2 END -->
		
		<!--#3 SUBJECT AVERAGE BAR GRAPH (USER TREND)-->			
		<div class="sixteen columns acenter bottom-4">&nbsp;&nbsp;&nbsp;&nbsp;<u><strong>Test Performance - Subject Wise</strong></u><br /><br />
		<div style="margin-right:350px;">
		<?php $mychartgraph->canvas_height="370";
		$mychartgraph_subject_count=($mychartgraph_subject_count*240);
		if($mychartgraph_subject_count > 960){$mychartgraph_subject_count=960;}
		$mychartgraph->canvas_width=$mychartgraph_subject_count;
		$mychartgraph->graph();?>
		</div>
		</div><br /><br />
		<table style="margin-left:100px; margin-bottom:20px;" width="0" border="0" cellspacing="0" cellpadding="0">
				<tr>

						<td> &nbsp;&nbsp;Correct &nbsp;&nbsp; </td>
						<td width="20" bgcolor="#17C864">&nbsp;</td>
						<td> &nbsp;&nbsp;Incorrect &nbsp;&nbsp;</td>				
						<td width="20" bgcolor="#B40A0A">&nbsp;</td>
						<td>&nbsp;&nbsp;Answered &nbsp;&nbsp; </td>
						<td width="20" bgcolor="#CCC">&nbsp;</td>		
						<td>&nbsp;&nbsp;Unanswered &nbsp;&nbsp; </td>
						<td width="20" bgcolor="#F0C500">&nbsp;</td>										
				</tr>
		</table> 
		<!--#3 END -->
				
		<!--#4 USER AVERAGE BAR GRAPH (USER TREND)-->
		<div class="sixteen columns acenter bottom-4">&nbsp;&nbsp;&nbsp;&nbsp;<u><strong>User Average</strong></u><br /><br />
				<div style="margin-right:350px;">
				<?php
				$mychartgraph_useravge->canvas_height="370";
				$mychartgraph_useravge->canvas_width="240";
				$mychartgraph_useravge->canvas="useraverage";
				$mychartgraph_useravge->graph();
				?>
				</div>
		</div>
					   
		<table style="margin-left:100px; margin-bottom:20px;" width="0" border="0" cellspacing="0" cellpadding="0">
				<tr>
				
					<td> &nbsp;&nbsp;Average Number of Correct Answer &nbsp;&nbsp;</td>				
					<td width="20" bgcolor="#17C864">&nbsp;</td>
					<td> &nbsp;&nbsp;Average Number of Wrong Answer &nbsp;&nbsp; </td>
					<td width="20" bgcolor="#B40A0A">&nbsp;</td>
					<td>&nbsp;&nbsp;Average Number  Answered &nbsp;&nbsp; </td>
					<td width="20" bgcolor="#CCC">&nbsp;</td>					
			</tr>
		</table>		<br /><hr /><br />		
		<!--#4 END -->	
		
