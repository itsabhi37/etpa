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
                    $office_id= mysql_real_escape_string($worksheet->getCellByColumnAndRow(0, $row)->getValue());
                    $office_name = mysql_real_escape_string($worksheet->getCellByColumnAndRow(1, $row)->getValue());
                    $block = mysql_real_escape_string($worksheet->getCellByColumnAndRow(2, $row)->getValue());
                    try {
                    $stmt = $auth_user->runQuery("INSERT into officedetails (office_id,office_name,block)values(:office_id,:office_name,:block)");
                    $stmt->execute(array(":office_id"=>$office_id,":office_name"=>$office_name,":block"=>$block));
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
            <li class="breadcrumb-item active">Master Office</li>
        </ol>

        <!-- Page Content -->
        <h4><i class="fas fa-fw fa-building"></i> Master Office</h4>
        <hr>
        <div class="row">
            <div class="card mb-3 ml-3 col-lg-5">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2 text-muted">New Office Import Section</h6>
                    <form method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <div class="custom-file">
                                <input type="file" name="excel" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" required>
                                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                            </div>
                        </div>
                        <button type="submit" name="import" class="btn btn-success mt-3 rounded-0"><i class="fas fa-fw fa-upload"></i> Upload</button>
                        <a href="office.php" class="btn btn-danger mt-3 rounded-0"><i class="fas fa-fw fa-times"></i> Cancel</a>
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
                        <a href="sample/Master_Office_Sample.xlsx" class="btn btn-info rounded-0"><i class="fas fa-fw fa-download"></i> Download</a>
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
                Office Details</div>
            <div class="card-body">
                <div class="table-responsive">
                    <div class="btn-group float-right ml-1" role="group">
                        <button class="btn btn-primary btn-sm dropdown-toggle rounded-0" id="btnGroupDrop4" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Export"><i class="fa fa-file-export"></i></button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#" onclick="exportTableAs('exportopdf','xls','Office Details');"><b><i class="fa fa-file-excel"></i></b> XLS</a>
                            <a class="dropdown-item" href="#" onclick="exportTableAs('exportopdf','pdf','Office Details');"><b><i class="fa fa-file-pdf"></i></b> PDF</a>
                        </div>
                    </div>
                    <div class="float-right ml-3" role="group">
                        <a href="#" data-href="delete.php?del_ofc_id=1" class="btn btn-danger btn-sm rounded-0" data-toggle="modal" title="Delete" data-target="#myModal"><i class="fa fa-trash"></i></a>
                    </div>
                    <table class="table table-bordered exportopdf dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Sl. No.</th>
                                <th>Office Name</th>
                                <th>Block</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $stmt = $auth_user->runQuery("SELECT office_id,office_name,block FROM officedetails");
                                $stmt->execute();
                                $num_rows = 0;
                                while ($userRow = $stmt->fetch(PDO::FETCH_ASSOC))
                                {
                                    $num_rows++;
                                    $id = $userRow['office_id'];
                                    $office_name = $userRow['office_name'];
                                    $block = $userRow['block'];
                            ?>
                            <tr>
                                <td><?php echo $num_rows; ?></td>
                                <td><?php echo $office_name; ?></td>
                                <td><?php echo $block; ?></td>
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