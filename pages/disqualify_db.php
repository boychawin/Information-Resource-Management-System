<?php
//1. เชื่อมต่อ database:
include 'db_connect.php'; // เรียกใช้งานไฟล์เชื่อมต่อกับฐานข้อมูล
include_once 'functions.php';
//ตรวจสอบถ้าว่างให้เด้งไปหน้าหลักและไม่แก้ไขข้อมูล
if ($_POST['staff_id'] == '') {
    $errors[] = urlencode('เกิดข้อผิดพลาด !!');
}

if ($_POST['day_rejectend'] == '') {
    $errors[] = urlencode('ระบุวันที่ !!');
}
if (!$errors) {
    //สร้างตัวแปรสำหรับรับค่าที่นำมาแก้ไขจากฟอร์ม
    $staff_id = $_POST['staff_id'];
    $b = $_POST['b'];
    $Suspend = $_POST['Suspend'];
    $staff_level1 = $_POST['staff_level1'];
    $day_reject = $_POST['day_reject'];
    $day_rejectend = $_POST['day_rejectend'];

    //ทำการปรับปรุงข้อมูลที่จะแก้ไขลงใน database
    $db_con = connect(); // เชื่อมต่อกับฐานข้อมูล
    $sql1 = "UPDATE employee SET  
                staff_level='$staff_level1',
                total_reject='$b',
                day_reject='$day_reject',
                day_rejectend='$day_rejectend'
                WHERE staff_id='$staff_id' ";
    ($result1 = mysqli_query($db_con, $sql1));
    // $sql = "DELETE FROM booking WHERE 1 AND id='$id'";
    // $sql = "UPDATE  booking_applications SET action='$Suspend' WHERE staff_id='$staff_id' ";
    $mysqli = connect(); // เชื่อมต่อกับฐานข้อมูล
    $sql = "UPDATE  booking_applications SET status='$Suspend' WHERE staff_id='$staff_id' ";
    $result = mysqli_query($mysqli, $sql);

    mysqli_close($db_con); //ปิดการเชื่อมต่อ database

    //จาวาสคริปแสดงข้อความเมื่อบันทึกเสร็จและกระโดดกลับไปหน้าฟอร์ม

    if ($result1) {
        if ($result) {
            $msg = urlencode('อัปเดตข้อมูลสำเร็จ');

            redirect_user("admin.php?tab=17&msg=$msg");
        } else {
            $errors[] = urlencode('เกิดข้อผิดพลาดกลับไปที่การอัปเดตอีกครั้ง !!');
            redirect_user(
                'admin.php?tab=17&error=' . join($errors, urlencode('<br>'))
            );
        }
    } else {
        $errors[] = urlencode('เกิดข้อผิดพลาดกลับไปที่การอัปเดตอีกครั้ง !!');
        redirect_user(
            'admin.php?tab=17&error=' . join($errors, urlencode('<br>'))
        );
    }
} else {
    redirect_user('admin.php?tab=17&error=' . join($errors, urlencode('<br>')));
}