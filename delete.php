<?php
	require_once("common/session.php");	
	require_once("common/class.user.php");
	$delete_data = new USER();
	
	//DELETE Office 
	if(isset($_GET['del_ofc_id'])&& $session->is_loggedin())
	{
		$delstmt = $delete_data->runQuery("DELETE FROM officedetails");
		$delstmt->execute();	
		?>
    <script type="text/javascript">
        window.location.href = "office.php";
    </script>
    <?php
    }

    //DELETE Employee 
	if(isset($_GET['del_emp_id'])&& $session->is_loggedin())
	{
		$delstmt = $delete_data->runQuery("DELETE FROM employeedetails");
		$delstmt->execute();	
		?>
    <script type="text/javascript">
        window.location.href = "employee.php";
    </script>
    <?php
    }

    //DELETE Randomization Data del_rand_id
	if(isset($_GET['del_rand_id'])&& $session->is_loggedin())
	{
		$delstmt = $delete_data->runQuery("DELETE FROM randomization");
		$delstmt->execute();	
		?>
    <script type="text/javascript">
        window.location.href = "randomize.php";
    </script>
    <?php
    }
	
?>