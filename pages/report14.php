<?php
session_start();
require '../config/thai_date.php';
?>
<!DOCTYPE html>
<html>

<head>
    <title> หน้า | ยกเลิกการจอง </title>
    <link rel="stylesheet" type="text/css" href="./css/main.css" media="print">
    <link rel="icon" type="image/png" href="https://boychawin.com/logo.png" />
    <?php include_once 'h2.php'; ?>
</head>

<body>
    <?php if (
        isset($_SESSION['staff-user']) &&
        $_SESSION['staff-user'] !== ''
    ) { ?>
        <?php if ($_SESSION['staff-level'] == 'supervisor') {
            $fname = $_SESSION['staff-fname'];
            $lname = $_SESSION['staff-lname'];
        ?>
            <script langauge="javascript">
                window.print();
            </script>
            <div class="row">

                <div class="col-lg-12">
                    <div class="col-lg-4">
                        <a href="../pages/index" rel="home">
                            <img src="../images/logo.png" width="50" height="50" class="img-fluid" href="/irms" alt="boychawin.com" class="logo">&nbsp; แจกระบบจองห้อง/โต๊ะ
                        </a>
                        <hr>
                        <p align='right'>สั่งพิมพ์วันที่<?php echo thai8(date('Y-m-d H:i:s')); ?> </p>
                    </div>
                    <h3 class="alert alert-success" class="page-header alert btn-info"><i class="fa fa-table"></i> ยกเลิกการจอง
                    </h3>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                <div class="col-lg-12">

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">



                                <?php
                                include 'db_connect.php'; // เรียกใช้งานไฟล์เชื่อมต่อกับฐานข้อมูล
                                $mysqli = connect(); // เชื่อมต่อกับฐานข้อมูล
                                $sql =
                                    'SELECT * FROM booking_applications ORDER BY id asc';
                                $result = $mysqli->query($sql);
                                ?>

                                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                                <script>
                                    $(document).ready(function() {
                                        $("#myInput").on("keyup", function() {
                                            var value = $(this).val().toLowerCase();
                                            $("#myTable tr").filter(function() {
                                                $(this).toggle($(this).text().toLowerCase().indexOf(value) >
                                                    -1)
                                            });
                                        });
                                    });
                                </script>
                                <div class="panel-body">
                                    <div class="dataTable_wrapper">

                                        <table class="table table-bordered table-responsive-sm w-100" id="myTable">
                                            <thead>
                                                <tr>
                                                    <th width="5%">ลำดับ</th>
                                                    <th width="10%">รหัส</th>
                                                    <th width="10%">ชื่อผู้ร้องขอ</th>
                                                    <th width="11%">เริ่ม</th>
                                                    <th width="11%">สิ้นสุด</th>
                                                    <th width="25%">จุดประสงค์การเข้าใช้งาน</th>
                                                    <th width="20%">ประเภท</th>
                                                    <th width="13%">สถานะ</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while (
                                                    $row = $result->fetch_object()
                                                ) {
                                                    if (
                                                        $row->status == 'reject'
                                                    ) { ?>
                                                        <tr>
                                                            <td class="center"><?php echo $row->id; ?> </td>
                                                            <td class="center"><?php echo $row->staff_id; ?> </td>
                                                            <td class="center"><?php echo $row->staff_name; ?> </td>
                                                            <td class="center"><?php echo $row->booking_start_date; ?></td>
                                                            <td class="center"><?php echo $row->booking_end_date; ?></td>

                                                            <td class="center"><?php echo $row->purpose; ?></td>
                                                            <td class="center"><?php echo $row->booking_type; ?></td>

                                                            <td class="center"><?php if ($row->status == 'accept') {
                                                                                    echo "เข้าใช้งาน";
                                                                                } else {
                                                                                    echo "ไม่เข้าใช้งาน";
                                                                                } ?></td>

                                                        </tr>
                                                <?php }
                                                }
                                                //mysqli_close($db_con);
                                                ?>



                                            </tbody>
                                        </table>

                                    </div>
                                    <!-- /.table-responsive -->



                                </div>
                                <!-- /.panel .chat-panel -->
                            </div>
                            <p align='center'>................................................</p>
                            <p align='center'>(<?php echo "" . "$fname" . " $lname" ?>) </p>
                            <p align='center'>วันที่<?php echo thai8(date('Y-m-d H:i:s')); ?> </p>
                        </div>
                    </div>
                </div>
            </div>



        <?php } elseif ($_SESSION['staff-level'] == 'non-supervisor') { ?>

            <td class="text-center mb-m-2">ไม่มีสิทธิ์</td>

            <?php
            echo "<script type='text/javascript'>";
            echo "alert('เกิดข้อผิดพลาด ท่านไม่มีสิทธิ์ ระบบจะเก็บข้อมูลของท่านไว้  !!');";
            echo 'window.history.back(1);';
            echo '</script>';
            ?>
        <?php } elseif ($_SESSION['staff-level'] == '') { ?>

            <td class="text-center mb-m-2">ไม่มีสิทธิ์</td>

            <?php
            echo "<script type='text/javascript'>";
            echo "alert('เกิดข้อผิดพลาด ท่านไม่มีสิทธิ์ ระบบจะเก็บข้อมูลของท่านไว้  !!');";
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
    <?php }
    } ?>


    <?php if (
        isset($_SESSION['admin-user']) &&
        $_SESSION['admin-user'] !== ''
    ) {
        $afname = $_SESSION['admin-fname'];
        $alname = $_SESSION['admin-lname'];
    ?>

        <script langauge="javascript">
            window.print();
        </script>


        <div class="row">

            <div class="col-lg-12">
                <div class="col-lg-4">
                    <a href="../pages/index" rel="home">
                        <img src="../images/logo.png" width="50" height="50" class="img-fluid" href="/irms" alt="boychawin.com" class="logo">&nbsp; แจกระบบจองห้อง/โต๊ะ
                    </a>
                    <hr>
                    <p align='right'>สั่งพิมพ์วันที่<?php echo thai8(date('Y-m-d H:i:s')); ?> </p>
                </div>
                <h3 class="alert alert-success" class="page-header alert btn-info"><i class="fa fa-table"></i> ยกเลิกการจอง
                </h3>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="col-lg-12">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">



                            <?php
                            include 'db_connect.php'; // เรียกใช้งานไฟล์เชื่อมต่อกับฐานข้อมูล
                            $mysqli = connect(); // เชื่อมต่อกับฐานข้อมูล
                            $sql =
                                'SELECT * FROM booking_applications ORDER BY id asc';
                            $result = $mysqli->query($sql);
                            ?>


                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                            <script>
                                $(document).ready(function() {
                                    $("#myInput").on("keyup", function() {
                                        var value = $(this).val().toLowerCase();
                                        $("#myTable tr").filter(function() {
                                            $(this).toggle($(this).text().toLowerCase().indexOf(value) >
                                                -1)
                                        });
                                    });
                                });
                            </script>
                            <div class="panel-body">
                                <div class="dataTable_wrapper">

                                    <table class="table table-bordered table-responsive-sm w-100" id="myTable">
                                        <thead>
                                            <tr>
                                                <th width="5%">ลำดับ</th>
                                                <th width="10%">รหัส</th>
                                                <th width="10%">ชื่อผู้ร้องขอ</th>
                                                <th width="11%">เริ่ม</th>
                                                <th width="11%">สิ้นสุด</th>
                                                <th width="25%">จุดประสงค์การเข้าใช้งาน</th>
                                                <th width="20%">ประเภท</th>
                                                <th width="13%">สถานะ</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while (
                                                $row = $result->fetch_object()
                                            ) {
                                                if (
                                                    $row->status == 'reject'
                                                ) { ?>
                                                    <tr>
                                                        <td class="center"><?php echo $row->id; ?> </td>
                                                        <td class="center"><?php echo $row->staff_id; ?> </td>
                                                        <td class="center"><?php echo $row->staff_name; ?> </td>
                                                        <td class="center"><?php echo $row->booking_start_date; ?></td>
                                                        <td class="center"><?php echo $row->booking_end_date; ?></td>

                                                        <td class="center"><?php echo $row->purpose; ?></td>
                                                        <td class="center"><?php echo $row->booking_type; ?></td>

                                                        <td class="center"><?php if ($row->status == 'accept') {
                                                                                echo "เข้าใช้งาน";
                                                                            } else {
                                                                                echo "ไม่เข้าใช้งาน";
                                                                            } ?></td>

                                                    </tr>
                                            <?php }
                                            }
                                            //mysqli_close($db_con);
                                            ?>



                                        </tbody>
                                    </table>

                                </div>
                                <!-- /.table-responsive -->



                            </div>
                            <!-- /.panel .chat-panel -->
                        </div>
                        <p align='center'>................................................</p>
                        <p align='center'>(<?php echo "" . "$afname" . " $alname" ?>) </p>
                        <p align='center'>วันที่<?php echo thai8(date('Y-m-d H:i:s')); ?> </p>

                    </div>
                </div>
            </div>
        </div>

    <?php } ?>
</body>

</html>