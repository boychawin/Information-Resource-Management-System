<?php
//1. เชื่อมต่อ database:
include 'connection.php'; //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี
include_once 'functions.php';
//ตรวจสอบถ้าว่างให้เด้งไปหน้าหลักและไม่แก้ไขข้อมูล
if ($_REQUEST['staff_id'] == '') {
    echo "<script type='text/javascript'>";
    echo "alert('เกิดข้อผิดพลาด !!');";
    echo 'window.history.back(1);';
    echo '</script>';
    echo 'เกิดข้อผิดพลาด';
}

//สร้างตัวแปรสำหรับรับค่าที่นำมาแก้ไขจากฟอร์ม
$staff_id = $_REQUEST['staff_id'];
$Suspend = 'non-supervisor';

//ทำการปรับปรุงข้อมูลที่จะแก้ไขลงใน database

// $sql = "DELETE FROM booking WHERE 1 AND id='$id'";
$sql = "UPDATE  employee SET  
    staff_level='$Suspend'
    WHERE staff_id='$staff_id' ";

$result = mysqli_query($db_con, $sql);

mysqli_close($db_con); //ปิดการเชื่อมต่อ database

//จาวาสคริปแสดงข้อความเมื่อบันทึกเสร็จและกระโดดกลับไปหน้าฟอร์ม

if ($result) {
    $msg = urlencode('อัปเดตข้อมูลสำเร็จ');

    redirect_user("admin.php?tab=17&msg=$msg");
} else {
    $errors[] = urlencode('เกิดข้อผิดพลาดกลับไปที่การอัปเดตอีกครั้ง !!');
    redirect_user('admin.php?tab=17&error=' . join($errors, urlencode('<br>')));
}


?>