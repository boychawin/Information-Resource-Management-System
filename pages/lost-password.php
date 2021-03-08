<div class="row">
    <div class="col-lg-12">

        <h3 class="alert alert-success" class="page-header alert btn-info"><i class="fa fa-calendar fa-fw"></i>
            ลืมรหัสผ่าน?</h3>
    </div>
</div>
<?php
include 'db_connect.php'; // เรียกใช้งานไฟล์เชื่อมต่อกับฐานข้อมูล
$con = connect(); // เชื่อมต่อกับฐานข้อมูล
$errors = [];
$con->set_charset('utf8');

if (isset($_POST['reset-password'])) {
    $email = $_POST['email'];
    $sql = mysqli_query($con, "SELECT * FROM adminpr WHERE email='$email'");
    while ($row = mysqli_fetch_array($sql)) {
        $password = $row['password'];
    }
    if (empty($email)) {
        array_push($errors, 'ต้องระบุอีเมลของคุณ');
        echo implode(' ', $errors);
    } elseif (mysqli_num_rows($sql) <= 0) {
        array_push($errors, ' ขออภัยไม่มีผู้ใช้ในระบบของเราด้วยอีเมลนั้น');
        echo implode(' ', $errors);
    }
    if (count($errors) == 0) {
        $to = "$email";
        $subject = 'ลืมรหัสผ่าน';
        $message = "รหัสผ่านของคุณคือ $password";
        $headers = "จาก: parttimemail18@gmail.com \r\n";
        $headers .= 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset-UTF-8' . "\r\n";
        mail($to, $subject, $message, $headers);
        header('location: index.php?tab=4');
    }
}
?>

<form class="login-form" action="lost-password.php" method="post">
    <h2 class="form-title">รีเซ็ตรหัสผ่าน</h2>
    <!-- form validation messages -->

    <div class="form-group">
        <label>ที่อยู่อีเมลของคุณ</label> <br>
        <input type="email" name="email">
    </div>
    <div class="form-group">
        <button type="submit" name="reset-password" class="login-btn">Submit</button>
    </div>
</form>



</div>
<li class="btn-danger divider" style="height:3px;"></li>