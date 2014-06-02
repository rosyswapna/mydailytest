

<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /> 
<title>Import </title> 
</head> 

<body> 

<?php 


$breadcrumb='<a href="/organization/index.php">Home</a> &raquo; <a href="/organization/import_user_csv.php">Import user</a>';
?>
<div class="two-thirds column mright8 bottom-1"> 

                    <div class="innercontainer-blk">
                        <p class="heading"><?php echo $CAP_page_caption?></p>
                        <form target="_self" method="post" action="<?php echo $current_url?>" enctype="multipart/form-data" name="frmcsv" id="frmcsv">
                        <div class="one-third column mright4">
                            <div class="form-box">
                                <label><small></small></label>
                                      </div><!-- End Box -->
                        </div>
                        <div class="clear"></div>
                        <div class="one-third column mright4">
                            <div class="form-box">
                                <label><?php echo $CAP_file?> <small>*</small></label>
                                <input name="csv" type="file" id="csv" class="text" />
                            </div><!-- End Box -->
                        </div>
                       <div class="clear"></div>
                        <div class="sixteen columns">
                            <div class="form-box">
                                <label><?php echo $CAP_credit?> </label>
                                <input type="text" name="txtcredit" value=""/> 
                                &nbsp;Available Credit : <?php echo $myorganizationcredit->total_credit; ?>                        
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="one-third column mright4">
                            <div class="form-box">
                               <input type="submit" class="button" name="Submit" value="<?php echo $CAP_upload?>" />
                            </div><!-- End Box -->
                        </div>


                    </form>      
                    </div>
</div>
















</body> 
</html> 
