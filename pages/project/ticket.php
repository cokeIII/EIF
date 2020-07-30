<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php 
    require_once "../conf.php";
    require_once "../connect.php";
    
    $busi_id = $_SESSION["id"];
    $branch_no = $_SESSION["branch_no"];
    if(isset($_SESSION["status"])){
        if($_SESSION["status"] == "admin"){
            $sql = "select project_id,project_name,pro_status,branch_no,busi_id,persons from project where pro_status = 'ผ่านการอนุมัติ'";
        } else if($_SESSION["status"] == "user") {
            $sql = "select project_id,project_name,pro_status,branch_no,busi_id,persons from project where busi_id = '$busi_id' and branch_no = '$branch_no' and pro_status = 'ผ่านการอนุมัติ'";
        }
    } 
    $result = $conn->query($sql);
?>

<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0 text-dark">รายงานปัญหา</h1>
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
                                        ชื่อโครงการ
                                    </th>
                                    <th style="width: 15%">
                                        ผู้รับผิดชอบ
                                    </th>
                                    <th style="width: 10%">
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            if ($result->num_rows > 0) {
                                $no = 0;
                                while($row = $result->fetch_assoc()) {
                            ?>
                                <tr>
                                    <td>
                                        <?php echo ++$no;?>
                                    </td>
                                    <td class="pro-name">
                                        <?php echo $row["project_name"];?>
                                    </td>
                                    <td>
                                        <?php
                                        $someArray = json_decode($row["persons"], true);
                                        foreach ($someArray as $key => $value) {
                                            echo "<p>".$value["perName"]."</p>";
                                        }
                                        ?>
                                    </td>
                                    <td class="project-actions text-center">
                                        <a class="btn btn-warning btn-sm btn-ticket" href="#"   proName="<?php echo $row["project_name"];?>" proId="<?php echo $row["project_id"];?>">
                                            <i class="fas fa-comment">
                                            </i>
                                            รายงานปัญหา
                                        </a>
                                        <a class="btn btn-primary btn-sm  mt-3 all-ticket" href="#"  proName="<?php echo $row["project_name"];?>" proId="<?php echo $row["project_id"];?>">
                                            <i class="fas fa-folder">
                                            </i>
                                            ปัญหาที่รายงานทั้งหมด
                                        </a>
                                    </td>
                                </tr>
                            <?php } 
                            }?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $(document).ready(function(){
        $("#tablePrePro").dataTable()
        $(document).on("click",".btn-ticket",function(){
            let item = $(this)
            $.ajax({
                type: 'post', 
                dataType: "json",
                url: 'pages/project/formticket.php',
                data: {
                    ticket:true, 
                    projectName: $(this).attr("proName"),
                    proId: $(this).attr("proId")
                },
                success: function (data) {
                    $('#mainContent').html(data)
                },
            })
        })
        var projectName = ""
        var proId = ""
        function reListTicket(projectName,proId){
            $.ajax({
                type: 'post', 
                dataType: "json",
                url: 'pages/project/listTicket.php',
                data: {
                    ticket:true, 
                    projectName: projectName,
                    proId: proId
                },
                success: function (data) {
                    $('#mainContent').html(data)
                },
            })
        }
        $(document).on("click",".all-ticket",function(){
            projectName = $(this).attr("proName")
            proId = $(this).attr("proId")
            reListTicket(projectName,proId)
        })

        $(document).on("click",".del-ticket",function(){
            let id = $(this).attr("val")
            let btn = $(this)
            const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success ml-2',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
            title: 'ต้องการลบ ใช่ หรือ ไม่ ?',
            text: "",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'ลบ',
            cancelButtonText: 'ยกเลิก',
            reverseButtons: true
            }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'post', 
                    dataType: "json",
                    url: 'pages/project/dbTicket.php',
                    data: {
                        delTicket:true, 
                        qua_id : id,
                    },
                    success: function (data) {
                        if(data){
                            swalWithBootstrapButtons.fire(
                            'ลบสำเร็จ',
                            '',
                            'success'
                            )
                            reListTicket(projectName,proId)

                        } else {
                            swalWithBootstrapButtons.fire(
                            'ลบไม่สำเร็จ',
                            '',
                            'error'
                            )

                        }
                    },
                })

            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                'ยกเลิก',
                '',
                'error'
                )
            }
            })
        })

        $(document).on("submit","#formTicket",function(e){
            e.preventDefault()
            let formTicket = $(this)
            $.ajax({
                url: "pages/project/dbTicket.php",
                type: "POST",
                data:  new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(data) {
                    if(data){
                        Swal.fire({
                            icon: 'success',
                            title: 'รายงานปัญหาสำเร็จ',
                            text: '',
                            footer: ''   
                        })
                        formTicket[0].reset();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'ERROR เกิดข้อผิดพลาด',
                            text: '',
                            footer: ''   
                        })
                    }
                }
            })
        })
    })
</script>