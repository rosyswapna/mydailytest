<!--

var PaginationCount = ['10','20','50','100'];

var dt1 = new Date(); // Create date object.
var time_stamp1 = dt1.getTime()/1000;
var end_time = Math.floor(time_stamp1)+<?php echo $_SESSION[SESSION_TITLE."duration"];?> ; 
var pause_time = "";
var resume_time = "";
var img_active_flag = "images/flag-active.png";
var img_flag = "images/flag.png";

var popup_ok ="";
var popup_cancel = "";


$( document ).ready(function() {

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

  var func_pause = function(){
    dt = new Date(); // Create date object.
    time_stamp = dt.getTime()/1000;
    pause_time = Math.floor(time_stamp);
    timer_pause = true;
    var success_post = $.post('<?php echo $current_url?>',
    {
      pause_time:pause_time,
    });
  };

  var func_resume = function(){
    dt = new Date(); // Create date object.
    time_stamp = dt.getTime()/1000;
    paused_time = Math.floor(time_stamp)-pause_time;
    end_time = end_time + paused_time;
    timer_pause = false;
    var success_post = $.post('<?php echo $current_url?>',
    {
      paused_time:paused_time
    });
    ct = setTimeout(calculate_time(),1);//START CLOCK
  }

  var fucc_saveuserkey = function(){
      var user_keys = [];
      var utd_id    = [];
      var multi_userkey = "";
      var input_name = "";
      var temp_name = "";
      $(".answer_options:checked").each(function() {
        user_keys.push(this.value);
        var input_name = ($(this).attr('name'));
        var list=input_name.split('_');
        utd_id.push(list[1]);
      });

      $(".answer_options_multiple:checked").each(function() {
          input_name = ($(this).attr('name'));
          if(input_name == temp_name)
          {
            multi_userkey += this.value+",";
          }
          else
          {
            var list = input_name.split('_');
            utd_id.push(list[1].substring(0,list[1].length-2));
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
      var post_act = 'pause';
      var success_post = $.post('<?php echo $current_url?>',
      {
        update_count:update_count,
        utd_idArray:JSON.stringify(utd_id), 
        userkeyArray:JSON.stringify(user_keys)
      });

      success_post.done(function (data) {
    // alert(data);
       
      });
       success_post.fail(function (data) {
     
      // alert("fail");
      });
};



  //call function
  check_flag();



  // user key updation on click answer option
	$(".answer_options").click(function(){
    	var opt_id=$(this).children(":input").attr('id');
        var list=opt_id.split('_');
        $.post('<?php echo $current_url?>',
       		{
        		id:+list[1], 
                user_keys:list[2] 
             });
    }) ;
   // ___________________________________________________________________________
	


  //pause timer
    $("#pause_button").click(function(){
      func_pause();
      popup_ok ="pause";
      popup_alert("You can resume your test any time by going to Test History from top menu and by clicking RESUME on the test that you have paused. Click OK to PAUSE or CANCEL to continue taking this test","#","Ok","Cancel");
    });
  // ___________________________________________________________________________



//cancel pause action
  $("#popup_alert_button_cancel").click(function(){
    if(popup_cancel == "continue"){
          return true;
    }else{
      func_resume();
    } 
  });
   // ___________________________________________________________________________
   


//proceed to pause save userkeys
  $("#popup_alert_button_ok").click(function(){ 
     if(popup_ok == "quit"){
           $("#hd_quit").trigger('click');
    }else{
        if(popup_ok == "pause"){
          var pause_post = $.post('<?php echo $current_url?>',{end_test:true});
          pause_post.done(function(){
            fucc_saveuserkey();
            window.location.href="user_test_history.php";
          });
          
        }        
    }    
  });
 // ___________________________________________________________________________

    
    
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

    // ___________________________________________________________________________
      
    
    
 
    /*
    //multiple answer updation
    $(".answer_options_multiple").click(function(){

        var check_name = $(this).attr('name');
        var check_value = $(this).val();
        var list = check_name.split('_');
        var id = list[1].substring(0,list[1].length-2);
        var checked = "";
        if(this.checked == true){checked = 1;}
        else{checked = 0;}

        var update = $.post('<?php echo $current_url?>',
        {
          id:id, 
          key:check_value,
          user_key_check:checked
        });
    }) ;
    */
     // ___________________________________________________________________________



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

   // ___________________________________________________________________________
    

    //custom number of questions per page
    $('#lstrecord_per_page').change(function(){
      fucc_saveuserkey_and_goto();
  		$("#HD_submit").trigger("click");  
    });
// ___________________________________________________________________________



  //save user keys on click next button (batch save)
  $(".button").click(function(){
    var h = $(this).attr('name');
    if(h== 'submit_link')
    {
     
      var next_link = '<?php printf("%s?page_num=%d&rpp=%d%s", $Mypagination->current_url, min($Mypagination->total_pages, $Mypagination->page_num + 1),$Mypagination->max_records, $Mypagination->querystring); ?>';
      var previous_link ='<?php printf("%s?page_num=%d&rpp=%d%s", $Mypagination->current_url, max(0, $Mypagination->page_num - 1),$Mypagination->max_records, $Mypagination->querystring); ?>';
      var first_link = '<?php printf("%s?page_num=%d&rpp=%d%s", $Mypagination->current_url, 0, $Mypagination->max_records, $Mypagination->querystring); ?>';
      var last_link = '<?php printf("%s?page_num=%d&rpp=%d%s", $Mypagination->current_url, $Mypagination->total_pages, $Mypagination->max_records, $Mypagination->querystring); ?>';
      var finish_link= '<?php echo '/result.php?id='.$_SESSION[SESSION_TITLE.'usertestid'];?>';
      
      var link ='';
      switch($(this).attr('id'))
      {
        case 'submit_first':link = first_link; break;
        case 'submit_previous':link = previous_link;break;
        case 'submit_next':link = next_link;break;
        case 'submit_last':link = last_link;break;
        default :link = first_link;
      }
      fucc_saveuserkey();
      window.location.href=link;
    }
    else{
      return true;
    }
        
  }) ; 
   // ___________________________________________________________________________


  //quit test
  $("#real_quit").click(function(){
      popup_ok = "quit";
      popup_cancel = "continue";
      popup_alert(" Are you sure you would like to exit? Please click OK to confirm or CANCEL to continue taking the test","#","Ok","Cancel")
  });
   // ___________________________________________________________________________

       
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
      //$("#submit_finish").click();
      //fucc_saveuserkey_and_goto();
      popup_alert("The time is up.","finish.php","","false");
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



-->
