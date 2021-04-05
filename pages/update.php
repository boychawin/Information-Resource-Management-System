<?php


require_once 'functions.php';

if (isset($_POST['update'])) {
    $err = [];

    if (var_set($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    } else {
        $err[] = urlencode('ระบุรหัสผ่าน');
    }

    if (var_set($_POST['confpassword'])) {
        $confpass = password_hash($_POST['confpassword'], PASSWORD_DEFAULT);
    } else {
        $err[] = urlencode('ยืนยันรหัสผ่าน');
    }

    if (var_set($_POST['phone'])) {
        $phone = strip_tags($_POST['phone']);
    } else {
        $err[] = urlencode('ระบุหมายเลขโทรศัพท์');
    }

    $id = var_set($_POST['id']) ? intval($id) : '';

    if (var_set($_POST['email'])) {
        $email = strip_tags($_POST['email']);
    } else {
        $err[] = urlencode('กรอกอีเมลของคุณ');
    }

    if (!$err) {
        if ($confpass == $password) {
            $query = $db_con->query(
                "UPDATE employee SET email = '$email', phone = $phone, password = '$password' WHERE id = $id"
            );

            $affected = $db_con->affected_rows;

            if ($affected == 1) {
                $msg = urlencode('ข้อมูลของคุณได้รับการปรับปรุง');

                header('Location:dashboard.php?tab=4&msg=' . $msg);
            } else {
                $error = urlencode(
                    'ไม่สามารถดำเนินการตามคำขอของคุณ ลองอีกครั้ง' .
                        $db_con->error
                );

                header('Location:dashboard.php?tab=4&error=' . $error);
            }
        } else {
            $error = urlencode('รหัสผ่านไม่ตรงกัน');

            header('Location:dashboard.php?tab=4&error=' . $error);
        }
    } else {
        header(
            'Location:admin.php?tab=4&error=' . join($err, urlencode('<br'))
        );
    }
} else {
    header('Location:dashboard.php?tab=4');
}