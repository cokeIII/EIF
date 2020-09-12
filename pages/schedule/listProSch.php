
<?php 
    require_once "../conf.php";
    require_once "../connect.php";
    
    $busi_id = $_SESSION["id"];
    $branch_no = $_SESSION["branch_no"];
    if(isset($_SESSION["status"])){
        if($_SESSION["status"] == "admin"){
            $sql = "select project_id,project_name,pro_status,branch_no,busi_id,persons from project where pro_status = 'ผ่านการอนุมัติ'";
        } else if($_SESSION["status"] == "user") {
            $sql = "select project_id,project_name,pro_status,branch_no,busi_id,persons from project where busi_id = '$busi_id' and branch_no = '$branch_no' and pro_status = 'ผ่านการอนุมัติ'";
        }
    } 
    $result = $conn->query($sql);
    $jsonData = "";
$jsonData.=
'<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0 text-dark">ตารางเวลา</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active">ตารางเวลา</li>
        </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<section class="content">
    <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <!-- /.row -->
    <!-- Main row -->
        <div class="row ">
            <div class="col-md-12">
                <div class="card" id="formProjects">
                    <div class="card-body">
                        <table class="table table-bordered hover projects" id="tableSchedule">
                            <thead>
                                <tr>
                                    <th style="width: 1%">
                                        ลำดับ
                                    </th>
                                    <th style="width: 13%">
                                        ชื่อโครงการ
                                    </th>
                                    <th style="width: 15%">
                                        ผู้รับผิดชอบ
                                    </th>
                                    <th style="width: 10%">
                                    </th>
                                </tr>
                            </thead>
                            <tbody>';

                            if ($result->num_rows > 0) {
                                $no = 0;
                                while($row = $result->fetch_assoc()) {

                                $jsonData.='<tr>
                                    <td>
                                        '.(++$no).'
                                    </td>
                                    <td class="pro-name">
                                        '.$row["project_name"].'
                                    </td>
                                    <td>';
                                       
                                        $someArray = json_decode($row["persons"], true);
                                        foreach ($someArray as $key => $value) {
                                            $jsonData.='<p>'.$value["perName"].'</p>';
                                        }
                                       
                                    $jsonData.='</td>
                                    <td class="project-actions text-center">';
                                        if(isset($_SESSION["status"]) && $_SESSION["status"]!="admin"){
                                            $jsonData.='<a class="btn btn-warning btn-sm btn-schedule mt-3" href="#"   proName="'.$row["project_name"].'" proId="'.$row["project_id"].'">
                                                <i class="fas fa-calendar-check">
                                                </i>
                                                กำหนดตารางเวลา
                                            </a>';
                                        }
                                    '
                                    </td>
                                </tr>
                            ';
                             } 
                            }
                            $jsonData.='
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>';
echo json_encode($jsonData);