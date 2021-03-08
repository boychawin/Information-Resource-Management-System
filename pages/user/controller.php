<?php
include_once '../functions.php';
include '../connection.php';
$date_receive = date('Y-m-d');

if ($_POST['MessageCODE'] == '') {
    $errors[] = urlencode('ใส่หัวข้อ !!');
}

if ($_POST['MessageText'] == '') {
    $errors[] = urlencode('ใส่อธิบายปัญหาของท่าน !!');
}
if (!$errors) {
    $fileName = date('Ymd') . '_' . $_FILES['filAlbumShot']['name'];
    if (
        move_uploaded_file(
            $_FILES['filAlbumShot']['tmp_name'],
            'myfile/' . $fileName
        )
    ) {
        echo 'Copy/Upload Complete<br>';

        ///ส่วนที่ 1 line แจ้งเตือน ใส่ก่อน sql
        $header = 'มีการร้องเรียน';
        $message =
            $header .
            "\n" .
            'หัวข้อ: ' .
            $_POST['MessageCODE'] .
            "\n" .
            'ผู้ร้องเรียน: ' .
            $_POST['ACCOUNT_USERNAME'] .
            "\n" .
            'ประเภท: ' .
            $_POST['Category'] .
            "\n" .
            'อธิบายปัญหาของท่าน: ' .
            $_POST['MessageText'] .
            "\n" .
            'สถานะ: ' .
            'รอตรวจสอบ';
        ///////////////////
        $sql =
            "INSERT INTO tblmessage(Category, MessageText, MessageCODE, ACCOUNT_USERNAME, IDNO, Email, Mstatus,date_no,date_receive, Mimage)
        VALUES('" .
            $_POST['Category'] .
            "','" .
            $_POST['MessageText'] .
            "','" .
            $_POST['MessageCODE'] .
            "','" .
            $_POST['ACCOUNT_USERNAME'] .
            "','" .
            $_POST['IDNO'] .
            "','" .
            $_POST['Email'] .
            "','" .
            $_POST['Mstatus'] .
            "','" .
            $_POST['date_no'] .
            "','" .
            $date_receive .
            "','" .
            $fileName .
            "')";
        $objQuery = mysqli_query($db_con, $sql);
        //$objQuery = mysqli_query($db_con, $sql) or die ("Error in query: $sql". mysqli_error($sql));
        mysqli_close($db_con);
        if ($objQuery) {
            ///ส่วนที่ 2 line แจ้งเตือน ใส่ตรงเพิ่ม sql สำเร็จ
            sendlinemesg();
            header('Content-Type: text/html; charset=utf8');
            $res = notify_message($message);
            //////////
            $msg = urlencode('ส่งสำเร็จ');
            redirect_user("../dashboard.php?tab=8&msg=$msg");
        } else {
            $errors[] = urlencode('เกิดข้อผิดพลาดกลับไปที่ลองอีกครั้ง !!');
            redirect_user(
                '../dashboard.php?tab=8&error=' .
                    join($errors, urlencode('<br>'))
            );
        }
    } else {
        $errors[] = urlencode('ใส่ข้อมูลให้ครบถ้วน !!');
        redirect_user(
            '../dashboard.php?tab=8&error=' . join($errors, urlencode('<br>'))
        );
    }
} else {
    redirect_user(
        '../dashboard.php?tab=8&error=' . join($errors, urlencode('<br>'))
    );
}
?>