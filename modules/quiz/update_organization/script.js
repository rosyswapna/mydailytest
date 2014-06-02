
$( document ).ready(function() {


	

	//----------------show or hide rows with quiz type start here------------
	var quiz_type = $('select[name=lstquiz_type]').val();
	if(quiz_type == 1){
		$('#div_q_nos').hide();
		$('#div_real').show();
		$('#div_real1').show();
		$('#div_real2').show();
	}
	else if(quiz_type == 2 || quiz_type == 3){
		$('#div_q_nos').show();
		$('#div_real').hide();
		$('#div_real1').hide();
		$('#div_real2').hide();
	}
	else{
		$('#div_q_nos').hide();
		$('#div_real').hide();
		$('#div_real1').hide();
		$('#div_real2').hide();
	}
	
	
	$('select[name=lstquiz_type]').change(function(){
		var quiz_id=$(this).val();
		if(quiz_id == 1){
			$('#div_q_nos').hide();
			$('#div_real').show();
			$('#div_real1').show();
			$('#div_real2').show();
		}
		else if(quiz_id == 2){
			$('#div_q_nos').show();
			$('#div_real').hide();
			$('#div_real1').hide();
			$('#div_real2').hide();
		}
		else if(quiz_id == 3){
			$('#div_q_nos').show();
			$('#div_real').hide();
			$('#div_real1').hide();
			$('#div_real2').hide();
		}
		else{
			$('#div_q_nos').hide();
			$('#div_real').hide();
			$('#div_real1').hide();
			$('#div_real2').hide();
		}
			
	});
	//----------------show or hide rows with quiz type end here------------
	

	var id = $("#cnt").val();
	$("#add_more").click(function(){
		var count_rules = $(".real_quiz_hide").length;
		id = count_rules+1;
		var cls = ""
		if(id%2 == 0)
		{
			cls = "white_body";
		}else{
			cls = "grey_body";
		}
		
		

			$('<div id="real_quiz_dtls'+id+'" class="'+cls+'"><div class="sixteen columns"><div class="form-box"><div class="top_left"><p>Quiz Rule '+id+'  : </p><input type="hidden" name ="h_validate_1" value="-1" /></div><div class="top_rule"><p id="msg_validate_'+id+'">Not Validated &nbsp;</p><input type="button" value="close" id="'+id+'" class="real_quiz_hide" /><input type="button" value="Validate Rule" rule_id="'+id+'" class="button_validate_rule" name="button_validate_rule[]" onClick = "check_rule(this);" />&nbsp;&nbsp;</div></div></div><div class="sixteen columns"></div><div class="one-third column"><div class="form-box"><label>'+cap_ruledescription+' <small>*</small></label><textarea name="ruledescription[]" cols="45" rows="5" id="ruledescription[]"></textarea></div></div><div class="one-third column"><div class="form-box"><label>'+cap_subject+' </label>'+subject_list+'</div></div><div class="one-third column"><div class="form-box"><label>'+cap_section+' </label>'+section_list+'</div></div><div class="one-third column"><div class="form-box"><label>'+cap_language+' </label>'+language_list+'</div></div><div class="one-third column"><div class="form-box"><label>'+cap_difficultylevel+' </label>'+difficulty_level_list+'</div></div><div class="sixteen columns"></div><div class="one-third column"><div class="form-box"><label>'+cap_exam+' <small>*</small></label>'+exam_list+'</div></div><div class="one-third column"><div class="form-box"><label>'+cap_totalmark+' <small>*</small></label><input type="text" name="total_mark[]" value =""/></div></div><div class="sixteen columns"></div><div class="one-third column"><div class="form-box"><label>'+cap_questionids+'</label><textarea name="rulequestionids[]" cols="45" rows="5" id="rulequestionids[]"></textarea></div></div><div class="one-third column"><div class="form-box"><label>From Passage </label><input type="checkbox" value="'+id+'" name="chk_passage[]" id="chk_passage[]" group="0"/><div id="div_grp'+id+'" style="display:none;"><label>'+cap_numberofquestiongroups+'<small>*</small></label><input type="text" style="width:110px;" name="no_question_groups[]" value =""/></div><div id="div_non_grp'+id+'" style="display:block;"><label>'+cap_numberofquestions+'<small>*</small></label><input type="text" name="no_questions[]" value =""/></div></div></div><div class="one-third column" id="div_questionids"><div class="form-box"><input type="button" class="btn_get_questionids" name="get_questionids[]" id="get_questionids'+id+'" value = "Get Question Ids" rule_id="'+id+'"/>&nbsp;&nbsp;</div></div><div class="sixteen columns"></div><div class="one-third column"><div class="form-box"><label>'+cap_negativemark+' <small>*</small></label><input type="text" name="negative_mark[]" value =0  style="width:50px;"/></div></div><div class="one-third column"><div class="form-box"><label>'+cap_wronganswercount+' <small>*</small></label><input type="text" name="negative_mark[]" value ="0"  style="width:50px;"/></div></div></div>').animate({ opacity: 'show' }, 'slow').appendTo('#real_quiz_dtls');

		

	});






$('body').on('click','.real_quiz_hide',function() {
	
	var rem_id = $(this).attr("id");
	$('#real_quiz_dtls'+rem_id).animate({opacity:"hide"}, "slow").remove();
});




//validate form on submit

$('#submit').click(function(){
	var error = "";
	var quiz_name = $("#txtname").val();
	var quiz_description = $("#txtdescription").val();
	var credit = $("#txtcredit").val();
	var examination = $("#lstexamination").val();

	var time = $("#txttime").val();
	var quiz_type = $('select[name=lstquiz_type]').val();

	//var namePattern = /^[A-Za-z]{3,25}$/;
	if(quiz_name== ""){
		error += "Enter valid quiz name\n";
	}
	if(quiz_description== ""){
		error += "Enter quiz description\n";
	}
	if(credit== ""){
		error += "Enter credit \n";
	}
	
	if(examination == -1){
		error += "Enter Exam \n";
	}
	
	if(quiz_type == -1){
		error +="Select quiz type \n";
	}
	else if(quiz_type == 1){
		var i=0;
		var rule_arrays=[];
		$('select[name="lstexam[]"]').each(function(){
			
			
			var rule_obj = $("input[name='button_validate_rule[]']");
			rule_id =$(rule_obj[(i)]).attr("rule_id");

			var exam_obj = $('select[name="lstexam[]"]');
			exam_id =$(exam_obj[(rule_id-1)]).val();

			var rule_str = generate_rule_string(rule_id-1);
			if(jQuery.inArray(rule_str,rule_arrays) > -1){
				error +="Rule "+rule_id+" is repeated \n";
			}
			else{
				rule_arrays[i]=rule_str;				
			}


		
			h_validate_id = $("input[name='h_validate_"+rule_id+"']").val();

			var number_of_question_groups_obj = $("input[name='no_question_groups[]']");
			var chk_passage_obj = $('input[name="chk_passage[]"]');
			if($(chk_passage_obj[(rule_id-1)]).prop('checked')){
				number_of_question_groups =$(number_of_question_groups_obj[(rule_id-1)]).val();
				if(number_of_question_groups == "" || number_of_question_groups <= 0){
					error += "Enter Number of question groups for rule "+(i+1)+"\n";
				}
			}


			var number_of_questions_obj = $("input[name='no_questions[]']");
			number_of_questions =$(number_of_questions_obj[(rule_id-1)]).val();

			var rule_description_obj = $("textarea[name='ruledescription[]']");
			rule_description =$(rule_description_obj[(rule_id-1)]).val();

			var total_mark_obj = $("input[name='total_mark[]']");
			total_mark =$(total_mark_obj[(rule_id-1)]).val();



			if(exam_id == -1){
				error += "Select exam for quiz rule "+(i+1)+"\n";
			}

			if(number_of_questions == ""){
				error += "Enter number of questions for quiz rule "+(i+1)+"\n";
			}

			if(rule_description == ""){
				error += "Enter description for quiz rule "+(i+1)+"\n";
			}

			if(total_mark == ""){
				error += "Enter total mark for quiz rule "+(i+1)+"\n";
			}

			if(h_validate_id == -1){
				error += "Quiz rule "+(i+1)+" not validated\n";
			}

			i++;
		});





		



	}
	else{
		var quiz_ids = $("#txtquestions").val();
		if(quiz_ids == ""){
			error += "Enter question ids\n";
		}
		else{
			//var q_pattern = '/[\^d,]/';
			//if(!q_pattern.test(quiz_ids)){
				//error += "Enter numbers separated with coma\n";
			//}

			var chk = check_duplicate_id(quiz_ids);
			if(chk == false){
				error += "Enter valid question ids\n";
			}
		}
		
	}

	
	if(error == ""){
		return true;
	}
	else{
		alert(error);
		return false;
	}
});
//validation ends here







$("body").on("click",'.btn_get_questionids',function(){
	
	var rule_index = $('.btn_get_questionids').index($(this));

	
	var exam_obj = $('select[name="lstexam[]"]');
	exam_id =$(exam_obj[rule_index]).val();

	var subject_obj = $('select[name="lstsubject[]"]');
	subject_id =$(subject_obj[rule_index]).val();

	var section_obj = $('select[name="lstsection[]"]');
	section_id =$(section_obj[rule_index]).val();

	var language_obj = $('select[name="lstlanguage[]"]');
	language_id =$(language_obj[rule_index]).val();

	var difficulty_level_obj = $('select[name="lstdifficultylevel[]"]');
	difficulty_level_id =$(difficulty_level_obj[rule_index]).val();

	var number_of_questions_obj = $("input[name='no_questions[]']");
	number_of_questions =$(number_of_questions_obj[rule_index]).val();

	var no_question_groups_obj = $("input[name='no_question_groups[]']");
	number_of_question_groups =$(no_question_groups_obj[rule_index]).val();
	
	var rulequestionids_obj = $("textarea[name='rulequestionids[]']");

	var limit = "";
	var errorMSG = "";
	
	var chk_passage_obj = $('input[name="chk_passage[]"]');
	if($(chk_passage_obj[rule_index]).prop('checked')){
		question_group = QUESTION_GROUP_TRUE;
		limit = number_of_question_groups ;
		if(limit == "" || limit <=0){
			errorMSG = "Enter Number of passages";
		}
	}else{
		question_group = QUESTION_GROUP_FALSE;
		limit = number_of_questions;
		if(limit == "" || limit <=0){
			errorMSG = "Enter Number of questions";
		}
	}
	

	if(errorMSG != ""){
		alert(errorMSG);
		return false;
	}else{
		var rule_post = $.post(CURRENT_URL,
		{
			question_group:question_group,
			rule_quesionids:1,
		    exam_id:exam_id,
		    subject_id:subject_id, 
		    section_id:section_id,
		    language_id:language_id,
		    difficulty_level_id:difficulty_level_id,
		    number_of_questions:limit
		});

	  	rule_post.done(function (data) {
  			var question_ids = data;
	  		$(rulequestionids_obj[rule_index]).val(question_ids);
	  		if(question_ids == ""){
	  			alert("No Questions Found");
	  		}else{
	  			
		  		var list = question_ids.split(',');
		  		num_rule_question_ids = list.length;
		  		$(number_of_questions_obj[rule_index]).val(num_rule_question_ids);
		  	}

	  	});
	  	rule_post.fail(function (data) {
	  		alert("Error in generate question ids. Enter manualy");
	  	});
	}

});




      
//show or hide number of question groups input box
$('body').on('click','input[name="chk_passage[]"]',function() {
	 var rule_id = $(this).val();
	 var div_grp_id ="#div_grp"+rule_id;
	 var div_non_grp_id ="#div_non_grp"+rule_id;

	 

	 if($(this).prop('checked')){
	 	$(div_grp_id).show();
	 	$(div_non_grp_id).hide();
	 }
	 else{
	 	$(div_grp_id).hide();
	 	$(div_non_grp_id).show();
	 }
});



$('input[name="chk_passage[]"]').each(function(){
	var rule_id = $(this).val();
	var question_group = $(this).attr('group');
	var chk_passage_obj = $('input[name="chk_passage[]"]');
	var div_grp_id ="#div_grp"+rule_id;
	var div_non_grp_id ="#div_non_grp"+rule_id;
	if(question_group == QUESTION_GROUP_TRUE){
		$(this).prop('checked',true);
		$(div_grp_id).show();
	 	$(div_non_grp_id).hide();
	}else{
		$(this).prop('checked',false);
		$(div_non_grp_id).show();
		$(div_grp_id).hide();
	 	
	}
});










		
});

function generate_rule_string(dynamicIndex)
{
	// var dynamicIndex = $('.button_validate_rule').index(rule_obj);
	// alert(rule_obj);
   
	var exam_obj = $('select[name="lstexam[]"]');
	exam_id =$(exam_obj[dynamicIndex]).val();

	var subject_obj = $('select[name="lstsubject[]"]');
	subject_id =$(subject_obj[dynamicIndex]).val();

	var section_obj = $('select[name="lstsection[]"]');
	section_id =$(section_obj[dynamicIndex]).val();

	var language_obj = $('select[name="lstlanguage[]"]');
	language_id =$(language_obj[dynamicIndex]).val();

	var difficulty_level_obj = $('select[name="lstdifficultylevel[]"]');
	difficulty_level_id =$(difficulty_level_obj[dynamicIndex]).val();

	var ruleStr = exam_id+"_"+subject_id+"_"+section_id+"_"+language_id+"_"+difficulty_level_id;

	return ruleStr;
}




var rule_array = [];
var num_rule_question_ids = 0;
	
function check_rule(rule_obj){
	
	var ruleStr = "";
	

	var rule_id = $(rule_obj).attr("rule_id");
    var dynamicIndex = $('.button_validate_rule').index(rule_obj);

    var chk_passage_obj = $('input[name="chk_passage[]"]');
	//chk_passage =$(chk_passage_obj[dynamicIndex]).val();

	if($(chk_passage_obj[dynamicIndex]).prop('checked')){
		question_group = 1;
	}else{
		question_group = 0;
	}
	   
	var exam_obj = $('select[name="lstexam[]"]');
	exam_id =$(exam_obj[dynamicIndex]).val();

	var subject_obj = $('select[name="lstsubject[]"]');
	subject_id =$(subject_obj[dynamicIndex]).val();

	var section_obj = $('select[name="lstsection[]"]');
	section_id =$(section_obj[dynamicIndex]).val();

	var language_obj = $('select[name="lstlanguage[]"]');
	language_id =$(language_obj[dynamicIndex]).val();

	var difficulty_level_obj = $('select[name="lstdifficultylevel[]"]');
	difficulty_level_id =$(difficulty_level_obj[dynamicIndex]).val();

	var number_of_questions_obj = $("input[name='no_questions[]']");
	number_of_questions =$(number_of_questions_obj[dynamicIndex]).val();

	var rule_description_obj = $("input[name='rule_description[]']");
	rule_description =$(rule_description_obj[(rule_id-1)]).val();

	var rulequestionids_obj = $("textarea[name='rulequestionids[]']");
	rulequestionids =$(rulequestionids_obj[(rule_id-1)]).val();

	ruleStr = exam_id+"_"+subject_id+"_"+section_id+"_"+language_id+"_"+difficulty_level_id;

	//check rule repetition
	if(dynamicIndex in rule_array){
		rule_array[dynamicIndex]="";
		if(jQuery.inArray(ruleStr,rule_array) == -1){
			rule_array[dynamicIndex]=ruleStr;
		}
		else{
			$("input[name='h_validate_"+rule_id+"']").val("-1");
	 		alert("This rule has been defined earlier");return false;
		}
	}
	else{

		if(jQuery.inArray(ruleStr,rule_array) == -1){
			rule_array[dynamicIndex]=ruleStr;
		}
		else{
			$("input[name='h_validate_"+rule_id+"']").val("-1");
	 		alert("This rule has been defined earlier");return false;
		}
	}

	//check count of questionids with number of questions
	if(num_rule_question_ids == 0 || num_rule_question_ids == number_of_questions){

	}else{
		$("input[name='h_validate_"+rule_id+"']").val("-1");
	 	alert("Number of quesion ids does not match with number of questions");return false;
	}
	


	$.get("/admin/quiz_rule_check.php", { question_group:question_group, exam_id: exam_id, subject_id:subject_id, section_id:section_id, language_id:language_id,  difficulty_level_id: difficulty_level_id, number_of_questions:number_of_questions, rule_description:rule_description },  
        function(result){
		if(result == true) {
			$("#msg_validate_"+rule_id).html("Validated");
			$("input[name='h_validate_"+rule_id+"']").val("1");

			alert("Rule "+rule_id+" Validated."); 
		}else{
			$("#msg_validate_"+rule_id).html("Not Validated");
			$("input[name='h_validate_"+rule_id+"']").val("-1");
			alert("Rule "+rule_id+" Validation failed."); 	 
		}
    });

 	
}		
			
function searchStringInArray (str, strArray) {
	var output = 0;
   for (var j=0; j<strArray.length; j++) {
       if (strArray[j]==str) output ++;
   }
   return output;
}
	
function check_duplicate_id (str_ids)
{		
	array_str =  str_ids.split(',');
	var var_return = true;
	for (var i=0; i<array_str.length;i++)
	{
		id = array_str[i];
		var count = searchStringInArray (id, array_str);
		if(count>1){
			return false;
		
		}else{
		//do nothing;
		}
	}
	return var_return;
}
