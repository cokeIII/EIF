
<?php 
    require_once "../conf.php";
    require_once "../connect.php";
    $name = $_POST["projectName"];
    $id = $_POST["proId"];
    $month = date("n");

    $yearQuarter = ceil($month / 3);

$jsonData = "";
$jsonData.= '<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-8">
        <h1 class="m-0 text-dark">รายงานปัญหา '.$name.' ประจำไตรมาสที่ '.$yearQuarter.' ปี '.date("Y").'</h1>
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
                            <input type="hidden" name="formTicket" value="true">
                            <div class="form-group">
                                <label for="topic" class="col-md-2 control-label h5">หัวข้อปัญหา</label>
                                <div class="input-group col-md-5">
                                    <input  type="text" class="form-control" required="" id="topic" name="topic" value="" required="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="detail" class="col-md-3 control-label h5">รายละเอียดของปัญหา</label>
                                <div class="input-group col-md-5">
                                    <textarea class="form-control" id="detail" rows="8" name="detail" value="" required=""></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="files" class="col-md-3 control-label h5">แนบไฟล์</label>
                                <div class="input-group col-md-5">
                                    <input type="file" class="form-control" id="files" name="files" >
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group col-md-5">
                                    <button type="submit" class="btn btn-primary" id="sendTicket">รายงาน</button>
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