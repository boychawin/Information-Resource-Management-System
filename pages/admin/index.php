<?php
// echo "<script type='text/javascript'>";
// echo "alert('เกิดข้อผิดพลาด');";
// echo 'window.history.back(1);';
// echo '</script>';
// echo 'เกิดข้อผิดพลาด';
 session_start();
include_once '../functions.php';

redirect_user('../index2.php?action=login&type=admin');
?>