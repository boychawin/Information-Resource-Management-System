<?php
include_once 'connection.php';
$user_registered = date('Y-m-d');
//echo "$user_registered";
$strSQL =
    "SELECT * FROM employee WHERE staff_id = '" .
    trim($_GET['staff_id']) .
    "' AND email = '" .
    trim($_GET['email']) .
    "' AND date_registered = '$user_registered' ";
$objQuery = mysqli_query($db_con, $strSQL);
$objResult = mysqli_fetch_array($objQuery);
if (!$objResult) {
    echo 'เปิดใช้งานไม่ถูกต้อง !';

    echo "<script type='text/javascript'>";
    echo "alert('เปิดใช้งานไม่ถูกต้อง !!');";
    echo "window.location = 'index.php?tab=2'; ";
    echo '</script>';
} else {
    $strSQL =
        "UPDATE employee SET staff_level = 'non-supervisor'  WHERE staff_id = '" .
        trim($_GET['staff_id']) .
        "' AND email = '" .
        trim($_GET['email']) .
        "' ";
    $objQuery = mysqli_query($db_con, $strSQL); //non-supervisor //supervisor

    echo 'เปิดใช้งานสำเร็จ ';
    echo "<script type='text/javascript'>";
    echo "alert('เปิดใช้งานสำเร็จ !!');";
    echo "window.location = 'index.php?tab=2'; ";
    echo '</script>';
}

mysqli_close($db_con);