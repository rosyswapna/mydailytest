<a id="menu_button" href="dashboard.php">HOME</a>
<?php if(isset($_SESSION[SESSION_TITLE.'admin_userid']) && $_SESSION[SESSION_TITLE.'admin_userid'] > 0){ ?>
<!--
<a href="contents_search.php" title="Dynamic Contents">Dynamic Contents</a>
<a href="settings.php" title="Settings">Settings</a> -->
<ul id="menu">
    <li><a href="#">QUIZZES</a>
        <ul class="sub-menu">
            <li>
			<a id="menu_button" href="quiz.php"  title="Add Quiz">ADD QUIZ</a>
            </li>
            <li>
              <a id="menu_button" href="quizzes.php" title="View Quizzes">VIEW QUIZZES</a>
            </li>
        </ul>
   
</li>

	
	 <li><a href="#">USERS</a>
        <ul class="sub-menu">
            <li>
			<a id="menu_button" href="user.php" title="Add User">ADD USER</a>
            </li>
            <li>
              <a id="menu_button" href="import_user_csv.php" title="Import User">IMPORT USER</a>
            </li>
			<li>
              <a id="menu_button" href="users.php" title="View User">VIEW USER</a>
            </li>
			
			<li>
			<a id="menu_button" href="organization.php" title="Add Organization">ADD ORGANIZATION</a>
            </li>
            <li>
              <a id="menu_button" href="organizations.php" title="View Organizations">VIEW ORGANIZATION</a>
            </li>
			<li>
			<a id="menu_button" href="agent.php" title="Add Organization">ADD AGENT</a>
            </li>
            <li>
              <a id="menu_button" href="agents.php" title="View Organizations">VIEW AGENTS</a>
            </li>
        </ul>
    </li>
	


<li><a href="#">QUESTION && GROUPS</a>
        <ul class="sub-menu">
            <li>
			<a id="menu_button" href="question.php" title="Add Question">ADD QUESTIONS</a>
            </li>
            <li>
              <a id="menu_button" href="questions.php" title="View Questions">VIEW QUESTIONS</a>
            </li>
			 <li>
              <a id="menu_button" href="import_question_csv.php" title="Import Questions">IMPORT QUESTIONS</a>
            </li>
			 <li>
              <a id="menu_button" href="imports.php" title="View Imported Questions">VIEW IMPORTS</a>
            </li>

            <li>
			<a id="menu_button" href="group.php" title="Add Groups">ADD GROUPS</a>
            </li>
            <li>
              <a id="menu_button" href="groups.php" title="View Groups">VIEW GROUPS</a>
            </li>
			 <li>
              <a id="menu_button" href="import_group_csv.php" title="Import Groups">IMPORT GROUPS</a>
            </li>
			 <li>
              <a id="menu_button" href="import_groups.php" title="View Imported Groups">VIEW IMPORTS</a>
            </li>
        </ul>
</li>
<li><a href="#">VOUCHERS</a>
        <ul class="sub-menu">
            <li>
			<a id="menu_button" href="generate_vouchers.php" title="Add Question">GENERATE VOUCHERS</a>
            </li>
            <li>
              <a id="menu_button" href="allocate_vouchers.php" title="View Questions">ALLOCATE VOUCHERS</a>
            </li>
			 <li>
              <a id="menu_button" href="bills.php" title="Import Questions">VIEW VOUCHER BILLS</a>
            </li>
			
        </ul>
</li>

<li><a href="#">MISC</a>
        <ul class="sub-menu">
            <li>
			<a id="menu_button" href="exam.php" title="Add Set">ADD EXAM</a>
            </li>
            <li>
              <a id="menu_button" href="subject.php" title="Add Subject">ADD SUBJECT</a>
            </li> 
			<li>
              <a id="menu_button" href="section.php" title="Add Section">ADD SECTION</a>
            </li>
			 <li>
              <a id="menu_button" href="difficulty_level.php" title="Add Difficulty Level">ADD DIFFICULTY LEVEL</a>
            </li>
			 <li>
              <a id="menu_button" href="language.php" title="Add Language">ADD LANGUAGE</a>
            </li>
			 <li>
              <a id="menu_button" href="add_credit.php" title="Add Credit">ADD CREDIT PLAN</a>
            </li>	
			 <li>
			<a id="menu_button"  href="change_password.php" title="Change Password">CHANGE PASSWORD</a> 
            </li>
					
        </ul>
</li>






		
       
            <li>
			<a id="menu_button"  href="logout.php" title="logout">LOGOUT</a> 
            </li>
           
       
   








<?php }else{ ?>
<a id="menu_button"  href="index.php" title="Login">LOGIN</a>
<?php } ?>

