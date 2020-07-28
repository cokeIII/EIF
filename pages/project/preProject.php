<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php 
    require_once "../conf.php";
    require_once "../connect.php";
    $busi_id = $_SESSION["id"];
    $branch_no = $_SESSION["branch_no"];
    
    $sql = "select project_id,project_name,pro_status,branch_no,busi_id,persons from project where busi_id = '$busi_id' and branch_no = '$branch_no'";
    $result = $conn->query($sql);
?>

<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0 text-dark">โครงการที่เสนอ</h1>
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
                                    <th style="width: 20%">
                                        ชื่อโครงการ
                                    </th>
                                    <th style="width: 20%">
                                        ผู้รับผิดชอบ
                                    </th>
                                    <th>
                                        ความคืบหน้า
                                    </th>
                                    <th style="width: 8%" class="text-center">
                                        สถานะ
                                    </th>
                                    <th style="width: 20%">
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
                                    <td>
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
                                    <td class="project_progress">
                                        <div class="progress progress-sm">
                                            <div class="progress-bar bg-green" role="progressbar" aria-volumenow="0" aria-volumemin="0" aria-volumemax="100" style="width: 0%">
                                            </div>
                                        </div>
                                        <small>
                                            0% Complete
                                        </small>
                                    </td>
                                    <td class="project-state">
                                        <span class="badge badge-warning"><?php echo $row["pro_status"];?></span>
                                    </td>
                                    <td class="project-actions text-right">
                                        <a class="btn btn-primary btn-sm viewProject" href="#"  val="<?php echo $row["project_id"]; ?>">
                                            <i class="fas fa-folder">
                                            </i>
                                            View
                                        </a>
                                        <a class="btn btn-info btn-sm" href="#">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                            Edit
                                        </a>
                                        <a class="btn btn-danger btn-sm" href="#">
                                            <i class="fas fa-trash">
                                            </i>
                                            Delete
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
        $(document).on("click",".viewProject",function(){
            $.ajax({
                type: 'post', 
                dataType: "json",
                url: 'pages/project/viewProject.php',
                data: {
                    viewProject:true, 
                    projectId: $(this).attr("val"),
                },
                success: function (data) {
                    $('#mainContent').html(data.content)         
                    var date = new Date()
                    var d    = date.getDate(),
                        m    = date.getMonth(),
                        y    = date.getFullYear()

                    var Calendar = FullCalendar.Calendar;
                    
                    var calendarEl = document.getElementById('calendar');
                    let i = 0,dateData=[];
                    $.each(data.calendar,function(index,value){
                        let newDate = value.split('-')
                        if(index == "start_duration"){
                            dateData[i]={
                                title          : 'วันเริ่มโครงการ',
                                start          : new Date(newDate[0], newDate[1]-1,newDate[2]),
                                allDay         : false,
                                backgroundColor: '#0073b7', //Blue
                                borderColor    : '#0073b7' //Blue
                            }
                        } else if(index == "end_duration") {
                            dateData[i]={
                                title          : 'วันสิ้นสุดโครงการ',
                                start          : new Date(newDate[0], newDate[1]-1,newDate[2]),
                                allDay         : false,
                                backgroundColor: '#0073b7', //Blue
                                borderColor    : '#0073b7' //Blue
                            }
                        }
                        i++
                    })
                    
                    var calendar = new Calendar(calendarEl, {
                        plugins: [ 'bootstrap', 'interaction', 'dayGrid', 'timeGrid' ],
                        header    : {
                            left  : 'prev,next today',
                            center: 'title',
                            right : 'dayGridMonth,timeGridWeek,timeGridDay'
                        },
                        'themeSystem': 'bootstrap',
                        //Random default events
                        events    : dateData,
                    });

                    calendar.render();

                },
            })

        })


    })
</script>