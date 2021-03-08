<?php
include_once 'connection.php';
include_once 'functions.php';
if (isset($_POST['request'])) {
    $errors = [];

    if (var_set($_POST['txtbooking_type'])) {
        $tool1 = $_POST['txtbooking_type'];
    } else {
        $errors[] = urlencode('ใส่ข้อมูลไม่ครบ โปรดตรวจสอบใหม่ ');
    }

    if (var_set($_POST['txtbuilding'])) {
        $tool2 = $_POST['txtbuilding'];
    } else {
        $errors[] = urlencode('ข้อมูลตึกไม่มี ');
    }

    if (var_set($_POST['txtclass'])) {
        $tool3 = $_POST['txtclass'];
    } else {
        $errors[] = urlencode('ข้อมูลชั้นไม่มี');
    }

    if (var_set($_POST['txtCapacity_person'])) {
        $tool4 = $_POST['txtCapacity_person'];
    } else {
        $errors[] = urlencode('ข้อมูลที่นั่งไม่มี ');
    }

    $booking_type = $tool1 . " " . $tool2 . " " . $tool3 . " " . $tool4;

    $fnamelname = $_POST['fnamelname'];

    if (var_set($_POST['numberp'])) {
        $numberp = $_POST['numberp'];
    } else {
        $errors[] = urlencode('จำนวนคนใช้ห้อง');
    }

    if (var_set($_POST['myfile'])) {
        $booking_id = $_POST['myfile'];
    } else {
        $errors[] = urlencode('ใส่รหัสห้อง/โต๊ะ');
    }


    $resultss = mysqli_query($db_con, "SELECT id,booking_id,Capacity_person from  booking WHERE booking_id = '$booking_id'");
    while ($rss = mysqli_fetch_array($resultss)) {
        if ($numberp > $rss['Capacity_person']) {

            $errors[] = urlencode('ใส่จำนวนคนใช้ห้องมากเกินไป โปรดเลือกจำนวนใหม่');
        }
    }


    if (var_set($_POST['purpose'])) {
        $purpose = $_POST['purpose'];
    } else {
        $errors[] = urlencode('โปรดใส่จุดประสงค์การเข้าใช้งาน');
    }
    if (var_set($_POST['booking_start_date'])) {
        $booking_start_date = strip_tags($_POST['booking_start_date']);
    } else {
        $errors[] = urlencode('โปรดเลือกวันที่เริ่มต้น');
    }

    if (var_set($_POST['booking_end_date'])) {
        $booking_end_date = strip_tags($_POST['booking_end_date']);
    } else {
        $errors[] = urlencode('โปรดเลือกวันที่สิ้นสุด');
    }
    $date_min = date('Y-m-d H:i:s');
    $refined_date_min = intval(implode('', explode('-', $date_min)));
    $refined_date_start = intval(
        implode('', explode('-', $booking_start_date))
    );

    $refined_date_end = intval(implode('', explode('-', $booking_end_date)));

    $range = $refined_date_end - $refined_date_start;
    $rangess = $refined_date_min - $refined_date_start;

    $min = date('Y-m-d');
    $d = date('H:i:s');
    $T = "T";
    $timetree = $min . "" . $T . "" . $d;

    if ($range < 0) {
        $errors[] = urlencode('วันที่เริ่มต้นต้องน้อยกว่าวันที่สิ้นสุด');
    }
    if ($booking_start_date <= $timetree) {
        $errors[] = urlencode('วันที่เริ่มต้นน้อยกว่าวันที่ปัจจุบัน');
    }

    if ($booking_start_date == $booking_end_date) {
        $errors[] = urlencode('วันที่เริ่มต้นต้องไม่เท่ากันกับวันที่สิ้นสุด');
    }


    if (var_set($_POST['staff_id'])) {
        $staff_id = strip_tags($_POST['staff_id']);
    } else {
        $errors[] = urlencode('เกิดข้อผิดพลาด. ลองอีกครั้ง' . $db_con->error);
    }

    // $date_requested = date("d-m-Y HH:mm");
    date_default_timezone_set('Asia/Bangkok');
    $date_requested = date('Y-m-d H:i:s');

    if (var_set($_POST['booking_id'])) {
        $booking_id2 = strip_tags($_POST['booking_id']);

        $res = query_db(
            "SELECT id,booking_id,booking_type FROM booking WHERE booking_id = '$booking_id2'"
        );

        if ($res) {
            $booking_type1 = strip_tags($_POST['booking_type']);
        } else {
            $errors[] = urlencode('เกิดข้อผิดพลาด+' . $db_con->error);
        }
    } else {
        $errors[] = urlencode('คุณต้องเลือก');
    }
    ///ส่วนที่ 1 line แจ้งเตือน
    $header = 'การจอง';
    $message =
        $header .
        "\n" .
        'เลือกห้อง: ' .
        $booking_type .
        "\n" .
        'ผู้ขอจอง: ' .
        $fnamelname .
        "\n" .
        'วันเวลาที่ร้องขอ: ' .
        $date_requested .
        "\n" .
        'วันเวลาที่เริ่มต้น: ' .
        $booking_start_date .
        "\n" .
        'วันเวลาที่สิ้นสุด: ' .
        $booking_end_date .
        "\n" .
        'จุดประสงค์การเข้าใช้งาน: ' .
        $purpose .
        "\n" .
        'สถานะ: ' .
        'รอการอนุมัติ';

    $Faculty_b = $_POST['Faculty_b'];

    $result = mysqli_query($db_con, "SELECT * from  booking_applications");
    while ($rs = mysqli_fetch_array($result)) {
        if ($rs['booking_type'] == $booking_type && $rs['startime'] == $booking_start_date && $rs['endtime'] == $booking_end_date && $rs['action'] == 'accept') {

            $errors[] = urlencode('รายการจองซ้ำและได้รับอนุมัติแล้ว');
        }
        if ($rs['booking_type'] == $booking_type && $rs['startime'] == $booking_start_date && $rs['endtime'] == $booking_end_date && $rs['action'] == '') {

            $errors[] = urlencode('รายการจองซ้ำ แต่ยังไม่ได้รับอนุมัติ');
        }

        // if ($rs['booking_type'] == $booking_type && $rs['action'] == 'accept') {
        //     if ($rs['startime'] >= $booking_start_date || $rs['endtime'] <= $booking_end_date) {
        //     $errors[] = urlencode('รายการจองซ้ำ กรุณาเช็คว่า ห้อง/โต๊ะ หรือช่วงวันเวลาซ้ำ'); 
        // }}
    }
    //เช็คค่าอนุมัติ
    $sql = "SELECT * FROM booking_applications WHERE booking_type = '" . $booking_type . "'
AND action = '" . "accept" . "'
AND (

   (startime BETWEEN '" . $booking_start_date . "' AND '" . $booking_end_date . "')
   OR 
   (endtime BETWEEN '" . $booking_start_date . "' AND '" . $booking_end_date . "')
   OR 
    ('" . $booking_start_date . "' BETWEEN startime  AND endtime)
   OR 
    ('" . $booking_end_date . "' BETWEEN  startime  AND endtime )
)";
    $qry = mysqli_query($db_con, $sql);
    if ($row = mysqli_fetch_array($qry)) {
        $errors[] = urlencode('รายการจองซ้ำ กรุณาเช็คว่า ห้อง/โต๊ะ หรือช่วงวันเวลาซ้ำ');
    }
    //เช็คค่าว่าง
    $sql_db = "SELECT * FROM booking_applications WHERE booking_type = '" . $booking_type . "'
    AND action IS NULL
    AND (
       (startime BETWEEN '" . $booking_start_date . "' AND '" . $booking_end_date . "')
       OR 
       (endtime BETWEEN '" . $booking_start_date . "' AND '" . $booking_end_date . "')
       OR 
        ('" . $booking_start_date . "' BETWEEN startime  AND endtime)
       OR 
        ('" . $booking_end_date . "' BETWEEN  startime  AND endtime )
    )";
    $qry_db = mysqli_query($db_con, $sql_db);
    if ($rows = mysqli_fetch_array($qry_db)) {
        $errors[] = urlencode('รายการจองซ้ำ แต่ยังไม่ได้รับอนุมัติ กรุณาเช็คว่า ห้อง/โต๊ะ หรือช่วงวันเวลาซ้ำ');
    }



    if (!$errors) {
        $stmt = $db_con->prepare("INSERT INTO booking_applications(booking_id,staff_id,staff_name,
                booking_type,booking_start_date,booking_end_date,date_requested,numberp,purpose,Faculty_b,startime,endtime) 
                VALUES(?,?,?,?,?,?,?,?,?,?,?,?)");

        $stmt->bind_param(
            'iissssssssss',
            $booking_id,
            $staff_id,
            $fnamelname,
            $booking_type,
            $booking_start_date,
            $booking_end_date,
            $date_requested,
            $numberp,
            $purpose,
            $Faculty_b,
            $booking_start_date,
            $booking_end_date,

        );
        //,$numberp,$purpose
        $stmt->execute();

        echo "<h3>Error: $db_con->error</h3>";

        if ($db_con->affected_rows == 1) {
            ///ส่วนที่ 2 line แจ้งเตือน
            sendlinemesg();
            header('Content-Type: text/html; charset=utf8');
            $res = notify_message($message);
            //////////
            $msg = urlencode('สำเร็จ รอเจ้าหน้าที่อนุมัติ ตรวจสอบสถานะได้ที่หน้าแรกของเว็บไซต์');

            redirect_user("dashboard.php?tab=6&msg=$msg");
        }
    } else {
        redirect_user(
            'dashboard.php?tab=6&error=' . join($errors, urlencode('<br>'))
        );
    }
}