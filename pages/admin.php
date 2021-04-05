<!DOCTYPE html>
<html lang="en">

<head>
    <title> </title>
    <link rel="icon" type="image/png" href="https://boychawin.com/logo.png" />
    <meta charset="utf-8">
    <meta name="author" content="Group One">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
    include_once 'header.php';
    $p = 'SELECT COUNT(*) FROM table_name';
    if (isset($_SESSION['admin-user']) && $_SESSION['admin-user'] !== '') {

        $username = $_SESSION['admin-user'];

        $id = $_SESSION['admin-id'];

        $result = $db_con->query(
            "SELECT * FROM admin WHERE username = '$username'"
        );

        if ($result->num_rows == 1) {
            $row = $result->fetch_object();

            $fullname = $row->fname . ' ' . $row->lname;
        }

        //include_once 'dash-header.php';

        echo "<div class='col-md-12''>" . "<div class='main-content '>";
        show_alert();
        $date_posted = date('Y-m-d');
        $time_posted = date('h:m:sa', time());

        if (isset($_GET['tab']) && $_GET['tab'] == 1) {
            echo " <h1 class='text-center hide'>หน้า | เพิ่มหัวข้อในการจองใหม่</h1>

               <form action='booking.php' method='post' class='mb-5'>
               
                   <label for='booking-type'>เพิ่มหัวข้อในการจองใหม่</label><br> 
                   <input type='text' placeholder='เช่น ห้องสร้างสุข' name='booking_type' id='booking-type'class='selectable' required><br><hr>
                       <option value=''></option>";
            foreach ($booking_types as $key => $value) {
                "<option value='$key'>$value</option>";
            }
            unset($booking_types);

            $booking_id = rand(10, 20) . date('U');

            $date_now = date('U') + 2591590;

            $auto_date = date('U') + 2591590;

            $dif = intval($date_now) - intval($auto_date);

            echo "
               
                   <label for='title'> วันที่อนุญาต</label><br>
                           
                   <input type='number' min='0' name='allowed_days' id='days' required><br>
                   <div id='hint' class='hide text-red'>
                   
                       <ul style='list-style-type:none;font-size:13px;'><br>
                           <b>โน้ต:</b>
                           <li> 0 หมายถึงไม่จำกัด</li>
                           <li> 1 วันขึ้นไปแสดงเวลาจริง</li>
                  
                       </ul>
                   </div><hr>
                   <label for='title'> วันที่เพิ่ม</label><br>
                   <input type='text' name='allowed_monthly_days' value='$date_posted' readonly required>       
                  
                   
                   <input type='hidden' name='booking_id' value='$booking_id'>
                   <input type='hidden' name='auto_update' value='$auto_date'>
                   <hr>
                   <label>เลือกผู้ที่สามารถใช้ได้</label><br>
                   <select name='staff_level' class='selectable'>
                       <option value='supervisor'>เจ้าหน้าที่</option>
                       <option value='non-supervisor'>สมาชิก</option>
                   </select>

                   <hr><button class='btn btn-primary ml-md-5' name='new_booking'>เผยแพร่</button>

               </form><hr><br>";
        } elseif (isset($_GET['tab']) && $_GET['tab'] == 2) {
            include_once 'approve.php';
        } elseif (isset($_GET['tab']) && $_GET['tab'] == 3) {
            include_once 'pending-booking.php';
        } elseif (isset($_GET['tab']) && $_GET['tab'] == 4) {
            include_once 'account.php';
        } elseif (isset($_GET['tab']) && $_GET['tab'] == 5) {
            include_once 'assign.php';
        } elseif (isset($_GET['tab']) && $_GET['tab'] == 6) {
            include 'new-request.php';
        } elseif (isset($_GET['tab']) && $_GET['tab'] == 7) {
            include 'new.php';
        } elseif (isset($_GET['tab']) && $_GET['tab'] == 8) {
            include 'booking-meta.php';
        } elseif (isset($_GET['tab']) && $_GET['tab'] == 9) {
            include 'showlocation.php';
        } elseif (isset($_GET['tab']) && $_GET['tab'] == 10) {
            include 'admin/Mindex.php';
        } elseif (isset($_GET['tab']) && $_GET['tab'] == 11) {
            include 'admin/Uindex.php';
        } elseif (isset($_GET['tab']) && $_GET['tab'] == 12) {
            include 'admin/report1.php'; //report1.php
        } elseif (isset($_GET['tab']) && $_GET['tab'] == 13) {
            include 'admin/report2.php';
        } elseif (isset($_GET['tab']) && $_GET['tab'] == 14) {
            include 'admin/report3.php';
        } elseif (isset($_GET['tab']) && $_GET['tab'] == 15) {
            include 'admin/chart.php';
        } elseif (isset($_GET['tab']) && $_GET['tab'] == 16) {
            include_once 'pending.php';
        } elseif (isset($_GET['tab']) && $_GET['tab'] == 17) {
            include_once 'C1inform.php';
        } elseif (isset($_GET['tab']) && $_GET['tab'] == 18) {
            include_once 'Messageupdateform.php';
        } elseif (isset($_GET['tab']) && $_GET['tab'] == 19) {
            include_once 'report12.php';
        } elseif (isset($_GET['tab']) && $_GET['tab'] == 20) {
            include_once 'report13.php';
        } elseif (isset($_GET['tab']) && $_GET['tab'] == 21) {
            include_once 'report14.php';
        } elseif (isset($_GET['tab']) && $_GET['tab'] == 22) {
            include_once 'locationupdateform.php';
        } elseif (isset($_GET['tab']) && $_GET['tab'] == 23) {
            include_once 'locationInsertform.php';
        } elseif (isset($_GET['tab']) && $_GET['tab'] == 24) {
            include_once 'registera.php';
        } elseif (isset($_GET['tab']) && $_GET['tab'] == 25) {
            include_once 'Ufromedit.php';
        } elseif (isset($_GET['tab']) && $_GET['tab'] == 26) {
            include_once 'disqualify.php';
        } elseif (isset($_GET['tab']) && $_GET['tab'] == 27) {
            require '../config/thai_date.php';
            $stmt = $db_con->query('SELECT * FROM booking_applications ');

            $rows = $stmt->num_rows;

            if ($rows > 0) {
                echo "<h1 class='text-center hide'>หน้า | ข้อมูลการจองทั้งหมด</h1>";
                echo "
                     
                     <div class='card-header alert-success text-black'><h3 class='text-center text-md'>ข้อมูลการจองทั้งหมด</h3></div>
                    <div class='content mb-lg-5'>
                    <input  class='form-control'id='myInput3' type='text' placeholder='ค้นหา ลำดับ, ประเภท '><br>
                    <table  class='table table-bordered table-responsive-sm w-100'>
                        <thead id='myTable3'>
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
                        'SELECT * FROM booking_applications '
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
            } else {
                echo "<h1 class='text-center text-md mb-lg'>ไม่มีอะไรข้อมูลให้แสดง</h1>";
            }
        } else {
            ?>
    <div class="row">
        <div class="col-md-12 mb-3 mx-auto">
            <h1 class='text-center hide'>หน้า | แผงควบคุม</h1>
            <div class="row">
                <div class="container mb-12 p-4">
                    <h4 class="extra-sm" class="text-center">
                        ยินดีต้อนรับคุณ :&nbsp;<?php echo $row->fname; ?>&nbsp;<?php echo $row->lname; ?></h1>
                
                        <h5></h5>
                        <quote class="float-right mute muted">
                            <i> <img src="../images/boychawin.com_logo.png" class="img-thumbnail" alt="Nature"
                                    style="width:100%"></i><br>
                            <span></span><br>



                            <div class="row mb-2">
                                <div class="col-md-3 mb-md-2">
                                    <div class="alert alert-success" role="alert"><span class="extra-sm"> จำนวนสมาชิก
                                        </span>
                                        <?php
                                                                                                                                        include 'db_connect.php'; // เรียกใช้งานไฟล์เชื่อมต่อกับฐานข้อมูล
                                                                                                                                        $db_con = connect(); // เชื่อมต่อกับฐานข้อมูล
                                                                                                                                        $query =
                                                                                                                                            'SELECT COUNT(*) AS id FROM employee';
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

                                        <a href="../pages/admin.php?tab=11" class="extra-sm"
                                            class="small-box-footer">ข้อมูลเพิ่มเติม <i
                                                class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-md-2">
                                    <div class="alert alert-primary" role="alert"><span class="extra-sm">
                                            จำนวนห้อง/โต๊ะจอง </span>
                                        <?php
                                                // include("db_connect.php"); // เรียกใช้งานไฟล์เชื่อมต่อกับฐานข้อมูล
                                                $db_con = connect(); // เชื่อมต่อกับฐานข้อมูล
                                                $query =
                                                    'SELECT COUNT(*) AS id FROM booking';
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
                                                    echo '<h3>' . $b . '</h3>';

                                                    echo '</tr>';
                                                }
                                                ?>
                                        <i class="fa fa-map-marker"></i>

                                        <a href="../pages/admin.php?tab=9" class="extra-sm"
                                            class="small-box-footer">ข้อมูลเพิ่มเติม <i
                                                class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-md-2">
                                    <div class="alert alert-info" role="alert"><span class="extra-sm"> จำนวนการจอง
                                        </span>
                                        <?php
                                                $db_con = connect(); // เชื่อมต่อกับฐานข้อมูล
                                                $query =
                                                    'SELECT COUNT(*) AS id FROM booking_applications';
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

                                        <a href="../pages/admin.php?tab=27" class="extra-sm"
                                            class="small-box-footer">ข้อมูลเพิ่มเติม <i
                                                class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-md-2">

                                    <div class="alert alert-warning" role="alert"> <span class="extra-sm">
                                            จำนวนเรื่องร้องเรียน </span>
                                        <?php
                                                // include("db_connect.php"); // เรียกใช้งานไฟล์เชื่อมต่อกับฐานข้อมูล
                                                $db_con = connect(); // เชื่อมต่อกับฐานข้อมูล
                                                $query =
                                                    'SELECT COUNT(*) AS id FROM tblmessage';
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

                                        <a href="../pages/admin.php?tab=10" class="extra-sm"
                                            class="small-box-footer">ข้อมูลเพิ่มเติม <i
                                                class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                        </quote>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    <?php
        }
        echo '</div></div>';
        ?>
    <!-- <script src="js/jquery.js"></script>

        <script src="bootstrap/js/bootstrap.min.js"></script>

        <script src="js/main.js"></script> -->
    <script>
    $('#days').on('change input', function() {

        var val = $(this).val();

        if (val !== '') {
            $("#hint").removeClass("hide");
        } else {

            $('#hint').addClass("hide");
        }
    });
    </script>

    <?php
    } else {
        header('Location:index2.php?action=login&type=admin');
    }

    include 'footer.php';
    ?>

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
    <a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button" data-toggle="tooltip"
        data-placement="left"><i class="fa fa-chevron-up"></i></a>
</body>

</html>