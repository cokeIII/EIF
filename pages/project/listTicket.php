<?php 
    require_once "../conf.php";
    require_once "../connect.php";
    
    $name = $_POST["projectName"];
    $id = $_POST["proId"];

    if(isset($_SESSION["status"])){
        if($_SESSION["status"] == "admin"){
            $sql = "select 
            qua_id,
            project_id,
            topic,
            detail,
            status,
            quater,
            qua_date,
            file_name
            from quarter_project where project_id ='$id'
            ";
        } else if($_SESSION["status"] == "user") {
            $sql = "select 
            qua_id,
            project_id,
            topic,
            detail,
            status,
            quater,
            qua_date,
            file_name
            from quarter_project where project_id ='$id'
            ";
        }
    } 
    $result = $conn->query($sql);
$jsonData = "";
$jsonData.='<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0 text-dark">ปัญหาในโครงการ '.$name.'</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
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
                        <table class="table table-bordered hover projects" id="tablePrePro">
                            <thead>
                                <tr>
                                    <th style="width: 1%">
                                        ลำดับ
                                    </th>
                                    <th style="width: 13%">
                                        หัวข้อ
                                    </th>
                                    <th style="width: 25%">
                                        รายละเอียด
                                    </th>
                                    <th style="width: 10%">
                                        ไฟล์แนบ
                                    </th>
                                    <th style="width: 8%" class="text-center">
                                        วันที่
                                    </th>
                                    <th style="width: 8%" class="text-center">
                                        
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            ';
                            if ($result->num_rows > 0) {
                                $no = 0;
                                while($row = $result->fetch_assoc()) {
                                $jsonData.='    
                                <tr>
                                    <td>
                                        '.++$no.'
                                    </td>
                                    <td>
                                        '.$row["topic"].'
                                    </td>
                                    <td>
                                        '.$row["detail"].'
                                    </td>
                                    <td>';
                                    if(!empty($row["file_name"])){
                                        $jsonData.='<a href="pages/project/uploads/'.$row["file_name"].'" class="btn btn-primary">ดาวโหลดไฟล์</a>';
                                    }
                                    $jsonData.='</td>
                                    <td>
                                        '.$row["qua_date"].'
                                    </td>
                                    <td>
                                        <a class="btn btn-danger btn-sm del-ticket" href="#" val="'.$row["qua_id"].'">
                                            <i class="fas fa-trash">
                                            </i>
                                            ลบ
                                        </a>
                                    </td>
                                </tr>
                                    '; 
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