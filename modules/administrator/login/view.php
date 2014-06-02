<?php // prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}
?>



		<form target="_self" method="post" action="<?php echo $current_url?>" name="frmlogin">
<table>
<tr>
<td colspan="2">
<a href="<?php echo WEB_URL;?>"><?php echo WEB_URL;?></a><br /><br />
</td>
</tr>
<tr>
<td><strong>Username:</strong> </td>
<td><input onclick="clean_loginname();" class="login_box"  type="text" name="loginname" id="loginname"  title="<?php echo $msg_default_username ?>"  value="<?php echo $msg_default_username ?>" ></td>
</tr>
<tr>
<td><strong>Password:</strong> </td>
<td><input class="login_box"  type="password" name="passwd" id="passwd" ></td>
</tr>
<tr><td colspan="2" >&nbsp; </td></tr>
<tr><td colspan="2" align="center"><input  value="<?php echo $submit_sign_in ?>" type="submit" name="submit" >
            <input name="h_id" value="<?php if(isset($h_id))echo $h_id; ?>" type="hidden">
			<input name="h_login" value="pass" type="hidden"> </td>
</tr>
<tr><td colspan="2" >&nbsp; </td></tr>
<tr><td colspan="2"align="center" > <div class="login_error">
	<?php if(isset($myuser->err_desc)) echo $myuser->err_desc; 
	if(isset($login_error)) echo $login_error ;?>
</div></td></tr>
			
		</form>


    <script language="javascript" type="text/javascript">
    //<!--
            document.getElementById("loginname").focus();
            document.getElementById("loginname").select();
   //-->
    </script>   


</div>
