<h1 class='text-center hide'> หน้า | แก้ไขรายละเอียดห้อง/โต๊ะ</h1>
<?php
//include('h2.php');
//1. เชื่อมต่อ database:
include 'connection.php'; //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี
//ตรวจสอบถ้าว่างให้เด้งไปหน้าหลัก
if ($_POST['id'] == '') {
  echo "<script type='text/javascript'>";
  echo "alert('เกิดข้อผิดพลาด !!');";
  echo "window.location = 'admin.php?tab=9'; ";
  echo '</script>';
  echo 'เกิดข้อผิดพลาด';
}
//รับค่าไอดีที่จะแก้ไข
$id = mysqli_real_escape_string($db_con, $_POST['id']);
//2. query ข้อมูลจากตาราง:
$sql = "SELECT * FROM booking WHERE id='$id' ";
$result = mysqli_query($db_con, $sql);
$row = mysqli_fetch_array($result);
extract($row);
?>
<div class="row">
    <div class="col-lg-12">
        <h4 class="alert alert-success" class="page-header alert alert-warning"><i class="fa fa-table"></i><a href="#"
                onclick="window.history.back(1);"> จัดการข้อมูลห้อง/โต๊ะ </a><a> / แก้ไขรายละเอียดห้อง/โต๊ะ</a> </h4>
    </div>
    <!-- -->
</div>
<form name="form1" method="post" action="locationupdate_db.php" enctype="multipart/form-data">
    <div class="form-group">
        <div class="col-md-8 ui-widget">
            <label class="col-md-4 control-label" for="id">รหัส </label>

            <div class="col-md-8">
                <input id="id" class="form-control input-sm" value="<?php echo $id; ?>" name="id" required readonly>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-8">
            <label class="col-md-4 control-label" for="booking_type">ชื่อหัวข้อ<font color="red"> * </font></label>
            <div class="col-md-8">
                <input required id="booking_type" class="form-control input-sm" value="<?php echo $booking_type; ?>"
                    name="booking_type" placeholder="เช่น ห้องสร้างสุข ">
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-8">
            <label class="col-md-4 control-label" for="booking_id">เลขประจำห้อง/โต๊ะ<font color="red"> * </font></label>
            <div class="col-md-8">
                <input required id="booking_type" class="form-control input-sm" value="<?php echo $booking_id; ?>"
                    name="booking_id" placeholder="เช่น 735 ">
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-8">
            <label class="col-md-4 control-label" for="Room_number">เลขลำดับห้อง/โต๊ะ<font color="red"> * </font>
            </label>
            <div class="col-md-8">
                <select class="form-control input-sm" name="Room_number" id="Room_number">
                    <?php
          echo "<option value=' $Room_number'>$Room_number</option>";
          for ($i = 1; $i < 20; $i++) {
            echo "<option value='$i'>$i</option>";
          }
          ?>
                </select>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-8">
            <label class="col-md-4 control-label" for="Capacity_person">ความจุ/คน<font color="red"> * </font></label>
            <div class="col-md-8">
                <select class="form-control input-sm" name="Capacity_person" id="Capacity_person">
                    <?php
          echo "<option value=' $Capacity_person'>$Capacity_person</option>";
          for ($i = 1; $i < 1000; $i++) {
            echo "<option value='$i'>$i</option>";
          }
          ?>
                </select>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-8">
            <label class="col-md-4 control-label" for="Room_details">รายละเอียดห้อง/โต๊ะ<font color="red"> * </font>
            </label>
            <div class="col-md-8">
                <textarea class="form-control input-sm" id="Room_details" rows="10" name="Room_details"
                    placeholder="เช่น 	ใช้สำหรับการประชุม " type="text"><?php echo $Room_details; ?></textarea>
            </div>
        </div>
    </div>


    <div class="form-group">
        <div class="col-md-8">
            <label class="col-md-4 control-label" for="Room_type">ประเภทห้อง<font color="red"> * </font></label>
            <div class="col-md-8">
                <input required id="Room_type" class="form-control input-sm" value="<?php echo $Room_type; ?>"
                    name="Room_type" placeholder="เช่น ห้องค้นคว้า  ">
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-8">
            <label class="col-md-4 control-label" for="building">ตึก<font color="red"> * </font></label>
            <div class="col-md-8">
                <input required id="building" class="form-control input-sm" value="<?php echo $building; ?>"
                    name="building" placeholder="เช่น 	บรรณราชนครินทร์  ">
            </div>
        </div>
    </div>


    <div class="form-group">
        <div class="col-md-8">
            <label class="col-md-4 control-label" for="class">ชั้น<font color="red"> * </font></label>
            <div class="col-md-8">
                <input required id="class" class="form-control input-sm" value="<?php echo $class; ?>" name="class"
                    placeholder="เช่น 4 ">
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-8">
            <label class="col-md-4 control-label" for="filAlbumShot">อัพโหลดรูป<font color="red"> * </font></label>
            <div class="col-md-8">
                <input required type="file" value="<?php echo $photo; ?>" name="filAlbumShot"
                    class="form-control input-sm">
            </div>
        </div>


        <input required type="hidden" value="non-supervisor" name="staff_level" class="form-control input-sm">
        <!--  
          <input name="ACCOUNT_USERNAME" value="<?php echo $username; ?>" type="hidden" id="ACCOUNT_USERNAME"  />
          <input name="IDNO" value="<?php echo $id; ?>" type="hidden" id="IDNO"  />
          <input name="Email" value="<?php echo $email; ?>" type="hidden" id="Email"  /> -->

        <div class="form-group">
            <div class="col-md-8">
                <label class="col-md-4 control-label" for="idno"></label>

                <div class="col-md-8">
                    <button class="btn btn-success btn-sm" name="btnSubmit" value="Submit" type="submit"><span
                            class="fa fa-send fw-fa"></span> แก้ไข</button>
                    <button type="button" onclick="window.location='admin.php?tab=9' "
                        class="btn btn-default">ย้อนกลับ</button>
                </div>
            </div>
        </div>
</form>
</div>