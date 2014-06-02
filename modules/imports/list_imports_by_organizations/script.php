<!--
function Trim(strInput) {
    while (true) {
        if (strInput.substring(0, 1) != " ")
            break;
        strInput = strInput.substring(1, strInput.length);
    }
    while (true) {
        if (strInput.substring(strInput.length - 1, strInput.length) != " ")
            break;
        strInput = strInput.substring(0, strInput.length - 1);
    }
   return strInput;
}




$(document).ready(function(){
	 var exporting_html = 'Exporting to Main DB...';
	$(document).on('click', '.export', function() {
    var question_import_id=this.id;alert(question_import_id);
 $.post("exports.php",{ question_import_id: question_import_id },  
            function(result){ 

                //if the result is 0  
                if(result == 1){  
                    //show that Export succesful  
                   alert("Export Successful");
                }else{  
                    //show that the username is NOT available  
                    alert("Export Unsuccessful");  
                }  
        });
}); 
});

 -->
