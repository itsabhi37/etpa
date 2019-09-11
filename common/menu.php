<?php
$page=basename($_SERVER['SCRIPT_NAME']);
?>
<!-- Sidebar -->
<ul class="sidebar navbar-nav d-print-none">
   <?php 
        if($page=='dashboard.php')
         {
            echo '<li class="nav-item active"><a class="nav-link" href="dashboard.php"><i class="fas fa-fw fa-tachometer-alt"></i><span> Dashboard</span></a></li>';
            echo '<li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-fw fa-folder"></i><span> Master</span></a><div class="dropdown-menu" aria-labelledby="pagesDropdown"><a class="dropdown-item" href="office.php"><i class="fas fa-fw fa-building"></i> Office</a><a class="dropdown-item" href="employee.php"><i class="fas fa-fw fa-users"></i> Employee</a></div></li>';
            echo '<li class="nav-item"><a class="nav-link" href="randomize.php"><i class="fas fa-fw fa-random"></i><span> Randomize Data</span></a></li>';
            echo '<li class="nav-item"><a class="nav-link" href="reports.php"><i class="fas fa-fw fa-chart-area"></i><span> Reports</span></a></li>';
            echo '<li class="nav-item"><a class="nav-link " href="logout.php?logout=true"><i class="fas fa-user-circle"></i><span> Logout</span></a></li>';
         }
        else if($page=='office.php')
         {
            echo '<li class="nav-item"><a class="nav-link" href="dashboard.php"><i class="fas fa-fw fa-tachometer-alt"></i><span> Dashboard</span></a></li>';
            echo '<li class="nav-item dropdown active"><a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-fw fa-folder"></i><span> Master</span></a><div class="dropdown-menu" aria-labelledby="pagesDropdown"><a class="dropdown-item active" href="office.php"><i class="fas fa-fw fa-building"></i> Office</a><a class="dropdown-item" href="employee.php"><i class="fas fa-fw fa-users"></i> Employee</a></div></li>';
            echo '<li class="nav-item"><a class="nav-link" href="randomize.php"><i class="fas fa-fw fa-random"></i><span> Randomize Data</span></a></li>';
            echo '<li class="nav-item"><a class="nav-link" href="reports.php"><i class="fas fa-fw fa-chart-area"></i><span> Reports</span></a></li>';
            echo '<li class="nav-item"><a class="nav-link " href="logout.php?logout=true"><i class="fas fa-user-circle"></i><span> Logout</span></a></li>';
         }
        else if($page=='randomize.php')
         {
            echo '<li class="nav-item"><a class="nav-link" href="dashboard.php"><i class="fas fa-fw fa-tachometer-alt"></i><span> Dashboard</span></a></li>';
            echo '<li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-fw fa-folder"></i><span> Master</span></a><div class="dropdown-menu" aria-labelledby="pagesDropdown"><a class="dropdown-item" href="office.php"><i class="fas fa-fw fa-building"></i> Office</a><a class="dropdown-item" href="employee.php"><i class="fas fa-fw fa-users"></i> Employee</a></div></li>';
            echo '<li class="nav-item active"><a class="nav-link" href="randomize.php"><i class="fas fa-fw fa-random"></i><span> Randomize Data</span></a></li>';
            echo '<li class="nav-item"><a class="nav-link" href="reports.php"><i class="fas fa-fw fa-chart-area"></i><span> Reports</span></a></li>';
            echo '<li class="nav-item"><a class="nav-link " href="logout.php?logout=true"><i class="fas fa-user-circle"></i><span> Logout</span></a></li>';
         }
        else if($page=='reports.php')
         {
            echo '<li class="nav-item"><a class="nav-link" href="dashboard.php"><i class="fas fa-fw fa-tachometer-alt"></i><span> Dashboard</span></a></li>';
            echo '<li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-fw fa-folder"></i><span> Master</span></a><div class="dropdown-menu" aria-labelledby="pagesDropdown"><a class="dropdown-item" href="office.php"><i class="fas fa-fw fa-building"></i> Office</a><a class="dropdown-item" href="employee.php"><i class="fas fa-fw fa-users"></i> Employee</a></div></li>';
            echo '<li class="nav-item"><a class="nav-link" href="randomize.php"><i class="fas fa-fw fa-random"></i><span> Randomize Data</span></a></li>';
            echo '<li class="nav-item active"><a class="nav-link" href="reports.php"><i class="fas fa-fw fa-chart-area"></i><span> Reports</span></a></li>';
            echo '<li class="nav-item"><a class="nav-link " href="logout.php?logout=true"><i class="fas fa-user-circle"></i><span> Logout</span></a></li>';
         }
        else if($page=='employee.php')
         {
            echo '<li class="nav-item"><a class="nav-link" href="dashboard.php"><i class="fas fa-fw fa-tachometer-alt"></i><span> Dashboard</span></a></li>';
            echo '<li class="nav-item dropdown active"><a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-fw fa-folder"></i><span> Master</span></a><div class="dropdown-menu" aria-labelledby="pagesDropdown"><a class="dropdown-item" href="office.php"><i class="fas fa-fw fa-building"></i> Office</a><a class="dropdown-item active" href="employee.php"><i class="fas fa-fw fa-users"></i> Employee</a></div></li>';
            echo '<li class="nav-item"><a class="nav-link" href="randomize.php"><i class="fas fa-fw fa-random"></i><span> Randomize Data</span></a></li>';
            echo '<li class="nav-item"><a class="nav-link" href="reports.php"><i class="fas fa-fw fa-chart-area"></i><span> Reports</span></a></li>';
            echo '<li class="nav-item"><a class="nav-link " href="logout.php?logout=true"><i class="fas fa-user-circle"></i><span> Logout</span></a></li>';
         }
        else
         {
            echo '<li class="nav-item"><a class="nav-link" href="dashboard.php"><i class="fas fa-fw fa-tachometer-alt"></i><span> Dashboard</span></a></li>';
            echo '<li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-fw fa-folder"></i><span> Master</span></a><div class="dropdown-menu" aria-labelledby="pagesDropdown"><a class="dropdown-item" href="office.php"><i class="fas fa-fw fa-building"></i> Office</a><a class="dropdown-item" href="employee.php"><i class="fas fa-fw fa-users"></i> Employee</a></div></li>';
            echo '<li class="nav-item"><a class="nav-link" href="randomize.php"><i class="fas fa-fw fa-random"></i><span> Randomize Data</span></a></li>';
            echo '<li class="nav-item"><a class="nav-link" href="reports.php"><i class="fas fa-fw fa-chart-area"></i><span> Reports</span></a></li>';
            echo '<li class="nav-item"><a class="nav-link " href="logout.php?logout=true"><i class="fas fa-user-circle"></i><span> Logout</span></a></li>';
         }
    ?>
    
    
    
    

    
</ul>