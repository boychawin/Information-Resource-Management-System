<h1 class='text-center hide'>หน้าหลัก | </h1>
<?php

if (isset($_GET['action']) && $_GET['action'] == 'login') {
    if (isset($_GET['type']) && $_GET['type'] == 'admin') {
        if (isset($_SESSION['admin-username'])) {
            header('Location:admin.php');
        }

        $username = 'username';

        $action = 'user.php?type=admin';

        $id = 'admin-login';

        $field = 'ชื่อผู้ใช้ผู้ดูแล';

        $prop = 'text';

        $login_type = 'admin';

        $title = 'เข้าสู่ระบบผู้ดูแล';

        $page = 'admin.php';

        $tbl = 'admin';
    } else {
        if (isset($_SESSION['staff-user'])) {
            echo '<script>history.back();</script>';
        }

        $username = 'staff';

        $field = 'Staff Username';

        $action = 'user.php';

        $id = 'staff-login';

        $login_type = 'staff';

        $prop = 'text';

        $title = 'พนักงานเข้าสู่ระบบ';

        $page = 'index.php';

        $tbl = 'employee';

        $account_trigger =
            "ไม่มีบัญชี? <a href='index?tab=8' class='text-sm'>" .
            '<u>สมัครตอนนี้</u></a>';
    }
} else {
    if (isset($_SESSION['staff-user'])) {
        echo '<script>history.back();</script>';
    }

    $username = 'username';

    $field = 'ชื่อเข้าใช้ระบบ';

    $action = 'user.php';

    $id = 'staff-login';

    $page = 'index.php';

    $login_type = 'staff';

    $prop = 'text';

    $title = 'เข้าสู่ระบบ';

    $tbl = 'employee';

    $account_trigger =
        "ไม่มีบัญชี? <a href='index?tab=8' class='text-sm text-primary'>" .
        'สมัคร</a>';
}

$part = <<<TY

 <div  >
    <div class="container">
    <h1 class="hide">$title</h1>

    <div class="row">

        <div class="col-md-4 col-lg-4 col-xl-5 mx-auto">
    <h3 class="text-center form-head"></h3>

            <div  class="card border-success mb-3" >
TY;

echo $part;

if (isset($_GET['error']) && !empty($_GET['error'])) {
    $error = $_GET['error'];

    echo "<small class='alert alert-danger alert-dismissible'>$error
                <span class='close' data-dismiss='alert'>&times;</span></small>";
}

$ac = isset($account_trigger) ? $account_trigger : '';

$last = <<<YOP
                
            <form action="user.php" method="post" id="$id">
           
            <h4 class="text-center form-head">$title</h4>
        
                <input type="hidden" name="login-type" value="$login_type">
    
                <input type="hidden" name="table" value="$tbl">
    
                <input type="hidden" name="page" value="$page">
                        
                <label class="text-black" for="staff_user"><b>$field</b><font color="red"> * </font></label class="text-black"><br>
                <input class="form-control" placeholder="โปรดป้อนชื่อผู้ใช้ ตัวอย่าง boychawin " type="$prop" name="$username" maxlength="50" class="input-text" id="username"required><br>
                       
                <label class="text-black" for="password"><b>รหัสเข้าใช้ระบบ</b><font color="red"> * </font></label class="text-black"><br>
                <input class="form-control"type="password" placeholder="กรุณาระบุรหัสผ่าน"name="password" maxlength="50" class="input-text" id="password"required onkeypress="return chspace()">
                <p class="text-red error-line1"></p>
               <br> <div class="text-center">
                <button name="login" class="btn btn-primary btn-lg " type="submit">ตกลง</button>
              </div>
                
                <br>
                <small class='mr-2'>$ac</small>
                <small class='ml-2 '>
                    <a href="index?tab=9" class='text-sm text-primary'> ลืมรหัสผ่าน?</a>
                </small>
            </form>
            
        </div>
YOP;
echo $last;
echo '</div>';
echo ' </div></div></div></div></div>';


?>
<script src="js/main.js"></script>