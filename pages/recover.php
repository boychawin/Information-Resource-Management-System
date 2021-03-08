<h1 class="text-hide">หน้า | </h1>
<div class="container my-5">
    <div class="card border-success mb-3">
        <?php if (isset($_GET['error']) && !empty($_GET['error'])) {
            $error = $_GET['error'];

            echo "<small class='alert alert-danger alert-dismissible'>$error
                <span class='close' data-dismiss='alert'>&times;</span></small>";
        } ?>
        <h1 class="text-lg">ระบุอีเมลของคุณ</h1>
        <p>ระบุอีเมลของคุณเพื่อให้เราสามารถส่งรหัสผ่านใหม่ให้คุณ นี้
            ต้องเปิดใช้งานอีเมลและเป็นอีเมลที่คุณใช้สมัครบัญชีของคุณ
        </p>
        <form action="mail.php" method="post">
            <input type="hidden" value="$token" name="token">
            <label for="memberemail">ที่อยู่อีเมล</label><br>
            <input class="form-control" type="email" name="memberemail" placeholder="โปรดป้อนอีเมลที่ท่านใช้สมัคร"
                required><br>
            <button class="btn btn-primary" name="recover_password">ส่งรหัสผ่าน</button>
        </form>
    </div>
</div>
</div>