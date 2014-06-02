<?php
if ( !defined('CHECK_INCLUDED') ){
    exit();
}?>
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /> 
<title>Import </title> 
</head> 

<body> 

<?php //if (!empty($_GET[success])) { echo "<b>Your file has been imported.</b><br><br>"; } //generic success notice ?> 

<form target="_self" method="post" action="<?php echo $current_url?>" enctype="multipart/form-data" name="frmcsv" id="frmcsv"> 
<table border="0" cellpadding="0" cellspacing="2" >
                <tr>
                    <td colspan="2" class="page_caption"><?php echo $CAP_page_caption?></td>
                </tr>
                <tr>
		<tr>
                    <td>&nbsp;</td>    
                    <td>&nbsp;</td>
		<tr>
			<tr>
                    <td colspan="2" class="errormessage">
                    <?php if(isset( $mytempquestion->error_description)) echo $mytempquestion->error_description; ?>
                    </td>
                </tr>
                    <td><?php echo $CAP_created; ?></td>   
                    <td><input type="text" name="txtcreated">
                    </td>
                </tr>
		
                    <td><?php echo $CAP_description; ?></td>   
                    <td><textarea name="txtdescription"></textarea>
                    </td>
                </tr>
                <tr><td><?php echo $CAP_csv_file?> </td><td> <input name="csv" type="file" id="csv" /> </td></tr>
			<tr><td><?php echo $CAP_zip_file?> </td><td> <input name="zip" type="file" id="zip" /> </td></tr>
		<tr>
                    <td><?php echo $CAP_Organization; ?></td>   
                    <td><?php populate_list_array("txtorganizationid", $organizations, "id", "name", gINVALID,false); ?>  
                    </td>
                </tr>
  		<tr>
                <td colspan="2" class="page_caption"><?php echo $CAP_caption?></td>
                </tr>
			<tr>
                    <td><?php echo $CAP_delimiter; ?><span style="color:red">*</span></td>   
                    <td><input type="text" name="txtdelimiter">
                    </td>
                </tr>
		<tr>
                    <td><?php echo $CAP_question_start_col; ?><span style="color:red">*</span></td>   
                    <td><input type="text" name="txtquestionstartcol">
                    </td>
                </tr>
		<tr>
                    <td><?php echo $CAP_question_image_start_col; ?></td>   
                    <td><input type="text" name="txtquestionimagestartcol">
                    </td>
                </tr>
		<tr>
                    <td><?php echo $CAP_option_start_col; ?><span style="color:red">*</span></td>   
                    <td><input type="text" name="txtoptionstartcol"><input type="checkbox" checked name=shuffle_chkbox>&nbsp;Shuffle Options.
                    </td>
                </tr>
		<tr>
                    <td><?php echo $CAP_number_option; ?><span style="color:red">*</span></td>   
                    <td><input type="text" name="txtnumberoption">
                    </td>
                </tr>
		<tr>

		<tr>
                    <td><?php echo $CAP_image_start_col; ?></td>   
                    <td><input type="text" name="txtimagestartcol">
                    </td>
                </tr>
		<tr>
                    <td><?php echo $CAP_number_image; ?></td>   
                    <td><input type="text" name="txtnumberimage">
                    </td>
                </tr>
		<tr>
                    <td><?php echo $CAP_answer_start_col; ?><span style="color:red">*</span></td>   
                    <td><input type="text" name="txtanswerstartcol">
                    </td>
                </tr>
		<tr>
                    <td><?php echo $CAP_number_answer; ?></td>   
                    <td><input type="text" name="txtnumberanswer" value="1">
                    </td>
                </tr>
		<tr>
                    <td><?php echo $CAP_exam_start_col; ?><span style="color:red">*</span></td>   
                    <td><input type="text" name="txtexamstartcol" >
                    </td>
                    <td>OR <?php echo $CAP_exam; ?><span style="color:red">*</span></td>   
                    <td><?php populate_list_array("txtexam", $exam, "id", "name", $myexam->id,$disable=false); ?>  
                    </td>
               
                </tr>
		<tr>
                    <td><?php echo $CAP_subject_start_col; ?></td>   
                    <td><input type="text"  name="txtsubjectstartcol" >
                    </td><td>OR <?php echo $CAP_subject; ?></td>   
                    <td><?php populate_list_array("txtsubject", $subject, "id", "name", $mysubject->id,$disable=false); ?>  
                    </td>
                </tr>
		<tr>
                    <td><?php echo $CAP_section; ?></td>   
                    <td><input type="text" name="txtsection_col"  ></td><td>OR <?php echo $CAP_section_id; ?></td>
                    <td><?php populate_list_array("txtsection", $sections, "id", "name",$mysection->id,$disable=false); ?></td>
                </tr>
		<tr>
                    <td><?php echo $CAP_difficulty_level; ?></td>   
                    <td><input type="text" name="txtdifficulty_level_col" ><td>OR <?php echo $CAP_difficulty; ?></td>
                    </td><td><?php populate_list_array("txtdifficultylevel", $difficulty_levels, "id", "name",$mydifficultylevel->id,$disable=false); ?></td>
                </tr>
		<tr>
                    <td><?php echo $CAP_language_id; ?></td>   
                    <td><input type="text" name="txtlanguage_col" ><td>OR <?php echo $CAP_language; ?></td>
                    </td><td><?php populate_list_array("txtlangauge", $languages, "id", "name",$mylanguage->id, $disable=false); ?></td>
                </tr>
		<tr>
                    <td><?php echo $CAP_group_key; ?></td>   
                    <td><input type="text" name="txtgroup_key_col" >
                    </td>
                </tr>
			<tr>
                   <td></td> <td><input type="submit" name="submit" value="<?php echo $CAP_upload?>" /> </td>
			</tr></table>
</form> 

</body> 
</html> 
