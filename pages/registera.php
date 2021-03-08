<h1 class='text-center hide'> หน้า | </h1>
<?php if (isset($_SESSION['username'])) {
    echo '<script>histroy.back();</script>';
} ?>
<?php
include 'db_connect.php'; // เรียกใช้งานไฟล์เชื่อมต่อกับฐานข้อมูล
$mysqli = connect(); // เชื่อมต่อกับฐานข้อมูล
$result = $mysqli->query('SELECT * FROM tb_Faculty');
$result1 = $mysqli->query('SELECT * FROM tb_field_study');
?>
<?php if (isset($_SESSION['staff-user']) && $_SESSION['staff-user'] !== '') { ?>
<?php if ($level == 'supervisor') { ?>
<div class="container">
    <h1 class="text-hide">สมัครสำหรับบัญชี</h1>
    <div class="row">

        <div class="col-md-12 mb-4 mx-auto">

            <form action="process.php" method="post" id="signup">
                <?php if (
                            isset($_SESSION['staff-user']) &&
                            $_SESSION['staff-user'] !== ''
                        ) { ?>

                <h4 class="alert alert-success" class="page-header alert alert-warning"><i
                        class="fa fa-table"></i>สมัครสำหรับบัญชีใหม่ </h4>
                <?php } ?>


                <?php if (
                            isset($_SESSION['admin-user']) &&
                            $_SESSION['admin-user'] !== ''
                        ) { ?>
                <h4 class="alert alert-success" class="page-header alert alert-warning"><i class="fa fa-table"></i><a
                        href="#" onclick="window.history.back(1);"> จัดการสมาชิก </a><a> / สมัครสำหรับบัญชีใหม่</a>
                </h4>

                <?php } ?>


                <div class="row mb-2">
                    <div class="col-md-4 mb-md-2">
                        <label for="title"><b>คำนำหน้า</b></label>
                        <font color="red"> * </font>

                        <select name="title" id="title">
                            <option value="นาย">นาย</option>
                            <option value="นาง">นาง</option>
                            <option value="Ms">นางสาว</option>
                            <option value="อาจารย์">อาจารย์</option>
                            <option value="รองศาสตราจารย์">รองศาสตราจารย์</option>
                            <option value="ผู้ช่วยศาสตราจารย์">ผู้ช่วยศาสตราจารย์</option>
                            <option value="ดร.">ดร.</option>
                            <option value="รศ.ดร">รศ.ดร</option>
                        </select>
                    </div>


                    <div class="col-md-4 mb-3">
                        <label for="firstname"><b>ชื่อ</b></label>
                        <font color="red"> * </font>
                        <input type="text" name="firstname" id="firstname" class="form-control"
                            placeholder="โปรดป้อนชื่อ" required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="lastname"><b>นามสกุล</b></label>
                        <font color="red"> * </font>
                        <input type="text" name="lastname" id="lastname" class="form-control"
                            placeholder="โปรดป้อนนามสกุล" required>
                    </div>

                </div>

                <div class="row my-2">

                    <div class="col-md-4 mb-2">
                        <label for="position"><b>ตำแหน่ง</b></label>
                        <font color="red"> * </font>
                        <!-- <input name="position" type="text" id="position" class="form-control" placeholder="ตัวอย่าง นักศึกษา"> -->
                        <select name="position" id="position">
                            <option value="">- เลือกตำแหน่ง -</option>
                            <option value="อาจารย์">อาจารย์</option>
                            <option value="เจ้าหน้าที่">เจ้าหน้าที่</option>
                            <option value="นักศึกษา ">นักศึกษา </option>
                            <option value="นักเรียน">นักเรียน</option>
                            <option value="บุคคลทั่วไป">บุคคลทั่วไป</option>
                        </select>
                    </div>

                    <div class="col-md-4 mb-2">
                        <label for="codepp"><b>เลขที่บัตรประชาชน</b></label>
                        <font color="red"> * </font>
                        <input name="codepp" maxlength="13" type="text" id="codepp" onkeyup="autoTab(this)"
                            class="form-control" placeholder="กรุณาระบุเลขที่บัตรประชาชน 13 ตัว" required>
                    </div>

                    <div class="col-md-4 mb-2">
                        <label for="email"><b>อีเมล</b></label>
                        <font for="code" class="text-sm padding-none"> อีเมลที่ใช้งานจริง
                            ระบบจะส่งข้อมูลที่จำเป็นไปยังอีเมลนี้</font>
                        <font color="red"> * </font>
                        <input type="email" name="email" id="email" class="form-control"
                            placeholder="โปรดป้อนอีเมล ตัวอย่าง xxxxx@gmail.com" required>
                    </div>

                </div>

                <div class="row my-2">

                    <div class="col-md-6 mb-2">
                        <label for="location"><b>ที่อยู่</b></label>
                        <font color="red"> * </font>
                        <?php
                                //<input name="location" rows="2" cols="20" id="location" class="form-control">
                                ?>
                        <textarea class="form-control input-sm" name="location" rows="2" cols="20" id="location"
                            class="form-control" rows="10" placeholder="โปรดป้อนข้อมูลที่อยู่ปัจจุบัน" type="text"
                            required></textarea>
                    </div>
                    <div class="col-md-6 mb-md-2">
                        <label for="Faculty"><b>คณะ/หน่วยงาน</b></label>
                        <font color="red"> * </font>

                        <select name="Faculty" id="Faculty">
                            <option value="">- เลือกคณะ/หน่วยงาน -</option>
                            <option value="คณะครุศาสตร์">คณะครุศาสตร์</option>
                            <option value="คณะเทคโนโลยีการเกษตร">คณะเทคโนโลยีการเกษตร</option>
                            <option value="คณะเทคโนโลยีอุตสาหกรรม">คณะเทคโนโลยีอุตสาหกรรม</option>
                            <option value="คณะวิทยาการจัดการ">คณะวิทยาการจัดการ</option>
                            <option value="คณะมนุษยศาสตร์และสังคมศาสตร์">คณะมนุษยศาสตร์และสังคมศาสตร์</option>
                            <option value="คณะวิทยาศาสตร์และเทคโนโลยี">คณะวิทยาศาสตร์และเทคโนโลยี</option>
                            <option value="สำนักงานอธิการบดี">สำนักงานอธิการบดี</option>
                            <option value="สำนักงานบัณฑิตวิทยาลัย">สำนักงานบัณฑิตวิทยาลัย</option>
                            <option value="สำนักวิทยบริการและเทคโนโลยีสารสนเทศ">สำนักวิทยบริการและเทคโนโลยีสารสนเทศ
                            </option>
                            <option value="สถาบันภาษา ศิลปะและวัฒนธรรม">สถาบันภาษา ศิลปะและวัฒนธรรม</option>
                            <option value="สำนักส่งเสริมวิชาการและงานทะเบียน">สำนักส่งเสริมวิชาการและงานทะเบียน</option>
                            <option value="สถาบันวิจัยและพัฒนา">สถาบันวิจัยและพัฒนา</option>
                            <option value="อื่นๆ">อื่นๆ</option>
                        </select>

                    </div>


                </div>




                <div class="container el">
                    <label class="padding-none"><b>หมายเลขโทรศัพท์</b></label>
                    <hr class="divider">

                    <div class="row mb-2">

                        <div class="col-md-4 stacked-el">
                            <label for="code" class="text-sm padding-none">เครือข่าย</label>
                            <font color="red"> * </font>
                            <select name="country-code" id="code">
                                <?php
                                        echo "<option value='AIS'>AIS</option>";
                                        echo "<option value='DTAC'>DTAC</option>";
                                        echo "<option value='TrueMove H'>TrueMove H</option>";
                                        echo "<option value='my By CAT'>my By CAT</option>";
                                        echo "<option value='TOT'>TOT</option>";
                                        echo "<option value='other'>อื่นๆ</option>";
                                        ?>
                            </select>
                        </div>
                        <div class="col-md-8 stacked-el">
                            <label for="phone" class="text-sm padding-none">หมายเลข</label>
                            <font color="red"> * </font>
                            <input type="text" maxlength="10" name="phone"
                                placeholder="กรุณาระบุเบอร์ 10 ตัว ตัวอย่าง 0902289893" id="phone" class="form-control"
                                required>
                        </div>
                    </div>
                </div>

                <div class="row mb-2">


                    <div class="col-md-4 mb-2">
                        <label for="username"><b>ชื่อผู้ใช้</b></label>
                        <font color="red"> * </font>
                        <input type="text" name="username" id="username" class="form-control"
                            placeholder="ชื่อผู้ใช้ต้องมีความยาว 5 ตัวอักษรขึ้นไป" required>
                    </div>

                    <div class="col-md-4">
                        <label for="password"><b>รหัสผ่าน</b></label>
                        <font color="red"> * </font>
                        <input type="password" name="password" id="password" class="form-control"
                            placeholder="ต้องมีตัวเลขหรือตัวอักษรอย่างน้อย 8 ตัวอักษร" required>
                        <p class="text-red error-line1"></p>
                    </div>


                    <?php if (
                            isset($_SESSION['staff-user']) &&
                            $_SESSION['staff-user'] !== ''
                        ) { ?>
                    <div class="col-md-4 mb-2">
                        <label for="staff_level"><b>สถานะ</b></label>
                        <font color="red"> * </font>
                        <select class="form-control " type="text" name="staff_level" required>

                             
                            <option value="non-supervisor"> สมาชิก</option>
                            <!-- <option value="supervisor">เจ้าหน้าที่</option> -->

                        </select>

                    </div>

                    <input type="hidden" value="<?php echo " $staff_username"; ?>" name="staff_username"
                        id="staff_username" class="form-control">
                    <?php } ?>


                    <?php if (
                            isset($_SESSION['admin-user']) &&
                            $_SESSION['admin-user'] !== ''
                        ) { ?>

                    <div class="col-md-4 mb-2">
                        <label for="staff_level"><b>สถานะ</b></label>
                        <font color="red"> * </font>
                        <select class="form-control " type="text" name="staff_level" required>

                             
                            <option value="non-supervisor"> สมาชิก</option>
                            <option value="supervisor">เจ้าหน้าที่</option>

                        </select>

                    </div>
                </div>
                <?php } ?>

        </div>

        <div class="text-center">
            <button class="btn btn-primary" type="submit" name="registeruser">
                สมัครสมาชิก
            </button>
            <button type="button" onclick="<?php echo 'window.history.back(3);'; ?>" " class=" btn
                btn-default">ย้อนกลับ</button>
        </div>

        </form>
    </div>
</div>

<?php } elseif ($level == 'non-supervisor') { ?>
<td class="text-center mb-m-2">ไม่มีสิทธิ์</td>

<?php
        echo "<script type='text/javascript'>";
        echo "alert('เกิดข้อผิดพลาด ไม่มีสิทธิ์ !!');";
        echo 'window.history.back(1);';
        echo '</script>';
        ?>

<?php } elseif ($level == '') { ?>

<td class="text-center mb-m-2">ไม่มีสิทธิ์</td>

<?php
        echo "<script type='text/javascript'>";
        echo "alert('เกิดข้อผิดพลาด ไม่มีสิทธิ์   !!');";
        echo 'window.history.back(1);';
        echo '</script>';
        ?>
<?php } elseif ($level == 'non') { ?>

<td class="text-center mb-m-2">ไม่มีสิทธิ์</td>

<?php
        echo "<script type='text/javascript'>";
        echo "alert('เกิดข้อผิดพลาด ไม่มีสิทธิ์   !!');";
        echo 'window.history.back(1);';
        echo '</script>';
        ?>
<?php }
} ?>


<?php if (isset($_SESSION['admin-user']) && $_SESSION['admin-user'] !== '') { ?>

<div class="container">
    <h1 class="text-hide">สมัครสำหรับบัญชี</h1>



    <div class="row">

        <div class="col-md-12 mb-4 mx-auto">


            <form action="process.php" method="post" id="signup">
                <?php if (
                        isset($_SESSION['staff-user']) &&
                        $_SESSION['staff-user'] !== ''
                    ) { ?>

                <h4 class="alert alert-success" class="page-header alert alert-warning"><i
                        class="fa fa-table"></i>สมัครสำหรับบัญชีใหม่ </h4>
                <?php } ?>


                <?php if (
                        isset($_SESSION['admin-user']) &&
                        $_SESSION['admin-user'] !== ''
                    ) { ?>
                <h4 class="alert alert-success" class="page-header alert alert-warning"><i class="fa fa-table"></i><a
                        href="#" onclick="window.history.back(1);"> จัดการสมาชิก </a><a> / สมัครสำหรับบัญชีใหม่</a>
                </h4>

                <?php } ?>


                <div class="row mb-2">
                    <div class="col-md-4 mb-md-2">
                        <label for="title"><b>คำนำหน้า</b></label>
                        <font color="red"> * </font>

                        <select name="title" id="title">
                            <option value="นาย">นาย</option>
                            <option value="นาง">นาง</option>
                            <option value="Ms">นางสาว</option>
                            <option value="อาจารย์">อาจารย์</option>
                            <option value="รองศาสตราจารย์">รองศาสตราจารย์</option>
                            <option value="ผู้ช่วยศาสตราจารย์">ผู้ช่วยศาสตราจารย์</option>
                            <option value="ดร.">ดร.</option>
                            <option value="รศ.ดร">รศ.ดร</option>
                        </select>
                    </div>


                    <div class="col-md-4 mb-3">
                        <label for="firstname"><b>ชื่อ</b></label>
                        <font color="red"> * </font>
                        <input type="text" name="firstname" id="firstname" class="form-control"
                            placeholder="โปรดป้อนชื่อ" required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="lastname"><b>นามสกุล</b></label>
                        <font color="red"> * </font>
                        <input type="text" name="lastname" id="lastname" class="form-control"
                            placeholder="โปรดป้อนนามสกุล" required>
                    </div>

                </div>

                <div class="row my-2">

                    <div class="col-md-4 mb-2">
                        <label for="position"><b>ตำแหน่ง</b></label>
                        <font color="red"> * </font>
                        <!-- <input name="position" type="text" id="position" class="form-control" placeholder="ตัวอย่าง นักศึกษา"> -->
                        <select name="position" id="position">
                            <option value="">- เลือกตำแหน่ง -</option>
                            <option value="อาจารย์">อาจารย์</option>
                            <option value="เจ้าหน้าที่">เจ้าหน้าที่</option>
                            <option value="นักศึกษา ">นักศึกษา </option>
                            <option value="นักเรียน">นักเรียน</option>
                            <option value="บุคคลทั่วไป">บุคคลทั่วไป</option>
                        </select>
                    </div>

                    <div class="col-md-4 mb-2">
                        <label for="codepp"><b>เลขที่บัตรประชาชน</b></label>
                        <font color="red"> * </font>
                        <input name="codepp" maxlength="13" type="text" id="codepp" onkeyup="autoTab(this)"
                            class="form-control" placeholder="กรุณาระบุเลขที่บัตรประชาชน 13 ตัว" required>
                    </div>

                    <div class="col-md-4 mb-2">
                        <label for="email"><b>อีเมล</b></label>
                        <font for="code" class="text-sm padding-none"> อีเมลที่ใช้งานจริง
                            ระบบจะส่งข้อมูลที่จำเป็นไปยังอีเมลนี้</font>
                        <font color="red"> * </font>
                        <input type="email" name="email" id="email" class="form-control"
                            placeholder="โปรดป้อนอีเมล ตัวอย่าง xxxxx@gmail.com" required>
                    </div>

                </div>

                <div class="row my-2">

                    <div class="col-md-6 mb-2">
                        <label for="location"><b>ที่อยู่</b></label>
                        <font color="red"> * </font>
                        <?php
                            //<input name="location" rows="2" cols="20" id="location" class="form-control">
                            ?>
                        <textarea class="form-control input-sm" name="location" rows="2" cols="20" id="location"
                            class="form-control" rows="10" placeholder="โปรดป้อนข้อมูลที่อยู่ปัจจุบัน" type="text"
                            required></textarea>
                    </div>
                    <div class="col-md-6 mb-md-2">
                        <label for="Faculty"><b>คณะ/หน่วยงาน</b></label>
                        <font color="red"> * </font>

                        <select name="Faculty" id="Faculty">
                            <option value="">- เลือกคณะ/หน่วยงาน -</option>
                            <option value="คณะครุศาสตร์">คณะครุศาสตร์</option>
                            <option value="คณะเทคโนโลยีการเกษตร">คณะเทคโนโลยีการเกษตร</option>
                            <option value="คณะเทคโนโลยีอุตสาหกรรม">คณะเทคโนโลยีอุตสาหกรรม</option>
                            <option value="คณะวิทยาการจัดการ">คณะวิทยาการจัดการ</option>
                            <option value="คณะมนุษยศาสตร์และสังคมศาสตร์">คณะมนุษยศาสตร์และสังคมศาสตร์</option>
                            <option value="คณะวิทยาศาสตร์และเทคโนโลยี">คณะวิทยาศาสตร์และเทคโนโลยี</option>
                            <option value="สำนักงานอธิการบดี">สำนักงานอธิการบดี</option>
                            <option value="สำนักงานบัณฑิตวิทยาลัย">สำนักงานบัณฑิตวิทยาลัย</option>
                            <option value="สำนักวิทยบริการและเทคโนโลยีสารสนเทศ">สำนักวิทยบริการและเทคโนโลยีสารสนเทศ
                            </option>
                            <option value="สถาบันภาษา ศิลปะและวัฒนธรรม">สถาบันภาษา ศิลปะและวัฒนธรรม</option>
                            <option value="สำนักส่งเสริมวิชาการและงานทะเบียน">สำนักส่งเสริมวิชาการและงานทะเบียน</option>
                            <option value="สถาบันวิจัยและพัฒนา">สถาบันวิจัยและพัฒนา</option>
                            <option value="อื่นๆ">อื่นๆ</option>
                        </select>

                    </div>


                </div>




                <div class="container el">
                    <label class="padding-none"><b>หมายเลขโทรศัพท์</b></label>
                    <hr class="divider">

                    <div class="row mb-2">

                        <div class="col-md-4 stacked-el">
                            <label for="code" class="text-sm padding-none">เครือข่าย</label>
                            <font color="red"> * </font>
                            <select name="country-code" id="code">
                                <?php
                                    echo "<option value='AIS'>AIS</option>";
                                    echo "<option value='DTAC'>DTAC</option>";
                                    echo "<option value='TrueMove H'>TrueMove H</option>";
                                    echo "<option value='my By CAT'>my By CAT</option>";
                                    echo "<option value='TOT'>TOT</option>";
                                    echo "<option value='other'>อื่นๆ</option>";
                                    ?>
                            </select>
                        </div>
                        <div class="col-md-8 stacked-el">
                            <label for="phone" class="text-sm padding-none">หมายเลข</label>
                            <font color="red"> * </font>
                            <input type="text" maxlength="10" name="phone"
                                placeholder="กรุณาระบุเบอร์ 10 ตัว ตัวอย่าง 0902289893" id="phone" class="form-control"
                                required>
                        </div>
                    </div>
                </div>

                <div class="row mb-2">


                    <div class="col-md-4 mb-2">
                        <label for="username"><b>ชื่อผู้ใช้</b></label>
                        <font color="red"> * </font>
                        <input type="text" name="username" id="username" class="form-control"
                            placeholder="ชื่อผู้ใช้ต้องมีความยาว 5 ตัวอักษรขึ้นไป" required>
                    </div>

                    <div class="col-md-4">
                        <label for="password"><b>รหัสผ่าน</b></label>
                        <font color="red"> * </font>
                        <input type="password" name="password" id="password" class="form-control"
                            placeholder="ต้องมีตัวเลขหรือตัวอักษรอย่างน้อย 8 ตัวอักษร" required>
                        <p class="text-red error-line1"></p>
                    </div>



                    <?php if (
                        isset($_SESSION['staff-user']) &&
                        $_SESSION['staff-user'] !== ''
                    ) { ?>
                    <div class="col-md-4 mb-2">
                        <label for="staff_level"><b>สถานะ</b></label>
                        <font color="red"> * </font>
                        <select class="form-control " type="text" name="staff_level" required>

                             
                            <option value="non-supervisor"> สมาชิก</option>
                            <!-- <option value="supervisor">เจ้าหน้าที่</option> -->

                        </select>

                    </div>
                </div>
                <?php } ?>


                <?php if (
            isset($_SESSION['admin-user']) &&
            $_SESSION['admin-user'] !== ''
        ) { ?>

                <div class="col-md-4 mb-2">
                    <label for="staff_level"><b>สถานะ</b></label>
                    <font color="red"> * </font>
                    <select class="form-control " type="text" name="staff_level" required>

                         
                        <option value="non-supervisor"> สมาชิก</option>
                        <option value="supervisor">เจ้าหน้าที่</option>

                    </select>

                </div>

                <input type="hidden" value="<?php echo " $username"; ?>" name="staff_username" id="staff_username"
                    class="form-control">
                <?php } ?>

        </div>

        <div class="text-center">
            <button class="btn btn-primary" type="submit" name="registeradmin">
                สมัครสมาชิก
            </button>
            <button type="button" onclick="<?php echo 'window.history.back(3);'; ?>" " class=" btn
                btn-default">ย้อนกลับ</button>
        </div><br>

        </form>
    </div>
</div>
</div>
<?php } ?>
<script src="js/main.js"></script>