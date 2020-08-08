<?php 
    require_once "../conf.php";
    require_once "../connect.php";
    if(isset($_POST["status"])){
        $status = $_POST["status"];
        $sql = "select project_id,project_name,pro_status,branch_no,busi_id,persons from project where pro_status = '$status'";
    } else {
        $sql = "select project_id,project_name,pro_status,branch_no,busi_id,persons from project";
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
                        <table class="table table-bordered hover projects" id="infoAllTablePrePro">
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