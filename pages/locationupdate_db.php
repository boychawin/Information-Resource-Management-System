<?php
//1. เชื่อมต่อ database:
include 'connection.php'; //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี
include_once 'functions.php';
//ตรวจสอบถ้าว่างให้เด้งไปหน้าหลักและไม่แก้ไขข้อมูล
if ($_POST['id'] == '') {
    echo "<script type='text/javascript'>";
    echo "alert('เกิดข้อผิดพลาด !!');";
    echo "window.location = 'admin.php?tab=9'; ";
    //echo "window.history.back();";
    echo '</script>';
    echo 'เกิดข้อผิดพลาด';
}

if ($_POST['booking_type'] == '') {
    $errors[] = urlencode('กรุณาระบุหัวข้อ !!');
}

if ($_POST['Room_details'] == '') {
    $errors[] = urlencode('กรุณาระบุรายละเอียด !!');
}

if ($_POST['Room_type'] == '') {
    $errors[] = urlencode('กรุณาระบุประเภทห้อง/โต๊ะ !!');
}

if ($_POST['building'] == '') {
    $errors[] = urlencode('กรุณาระบุตึก !!');
}

if ($_POST['booking_id'] == '') {
    $errors[] = urlencode('กรุณาระบุเลขประจำห้อง/โต๊ะ !!');
}
if ($_POST['Room_number'] == '') {
    $errors[] = urlencode('กรุณาระบุเลขลำดับห้อง/โต๊ะ !!');
}
if ($_POST['Capacity_person'] == '') {
    $errors[] = urlencode('กรุณาระบุความจุ/คน !!');
}
if ($_POST['class'] == '') {
    $errors[] = urlencode('กรุณาระบุชั้น !!');
}
if (!$errors) {
    //สร้างตัวแปรสำหรับรับค่าที่นำมาแก้ไขจากฟอร์ม
    $id = $_POST['id'];
    $booking_id = $_POST['booking_id'];
    $booking_type = $_POST['booking_type'];

    ////////////
    $Room_number = $_POST['Room_number'];
    $Capacity_person = $_POST['Capacity_person'];
    $Room_details = $_POST['Room_details'];
    $Room_type = $_POST['Room_type'];
    $building = $_POST['building'];
    $class = $_POST['class'];
    $for_staff_level = $_POST['staff_level'];

    $fileName = date('Ymd') . '_' . $_FILES['filAlbumShot']['name'];
    if (
        move_uploaded_file(
            $_FILES['filAlbumShot']['tmp_name'],
            'myfile/' . $fileName
        )
    ) {
        //ทำการปรับปรุงข้อมูลที่จะแก้ไขลงใน database

        $sql = "UPDATE booking SET  
			booking_id='$booking_id' ,
			booking_type='$booking_type' ,
			Room_number='$Room_number' , 
			Capacity_person='$Capacity_person' , 
			Room_details ='$Room_details ' , 
			Room_type='$Room_type' , 
			building='$building' , 
			class='$class' , 
			for_staff_level='$for_staff_level' , 
			photo='$fileName'  
			WHERE id='$id' ";

        $result = mysqli_query($db_con, $sql);

        mysqli_close($db_con); //ปิดการเชื่อมต่อ database

        //จาวาสคริปแสดงข้อความเมื่อบันทึกเสร็จและกระโดดกลับไปหน้าฟอร์ม
        if ($result) {
            $msg = urlencode('อัปเดตข้อมูลสำเร็จ');
            redirect_user("admin.php?tab=9&msg=$msg");
        } else {
            $errors[] = urlencode(
                'เกิดข้อผิดพลาดกลับไปที่การอัปเดตอีกครั้ง !!'
            );
            redirect_user(
                'admin.php?tab=9&error=' . join($errors, urlencode('<br>'))
            );
        }
    }
    echo "<script type='text/javascript'>";
    echo "alert('กรุณาใส่ข้อมูลให้ครบ เช่น รูปภาพ !!');";
    //echo "window.location = 'admin.php?tab=9'; ";
    echo "window.history.back();";
    echo '</script>';
    echo 'กรุณาใส่ข้อมูลให้ครบ';
} else {
    redirect_user('admin.php?tab=9&error=' . join($errors, urlencode('<br>')));
}