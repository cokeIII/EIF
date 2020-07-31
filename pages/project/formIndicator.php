
<?php 
    require_once "../conf.php";
    require_once "../connect.php";
    $name = $_POST["projectName"];
    $id = $_POST["proId"];
    $month = date("n");
    $sql = "select  qua_id,project_id,topic from quarter_project where project_id = '$id' and status = 'สรุปโครงการ'";
    $result = $conn->query($sql);
    $yearQuarter = ceil($month / 3);
    // print_r($sql);

$jsonData = "";
$jsonData.= '<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-8">
        <h1 class="m-0 text-dark">กำหนดตัวชี้วัด '.$name.' ประจำไตรมาสที่ '.$yearQuarter.' ปี '.date("Y").'</h1>
        </div><!-- /.col -->
        <div class="col-sm-4">
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
                        <form id="formTicket" method="post" class="form-horizontal" action="">
                            <input type="hidden" name="project_id" value="'.$id.'">
                            <input type="hidden" name="formIndicator" value="true">
                            <div class="form-group">';
                            $no = 0;
                            if ($result->num_rows > 0) {
                                
                                while($row = $result->fetch_assoc()) {
                                $jsonData.=' 
                                <label for="topicIndicator" class="col-md-2 control-label h5">ตัวชี้วัดที่'.++$no.'</label>
   
                                <div class="input-group col-md-5">
                                    <input  type="text" class="form-control" required="" id="topicIndicator" name="topicIndicator'.$no.'" value="" required="">
                                </div>';
                                }
                                
                            }

                            $jsonData.=' 
                            <label for="topicIndicator" class="col-md-2 control-label h5">ตัวชี้วัดที่'.++$no.'</label>

                            <div class="input-group col-md-5">
                                <input  type="text" class="form-control" required="" id="topicIndicator" name="topicIndicator'.$no.'" value="" required="">
                            </div>';

                                $jsonData.='
                            </div>
                            <div class="form-group">
                                <div class="input-group col-md-5">
                                    <button type="submit" class="btn btn-primary" id="sendIndicator">เพิ่มตัวชี้วัด</button>
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