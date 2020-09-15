
<?php 
    require_once "../conf.php";
    require_once "../connect.php";
    $name = $_POST["projectName"];
    $id = $_POST["proId"];
    $month = date("n");
    $Y =  date("Y");
    $yearQuarter = ceil($month / 3);
    $sql = "select  qua_id,detail,project_id,topic,qua_date,qua_check from quarter_project where project_id = '$id' and status != 'รายงานปัญหา' and quater = '$yearQuarter' and YEAR(qua_date) = '$Y'";
    $result = $conn->query($sql);
function quaCheck($c){
    if($c == 0 ){
        return '<span class="badge badge-danger">ไม่ผ่านการประเมิน</span>';
    } else if($c == 1){
        return '<span class="badge badge-success">ผ่านการประเมิน</span>';
    } else if($c == 2){
        return '<span class="badge badge-warning">รอการประเมิน</span>';
    }
}
$jsonData = "";
$jsonData.= '<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-9">
        <h1 class="m-0 text-dark">ประเมินตัวชี้วัดโครงการ '.$name.' ประจำไตรมาสที่ '.$yearQuarter.' ปี '.date("Y").'</h1>
        </div><!-- /.col -->
        <div class="col-sm-3">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active">โครงการ</li>
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
                        <table class="table table-bordered hover projects" id="tablelistCheckQua">
                            <thead>
                                <tr>
                                    <th style="width: 1%">
                                        ลำดับ
                                    </th>
                                    <th style="width: 13%">
                                        หัวข้อ
                                    </th>
                                    <th style="width: 15%">
                                        รายละเอียด
                                    </th>
                                    <th style="width: 15%">
                                        สถานะ
                                    </th>
                                    <th style="width: 10%">
                                        วันเวลา
                                    </th>
                                    <th style="width: 20%">
                                    </th>
                                </tr>
                            </thead>
                            <tbody>';

                            $no = 0;
                            if ($result->num_rows > 0) {
                                
                                while($row = $result->fetch_assoc()) {
                                $no++;
                                $jsonData.=' 
                                    <tr>
                                        <td>
                                            '.$no.'
                                        </td>
                                        <td>
                                            '.$row['topic'].'
                                        </td>
                                        <td>
                                            '.$row['detail'].'
                                        </td>
                                        <td>
                                            '.quaCheck($row['qua_check']).'
                                        </td>
                                        <td>
                                            '.$row['qua_date'].'
                                        </td>
                                        <td class="project-actions text-center">
                                            <a class="btn btn-success btn-sm  mt-3 btn-qua-check" href="#" val="1" proId="'.$row["qua_id"].'">
                                                    <i class="fas fa-check">
                                                    </i>
                                                    ผ่านการประเมิน
                                            </a>
                                            <a class="btn btn-danger btn-sm  mt-3 btn-qua-check" href="#" val="0" proId="'.$row["qua_id"].'">
                                                    <i class="fas fa-window-close">
                                                    </i>
                                                    ไม่ผ่านการประเมิน
                                            </a>
                                            <a class="btn btn-warning btn-sm  mt-3 btn-qua-check" href="#" val="2" proId="'.$row["qua_id"].'">
                                                    <i class="fas fa-clock">
                                                    </i>
                                                    รอการประเมิน
                                            </a>
                                        </td>    
                                    </tr>
                                ';
                                }
                            }
        $jsonData.='        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>';

echo json_encode($jsonData);
