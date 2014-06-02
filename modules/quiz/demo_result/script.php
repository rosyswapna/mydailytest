 <!--
var current_url = "<?php echo $current_url.'?id='.$_GET['id']; ?>";

 var global_idle="";
function refresh() {
      popup_alert ("Please register to take real tests","sign_up.php","Signup","close");
  	global_idle="false";
}

var timer;
function start() {
 timer = setTimeout(function(){refresh()}, 30000);
}

$(document).ready(function() {
 
	 //custom number of questions per page
    $('#lstrecord_per_page').change(function(){
		$( "#hd_submit" ).trigger("click");		
    });
start();
       $("body").mousemove(function( event ) {
               if(global_idle==""){
		clearTimeout(timer);
               start(); 
	}
     
       });
$(document).scroll(function() {
 if(global_idle==""){
clearTimeout(timer);
 start();
}
});

$(document).keypress(function(e) {
	 if(global_idle==""){
               clearTimeout(timer);
               start();
	}
       });




       //links generated with button id
  $(".button_pagination").click(function(){
    
      var next_link = '<?php printf("%s?page_num=%d&rpp=%d%s", $Mypagination->current_url, min($Mypagination->total_pages, $Mypagination->page_num + 1),$Mypagination->max_records, $Mypagination->querystring); ?>';
      var previous_link ='<?php printf("%s?page_num=%d&rpp=%d%s", $Mypagination->current_url, max(0, $Mypagination->page_num - 1),$Mypagination->max_records, $Mypagination->querystring); ?>';
      var first_link = '<?php printf("%s?page_num=%d&rpp=%d%s", $Mypagination->current_url, 0, $Mypagination->max_records, $Mypagination->querystring); ?>';
      var last_link = '<?php printf("%s?page_num=%d&rpp=%d%s", $Mypagination->current_url, $Mypagination->total_pages, $Mypagination->max_records, $Mypagination->querystring); ?>';
      var result_link = 'result.php?id=<?php echo $demotestdetails->demo_test_id; ?>';
      var link ='';
      switch($(this).attr('id'))
      {
        case 'submit_first':link = first_link; break;
        case 'submit_previous':link = previous_link;break;
        case 'submit_next':link = next_link; break;
        case 'submit_last':link = last_link;break;
        case 'submit_back':link = result_link;break;
        default :link = first_link;
      }

      window.location = link+"#review";
      return false;    
  });



});



 




 -->

