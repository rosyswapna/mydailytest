<?php 
	$url_profile ="#";
	$organization_prefix = "";

	if(isset($_SESSION[SESSION_TITLE.'user_type']) && $_SESSION[SESSION_TITLE.'user_type'] == REGISTERED_ORGANISATION ){
		$organization_prefix = "/organization";
	}

	if(isset($_SESSION[SESSION_TITLE.'userid'])){ 

		if($_SESSION[SESSION_TITLE.'user_status_id']==USERSTATUS_IMPORTED || $_SESSION[SESSION_TITLE.'user_status_id'] == USERSTATUS_MOBILE_REGISTRATION ){
			$url_profile ="/update_user_profile.php";
		}else{
			$url_profile =$organization_prefix."/profile.php";
		}
	}
?>
		<li><a href="/index.php" <?php if($this->page_name == "index"){?> class="active"<?php  }?>>Home</a></li>
<?php if(isset($_SESSION[SESSION_TITLE.'userid'])){ ?>


<?php if($_SESSION[SESSION_TITLE.'user_status_id']==USERSTATUS_ACTIVE  ){ ?>
		<li><a href="/dashboard.php" <?php if($this->page_name == "dashboard"){?> class="active"<?php  }?>>Take My Test</a></li>
<?php } ?>
		<li><a href="<?php echo $url_profile;  ?>" <?php if($this->page_name == "profile"){?> class="active"<?php  }?>>My Profile</a></li>
<?php if($_SESSION[SESSION_TITLE.'user_status_id']==USERSTATUS_ACTIVE  ){ ?>
		<li><a href="/user_test_history.php" <?php if($this->page_name == "user_test_history"){?> class="active"<?php  }?>>Test History</a></li>
<?php } ?>

<?php }else{ ?>
		<li><a href="demo.php" <?php if($this->page_name == "demo"){?> class="active"<?php  }?>>MOCK TEST</a></li>
		<li><a href="sign_up.php" <?php if($this->page_name == "sign_up"){?> class="active"<?php  }?>>SIGN UP</a></li>

<?php } ?>


