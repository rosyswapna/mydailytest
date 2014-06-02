

$(document).ready(function(){


	$("#print_div").click(function(){
		var printContents = document.getElementById("print_div_content").innerHTML;
     	var originalContents = document.body.innerHTML;

    	 document.body.innerHTML = printContents;

     	window.print();

     	document.body.innerHTML = originalContents;
		

	});
});