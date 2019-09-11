<?php
	session_start();
	require_once('common/class.user.php');
	
	$admin_logout = new USER();
	
	if($admin_logout->is_loggedin()!="")
	{
		$admin_logout->redirect('dashboard.php');
	}
	if(isset($_GET['logout']) && $_GET['logout']=="true")
	{
		$admin_logout->doLogout();
		$admin_logout->redirect('index.php');
	}

?>