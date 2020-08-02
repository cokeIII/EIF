<?php 
    require_once "../conf.php";
    require_once "../connect.php";
    
    $busi_id = $_SESSION["id"];
    $branch_no = $_SESSION["branch_no"];
    $projectId = $_POST["projectId"];
    if(isset($_SESSION["status"])){
        if($_SESSION["status"] == "admin"){
            $sql = "select * from project where project_id = '$projectId'";
        } else if($_SESSION["status"] == "user") {
            $sql = "select * from project where busi_id = '$busi_id' and branch_no = '$branch_no' and project_id = '$projectId'";
        }
    } 

    $result = $conn->query($sql);
    $jsonData["content"] = "";
    $jsonData["content"].='<div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1 class="m-0 text-dark">รายละเอียดโครงการ</h1>
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
                    <div class="card ">
                        <div class="card-header"><h5>สถาณที่</h5></div>
                        <div class="card-body">
                            '.$row["locations"].'
                        </div>
                    </div>
                    <div class="card ">
                        <div class="card-header"><h5>ประโยชน์ที่คาดว่าจะได้รับ</h5></div>
                        <div class="card-body">
                            '.$row["product"].'
                        </div>
                    </div>
                    <div class="card ">
                        <div class="card-header"><h5>วันที่ลงทะเบียน</h5></div>
                        <div class="card-body">
                            '.$row["project_date"].'
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
                    <div class="card">
                        <div class="card-header"><h5>รายการวันที่</h5></div>
                        <div class="card-body">
                            <div id="dateDetail"></div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header"><h5>วิธีการประเมินผลและดัชนีชี้วัดความสำเร็จ</h5></div>
                        <div class="card-body">
                            '.$row["indicator"].'
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header"><h5>งบประมาณ</h5></div>
                        <div class="card-body">
                            ';

                            $someArray = json_decode($row["budget"], true);
                            $jsonData["content"].= "<p> <b>งบประมาณ</b> : ".$someArray["sumPrice"]." บาท</p>";
                            $totalPrice = 0;
                            foreach ($someArray as $key => $value) {
                                if($key != "sumPrice"){
                                    $jsonData["content"].="<p> <b></b>".$value["disBudget"]." ";
                                    $jsonData["content"].="<b>จำนวน</b> : ".$value["num"]."";
                                    $jsonData["content"].="<b> </b> ".$value["unit"]." ";
                                    $jsonData["content"].="<b>หน่วยละ </b> : ".$value["price"]." บาท ";
                                    $jsonData["content"].="<b>รวม </b> : ".$value["price"]*$value["num"]." บาท</p>";
                                    $totalPrice+=$value["price"]*$value["num"];
                                }
                            }
                            $jsonData["content"].= "<p> <b>รวมทั้งหมด</b> : ".$totalPrice." บาท</p>";

                            $jsonData["content"].='
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
