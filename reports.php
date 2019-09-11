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
        <ol class="breadcrumb d-print-none">
            <li class="breadcrumb-item">
                <a href="dashboard.php"><i class="fas fa-fw fa-tachometer-alt"></i> Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Reports</li>
        </ol>

        <!-- Page Content -->
        <h4><i class="fas fa-fw fa-chart-area"></i><span> Reports</h4>
        <hr>
        
        <!-- DataTables Example -->
        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-table"></i>
                Randomised Data List</div>
            <div class="card-body">
                <div class="table-responsive">
                    <div class="btn-group float-right ml-1 d-print-none" role="group">
                        <button class="btn btn-primary btn-sm dropdown-toggle rounded-0" id="btnGroupDrop4" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Export"><i class="fa fa-file-export"></i></button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#" onclick="exportTableAs('exportopdf','xls','Randomised Reports');"><b><i class="fa fa-file-excel"></i></b> XLS</a>
							<a class="dropdown-item" href="#" onclick="exportTableAs('exportopdf','pdf','Randomised Reports');"><b><i class="fa fa-file-pdf"></i></b> PDF</a>
						</div>
                       <button id="btnPrint" class="btn btn-sm btn-info d-print-none ml-1" title="Print"><i class="fa fa-print"></i></button>
                    </div>
                    <div class="float-right ml-3" role="group">
                        <a href="#" data-href="delete.php?del_rand_id=1" class="btn btn-danger btn-sm rounded-0" data-toggle="modal" title="Delete" data-target="#myModal"><i class="fa fa-trash"></i></a>
                    </div>
                    <table class="table table-bordered exportopdf dataTable" id="printThis" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Sl. No.</th>
                                <th>Office Name</th>
                                <th>Block</th>
                                <th>Employee Name</th>
                                <th>Father Name</th>
                                <th>Qualification</th>
                                <th>Home Block</th>
                                <th>Posting Block</th>
                                <th>Mobile</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            
                                $stmt = $auth_user->runQuery("SELECT o.office_name,o.block,e.employee_name,e.father_name,e.qualification,e.homeblock,e.postingblock,e.mobile FROM officedetails o,employeedetails e, randomization r WHERE e.employee_id=r.employee_id AND o.office_id=r.office_id");
                                $stmt->execute();
                                $num_rows = 0;
                                while ($userRow = $stmt->fetch(PDO::FETCH_ASSOC))
                                {
                                    $num_rows++;
                                    $office_name = $userRow['office_name'];
                                    $block = $userRow['block'];
                                    $employee_name = $userRow['employee_name'];
                                    $father_name = $userRow['father_name'];
                                    $qualification = $userRow['qualification'];
                                    $homeblock = $userRow['homeblock'];
                                    $postingblock = $userRow['postingblock'];
                                    $mobile = $userRow['mobile'];
                            ?>
                            <tr>
                                <td><?php echo $num_rows; ?></td>
                                <td><?php echo $office_name; ?></td>
                                <td><?php echo $block; ?></td>
                                <td><?php echo $employee_name; ?></td>
                                <td><?php echo $father_name; ?></td>
                                <td><?php echo $qualification; ?></td>
                                <td><?php echo $homeblock; ?></td>
                                <td><?php echo $postingblock; ?></td>
                                <td><?php echo $mobile; ?></td>
                            </tr>
                            <?php
                                }
                            echo "</tbody>";
                            echo "</table>";
                            ?>
                </div>
                </div>
        </div>
    </div>
    <!-- /.container-fluid -->
    <?php require_once("common/deletemodal.php"); ?>
    <?php require_once("common/footer.php"); ?>  