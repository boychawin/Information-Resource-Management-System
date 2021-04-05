<!DOCTYPE html>
<html lang="en">
<title> </title>

<head>
    <link rel="icon" type="image/png" href="https://boychawin.com/logo.png" />
    <meta charset="utf-8">
    <meta name="author" content="Group One">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $("#myInput3").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable3 tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>

</head>

<body background="../images/bg-arit-big.png">


    <?php
    require '../config/thai_date.php';
    include_once 'header.php';

    if (!isset($_SESSION['staff-user']) && $_SESSION['staff-user'] == '') {
        echo "<script>location.href = 'index.php';</script>";
    } else {
        $staff_username = $_SESSION['staff-user'];

        $staff_email = $_SESSION['staff-email'];

        $staff_id = $_SESSION['staff-id'];

        $res = query_db(
            "SELECT * FROM employee WHERE username = '$staff_username'"
        );

        $id = $res->staff_id;

        $level = $res->staff_level;

        $total_reject = $res->total_reject;

        $fname1 = $res->fname;
        $lname1 = $res->lname;

        $Faculty = $res->Faculty;

        $day_reject = $res->day_reject;
        $day_rejectend = $res->day_rejectend;
        $date_registered = $res->date_registered;
        $username = $res->username;

        //include_once 'dash-header.php';

        echo "<div class='col-md-12'>" . "<div class='main-content '>";

        show_alert();

        if (isset($_GET['tab']) && $_GET['tab'] == 1) {
            echo "<h1 class='text-center hide'> </h1> ";

            $tabs = <<<PHP
        <h1 class='text-center hide'>หน้า | สถานะการจอง</h1>
            <ul class="nav nav-tabs nav-fill" id="tab_content" role="tablist">

                <li class="nav-item">
                    <a class="nav-link active" id="rejected-tab" data-toggle="tab"
                        href="#rejected" role="tab" aria-controls="rejected" aria-selected="false">
                    <i class="fa fa-close"></i>
                    <span class="extra-sm break"> <span class="extra-sm"> ยกเลิก  </span></span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" id="accepted-tab" data-toggle="tab"
                        href="#accepted" role="tab" aria-controls="accepted"
                            aria-selected="false">
                        <i class="fa fa-handshake-o"></i>
                        <span class="extra-sm break"><span class="extra-sm"> ได้รับอนุมัติ  </span></span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" id="no-action-tab" data-toggle="tab"
                        href="#no-action" role="tab" aria-controls="no-action"
                            aria-selected="true">
                        <i class="fa fa-refresh"></i>
                        <span class="extra-sm break"> <span class="extra-sm"> รออนุมัติ  </span></span>
                    </a>
                </li>
            </ul>
PHP;
            echo $tabs . '<div class="tab-content" id="tab">';

            $result = $db_con->query(
                "SELECT * FROM booking_applications WHERE staff_id = $staff_id and action = 'reject' ORDER BY id DESC"
            );

            echo '<div class="tab-pane fade show active p-12" role="tabpanel"
                aria-labelledby="rejected-tab" id="rejected">';

            if ($result->num_rows > 0) {
                echo '<div class="card mb-md-5">
                <h2 class="text-md text-center"> <span class="extra-sm"> เช็คสถานะการจอง  </span></h2>
                    <table class="table table-bordered table-responsive-sm w-100">

                        <thead >
                            <th>ลำดับ</th>
                            <th> ประเภท</th>
                            <th>เหตุผล</th>
                            <th>วันที่ถูกปฏิเสธ</th>
                            <th>การดําเนินการ</th>
                        </thead>';

                while ($row = $result->fetch_object()) {
                    $reason =
                        strlen($row->reason_reject) > 0
                        ? substr($row->reason_reject, 0, 15)
                        : 'ไม่มีเหตุผล';

                    $reasons = nl2br($row->reason_reject);
                    $r = <<<PP
                        <tr id='to-be-removed_$row->id'>

                            <td>$row->id</td>
                            <td>$row->booking_type</td>
                            <td>$reason...</td>

                            <td>
                                $row->date_requested
                             </td>
                            <td>
                                <button class="btn details" id="$row->id">
                                   <span class="extra-sm"> รายละเอียด  </span>
                                </button>
                            </td>
                        </tr>

                        <tr id='to-replace_$row->id' class='hide'>

                            <td colspan="4">$reasons</td>
                            <td>
                                <button class="btn text-sm back-btn" name="$row->id"
                                    id="replace_$row->id">
                                    <small>Back</small>
                                </button>
                            </td>
                        </tr>
PP;
                    echo $r;
                }

                echo "</table>
             </div>";
            } else {
                echo '<br><h2 class="text-center mb-5">ไม่มีข้อมูลที่สามารถใช้ได้</h2>';
            }

            echo '</div>';

            $result = $db_con->query(
                "SELECT * FROM booking_applications WHERE staff_id = $staff_id and action = 'accept'ORDER BY id DESC"
            );

            echo '<div class="tab-pane fade show p-12" role="tabpanel"
                aria-labelledby="accepted-tab" id="accepted">';
            if ($result->num_rows > 0) {
                echo '<div class="card">
                    <table class="table table-bordered table-responsive-sm w-100">

                        <thead >
                            <th>ลำดับ</th>
                            <th> รหัส</th>
                            <th> ประเภท</th>
                            <th>วันที่ได้รับอนุมัติ</th>
                        </thead>';

                while ($row = $result->fetch_object()) {
                    // $type = ucwords(implode(' ',explode('_',$row->booking_type)));

                    echo "<tr>
                         <td>$row->id</td>
                        <td>$row->booking_id</td>
                        <td>$row->booking_type</td>
                        <td>
                            $row->date_requested
                        </td>
                    </tr>";
                }

                echo "</table>
           </div>";
            } else {
                echo '<br><h2 class="text-center mb-5">ไม่มีข้อมูลที่สามารถใช้ได้</h2>';
            }

            echo ' </div>';

            $result = $db_con->query(
                "SELECT * FROM booking_applications WHERE action IS NULL  and staff_id = $staff_id "
            );

            echo '<div class="tab-pane fade show p-12" role="tabpanel"
        aria-labelledby="no-action-tab" id="no-action">';
            if ($result->num_rows > 0) {
                echo '<div class="card">
                    <table class="table table-bordered table-responsive-sm w-100">

                        <thead >
                            <th>ลำดับ</th>
                            <th> รหัส</th>
                            <th> ประเภท</th>
                            
                            <th>วันที่ร้องขอ</th>
                        </thead>';

                while ($row = $result->fetch_object()) {
                    $type = ucwords(
                        implode(' ', explode('_', $row->booking_type))
                    );

                    echo "<tr>
                         <td>$row->id</td>
                        <td>$row->booking_id</td>

                        <td>$type</td>

                        

                        <td>
                            $row->date_requested
                        </td>
                    </tr>";
                }

                echo "</table>
           </div>";
            } else {
                echo '<br><h2 class="text-center mb-5">ไม่มีข้อมูลที่สามารถใช้ได้</h2>';
            }

            echo '</div>';
        } elseif (isset($_GET['tab']) && $_GET['tab'] == 2) {
            echo ' ';
            if ($level == 'supervisor') {
                $stmt = $db_con->query('SELECT * FROM booking_applications');

                $rows = $stmt->num_rows;

                if ($rows > 0) {
                    echo "<h1 class='text-center hide'>หน้า | ข้อมูลการจองทั้งหมด</h1>";
                    echo "
                    <div class='card-header alert-success text-black'><h3 class='text-center text-md'>รายงานข้อมูลการจองทั้งหมด</h3></div>
                     
                      
                    <div class='content mb-lg-5'>
                    
                    <input  class='form-control'id='myInput3' type='text' placeholder='ค้นหาข้อมูล ลำดับ, ประเภท'><br>
                    <table class='table table-bordered table-responsive-sm w-100'id='myTable3'>
                        <thead >
                        <th class='extra-sm' width='5%'>ลำดับ</th>
                        <th class='extra-sm' width='15%'>เริ่ม</th>
                        <th class='extra-sm' width='15%'>สิ้นสุด</th>
                        <!-- <th class='extra-sm'width='30%'>จุดประสงค์การเข้าใช้งาน</th> -->
                        <th class='extra-sm' width='15%'>วันเวลาที่ร้องขอ</th>
                        <th class='extra-sm' width='45%'>ประเภท</th>
                        <th class='extra-sm' width='5%'>สถานะ</th>

                        </thead>";

                    while ($rs = $stmt->fetch_object()) {
                        $result = $db_con->query(
                            "SELECT * FROM booking_applications WHERE staff_id = $staff_id'"
                        );

                        // $level = ucwords($row->action);
                        if ($rs->action == 'accept') {
                            $status =
                                "<button  class='btn btn-success btn-sm'>" .
                                "<i class='fa fa-check pr-2'class='extra-sm'></i> อนุมัติ </button>";
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
                        <tr class="extra-sm">
                            <td class="extra-sm"><?php echo $rs->id; ?> </td>
                            <td class="extra-sm"><?php echo thai8(
                                                        $rs->booking_start_date
                                                    ); ?></td>
                            <td class="extra-sm"><?php echo thai8(
                                                        $rs->booking_end_date
                                                    ); ?></td>
                            <td class="extra-sm" class="center"><?php echo thai8(
                                                                    $rs->date_requested
                                                                ); ?></td>
                            <td class="extra-sm" class="center"><?php echo $rs->booking_type; ?></td>
                            <td class="extra-sm" class="center"><?php if (
                                                                    $rs->action == 'accept'
                                                                ) {
                                                                    echo $status2;
                                                                } else {
                                                                    echo $status;
                                                                } ?></td>

                        </tr>
                    <?php

                    }

                    echo "</table>
                </div>";
                }
            } else {
                echo "<h1 class='text-center text-md mb-lg'>ไม่มีอะไรข้อมูลให้แสดง</h1>";
            }
        } elseif (isset($_GET['tab']) && $_GET['tab'] == 3) {
            echo "<h1 class='text-center hide'> หน้า | </h1> ";
            include_once 'stats.php';
        } elseif (isset($_GET['tab']) && $_GET['tab'] == 4) {
            echo "<h1 class='text-center hide'> </h1> ";
            include_once 'account.php';
        } elseif (isset($_GET['tab']) && $_GET['tab'] == 5) {
            echo "<h1 class='text-center hide'>หน้า | รายงาน</h1> ";

            $result = $db_con->query(
                "SELECT * FROM booking_applications WHERE staff_id = $id"
            );

            echo '<div class="card mb-md-5">
            <h4 class="alert alert-success" class="page-header alert btn-info"><i class="fa fa-table"></i> รายการจอง</h4>
<input  class="form-control"id="myInput" type="text" placeholder="ค้นหาข้อมูล ลำดับและประเภท..."><br>

    <table class="table table-bordered table-responsive-sm w-100" id="myTable">

            <thead >
            <th class="extra-sm" width="5%">ลำดับ</th>
            <th class="extra-sm" width="15%">เริ่ม</th>
            <th class="extra-sm" width="15%">สิ้นสุด</th>
            <th class="extra-sm" width="15%">วันเวลาที่ร้องขอ</th>
            <th class="extra-sm" width="45%">ประเภท</th>
            <th class="extra-sm" width="5%">สถานะ</th>
            
            </thead>';

            if ($result->num_rows > 0) {
                while ($rs = $result->fetch_object()) {
                    if ($rs->action == 'accept') {
                        $status =
                            "<button  class='btn btn-success btn-sm'>" .
                            "<i class='fa fa-check pr-2'class='extra-sm'></i> อนุมัติ </button>";
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


                    $type = ucfirst($rs->booking_type) . ' ';
                    ?>


                    <tr class="extra-sm">
                        <td class="extra-sm"><?php echo $rs->id; ?> </td>
                        <td class="extra-sm"><?php echo thai8(
                                                    $rs->booking_start_date
                                                ); ?></td>
                        <td class="extra-sm"><?php echo thai8(
                                                    $rs->booking_end_date
                                                ); ?></td>
                        <td class="extra-sm" class="center"><?php echo thai8(
                                                                $rs->date_requested
                                                            ); ?></td>
                        <td class="extra-sm" class="center"><?php echo $rs->booking_type; ?></td>
                        <td class="extra-sm" class="center"><?php if (
                                                                $rs->action == 'accept'
                                                            ) {
                                                                echo $status2;
                                                            } else {
                                                                echo $status;
                                                            } ?></td>

                    </tr>

            <?php          }
            } else {
                echo '<tr><td class="text-center mb-m-2">ไม่มีข้อมูลการจอง</td></tr>';
            }

            echo '</table></div>';
        } elseif (isset($_GET['tab']) && $_GET['tab'] == 6) {
            include_once 'new-request.php';
        } elseif (isset($_GET['tab']) && $_GET['tab'] == 7) {
            include_once 'pending.php';
        } elseif (isset($_GET['tab']) && $_GET['tab'] == 8) {
            include_once 'user/createmessage.php';
        } elseif (isset($_GET['tab']) && $_GET['tab'] == 9) {
            include_once 'admin/Mindex.php';
        } elseif (isset($_GET['tab']) && $_GET['tab'] == 13) {
            include_once 'admin/chart.php';
        } elseif (isset($_GET['tab']) && $_GET['tab'] == 14) {
            include_once 'pending2.php';
        } elseif (isset($_GET['tab']) && $_GET['tab'] == 15) {
            include_once 'Messageupdateform.php';
        } elseif (isset($_GET['tab']) && $_GET['tab'] == 16) {
            include_once 'admin/report1.php';
        } elseif (isset($_GET['tab']) && $_GET['tab'] == 17) {
            include_once 'admin/report2.php';
        } elseif (isset($_GET['tab']) && $_GET['tab'] == 18) {
            include_once 'admin/report3.php';
        } elseif (isset($_GET['tab']) && $_GET['tab'] == 19) {
            include_once 'registera.php';
        } else {
            ?>
            <div class="row">
                <div class="col-md-12 mb-3 mx-auto">
                    <h1 class='text-center hide'>หน้า | แผงควบคุม</h1>
                    <div class="row">
                        <div class="container mb-12 p-4">
                            <h4 class="extra-sm" class="text-center">
                                ยินดีต้อนรับคุณ :&nbsp;<?php echo $res->fname; ?>&nbsp;<?php echo $res->lname; ?></h4>
                            <p></p>
                            <p></p>
                            <p>
                            </p>
                            <h5></h5>
                            <quote class="float-right mute muted">
                                <i> <img src="../images/aritsnru.jpg" class="img-thumbnail" alt="Nature" style="width:100%"></i><br>
                                <span></span><br>

                                <?php if ($level == 'supervisor') { ?>
                                    <div class="row mb-2">
                                        <div class="col-md-3 mb-md-2">
                                            <div class="alert alert-success" role="alert"><span class="extra-sm"> จำนวนสมาชิกทั้งหมด </span> <?php
                                                                                                                                                include 'db_connect.php'; // เรียกใช้งานไฟล์เชื่อมต่อกับฐานข้อมูล
                                                                                                                                                $db_con = connect(); // เชื่อมต่อกับฐานข้อมูล
                                                                                                                                                ($query =
                                                                                                                                                    'SELECT COUNT(*) AS id FROM employee');
                                                                                                                                                $result = mysqli_query(
                                                                                                                                                    $db_con,
                                                                                                                                                    $query
                                                                                                                                                );

                                                                                                                                                while (
                                                                                                                                                    $row = mysqli_fetch_array(
                                                                                                                                                        $result
                                                                                                                                                    )
                                                                                                                                                ) {
                                                                                                                                                    echo '<tr>';

                                                                                                                                                    echo '<h3>' .
                                                                                                                                                        $row['id'] .
                                                                                                                                                        '</h3>';

                                                                                                                                                    echo '</tr>';
                                                                                                                                                }
                                                                                                                                                ?>
                                                <i class="fa fa-users"></i>

                                                <a href="" class="extra-sm" class="small-box-footer">ข้อมูลเพิ่มเติม <i class="fa fa-arrow-circle-right"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-md-2">
                                            <div class="alert alert-primary" role="alert"><span class="extra-sm"> จำนวนห้อง/โต๊ะจองทั้งหมด </span>
                                                <?php
                                                // include("db_connect.php"); // เรียกใช้งานไฟล์เชื่อมต่อกับฐานข้อมูล
                                                $db_con = connect(); // เชื่อมต่อกับฐานข้อมูล
                                                ($query =
                                                    'SELECT COUNT(*) AS id FROM booking');
                                                $result = mysqli_query(
                                                    $db_con,
                                                    $query
                                                );

                                                while (
                                                    $row = mysqli_fetch_array(
                                                        $result
                                                    )
                                                ) {
                                                    echo '<tr>';
                                                    $b = $row['id'] - 1;
                                                    echo '<h3>' .
                                                        $b .
                                                        '</h3>';
                                                    echo '</tr>';
                                                }
                                                ?>
                                                <i class="fa fa-map-marker"></i>

                                                <a href="index.php?tab=5" class="extra-sm" class="small-box-footer">ข้อมูลเพิ่มเติม <i class="fa fa-arrow-circle-right"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-md-2">
                                            <div class="alert alert-info" role="alert"><span class="extra-sm"> จำนวนการจองทั้งหมด </span>
                                                <?php
                                                $db_con = connect(); // เชื่อมต่อกับฐานข้อมูล
                                                ($query =
                                                    'SELECT COUNT(*) AS id FROM booking_applications ');
                                                $result = mysqli_query(
                                                    $db_con,
                                                    $query
                                                );

                                                while (
                                                    $row = mysqli_fetch_array(
                                                        $result
                                                    )
                                                ) {
                                                    echo '<tr>';

                                                    echo '<h3>' .
                                                        $row['id'] .
                                                        '</h3>';

                                                    echo '</tr>';
                                                }
                                                ?>
                                                <i class="fa fa-user-plus"></i>

                                                <a href="dashboard.php?tab=5" class="extra-sm" class="small-box-footer">ข้อมูลเพิ่มเติม <i class="fa fa-arrow-circle-right"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-md-2">

                                            <div class="alert alert-warning" role="alert"> <span class="extra-sm"> จำนวนแจ้ง/ร้องเรียนทั้งหมด </span>
                                                <?php
                                                // include("db_connect.php"); // เรียกใช้งานไฟล์เชื่อมต่อกับฐานข้อมูล
                                                $db_con = connect(); // เชื่อมต่อกับฐานข้อมูล
                                                ($query =
                                                    'SELECT COUNT(*) AS id FROM tblmessage');
                                                $result = mysqli_query(
                                                    $db_con,
                                                    $query
                                                );

                                                while (
                                                    $row = mysqli_fetch_array(
                                                        $result
                                                    )
                                                ) {
                                                    echo '<tr>';

                                                    echo '<h3>' .
                                                        $row['id'] .
                                                        '</h3>';

                                                    echo '</tr>';
                                                }
                                                ?>
                                                <i class="fa fa-paper-plane"></i>

                                                <a href="dashboard.php?tab=9" class="extra-sm" class="small-box-footer">ข้อมูลเพิ่มเติม <i class="fa fa-arrow-circle-right"></i></a>
                                            </div>
                                        </div>

                                    <?php } elseif (
                                    $level == 'non-supervisor'
                                ) { ?>

                                        <div class="row mb-2">

                                            <div class="col-md-3 mb-md-2">
                                                <div class="alert alert-primary" role="alert"><span class="extra-sm"> จำนวนห้อง/โต๊ะ </span>
                                                    <?php
                                                    include 'db_connect.php'; // เรียกใช้งานไฟล์เชื่อมต่อกับฐานข้อมูล
                                                    $db_con = connect(); // เชื่อมต่อกับฐานข้อมูล
                                                    ($query =
                                                        'SELECT COUNT(*) AS id FROM booking');
                                                    $result = mysqli_query(
                                                        $db_con,
                                                        $query
                                                    );

                                                    while (
                                                        $row = mysqli_fetch_array(
                                                            $result
                                                        )
                                                    ) {
                                                        echo '<tr>';
                                                        $b = $row['id'] - 1;
                                                        echo '<h3>' .
                                                            $b .
                                                            '</h3>';

                                                        echo '</tr>';
                                                    }
                                                    ?>
                                                    <i class="fa fa-map-marker"></i>

                                                    <a href="index.php?tab=5" class="extra-sm" class="small-box-footer">ข้อมูลเพิ่มเติม <i class="fa fa-arrow-circle-right"></i></a>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-md-2">
                                                <div class="alert alert-info" role="alert"><span class="extra-sm"> จำนวนการจองของฉัน </span>
                                                    <?php
                                                    $db_con = connect(); // เชื่อมต่อกับฐานข้อมูล
                                                    ($query = "SELECT COUNT(*) AS id FROM booking_applications WHERE staff_id = '$staff_id'");
                                                    $result = mysqli_query(
                                                        $db_con,
                                                        $query
                                                    );

                                                    while (
                                                        $row = mysqli_fetch_array(
                                                            $result
                                                        )
                                                    ) {
                                                        echo '<tr>';

                                                        echo '<h3>' .
                                                            $row['id'] .
                                                            '</h3>';

                                                        echo '</tr>';
                                                    }
                                                    ?>
                                                    <i class="fa fa-user-plus"></i>

                                                    <a href="dashboard.php?tab=5" class="extra-sm" class="small-box-footer">ข้อมูลเพิ่มเติม <i class="fa fa-arrow-circle-right"></i></a>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-md-2">

                                                <div class="alert alert-warning" role="alert"> <span class="extra-sm"> จำนวนแจ้ง/ร้องเรียนของฉัน </span>
                                                    <?php
                                                    // include("db_connect.php"); // เรียกใช้งานไฟล์เชื่อมต่อกับฐานข้อมูล
                                                    $db_con = connect(); // เชื่อมต่อกับฐานข้อมูล
                                                    ($query = "SELECT COUNT(*) AS id FROM tblmessage WHERE IDNO = '$staff_id'");
                                                    $result = mysqli_query(
                                                        $db_con,
                                                        $query
                                                    );

                                                    while (
                                                        $row = mysqli_fetch_array(
                                                            $result
                                                        )
                                                    ) {
                                                        echo '<tr>';

                                                        echo '<h3>' .
                                                            $row['id'] .
                                                            '</h3>';

                                                        echo '</tr>';
                                                    }
                                                    ?>
                                                    <i class="fa fa-paper-plane"></i>

                                                    <a href="dashboard.php?tab=8" class="extra-sm" class="small-box-footer">ข้อมูลเพิ่มเติม <i class="fa fa-arrow-circle-right"></i></a>
                                                </div>
                                            </div>
                                        <?php } ?>
                            </quote>
                            <br><br><br>
                        </div>
                    </div>
                </div>
            </div>
    <?php
        }

        echo '</div></div></div>';
    }

    include_once 'footer.php';
    ?>
    <script>
        $(".details").click(function() {
            var id = this.id;

            $("#to-be-removed_" + id).fadeOut("slow", function() {

                $("#to-replace_" + id).fadeIn("slow");
            })
        })

        $(".back-btn").click(function() {
            var id = this.id;
            name = this.name;

            $("#to-" + id).fadeOut("slow", function() {
                $("#to-be-removed_" + name).fadeIn();
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $(window).scroll(function() {
                if ($(this).scrollTop() > 50) {
                    $('#back-to-top').fadeIn();
                } else {
                    $('#back-to-top').fadeOut();
                }
            });
            // scroll body to 0px on click
            $('#back-to-top').click(function() {
                $('#back-to-top').tooltip('hide');
                $('body,html').animate({
                    scrollTop: 0
                }, 800);
                return false;
            });

            $('#back-to-top').tooltip('show');

        });
    </script>
    <style>
        .back-to-top {
            cursor: pointer;
            position: fixed;
            bottom: 20px;
            right: 20px;
            display: none;
        }
    </style>
    <a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button" data-toggle="tooltip" data-placement="left"><i class="fa fa-chevron-up"></i></a>
</body>

</html>