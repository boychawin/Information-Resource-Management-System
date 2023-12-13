<?php
session_start();
// if(isset($_SESSION['username'])){
//     $username = $_SESSION['username'];
// }else{
//     $username = "there";
// }
include 'connection.php';
require_once 'functions.php';

if (isset($_POST['recover_password'])) {
    //$memberemail=$_POST['memberemail'];
    $expire = '';

    if (!isset($_POST['memberemail']) || $_POST['memberemail'] == '') {
        $errors[] = urlencode('ต้องระบุที่อยู่อีเมล');
        header('Location:index.php?tab=9&error=' . join($errors));

        echo "<script type='text/javascript'>";
        echo "alert('ต้องระบุที่อยู่อีเมล');";
        echo 'window.history.back(1);';
        echo '</script>';
        //echo "กรุณเปิดอนุญาตให้ใช้ JavaScript บนเว็บนี้";
    } elseif (
        !(
            strpos($_POST['memberemail'], '.') > 0 &&
            strpos($_POST['memberemail'], '@') > 0
        ) ||
        preg_match('/[^a-zA-Z0-9.@_-]/', $_POST['memberemail'])
    ) {
        $errors[] = urlencode('อีเมลไม่ถูกต้อง');
        header('Location:index.php?tab=9&error=' . join($errors));
        echo "<script type='text/javascript'>";
        echo "alert('อีเมลไม่ถูกต้อง');";
        echo 'window.history.back(1);';
        echo '</script>';
        // echo "กรุณเปิดอนุญาตให้ใช้ JavaScript บนเว็บนี้";
    } else {
        $memberemail = strip_tags(
            trim(htmlspecialchars($_POST['memberemail']))
        );
        $rs = mysqli_query(
            $db_con,
            "select email from employee where email='$memberemail' "
        );
        $row = mysqli_fetch_array($rs);
        $count = mysqli_num_rows($rs);

        if ($rs->num_rows <= 0) {
            //  $errors[] = urlencode("ไม่พบอีเมล หรืออีเมลไม่ถูกต้อง");
            $errors[] = urlencode('ไม่พบอีเมล หรืออีเมลไม่ถูกต้อง');
            header('Location:index.php?tab=9&error=' . join($errors));

            echo "<script type='text/javascript'>";
            echo "alert('ไม่พบอีเมล หรืออีเมลไม่ถูกต้อง');";
            echo 'window.history.back(1);';
            echo '</script>';
            //echo "กรุณเปิดอนุญาตให้ใช้ JavaScript บนเว็บนี้";
        }
        if ($rs->num_rows == 1) {
            $newpass = rand(10000000, 99999999); // ทำการสุ่มสร้างรหัสใหม่
            //$newpass_md5=md5($newpass);  // แปลงเป็น md5 เพื่อบันทึกลงเบส
            $password = password_hash(
                strip_tags(trim($newpass)),
                PASSWORD_DEFAULT
            );

            mysqli_query(
                $db_con,
                "update employee set password='$password' where email='$memberemail' "
            ); // บันทึกรหัสใหม่ลงฐานข้อมูล
            // ส่งรหัสใหม่ให้สมาชิกทางเมล
            //////////////////////////////////////////////////ส่งเมล์
            $mailto = "$memberemail";
            $mailSub = 'รหัสผ่านใหม่';
            $mailMsg =
                $mailSub .
                '<br>' .
                'Email: ' .
                $memberemail .
                '<br>' .
                'รหัสผ่านใหม่ของคุณคือ: ' .
                $newpass .
                '<br>' .
                'เว็บไซต์: ' .
                "<a href='http://localhost/IRMS/pages/index.php?tab=2'>เข้าสู่ระบบ</a>" .
                '<br>' .
                'สถานะ: ' .
                'สำเร็จ';
            require 'PHPMailer/PHPMailerAutoload.php';
            $mail = new PHPMailer();
            $mail->IsSmtp();
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'tls';
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587; // or 587
            $mail->IsHTML(true);
            $mail->CharSet = 'utf-8';
            $mail->ContentType = 'text/html';
            $mail->Username = 'asnru0298@gmail.com'; //username gmail accound
            $mail->Password = '1471200B'; //password gmail accound
            $mail->SetFrom('irms_snru@gmail.com', 'irms_snru');
            // $mail->AddReplyTo("yourmail@gmail.com", "Company name");
            $mail->Subject = $mailSub;
            $mail->Body = $mailMsg;
            $mail->AddAddress($mailto);

            if (!$mail->Send()) {
                echo 'ส่งเมล์ไม่สำเร็จ';
            } else {
                echo 'ส่งเมล์สำเร็จ';
            }

            $subject = 'กู้คืนรหัสผ่านของคุณ';
            $raw_message = "Email $memberemail\r\n";
            $raw_message = "รหัสผ่านใหม่ของคุณคือ $newpass \n";
            $raw_message .= "มีคนขอเปลี่ยนรหัสผ่านของคุณ \n";
            $raw_message .= "เข้าสู่ระบบ https://boychawin.com/ \n";
            $raw_message .=
                "หากคุณไม่ได้ทำตามคำขอเพียงเพิกเฉยต่อข้อความนี้.\r\n\r\nirms";

            $message = wordwrap($raw_message, 70, "\n");

            $from = 'HR:<snru@irms';

            mail($memberemail, $subject, $message);

            $msg = urlencode(
                'สำเร็จ กรุณาเช็ครหัสผ่านใหม่ที่ได้รับที่อีเมลที่ท่านเคยลงทะเบียนไว้'
            );
            header('Location:thankyou.php?msg=' . $msg);
        } else {
           
        }
    }

}