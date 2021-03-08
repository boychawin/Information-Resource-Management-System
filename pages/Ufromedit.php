<h1 class='text-center hide'> หน้า | แก้ไขผู้ใช้</h1>
<?php
//1. เชื่อมต่อ database:
include 'connection.php'; //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี
//ตรวจสอบถ้าว่างให้เด้งไปหน้าหลัก
if ($_POST['id'] == '') {
    echo "<script type='text/javascript'>";
    echo "alert('เกิดข้อผิดพลาด !!');";
    echo 'window.history.back(1);';
    echo '</script>';
    echo 'เกิดข้อผิดพลาด';
}
//รับค่าไอดีที่จะแก้ไข
$id = mysqli_real_escape_string($db_con, $_POST['id']);
//2. query ข้อมูลจากตาราง:
$sql = "SELECT * FROM employee WHERE id='$id' ";
$result = mysqli_query($db_con, $sql);
$row = mysqli_fetch_array($result);
extract($row);
?>
<div class="row">
    <div class="col-lg-12">
        <h4 class="alert alert-success" class="page-header alert alert-warning"><i class="fa fa-table"></i><a href="#"
                onclick="window.history.back(1);"> จัดการสมาชิก </a><a> / แก้ไข</a></h4>
    </div>
    <!-- -->
</div>

<form role="form" name="updateuser" id="updateuser" class="form-group" method="post" action="Ufromedit_db.php">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">

                        <div class="col-lg-12">

                            <div class="row">

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>รหัส</label>
                                        <input class="form-control input-sm" type="text" name="id"
                                            value="<?php echo $id; ?>" readonly required>
                                    </div>
                                </div>


                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>ชื่อ</label>
                                        <input class="form-control input-sm" type="text" name="Category"
                                            value="<?php echo $fname; ?>" readonly>

                                    </div>
                                </div>
                            </div>




                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>ฃื่อผู้ใช้ </label>


                                        <input class="form-control input-sm" type="text" name="username" rows="3"
                                            value="<?php echo $username; ?>">
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>รหัสผ่าน </label>

                                        <font color='red' class='extra-sm'> *กรุณาขอรหัสผ่านจากสมาชิกท่านี้ก่อน
                                            หรือตั้งรหัสผ่านใหม่* </font>
                                        <input class="form-control input-sm" type="text" name="password" rows="3"
                                            value="">
                                    </div>
                                </div>



                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>ตำแหน่ง </label>
                                        <select class="form-control form-control-lg" type="text" name="staff_level"
                                            required>

                                              
                                            <option value="<?php echo $staff_level; ?>">
                                                <?php
                        if ($staff_level == 'non-supervisor') {
                            echo 'สมาชิก';
                        }
                        if ($staff_level == 'supervisor') {
                            echo 'เจ้าหน้าที่';
                        }
                        ?></option>
                                            <option value="non-supervisor"> สมาชิก</option>
                                            <option value="supervisor">เจ้าหน้าที่</option>

                                        </select>


                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <button name="updateuser" value="updateuser" type="submit" class="btn btn-success"
                                        id="btnConfirm">แก้ไข</button>
                                    <button type="button" onclick="<?php echo 'window.history.back(1);'; ?>"
                                        class="btn btn-default">ย้อนกลับ</button>



                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
</form>