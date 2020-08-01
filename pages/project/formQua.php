
<?php 
    require_once "../conf.php";
    require_once "../connect.php";
    $name = $_POST["projectName"];
    $id = $_POST["proId"];
    $month = date("n");
    $sql = "select  qua_id,detail,project_id,topic from quarter_project where project_id = '$id' and status = 'สรุปโครงการ'";
    $sqlUser = "select  qua_id,detail,project_id,topic from quarter_project where project_id = '$id' and status = 'สรุปโครงการ_user'";
    $result = $conn->query($sql);
    $resultUser = $conn->query($sqlUser);
    $yearQuarter = ceil($month / 3);
    // print_r($sql);

$jsonData = "";
$jsonData.= '<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-9">
        <h1 class="m-0 text-dark">รายงานผลโครงการ '.$name.' ประจำไตรมาสที่ '.$yearQuarter.' ปี '.date("Y").'</h1>
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
                    <div class="card-body">';
                            $no = 0;
                            if ($result->num_rows > 0) {
                                
                                while($row = $result->fetch_assoc()) {
                                $jsonData.=' 
                                <div class="form-group">
                                    <label for="topicQua" class="col-md-2 control-label h5 mt-2">ตัวชี้วัดที่'.++$no.'</label>
    
                                    <div class="input-group col-md-5">
                                        <input  type="text" class="form-control topicQua" required=""  name="topicIndicator'.$row["qua_id"].'" value="'.$row["topic"].'" required="" disabled>
                                    </div>
                                    <div class="input-group col-md-6 input-qua mt-3">
                                        <div class="row">
                                            <div class="col-md-9">
                                                <textarea name="detail-qua" id="detail-qua" cols="40" class="form-control topicQua" rows="5" disabled>'.$row["detail"].'</textarea>
                                            </div>
                                            <div class="col-md-3">
                                                <a class="btn btn-info btn-sm edit-qua ml-2 mt-2" href="#">
                                                    <i class="fas fa-pencil-alt">
                                                    </i>
                                                    แก้ไข
                                                </a>

                                                <a class="btn m-2 btn-info btn-sm edit-qua-save collapse " href="#" val="'.$row["qua_id"].'">
                                                    <i class="fas fa-save">
                                                    </i>
                                                    บันทึก
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                ';
                                }
                                
                            }
                            $jsonData.=' <label for="topicQua" class="col-md-2 control-label h5 mt-2">สรุปรายงาน</label>';

                            if ($resultUser->num_rows > 0) {
                                
                                while($row = $resultUser->fetch_assoc()) {
                                    $jsonData.=' <div class="input-group col-md-5">
                                        <input  type="text" class="form-control topicQua" required=""  name="topicIndicator'.$row["qua_id"].'" value="'.$row["topic"].'" required="" disabled>
                                    </div>
                                    <div class="input-group col-md-6 input-qua mt-3">
                                        <div class="row">
                                            <div class="col-md-9">
                                                <textarea name="detail-qua" id="detail-qua" cols="40" class="form-control topicQua" rows="5" disabled>'.$row["detail"].'</textarea>
                                            </div>
                                            <div class="col-md-3">
                                                <a class="btn btn-info btn-sm edit-qua ml-2 mt-2" href="#">
                                                    <i class="fas fa-pencil-alt">
                                                    </i>
                                                    แก้ไข
                                                </a>

                                                <a class="btn m-2 btn-info btn-sm edit-qua-save collapse " href="#" val="'.$row["qua_id"].'">
                                                    <i class="fas fa-save">
                                                    </i>
                                                    บันทึก
                                                </a>
                                            </div>
                                        </div>
                                    </div>';
                                }
                            }

                            $jsonData.=' 
                        <form id="formQua" method="post" class="form-horizontal" action="">
                            <input type="hidden" name="project_id" value="'.$id.'">
                            <input type="hidden" name="formQua" value="true">

                            <div class="form-group">
                                <label for="topicQua" class="col-md-2 control-label h5 mt-2">หัวข้อ</label>

                                <div class="input-group col-md-5 input-qua">
                                    <input  type="text" class="form-control topicQua" required=""  name="topicQua" value="" required="" >
                                </div>
                                <label for="topicQua" class="col-md-2 control-label h5 mt-2">รายละเอียด</label>

                                <div class="input-group col-md-5 mt-2">
                                    <textarea name="detail-qua" id="detail-qua" cols="40" class="form-control" rows="5"></textarea>
                                </div>';

                                $jsonData.='
                            </div>
                            <div class="form-group">
                                <div class="input-group col-md-5">
                                    <button type="submit" class="btn btn-primary" id="sendQua">บันทึก</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>';

echo json_encode($jsonData);
