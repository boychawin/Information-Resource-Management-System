<?php
session_start();
require_once 'db.php';

require_once 'functions.php';

if (isset($_POST['register'])) {
    $errors = [];

    if (
        !isset($_POST['g-recaptcha-response']) ||
        $_POST['g-recaptcha-response'] == ''
    ) {
        $errors[] = urlencode('โปรดยืนยันตัวตนของคุณ captcha');
    } else {
        $captcha = strip_tags(
            trim(htmlspecialchars($_POST['g-recaptcha-response']))
        );
        $secretKey = '6LdeLqkZAAAAAKIPv3VWiOJ3Anw1C6uciINda0Y9';
        $ip = $_SERVER['REMOTE_ADDR'];
        $response = file_get_contents(
            'https://www.google.com/recaptcha/api/siteverify?secret=' .
                $secretKey .
                '&response=' .
                $captcha .
                '&remoteip=' .
                $ip
        );
        $responseKeys = json_decode($response, true);
        if (intval($responseKeys['success']) !== 1) {
            echo '<h2>โปรดทำการยันยืนให้ถูกต้อง</h2>';
            $errors[] = urlencode('โปรดทำการยันยืนให้ถูกต้อง');
        } else {
            echo '<h2>ขอบคุณสำหรับคอมเม้น</h2>';
        }
    }
    if (!isset($_POST['email']) || $_POST['email'] == '') {
        $errors[] = urlencode('ต้องระบุที่อยู่อีเมล');
    } elseif (
        !(strpos($_POST['email'], '.') > 0 && strpos($_POST['email'], '@') > 0) ||
        preg_match('/[^a-zA-Z0-9.@_-]/', $_POST['email'])
    ) {
        $errors[] = urlencode('อีเมลไม่ถูกต้อง');
    } else {
        $email = strip_tags(trim(htmlspecialchars($_POST['email'])));
    }

    if (!isset($_POST['username']) || $_POST['username'] == '') {
        $errors[] = urlencode('ต้องระบุชื่อผู้ใช้');
    } elseif (strlen($_POST['username']) < 5) {
        $errors[] = urlencode('ชื่อผู้ใช้ต้องมีความยาว 5 ตัวอักษรขึ้นไป');
    } else {
        $username = strip_tags(trim(htmlspecialchars($_POST['username'])));
    }

    if (!isset($_POST['firstname']) || $_POST['firstname'] == '') {
        $errors[] = urlencode('ชื่อต้องไม่เว้นว่าง');
    } elseif (!preg_match('/[a-zA-Zก-ฮะ-์]/', $_POST['firstname'])) {
        $errors[] = urlencode('ชื่อจะต้องประกอบด้วยตัวอักษรเท่านั้น');
    } else {
        $firstname = strip_tags(trim(htmlspecialchars($_POST['firstname'])));
    }

    if (!isset($_POST['lastname']) || $_POST['lastname'] == '') {
        $errors[] = urlencode('นามสกุลต้องไม่เว้นว่าง');
    } elseif (!preg_match('/[a-zA-Zก-ฮะ-์]/', $_POST['lastname'])) {
        $errors[] = urlencode('นามสกุลต้องประกอบด้วยตัวอักษรเท่านั้น');
    } else {
        $lastname = strip_tags(trim(htmlspecialchars($_POST['lastname'])));
    }

    if (!isset($_POST['password']) || $_POST['password'] == '') {
        $errors[] = urlencode('กรุณาใส่รหัสผ่าน');
    } elseif (strlen($_POST['password']) < 8) {
        $errors[] = urlencode('รหัสผ่านต้องมีอย่างน้อย 8 ตัวอักษร');
    } else {
        $password = password_hash(
            strip_tags(trim($_POST['password'])),
            PASSWORD_DEFAULT
        );
    }

    if (!isset($_POST['phone']) || $_POST['phone'] == '') {
        $errors[] = urlencode('โปรดระบุหมายเลขโทรศัพท์');
    } elseif (!is_numeric($_POST['phone'])) {
        $errors[] = urlencode('หมายเลขโทรศัพท์ไม่ถูกต้อง');
    } else {
        $phone = strip_tags(trim(htmlspecialchars($_POST['phone'])));
    }

    if (!isset($_POST['codepp']) || $_POST['codepp'] == '') {
        $errors[] = urlencode('โปรดระบุเลขที่บัตรประชาชน');
    } elseif (!is_numeric($_POST['codepp'])) {
        $errors[] = urlencode('เลขที่บัตรประชาชนไม่ถูกต้อง');
    } else {
        $staff_id = strip_tags(trim(htmlspecialchars($_POST['codepp'])));
    }

    if (!isset($_POST['position']) || $_POST['position'] == '') {
        $errors[] = urlencode('ต้องระบุตำแหน่ง');
    } elseif (!preg_match('/[a-zA-Zก-ฮะ-์]/', $_POST['position'])) {
        $errors[] = urlencode('ตำแหน่งไม่ถูกต้อง');
    } else {
        $position = strip_tags(trim(htmlspecialchars($_POST['position'])));
    }

    // $position = strip_tags(trim(htmlspecialchars($_POST['position'])));
    $location = strip_tags(trim(htmlspecialchars($_POST['location'])));
    //$ins = strip_tags(trim(htmlspecialchars($_POST['ins'])));
    $ins = '';
    $field_study = '';
    $day_reject = '0';
    $day_rejectend = '0';
    $code = strip_tags(trim(htmlspecialchars($_POST['country-code'])));
    // }

    if (!isset($_POST['title']) || $_POST['title'] == '') {
        $errors[] = urlencode('ต้องระบุชื่อ');
    } elseif (!preg_match('/[a-zA-Zก-ฮะ-์]/', $_POST['title'])) {
        $errors[] = urlencode('ชื่อไม่ถูกต้อง');
    } else {
        $title = strip_tags(trim(htmlspecialchars($_POST['title'])));
    }

    if (!isset($_POST['Faculty']) || $_POST['Faculty'] == '') {
        $errors[] = urlencode('ต้องระบุคณะ');
    } elseif (!preg_match('/[a-zA-Zก-ฮะ-์]/', $_POST['Faculty'])) {
        $errors[] = urlencode('คณะไม่ถูกต้อง');
    } else {
        $Faculty = strip_tags(trim(htmlspecialchars($_POST['Faculty'])));
    }

    ///เพิ่ม or id ใหม่


    $query = $db_con->query("SELECT id FROM employee WHERE username = '$username' ");

    if ($query->num_rows > 0) {
        $errors[] = urlencode('มี ชื่อผู้ใช้ นี้อยู่แล้ว');
    }

    $query1 = $db_con->query("SELECT id FROM employee WHERE email = '$email' ");

    if ($query1->num_rows > 0) {
        $errors[] = urlencode('มีผู้ใช้อีเมลนี้อยู่แล้ว');
    }

    $query2 = $db_con->query("SELECT id FROM employee WHERE  phone = '$phone' ");

    if ($query2->num_rows > 0) {
        $errors[] = urlencode('มีผู้ใช้เบอร์นี้อยู่แล้ว');
    }

    $query3 = $db_con->query("SELECT id FROM employee WHERE staff_id = '$staff_id'");

    if ($query3->num_rows > 0) {
        $errors[] = urlencode('มีผู้ใช้เลขที่บัตรประชาชนอยู่แล้ว');
    }

    $user_registered = date('Y-m-d');
    $total_reject = '0';
    //$staff_id = date('mYdHis');

    ///ส่วนที่ 1 line แจ้งเตือน
    $header = 'สมัครสมาชิก';
    $message =
        $header .
        "\n" .
        'ID: ' .
        $staff_id .
        "\n" .
        'ชื่อผู้ใช้: ' .
        $username .
        "\n" .
        'ชื่อ: ' .
        $firstname .
        "\n" .
        'วันที่สมัคร: ' .
        $user_registered .
        "\n" .
        'อีเมล: ' .
        $email .
        "\n" .
        'สถานะ: ' .
        'รอการอนุมัติ';

    if (!$errors) {
        $stmt = $db_con->prepare("INSERT INTO employee(staff_id,title,fname,
            lname,username,password,position,location,ins,email,country_code,phone,Faculty,field_study,date_registered,total_reject,day_reject,day_rejectend) 
            VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

        $stmt->bind_param(
            'ssssssssssssssssss',
            $staff_id,
            $title,
            $firstname,
            $lastname,
            $username,
            $password,
            $position,
            $location,
            $ins,
            $email,
            $code,
            $phone,
            $Faculty,
            $field_study,
            $user_registered,
            $total_reject,
            $day_reject,
            $day_rejectend
        );

        $stmt->execute();

        $result = $stmt->get_result();

        $row = $db_con->affected_rows;

        if ($row == 1) {
            //Sessions
            if (!session_id()) {
                session_start();
            }

            $_SESSION['staff-level'] = $rows->staff_level;

            $_SESSION['staff-id'] = $staff_id;
        
            $_SESSION['staff-lname'] = $lastname;
            $_SESSION['staff-user'] = $username;

            $_SESSION['staff-user'] = $username;

            $_SESSION['staff-email'] = $email;

            // $_SESSION['staff-id'] = $row->staff_id;

            $_SESSION['staff-fname'] = $firstname;

            $msg = urlencode(
                "ขอแสดงความยินดี $firstname! คุณสมัครสำเร็จ " . 'โปรดเข้าไปที่ยืนยันตัวตนที่อีเมล ที่ท่านได้สมัครไว้เพื่อเปิดใช้งาน...'
            );
            header('Location:thankyou.php?msg=' . $msg);

            ///ส่วนที่ 2 email แจ้งเตือน
            $subject = 'การสมัครสำเร็จ';
            $raw_message = "สวัสดี $username\r\n";
            $raw_message = "ID:$staff_id \n";
            $raw_message .= "ชื่อ:$firstname \n";
            $raw_message .= "วันที่สมัคร:$user_registered \n";
            $raw_message .= "กดยืนยันเพื่อเปิดใช้งาน: https://boychawin.com/irms/pages/activate.php?staff_id=$staff_id&email=$email \n";
            $raw_message .=
                "ปล.กรุณากดยืนยันภายในวันที่สมัคร ถ้าไม่กดภายในวันที่ทำการสมัครลิงค์จะหมดอายุ และต้องรอทางเจ้าหน้าที่อนุมัติหรือไปติดต่อเจ้าหน้าที่นะครับ.\r\n\r\n irms";

            $messag = wordwrap($raw_message, 70, "\n");

            $from = 'HR:<snru@irms';

            mail($email, $subject, $messag);

            ///ส่วนที่ 2 line แจ้งเตือน
            sendlinemesg();
            header('Content-Type: text/html; charset=utf8');
            $res = notify_message($message);
            //////////////////////////////////////////////////ส่งเมล์
            // $mailto = "$email";
            // $mailSub = 'ได้ทำการสมัครสมาชิก';
            // $mailMsg =
            //     $mailSub .
            //     '<br>' .
            //     'ID: ' .
            //     $staff_id .
            //     '<br>' .
            //     'ชื่อผู้ใช้: ' .
            //     $username .
            //     '<br>' .
            //     'ชื่อ: ' .
            //     $firstname .
            //     '<br>' .
            //     'วันที่สมัคร: ' .
            //     $user_registered .
            //     '<br>' .
            //     'สถานะ: ' .
            //     "<a href='https://boychawin.com/irms/pages/activate.php?staff_id=$staff_id&email=$email'>กดยืนยันเพื่อเปิดใช้งาน</a><font color='red' class='extra-sm'> ปล.กรุณากดยืนยันภายในวันที่สมัคร ถ้าไม่กดภายในวันที่ทำการสมัครลิงค์จะหมดอายุ และต้องรอทางเจ้าหน้าที่อนุมัติหรือไปติดต่อเจ้าหน้าที่นะครับ </font>";

            // require 'PHPMailer/PHPMailerAutoload.php';
            // $mail = new PHPMailer();
            // $mail->IsSmtp();
            // $mail->SMTPAuth = true;
            // $mail->SMTPSecure = 'tls';
            // $mail->Host = 'smtp.gmail.com';
            // $mail->Port = 587; // or 587
            // $mail->IsHTML(true);
            // $mail->CharSet = 'utf-8';
            // $mail->ContentType = 'text/html';
            // $mail->Username = 'asnru0298@gmail.com'; //username gmail accound
            // $mail->Password = '1471200B'; //password gmail accound
            // $mail->SetFrom('irms_snru@gmail.com', 'irms_snru');
            // // $mail->AddReplyTo("yourmail@gmail.com", "Company name");
            // $mail->Subject = $mailSub;
            // $mail->Body = $mailMsg;
            // $mail->AddAddress($mailto);

            // if (!$mail->Send()) {
            //     echo 'ส่งเมล์ไม่สำเร็จ';
            // } else {
            //     echo 'ส่งเมล์สำเร็จ';
            // }

            // header('Location:thankyou.php?msg='.$msg);

        } else {
            header(
                'Location:index.php?tab=8?&error=การสมัคร+ไม่สำเร็จ+ข้อมูลซ้ำ+' .
                    'ลองอีกครั้ง'

            );
        }
    } else {
        header('Location:index.php?tab=8&error=' . join($errors, '<br>'));
    }
} elseif (isset($_POST['registeradmin'])) {
    $errors = [];

    if (!isset($_POST['email']) || $_POST['email'] == '') {
        $errors[] = urlencode('ต้องระบุที่อยู่อีเมล');
    } elseif (
        !(strpos($_POST['email'], '.') > 0 && strpos($_POST['email'], '@') > 0) ||
        preg_match('/[^a-zA-Z0-9.@_-]/', $_POST['email'])
    ) {
        $errors[] = urlencode('อีเมลไม่ถูกต้อง');
    } else {
        $email = strip_tags(trim(htmlspecialchars($_POST['email'])));
    }

    if (!isset($_POST['username']) || $_POST['username'] == '') {
        $errors[] = urlencode('ต้องระบุชื่อผู้ใช้');
    } elseif (strlen($_POST['username']) < 5) {
        $errors[] = urlencode('ชื่อผู้ใช้ต้องมีความยาว 5 ตัวอักษรขึ้นไป');
    } else {
        $username = strip_tags(trim(htmlspecialchars($_POST['username'])));
    }

    if (!isset($_POST['firstname']) || $_POST['firstname'] == '') {
        $errors[] = urlencode('ชื่อต้องไม่เว้นว่าง');
    } elseif (!preg_match('/[a-zA-Zก-ฮะ-์]/', $_POST['firstname'])) {
        $errors[] = urlencode('ชื่อจะต้องประกอบด้วยตัวอักษรเท่านั้น');
    } else {
        $firstname = strip_tags(trim(htmlspecialchars($_POST['firstname'])));
    }

    if (!isset($_POST['lastname']) || $_POST['lastname'] == '') {
        $errors[] = urlencode('นามสกุลต้องไม่เว้นว่าง');
    } elseif (!preg_match('/[a-zA-Zก-ฮะ-์]/', $_POST['lastname'])) {
        $errors[] = urlencode('นามสกุลต้องประกอบด้วยตัวอักษรเท่านั้น');
    } else {
        $lastname = strip_tags(trim(htmlspecialchars($_POST['lastname'])));
    }

    if (!isset($_POST['password']) || $_POST['password'] == '') {
        $errors[] = urlencode('กรุณาใส่รหัสผ่าน');
    } elseif (strlen($_POST['password']) < 8) {
        $errors[] = urlencode('รหัสผ่านต้องมีอย่างน้อย 8 ตัวอักษร');
    } else {
        $password = password_hash(
            strip_tags(trim($_POST['password'])),
            PASSWORD_DEFAULT
        );
    }

    if (!isset($_POST['phone']) || $_POST['phone'] == '') {
        $errors[] = urlencode('โปรดระบุหมายเลขโทรศัพท์');
    } elseif (!is_numeric($_POST['phone'])) {
        $errors[] = urlencode('หมายเลขโทรศัพท์ไม่ถูกต้อง');
    } else {
        $phone = strip_tags(trim(htmlspecialchars($_POST['phone'])));
    }

    if (!isset($_POST['codepp']) || $_POST['codepp'] == '') {
        $errors[] = urlencode('โปรดระบุเลขที่บัตรประชาชน');
    } elseif (!is_numeric($_POST['codepp'])) {
        $errors[] = urlencode('เลขที่บัตรประชาชนไม่ถูกต้อง');
    } else {
        $staff_id = strip_tags(trim(htmlspecialchars($_POST['codepp'])));
    }

    if (!isset($_POST['position']) || $_POST['position'] == '') {
        $errors[] = urlencode('ต้องระบุตำแหน่ง');
    } elseif (!preg_match('/[a-zA-Zก-ฮะ-์]/', $_POST['position'])) {
        $errors[] = urlencode('ตำแหน่งไม่ถูกต้อง');
    } else {
        $position = strip_tags(trim(htmlspecialchars($_POST['position'])));
    }

    // $position = strip_tags(trim(htmlspecialchars($_POST['position'])));
    $location = strip_tags(trim(htmlspecialchars($_POST['location'])));
    //$ins = strip_tags(trim(htmlspecialchars($_POST['ins'])));
    $ins = '';
    $field_study = '';
    $day_reject = '0';
    $day_rejectend = '0';
    $code = strip_tags(trim(htmlspecialchars($_POST['country-code'])));
    // }

    if (!isset($_POST['title']) || $_POST['title'] == '') {
        $errors[] = urlencode('ต้องระบุชื่อ');
    } elseif (!preg_match('/[a-zA-Zก-ฮะ-์]/', $_POST['title'])) {
        $errors[] = urlencode('ชื่อไม่ถูกต้อง');
    } else {
        $title = strip_tags(trim(htmlspecialchars($_POST['title'])));
    }

    if (!isset($_POST['Faculty']) || $_POST['Faculty'] == '') {
        $errors[] = urlencode('ต้องระบุคณะ');
    } elseif (!preg_match('/[a-zA-Zก-ฮะ-์]/', $_POST['Faculty'])) {
        $errors[] = urlencode('คณะไม่ถูกต้อง');
    } else {
        $Faculty = strip_tags(trim(htmlspecialchars($_POST['Faculty'])));
    }

    ///เพิ่ม or id ใหม่

    if (var_set($_POST['staff_level'])) {
        $staff_level = $_POST['staff_level'];
    } else {
        $errors[] = urlencode('โปรดใส่สถานะ');
    }
    if (var_set($_POST['staff_username'])) {
        $staff_username = $_POST['staff_username'];
    } else {
        $errors[] = urlencode('โปรดใส่สถานะแอดมิน');
    }


    $query = $db_con->query("SELECT id FROM employee WHERE username = '$username' ");

    if ($query->num_rows > 0) {
        $errors[] = urlencode('มี ชื่อผู้ใช้ นี้อยู่แล้ว');
    }

    $query1 = $db_con->query("SELECT id FROM employee WHERE email = '$email' ");

    if ($query1->num_rows > 0) {
        $errors[] = urlencode('มีผู้ใช้อีเมลนี้อยู่แล้ว');
    }

    $query2 = $db_con->query("SELECT id FROM employee WHERE  phone = '$phone' ");

    if ($query2->num_rows > 0) {
        $errors[] = urlencode('มีผู้ใช้เบอร์นี้อยู่แล้ว');
    }

    $query3 = $db_con->query("SELECT id FROM employee WHERE staff_id = '$staff_id'");

    if ($query3->num_rows > 0) {
        $errors[] = urlencode('มีผู้ใช้เลขที่บัตรประชาชนอยู่แล้ว');
    }

    $user_registered = date('Y-m-d');
    $total_reject = '0';
    //$staff_id = date('mYdHis');

    ///ส่วนที่ 1 line แจ้งเตือน
    $header = 'สมัครสมาชิก';
    $message =
        $header .
        "\n" .
        'ID: ' .
        $staff_id .
        "\n" .
        'ชื่อผู้ใช้: ' .
        $username .
        "\n" .
        'ชื่อ: ' .
        $firstname .
        "\n" .
        'วันที่สมัคร: ' .
        $user_registered .
        "\n" .
        'อีเมล: ' .
        $email .
        "\n" .
        'สถานะ: ' .
        'ได้รับการอนุมัติจากแอดมิน';

    if (!$errors) {
        $stmt = $db_con->prepare("INSERT INTO employee(staff_id,title,fname,
            lname,username,password,position,location,ins,email,country_code,phone,Faculty,field_study,supervisor,staff_level,date_registered,total_reject,day_reject,day_rejectend) 
            VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

        $stmt->bind_param(
            'ssssssssssssssssssss',
            $staff_id,
            $title,
            $firstname,
            $lastname,
            $username,
            $password,
            $position,
            $location,
            $ins,
            $email,
            $code,
            $phone,
            $Faculty,
            $field_study,
            $staff_username,
            $staff_level,
            $user_registered,
            $total_reject,
            $day_reject,
            $day_rejectend
        );

        $stmt->execute();

        $result = $stmt->get_result();

        $row = $db_con->affected_rows;

        if ($row == 1) {
        

            ///ส่วนที่ 2 email แจ้งเตือน
            $subject = 'การสมัครสำเร็จ';
            $raw_message = "สวัสดี $username\r\n";
            $raw_message = "ID:$staff_id \n";
            $raw_message .= "ชื่อ:$firstname \n";
            $raw_message .= "วันที่สมัคร:$user_registered \n";
            $raw_message .= "สถานะ: ได้รับการอนุมัติจากแอดมิน \n";
            $raw_message .= "ไปที่เว็บไซต์ https://boychawin.com/\r\n\r\n irms";

            $messag = wordwrap($raw_message, 70, "\n");

            $from = 'HR:<snru@irms';

            mail($email, $subject, $messag);

            ///ส่วนที่ 2 line แจ้งเตือน
            sendlinemesg();
            header('Content-Type: text/html; charset=utf8');
            $res = notify_message($message);

            $msg = urlencode('สมัครสำเร็จ');

            redirect_user("admin.php?tab=24&msg=$msg");

    

        } else {
            header(
                'Location:admin.php?tab=24?&error=การสมัคร+ไม่สำเร็จ+ข้อมูลซ้ำ+' .
                    'ลองอีกครั้ง'

            );
        }
    } else {
        header('Location:admin.php?tab=24&error=' . join($errors, '<br>'));
    }
} elseif (isset($_POST['registeruser'])) {
    $errors = [];

    if (!isset($_POST['email']) || $_POST['email'] == '') {
        $errors[] = urlencode('ต้องระบุที่อยู่อีเมล');
    } elseif (
        !(strpos($_POST['email'], '.') > 0 && strpos($_POST['email'], '@') > 0) ||
        preg_match('/[^a-zA-Z0-9.@_-]/', $_POST['email'])
    ) {
        $errors[] = urlencode('อีเมลไม่ถูกต้อง');
    } else {
        $email = strip_tags(trim(htmlspecialchars($_POST['email'])));
    }

    if (!isset($_POST['username']) || $_POST['username'] == '') {
        $errors[] = urlencode('ต้องระบุชื่อผู้ใช้');
    } elseif (strlen($_POST['username']) < 5) {
        $errors[] = urlencode('ชื่อผู้ใช้ต้องมีความยาว 5 ตัวอักษรขึ้นไป');
    } else {
        $username = strip_tags(trim(htmlspecialchars($_POST['username'])));
    }

    if (!isset($_POST['firstname']) || $_POST['firstname'] == '') {
        $errors[] = urlencode('ชื่อต้องไม่เว้นว่าง');
    } elseif (!preg_match('/[a-zA-Zก-ฮะ-์]/', $_POST['firstname'])) {
        $errors[] = urlencode('ชื่อจะต้องประกอบด้วยตัวอักษรเท่านั้น');
    } else {
        $firstname = strip_tags(trim(htmlspecialchars($_POST['firstname'])));
    }

    if (!isset($_POST['lastname']) || $_POST['lastname'] == '') {
        $errors[] = urlencode('นามสกุลต้องไม่เว้นว่าง');
    } elseif (!preg_match('/[a-zA-Zก-ฮะ-์]/', $_POST['lastname'])) {
        $errors[] = urlencode('นามสกุลต้องประกอบด้วยตัวอักษรเท่านั้น');
    } else {
        $lastname = strip_tags(trim(htmlspecialchars($_POST['lastname'])));
    }

    if (!isset($_POST['password']) || $_POST['password'] == '') {
        $errors[] = urlencode('กรุณาใส่รหัสผ่าน');
    } elseif (strlen($_POST['password']) < 8) {
        $errors[] = urlencode('รหัสผ่านต้องมีอย่างน้อย 8 ตัวอักษร');
    } else {
        $password = password_hash(
            strip_tags(trim($_POST['password'])),
            PASSWORD_DEFAULT
        );
    }

    if (!isset($_POST['phone']) || $_POST['phone'] == '') {
        $errors[] = urlencode('โปรดระบุหมายเลขโทรศัพท์');
    } elseif (!is_numeric($_POST['phone'])) {
        $errors[] = urlencode('หมายเลขโทรศัพท์ไม่ถูกต้อง');
    } else {
        $phone = strip_tags(trim(htmlspecialchars($_POST['phone'])));
    }

    if (!isset($_POST['codepp']) || $_POST['codepp'] == '') {
        $errors[] = urlencode('โปรดระบุเลขที่บัตรประชาชน');
    } elseif (!is_numeric($_POST['codepp'])) {
        $errors[] = urlencode('เลขที่บัตรประชาชนไม่ถูกต้อง');
    } else {
        $staff_id = strip_tags(trim(htmlspecialchars($_POST['codepp'])));
    }

    if (!isset($_POST['position']) || $_POST['position'] == '') {
        $errors[] = urlencode('ต้องระบุตำแหน่ง');
    } elseif (!preg_match('/[a-zA-Zก-ฮะ-์]/', $_POST['position'])) {
        $errors[] = urlencode('ตำแหน่งไม่ถูกต้อง');
    } else {
        $position = strip_tags(trim(htmlspecialchars($_POST['position'])));
    }

    // $position = strip_tags(trim(htmlspecialchars($_POST['position'])));
    $location = strip_tags(trim(htmlspecialchars($_POST['location'])));
    //$ins = strip_tags(trim(htmlspecialchars($_POST['ins'])));
    $ins = '';
    $field_study = '';
    $day_reject = '0';
    $day_rejectend = '0';
    $code = strip_tags(trim(htmlspecialchars($_POST['country-code'])));
    // }

    if (!isset($_POST['title']) || $_POST['title'] == '') {
        $errors[] = urlencode('ต้องระบุชื่อ');
    } elseif (!preg_match('/[a-zA-Zก-ฮะ-์]/', $_POST['title'])) {
        $errors[] = urlencode('ชื่อไม่ถูกต้อง');
    } else {
        $title = strip_tags(trim(htmlspecialchars($_POST['title'])));
    }

    if (!isset($_POST['Faculty']) || $_POST['Faculty'] == '') {
        $errors[] = urlencode('ต้องระบุคณะ');
    } elseif (!preg_match('/[a-zA-Zก-ฮะ-์]/', $_POST['Faculty'])) {
        $errors[] = urlencode('คณะไม่ถูกต้อง');
    } else {
        $Faculty = strip_tags(trim(htmlspecialchars($_POST['Faculty'])));
    }

    ///เพิ่ม or id ใหม่

    if (var_set($_POST['staff_level'])) {
        $staff_level = $_POST['staff_level'];
    } else {
        $errors[] = urlencode('โปรดใส่สถานะ');
    }
    if (var_set($_POST['staff_username'])) {
        $staff_username = $_POST['staff_username'];
    } else {
        $errors[] = urlencode('โปรดใส่สถานะเจ้าหน้าที่');
    }


    $query = $db_con->query("SELECT id FROM employee WHERE username = '$username' ");

    if ($query->num_rows > 0) {
        $errors[] = urlencode('มี ชื่อผู้ใช้ นี้อยู่แล้ว');
    }

    $query1 = $db_con->query("SELECT id FROM employee WHERE email = '$email' ");

    if ($query1->num_rows > 0) {
        $errors[] = urlencode('มีผู้ใช้อีเมลนี้อยู่แล้ว');
    }

    $query2 = $db_con->query("SELECT id FROM employee WHERE  phone = '$phone' ");

    if ($query2->num_rows > 0) {
        $errors[] = urlencode('มีผู้ใช้เบอร์นี้อยู่แล้ว');
    }

    $query3 = $db_con->query("SELECT id FROM employee WHERE staff_id = '$staff_id'");

    if ($query3->num_rows > 0) {
        $errors[] = urlencode('มีผู้ใช้เลขที่บัตรประชาชนอยู่แล้ว');
    }

    $user_registered = date('Y-m-d');
    $total_reject = '0';
    //$staff_id = date('mYdHis');

    ///ส่วนที่ 1 line แจ้งเตือน
    $header = 'สมัครสมาชิก';
    $message =
        $header .
        "\n" .
        'ID: ' .
        $staff_id .
        "\n" .
        'ชื่อผู้ใช้: ' .
        $username .
        "\n" .
        'ชื่อ: ' .
        $firstname .
        "\n" .
        'วันที่สมัคร: ' .
        $user_registered .
        "\n" .
        'อีเมล: ' .
        $email .
        "\n" .
        'สถานะ: ' .
        'ได้รับการอนุมัติจากเจ้าหน้าที่';

    if (!$errors) {
        $stmt = $db_con->prepare("INSERT INTO employee(staff_id,title,fname,
            lname,username,password,position,location,ins,email,country_code,phone,Faculty,field_study,supervisor,staff_level,date_registered,total_reject,day_reject,day_rejectend) 
            VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

        $stmt->bind_param(
            'ssssssssssssssssssss',
            $staff_id,
            $title,
            $firstname,
            $lastname,
            $username,
            $password,
            $position,
            $location,
            $ins,
            $email,
            $code,
            $phone,
            $Faculty,
            $field_study,
            $staff_username,
            $staff_level,
            $user_registered,
            $total_reject,
            $day_reject,
            $day_rejectend
        );

        $stmt->execute();

        $result = $stmt->get_result();

        $row = $db_con->affected_rows;

        if ($row == 1) {
        

            ///ส่วนที่ 2 email แจ้งเตือน
            $subject = 'การสมัครสำเร็จ';
            $raw_message = "สวัสดี $username\r\n";
            $raw_message = "ID:$staff_id \n";
            $raw_message .= "ชื่อ:$firstname \n";
            $raw_message .= "วันที่สมัคร:$user_registered \n";
            $raw_message .= "สถานะ: ได้รับการอนุมัติจากเจ้าหน้าที่ \n";
            $raw_message .= "ไปที่เว็บไซต์ https://boychawin.com/\r\n\r\n irms";

            $messag = wordwrap($raw_message, 70, "\n");

            $from = 'HR:<snru@irms';

            mail($email, $subject, $messag);

            ///ส่วนที่ 2 line แจ้งเตือน
            sendlinemesg();
            header('Content-Type: text/html; charset=utf8');
            $res = notify_message($message);

            $msg = urlencode('สมัครสำเร็จ');

            redirect_user("dashboard.php?tab=19&msg=$msg");

    

        } else {
            header(
                'Location:dashboard.php?tab=19?&error=การสมัคร+ไม่สำเร็จ+ข้อมูลซ้ำ+' .
                    'ลองอีกครั้ง'

            );
        }
    } else {
        header('Location:dashboard.php?tab=19&error=' . join($errors, '<br>'));
    }
} elseif (isset($_POST['make-super'])) {
    if (var_set($_POST['make-supervisor'])) {
        if (is_string($_POST['make-supervisor'])) {
            $make_super = $_POST['make-supervisor'];

            $tab = $_POST['tab'];

            $result = $db_con->query(
                "UPDATE employee SET supervisor = 'N/A', staff_level = 'supervisor' " .
                    "WHERE username = '$make_super'"
            );

            if ($db_con->affected_rows == 1) {
                $name = ucfirst($make_super);

                $msg = urlencode("$name ได้รับการแต่งตั้งเป็นหัวหน้างาน");

                redirect_user("admin.php?tab=$tab&msg=$msg");
            } else {
                $msg = urlencode(
                    'เกิดข้อผิดพลาด. ลองอีกครั้ง ' . $db_con->error
                );

                redirect_user("admin.php?tab=5&error=$msg");
            }
        } else {
            redirect_user('admin.php?tab=5&error=Invalid+value+selected');
        }
    }
} elseif (isset($_POST['assign-super'])) {
    if (var_set($_POST['assign-to'])) {
        $error = [];

        if (is_string($_POST['supervisor'])) {
            $super = $_POST['supervisor'];
        } else {
            $error[] = urlencode('ไม่ถูกต้อง');
        }

        if (is_string($_POST['assign-to'])) {
            $username = $_POST['assign-to'];
        } else {
            $error[] = urlencode('ผู้ใช้ที่เลือกไม่ถูกต้อง');
        }
    }

    if (!$error) {
        $result = $db_con->query(
            "UPDATE employee SET supervisor = '$super', staff_level = 'non-supervisor' " .
                "WHERE username = '$username'"
        );

        if ($db_con->affected_rows == 1) {
            $name = ucfirst($username);

            $sup = ucfirst($super);

            $msg = urlencode("$name ได้รับมอบหมายให้ $sup");

            redirect_user("admin.php?tab=5&msg=$msg");
        } else {
            $msg = urlencode('เกิดข้อผิดพลาด. ลองอีกครั้ง ' . $db_con->error);

            redirect_user("admin.php?tab=5&error=$msg");
        }
    } else {
        redirect_user(
            'admin.php?tab=5&error=' . join($error, urlencode('<br>'))
        );
    }
} elseif (isset($_POST['accept'])) {
    $error = [];

    if (var_set($_POST['ide']) && is_numeric($_POST['ide'])) {
        $ide = $_POST['ide'];
    }

    if (var_set($_POST['staff_id']) && is_numeric($_POST['staff_id'])) {
        $staff_id = $_POST['staff_id'];
    }

    if (var_set($_POST['booking_id']) && is_numeric($_POST['booking_id'])) {
        $booking_id = $_POST['booking_id'];
    }

    if (var_set($_POST['email'])) {
        $email = $_POST['email'];
    }

    if (var_set($_POST['firstname'])) {
        $firstname = $_POST['firstname'];
    }

    if (var_set($_POST['booking_type'])) {
        $booking_type = $_POST['booking_type'];
    } else {
        $error[] = urlencode('เกิดข้อผิดพลาด. ลองอีกครั้ง');
    }

    if (var_set($_POST['num_days']) && is_numeric($_POST['num_days'])) {
        $num_days = $_POST['num_days'];
    } else {
        $error[] = urlencode('เกิดข้อผิดพลาด. ลองอีกครั้ง');
    }

    $date_accepted = date('d-m-Y');

    if (!$error) {
        $result = $db_con->query("UPDATE recommended_booking SET status = 'accepted' 
            WHERE id = $ide AND staff_id = $staff_id");

        if ($db_con->affected_rows == 1) {
            $stmt = $db_con->prepare("INSERT INTO accepted_booking(booking_id,staff_id,
            booking_type,num_days,date_accepted) VALUES(?,?,?,?,?)");

            $stmt->bind_param(
                'iisis',
                $booking_id,
                $staff_id,
                $booking_type,
                $num_days,
                $date_accepted
            );

            $stmt->execute();

            if ($db_con->affected_rows == 1) {
                $msg = urlencode('สำเร็จ');
                redirect_user("admin.php?tab=3&msg=$msg");
                //$firstname = ucfirst($firstname);

                // $to = "$email";

                // $subject = 'ได้รับการยอมรับ';
                // $raw_message = "สวัสดี: $firstname \r\n";
                // $raw_message = "เลขที่: $booking_id \r\n";
                // $raw_message = "ได้รับการยอมรับ \n";
                // $raw_message .=
                //     "ไปที่เว็บไซต์ https://boychawin.com/\r\n\r\n irms";

                // $message = wordwrap($raw_message, 70, "\n\t");

                // $from = 'asnru0298@gmail.com';

                // if (mail($to, $subject, $message, $from)) {
                //     $msg = urlencode('ได้รับการยอมรับ');

                //     redirect_user("dashboard.php?tab=7&msg=$msg");
                // }
            } else {
                $msg = urlencode('ไม่สามารถยอมรับคำขอ');

                redirect_user("admin.php?tab=3&error=$msg");
            }
        } else {
            $msg = urlencode('มีข้อผิดพลาด ลองอีกครั้ง' . $db_con->error);

            redirect_user("admin.php?tab=3&error=$msg");
        }
    } else {
        redirect_user(
            'admin.php?tab=5&error=' . join($error, urlencode('<br>'))
        );
    }
} elseif (isset($_POST['approve'])) {
    $err = [];

    if (var_set($_POST['staff_id'])) {
        $staff_id = intval(strip_tags($_POST['staff_id']));
    } else {
        $err[] = urlencode('ไม่สามารถอนุมัติได้ ลองอีกครั้ง');
    }

    if (var_set($_POST['id'])) {
        $id = intval(strip_tags($_POST['id']));
    } else {
        $err[] = urlencode('ไม่สามารถอนุมัติได้ กรุณาลองอีกครั้ง');
    }

    if (!$err) {
        $res = $db_con->query("UPDATE employee set staff_level = 'non-supervisor' 
             WHERE id = $id AND staff_id = $staff_id");

        if ($db_con->affected_rows == 1) {
            $msg = urlencode('ได้รับการอนุมัติ สำเร็จ');
            redirect_user("admin.php?tab=2&msg=$msg");

            $subject = 'ได้รับการอนุมัติการสมัครจากเจ้าหน้าที่';
            $raw_message =
                "สถานะ: ได้รับการอนุมัติการสมัครจากเจ้าหน้าที่ \r\n";
            $raw_message = "ไปที่เว็บไซต์ https://boychawin.com/ \n";
            $raw_message .= "ไปที่เว็บไซต์ https://boychawin.com/\r\n\r\n irms";

            $message = wordwrap($raw_message, 70, "\n");

            $from = 'HR:<snru@irms';

            mail($email, $subject, $message);
        } else {
            $msg = urlencode('ได้รับการอนุมัติ สำเร็จ');
            redirect_user("admin.php?tab=2&msg=$msg");
        }
    } else {
        redirect_user('admin.php?error=' . join($err, urlencode('<br>')));
    }
} elseif (isset($_POST['noapprove'])) {
    $err = [];

    if (var_set($_POST['staff_id'])) {
        $staff_id = intval(strip_tags($_POST['staff_id']));
    } else {
        $err[] = urlencode('ไม่สามารถอนุมัติได้ ลองอีกครั้ง');
    }

    if (var_set($_POST['id'])) {
        $id = intval(strip_tags($_POST['id']));
    } else {
        $err[] = urlencode('ไม่สามารถอนุมัติได้ กรุณาลองอีกครั้ง');
    }

    if (!$err) {
        $res = $db_con->query("UPDATE employee set staff_level = 'noadmin' 
             WHERE id = $id AND staff_id = $staff_id");

        if ($db_con->affected_rows == 1) {
            $msg = urlencode('ไม่ได้รับการอนุมัติ สำเร็จ');
            redirect_user("admin.php?tab=2&msg=$msg");

            $subject = 'ไม่ได้รับการอนุมัติการสมัครจากเจ้าหน้าที่';
            $raw_message =
                "สถานะ: ไม่ได้รับการอนุมัติการสมัครจากเจ้าหน้าที่ \r\n";
            $raw_message = "ไปที่เว็บไซต์ https://boychawin.com/ \n";
            $raw_message .= "ไปที่เว็บไซต์ https://boychawin.com/\r\n\r\n irms";

            $message = wordwrap($raw_message, 70, "\n");

            $from = 'HR:<snru@irms';

            mail($email, $subject, $message);
        } else {
            $msg = urlencode('ไม่ได้รับการอนุมัติ สำเร็จ');
            redirect_user("admin.php?tab=2&msg=$msg");
        }
    } else {
        redirect_user('admin.php?error=' . join($err, urlencode('<br>')));
    }
} elseif (isset($_POST['publish'])) {
    $errors = [];

    if (var_set($_POST['date_joined'])) {
        $date_joined = strip_tags($_POST['date_joined']);
    } else {
        $errors[] = urlencode('วันที่เข้าร่วม');
    }

    if (var_set($_POST['salary_level'])) {
        $salary_level = strip_tags($_POST['salary_level']);
    } else {
        $errors[] = urlencode('ต้องระบุ');
    }

    if (var_set($_POST['staff_id'])) {
        $staff_id = strip_tags($_POST['staff_id']);
    } else {
        $errors[] = urlencode('กรุณาเลือกพนักงาน');
    }

    if (!$errors) {
        $res = $db_con->query(
            "SELECT * FROM job_description WHERE staff_id = $staff_id"
        );

        if ($res->num_rows > 0) {
            redirect_user(
                'admin.php?tab=6&error=Job+description+already+exists+for+staff'
            );
        } else {
            $rows = query_db(
                "SELECT staff_level FROM employee WHERE staff_id = $staff_id"
            );

            $stmt = $db_con->prepare("INSERT INTO job_description(staff_id, 
            staff_level,salary_level,date_joined) VALUES(?,?,?,?)");
            echo "<h1>Errors: $db_con->error</h1>";
            $stmt->bind_param(
                'isis',
                $staff_id,
                $rows->staff_level,
                $salary_level,
                $date_joined
            );

            $stmt->execute();

            if ($db_con->affected_rows == 1) {
                $msg = urlencode('Job description added successfully');
                redirect_user("admin.php?tab=6&msg=$msg");
            }
        }
    } else {
        redirect_user(
            'admin.php?tab=6&error=' . join($errors, urlencode('<br>'))
        );
    }
} elseif (isset($_POST['staff_meta'])) {
    $errors = [];

    if (var_set($_POST['annual_booking_days_allowed'])) {
        $allowed_days = strip_tags($_POST['annual_booking_days_allowed']);
    } else {
        $errors[] = urlencode('โปรดระบุจำนวนวันสูงสุดที่อนุญาตต่อปี');
    }

    if (var_set($_POST['annual_booking_days_allowed'])) {
        $allowed_monthly_days = strip_tags(
            $_POST['monthly_booking_days_allowed']
        );
    } else {
        $errors[] = urlencode('โปรดระบุจำนวนวันสูงสุดที่อนุญาตต่อปี');
    }

    if (var_set($_POST['staff_level'])) {
        $staff_level = strip_tags($_POST['staff_level']);
    } else {
        $errors[] = urlencode('กรุณาเลือกระดับพนักงาน');
    }

    if (!$errors) {
        $res = $db_con->query(
            "SELECT * FROM user_booking_metadata WHERE staff_level = '$staff_level'"
        );

        if ($res->num_rows > 0) {
            redirect_user(
                "admin.php?tab=8&error=Data+already+exists+for+$staff_level"
            );
        } else {
            $stmt = $db_con->prepare("INSERT INTO user_booking_metadata(staff_level,
            total_yr_booking_count,total_month_booking_count) VALUES(?,?,?)");
            $stmt->bind_param(
                'sii',
                $staff_level,
                $allowed_days,
                $allowed_monthly_days
            );

            $stmt->execute();

            if ($db_con->affected_rows == 1) {
                $msg = urlencode('มีการเพิ่มข้อมูลพนักงาน');
                redirect_user("admin.php?tab=8&msg=$msg");
            } else {
                redirect_user(
                    'admin.php?tab=8&error=Could+not+create+booking+metadata+' .
                        $db_con->error
                );
            }
        }
    } else {
        redirect_user(
            'admin.php?tab=8&error=' . join($errors, urlencode('<br>'))
        );
    }
} elseif (isset($_POST['reject'])) {
    $error = [];

    if (var_set($_POST['ide']) && is_numeric($_POST['ide'])) {
        $ide = $_POST['ide'];
    }
    if (var_set($_POST['booking_type'])) {
        $booking_type = strval($_POST['booking_type']);
    } else {
        $error[] = urlencode('ขออภัยเกิดข้อผิดพลาด.');
    }

    if (var_set($_POST['email'])) {
        $email = $_POST['email'];
    }

    if (var_set($_POST['firstname'])) {
        $firstname = $_POST['firstname'];
    }

    if (var_set($_POST['booking_id'])) {
        $booking_id = intval($_POST['booking_id']);
    } else {
        $error[] = urlencode('ขออภัยเกิดข้อผิดพลาด.');
    }

    if (var_set($_POST['staff_id'])) {
        $staff_id = intval($_POST['staff_id']);
    } else {
        $error[] = urlencode('ขออภัยเกิดข้อผิดพลาด.');
    }

    if (!$error) {
        $date_rejected = date('d-m-Y');

        $result = $db_con->query("UPDATE recommended_booking SET status = 'rejected' 
            WHERE id = $ide AND staff_id = $staff_id");

        if ($db_con->affected_rows == 1) {
            $stmt = $db_con->prepare("INSERT INTO rejected_booking(booking_id,staff_id,
                booking_type,date_rejected) VALUES(?,?,?,?)");

            $stmt->bind_param(
                'iiss',
                $booking_id,
                $staff_id,
                $booking_type,
                $date_rejected
            );

            $stmt->execute();

            if ($db_con->affected_rows == 1) {
                $msg = urlencode('สำเร็จ');
                redirect_user("admin.php?tab=3&msg=$msg");
                // $firstname = ucfirst($firstname);

                // $to = $email;

                // $subject = 'ถูกปฏิเสธ';
                // $raw_message = "สวัสดี: $firstname \r\n";
                // $raw_message = "เลขที่: $booking_id \r\n";
                // $raw_message = "ขออภัยในความไม่สะดวก \n";
                // $raw_message .=
                //     "ไปที่เว็บไซต์ https://boychawin.com/\r\n\r\n irms";

                // $message = wordwrap($raw_message, 70, "\n\t");

                // $from = 'asnru0298@gmail.com';

                // if (mail($to, $subject, $message, $from)) {
                //     $msg = urlencode('ถูกปฏิเสธ');

                //     redirect_user("dashboard.php?tab=7&msg=$msg");
                // }
            } else {
                redirect_user(
                    'admin.php?tab=3&error=booking+could+not+be+rejected+' .
                        $db_con->error
                );
            }
        } else {
            redirect_user(
                'admin.php?tab=3&error=booking+could+not+be+rejected+' .
                    $db_con->error
            );
        }
    } else {
        redirect_user(
            'admin.php?tab=3&error=' . join($error, urlencode('<br>'))
        );
    }
} else {
    redirect_user('404.php');
}