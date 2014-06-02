<?php 
 $breadcrumb = '<a href="/index.php">Home</a> &raquo; <a href="/demo_result.php?id='.$demotest->id.'">Demo Result</a> &raquo; <a href="/demo_detailed_analysis?id='.$demotest->id.'">Demo Detailed Analysis</a>';
 ?> 
<script type="text/javascript">
	window.onload = function () {
		
		var chart = new CanvasJS.Chart("chartContainer",
		{
			title:{
				text: "",
				fontFamily: "'Arial'"

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
				indexLabelFontFamily: "'Arial'",       
				indexLabelFontSize: 11,
				indexLabelFontWeight: "bold",
				startAngle:0,
				indexLabelFontColor: "black",       
				indexLabelLineColor: "darkgrey", 
				indexLabelPlacement: "inside", 
				toolTipContent: "{name}: {y}",
				showInLegend: true,
				dataPoints: [
				{  y: <?php echo $notattempted?>, <?php if ($notattempted==0) { ?>indexLabel: "" , name: " "}, <?php } else {?> indexLabel: "  <?php echo round($notattempted/$total_questions*100)?> %" , name: " "},<?php }?>
				{  y: <?php echo $incorrect?>, <?php if ($incorrect==0) { ?>indexLabel: "" , name: " "}, <?php } else {?> indexLabel: "  <?php echo round($incorrect/$total_questions*100)?> %", name: " "},  <?php }?>
				{  y: <?php echo $correct?>,<?php if ($correct==0) { ?>indexLabel: "" , name: " "}, <?php } else {?>  indexLabel: "  <?php echo round($correct/$total_questions*100)?> %", name: " "} <?php }?>
				
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
		<span class="fleft">Result : <?php echo $myquiz->name;?></span>

	</p>
	<div class="sixteen columns mright8 bottom-4" style="border-bottom:1px solid #ccc">
		<div class="inner-box">
			<p class="description ">Total No. of Quesions : <strong><?php echo $total_questions; ?></strong>  |  No. of Quesions Answered: <strong><?php echo $attempted; ?></strong>  |  No. of Correct Answers : <strong><?php echo $correct; ?></strong></p>
			<p class="description bottom-1">No. of Wrong Answers : <strong><?php echo $incorrect; ?></strong> </p>
			<p class="description fright">
				<span class="bold-bg">For detailed reports, reviews please 
					<a href="/sign_up.php">
						<input type="submit" class="button" value="Sign Up">
					</a>
				</span>  
				<span class="bold-bg1">
					<a href="/demo_result.php?id=<?php echo $demotest->id;?>">
						<input type="submit" class="button" value="Questions Review">
					</a>
				</span>
			</p>														
		</div>	
	</div>

	<div class="sixteen columns acenter bottom-4">
		<span class="fleft">
		<strong><u>Test Performance - Numbers</u></strong> <br />

				<?php
				$mychartgraph_useravge->canvas_height="370";
				$mychartgraph_useravge->canvas_width="250";
				$mychartgraph_useravge->canvas="useraverage";
				$mychartgraph_useravge->graph();
				?>
		<table style="margin-left:30px; margin-bottom:20px;" width="0" border="0" cellspacing="0" cellpadding="0">
				<tr>
		
						<td> &nbsp;&nbsp;Correct &nbsp;&nbsp;</td>				
						<td width="20" bgcolor="#17C864">&nbsp;</td>				
						<td> &nbsp;&nbsp;Incorrect &nbsp;&nbsp; </td>
						<td width="20" bgcolor="#C24642">&nbsp;</td>
						<td>&nbsp;&nbsp;Unanswered &nbsp;&nbsp; </td>
						<td width="20" bgcolor="#F0C500">&nbsp;</td>				
		
				</tr>
				
		</table> 		
		</span>
					
		<span class="fright">
		<strong><u>Test Performance - %</u></strong><br /><br /><br /><br />
		<div id="chartContainer" style="height: 300px; display:inline-block; position:relative; width: 400px;"></div><br /><br /><br /><br /><br />
		<table style="margin-left:30px; margin-bottom:20px;" width="0" border="0" cellspacing="0" cellpadding="0">
				<tr>
		
						<td> &nbsp;&nbsp;Correct &nbsp;&nbsp;</td>				
						<td width="20" bgcolor="#17C864">&nbsp;</td>				
						<td> &nbsp;&nbsp;Incorrect &nbsp;&nbsp; </td>
						<td width="20" bgcolor="#C24642">&nbsp;</td>
						<td>&nbsp;&nbsp;Unanswered &nbsp;&nbsp; </td>
						<td width="20" bgcolor="#F0C500">&nbsp;</td>				
		
				</tr>
				
		</table>
		</span>
	</div>
</div>

