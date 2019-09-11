<?php
//Include Commnon Header Part
require_once("common/header.php");
require_once("common/menu.php");
require_once("common/session.php");	
require_once("common/class.user.php");

$auth_user = new USER();

if(isset($_POST["import"]))
{
    $extension = end(explode(".", $_FILES["excel"]["name"])); // For getting Extension of selected file
    $allowed_extension = array("xls", "xlsx", "csv"); //allowed extension
        if(in_array($extension, $allowed_extension)) //check selected file extension is present in allowed extension array
        {
        $file = $_FILES["excel"]["tmp_name"]; // getting temporary source of excel file
        include("PHPExcel/IOFactory.php"); // Add PHPExcel Library in this code
        $objPHPExcel = PHPExcel_IOFactory::load($file); // create object of PHPExcel library by using load() method and in load method define path of selected file

         foreach ($objPHPExcel->getWorksheetIterator() as $worksheet)
            {
                $highestRow = $worksheet->getHighestRow();
                for($row=2; $row<=$highestRow; $row++)
                {
                    $employee_id= mysql_real_escape_string($worksheet->getCellByColumnAndRow(0, $row)->getValue());
                    $employee_name = mysql_real_escape_string($worksheet->getCellByColumnAndRow(1, $row)->getValue());
                    $father_name = mysql_real_escape_string($worksheet->getCellByColumnAndRow(2, $row)->getValue());
                    $qualification = mysql_real_escape_string($worksheet->getCellByColumnAndRow(3, $row)->getValue());
                    $homeblock = mysql_real_escape_string($worksheet->getCellByColumnAndRow(4, $row)->getValue());
                    $postingblock = mysql_real_escape_string($worksheet->getCellByColumnAndRow(5, $row)->getValue());
                    $mobile = mysql_real_escape_string($worksheet->getCellByColumnAndRow(6, $row)->getValue());
                    try {
                    $stmt = $auth_user->runQuery("INSERT into employeedetails (employee_id,employee_name,father_name,qualification,homeblock,postingblock,mobile)values(:employee_id,:employee_name,:father_name,:qualification,:homeblock,:postingblock,:mobile)");
                    $stmt->execute(array(":employee_id"=>$employee_id,":employee_name"=>$employee_name,":father_name"=>$father_name,":qualification"=>$qualification,":homeblock"=>$homeblock,":postingblock"=>$postingblock,":mobile"=>$mobile));
                    }catch (PDOException $e) {
                      $error = "Something went wrong.<br>".$e->getMessage();
                    }
                }
            } 
        }
        else{
            $error = "Invalid File Selected, Please select Excel File only!"; //if non excel file then
        }
}
?>
<div id="content-wrapper">
    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="dashboard.php"><i class="fas fa-fw fa-tachometer-alt"></i> Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Master Employee</li>
        </ol>

        <!-- Page Content -->
        <h4><i class="fas fa-fw fa-users"></i> Master Employee</h4>
        <hr>
        <div class="row">
            <div class="card mb-3 ml-3 col-lg-5">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2 text-muted">New Employee Import Section</h6>
                    <form method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <div class="custom-file">
                                <input type="file" name="excel" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" required>
                                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                            </div>
                        </div>
                        <button type="submit" name="import" class="btn btn-success mt-3 rounded-0"><i class="fas fa-fw fa-upload"></i> Upload</button>
                        <a href="employee.php" class="btn btn-danger mt-3 rounded-0"><i class="fas fa-fw fa-times"></i> Cancel</a>
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

            <div class="card mb-3 ml-4 col-lg-4">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2 text-muted">Download Excel Format</h6>
                    <div class="text-center mt-4">
                        <a href="sample/Master_Employee_Sample.xlsx" class="btn btn-info rounded-0"><i class="fas fa-fw fa-download"></i> Download</a>
                    </div>
                </div>
                <div class="text-center mb-4"><small class="text-center text-danger">Please don't alter or modify any field in downloaded excel file.</small>
                </div>
            </div>

        </div>
        <!-- DataTables Example -->
        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-table"></i>
                Employee Details</div>
            <div class="card-body">
                <div class="table-responsive">
                    <div class="btn-group float-right ml-1" role="group">
                        <button class="btn btn-primary btn-sm dropdown-toggle rounded-0" id="btnGroupDrop4" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Export"><i class="fa fa-file-export"></i></button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#" onclick="exportTableAs('exportopdf','xls','Employee Details');"><b><i class="fa fa-file-excel"></i></b> XLS</a>
                            <a class="dropdown-item" href="#" onclick="exportTableAs('exportopdf','pdf','Employee Details');"><b><i class="fa fa-file-pdf"></i></b> PDF</a>
                        </div>
                    </div>
                    <div class="float-right ml-3" role="group">
                        <a href="#" data-href="delete.php?del_emp_id=1" class="btn btn-danger btn-sm rounded-0" data-toggle="modal" title="Delete" data-target="#myModal"><i class="fa fa-trash"></i></a>
                    </div>
                    <table class="table table-bordered exportopdf dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Sl. No.</th>
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
                                $stmt = $auth_user->runQuery("SELECT employee_id, employee_name, father_name, qualification,homeblock,postingblock, mobile FROM employeedetails");
                                $stmt->execute();
                                $num_rows = 0;
                                while ($userRow = $stmt->fetch(PDO::FETCH_ASSOC))
                                {
                                    $num_rows++;
                                    $employee_id = $userRow['employee_id'];
                                    $employee_name = $userRow['employee_name'];
                                    $father_name = $userRow['father_name'];
                                    $qualification = $userRow['qualification'];
                                    $homeblock = $userRow['homeblock'];
                                    $postingblock = $userRow['postingblock'];
                                    $mobile = $userRow['mobile'];
                            ?>
                            <tr>
                                <td><?php echo $num_rows; ?></td>
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