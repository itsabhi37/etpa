<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
<?php $page=basename($_SERVER['SCRIPT_NAME']); 
    if($page=='dashboard.php')
    {
        echo '<title> Dashboard | ETPA</title>';
    }
    else if($page=='office.php')
    {
        echo '<title> Master Office | ETPA</title>';
    }
    else if($page=='employee.php')
    {
        echo '<title> Master Employee | ETPA</title>';
    }
    else if($page=='randomize.php')
    {
        echo '<title> Randomize Data | ETPA</title>';
    }
    else if($page=='reports.php')
    {
        echo '<title> Reports | ETPA</title>';
    }
    else
    {
        echo '<title> ETPA </title>';
    }
?>
    

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body id="page-top">

    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

        <a class="navbar-brand mr-1" href="index.html">ETPA</a>

        <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
            <i class="fas fa-bars"></i>
        </button>

    </nav>

    <div id="wrapper">