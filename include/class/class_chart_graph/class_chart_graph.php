<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

class ChartGraph {
	var $canvas= "canvas";
	var $canvas_height= "450";
	var $canvas_width= "600";
	var $label = "";	
	var $datasets = array();

	
	
	function graph(){ ?>
	<?php 
	$datasets= "";
		foreach ($this->datasets as $dataset){
			//print_r($dataset); exit();
			$datasets.='{
					fillColor : "'.$dataset["color"].'",
					strokeColor : "rgba(220,220,220,1)",
					data : ['.$dataset["dataset"].']
				},';	
		}
		$datasets=substr($datasets,0,-1);
	     ?>
	<canvas id="<?php echo $this->canvas;?>" height="<?php echo $this->canvas_height;?>" width="<?php echo $this->canvas_width;?>"></canvas>
	<script>

		var barChartData = { labels : [<?php echo $this->label; ?>],
			datasets : [<?php echo $datasets;?>]
			}

	var myLine = new Chart(document.getElementById("<?php echo $this->canvas;?>").getContext("2d")).Bar(barChartData);
	
	</script>


<?php
	}
	
	
	
	
}
?>