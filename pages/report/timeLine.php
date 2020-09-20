<?php 
    require_once "../conf.php";
    require_once "../connect.php";

    $jsonData = "";
$jsonData.='<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0 text-dark">เส้นเวลาโครงการ </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
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
                        <div id="timeline" style="height: 180px;"></div>
                        <hr class="hr">
                        <h2 id="topicTimeline"><h2>
                        <div id="datailTimeline"></div>
                        <div id="startTimeline"></div>
                        <div id="endTimeline"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>';
echo json_encode($jsonData);
?>