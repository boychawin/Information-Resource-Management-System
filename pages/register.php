<script src="https://www.google.com/recaptcha/api.js"></script>
<?php
include_once 'styles.php';
if (isset($_SESSION['username'])) {
    echo '<script>histroy.back();</script>';
}
?>

<div class="row">
    <h1 class="text-hide">หน้า | สมัครสำหรับบัญชีใหม่</h1>
    <title></title>


    <div class="col-md-12 mb-3 mx-auto">

        <div class="card  mb-3">
            <?php if (isset($_GET['error']) && !empty($_GET['error'])) {
                $error = $_GET['error'];
                echo "<small class='alert alert-danger alert-dismissible'>$error
                <span class='close' data-dismiss='alert'>&times;</span></small>";
            } ?>
            <form action="process.php" method="post" id="signup">
                <div class="card-header alert-success text-body">
                    <h4 class="text-center">สมัครสำหรับบัญชีใหม่</h4>
                </div><br>

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


                    <div class="col-md-6 mb-2">
                        <label for="username"><b>ชื่อผู้ใช้</b></label>
                        <font color="red"> * </font>
                        <input type="text" name="username" id="username" class="form-control"
                            placeholder="ชื่อผู้ใช้ต้องมีความยาว 5 ตัวอักษรขึ้นไป" required>
                    </div>

                    <div class="col-md-6">
                        <label for="password"><b>รหัสผ่าน</b></label>
                        <font color="red"> * </font>
                        <input type="password" name="password" id="password" class="form-control"
                            placeholder="ต้องมีตัวเลขหรือตัวอักษรอย่างน้อย 8 ตัวอักษร" required
                            onkeypress="return chspace()">
                        <p class="text-red error-line1"></p>
                    </div>
                </div>


                <div class="row mb-2">
                    <div class="col-md-12 mb-1">
                        <label><b>โปรดยืนยันตัวตน</b></label>
                        <font color="red"> * </font>
                        <div class="g-recaptcha" data-sitekey="6LdeLqkZAAAAAG2wiWXRdHduG-ndM6hduGCcuo4H"></div>
                    </div>
                </div>

                <div class="text-center">
                    <button class="btn btn-primary" type="submit" name="register">
                        สมัครสมาชิก
                    </button>
                </div><br>

                <p class="text-sm">
                    สมัครเรียบร้อยแล้ว?
                    <a href="index?tab=2" class="text-primary">เข้าสู่ระบบที่นี่</a>
                </p>

            </form>
        </div>
    </div>
</div>
</div>
<script src="js/main.js"></script>