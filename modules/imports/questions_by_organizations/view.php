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

<?php

$breadcrumb='<a href="/organization/index.php">Home</a> &raquo; <a href="/organization/import_question_csv.php">Import questions</a>';
 if(isset( $mytempquestion->error_description)) $_SESSION[SESSION_TITLE.'flash'] = $mytempquestion->error_description; 
?>
<div class="two-thirds column mright8 bottom-1">            
                    <div class="innercontainer-blk">
                        <p class="heading"><?php echo $CAP_page_caption?> </p>
                        <form target="_self" method="post" action="<?php echo $current_url?>" enctype="multipart/form-data" name="frmcsv" id="frmcsv"> 
                        <div class="one-third column mright4">
                            <div class="form-box">
                                <label><?php echo $CAP_created; ?><small>*</small></label>
                                <input type="text" name="txtcreated" class="text"> 
                            </div><!-- End Box -->
                        </div>
                        <div class="clear"></div>
                        <div class="one-third column mright4">
                            <div class="form-box">
                                <label><?php echo $CAP_description; ?><small>*</small></label>
                                <textarea name="txtdescription" class="text"></textarea>
                            </div><!-- End Box -->
                        </div>
                        <div class="clear"></div>
                        <div class="one-third column mright4">
                            <div class="form-box">
                                <label><?php echo $CAP_csv_file?> <small>*</small></label>
                                <input name="csv" type="file" id="csv" class="text" >
                            </div><!-- End Box -->
                        </div>
                        <div class="clear"></div>
                        <div class="one-third column mright4">
                            <div class="form-box">
                                <label><?php echo $CAP_zip_file?> <small></small></label>
                                <input name="zip" type="file" id="zip" class="text">
                            </div><!-- End Box -->
                        </div>
                        <div class="one-third column mright4">
                            <div class="form-box">
                                <label> <?php echo $CAP_delimiter; ?> <small>*</small></label>
                                <input type="text" name="txtdelimiter" class="text" >
                            </div><!-- End Box -->
                        </div>
                        <div class="one-third column mright4">
                            <div class="form-box big">
                                <label><?php echo $CAP_question_start_col; ?><small>*</small></label>
                                <input type="text" name="txtquestionstartcol" class="text">
                            </div><!-- End Box -->
                        </div>
                        <div class="one-third column mright4">
                            <div class="form-box">
                                <label><?php echo $CAP_question_image_start_col; ?> <small>*</small></label>
                                <input type="text" name="txtquestionimagestartcol" class="text" >
                            </div><!-- End Box -->
                        </div>
                         <div class="one-third column mright4">
                            <div class="form-box">
                                <label> <?php echo $CAP_option_start_col; ?> <small>*</small></label>
                               <input type="text"  class="text" name="txtoptionstartcol"><p class="exam_checkboxs"> <input type="checkbox" checked name=shuffle_chkbox>&nbsp;Shuffle Options.</p>
                            </div><!-- End Box -->
                        </div><div class="clear"></div>
                        <div class="one-third column mright4">
                            <div class="form-box big">
                                <label><?php echo $CAP_number_option; ?><small>*</small></label>
                                <input type="text" name="txtnumberoption" class="text">
                            </div><!-- End Box -->
                        </div>
                        <div class="one-third column mright4">
                            <div class="form-box">
                                <label><?php echo $CAP_image_start_col; ?> <small>*</small></label>
                                <input type="text" name="txtimagestartcol" class="text" >
                            </div><!-- End Box -->
                        </div>
                         <div class="one-third column mright4">
                            <div class="form-box big">
                                <label><?php echo $CAP_answer_start_col; ?><small>*</small></label>
                                <input type="text" name="txtanswerstartcol" class="text">
                            </div><!-- End Box -->
                        </div>
                        <div class="one-third column mright4">
                            <div class="form-box">
                                <label><?php echo $CAP_number_answer; ?><small>*</small></label>
                                <input type="text" name="txtnumberanswer" value="1" class="text">
                            </div><!-- End Box -->
                        </div>
                         <div class="one-third column mright4">
                            <div class="form-box big">
                                <label><?php echo $CAP_exam_start_col; ?><small>*</small></label>
                                <input type="text" name="txtexamstartcol" class="text">
                            </div><!-- End Box -->
                        </div>

                        <div class="one-third column mright4">
                            <div class="form-box">
                                <label>OR <?php echo $CAP_exam; ?><small>*</small></label>
                                <?php populate_list_array("txtexam", $exam, "id", "name", $myexam->id,$disable=false); ?> 
                            </div><!-- End Box -->
                        </div>
                        <div class="one-third column mright4">
                            <div class="form-box big">
                                <label><?php echo $CAP_subject_start_col; ?></label>
                                <input type="text"  name="txtsubjectstartcol"  class="text">
                            </div><!-- End Box -->
                        </div>
                        <div class="one-third column mright4">
                            <div class="form-box">
                                <label>OR <?php echo $CAP_subject; ?></label>
                                <?php populate_list_array("txtsubject", $subject, "id", "name", $mysubject->id,$disable=false); ?>
                            </div><!-- End Box -->
                        </div>
                        <div class="one-third column mright4">
                            <div class="form-box big">
                                <label><?php echo $CAP_section; ?></label>
                                <input type="text" name="txtsection_col"  class="text">
                            </div><!-- End Box -->
                        </div>
                        <div class="one-third column mright4">
                            <div class="form-box">
                                <label>OR <?php echo $CAP_section_id; ?></label>
                                <?php populate_list_array("txtsection", $sections, "id", "name",$mysection->id,$disable=false); ?>
                            </div><!-- End Box -->
                        </div>
                        <div class="one-third column mright4">
                            <div class="form-box big">
                                <label><?php echo $CAP_difficulty_level; ?></label>
                                <input type="text" name="txtdifficulty_level_col" class="text">
                            </div><!-- End Box -->
                        </div>
                        <div class="one-third column mright4">
                            <div class="form-box">
                                <label>OR <?php echo $CAP_difficulty; ?></label>
                                <?php populate_list_array("txtdifficultylevel", $difficulty_levels, "id", "name",$mydifficultylevel->id,$disable=false); ?> 
                            </div><!-- End Box -->
                        </div>
                        <div class="one-third column mright4">
                            <div class="form-box big">
                                <label><?php echo $CAP_language_id; ?></label>
                                <input type="text" name="txtlanguage_col" class="text">
                            </div><!-- End Box -->
                        </div>
                        <div class="one-third column mright4">
                            <div class="form-box">
                                <label>OR <?php echo $CAP_language; ?></label>
                                <?php populate_list_array("txtlangauge", $languages, "id", "name",$mylanguage->id, $disable=false); ?> 
                            </div><!-- End Box -->
                        </div>
                        <div class="one-third column mright4">
                            <div class="form-box big">
                                <label><?php echo $CAP_group_key; ?></label>
                                <input type="text" name="txtgroup_key_col" class="text">
                            </div><!-- End Box -->
                        </div>
                        <div class="clear"></div>
                        <div class="one-third column mright4">
                            <div class="form-box">
 <input type="submit" name="submit" value="<?php echo $CAP_upload?>" class="button">
                                
                                <input type="reset" class="button gray" value="Cancel">
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
</body> 
</html> 
