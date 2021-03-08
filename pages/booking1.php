<?php
include 'connection.php';

$sql =
    "INSERT INTO booking(booking_id, booking_type, allowed_days, current_days, allowed_monthly_days, for_staff_level, auto_update)
        VALUES('" .
    $_POST['booking_id'] .
    "','" .
    $_POST['booking_type'] .
    "','" .
    $_POST['allowed_days'] .
    "','" .
    $_POST['current_days'] .
    "','" .
    $_POST['allowed_monthly_days'] .
    "','" .
    $_POST['for_staff_level'] .
    "','" .
    $_POST['auto_update'] .
    "')";
$objQuery = mysqli_query($db_con, $sql);
mysqli_close($db_con);
if ($objQuery) {
    echo "<script type='text/javascript'>";
    echo "alert('สำเร็จ');";

    echo '</script>';
    echo 'สำเร็จ';
} else {
    echo "<script type='text/javascript'>";
    echo "alert('เกิดข้อผิดพลาด');";

    echo '</script>';
    echo 'เกิดข้อผิดพลาด';
}