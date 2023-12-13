<?php
//1. เชื่อมต่อ database:
include 'db_connect.php'; // เรียกใช้งานไฟล์เชื่อมต่อกับฐานข้อมูล
include_once 'functions.php';
//ตรวจสอบถ้าว่างให้เด้งไปหน้าหลักและไม่แก้ไขข้อมูล
    //สร้างตัวแปรสำหรับรับค่าที่นำมาแก้ไขจากฟอร์ม
    $staff_id = $_GET['staff_id'];
    $Suspend = $_GET['Suspend'];


    //ทำการปรับปรุงข้อมูลที่จะแก้ไขลงใน database
    $db_con = connect(); // เชื่อมต่อกับฐานข้อมูล
    $sql1 = "UPDATE booking_applications SET  
                action='$Suspend'
                WHERE staff_id='$staff_id' ";
    ($result1 = mysqli_query($db_con, $sql1));
    // $sql = "DELETE FROM booking WHERE 1 AND id='$id'";
    // $sql = "UPDATE  booking_applications SET action='$Suspend' WHERE staff_id='$staff_id' ";
    // $mysqli = connect(); // เชื่อมต่อกับฐานข้อมูล
    // $sql = "UPDATE  booking_applications SET action='$Suspend' WHERE staff_id='$staff_id' ";
    //  $result = mysqli_query($mysqli, $sql) ;

    mysqli_close($db_con); //ปิดการเชื่อมต่อ database
    //จาวาสคริปแสดงข้อความเมื่อบันทึกเสร็จและกระโดดกลับไปหน้าฟอร์ม

    if ($result1) {
        $msg = urlencode('อัปเดตข้อมูลสำเร็จ');

        redirect_user("admin.php?tab=17&msg=$msg");
    } else {
        $errors[] = urlencode('เกิดข้อผิดพลาดกลับไปที่การอัปเดตอีกครั้ง 2222!!');
        redirect_user(
            'admin.php?tab=17&error=' . join($errors)
        );
    }