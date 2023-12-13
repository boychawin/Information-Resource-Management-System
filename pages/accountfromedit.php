<?php
//1. เชื่อมต่อ database:
include 'connection.php'; //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี
include_once 'functions.php';
$errors = [];
//ตรวจสอบถ้าว่างให้เด้งไปหน้าหลักและไม่แก้ไขข้อมูล
if ($_POST['id'] == '') {
    echo "<script type='text/javascript'>";
    echo "alert('เกิดข้อผิดพลาด !!');";
    echo "window.location = 'dashboard.php?tab=4'; ";
    echo '</script>';
    echo 'เกิดข้อผิดพลาด !';
}
//สร้างตัวแปรสำหรับรับค่าที่นำมาแก้ไขจากฟอร์ม
$id = $_POST['id'];
$staff_level = $_POST['staff_level'];

if (isset($_POST['update'])) {
    $errors = [];
    $username = $_POST['username'];
    $position = $_POST['position'];
    $Faculty = $_POST['Faculty'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $location = $_POST['location'];

    if ($_POST['phone'] == '') {
        $errors[] = urlencode('ใส่เบอร์ !!');
    }

    if ($_POST['email'] == '') {
        $errors[] = urlencode('ใส่ email !!');
    }

    if ($_POST['location'] == '') {
        $errors[] = urlencode('ใส่ที่อยู่ !!');
    }

    if ($_POST['username'] == '') {
        $errors[] = urlencode('ชื่อเข้าระบบ !!');
    }

    if ($_POST['position'] == '') {
        $errors[] = urlencode('ตำแหน่ง !!');
    }

    if ($_POST['Faculty'] == '') {
        $errors[] = urlencode('หน่วยงาน !!');
    }
    //ทำการปรับปรุงข้อมูลที่จะแก้ไขลงใน database
    if (!$errors) {
        if ($staff_level == 'supervisor') {
            //non-supervisor

            $sql = "UPDATE employee SET
                                username='$username' ,
                                position='$position' ,
                                Faculty='$Faculty' ,  
                                phone='$phone' ,
                                email='$email' , 
                                location='$location'
                                WHERE id='$id' ";

            $result = mysqli_query($db_con, $sql);

            mysqli_close($db_con); //ปิดการเชื่อมต่อ database

            //จาวาสคริปแสดงข้อความเมื่อบันทึกเสร็จและกระโดดกลับไปหน้าฟอร์ม
            if ($result) {
                $msg = urlencode('อัปเดตข้อมูลสำเร็จ');

                redirect_user("dashboard.php?tab=4&msg=$msg");
            } else {
                $errors[] = urlencode(
                    'เกิดข้อผิดพลาดกลับไปที่การอัปเดตอีกครั้ง !!'
                );
                redirect_user(
                    'dashboard.php?tab=4&error=' .
                        join($errors)
                );
            }
        } elseif ($staff_level == 'non-supervisor') {
            //non-supervisor

            $sql = "UPDATE employee SET
                        username='$username' ,
                        position='$position' ,
                        Faculty='$Faculty' ,  
                        phone='$phone' ,
                        email='$email' , 
                        location='$location'
                        WHERE id='$id' ";

            $result = mysqli_query($db_con, $sql);

            mysqli_close($db_con); //ปิดการเชื่อมต่อ database

            //จาวาสคริปแสดงข้อความเมื่อบันทึกเสร็จและกระโดดกลับไปหน้าฟอร์ม
            if ($result) {
                $msg = urlencode('อัปเดตข้อมูลสำเร็จ');

                redirect_user("dashboard.php?tab=4&msg=$msg");
            } else {
                $errors[] = urlencode(
                    'เกิดข้อผิดพลาดกลับไปที่การอัปเดตอีกครั้ง !!'
                );
                redirect_user(
                    'dashboard.php?tab=4&error=' .
                        join($errors)
                );
            }
        } elseif ($staff_level == '') {
            //admin
            $sql = "UPDATE admin SET
                                username='$username' ,
                                position='$position' ,
                                Faculty='$Faculty' ,   
                                phone='$phone' ,
                                email='$email' , 
                                location='$location'
                                WHERE id='$id' ";

            $result = mysqli_query($db_con, $sql);

            mysqli_close($db_con); //ปิดการเชื่อมต่อ database

            //จาวาสคริปแสดงข้อความเมื่อบันทึกเสร็จและกระโดดกลับไปหน้าฟอร์ม
            if ($result) {
                $msg = urlencode('อัปเดตข้อมูลสำเร็จ');

                redirect_user("admin.php?tab=4&msg=$msg");
            } else {
                $errors[] = urlencode(
                    'เกิดข้อผิดพลาดกลับไปที่การอัปเดตอีกครั้ง !!'
                );
                redirect_user(
                    'admin.php?tab=4&error=' . join($errors)
                );
            }
        } else {
            echo "<script type='text/javascript'>";
            echo "alert('เกิดข้อผิดพลาดกลับไปที่การอัปเดตอีกครั้ง');";
            echo 'window.history.back(1);';
            echo '</script>';
            echo 'เกิดข้อผิดพลาดกลับไปที่การอัปเดตอีกครั้ง !';
        }
    } else {
        if ($staff_level == 'supervisor') {
            redirect_user(
                'dashboard.php?tab=4&error=' . join($errors)
            );
        } elseif ($staff_level == 'non-supervisor') {
            redirect_user(
                'dashboard.php?tab=4&error=' . join($errors)
            );
        } elseif ($staff_level == '') {
            //admin
            redirect_user(
                'admin.php?tab=4&error=' . join($errors)
            );
        }
    }
}
if (isset($_POST['password-account'])) {
    $confpassword = $_POST['confpassword'];
    $password = $_POST['password'];

    if (strlen($_POST['password']) < 8) {
        $errors[] = urlencode('รหัสผ่านต้องมีอย่างน้อย 8 ตัวอักษร');
    }

    if ($_POST['confpassword'] == '') {
        $errors[] = urlencode('ใส่รหัสผ่านยืนยัน');
    }

    if ($_POST['password'] == '') {
        $errors[] = urlencode('ใส่รหัสผ่าน');
    }

    if ($confpassword != $password) {
        $errors[] = urlencode('รหัสผ่านไม่ตรงกัน');
    }

    if (!$errors) {
        if ($confpassword == $password) {
            $password1 = password_hash($_POST['password'], PASSWORD_DEFAULT);

            if ($staff_level == 'supervisor') {
                //non-supervisor

                $sql = "UPDATE employee SET  
                       password='$password1'
                       WHERE id='$id' ";

                $result = mysqli_query($db_con, $sql);

                mysqli_close($db_con); //ปิดการเชื่อมต่อ database
                //จาวาสคริปแสดงข้อความเมื่อบันทึกเสร็จและกระโดดกลับไปหน้าฟอร์ม
                if ($result) {
                    $msg = urlencode('เปลี่ยนรหัสผ่านแล้ว');

                    redirect_user("dashboard.php?tab=4&msg=$msg");
                } else {
                    $errors[] = urlencode(
                        'เกิดข้อผิดพลาดกลับไปที่การอัปเดตอีกครั้ง !!'
                    );
                    redirect_user(
                        'dashboard.php?tab=4&error=' .
                            join($errors)
                    );
                }
            } elseif ($staff_level == 'non-supervisor') {
                //non-supervisor

                $sql = "UPDATE employee SET  
               password='$password1'
               WHERE id='$id' ";

                $result = mysqli_query($db_con, $sql);

                mysqli_close($db_con); //ปิดการเชื่อมต่อ database

                //จาวาสคริปแสดงข้อความเมื่อบันทึกเสร็จและกระโดดกลับไปหน้าฟอร์ม
                if ($result) {
                    $msg = urlencode('เปลี่ยนรหัสผ่านแล้ว');

                    redirect_user("dashboard.php?tab=4&msg=$msg");
                } else {
                    $errors[] = urlencode(
                        'เกิดข้อผิดพลาดกลับไปที่การอัปเดตอีกครั้ง !!'
                    );
                    redirect_user(
                        'dashboard.php?tab=4&error=' .
                            join($errors)
                    );
                }
            } elseif ($staff_level == '') {
                //admin
                $sql = "UPDATE admin SET  
                       password='$password1'
                       WHERE id='$id' ";

                $result = mysqli_query($db_con, $sql);
                //or die ("Error in query: $sql " . mysqli_error());
                mysqli_close($db_con); //ปิดการเชื่อมต่อ database

                //จาวาสคริปแสดงข้อความเมื่อบันทึกเสร็จและกระโดดกลับไปหน้าฟอร์ม
                if ($result) {
                    $msg = urlencode('เปลี่ยนรหัสผ่านแล้ว');

                    redirect_user("admin.php?tab=4&msg=$msg");
                } else {
                    $errors[] = urlencode(
                        'เกิดข้อผิดพลาดกลับไปที่การอัปเดตอีกครั้ง !!'
                    );
                    redirect_user(
                        'admin.php?tab=4&error=' .
                            join($errors)
                    );
                }
            }
        }
    } else {
        if ($staff_level == 'supervisor') {
            redirect_user(
                'dashboard.php?tab=4&error=' . join($errors)
            );
        } elseif ($staff_level == 'non-supervisor') {
            redirect_user(
                'dashboard.php?tab=4&error=' . join($errors)
            );
        } elseif ($staff_level == '') {
            //admin
            redirect_user(
                'admin.php?tab=4&error=' . join($errors)
            );
        }
    }
}

echo "<script type='text/javascript'>";
echo "alert('เกิดข้อผิดพลาดกลับไปที่การอัปเดตอีกครั้ง');";
echo 'window.history.back();';
echo '</script>';
echo 'เกิดข้อผิดพลาดกลับไปที่การอัปเดตอีกครั้ง';