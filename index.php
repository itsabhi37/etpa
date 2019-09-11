<?php
session_start();
/*require_once("php/header.php");*/
require_once("common/class.user.php");

$login = new USER();
if($login->is_loggedin()!="")
{
	$login->redirect('dashboard.php');
}
if(isset($_POST['btnLogin']))
{
	$aname = mysql_real_escape_string($_POST['txtUsername']);		
	$aname = trim($aname);
	
	$apass = mysql_real_escape_string($_POST['txtPassword']);		
	$apass = trim($apass);
	
	if($aname=="")	{
		$error = "Please provide username !";	
	}
	else if($apass=="")	{
		$error = "Please provide Password!";	
	}
	else{
	
		if($login->doLogin($aname,$apass))
		{
			$login->redirect('dashboard.php');
		}
		else
		{
			$error = "Incorrect Login Credentials, Please try again !";
		}	
	}
}
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login | ETPA</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark">

    <div class="container">
        <div class="card card-login mx-auto mt-5">
            <div class="card-header">Login</div>
            <div class="card-body">
                <form role="form" method="post">
                    <div class="form-group">
                       <label>Username: </label>
                        <input type="text" placeholder="Username" class="form-control" name="txtUsername" required />
                    </div>
                    <div class="form-group">
                       <label>Password: </label>
                        <input type="password" placeholder="Password" class="form-control" name="txtPassword" required />
                    </div>
                    <button type="submit" style="outline:none" class="btn btn-primary btn-block" name="btnLogin"><span class="fa fa-user"></span> Login</button>

                    <div id="msg" style="color:#F00; text-align:center;">
                        <?php
                            		if(isset($error) && $error!="")
									{
										echo $error;
									}
							?>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>