

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
                    <td><?php echo $CAP_Organization; ?></td>   
                    <td><?php populate_list_array("txtorganizationid", $organizations, "id", "name", gINVALID,$disable=false); ?>  
                    </td>
                </tr>
		
                </tr><td><?php echo $CAP_file?> </td><td> <input name="csv" type="file" id="csv" /> </td></tr>
  		<tr>
		<tr><td></td><td></td></tr><tr><td></td><td></td></tr><tr><td></td><td></td></tr>
		<tr><td></td><td>
			<input type="checkbox" name="chkoffer"/><?php echo $CAP_chk_offer; ?>
		</td>
		</tr>
                   <td></td> <td><input type="submit" name="Submit" value="<?php echo $CAP_upload?>" /> </td>
			</tr></table>
</form> 

</body> 
</html> 
