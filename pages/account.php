<?php
if (isset($_SESSION['staff-user']) && $_SESSION['staff-user'] !== '') {
    $username = $_SESSION['staff-user'];

    $email = $_SESSION['staff-email'];

    $id = $_SESSION['staff-id'];

    $tbl = 'employee';

    $type = 'Staff';
} elseif (isset($_SESSION['admin-user']) && $_SESSION['admin-user'] !== '') {
    $username = $_SESSION['admin-user'];

    $email = $_SESSION['admin-email'];

    $id = $_SESSION['admin-id'];

    $tbl = 'admin';

    $type = 'Admin';
} else {
    redirect_user('index.php');
}
//show_alert();

$result = query_db("SELECT * FROM $tbl WHERE username = '$username'");

if ($result) {
    if (
        is_session_inplace('staff-user') ||
        is_session_inplace('supervisor-user')
    ) {
        $res = $result->supervisor;

        if ($res) {
            $sup = $res;
        } elseif ($res == '') {
            $sup = 'Not yet assigned';
        } else {
            $sup = 'N/A';
        }

        $uid = $result->staff_id;
    } elseif (is_session_inplace('supervisor-user')) {
        $uid = $result->supervisor_id;
        $sup = 'N/A';
    } else {
        $uid = $result->admin_id;
        $sup = '';
    } ?>
<div class="center">
    <div class='col-md-10 mb-2 mx-auto'>
        <h1 class='text-center hide'>หน้า | รายละเอียดข้อมูลส่วนตัว</h1>
        <form action='accountfromedit.php' method="post">
            <table class="table table-hover table-lg table-responsive-sm w-100">
                <thead>
                    <div class="card-header alert-success text-black">
                        <h5 class="text-center"><i class="fa fa-user-circle icon"></i><span class="extra-sm">
                                รายละเอียดข้อมูลส่วนตัว </span></h5>
                    </div>
                </thead>
                <tr>
                    <td>
                        <h6 class="extra-sm"> เลขที่บัตรประชาชน<font color='red'> * </font>
                            </h3>
                    </td>
                    <td class="extra-sm">
                        <input class="form-control" class="extra-sm" type='text' name="uid" value="<?php echo $uid; ?>"
                            readonly>
                    </td>

                </tr>

                <tr>
                    <td>
                        <h6 class="extra-sm">ชื่อ - นามสกุล <font color='red'> * </font>
                        </h6>
                    </td>
                    <td class="extra-sm">
                        <input class="form-control" class="extra-sm" type='text' name="fnamelname"
                            value="<?php echo $result->fname; ?>&nbsp;<?php echo $result->lname; ?>" readonly>
                    </td>

                </tr>

                <tr>
                    <td>
                        <?php include_once '../config/thai_date.php'; ?>
                        <h6 class="extra-sm">วันที่สมัคร<font color='red'> * </font>
                        </h6>
                    </td>
                    <td>
                        <input class="form-control" class="extra-sm" type='text' name="date_registered"
                            value="<?php echo thai11($result->date_registered); ?>" readonly>
                    </td>

                </tr>

                <tr>
                    <td>
                        <h6 class="extra-sm">ชื่อเข้าระบบ <font color='red'> * </font>
                        </h6>
                    </td>
                    <td>
                        <input class="form-control" class="extra-sm" type='text' name="username"
                            value="<?php echo $result->username; ?>" readonly>

                    </td>


                </tr>

                <tr>
                    <td>
                        <h6 class="extra-sm">ตำแหน่ง<font color='red'> * </font>
                        </h6>
                    </td>
                    <td>
                        <input class="form-control" class="extra-sm" type='text' name="position"
                            value="<?php echo $result->position; ?>" readonly>
                    </td>

                </tr>

                <tr>
                    <td>
                        <h6 class="extra-sm">หน่วยงาน<font color='red'> * </font>
                        </h6>
                    </td>
                    <td>
                        <input class="form-control" class="extra-sm" type='text' name="Faculty"
                            value="<?php echo $result->Faculty; ?>" readonly>
                    </td>

                </tr>


                <tr>
                    <td>
                        <h6 class="extra-sm">หมายเลขโทรศัพท์<font color='red'> * </font>
                        </h6>
                    </td>
                    <td class="extra-sm">


                        <input class="form-control" type='text' maxlength="10" name="phone"
                            value="0<?php echo $result->phone; ?>">
                        <input class="form-control" type='hidden' name="id" value="<?php echo $result->id; ?>">
                        <input class="form-control" type='hidden' name="staff_level"
                            value="<?php echo $result->staff_level; ?>">

                    </td>

                </tr>

                <tr>
                    <td>
                        <h6 class="extra-sm">อีเมล<font color='red'> * </font>
                        </h6>
                    </td>
                    <td class="extra-sm">
                        <input class="form-control" name='email' type="text" value="<?php echo $result->email; ?>">
                    </td>

                </tr>

                <tr>
                    <td>
                        <h6 class="extra-sm">ที่อยู่<font color='red'> * </font>
                        </h6>
                    </td>
                    <td class="extra-sm">

                        <textarea class="form-control input-sm" id="location" rows="3" name="location" placeholder=" "
                            value="<?php echo $result->location; ?>"
                            type="text"><?php echo $result->location; ?></textarea>
                    </td>

                </tr>

                <?php if (
                        isset($_SESSION['staff-user']) &&
                        $_SESSION['staff-user'] !== ''
                    ) { ?>
                <tr>
                    <td>
                        <h6 class="extra-sm">สถานะ</h6>
                    </td>
                    <td><?php if ($result->staff_level == 'supervisor') {
                                    echo "<input  class='form-control' type='text' value='เจ้าหน้าที่'readonly>

                    ";
                                } elseif ($result->staff_level == 'non-supervisor') {
                                    echo "<input  class='form-control'type='text' value='สมาชิก'readonly>

                        ";
                                } elseif (
                                    $result->staff_level == '' &&
                                    $result->total_reject == '0'
                                ) {
                                    echo "<h5><font color='red'>*ยังไม่ได้รับการยืนยัน กรุณาเข้าไปยืนยันตัวตนที่อีเมลภายในวันที่สมัคร คือ " .
                                        $date_registered .
                                        ' เพื่อใช้งานหรือรอทางเจ้าหน้าที่อนุมัติ*</font></h5></p><br>';
                                } elseif (
                                    $result->staff_level == 'non' &&
                                    $result->total_reject >= '1'
                                ) {
                                    if ($result->day_rejectend <= date('d-m-Y')) {
                                        echo "<h5 class='extra-sm'><font color='green'> (ครบกำหนดแล้ว) </font></h5>";
                                    } else {
                                        echo "<h5 class='extra-sm'><font color='red'> (ยังไม่ครบกำหนด) </font></h5>";
                                    }

                                    echo "<h5 class='extra-sm'><font color='red'> *บัญชีท่านถูกระงับชั่วคราว เป็นเวลา 15 วัน เรื่มนับตั้งแต่วันที่   " .
                                        $result->day_reject .
                                        '  เป็นต้นไป หรือถ้าหากครบวันที่กำหนดแล้วระบบยังใช้ไม่ได้ให้ติดต่อเจ้าหน้าที่* </font></h5></p><br>';
                                } elseif ($result->staff_level == 'noadmin') {
                                    echo "<h5 class='extra-sm'><font color='red'> ไม่ได้รับการอนุมัติ ติดต่อเจ้าหน้าที่ได้ตามที่อยู่ด้านล่าง </font></h5>";
                                }

                                ?>
                    </td>

                </tr>
                <?php if ($result->staff_level == 'supervisor') { ?>
                <tr>
                    <td>

                    </td>
                    <td colspan="3"><button name="update" type="submit" class="btn btn-primary">
                            <span class="fa fa-edit fw-fa"></span> <span class="extra-sm"> แก้ไขข้อมูลส่วนตัว </span>
                        </button>
                    </td>
                </tr>

                <?php } elseif ($result->staff_level == 'non-supervisor') { ?>
                <tr>
                    <td>

                    </td>
                    <td colspan="3"><button name="update" type="submit" class="btn btn-primary">
                            <span class="fa fa-edit fw-fa"></span> <span class="extra-sm"> แก้ไขข้อมูลส่วนตัว </span>
                        </button>
                    </td>
                </tr>

                <?php }
                    } ?>

                <?php if (
                        isset($_SESSION['admin-user']) &&
                        $_SESSION['admin-user'] !== ''
                    ) { ?>
                <tr>
                    <td>

                    </td>
                    <td colspan="3"><button name="update" type="submit" class="btn btn-primary">
                            <span class="fa fa-edit fw-fa"></span> <span class="extra-sm"> แก้ไขข้อมูลส่วนตัว </span>
                        </button>
                    </td>
                </tr>

                <?php } ?>
    </div>
    </table>
    </form>

    <?php
} else {
    echo '<h2 class="extra-sm">ไม่มีข้อมูลผู้ใช้</h2>';
}
    ?>

</div>
</div>
</div>
<div class='col-md-10 mb-2 mx-auto'>
    <div class="card mb-4">
        <h3 class="text-danger"><span class="extra-sm"> เปลี่ยนรหัสผ่าน </span></h3>

        <form id="password-account" action='accountfromedit.php' method="post">
            <input type='hidden' name="id" value="<?php echo $result->id; ?>">
            <input type='hidden' name="staff_level" value="<?php echo $result->staff_level; ?>">
            <label for="confirm-delete">
                <input type="checkbox" id="confirm-delete">
                <span class="extra-sm"> รู้แล้ว ต้องการเปลี่ยนรหัสผ่าน </span></h3></label>
            <hr>

            <div class="hide" id="hide">
                <label for="password" class="extra-sm">ป้อนรหัสผ่านของคุณเพื่อดำเนินการต่อ</label><br><br>
                <tr>
                    <td>
                        <h6 class="extra-sm">รหัสผ่านใหม่<font color='red'> * </font>
                        </h6>
                    </td>
                    <td>
                        <input class="form-control" type="text" name="password" id="password" placeholder="รหัสผ่านใหม่"
                            onkeypress="return chspace()">
                        <p class="text-red error-line1"></p>
                    </td>
                    <td>

                    </td>
                </tr>

                <tr>
                    <td>
                        <h6 class="extra-sm">ยืนยันรหัสผ่าน<font color='red'> * </font>
                        </h6>
                    </td>
                    <td>
                        <input class="form-control" type="text" name="confpassword" id="conf-pass"
                            placeholder="ยืนยันรหัสผ่าน" onkeypress="return chspace()">
                        <p class="text-red error-line2"></p>
                    </td>
                    <td>

                    </td>
                </tr>
                <tr><br>
                    <?php if (
                            isset($_SESSION['staff-user']) &&
                            $_SESSION['staff-user'] !== ''
                        ) { ?>
                    <?php if ($result->staff_level == 'supervisor') { ?>

                    <button name="password-account" type="submit" class="btn btn-danger"><span class="extra-sm"> เปลี่ยน
                        </span></button>



                    <?php } elseif (
                                $result->staff_level == 'non-supervisor'
                            ) { ?>

                    <button name="password-account" type="submit" class="btn btn-danger"><span class="extra-sm"> เปลี่ยน
                        </span></button>

                    <?php }
                        } ?>

                    <?php if (
                            isset($_SESSION['admin-user']) &&
                            $_SESSION['admin-user'] !== ''
                        ) { ?>
                    <button name="password-account" type="submit" class="btn btn-danger"><span class="extra-sm"> เปลี่ยน
                        </span></button>

                    <?php } ?>
            </div>
        </form>
    </div>
</div>
</div>