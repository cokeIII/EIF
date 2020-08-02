
<?php 
    require_once "../conf.php";
    require_once "../connect.php";
    $name = $_POST["projectName"];
    $id = $_POST["proId"];
    $month = date("n");
    $Y =  date("Y");
    $yearQuarter = ceil($month / 3);
    $sql = "select  qua_id,detail,project_id,topic from quarter_project where project_id = '$id' and status = 'สรุปโครงการ' and quater = '$yearQuarter' and YEAR(qua_date) = '$Y'";
    $sqlUser = "select  qua_id,detail,project_id,topic from quarter_project where project_id = '$id' and status = 'สรุปโครงการ_user' and quater = '$yearQuarter' and YEAR(qua_date) = '$Y'";
    $result = $conn->query($sql);
    $resultUser = $conn->query($sqlUser);

    $costBudget = "";
    $progress = "";

    $sqlProgress = "select * from quarter_progress where project_id = '$id' and quater_year = '$Y' and quater = '$yearQuarter '";
    $resultProgress = $conn->query($sqlProgress);
    if ($resultProgress->num_rows > 0) {
        $rowProgress = $resultProgress->fetch_assoc();
        $costBudget = $rowProgress["cost_budget"];
        $progress = $rowProgress["progress"];
    }
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
                                                <a class="btn btn-info btn-sm edit-qua ml-2 mt-2" >
                                                    <i class="fas fa-pencil-alt">
                                                    </i>
                                                    แก้ไข
                                                </a>

                                                <a class="btn m-2 btn-info btn-sm edit-qua-save collapse "  val="'.$row["qua_id"].'">
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
                                    $jsonData.=' <div class="input-qua mt-3"><div class="input-group col-md-5">
                                        <input  type="text" class="form-control topicQua" required=""  name="topicIndicator'.$row["qua_id"].'" value="'.$row["topic"].'" required="" disabled>
                                    </div>
                                    <div class="input-group col-md-6  mt-3">
                                        <div class="row">
                                            <div class="col-md-9">
                                                <textarea name="detail-qua" id="detail-qua" cols="40" class="form-control detailQua" rows="5" disabled>'.$row["detail"].'</textarea>
                                            </div>
                                            <div class="col-md-3">
                                                <a class="btn btn-info btn-sm edit-qua-user ml-2 mt-2" >
                                                    <i class="fas fa-pencil-alt">
                                                    </i>
                                                    แก้ไข
                                                </a>

                                                <a class="btn m-2 btn-info btn-sm edit-qua-save-user collapse "  val="'.$row["qua_id"].'">
                                                    <i class="fas fa-save">
                                                    </i>
                                                    บันทึก
                                                </a>

                                                <a class="btn m-2 btn btn-danger btn-sm del-qua-user"  val="'.$row["qua_id"].'">
                                                    <i class="fas fa-trash">
                                                    </i>
                                                    ลบ
                                                </a>

                                            </div>
                                        </div>
                                    </div></div>';
                                }
                            }

                            $jsonData.=' 
                            <hr class="hr">
                        <form id="formQua" method="post" class="form-horizontal" action="">
                        <div class="row">
                            <div class="col-md-6">
                                
                                    <input type="hidden" name="project_id" value="'.$id.'">
                                    <input type="hidden" name="formQua" value="true">

                                    <div class="form-group">
                                        <label for="topicQua" class=" control-label h5 mt-2">หัวข้อ</label>

                                        <div class="input-group  input-qua">
                                            <input  type="text" class="form-control topicQua" required=""  name="topicQua" value="" required="" >
                                        </div>
                                        <label for="topicQua" class="control-label h5 mt-2">รายละเอียด</label>

                                        <div class="input-group  mt-2">
                                            <textarea name="detail-qua" id="detail-qua" cols="40" class="form-control" rows="5"></textarea>
                                        </div>';

                                        $jsonData.='
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group ">
                                            <button type="submit" class="btn btn-primary" id="sendQua">บันทึก</button>
                                        </div>
                                    </div>
                                
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="costBudget" class=" control-label h5 mt-2">งบประมาณที่ใช้ในไตรมาส</label>

                                    <div class="input-group  input-qua">
                                        <input  type="number" class="form-control costBudget col-md-6" required=""  name="costBudget" value="'. $costBudget.'" required="" >
                                    </div>

                                    <label for="progress" class=" control-label h5 mt-2">ความคืบหน้าของโครงการ</label>

                                    <div class="input-group  input-qua">
                                        <input  type="number" class="form-control  col-md-3" required=""  name="progress" value="'.$progress.'" required="" > %
                                    </div>

                                </div>
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
