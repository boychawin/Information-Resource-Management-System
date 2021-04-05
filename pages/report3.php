<?php
session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <title> หน้า | แผนภาพสถิติรายปี </title>

    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="icon" type="image/png" href="https://boychawin.com/logo.png" />

    <!-- DataTables CSS -->
    <link href="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css"
        rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="../bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">

    <!-- Date -->
    <link href="css/bootstrap-datetimepicker.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../bower_components/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!--fancybox -->
    <link rel="stylesheet" href="../fancy/jquery.fancybox.css" type="text/css" media="screen" />

    <!-- Optionally add helpers - button, thumbnail and/or media -->
    <link rel="stylesheet" href="../fancy/helpers/jquery.fancybox-buttons.css" type="text/css" media="screen" />

    <!-- fullcalendar -->
    <link href='../fullcalendar.css' rel='stylesheet' />
    <link href='../fullcalendar.print.css' rel='stylesheet' media='print' />
    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="../bower_components/raphael/raphael-min.js"></script>
    <script src="../bower_components/morrisjs/morris.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="../bower_components/DataTables/media/js/jquery.dataTables.min.js"></script>
    <script src="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src='../lib/moment.min.js'></script>
    <script src='../fullcalendar.min.js'></script>
    <script src='../lang/th.js'></script>
    <script src="../fancy/jquery.fancybox.pack.js"></script>
    <script src="../fancy/helpers/jquery.fancybox-thumbs.js"></script>
    <script src="../fancy/helpers/jquery.fancybox-buttons.js"></script>
</head>

<body>

    <?php if (
        isset($_SESSION['staff-user']) &&
        $_SESSION['staff-user'] !== ''
    ) { ?>
    <?php if ($_SESSION['staff-level'] == 'supervisor') { ?>

    <?php include 'data3.php'; ?>
    <div class="row">
        <div class="col-lg-12">
            <h3 class="card-header alert  btn-success"><i class="fa fa-bar-chart fa-fw"></i>
                แผนภาพสถิติผู้มาใช้บริการรายปี</h3>
        </div>
    </div>

    <!-- /.row -->
    <div class="row">

        <div class="col-lg-12">
            <div class="panel panel-default">

                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div id="morris-bar-chart"></div>
                    <br>
                    <br>
                    <p class="btn-success divider" style="height:3px;"></p>
                    <br>
                    <div class="text-center">
                        <a href="report.php" class="btn btn-primary  "> <i class="fa fa-bar-chart"></i> แผนภาพรายวัน</a>
                        <a href="report2.php" class="btn btn-success  "> <i class="fa fa-bar-chart"></i>
                            แผนภาพรายเดือน</a>
                        <a href="report3.php" class="btn btn-info  "> <i class="fa fa-bar-chart"></i> แผนภาพรายปี</a>
                        <a onclick="<?php echo 'window.history.back(4);'; ?>" class="btn btn-default"> <i></i>
                            ย้อนกลับ</a>

                    </div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-6 -->

        <!-- /.col-lg-6 -->
    </div>
    <!-- /.row -->






    <?php } elseif ($_SESSION['staff-level'] == 'non-supervisor') { ?>

    <td class="text-center mb-m-2">ไม่มีสิทธิ์</td>

    <?php
            echo "<script type='text/javascript'>";
            echo "alert('เกิดข้อผิดพลาด ท่านไม่มีสิทธิ์   !!');";
            echo 'window.history.back(1);';
            echo '</script>';
            ?>
    <?php } elseif ($_SESSION['staff-level'] == '') { ?>

    <td class="text-center mb-m-2">ไม่มีสิทธิ์</td>

    <?php
            echo "<script type='text/javascript'>";
            echo "alert('เกิดข้อผิดพลาด ท่านไม่มีสิทธิ์   !!');";
            echo 'window.history.back(1);';
            echo '</script>';
            ?>
    <?php } elseif ($_SESSION['staff-level'] == 'non') { ?>

    <td class="text-center mb-m-2">ไม่มีสิทธิ์</td>

    <?php
            echo "<script type='text/javascript'>";
            echo "alert('เกิดข้อผิดพลาด ไม่มีสิทธิ์   !!');";
            echo 'window.history.back(1);';
            echo '</script>';
            ?>
    <?php }} ?>


    <?php if (
        isset($_SESSION['admin-user']) &&
        $_SESSION['admin-user'] !== ''
    ) { ?>


    <?php include 'data3.php'; ?>
    <div class="row">
        <div class="col-lg-12">
            <h3 class="card-header alert  btn-success"><i class="fa fa-bar-chart fa-fw"></i>
                แผนภาพสถิติผู้มาใช้บริการรายปี</h3>
        </div>
    </div>

    <!-- /.row -->
    <div class="row">

        <div class="col-lg-12">
            <div class="panel panel-default">

                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div id="morris-bar-chart"></div>
                    <br>
                    <br>
                    <p class="btn-success divider" style="height:3px;"></p>
                    <br>
                    <div class="text-center">
                        <a href="report.php" class="btn btn-primary  "> <i class="fa fa-bar-chart"></i> แผนภาพรายวัน</a>
                        <a href="report2.php" class="btn btn-success  "> <i class="fa fa-bar-chart"></i>
                            แผนภาพรายเดือน</a>
                        <a href="report3.php" class="btn btn-info  "> <i class="fa fa-bar-chart"></i> แผนภาพรายปี</a>
                        <a onclick="<?php echo 'window.history.back(4);'; ?>" class="btn btn-default"> <i></i>
                            ย้อนกลับ</a>

                    </div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-6 -->

        <!-- /.col-lg-6 -->
    </div>
    <!-- /.row -->

    <?php } ?>


</body>

</html>