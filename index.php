<!DOCTYPE html>
<html>
<head>
  <?php 
    require_once "pages/conf.php";
    $_SESSION["status"] = "mormal";
  ?> 
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $title;?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Theme style index-->
  <link rel="stylesheet" href="dist/css/index.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <ul class="navbar-nav ml-auto">
    <li class="nav-item">
        <?php if(isset($_SESSION["username"])){
            echo $_SESSION["username"];
        };?>
      </li>
      <li class="nav-item">
        <?php if(isset($_SESSION["login"]) && $_SESSION["login"]==true){?>
          <a class="nav-link" href="pages/login/logout.php">LOGOUT</a>
        <?php } else {?>
          <a class="nav-link" href="#"  data-toggle="modal" data-target="#modal-default">LOGIN</a>
        <?php }?>
      </li>
    </ul>

  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary color-sidebar elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">EIF</span>
    </a>

    <!-- Sidebar -->
      <?php
        if(isset($_SESSION["status"])) {
          if($_SESSION["status"] == "user"){
            require_once "pages/sidebar/sidebarUser.php";
          } else if($_SESSION["status"] == "admin"){
            require_once "pages/sidebar/sidebarAdmin.php";
          } else {
            require_once "pages/sidebar/sidebar.php";
          }
        }
      ?>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper bg-img" id="mainContent">
    
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
  
    <!-- Content Header (Page header) -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info f-black">
              <div class="inner ">
                <h3>0</h3>
                <p>โครงการทั้งหมด</p>
              </div>
              <div class="icon">
                <i class="icon ion-md-business"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success f-black">
              <div class="inner">
                <h3>0</h3>
                <p>โครงการที่ผ่านการอนุมัติ</p>
              </div>
              <div class="icon">
                <i class="icon ion-md-checkmark"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warningM f-black">
              <div class="inner">
                <h3>0</h3>
                <p>โครงการที่รอการอนุมัติ</p>
              </div>
              <div class="icon">
                <i class="icon ion-md-stopwatch"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger f-black">
              <div class="inner">
                <h3>0</h3>
                <p>โครงการที่ไม่ผ่านการอนุมัติ</p>
              </div>
              <div class="icon">
                <i class="icon ion-md-close"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
      </div>
    </section>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header color-sidebar f-withe">
              <h3 class="card-title">จำนวนโครงการใน 10 อุตสาหกรรม</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
              </div>
            </div>
            <div class="card-body">
              <div class="chart">
                <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <div class="col-md-6">
          <!-- solid sales graph -->
          <div class="card color-sidebar">
            <div class="card-header border-0">
              <h3 class="card-title f-withe">
                <!-- <i class="fas fa-th mr-1"></i> -->
                <div class="row">
                  <div class="input-group input-group-sm">
                    ผลการประเมินโครงการ
                    <input type="text" class="form-control ml-2" placeholder="ชื่อโครงการ">
                    <span class="input-group-append">
                      <button type="button" class="btn color-menu btn-flat">Go!</button>
                    </span>
                  </div>
                </div>
              </h3>

              <div class="card-tools">
                <button type="button" class="btn color-sidebar btn-sm" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn color-sidebar btn-sm" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <canvas class="chart" id="line-chart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            </div>
            <!-- /.card-body -->
            <div class="card-footer bg-transparent">
            </div>
            <!-- /.card-footer -->
          </div>
          <!-- /.card -->
        </div>
      </div>
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2019 </strong>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Login</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form role="form" id="quickForm">
          <div class="card-body">
            <div class="form-group">
              <label for="exampleInputEmail1">เลขประจำตัวผู้เสียภาษี</label>
              <input type="tel" maxlength="13" minlength="13" pattern="[0-9]{13}" name="username" class="form-control" id="username" placeholder="13 หลัก" required>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">รหัสผ่าน</label>
              <input type="password" name="password" class="form-control" id="password" placeholder="">
            </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <button type="submit" class="btn btn-primary float-sm-right color-menu">Login</button>
          </div>
        </form>
      </div>
      <!-- <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<!-- <script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script> -->
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<script src="dist/js/pages/index.js"></script>
</body>
</html>
<script>

$(function () {    
  var areaChartData = {
      labels  : ['ยานยนต์สมัยใหม่', 'อิเล็กทรอนิกส์อัจฉริยะ', 'การท่องเที่ยว', 'การเกษตร', 'การแปรรูปอาหาร', 'หุ่นยนต์', 'โลจิสติกส์','ดิจิทัล','เชื้อเพลิงชีวภาพ','การแพทย์ครบวงจร'],
      datasets: [
        {
          label               : 'Digital Goods',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [28, 34, 31, 19, 36, 27, 30,42,11,17]
        }
      ]
    }

    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    var barChartData = jQuery.extend(true, {}, areaChartData)
    var temp0 = areaChartData.datasets[0]
    // var temp1 = areaChartData.datasets[1]
    // barChartData.datasets[0] = temp1
    barChartData.datasets[0] = temp0

    var barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : true,
      legend: {
        display: false
      },
    }

    var barChart = new Chart(barChartCanvas, {
      type: 'bar', 
      data: barChartData,
      options: barChartOptions
    })
})
// // Sales graph chart
var salesGraphChartCanvas = $('#line-chart').get(0).getContext('2d');
//$('#revenue-chart').get(0).getContext('2d');

var salesGraphChartData = {
  labels  : ['2011 Q1', '2011 Q2', '2011 Q3', '2011 Q4', '2012 Q1', '2012 Q2', '2012 Q3', '2012 Q4', '2013 Q1', '2013 Q2'],
  datasets: [
    {
      label               : 'Digital Goods',
      fill                : false,
      borderWidth         : 2,
      lineTension         : 0,
      spanGaps : true,
      borderColor         : '#efefef',
      pointRadius         : 3,
      pointHoverRadius    : 7,
      pointColor          : '#efefef',
      pointBackgroundColor: '#efefef',
      data                : [30, 60, 20, 70, 80, 50, 40, 30, 40, 50]
    }
  ]
}

var salesGraphChartOptions = {
  maintainAspectRatio : false,
  responsive : true,
  legend: {
    display: false,
  },
  scales: {
    xAxes: [{
      ticks : {
        fontColor: '#efefef',
      },
      gridLines : {
        display : false,
        color: '#efefef',
        drawBorder: false,
      }
    }],
    yAxes: [{
      ticks : {
        stepSize: 10,
        fontColor: '#efefef',
      },
      gridLines : {
        display : true,
        color: '#efefef',
        drawBorder: false,
      }
    }]
  }
}

// This will get the first returned node in the jQuery collection.
var salesGraphChart = new Chart(salesGraphChartCanvas, { 
    type: 'line', 
    data: salesGraphChartData, 
    options: salesGraphChartOptions
  }
)
</script>
