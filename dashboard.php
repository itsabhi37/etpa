<?php
//Include Commnon Header Part
require_once("common/header.php");
require_once("common/menu.php");
require_once("common/session.php");	
require_once("common/class.user.php");

$auth_user = new USER();
?>
<div id="content-wrapper">

    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#"><i class="fas fa-fw fa-tachometer-alt"></i> Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Overview</li>
        </ol>

        <!-- Icon Cards-->
        <div class="row">
            <div class="col-xl-3 col-sm-6 mb-3">
                <div class="card text-white bg-primary o-hidden h-100">
                    <div class="card-body">
                        <div class="card-body-icon">
                              <i class="fas fa-fw fa-building"></i>
                        </div>
                        <div class="mr-5">
                           <?php
                                $stmt = $auth_user->runQuery("SELECT count(office_id)as office_id FROM officedetails");
                                $stmt->execute();
                                while ($userRow = $stmt->fetch(PDO::FETCH_ASSOC))
                                {
                                    echo 'Total Offices - '. $office_count = $userRow['office_id']; // Total Office Count
                                }
                            ?>                            
                        </div>
                    </div>
                    <a class="card-footer text-white clearfix small z-1" href="office.php">
                        <span class="float-left">View Details</span>
                        <span class="float-right">
                            <i class="fas fa-angle-right"></i>
                        </span>
                    </a>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
                <div class="card text-white bg-warning o-hidden h-100">
                    <div class="card-body">
                        <div class="card-body-icon">
                            <i class="fas fa-fw fa-users"></i>
                        </div>
                        <div class="mr-5">
                            <?php
                                $stmt = $auth_user->runQuery("SELECT count(employee_id)as employee_id FROM employeedetails");
                                $stmt->execute();
                                while ($userRow = $stmt->fetch(PDO::FETCH_ASSOC))
                                {
                                    echo 'Total Employee - '. $employee_count = $userRow['employee_id']; // Total Office Count
                                }
                            ?>
                        </div>
                    </div>
                    <a class="card-footer text-white clearfix small z-1" href="employee.php">
                        <span class="float-left">View Details</span>
                        <span class="float-right">
                            <i class="fas fa-angle-right"></i>
                        </span>
                    </a>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
                <div class="card text-white bg-success o-hidden h-100">
                    <div class="card-body">
                        <div class="card-body-icon">
                            <i class="fas fa-fw fa-shopping-cart"></i>
                        </div>
                        <div class="mr-5">Coming Soon</div>
                    </div>
                    <a class="card-footer text-white clearfix small z-1" href="#">
                        <span class="float-left">View Details</span>
                        <span class="float-right">
                            <i class="fas fa-angle-right"></i>
                        </span>
                    </a>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
                <div class="card text-white bg-danger o-hidden h-100">
                    <div class="card-body">
                        <div class="card-body-icon">
                            <i class="fas fa-fw fa-life-ring"></i>
                        </div>
                        <div class="mr-5">Coming Soon</div>
                    </div>
                    <a class="card-footer text-white clearfix small z-1" href="#">
                        <span class="float-left">View Details</span>
                        <span class="float-right">
                            <i class="fas fa-angle-right"></i>
                        </span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Area Chart Example-->
        <!--<div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-chart-area"></i>
                Area Chart Example</div>
            <div class="card-body">
                <canvas id="myAreaChart" width="100%" height="30"></canvas>
            </div>
            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
        </div>-->
    </div>
    <!-- /.container-fluid -->
    
    <!-- Charts plugin JavaScript-->
        <!--<script src="vendor/chart.js/Chart.min.js"></script>
        <script src="js/demo/chart-area-demo.js"></script>-->
        
<?php require_once("common/footer.php"); ?>