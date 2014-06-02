<!--



$(document).ready(function(){

$( document ).on( "mouseover", ".img", function() {
this.width='200'; 
this.height='200';
});

$( document ).on( "mouseout", ".img", function() {
this.width='100'; 
this.height='50';
});
	
 $("#tab #checkall").live("click", function () {
        if ($("#tab #checkall").is(':checked')) {
            $("#tab input[type=checkbox]").each(function () {
                $(this).prop("checked", true);
            });

        } else {
            $("#tab input[type=checkbox]").each(function () {
                $(this).prop("checked", false);
            });
        }
    });
	$('.classcheck').live("click", function () {
	question_id=$(this).attr('question_id');
	$('#answer_paragraph_'+question_id).html("");
	index=1;
	$("input[name='optioncheck_"+question_id+"[]']").each(function () {
	if( $(this).is(':checked') ){
     	 var checkbox_value= $(this).val();
	var option_val=$('#txtoptions_'+question_id+'_'+checkbox_value).val();
	$('#answer_paragraph_'+question_id).append(index+' : '+option_val+'<br>');
	index++;	
	}
		
	});
		
	});

	$('.back').live("click", function () { 
   	 if(document.referrer.indexOf(window.location.hostname) != -1){
        parent.history.go(-1);
        return false;
   	 }
	});


	 $('.edit_link').live("click", function () { 
		question_id=$(this).attr('question_id');
		$("#popup_form_"+question_id).toggle();
		return false;	
		//

	   }); 

	 $('.test').live("click", function () {
	var question_id=$(this).attr('question_id');
	
	});
	

	$('.update_button').live("click", function () {
	question_id=$(this).attr('question_id');
	var i=0;
	var question = $('#txtquestion_'+question_id).val();
	var id=$('#txtid_'+question_id).val();
	var answers =  "";
	var answer_keys="";
	var question_type_id="";
	var options="";
	
	var id=$('#txtid_'+question_id).val();
	var answer_array=[];
	var answer_key_array=[];
	var options_array=[];
	i=0;
	$("input[name='optioncheck_"+question_id+"[]']").each(function () {
	if( $(this).is(':checked') ){
     	var checkbox_value= $(this).val();
	var answer_val=$('#txtoptions_'+question_id+'_'+checkbox_value).val();
	if(answer_val!=''){
	answer_array[i]=$('#txtoptions_'+question_id+'_'+checkbox_value).val();
	answer_key_array[i]=$(this).val();
	i++;
	}
	}
	});
	i=0;
	$("input[name='txtoptions_"+question_id+"[]']").each(function () {
	var opt_val=$(this).val();	
	if(opt_val!=''){	  
	options_array[i]= $(this).val();
	i++;
	}
		
	});
	
	
	$('#answer_paragraph_'+question_id).html("");
	index=1;
	$("input[name='optioncheck_"+question_id+"[]']").each(function () {
	if( $(this).is(':checked') ){
     	 var checkbox_value= $(this).val();
	var option_val=$('#txtoptions_'+question_id+'_'+checkbox_value).val();
	$('#answer_paragraph_'+question_id).append(index+' : '+option_val+'<br>');
	index++;	
	}
		
	});

	var default_option_delimitter="<?php echo DEFAULT_OPTION_DELIMITER;?>";
	var default_answer_key_delimitter="<?php echo DEFAULT_ANSWER_KEY_DELIMITER;?>";
	for (answer_index = 0; answer_index < answer_array.length ; answer_index++)
	{
		answers=answers+answer_array[answer_index];
		if(answer_index < answer_array.length-1){
		answers=answers+default_option_delimitter;
		}
	}
	//alert(answers);
	for (answer_key_index = 0; answer_key_index < answer_key_array.length ; answer_key_index++)
	{
		answer_keys=answer_keys+answer_key_array[answer_key_index];
		if(answer_key_index < answer_key_array.length-1){
		answer_keys=answer_keys+default_answer_key_delimitter;
		}
	}
	//alert(answer_keys);
	
	if(answer_key_array.length>1){
	question_type_id="<?php echo QUESTION_TYPE_MULTIPLE_ANSWERS; ?>";
	}else{
	question_type_id="<?php echo QUESTION_TYPE_SINGLE_ANSWER; ?>";
	}
	for (option_index = 0; option_index < options_array.length; option_index++)
	{
		options=options+options_array[option_index];
		if(option_index < options_array.length-1){
		options=options+default_option_delimitter;
		}
		
	}
	//alert(options);	
	
	var subject_id=$("select[name='lstsubject_"+question_id+"']").val();
	var exam_id=$("select[name='lstexam_"+question_id+"']").val();

        //use ajax to run the check 
	 $.post('temp_question.php',{
	id:id,
	question:question,
	options:options,
	answers:answers,
	question_type_id:question_type_id,
	answer_keys:answer_keys,
	subject_id:subject_id,
	exam_id:exam_id
	},function(data){
	if(data!='1'){
	$("#question_div_"+question_id).html(data);
	$("#popup_form_"+question_id).hide();
	
	}
	else{
	$("#popup_form_"+question_id).hide();
	}
	});
	
        });

});

 -->
