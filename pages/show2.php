<!DOCTYPE html>
<html lang="en">
<title>ปฏิทินผู้มาใช้บริการ </title>
<!-- Bootstrap Core CSS -->
<link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="./css/main.css" rel="stylesheet">
<!-- Custom Fonts -->
<link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<!-- jQuery -->
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Custom Theme JavaScript -->
</script>
<?php
if (isset($_GET['id'])) {
    $_GET['id'];
} else {
    $_GET['id'] = '';
}
include 'db_connect.php'; // เรียกใช้งานไฟล์เชื่อมต่อกับฐานข้อมูล
$mysqli = connect(); // เชื่อมต่อกับฐานข้อมูล
include '../config/thai_date.php';
$sql = "SELECT * FROM booking_applications WHERE id ='" . $_GET['id'] . "'  ";
$result = $mysqli->query($sql);
$rs = $result->fetch_object();
if ($rs->action == 'accept') {
    $status =
        "<button class='btn btn-success btn-sm'>" .
        "<i class='fa fa-check pr-2'></i> อนุมัติ </button>";
} elseif ($rs->action == 'reject') {
    $status =
        "<button class='btn btn-danger btn-sm'>" .
        "<i class='fa fa-remove pr-2'></i> ไม่อนุมัติ</button>";
} else {
    $status =
        "<button class='btn btn-warning btn-sm'>" .
        "<i class='fa fa-refresh pr-2'></i>  รออนุมัติ</button>";
}

if ($rs->status == 'accept') {
    $status2 =
        "<button class='btn btn-success btn-sm'>" .
        "<i class='fa fa-check pr-2'></i> เข้าใช้งานแล้ว </button>";
} elseif ($rs->status == 'reject') {
    $status2 =
        "<button class='btn btn-danger btn-sm'>" .
        "<i class='fa fa-remove pr-2'></i> อนุมัติ / ยกเลิก</button>";
} elseif ($rs->status == 'Suspend') {
    $status2 =
        "<div class='btn btn-danger btn-sm'>" .
        "<i class='fa fa-remove pr-2'></i> อนุมัติ / ยกเลิก</div>";
} else {
    $status2 =
        "<button class='btn btn-primary btn-sm'>" .
        "<i class='fa fa-refresh pr-2'></i>  อนุมัติ / รอใช้</button>";
}
?>


<div id="wrapper">



    <div class="row">

        <div class="col-lg-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    รายละเอียดการขอใช้บริการ
                </div>
                <div class="panel-body">
                    <button class="btn btn-info btn-sm"> ผู้ขอใช้ </button>
                    <div class="alert alert-success">
                        <?php echo $rs->staff_name; ?>
                    </div>
                    <button class="btn btn-info btn-sm"> วัน-เวลาใช้ห้อง </button>
                    <div class="alert alert-info">
                        เริ่ม <?php echo thai8(
                                    $rs->booking_start_date
                                ); ?> - <?php echo thai8($rs->booking_end_date); ?>
                    </div>

                    <button class="btn btn-info btn-sm"> จุดประสงค์การเข้าใช้งาน </button>
                    <div class="alert alert-info">
                        <?php echo $rs->purpose; ?>
                    </div>
                    <button class="btn btn-info btn-sm"> ห้อง/โต๊ะ </button>
                    <div class="alert alert-success">
                        <?php echo $rs->booking_type; ?>
                    </div>

                    <button class="btn btn-info btn-sm"> สถานะ </button>
                    <!--                            
                                <?php
                                echo $status;
                                echo '&nbsp;';
                                echo $status2;
                                ?>  -->

                    <?php if ($rs->action == 'accept') {
                        echo $status2;
                    } else {
                        echo $status;
                    } ?>
                </div><!-- .panel-body -->

            </div> <!-- panel panel-default -->
        </div> <!-- col-lg-6 -->


    </div><!-- row -->
</div>