<?php
require_once "../conf.php";
require_once "../connect.php";
$month = date("n");
$Y =  date("Y");
$Yselect =  date("Y");
$id = $_POST["project_id"];
$yearQuarter = ceil($month / 3);
$status = "สรุปโครงการ";
if(isset($_POST["qua_select"])){
    $yearQuarter = $_POST["qua_select"];
}
if(isset($_POST["Y_select"])){
    $Y = $_POST["Y_select"];
}
if(isset($_POST["status_select"])){
    $status = $_POST["status_select"];
}
$sql = "select 
project_id,
project_name,
maingoal,
budget,
persons
from project
where project_id  = '$id'
";
$sqlProgress = "select * from quarter_progress where project_id  = '$id' and quater = '$yearQuarter' and quater_year = '$Y'";
$sqlQua = "select * from quarter_project where project_id  = '$id' and quater = '$yearQuarter' and YEAR(qua_date) = '$Y'";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
}


$resultQua = $conn->query($sqlQua);

$resultProgress = $conn->query($sqlProgress);
if ($resultProgress->num_rows > 0) {
    $rowProgress = $resultProgress->fetch_assoc();
}

$jsonData = "";
$jsonData.= '<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-8">
        <h1 class="m-0 text-dark">สรุปรายงานโครงการ</h1>
        </div><!-- /.col -->
        <div class="col-sm-4">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active">รายงาน</li>
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
                        <div class="row">
                            <div class="col-md-5">
                                <div><b>ชื่อโครงการ : </b> '.$row["project_name"].'</div>
                                    <div><b>ผู้รับผิดชอบ : </b>';
                                    $peraonArray = json_decode($row["persons"], true);
                                    foreach ($peraonArray as $key => $value) {
                                        $jsonData.="<p> <b>ลำดับ</b> : ".$key."</p>";
                                        $jsonData.="<p> <b>ชื่อ</b> : ".$value["perName"]."</p>";
                                    }
                                
                                $jsonData.='
                                </div>
                            </div>
                            <div class="col-md-5">';
                                $budgetArray = json_decode($row["budget"], true);
                                $jsonData.='<div><b>เป้าหมายหลัก</b> '.$row["maingoal"].'</div>
                                <div><b>งบประมาณ : </b> '.$budgetArray["sumPrice"].'</div>
                                <div><b>งบประมาณที่ใช้ในไตรมาสนี้ : </b> '; 
                                if($resultProgress->num_rows > 0){ $jsonData.=$rowProgress["cost_budget"];} 
                                $jsonData.='</div>
                                <div><b>ความคืบหน้า : </b> 
                                
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-green" role="progressbar" aria-volumenow="';
                                    if($resultProgress->num_rows > 0){$jsonData.=$rowProgress["progress"];}
                                    $jsonData.='" aria-volumemin="0" aria-volumemax="100" style="width: ';
                                    if($resultProgress->num_rows > 0){$jsonData.=$rowProgress["progress"];}
                                    $jsonData.='%">
                                </div>
                                </div>
                                <small>';
                                if($resultProgress->num_rows > 0){ $jsonData.=$rowProgress["progress"];}
                                $jsonData.='% Complete
                                </small>

                                </div>
                            </div>
                        </div>
                        <hr class="hr">
                        <div class="row">
                            <div class=" input-group col-md-3 m-3">
                                <b>ไตรมาสที่ : </b>
                                <select class="ml-2 form-control " name="qua_select" id="qua_select">
                                    ';
                                    for($i = 1;$i<=4;$i++){
                                        $jsonData.='
                                        <option value="'.$i.'" ';
                                        if($yearQuarter == $i){ $jsonData.='selected';}
                                        
                                        $jsonData.='>'.$i.'</option>';
                                    }
                                $jsonData.='</select>
                            </div>
                            <div class=" input-group col-md-3 m-3">
                                <b>ปี : </b>
                                <select class="ml-2 form-control " name="Y_select" id="Y_select">
                                    ';
                                    for($i = $Yselect-3;$i<=$Yselect;$i++){
                                        $jsonData.='
                                        <option value="'.$i.'" ';
                                        if($Y== $i){ $jsonData.='selected';}
                                        
                                        $jsonData.='>'.$i.'</option>';
                                    }
                                $jsonData.='</select>
                            </div>
                            <div class=" input-group col-md-3 m-3">
                                <b>ประเภท : </b>
                                <select class="ml-2 form-control " name="status_select" id="status_select">
                                    <option value="สรุปโครงการ" ';if($status == "สรุปโครงการ"){ $jsonData.='selected';} $jsonData.='>สรุปโครงการ</option>
                                    <option value="รายงานปัญหา"';if($status == "รายงานปัญหา"){ $jsonData.='selected';} $jsonData.='>รายงานปัญหา</option>
                                </select>
                            </div>
                        </div>
                        <table class=" table table-bordered hover detail-report" id="tableDetailReport">
                            <thead>
                                <tr>
                                    <td>ลำดับ</td>
                                    <td>หัวข้อ</td>
                                    <td>รายละเอียด</td>
                                    <td>วันที่</td>
                                </tr>
                            </thead>
                            <tbody>';
                            if ($resultQua->num_rows > 0) {
                                $no = 0;
                                while($rowQua = $resultQua->fetch_assoc()) {
                                    if($status == "สรุปโครงการ"){
                                        if($rowQua["status"] == "สรุปโครงการ" || $rowQua["status"] == "สรุปโครงการ_user"){
                                            $jsonData.='<tr>
                                                <td>'.++$no.'</td>
                                                <td>'.$rowQua["topic"].'</td>
                                                <td>'.$rowQua["detail"].'</td>
                                                <td>'.$rowQua["qua_date"].'</td>
                                            </tr>';
                                        }
                                    } else if($status == "รายงานปัญหา"){
                                        if($rowQua["status"] == "รายงานปัญหา"){
                                            $jsonData.='<tr>
                                                <td>'.++$no.'</td>
                                                <td>'.$rowQua["topic"].'</td>
                                                <td>'.$rowQua["detail"].'</td>
                                                <td>'.$rowQua["qua_date"].'</td>
                                            </tr>';
                                        }
                                    }
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
