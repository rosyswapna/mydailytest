
<!--

var PaginationCount = ['10','20','50','100'];

var dt1 = new Date(); // Create date object.
var time_stamp1 = dt1.getTime()/1000;
var end_time = Math.floor(time_stamp1)+<?php echo $_SESSION[SESSION_TITLE."duration"];?> ; 
var pause_time = "";

var img_active_flag = "images/flag-active.png";
var img_flag = "images/flag.png";

var a_link = "";
var popup_ok ="";
var popup_cancel = "";
var popup_close = "";


$( document ).ready(function() {

$('a').click(function() {
  if($(this).attr('id') != 'popup_alert_redirect')
  {
    a_link = $(this).attr('href');
    popup_alert("Click Ok to exit the test else cancel to continue test","#","Ok","Cancel");
    $("#popup_alert_redirect").attr('href',a_link);
    return false;
  }
});

var check_flag = function(){
     var linkArray = $("img.flag").map(function() {
      return $(this).attr('src');
      }).get();
      var img_active_flag_index = jQuery.inArray(img_active_flag, linkArray);
      if(img_active_flag_index >= 0){
        $("#search").show();
      }else{
        $("#search").hide();
      }

  };

check_flag();

  //flag question on click flag link 
    $(".flag").click(function(){
        var q_id=$(this).attr('id');
        var list=q_id.split('_');
        if(list[2]==0)
        {
          var new_id = q_id.slice(0,-1)+1;
          $(this).attr('src','images/flag-active.png');
          flag_update = $.post('<?php echo $current_url?>',
          {
            id:list[1], 
            flag:1 
          });
           
          flag_update.success(function () {
            $("#"+q_id).attr('src','images/flag-active.png');
            $("#"+q_id).attr('id',new_id);
          });
          flag_update.fail(function () {
            $("#"+q_id).attr('src','images/flag.png');
          });
        }
        else{
            var new_id = q_id.slice(0,-1)+0;
            $("#"+q_id).attr('src','images/flag.png');
            flag_update = $.post('<?php echo $current_url?>',
            {
              id:list[1], 
              flag:0 
            });
               
            flag_update.success(function () {
              $("#"+q_id).attr('src','images/flag.png');
              $("#"+q_id).attr('id',new_id);
            });
            flag_update.fail(function () {
              $("#"+q_id).attr('src','images/flag-active.png');
            });
        }
        check_flag();
     }) ;



     //save user keys on click next button (batch save)
      $(".button").click(function(){
        var h = $(this).attr('name');
        if(h== 'submit_link')
        {
         
          var next_link = '<?php printf("%s?page_num=%d&rpp=%d%s", $Mypagination->current_url, min($Mypagination->total_pages, $Mypagination->page_num + 1),$Mypagination->max_records, $Mypagination->querystring); ?>';
          var previous_link ='<?php printf("%s?page_num=%d&rpp=%d%s", $Mypagination->current_url, max(0, $Mypagination->page_num - 1),$Mypagination->max_records, $Mypagination->querystring); ?>';
          var first_link = '<?php printf("%s?page_num=%d&rpp=%d%s", $Mypagination->current_url, 0, $Mypagination->max_records, $Mypagination->querystring); ?>';
          var last_link = '<?php printf("%s?page_num=%d&rpp=%d%s", $Mypagination->current_url, $Mypagination->total_pages, $Mypagination->max_records, $Mypagination->querystring); ?>';          
          var link ='';
          switch($(this).attr('id'))
          {
            case 'submit_first':link = first_link;break;
            case 'submit_previous':link = previous_link;break;
            case 'submit_next':link = next_link;break;
            case 'submit_last':link = last_link;break;
            default :link = first_link;
          }
          //alert(link);return false;
          var user_keys = [];
          var dtd_id    = [];
          var temp_name = "";
          var multi_userkey="";
          $(".answer_options:checked").each(function() {
            user_keys.push(this.value);
            var input_name = ($(this).attr('name'));
            var list=input_name.split('_');
            dtd_id.push(list[1]);
          });

          $(".answer_options_multiple:checked").each(function() {
              var input_name = ($(this).attr('name'));
              if(input_name == temp_name)
              {
                multi_userkey += this.value+",";
              }
              else
              {
                var list = input_name.split('_');
                dtd_id.push(list[1]);
                if(multi_userkey != ""){
                    user_keys.push(multi_userkey.substring(0,multi_userkey.length-1));
                    multi_userkey = "";
                }
                temp_name = input_name;
                multi_userkey += this.value + ",";
              }   
          });

          if(multi_userkey != ""){
              user_keys.push(multi_userkey.substring(0,multi_userkey.length-1));
              multi_userkey = "";
          }
        
          var update_count = user_keys.length;
          var success_post = $.post('<?php echo $current_url?>',
          {
            update_count:update_count,
            idArray:dtd_id, 
            userkeyArray:user_keys
          });
            
          success_post.done(function (data) {
            window.location = link;
            return false;
          });
        }
        else{
          return true;
        }
            
      });



       //custom number of questions per page
    $('#lstrecord_per_page').change(function(){
      action_record_per_page ='save';
      var user_keys = [];
      var utd_id    = [];
      $(".answer_options:checked").each(function() {
        user_keys.push(this.value);
        var input_name = ($(this).attr('name'));
        var list=input_name.split('_');
        utd_id.push(list[1]);
      });
      var update_count = user_keys.length;
      // alert(update_count);return false;
      var success_post = $.post('<?php echo $current_url?>',
      {
        update_count:update_count,
        post_act:action_record_per_page,
        idArray:utd_id, 
        userkeyArray:user_keys
      });
      
      
      success_post.done(function (data) {
        //alert(data) ;
        $("#HD_submit").trigger("click"); 
      });   
       
    });



    //user key updation on click answer option
    $(".answer_options").click(function(){
        var opt_id=$(this).children(":input").attr('id');
          var list=opt_id.split('_');
          $.post('<?php echo $current_url?>',
            {
              id:+list[1], 
                user_keys:list[2] 
            });
      }) ;

      $("#pause_button").click(function(){

         dt = new Date(); // Create date object.
        time_stamp = dt.getTime()/1000;
        pause_time = Math.floor(time_stamp);
        timer_pause = true;
        popup_cancel = "quit"
        popup_alert("Please click RESUME to continue taking the test or QUIT to exit the test and continue browsing mydailytest.com","#","Resume","Quit");
        
        var user_keys = [];
        var dtd_id    = [];
        $(".answer_options:checked").each(function() {
          user_keys.push(this.value);
          var input_name = ($(this).attr('name'));
          var list=input_name.split('_');
          dtd_id.push(list[1]);
        });
        
        var update_count = user_keys.length;

        var success_post = $.post('<?php echo $current_url?>',
        {
          pause_time:pause_time,
          update_count:update_count,
          dtd_idArray:dtd_id, 
          userkeyArray:user_keys
        });

        success_post.done(function (data) {
        //alert(data);
        });
      
      });

      $("#popup_alert_button_ok").click(function(){
        if(popup_ok == "quit"){
          $("#hd_quit").trigger('click');
        }
        else{
          var ok_href = $("#popup_alert_redirect").attr('href');
          if(ok_href != "#"){
             window.location.href=ok_href;
          }else{
          
            dt = new Date(); // Create date object.
            time_stamp = dt.getTime()/1000;
            paused_time = Math.floor(time_stamp)-pause_time;
            end_time = end_time + paused_time;
            timer_pause = false;
            $('.overlay, .overlay-panel').fadeOut(300);
            
            
            var success_post = $.post('<?php echo $current_url?>',
            {
              paused_time:paused_time
            });

            success_post.done(function (data) {
            //alert(data);
            });
           ct = setTimeout(calculate_time(),1);//START CLOCK 
          }
        }
      });
	  
	  
	   $("#popup_alert_close").click(function(){
        dt = new Date(); // Create date object.
        time_stamp = dt.getTime()/1000;
        paused_time = Math.floor(time_stamp)-pause_time;
        end_time = end_time + paused_time;
        timer_pause = false;
        $('.overlay, .overlay-panel').fadeOut(300);
        
        
        var success_post = $.post('<?php echo $current_url?>',
        {
          paused_time:paused_time
        });

        success_post.done(function (data) {
        //alert(data);
        });
       ct = setTimeout(calculate_time(),1);//START CLOCK 

      });
	    
	  
	  
	  
	  

      $("#popup_alert_button_cancel").click(function(){
        if(popup_cancel == "continue"){
          return true;
        }
        else if(popup_cancel == "quit"){
          $("#hd_quit").trigger('click');
        }else{
         var ok_href = $("#popup_alert_redirect").attr('href');
          if(ok_href == "#"){
             
          }else{
            return true;
          }
        }
      });

   



      $("#demo_quit").click(function(){
          popup_ok = "quit";
          popup_cancel = "continue"
          popup_alert(" Are you sure you would like to exit? Please click OK to confirm or CANCEL to continue taking the test","#","Ok","Cancel")
      });


     $("#popup_alert_close").click(function(){
      alert("hi");
     });




});



//timer function

var seconds_delay = 1; // Adjust this value for number of seconds to delay before changing the time display.
var ct,mins,secs,hrs,sw = 1;
var timer_pause = false;
function calculate_time()
{
  if(timer_pause == false)
  {
    var dt = new Date(); // Create date object.
    var time_stamp = dt.getTime()/1000; // Get current minutes (converted to seconds).
    var total_time = end_time - Math.floor(time_stamp); // Subtract current seconds from total seconds to get seconds remaining.

    hrs = Math.floor(total_time / 60 / 60);
    mins = Math.floor((total_time / 60) - (hrs * 60)); // Extract minutes from seconds remaining.
    secs = total_time - ((mins * 60) + (hrs * 60 * 60)); // Extract remainder seconds if any.

    if(secs < 10){secs = "0" + secs;} // Check if seconds are less than 10 and add a 0 in front.
    if(mins < 10){mins = "0" + mins;} // Check if minutes are less than 10 and add a 0 in front.
    if(hrs < 10 && hrs > -1){hrs = "0" + hrs;} // Check if hourss are less than 10 and add a 0 in front.
    var lbl = document.getElementById('clock');
    lbl.innerHTML = hrs + ":" + mins + ":" + secs;
    // This if statement adjusts time to increments of seconds_delay
    if(secs % seconds_delay > 0)
    {
      sw = 0;
      ct = setTimeout("calculate_time()",500);
    }
    else{sw = 1;}
    // Check for end of time, stop clock and display message.
    if(hrs < 0 && mins >= 0 && secs >= 0 || hrs == 0 && mins == 0 && secs == 0)
    {
      clearTimeout(ct);
      var lbl = document.getElementById('clock');
      lbl.innerHTML = "00:00:00";
      //document.getElementById("clock").value = "00:00:00";
    $("#submit_finish").click();
      $("#popup_alert_close").hide();
      popup_alert("The time is up.","demo_finish.php","","false");
      sw = 0;
    }
    if(sw){

      ct = setTimeout("calculate_time()",seconds_delay * 1000);
    }  // Display the time once every seconds_increment seconds. 1000 equals approximatly 1 second.
  }
 }

$(document).ready(function(){

  ct = setTimeout(calculate_time(),1);//START CLOCK 


});