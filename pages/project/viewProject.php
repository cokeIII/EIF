<?php 
    require_once "../conf.php";
    require_once "../connect.php";
    $busi_id = $_SESSION["id"];
    $branch_no = $_SESSION["branch_no"];
    $projectId = $_POST["projectId"];
    $sql = "select * from project where busi_id = '$busi_id' and branch_no = '$branch_no' and project_id = '$projectId'";
    $result = $conn->query($sql);
    $jsonData["content"] = "";
    $jsonData["content"].='<div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1 class="m-0 text-dark">รายละเอียดโปรเจค</h1>
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
                <div class="col-md-6 ">
            ';
                if ($result->num_rows > 0) {
                    $no = 0;
                    while($row = $result->fetch_assoc()) {
            
                    $jsonData["content"].='
                    <div class="card ">
                        <div class="card-header"><h5>ชื่อโครงการ</h5></div>
                        <div class="card-body">
                            '.$row["project_name"].'
                        </div>
                    </div>
                    <div class="card ">
                        <div class="card-header"><h5>ผู้รับผิดชอบ</h5></div>
                        <div class="card-body">
                            ';
                            $someArray = json_decode($row["persons"], true);
                            foreach ($someArray as $key => $value) {
                                $jsonData["content"].="<p> <b>ลำดับ</b> : ".$key."</p>";
                                $jsonData["content"].="<p> <b>ชื่อ</b> : ".$value["perName"]."</p>";
                                $jsonData["content"].="<p> <b>เบอร์โทร</b> : ".$value["tel"]."</p>";
                                $jsonData["content"].="<p> <b>อีเมลล์</b> : ".$value["email"]."</p>";
                            }
                            $jsonData["content"].='
                        </div>
                    </div>
                    <div class="card ">
                        <div class="card-header"><h5>หลักการและเหตุผล</h5></div>
                        <div class="card-body">
                            '.$row["reason"].'
                        </div>
                    </div>
                    <div class="card ">
                        <div class="card-header"><h5>เป้าหมายหลัก</h5></div>
                        <div class="card-body">
                            '.$row["maingoal"].'
                        </div>
                    </div>
                </div>
                    ';
                $jsonData["content"].='<div class="col-md-6 ">
                    <div class="card">
                        <div class="card-header"><h5>กำหนดการ</h5></div>
                        <div class="card-body">
                            <div id="calendar"></div>
                        </div>
                    </div>
                ';
                        $jsonData["calendar"] = [
                            "start_duration" => $row["start_duration"],
                            "end_duration" => $row["end_duration"]
                        ];
                    
                    }
                }  
                $jsonData["content"].='
                </div>
            </div>
        </div>
    </div>
</section>';
echo json_encode($jsonData);
