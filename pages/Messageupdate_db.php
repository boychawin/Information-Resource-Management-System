<?php
//1. เชื่อมต่อ database:
include 'connection.php'; //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี
include_once 'functions.php';
//ตรวจสอบถ้าว่างให้เด้งไปหน้าหลักและไม่แก้ไขข้อมูล
//สร้างตัวแปรสำหรับรับค่าที่นำมาแก้ไขจากฟอร์ม
if (isset($_POST['user'])) {
    if ($_POST['MessageID'] == '') {
        echo "<script type='text/javascript'>";
        echo "alert('เกิดข้อผิดพลาด !!');";
        echo 'window.history.back(1);';
        echo '</script>';
        echo 'เกิดข้อผิดพลาด';
    }

    if ($_POST['MessageCODE'] == '') {
        echo "<script type='text/javascript'>";
        echo "alert('ใส่หัวข้อ ถ้าขึ้นแจ้งเตือนนี้แสดงว่าข้อมูลจะไม่ถูกเปลี่ยน!!');";
        echo 'window.history.back(1);';
        echo '</script>';
        echo 'ใส่หัวข้อ';
    }

    if ($_POST['MessageText'] == '') {
        echo "<script type='text/javascript'>";
        echo "alert('ใส่อธิบายปัญหาของท่าน ถ้าขึ้นแจ้งเตือนนี้แสดงว่าข้อมูลจะไม่ถูกเปลี่ยน!!');";
        echo 'window.history.back(1);';
        echo '</script>';
        echo 'ใส่อธิบายปัญหาของท่าน';
    }
    $MessageID = $_POST['MessageID'];
    $Category = $_POST['Category'];
    $MessageText = $_POST['MessageText'];
    $MessageCODE = $_POST['MessageCODE'];
    $Mstatus = $_POST['Mstatus'];
    $date_receive = $_POST['date_receive'];

    $sql = "UPDATE tblmessage SET  
						Category='$Category' ,
						MessageText='$MessageText' , 
						MessageCODE='$MessageCODE' ,
                        Mstatus='$Mstatus' ,
						date_receive='$date_receive'
						WHERE MessageID='$MessageID' ";

    $result = mysqli_query($db_con, $sql);

    mysqli_close($db_con); //ปิดการเชื่อมต่อ database

    //จาวาสคริปแสดงข้อความเมื่อบันทึกเสร็จและกระโดดกลับไปหน้าฟอร์ม

    if ($result) {
        $msg = urlencode('อัปเดตข้อมูลสำเร็จ');

        redirect_user("dashboard.php?tab=9&msg=$msg");
    } else {
        $msg = urlencode('เกิดข้อผิดพลาดกลับไปที่การอัปเดตอีกครั้ง');

        redirect_user("dashboard.php?tab=9&msg=$msg");
    }
}
if (isset($_POST['admin'])) {
    if ($_POST['MessageID'] == '') {
        echo "<script type='text/javascript'>";
        echo "alert('เกิดข้อผิดพลาด !!');";
        echo 'window.history.back(1);';
        echo '</script>';
        echo 'เกิดข้อผิดพลาด';
    }

    if ($_POST['MessageCODE'] == '') {
        echo "<script type='text/javascript'>";
        echo "alert('ใส่หัวข้อ ถ้าขึ้นแจ้งเตือนนี้แสดงว่าข้อมูลจะไม่ถูกเปลี่ยน!!');";
        echo 'window.history.back(1);';
        echo '</script>';
        echo 'ใส่หัวข้อ';
    }

    if ($_POST['MessageText'] == '') {
        echo "<script type='text/javascript'>";
        echo "alert('ใส่อธิบายปัญหาของท่าน ถ้าขึ้นแจ้งเตือนนี้แสดงว่าข้อมูลจะไม่ถูกเปลี่ยน!!');";
        echo 'window.history.back(1);';
        echo '</script>';
        echo 'ใส่อธิบายปัญหาของท่าน';
    }
    $MessageID = $_POST['MessageID'];
    $Category = $_POST['Category'];
    $MessageText = $_POST['MessageText'];
    $MessageCODE = $_POST['MessageCODE'];
    $Mstatus = $_POST['Mstatus'];
    $date_receive = $_POST['date_receive'];

    $sql = "UPDATE tblmessage SET  
						Category='$Category' ,
						MessageText='$MessageText' , 
						MessageCODE='$MessageCODE' ,
                        Mstatus='$Mstatus' ,
						date_receive='$date_receive'
						WHERE MessageID='$MessageID' ";

    $result = mysqli_query($db_con, $sql);

    mysqli_close($db_con); //ปิดการเชื่อมต่อ database

    //จาวาสคริปแสดงข้อความเมื่อบันทึกเสร็จและกระโดดกลับไปหน้าฟอร์ม

    if ($result) {
        $msg = urlencode('อัปเดตข้อมูลสำเร็จ');
        redirect_user("admin.php?tab=10&msg=$msg");
    } else {
        $msg = urlencode('เกิดข้อผิดพลาดกลับไปที่การอัปเดตอีกครั้ง');
        redirect_user("admin.php?tab=10&msg=$msg");
    }
}