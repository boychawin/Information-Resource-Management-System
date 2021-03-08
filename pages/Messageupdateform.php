<h1 class='text-center hide'> หน้า | แก้ไขการร้องเรียน</h1>
<?php
//include('h2.php');
//1. เชื่อมต่อ database:
include 'connection.php'; //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี
//include_once("functions.php");
//ตรวจสอบถ้าว่างให้เด้งไปหน้าหลัก
if ($_POST['id'] == '') {
    echo "<script type='text/javascript'>";
    echo "alert('เกิดข้อผิดพลาด !!');";
    echo 'window.history.back(1);';
    echo '</script>';
    echo 'เกิดข้อผิดพลาด';
}
//รับค่าไอดีที่จะแก้ไข
$id = $_POST['id'];

//2. query ข้อมูลจากตาราง:
$sql = "SELECT * FROM tblmessage WHERE MessageID='$id' ";
$result = mysqli_query($db_con, $sql);
$row = mysqli_fetch_array($result);
extract($row);
?>
<?php if (isset($_SESSION['staff-user']) && $_SESSION['staff-user'] !== '') { ?>
<?php if ($level == 'supervisor') { ?>
<div class="row">
    <div class="col-lg-12">
        <h4 class="alert alert-success" class="page-header alert alert-warning"><i class="fa fa-table"></i> <a
                value="จัดการร้องเรียน" href="#" onclick="window.history.back(1);">จัดการร้องเรียน </a><a> / แก้ไข</a>
        </h4>
    </div>
    <!-- -->
</div>
<?php if (
        isset($_SESSION['staff-user']) &&
        $_SESSION['staff-user'] !== ''
    ) { ?>
<form role="form" name="user" id="user" class="form-group" method="post" action="Messageupdate_db.php">

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
                                        <input class="form-control input-sm" type="text" name="MessageID"
                                            value="<?php echo $MessageID; ?>" readonly required>
                                    </div>
                                </div>


                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>ประเภท</label>

                                        <select class="form-control input-sm" type="text" name="Category" readonly>
                                            <option value="<?php echo $Category; ?>"><?php echo $Category; ?></option>
                                            <option>แจ้งอุปกรณ์ชำรุด</option>
                                            <option>แจ้งอุปกรณ์ไม่สะอาด</option>
                                            <option>แจ้งมีคนลืมของ</option>
                                            <option>ร้องเรียนเรื่องการบริการ</option>
                                            <option>อื่นๆ</option>

                                        </select>


                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="form-group">
                                        <label>อธิบายปัญหาของท่าน </label>
                                        <input class="form-control input-sm" type="textarea" name="MessageText" rows="3"
                                            value="<?php echo $MessageText; ?>" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>หัวข้อ </label>
                                        <input class="form-control input-sm" type="textarea" name="MessageCODE" rows="3"
                                            value="<?php echo $MessageCODE; ?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>สถานะ </label>
                                        <select class="form-control form-control-lg" type="text" name="Mstatus"
                                            required>
                                            <option value="<?php echo $Mstatus; ?>"><?php echo $Mstatus; ?></option>
                                            <option value="แก้ไขแล้ว"> แก้ไขแล้ว</option>
                                            <option value="ได้ทำความสะอาดแล้ว">ได้ทำความสะอาดแล้ว</option>
                                            <option value="รับของแล้ว">รับของแล้ว</option>
                                            <option value="รับเรื่องแล้ว">รับเรื่องแล้ว</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <input name="date_receive" value="<?php echo date('Y-m-d');?>" type="hidden"
                                id="date_receive" />
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <button name="user" value="user" type="submit" class="btn btn-success"
                                        id="user">แก้ไข</button>
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
<?php } ?>
<?php } elseif ($level == 'non-supervisor') { ?>
<td class="text-center mb-m-2">ไม่มีสิทธิ์</td>
<?php
    echo "<script type='text/javascript'>";
    echo "alert('เกิดข้อผิดพลาด ท่านไม่มีสิทธิ์   !!');";
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

<?php }} ?>

<?php if (
      isset($_SESSION['admin-user']) &&
      $_SESSION['admin-user'] !== ''
  ) { ?>
<div class="row">
    <div class="col-lg-12">
        <h4 class="alert alert-success" class="page-header alert alert-warning"><i class="fa fa-table"></i> <a
                value="จัดการร้องเรียน" href="#" onclick="window.history.back(1);">จัดการร้องเรียน </a><a> / แก้ไข</a>
        </h4>
    </div>
    <!-- -->
</div>
<form role="form" name="admin" id="admin" class="form-group" method="post" action="Messageupdate_db.php">

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
                                        <input class="form-control input-sm" type="text" name="MessageID"
                                            value="<?php echo $MessageID; ?>" readonly required>
                                    </div>
                                </div>


                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>ประเภท</label>

                                        <select class="form-control input-sm" type="text" name="Category" readonly>
                                            <option value="<?php echo $Category; ?>"><?php echo $Category; ?></option>
                                            <option>แจ้งอุปกรณ์ชำรุด</option>
                                            <option>แจ้งอุปกรณ์ไม่สะอาด</option>
                                            <option>แจ้งมีคนลืมของ</option>
                                            <option>ร้องเรียนเรื่องการบริการ</option>
                                            <option>อื่นๆ</option>

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="form-group">
                                        <label>อธิบายปัญหาของท่าน </label>
                                        <input class="form-control input-sm" type="textarea" name="MessageText" rows="3"
                                            value="<?php echo $MessageText; ?>" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>หัวข้อ </label>
                                        <input class="form-control input-sm" type="textarea" name="MessageCODE" rows="3"
                                            value="<?php echo $MessageCODE; ?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>สถานะ </label>
                                        <select class="form-control form-control-lg" type="text" name="Mstatus"
                                            required>
                                            <option value="<?php echo $Mstatus; ?>"><?php echo $Mstatus; ?></option>
                                            <option value="แก้ไขแล้ว"> แก้ไขแล้ว</option>
                                            <option value="ได้ทำความสะอาดแล้ว">ได้ทำความสะอาดแล้ว</option>
                                            <option value="รับของแล้ว">รับของแล้ว</option>
                                            <option value="รับเรื่องแล้ว">รับเรื่องแล้ว</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <input name="date_receive" value="<?php echo date('Y-m-d');?>" type="hidden"
                                id="date_receive" />
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <button name="admin" value="admin" type="submit" class="btn btn-success"
                                        id="admin">แก้ไข</button>
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
<?php } ?>