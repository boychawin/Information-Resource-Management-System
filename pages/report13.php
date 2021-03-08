<?php
session_start(); 
require '../config/thai_date.php';
?>
<!DOCTYPE html>
<html>

<head>
    <title> หน้า | รายงานอุปกรณ์ชำรุด </title>
    <link rel="stylesheet" type="text/css" href="./css/main.css" media="print">
    <link rel="icon" type="image/png" href="../images/Snru_3.png" />
    <?php include_once 'h2.php'; ?>
</head>

<body>
    <?php if (
        isset($_SESSION['staff-user']) &&
        $_SESSION['staff-user'] !== ''
    ) { ?>
    <?php if ($_SESSION['staff-level'] == 'supervisor') { 
                    $fname = $_SESSION['staff-fname'];
                    $lname =$_SESSION['staff-lname'] ;
                    ?>


    <script langauge="javascript">
    window.print();
    </script>

    <div class="row">

        <div class="col-lg-12">
            <div class="col-lg-4">
                <img src="../images/irms-arit.png" width="250" height="50" class="img-fluid" href="/irms"
                    alt="มหาวิทยาลัยราชภัฏสกลนคร" class="logo">
                <hr>
                <p align='right'>สั่งพิมพ์วันที่<?php echo thai8(date('Y-m-d H:i:s'));?> </p>
            </div>

            <h3 class="alert alert-success" class="page-header alert btn-info"><i class="fa fa-table"></i>
                รายงานอุปกรณ์ชำรุด </h3>
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
                                    'SELECT * FROM tblmessage ORDER BY MessageID asc';
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
                                            <th width="15%">ประเภท</th>
                                            <th width="20%">หัวข้อ</th>
                                            <th width="30%">อธิบายปัญหา</th>
                                            <th width="15%">ชื่อผู้ร้องเรียน</th>
                                            <th width="15%">สถานะ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while (
                                                    $row = $result->fetch_object()
                                                ) {
                                                    if (
                                                        $row->Category ==
                                                        'แจ้งอุปกรณ์ชำรุด'
                                                    ) { ?>
                                        <tr>
                                            <td class="center"><?php echo $row->MessageID; ?> </td>
                                            <td class="center"><?php echo $row->Category; ?></td>


                                            <td class="center"><?php echo $row->MessageCODE; ?></td>
                                            <td class="center"><?php echo $row->MessageText; ?></td>
                                            <td class="center"><?php echo $row->ACCOUNT_USERNAME; ?></td>


                                            <td class="center"><?php
                                                            if (
                                                                $row->Mstatus ==
                                                                ''
                                                            ) {
                                                                echo 'รอยืนยัน';
                                                            }
                                                            if (
                                                                $row->Mstatus ==
                                                                'รับเรื่องแล้ว'
                                                            ) {
                                                                echo 'รับเรื่องแล้ว';
                                                            }
                                                            if (
                                                                $row->Mstatus ==
                                                                'แก้ไขแล้ว'
                                                            ) {
                                                                echo 'แก้ไขแล้ว';
                                                            } else {
                                                                //echo $row->action;
                                                            }
                                                            ?> </td>
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
                    <p align='center'>(<?php echo ""."$fname"." $lname" ?>) </p>
                    <p align='center'>วันที่<?php echo thai8(date('Y-m-d H:i:s'));?> </p>
                </div>
            </div>
        </div>
    </div>



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
                <img src="../images/irms-arit.png" width="250" height="50" class="img-fluid" href="/irms"
                    alt="มหาวิทยาลัยราชภัฏสกลนคร" class="logo">
                <hr>
                <p align='right'>สั่งพิมพ์วันที่<?php echo thai8(date('Y-m-d H:i:s'));?> </p>
            </div>

            <h3 class="alert alert-success" class="page-header alert btn-info"><i class="fa fa-table"></i>
                รายงานอุปกรณ์ชำรุด </h3>
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
                                'SELECT * FROM tblmessage ORDER BY MessageID asc';
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
                                            <th width="15%">ประเภท</th>
                                            <th width="20%">หัวข้อ</th>
                                            <th width="30%">อธิบายปัญหา</th>
                                            <th width="15%">ผู้ร้องเรียน</th>
                                            <th width="15%">สถานะ</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while (
                                                $row = $result->fetch_object()
                                            ) {
                                                if (
                                                    $row->Category ==
                                                    'แจ้งอุปกรณ์ชำรุด'
                                                ) { ?>
                                        <tr>
                                            <td class="center"><?php echo $row->MessageID; ?> </td>
                                            <td class="center"><?php echo $row->Category; ?></td>


                                            <td class="center"><?php echo $row->MessageCODE; ?></td>
                                            <td class="center"><?php echo $row->MessageText; ?></td>
                                            <td class="center"><?php echo $row->ACCOUNT_USERNAME; ?></td>


                                            <td class="center"><?php
                                                        if (
                                                            $row->Mstatus == ''
                                                        ) {
                                                            echo 'รอยืนยัน';
                                                        }
                                                        if (
                                                            $row->Mstatus ==
                                                            'รับเรื่องแล้ว'
                                                        ) {
                                                            echo 'รับเรื่องแล้ว';
                                                        }
                                                        if (
                                                            $row->Mstatus ==
                                                            'แก้ไขแล้ว'
                                                        ) {
                                                            echo 'แก้ไขแล้ว';
                                                        } else {
                                                            //echo $row->action;
                                                        }
                                                        ?> </td>
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
                    <p align='center'>(<?php echo ""."$afname"." $alname" ?>) </p>
                    <p align='center'>วันที่<?php echo thai8(date('Y-m-d H:i:s'));?> </p>

                </div>
            </div>
        </div>
    </div>



    <?php } ?>
</body>

</html>