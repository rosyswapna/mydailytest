
<?php if(isset($_SESSION[SESSION_TITLE.'userid']) && $_SESSION[SESSION_TITLE.'user_type'] == REGISTERED_AGENT){ ?>
<li><a   <?php if($this->page_name == "index"){?> class="active"<?php  }?>  href="index.php">HOME</a></li>
<li><a  <?php if($this->page_name == "dashboard"){?> class="active"<?php  }?>  href="dashboard.php">DASHBOARD</a></li>
<li><a  <?php if($this->page_name == "profile"){?> class="active"<?php  }?> href="profile.php">PROFILE</a></li>
<li><a  <?php if($this->page_name == "update_password"){?> class="active"<?php  }?>  href="update_password.php">CHANGE PASSWORD</a></li>
<li><a  href="logout.php">SIGN OUT</a></li>
<?php } else {
?>
<li><a  <?php if($this->page_name == "index"){?> class="active"<?php  }?> href="/index.php">HOME</a></li>
<li><a  <?php if($this->page_name == "login"){?> class="active"<?php  }?> href="/agent/login.php">Login</a></li>
<?php }
?>
 
 

