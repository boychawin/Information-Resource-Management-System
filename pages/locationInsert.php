<?php
include 'connection.php'; //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี
include_once 'functions.php';
//สร้างตัวแปรสำหรับรับค่าที่นำมาแก้ไขจากฟอร์ม
$id = $_POST['id'];
$name = $_POST['name'];
$details = $_POST['details'];
//เช็คจากตาราง User
$sql = "SELECT * FROM picture_place WHERE photo='$photo'";
$result = mysqli_query($db_con, $sql);
if (mysqli_num_rows($result) == 0) {
    //echo "true,<span style='color:green'>ชื่อผู้ใช้งานใช้ได้ครับ</span>";
    //เช็คจากตาราง User
    $sql = "SELECT * FROM picture_place WHERE name='$name' ";
    $result = mysqli_query($db_con, $sql);
    if (mysqli_num_rows($result) == 0) {
        $fileName = date('Ymd') . '_' . $_FILES['filAlbumShot']['name'];
        if (
            move_uploaded_file(
                $_FILES['filAlbumShot']['tmp_name'],
                'myfile/' . $fileName
            )
        ) {
            //เพิ่มเข้าไปในฐานข้อมูล
            $sql = "INSERT INTO picture_place(name, photo, details)
            VALUES('$name', '$fileName', '$details')";

            $result = mysqli_query($db_con, $sql);

            //ปิดการเชื่อมต่อ database
            mysqli_close($db_con);
            //จาวาสคริปแสดงข้อความเมื่อบันทึกเสร็จและกระโดดกลับไปหน้าฟอร์ม
            if ($result) {
                echo "<script type='text/javascript'>";
                echo "alert('เพิ่มความสำเร็จ');";
                echo "window.location = 'admin.php?tab=9'; ";
                echo '</script>';
                echo 'เพิ่มความสำเร็จ';
            } else {
                echo "<script type='text/javascript'>";
                echo "alert('เกิดข้อผิดพลาด');";
                echo "window.location = 'admin.php?tab=9'; ";
                echo '</script>';
                echo 'เกิดข้อผิดพลาด';
            }
        }
    } else {
        echo '<script>';
        echo "alert(' ฃื่อซ้ำ !');";
        echo 'window.history.back();';
        echo '</script>';
    }
} else {
    echo '<script>';
    echo "alert(' ที่อยู่รูปภาพซ้ำ !');";
    echo 'window.history.back();';
    echo '</script>';
}


?>