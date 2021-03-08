<h1 class='text-center hide'> หน้า | แก้ไขรายละเอียตัดสิทธิ์</h1>
<?php
//1. เชื่อมต่อ database: 
include('connection.php');  //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี
//ตรวจสอบถ้าว่างให้เด้งไปหน้าหลัก
if ($_POST["staff_id"] == '') {
  echo "<script type='text/javascript'>";
  echo "alert('เกิดข้อผิดพลาด !!');";
  echo "window.location = 'admin.php?tab=17'; ";
  echo "</script>";
  echo "เกิดข้อผิดพลาด";
}
//รับค่าไอดีที่จะแก้ไข
$staff_id = mysqli_real_escape_string($db_con, $_POST['staff_id']);

//2. query ข้อมูลจากตาราง: 
$sql = "SELECT * FROM employee WHERE staff_id='$staff_id' ";
$result = mysqli_query($db_con, $sql);
$row = mysqli_fetch_array($result);
extract($row);

$Suspend = "Suspend";
$a = 1;
$staff_level1 = "non";
$b = $a + $total_reject;
$day_reject = date("d-m-yy");
$day_rejectend = date("d-m-yy");

?>
<div class="row">
    <div class="col-lg-12">
        <h4 class="alert alert-success" class="page-header alert alert-warning"><i class="fa fa-table"></i> <a href="#"
                onclick="window.history.back(1);"> ข้อมูลตัดสิทธิ์ </a><a> / แก้ไขรายละเอียตัดสิทธิ์</a> </h4>
    </div>
    <!-- -->
</div>
<form name="form1" method="post" action="disqualify_db.php" enctype="multipart/form-data">
    <div class="form-group">
        <div class="col-md-8 ui-widget">
            <label class="col-md-4 control-label" for="id">รหัสสมาชิก </label>

            <div class="col-md-8">
                <input id="id" class="form-control input-sm" value="<?php echo $staff_id; ?>" name="staff_id" readonly>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-8">
            <label class="col-md-4 control-label" for="b">จำนวน/ครั้ง ที่โดนระงับ</label>
            <div class="col-md-8">
                <input id="b" class="form-control input-sm" value="<?php echo $b; ?>" name="b" readonly>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-8">
            <label class="col-md-4 control-label" for="Suspend">สถานะการจอง</label>
            <div class="col-md-8">
                <input id="Suspend" class="form-control input-sm" value="<?php echo $Suspend; ?>" name="Suspend"
                    readonly>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-8">
            <label class="col-md-4 control-label" for="staff_level1">สถานะสมาชิก</label>
            <div class="col-md-8">
                <input id="staff_level1" class="form-control input-sm" value="<?php echo $staff_level1; ?>"
                    name="staff_level1" readonly>
            </div>
        </div>
    </div>


    <div class="form-group">
        <div class="col-md-8">
            <label class="col-md-4 control-label" for="day_reject">วัน/เวลา เริ่มต้น</label>
            <div class="col-md-8">
                <input id="day_reject" class="form-control input-sm" value="<?php echo $day_reject; ?>"
                    name="day_reject" readonly>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-8">
            <label class="col-md-4 control-label" for="day_rejectend">วัน/เวลา สิ้นสุด</label>
            <div class="col-md-8">
                <input id="day_rejectend" class="form-control input-sm" value="<?php echo $day_rejectend; ?>"
                    name="day_rejectend">
            </div>
        </div>
    </div>



    <div class="form-group">
        <div class="col-md-8">
            <label class="col-md-4 control-label" for="idno"></label>

            <div class="col-md-8">
                <button class="btn btn-success btn-sm" name="btnSubmit" value="Submit" type="submit"><span
                        class="fa fa-send fw-fa"></span> ยีนยัน</button>
                <button type="button" onclick="window.location='admin.php?tab=17' "
                    class="btn btn-default">ย้อนกลับ</button>
            </div>
        </div>
    </div>
</form>