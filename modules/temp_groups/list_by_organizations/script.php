<!--



$(document).ready(function(){
	
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
	passage_id=$(this).attr('passage_id');
	$('#answer_paragraph_'+passage_id).html("");
	index=1;
	$("input[name='optioncheck_"+passage_id+"[]']").each(function () {
	if( $(this).is(':checked') ){
     	 var checkbox_value= $(this).val();
	var option_val=$('#txtoptions_'+passage_id+'_'+checkbox_value).val();
	$('#answer_paragraph_'+passage_id).append(index+' : '+option_val+'<br>');
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
		passage_id=$(this).attr('passage_id');
		$("#popup_form_"+passage_id).toggle();
		return false;	
		//

	   }); 

	 $('.test').live("click", function () {
	var passage_id=$(this).attr('passage_id');
	
	});
	

	$('.update_button').live("click", function () {
	passage_id=$(this).attr('passage_id');
	var i=0;
	var passage = $('#txtpassage_'+passage_id).val();
	var id=$('#txtid_'+passage_id).val();
	i=0;
	var subject_id=$("select[name='lstsubject_"+passage_id+"']").val();
	var exam_id=$("select[name='lstexam_"+passage_id+"']").val();

        //use ajax to run the check 
	 $.post('temp_group.php',{
	id:id,
	passage:passage,
	subject_id:subject_id,
	exam_id:exam_id
	},function(data){
	if(data!='1'){
	$("#passage_div_"+passage_id).html(data);
	$("#popup_form_"+passage_id).hide();
	
	}
	else{
	$("#popup_form_"+passage_id).hide();
	}
	});
	
        });

});

 -->
