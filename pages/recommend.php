<?php
include_once 'functions.php';

if (isset($_POST['accept'])) {
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

    if (var_set($_POST['booking_type']) && is_string($_POST['booking_type'])) {
        $booking_type = $_POST['booking_type'];
    }

    if (var_set($_POST['num_days']) && is_numeric($_POST['num_days'])) {
        $num_days = $_POST['num_days'];
    }

    if (
        var_set($_POST['recommended_by']) &&
        is_string($_POST['recommended_by'])
    ) {
        $recommended_by = $_POST['recommended_by'];
    } else {
        $error[] = urlencode('เกิดข้อผิดพลาด. โดย');
    }

    if (
        var_set($_POST['why_recommend']) &&
        is_string($_POST['why_recommend'])
    ) {
        $why_recommend = $_POST['why_recommend'];
    } else {
        $why_recommend = '';
    }

    $date_accepted = date('d-m-Y');

    if (!$error) {
        $result = $db_con->query("UPDATE booking_applications SET action = 'accept' 
            WHERE  id = $ide AND staff_id = $staff_id");

        if ($db_con->affected_rows == 1) {
            $stmt = $db_con->prepare("INSERT INTO recommended_booking(booking_id,staff_id,
            booking_type,recommended_by,num_days,why_recommend,date_recommended) VALUES(?,?,?,?,?,?,?)");

            $stmt->bind_param(
                'iississ',
                $booking_id,
                $staff_id,
                $booking_type,
                $recommended_by,
                $num_days,
                $why_recommend,
                $date_accepted
            );

            $stmt->execute();

            if ($db_con->affected_rows == 1) {
                //////////////////////////////////////////////////ส่งเมล์
                $mailto = "$email";
                $mailSub = 'เจ้าหน้าที่ได้ทำตรวจสอบรายการที่ท่านร้องขอแล้ว';
                $mailMsg =
                    $mailSub .
                    '<br>' .
                    'เลขรายการ: ' .
                    $ide .
                    '<br>' .
                    'รายการจอง: ' .
                    $booking_type .
                    '<br>' .
                    'ร้องขอเมื่อ: ' .
                    $date_accepted .
                    '<br>' .
                    'สถานะ: ' .
                    "<font color='green' class='extra-sm'>ได้รับการอนุมัติแล้ว  </font>" .
                    '<br>' .
                    'ไปที่เว็บไซต์: ' .
                    "<a href='https://boychawin.com/irms/pages/index'>http://localhost/irms/pages/index</a>";

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

                header('Location:thankyou.php?msg=' . $msg);
                $msg = urlencode('สำเร็จ');
                //////////////////////////////////////////////////
                redirect_user("dashboard.php?tab=7&msg=$msg");
                $firstname = ucfirst($firstname);

                $to = "$email";

                // $subject = 'คำร้องขอจองได้รับอนุมัติ';
                // $raw_message = "
                // สวัสดี: $firstname 
                // เลขที่: $booking_id 
                // เลขรายการ: $ide 
                // ร้องขอเมื่อ: $date_accepted 
                // สถานะ : ได้รับการอนุมัติแล้ว 
                // ไปที่เว็บไซต์ https://boychawin.com";

                $subject = 'คำร้องขอจองได้รับอนุมัติ';
                $raw_message = "สวัสดี $firstname\r\n";
                $raw_message = "รายการ:$booking_type \n";
                $raw_message .= "เลขรายการ:$ide \n";
                $raw_message .= "ร้องขอเมื่อ:$date_accepted \n";
                $raw_message .= "สถานะ: ได้รับการอนุมัติแล้ว \n";
                $raw_message .=
                    "ไปที่เว็บไซต์ https://boychawin.com.\r\n\r\n irms";
    
                $messag = wordwrap($raw_message, 70, "\n");

                $from = 'HR: <asnru0298@gmail.com>';

                if (mail($to, $subject, $messag, $from)) {
                    $msg = urlencode('สำเร็จ');
                    redirect_user("dashboard.php?tab=7&msg=$msg");
                }
            } else {
                $msg = urlencode('ไม่สำเร็จ');

                redirect_user("dashboard.php?tab=7&error=$msg");
            }
        } else {
            // $msg = urlencode('สำเร็จ ' . $db_con->error);

            // redirect_user("dashboard.php?tab=7&error=$msg");
            $msg = urlencode('สำเร็จ');
                    redirect_user("dashboard.php?tab=7&msg=$msg");
        }
    } else {
        redirect_user(
            'dashboard.php?tab=7&error=' . join($error)
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
        $error[] = urlencode('ขออภัยเกิดข้อผิดพลาด');
    }

    if (var_set($_POST['booking_id'])) {
        $booking_id = intval($_POST['booking_id']);
    }
    // if(var_set($_POST['email']) && is_numeric($_POST['email'])){

    //     $email = $_POST['email'];
    // }
    $email = $_REQUEST['email'];
    if (var_set($_POST['firstname']) && is_numeric($_POST['firstname'])) {
        $firstname = $_POST['firstname'];
    }

    if (var_set($_POST['staff_id'])) {
        $staff_id = intval($_POST['staff_id']);
    } else {
        $error[] = urlencode('ขออภัยเกิดข้อผิดพลาด');
    }

    if (var_set($_POST['reason'])) {
        $reason = strval($_POST['reason']);
    } else {
        $reason = '';
    }

    if (!$error) {
        $date_rejected = date('d-m-Y');

        $result = $db_con->query("UPDATE booking_applications SET action = 'reject',reason_reject='$reason' 
            WHERE  id = $ide AND staff_id = $staff_id");

        if ($db_con->affected_rows == 1) {
            $stmt = $db_con->prepare("INSERT INTO rejected_booking(booking_id,staff_id,
                booking_type,reason_reject,date_rejected) VALUES(?,?,?,?,?)");

            $stmt->bind_param(
                'iisss',
                $booking_id,
                $staff_id,
                $booking_type,
                $reason,
                $date_rejected
            );

            $stmt->execute();

            if ($db_con->affected_rows == 1) {
                //////////////////////////////////////////////////ส่งเมล์
                $mailto = $email;
                $mailSub = 'เจ้าหน้าที่ได้ทำตรวจสอบรายการที่ท่านร้องขอแล้ว';
                $mailMsg =
                    $mailSub .
                    '<br>' .
                    'เลขรายการ: ' .
                    $ide .
                    '<br>' .
                    'รายการจอง: ' .
                    $booking_type .
                    '<br>' .
                    'ร้องขอเมื่อ: ' .
                    $date_rejected .
                    '<br>' .
                    'สถานะ: ' .
                    "<font color='red' class='extra-sm'>ไม่ได้รับการอนุมัติ  </font>" .
                    '<br>' .
                    'ไปที่เว็บไซต์: ' .
                    "<a href='http://localhost/irms/pages/index'>http://localhost/irms/pages/index</a>";

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

                // header('Location:thankyou.php?msg='.$msg);

                //////////////////////////////////////////////////
                $msg = urlencode('สำเร็จ');
                redirect_user("dashboard.php?tab=7&msg=$msg");
                // $firstname = ucfirst($firstname);

                $to = "$email";
               // $reason = wordwrap($reason, 70, '\r\n');
                 
                // $raw_message = "สวัสดี: $firstname \r\n";
                // $raw_message = "เลขที่: $booking_id \n";
                // $raw_message = "เลขรายการ: $ide \n";
                // $raw_message = "ร้องขอเมื่อ: $date_accepted \n";
                // $raw_message = "เหตุผล: $reason \n";
                // $raw_message = "สถานะ : ไม่ได้รับการอนุมัติ\n";
                // $raw_message .=
                //     "ไปที่เว็บไซต์ https://boychawin.com/\r\n\r\n irms";

                $subject = 'คำร้องขอจองไม่ได้รับอนุมัติทดสอบ';
                $raw_message = "สวัสดี $firstname\r\n";
                $raw_message = "รายการ:$booking_type \n";
                $raw_message .= "เลขรายการ:$ide \n";
                $raw_message .= "เหตุผล:$reason \n";
                $raw_message .= "สถานะ: ไม่ได้รับการอนุมัติ \n";
                $raw_message .=
                    "ไปที่เว็บไซต์ https://boychawin.com.\r\n\r\n irms";
    
                $messag = wordwrap($raw_message, 70, "\n");

                //     $subject = 'คำร้องขอจองไม่ได้รับอนุมัติ';
                //     $raw_message = "
                //     เลขที่: $booking_id 
                //     เลขรายการ: $ide 
                //     เหตุผล: $reason
                //     สถานะ : ไม่ได้รับการอนุมัติ 
                //     ไปที่เว็บไซต์ https://boychawin.com";

                
                // $msg = wordwrap($raw_message, 1000, "\n");

                $from = 'HR: <asnru0298@gmail.com>';

                if (mail($to, $subject, $messag, $from)) {
                    $msg = urlencode('สำเร็จ');

                    redirect_user("dashboard.php?tab=7&msg=$msg");
                }
            } else {
                redirect_user(
                    'dashboard.php?tab=7&error=booking+could+not+be+rejected+' .
                        $db_con->error
                );
            }
        } else {
            redirect_user(
                'dashboard.php?tab=7&error=booking+could+not+be+rejected+' .
                    $db_con->error
            );
        }
    } else {
        redirect_user(
            'dashboard.php?tab=7&error=' . join($error)
        );
    }
} elseif (isset($_POST['accept2'])) {
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

    if (var_set($_POST['booking_type']) && is_string($_POST['booking_type'])) {
        $booking_type = $_POST['booking_type'];
    }

    if (var_set($_POST['num_days']) && is_numeric($_POST['num_days'])) {
        $num_days = $_POST['num_days'];
    }

    if (
        var_set($_POST['recommended_by']) &&
        is_string($_POST['recommended_by'])
    ) {
        $recommended_by = $_POST['recommended_by'];
    } else {
        $error[] = urlencode('เกิดข้อผิดพลาด. โดย');
    }

    if (
        var_set($_POST['why_recommend']) &&
        is_string($_POST['why_recommend'])
    ) {
        $why_recommend = $_POST['why_recommend'];
    } else {
        $why_recommend = '';
    }

    $date_accepted = date('d-m-Y');

    if (!$error) {
        $result = $db_con->query("UPDATE booking_applications SET action = 'accept' 
                WHERE  id = $ide AND staff_id = $staff_id");

        if ($db_con->affected_rows == 1) {
            $stmt = $db_con->prepare("INSERT INTO recommended_booking(booking_id,staff_id,
                booking_type,recommended_by,num_days,why_recommend,date_recommended) VALUES(?,?,?,?,?,?,?)");

            $stmt->bind_param(
                'iississ',
                $booking_id,
                $staff_id,
                $booking_type,
                $recommended_by,
                $num_days,
                $why_recommend,
                $date_accepted
            );

            $stmt->execute();

            if ($db_con->affected_rows == 1) {
                //////////////////////////////////////////////////ส่งเมล์
                $mailto = "$email";
                $mailSub = 'เจ้าหน้าที่ได้ทำตรวจสอบรายการที่ท่านร้องขอแล้ว';
                $mailMsg =
                    $mailSub .
                    '<br>' .
                    'เลขรายการ: ' .
                    $ide .
                    '<br>' .
                    'รายการจอง: ' .
                    $booking_type .
                    '<br>' .
                    'ร้องขอเมื่อ: ' .
                    $date_accepted .
                    '<br>' .
                    'สถานะ: ' .
                    "<font color='green' class='extra-sm'>ได้รับการอนุมัติแล้ว  </font>" .
                    '<br>' .
                    'ไปที่เว็บไซต์: ' .
                    "<a href='https://boychawin.com/irms/pages/index'>http://localhost/irms/pages/index</a>";

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

                //header('Location:thankyou.php?msg='.$msg);

                //////////////////////////////////////////////////
                $msg = urlencode('สำเร็จ');
                redirect_user("admin.php?tab=16&msg=$msg");
                $firstname = ucfirst($firstname);

                $to = "$email";

                $subject = 'คำร้องขอจองได้รับอนุมัติ';
                $raw_message = "สวัสดี $firstname\r\n";
                $raw_message = "รายการ:$booking_type \n";
                $raw_message .= "เลขรายการ:$ide \n";
                $raw_message .= "ร้องขอเมื่อ:$date_accepted \n";
                $raw_message .= "สถานะ: ได้รับการอนุมัติแล้ว \n";
                $raw_message .=
                    "ไปที่เว็บไซต์ https://boychawin.com.\r\n\r\n irms";
    
                $messag = wordwrap($raw_message, 70, "\n");
                
                //     $subject = 'คำร้องขอจองได้รับอนุมัติ';
                //     $raw_message = "
                //     สวัสดี: $firstname 
                //     เลขที่: $booking_id 
                //     เลขรายการ: $ide 
                //     ร้องขอเมื่อ: $date_accepted 
                //     สถานะ : ได้รับการอนุมัติแล้ว 
                //     ไปที่เว็บไซต์ https://boychawin.com";

                // $msg = wordwrap($raw_message, 10000, "\r\n");

                $from = 'HR: <asnru0298@gmail.com>';

                if (mail($to, $subject, $messag, $from)) {
                    $msg = urlencode('สำเร็จ');

                    redirect_user("admin.php?tab=16&msg=$msg");
                }
            } else {
                $msg = urlencode('ไม่สำเร็จ');

                redirect_user("admin.php?tab=16&error=$msg");
            }
        } else {
            $msg = urlencode('สำเร็จ ' . $db_con->error);

            redirect_user("admin.php?tab=16&error=$msg");
        }
    } else {
        redirect_user(
            'admin.php?tab=16&error=' . join($error)
        );
    }
} elseif (isset($_POST['reject2'])) {
    $error = [];

    if (var_set($_POST['ide']) && is_numeric($_POST['ide'])) {
        $ide = $_POST['ide'];
    }

    if (var_set($_POST['booking_type'])) {
        $booking_type = strval($_POST['booking_type']);
    } else {
        $error[] = urlencode('ขออภัยเกิดข้อผิดพลาด');
    }

    if (var_set($_POST['booking_id'])) {
        $booking_id = intval($_POST['booking_id']);
    }

    // if(var_set($_POST['email']) && is_numeric($_POST['email'])){

    //     $email = $_POST['email'];
    // }
    $email = $_REQUEST['email'];
    if (var_set($_POST['firstname']) && is_numeric($_POST['firstname'])) {
        $firstname = $_POST['firstname'];
    }

    if (var_set($_POST['staff_id'])) {
        $staff_id = intval($_POST['staff_id']);
    } else {
        $error[] = urlencode('ขออภัยเกิดข้อผิดพลาด');
    }

    if (var_set($_POST['reason'])) {
        $reason = strval($_POST['reason']);
    } else {
        $reason = '';
    }

    if (!$error) {
        $date_rejected = date('d-m-Y');

        $result = $db_con->query("UPDATE booking_applications SET action = 'reject' 
                WHERE  id = $ide AND staff_id = $staff_id");

        if ($db_con->affected_rows == 1) {
            $stmt = $db_con->prepare("INSERT INTO rejected_booking(booking_id,staff_id,
                    booking_type,reason_reject,date_rejected) VALUES(?,?,?,?,?)");

            $stmt->bind_param(
                'iisss',
                $booking_id,
                $staff_id,
                $booking_type,
                $reason,
                $date_rejected
            );

            $stmt->execute();

            if ($db_con->affected_rows == 1) {
                //////////////////////////////////////////////////ส่งเมล์
                $mailto = $email;
                $mailSub = 'เจ้าหน้าที่ได้ทำตรวจสอบรายการที่ท่านร้องขอแล้ว';
                $mailMsg =
                    $mailSub .
                    '<br>' .
                    'เลขรายการ: ' .
                    $ide .
                    '<br>' .
                    'รายการจอง: ' .
                    $booking_type .
                    '<br>' .
                    'ร้องขอเมื่อ: ' .
                    $date_rejected .
                    '<br>' .
                    'สถานะ: ' .
                    "<font color='red' class='extra-sm'>ไม่ได้รับการอนุมัติ  </font>" .
                    '<br>' .
                    'ไปที่เว็บไซต์: ' .
                    "<a href='http://localhost/irms/pages/index'>http://localhost/irms/pages/index</a>";

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

                // header('Location:thankyou.php?msg='.$msg);
                $msg = urlencode('สำเร็จ');
                //////////////////////////////////////////////////
                redirect_user("admin.php?tab=16&msg=$msg");
                // redirect_user("admin.php?tab=16&msg=$msg");
                $firstname = ucfirst($firstname);

                $to = "$email";
                // $reason = wordwrap($reason, 70, '\r\n');
                // $subject = 'คำร้องขอจองไม่ได้รับอนุมัติ';
                // $raw_message = "สวัสดี: $firstname \r\n";
                // $raw_message = "เลขที่: $booking_id \n";
                // $raw_message = "เลขรายการ: $ide \n";
                // $raw_message = "ร้องขอเมื่อ: $date_accepted \n";
                // $raw_message = "เหตุผล: $reason \n";
                // $raw_message = "สถานะ : ไม่ได้รับการอนุมัติ\n";
                // $raw_message .=
                //     "ไปที่เว็บไซต์ https://boychawin.com/\r\n\r\n irms";
                $subject = 'คำร้องขอจองไม่ได้รับอนุมัติ';
                $raw_message = "สวัสดี $firstname\r\n";
                $raw_message = "รายการ:$booking_type \n";
                $raw_message .= "เลขรายการ:$ide \n";
                $raw_message .= "เหตุผล:$reason \n";
                $raw_message .= "สถานะ: ไม่ได้รับการอนุมัติ \n";
                $raw_message .=
                    "ไปที่เว็บไซต์ https://boychawin.com.\r\n\r\n irms";
    
                $messag = wordwrap($raw_message, 70, "\n");

                //     $subject = 'คำร้องขอจองไม่ได้รับอนุมัติ';
                //     $raw_message = "
                //     เลขที่: $booking_id 
                //     เลขรายการ: $ide 
                //     เหตุผล: $reason
                //     สถานะ : ไม่ได้รับการอนุมัติ 
                //     ไปที่เว็บไซต์ https://boychawin.com";



                // $msg = wordwrap($raw_message, 10000, "\r\n");
                

                $from = 'HR: <asnru0298@gmail.com>';

                if (mail($to, $subject, $messag, $from)) {
                    $msg = urlencode('ถูกปฏิเสธ');

                    redirect_user("admin.php?tab=16&msg=$msg");
                }
            } else {
                redirect_user(
                    'admin.php?tab=16&error=booking+could+not+be+rejected+' .
                        $db_con->error
                );
            }
        } else {
            redirect_user(
                'admin.php?tab=16&error=booking+could+not+be+rejected+' .
                    $db_con->error
            );
        }
    } else {
        redirect_user(
            'admin.php?tab=16&error=' . join($error)
        );
    }
} else {
    redirect_user('404.php');
}