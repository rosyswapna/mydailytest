<!-- 
function validate(){
        error = "";
		
		if(document.getElementById("txtanswers").value==""){
            error = "<?php echo $answer_empty ?>\n";
        }
        
      	if(document.getElementById("txtoptions").value==""){
            error = "<?php echo $option_empty ?>\n";
        }
       
         if(document.getElementById("lstquestionstatuses").value=="-1"){
            error = "<?php echo $ques_stat_id_empty ?>\n";
        }  
		
		  if(document.getElementById("lstexam").value=="-1"){
            error = "<?php echo $exam_id_empty ?>\n";
        }
    	if(document.getElementById("txtquestion").value==""){
            error = "<?php echo $question_empty ?>\n";
        }
        if ( error != "" ){
            alert(error);
            return false;
        }else{
            return true;
        }
    }

	$(document).ready(function(){
	
	$( document ).on("click",".addtextbox",function () {
	
	var option_id=$(this).attr('option_id');
	
	var question_id=$(this).attr('question_id');
	option_id++;
	var content='<p class="exam_checkboxs"><input class="classcheck" type="checkbox" id="optioncheck_'+question_id+'" name="optioncheck[]" value="'+option_id+'"></p>';
content=content+'<input type="text" class="text"  id="txtoptions_'+option_id+'" name="txtoptions[]" value=""><br>';
	
	
	var content_addtextbox='<br><input type="button" value="Add Option" question_id="'+question_id+'" option_id="'+option_id+'" class="addtextbox button" id="addtextbox_'+option_id+'">';
if(question_id!=<?php  echo gINVALID;?>){	
var content_file='<a class="option_image_edit" href="option_image_edit.php?option_position='+option_id+'&&id='+question_id+'">Add</a><img  src="/images/noimage.png" alt="File not found"  alt="File not found" height="50" width="100" border="3" ><br><br>';
}else{
var content_file='<br><br><input class="text" type="file" name="image[]" multiple />';
}
	$('.addtextbox_div').html(content_addtextbox);
	$('.newoption_div').append(content);
	$('.newfile_div').append(content_file);
	});
	$( document ).on("click",".classcheck",function () {
	
	$('.answer_paragraph').html("");
	index=1;
	$("input[name='optioncheck[]']").each(function () {
	if( $(this).is(':checked') ){
     	 var checkbox_value= $(this).val();
	var option_val=$('#txtoptions_'+checkbox_value).val();
	if(option_val!=''){
	$('.answer_paragraph').append(index+' : '+option_val+'<br>');
	index++;	
	}
	}
	
	});
	});
	$( document ).on( "mouseover", ".img", function() {
	this.width='150'; 
	this.height='100';
	});

	$( document ).on( "mouseout", ".img", function() {
	this.width='100'; 
	this.height='50';
	});
	$( document ).on( "click", ".option_image_edit", function() {
	newwindow=window.open(this.href,'name','height=250,width=520,top=200,left=300,resizable');
	if (window.focus) {newwindow.focus()}
	return false;
	});
	
	
		
	});

-->

