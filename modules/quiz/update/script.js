
$( document ).ready(function() {

	
	

	//----------------show or hide rows with quiz type start here------------
	var quiz_type = $('select[name=lstquiz_type]').val();
	if(quiz_type == 1){
		$('tr#tr_qg_nos').hide();
		$('tr#tr_q_nos').hide();
		$('tr#tr_real').show();
		$('tr#tr_real1').show();
		$('tr#tr_real2').show();
	}
	else if(quiz_type == 2 || quiz_type == 3){
		$('tr#tr_qg_nos').show();
		$('tr#tr_q_nos').show();
		$('tr#tr_real').hide();
		$('tr#tr_real1').hide();
		$('tr#tr_real2').hide();
	}
	else{
		$('tr#tr_qg_nos').hide();
		$('tr#tr_q_nos').hide();
		$('tr#tr_real').hide();
		$('tr#tr_real1').hide();
		$('tr#tr_real2').hide();
	}
	
	
	$('select[name=lstquiz_type]').change(function(){
		var quiz_id=$(this).val();
		if(quiz_id == 1){
			$('tr#tr_qg_nos').hide();
			$('tr#tr_q_nos').hide();
			$('tr#tr_real').show();
			$('tr#tr_real1').show();
			$('tr#tr_real2').show();
		}
		else if(quiz_id == 2){
			$('tr#tr_qg_nos').show();
			$('tr#tr_q_nos').show();
			$('tr#tr_real').hide();
			$('tr#tr_real1').hide();
			$('tr#tr_real2').hide();
		}
		else if(quiz_id == 3){
			$('tr#tr_qg_nos').show();
			$('tr#tr_q_nos').show();
			$('tr#tr_real').hide();
			$('tr#tr_real1').hide();
			$('tr#tr_real2').hide();
		}
		else{
			$('tr#tr_qg_nos').hide();
			$('tr#tr_q_nos').hide();
			$('tr#tr_real').hide();
			$('tr#tr_real1').hide();
			$('tr#tr_real2').hide();
		}
			
	});
	//----------------show or hide rows with quiz type end here------------
	

	var id = $("#cnt").val();
	$("#add_more").click(function(){
		
		id++;
		$('<div id="real_quiz_dtls'+id+'"><table border="0" cellspacing="4" width="100%" cellpadding="2" id="real_qns_list"><tr><td>Quiz Rule '+id+'  :  </td><td align="right"> <p id="msg_validate_'+id+'">Not Validated</p> <input type="hidden"  name ="h_validate_'+id+'" value="-1" /> <div id="top_rule"><input type="button" value="close" id="'+id+'" class="real_quiz_hide"/> <input type="button" value="Validate Rule" rule_id="'+id+'" class="button_validate_rule" name="button_validate_rule[]" onClick = "check_rule(this);"  /> </div> </td></tr></tr><tr><td width="25%">Rule Description<span style="color:red;">*</span> </td><td width="49%"><textarea name="ruledescription[]" cols="45" rows="5" id="ruledescription[]"></textarea></td></tr><tr><td width="25%">Question Ids</td><td width="49%"><textarea name="rulequestionids[]" cols="45" rows="5" id="rulequestionids[]"></textarea></td></tr><tr><td></td><td align="right"><input type="button" name="get_questionids[]" class="btn_get_questionids" id="get_questionids[]" value = "Get Question Ids" rule_id="'+id+'" /></td></tr><tr><td width="25%">From Passage&nbsp;<input type="checkbox" value="'+id+'" name="chk_passage[]" id="chk_passage[]"/></td><td width="49%"><div id="div_grp'+id+'" style="display:none;">&nbsp;&nbsp;Number of Question Groups<span style="color:red;">*</span> <input type="text" style="width:110px;" name="no_question_groups[]" value =""/></div></td></tr><tr><td width="25%">Exam<span style="color:red;">*</span> </td><td width="49%">'+exam_list+'</td></tr><tr><td width="49%">Subject </td><td width="49%">'+subject_list+'</td></tr><tr><td width="25%">Section </td><td width="49%">'+section_list+'</td></tr><tr><td width="49%">Language </td><td width="49%">'+language_list+'</td></tr><tr><td width="25%">Difficulty Level </td><td width="49%">'+difficulty_level_list+'</td></tr><tr><td width="49%">Number Of Questions<span style="color:red;">*</span></td><td width="49%"><input type="text" name="no_questions[]" value =""/></td></tr><tr><td width="49%">Total Mark<span style="color:red;">*</span></td><td width="49%"><input type="text" name="total_mark[]" value =""/></td></tr><tr><td width="49%">Negative Mark <input type="text" name="negative_mark[]" value =0  style="width:50px;"/></td><td width="49%">For	<input type="text" name="wrong_answer_count[]" value =0 style="width:50px;"/> Wrong Answers</td></tr><tr><td height="50"></td></tr></table></div>').animate({ opacity: 'show' }, 'slow').appendTo('#real_quiz_dtls');

		

	});



$('body').on('click','.real_quiz_hide',function() {
	
	var rem_id = $(this).attr("id");
	$("#cnt").val(rem_id-1);
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
		var quiz_group_ids = $("#txtquestiongroups").val();
		var quiz_ids = $("#txtquestions").val();
		if(quiz_ids == "" && quiz_group_ids == ""){
			error += "Enter question ids or passage ids\n";
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
	
	var rule_id = $(this).attr('rule_id');
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

	var chk_passage_obj = $('input[name="chk_passage[]"]');
	if($(chk_passage_obj[rule_index]).prop('checked')){
		question_group = 1;
		limit = number_of_question_groups ;
		if(limit == "" || limit <=0){
			alert("Enter Number of passages");return false;
		}
	}else{
		question_group = 0;
		limit = number_of_questions;
	}
	

	if(number_of_questions == "" || number_of_questions <= 0){
		alert("Enter Number of questions");
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

/*
$('select[name="lstexam[]"]').live("change",function(){
	var selectbox = $(this);
	var rule_id = selectbox.index('select')/5;
	var rule_index = rule_id-1;
});
*/







      
//show or hide number of question groups input box
$('body').on('click','input[name="chk_passage[]"]',function() {
	 var rule_id = $(this).val();
	 var div_passage_id ="#div_grp"+rule_id;

	 if($(this).prop('checked')){
	 	$(div_passage_id).show();
	 }
	 else{
	 	$(div_passage_id).hide();
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
	chk_passage =$(chk_passage_obj[dynamicIndex]).val();

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
	


	$.get("quiz_rule_check.php", { question_group:question_group, exam_id: exam_id, subject_id:subject_id, section_id:section_id, language_id:language_id,  difficulty_level_id: difficulty_level_id, number_of_questions:number_of_questions, rule_description:rule_description },  
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
