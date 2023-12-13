<?php
//1. เชื่อมต่อ database:
include 'connection.php'; //ไฟล์เชื่อมต่อกับ database
include_once 'functions.php';
$errors = [];
//ตรวจสอบถ้าว่างให้เด้งไปหน้าหลักและไม่แก้ไขข้อมูล
if ($_REQUEST['id'] == '') {
    echo "<script type='text/javascript'>";
    echo "alert('เกิดข้อผิดพลาด !!');";
    echo "window.location = 'admin.php?tab=9'; ";
    echo '</script>';
    echo 'เกิดข้อผิดพลาด';
}
//สร้างตัวแปรสำหรับรับค่าที่นำมาแก้ไขจากฟอร์ม
$id = $_REQUEST['id'];
//ทำการปรับปรุงข้อมูลที่จะแก้ไขลงใน database
$sql = "DELETE FROM booking WHERE 1 AND id='$id'";
$result = mysqli_query($db_con, $sql);
mysqli_close($db_con); //ปิดการเชื่อมต่อ database
//จาวาสคริปแสดงข้อความเมื่อบันทึกเสร็จและกระโดดกลับไปหน้าฟอร์ม
if ($result) {
    $msg = urlencode('ลบสำเร็จ');
    redirect_user("admin.php?tab=9&msg=$msg");
} else {
    $errors[] = urlencode('เกิดข้อผิดพลาดกลับไปที่ลองอีกครั้ง !!');
    redirect_user('admin.php?tab=9&error=' . join($errors));
}