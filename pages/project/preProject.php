<?php 
    require_once "../conf.php";
    require_once "../connect.php";
    
    $busi_id = $_SESSION["id"];
    $branch_no = $_SESSION["branch_no"];
    if(isset($_SESSION["status"])){
        if($_SESSION["status"] == "admin"){
            $sql = "select project_id,project_name,pro_status,branch_no,busi_id,persons from project";
        } else if($_SESSION["status"] == "user") {
            $sql = "select project_id,project_name,pro_status,branch_no,busi_id,persons from project where busi_id = '$busi_id' and branch_no = '$branch_no'";
        }
    } 
    $result = $conn->query($sql);
$jsonData =  "" ;

$jsonData.='<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0 text-dark">โครงการที่เสนอ</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active">โครงการ</li>
        </ol>
        </div>
    </div>
    </div>
</div>
<section class="content">
    <div class="container-fluid">
        <div class="row ">
            <div class="col-md-12">
                <div class="card" id="formProjects">
                    <div class="card-body">
                        <table class="table table-bordered hover projects" id="tablePrePro">
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
                                    <th style="width: 8%" class="text-center">
                                        สถานะ
                                    </th>
                                    <th style="width: 25%">
                                    </th>
                                </tr>
                            </thead>
                            <tbody>';
                            
                            if ($result->num_rows > 0) {
                                $no = 0;
                                while($row = $result->fetch_assoc()) {
                            
                                $jsonData.='<tr>
                                    <td>
                                        '.++$no.'
                                    </td>
                                    <td>
                                        '.$row["project_name"].'
                                    </td>
                                    <td>';
                                        
                                        $someArray = json_decode($row["persons"], true);
                                        foreach ($someArray as $key => $value) {
                                            $jsonData.='<p>'.$value["perName"].'</p>';
                                        }
                                    $jsonData.='
                                    </td>
                                    <td class="project-state">';
                                        
                                            $classStatus = "";
                                            if($row["pro_status"] == "ผ่านการอนุมัติ" || $row["pro_status"] == "ดำเนินงานแล้วเสร็จ"){
                                                $classStatus = "badge-success";
                                            } else if($row["pro_status"] == "รอการอนุมัติ"){
                                                $classStatus = "badge-warning";
                                            } else if($row["pro_status"] == "ไม่ผ่านการอนุมัติ"){
                                                $classStatus = "badge-danger";
                                            } else if($row["pro_status"] == "ขั้นดำเนินกิจกรรม"){
                                                $classStatus = "badge-info";
                                            }
                                $jsonData.='
                                        <span class="badge '.$classStatus.'">'.$row["pro_status"].'</span>
                                    </td>
                                    <td class="project-actions text-right">
                                        <div class="row">
                                            <a class="ml-3 btn btn-primary btn-sm viewProject" href="#"  val="'.$row["project_id"].'">
                                                <i class="fas fa-folder">
                                                </i>
                                                รายละเอียด
                                            </a>';
                                            if(isset($_SESSION["status"]) && $_SESSION["status"] == "admin"){
                                                if($row["pro_status"] == "รอการอนุมัติ") {
                                                $jsonData.='
                                                <a class="ml-3 btn btn-success btn-sm approve" href="#"  val="'.$row["project_id"].'">
                                                    <i class="fas fa-check">
                                                    </i>
                                                    อนุมัติ
                                                </a>
                                                <a class="ml-3 btn btn-danger btn-sm disApprove" href="#"  val="'.$row["project_id"].'">
                                                    <i class="fas fa-check">
                                                    </i>
                                                    ไม่อนุมัติ
                                                </a>';
                                            
                                                } else if($row["pro_status"] == "ไม่ผ่านการอนุมัติ") {
                                                    $jsonData.='<a class="ml-3 btn btn-success btn-sm approve" href="#"  val="'.$row["project_id"].'">
                                                        <i class="fas fa-check">
                                                        </i>
                                                        อนุมัติ
                                                    </a>';
                                                }
                                            }
                                        $jsonData.='</div>
                                        <div class="row">';
                                            if(isset($_SESSION["status"]) && $_SESSION["status"] == "admin" || $row["pro_status"] == "รอการอนุมัติ" || $row["pro_status"] == "ไม่ผ่านการอนุมัติ"){
                                            $jsonData.='<a class="ml-3 mt-3 btn btn-info btn-sm edit-project" val="'.$row["project_id"].'">
                                                <i class="fas fa-pencil-alt">
                                                </i>
                                                แก้ไข
                                            </a>
                                            <a class="ml-3 mt-3 btn btn-danger btn-sm btn-delProject" val="'.$row["project_id"].'">
                                                <i class="fas fa-trash">
                                                </i>
                                                ลบ
                                            </a>';
                                             }
                                        $jsonData.='</div>
                                    </td>
                                </tr>';
                                } 
                            }
                            $jsonData.='</tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>';
echo json_encode($jsonData);