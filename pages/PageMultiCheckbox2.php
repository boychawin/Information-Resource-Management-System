<meta charset="utf-8" />
<?php
include('connection.php');
include_once 'functions.php';
// print array ออกมาดู


foreach($_POST['chkbook'] as $i=>$art){
  
        $ide = mysqli_real_escape_string($db_con,$_POST['chkbook'][$i]);
        $booking_id = mysqli_real_escape_string($db_con,$_POST['booking_id'][$i]);
        $staff_id = mysqli_real_escape_string($db_con,$_POST['staff_id'][$i]);
        $recommended_by = mysqli_real_escape_string($db_con,$_POST['recommended_by'][$i]);
        $booking_type = mysqli_real_escape_string($db_con,$_POST['booking_type'][$i]);
        $firstname = mysqli_real_escape_string($db_con,$_POST['firstname'][$i]);
        $num_days = mysqli_real_escape_string($db_con,$_POST['num_days'][$i]);
        $email = mysqli_real_escape_string($db_con,$_POST['email'][$i]);


            $why_recommend = "0";
    
    
        $date_accepted = date('d-m-Y');
    
     
            $result = $db_con->query("UPDATE booking_applications SET action = 'accept' 
                WHERE  id = $ide AND staff_id = $staff_id");
    
    $subject = 'คำร้องขอจองได้รับอนุมัติ';
    $raw_message = "สวัสดี $firstname\r\n";
    $raw_message = "รายการ:$booking_type \n";
    $raw_message .= "เลขรายการ:$ide \n";
    $raw_message .= "ร้องขอเมื่อ:$date_accepted \n";
    $raw_message .= "สถานะ: ได้รับการอนุมัติแล้ว \n";
    $raw_message .=
        "ไปที่เว็บไซต์ https://boychawin.com.\r\n\r\n irms";
    
        $messag = wordwrap($raw_message, 70, "\n");

       
}

sendlinemesg();
header('Content-Type: text/html; charset=utf8');
$res = notify_message($messag);
?>