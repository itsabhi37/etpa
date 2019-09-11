<?php
//Include Commnon Header Part
require_once("common/header.php");
require_once("common/menu.php");
require_once("common/session.php");	
require_once("common/class.user.php");

$auth_user = new USER();

if(isset($_POST['randomize']))
{
    $office_id=0;
    $employee_id=0;
    $home_block='';
    $posting_block='';
    $employee_block='';
    
    if (isset($_POST['homeBlock'])) {
        $home_block='checked';
        $_SESSION["homeBlock"] = "checked" ;
    }else{
        $_SESSION["homeBlock"] = "" ;
    }
    
    if (isset($_POST['postingBlock'])) {
        $posting_block='checked';
        $_SESSION["postingBlock"] = "checked" ;
    }else{
        $_SESSION["postingBlock"] = "" ;
    }
    
    $stmt = $auth_user->runQuery("SELECT count(office_id)as office_id FROM officedetails");
    $stmt->execute();
    while ($userRow = $stmt->fetch(PDO::FETCH_ASSOC))
    {
        $office_count = $userRow['office_id']; // Total Office Count
    }
    
    for($i=1;$i<=$office_count;$i++){
        if($i<=0){
            // If you replace 0 to any no. then from 1 to that no. of office must select an employee
            // Fetch Employee Id Randomly
            
            $stmt = $auth_user->runQuery("SELECT *FROM employeedetails WHERE employee_id NOT IN (SELECT employee_id FROM randomization) order by RAND() LIMIT 1");
            $stmt->execute();
            while ($userRow = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                $employee_id = $userRow['employee_id']; 
            }
            // Insert Randomized data in Randomization Table
            
            $stmt = $auth_user->runQuery("INSERT into randomization (office_id,employee_id)values(:office_id,:employee_id)");
            $stmt->execute(array(":office_id"=>$i,":employee_id"=>$employee_id));
                    
        }
        else{
            
            // Fetch Office Id Randomly
            $stmt = $auth_user->runQuery("SELECT *FROM officedetails WHERE office_id NOT IN (SELECT office_id FROM randomization) order by RAND() LIMIT 1");
            $stmt->execute();
            while ($userRow = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                $office_id = $userRow['office_id']; 
                $office_block=$userRow['block']; 
            }
            
            // Fetch Employee Id Randomly
            if($home_block=='checked' && $posting_block!='checked'){
                // If Home block checkbox is checked then Home Block & Office Block will be NOT SAME
                $stmt = $auth_user->runQuery("SELECT *FROM employeedetails WHERE employee_id NOT IN (SELECT employee_id FROM randomization) AND homeblock!=:office_block order by RAND() LIMIT 1");
                $stmt->execute(array(":office_block"=>$office_block)); 
                while ($userRow = $stmt->fetch(PDO::FETCH_ASSOC))
                {
                $employee_id = $userRow['employee_id']; 
                }
            }
            else if($home_block!='checked' && $posting_block=='checked'){
                // If Posting block checkbox is checked then Posting Block & Office Block Will be NOT SAME
                $stmt = $auth_user->runQuery("SELECT *FROM employeedetails WHERE employee_id NOT IN (SELECT employee_id FROM randomization) AND postingblock!=:office_block order by RAND() LIMIT 1");
                $stmt->execute(array(":office_block"=>$office_block)); 
                while ($userRow = $stmt->fetch(PDO::FETCH_ASSOC))
                {
                $employee_id = $userRow['employee_id']; 
                }
            }
            else if($home_block=='checked' && $posting_block=='checked'){
                // If Home Block & Posting block both checkboxe are checked then Home Block, Posting Block will be not same like Office Block
                $stmt = $auth_user->runQuery("SELECT *FROM employeedetails WHERE employee_id NOT IN (SELECT employee_id FROM randomization) AND homeblock!=:office_block AND postingblock!=:office_block order by RAND() LIMIT 1");
                $stmt->execute(array(":office_block"=>$office_block)); 
                while ($userRow = $stmt->fetch(PDO::FETCH_ASSOC))
                {
                $employee_id = $userRow['employee_id']; 
                }
            }
            else{
                $stmt = $auth_user->runQuery("SELECT *FROM employeedetails WHERE employee_id NOT IN (SELECT employee_id FROM randomization) order by RAND() LIMIT 1");
                $stmt->execute();  
                while ($userRow = $stmt->fetch(PDO::FETCH_ASSOC))
                {
                $employee_id = $userRow['employee_id']; 
                }
            }
            
            // Insert Randomized data in Randomization Table
            if($employee_id!='' && $office_id!=''){
            $stmt = $auth_user->runQuery("INSERT into randomization (office_id,employee_id)values(:office_id,:employee_id)");
            $stmt->execute(array(":office_id"=>$office_id,":employee_id"=>$employee_id));
            }
            $employee_id='';
            $office_id='';
        }
    }   
        ?>
        <script type="text/javascript">
		alert("Randomization has been done Successfully...!");
		window.location.href = "randomize#step-3";
		</script>
		<?php    
}
?>
<!-- Include SmartWizard CSS -->
<link href="css/smart_wizard.css" rel="stylesheet" type="text/css" />

<!-- Optional SmartWizard theme -->
<link href="css/smart_wizard_theme_arrows.css" rel="stylesheet" type="text/css" />

<div id="content-wrapper">
    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="dashboard.php"><i class="fas fa-fw fa-tachometer-alt"></i> Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Randomize Data</li>
        </ol>

        <!-- Page Content -->
        <h4><i class="fas fa-fw fa-random"></i> Randomize Data</h4>
        <hr>
        <div class="card mb-3">

            <!-- SmartWizard html -->
            <div id="smartwizard">
                <ul>
                    <li><a href="#step-1">Step 1<br /><small>Office Details </small></a></li>
                    <li><a href="#step-2">Step 2<br /><small>Employee Details</small></a></li>
                    <li><a href="#step-3">Step 3<br /><small>Randomize Data</small></a></li>
                </ul>

                <div>
                  
                   <!--Office Details-->
                    <div id="step-1">
                       
                        <!-- Office Details Table -->
                        <div class="card mt-3">
                            <div class="card-header">
                                <i class="fas fa-table"></i>
                                Office Details</div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <div class="btn-group float-right ml-3" role="group">
                                        <button class="btn btn-primary btn-sm dropdown-toggle rounded-0" id="btnGroupDrop4" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Export"><i class="fa fa-file-export"></i> </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#" onclick="exportTableAs('exportopdf','xls','Office Details');"><b><i class="fa fa-file-excel"></i></b> XLS</a>
                                            <a class="dropdown-item" href="#" onclick="exportTableAs('exportopdf','pdf','Office Details');"><b><i class="fa fa-file-pdf"></i></b> PDF</a>
                                        </div>
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
                    
                    <!--Employee Details-->
                    <div id="step-2">
                        <!-- Employee Details Table -->
                        <div class="card mt-3">
                            <div class="card-header">
                                <i class="fas fa-table"></i>
                                Employee Details</div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <div class="btn-group float-right ml-3" role="group">
                                        <button class="btn btn-primary btn-sm dropdown-toggle rounded-0" id="btnGroupDrop4" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Export"><i class="fa fa-file-export"></i></button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#" onclick="exportTableAs('exportopdf','xls','Employee Details');"><b><i class="fa fa-file-excel"></i></b> XLS</a>
                                            <a class="dropdown-item" href="#" onclick="exportTableAs('exportopdf','pdf','Employee Details');"><b><i class="fa fa-file-pdf"></i></b> PDF</a>
                                        </div>
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
                    
                    <div id="step-3" class="text-center">
                       <form method="post">
                       
                       <?php
                            $total_required_data='';
                            $ran_data_required='';
                            $randomized_data_count = $auth_user->getCount("SELECT count(office_id)as office_id FROM randomization","office_id");
                            
                            $is_employee_zero = $auth_user->getCount("SELECT count(employee_id)as employee_id FROM employeedetails","employee_id");
                            $is_office_zero = $auth_user->getCount("SELECT count(office_id)as office_id FROM officedetails","office_id");
                           
                            if($randomized_data_count>0){
                                
                                if($is_office_zero < $is_employee_zero){
                                    // If Office Count is less than Employee Count
                                    $total_required_data=$is_office_zero;
                                }
                                else if($is_office_zero > $is_employee_zero){
                                    // If Office Count is greater than Employee Count
                                    $total_required_data=$is_employee_zero;
                                }
                                else if($is_office_zero == $is_employee_zero){
                                    // If Office Count is euqal to Employee Count
                                    $total_required_data=$is_employee_zero;
                                }
                                
                                if($randomized_data_count!=$total_required_data){
                                    // If Required randomized data is less then the required total data then it shows message to 
                                    // delete the randomized data and randomize again, after exemption of some rules like Home Block & Posting Block.
                                    $more_randomized_data=$total_required_data-$randomized_data_count;
                                    echo '<div class="offset-md-4">';
                                    echo '<table class="table-bordered mt-3" width="350px">';
                                    echo '<tr class="text-info"><td style="text-align:right;">Randomized Data Required :&nbsp;</td><td width="50px">'.$total_required_data.'</td></tr>';
                                    echo '<tr class="text-info"><td style="text-align:right;">Randomized Data We have :&nbsp;</td><td>'.$randomized_data_count.'</td></tr>';
                                    echo '<tr class="text-info"><td style="text-align:right;">More Randomized Data We needed :&nbsp;</td><td>'.$more_randomized_data.'</td></tr>';
                                    echo '</table>';
                                    echo '</div>';
                                    
                                    echo '<div class="offset-md-5">';
                                    echo '<table class="table-bordered mt-3" width="200px">';
                                    echo '<tr class="text-info"><td colspan="2" style="text-align:centre;">Rules &nbsp;</td></tr>';
                                    
                                    if($_SESSION["homeBlock"]=="checked"){
                                        echo '<tr class="text-info"><td style="text-align:right;">Home Block :&nbsp;</td><td width="50px"><i class="fa fa-check"></i></td></tr>';
                                    }else{ 
                                        echo '<tr class="text-info"><td style="text-align:right;">Home Block :&nbsp;</td><td width="50px"><i class="fas fa-fw fa-times"></i></td></tr>';
                                    }
                                    
                                    if($_SESSION["postingBlock"]=="checked"){
                                        echo '<tr class="text-info"><td style="text-align:right;">Posting Block :&nbsp;</td><td width="50px"><i class="fa fa-check"></i></td></tr>';
                                    }else{ 
                                        echo '<tr class="text-info"><td style="text-align:right;">Posting Block :&nbsp;</td><td width="50px"><i class="fas fa-fw fa-times"></i></td></tr>';
                                    }
                                    echo '</table>';
                                    echo '</div>';
                                    
                                    echo '<p class="text-danger mt-2"> <strong>Note:</strong> Delete Inital Randomized data, exempt some rules and then Re-Randomized data.</p>';
                                    
                                    echo '<a href="#" data-href="delete.php?del_rand_id=1" class="mt-2 btn  btn-primary rounded-0" data-toggle="modal" title="Delete" data-target="#myModal"><i class="fa fa-trash"></i> Delete Randomize Data</a>';
                                }
                                echo '<a href="reports.php" class="btn btn-success ml-1 mt-2 rounded-0"><i class="fas fa-fw fa-chart-area"></i> View Report</a>';
                            }
                           else{
                               if($is_office_zero>0 && $is_employee_zero>0){
                                   ?>
                                   <div class="form-check mt-2">
                                    <input type="checkbox" name="homeBlock" class="form-check-input" id="homeBlock">
                                    <label class="form-check-label text-danger mr-4 " for="homeBlock">Home Block</label>
                                    <input type="checkbox" name="postingBlock" class="form-check-input" id="postingBlock">
                                    <label class="form-check-label text-danger" for="postingBlock">Posting Block </label>
                                  </div>
                                   <?php
                                    echo '<button type="submit" name="randomize" class="mt-2 btn  btn-success rounded-0"><i class="fas fa-fw fa-random"></i> Randomize Data</button>';
                               }
                           }
                        ?>
                        <a href="randomize.php" class="btn btn-danger mt-2 rounded-0"><i class="fas fa-fw fa-times"></i> Cancel</a>
                        
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <!-- /.container-fluid -->
    <?php require_once("common/deletemodal.php"); ?>
    <?php require_once("common/footer.php"); ?>
    <!-- Include SmartWizard JavaScript source -->
    <script type="text/javascript" src="js/jquery.smartWizard.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            // Smart Wizard
            $('#smartwizard').smartWizard({
                selected: 0,
                theme: 'arrows',
                transitionEffect: 'fade'
            });
        });
    </script>