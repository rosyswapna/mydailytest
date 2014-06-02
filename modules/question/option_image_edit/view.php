<form  target="_self" method="post" enctype="multipart/form-data" action="<?php echo $current_url?>" name="frm">
<table><br><br><br><br>
<tr>
<td>Option Image :</td>
<td>
<input type="file" name="option_image"/> <input type="hidden" name="id" value="<?php if(isset($_POST['id'])) { echo $_POST['id'];  }else{ echo $_GET['id']; } ?>">
<input type="hidden" name="option_position" value="<?php if(isset($_POST['option_position'])) { echo $_POST['option_position'];  }else{ echo $_GET['option_position']; } ?>">
<input type="hidden" name="image" value="<?php if(isset($_POST['image'])) { echo $_POST['image'];  }else{ if(isset($_GET['image'])){ echo $_GET['image'];  }else{ echo gINVALID; } } ?>">
</td>
<td></td><td><input type="submit" name="upload" value="upload"></td>
</tr>
</table>
</form>
