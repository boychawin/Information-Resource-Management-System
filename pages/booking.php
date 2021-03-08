<?php
include_once 'connection.php';
include 'functions.php';

if (isset($_POST['new_booking'])) {
    $date_posted = date('Ymd');

    if (!isset($_POST['booking_id']) || $_POST['booking_id'] == '') {
        $errors[] = urlencode('ต้องระบุเลขห้อง');
    } else {
        $booking_id = strip_tags(trim(htmlspecialchars($_POST['booking_id'])));
    }

    $querys = $db_con->query("SELECT * FROM booking WHERE booking_id = '$booking_id' ");

    if ($querys->num_rows > 0) {
        $errors[] = urlencode('เลขประจำห้อง/โต๊ะ ซ้ำ !!');
    }


    if (!isset($_POST['booking_type']) || $_POST['booking_type'] == '') {
        $errors[] = urlencode('ต้องระบุชื่อหัวข้อ');
    } else {
        $booking_type = strip_tags(
            trim(htmlspecialchars($_POST['booking_type']))
        );
    }

    if (!isset($_POST['Room_number']) || $_POST['Room_number'] == '') {
        $errors[] = urlencode('ต้องระบุเลขห้อง');
    } else {
        $Room_number = strip_tags(
            trim(htmlspecialchars($_POST['Room_number']))
        );
    }

    if (!isset($_POST['Capacity_person']) || $_POST['Capacity_person'] == '') {
        $errors[] = urlencode('ต้องระบุความจุ/คน');
    } else {
        $Capacity_person = strip_tags(
            trim(htmlspecialchars($_POST['Capacity_person']))
        );
    }

    if (!isset($_POST['Room_details']) || $_POST['Room_details'] == '') {
        $errors[] = urlencode('ต้องระบุรายละเอียดห้อง/โต๊ะ');
    } else {
        $Room_details = strip_tags(
            trim(htmlspecialchars($_POST['Room_details']))
        );
    }

    if (!isset($_POST['Room_type']) || $_POST['Room_type'] == '') {
        $errors[] = urlencode('ต้องระบุประเภทห้อง');
    } else {
        $Room_type = strip_tags(trim(htmlspecialchars($_POST['Room_type'])));
    }

    if (!isset($_POST['building']) || $_POST['building'] == '') {
        $errors[] = urlencode('ต้องระบุตึก');
    } else {
        $building = strip_tags(trim(htmlspecialchars($_POST['building'])));
    }

    if (!isset($_POST['class']) || $_POST['class'] == '') {
        $errors[] = urlencode('ต้องระบุชั้น');
    } else {
        $class = strip_tags(trim(htmlspecialchars($_POST['class'])));
    }

    if (!$errors) {

        $for_staff_level = $_POST['staff_level'];

        $allowed_days = date('d');
        $auto_date = date('U') + 2591590;

        $result = $db_con->query("SELECT * FROM booking WHERE booking_type = '$booking_type' 
            AND for_staff_level = '$for_staff_level'");

        $fileName = date('Ymd') . '_' . $_FILES['filAlbumShot']['name'];
        if (
            move_uploaded_file(
                $_FILES['filAlbumShot']['tmp_name'],
                'myfile/' . $fileName
            )
        ) {
            $stmt = $db_con->prepare("INSERT INTO booking(booking_id,booking_type,Room_number,Capacity_person,Room_details,Room_type,building,class,
                allowed_days, current_days, allowed_monthly_days, for_staff_level,
                auto_update,photo) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

            $stmt->bind_param(
                'isiisssiiiisis',
                $booking_id,
                $booking_type,
                $Room_number,
                $Capacity_person,
                $Room_details,
                $Room_type,
                $building,
                $class,
                $allowed_days,
                $allowed_days,
                $date_posted,
                $for_staff_level,
                $auto_date,
                $fileName
            );

            $stmt->execute();

            if ($db_con->affected_rows == 1) {
                $msg = urlencode('เพิ่มสำเร็จแล้ว');
                redirect_user("admin.php?tab=9&msg=$msg");
            } else {
                $error = urlencode('ไม่สามารถเพิ่มได้ ' . $db_con->error);
                redirect_user("admin.php?tab=9&error=$error");
            }
        }
    } else {
        redirect_user('admin.php?tab=23&error=' . join($errors, urlencode('<br>')));
    }
}

echo "<script type='text/javascript'>";
echo "alert('กรุณากรอกข้อมูลให้ครบ');";
echo 'window.history.back();';
echo '</script>';