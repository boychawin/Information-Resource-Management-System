<?php
//1. เชื่อมต่อ database:
include 'connection.php'; //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี
include_once 'functions.php';
//ตรวจสอบถ้าว่างให้เด้งไปหน้าหลักและไม่แก้ไขข้อมูล
if ($_POST['id'] == '') {
    echo "<script type='text/javascript'>";
    echo "alert('เกิดข้อผิดพลาด !!');";
    echo 'window.history.back(1);';
    echo '</script>';
    echo 'เกิดข้อผิดพลาด';
}
if ($_POST['password'] != '') {
    //สร้างตัวแปรสำหรับรับค่าที่นำมาแก้ไขจากฟอร์ม
    $id = $_POST['id'];
    $username = $_POST['username'];
    //	$password = $_POST["password"];
    $staff_level = $_POST['staff_level'];

    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    //	$Mstatus = $_POST["Mstatus"];
    //$email = $_POST["email"];

    //ทำการปรับปรุงข้อมูลที่จะแก้ไขลงใน database

    $sql = "UPDATE employee SET  
			username='$username' ,
			password='$password' , 
			staff_level='$staff_level' 
			WHERE id='$id' ";

    $result = mysqli_query($db_con, $sql);

    mysqli_close($db_con); //ปิดการเชื่อมต่อ database

    //จาวาสคริปแสดงข้อความเมื่อบันทึกเสร็จและกระโดดกลับไปหน้าฟอร์ม

    if ($result) {
        $msg = urlencode('อัปเดตข้อมูลสำเร็จ');

        redirect_user("admin.php?tab=11&msg=$msg");
    } else {
        $errors[] = urlencode('เกิดข้อผิดพลาดกลับไปที่การอัปเดตอีกครั้ง !!');
        redirect_user(
            'admin.php?tab=11&error=' . join($errors)
        );
    }
} else {
    $errors[] = urlencode('ใส่ข้อมูลให้ครบถ้วน !!');
    redirect_user('admin.php?tab=11&error=' . join($errors));
}