<?php if (isset($_SESSION['admin-user']) && $_SESSION['admin-user'] !== '') { ?>

<?php include 'connection.php';
    //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี
    //ตรวจสอบถ้าว่างให้เด้งไปหน้าหลัก
	?>
<div class='col-md-10 mb-2 mx-auto'>
    <h1 class='text-center hide'>หน้า | เพิ่มหัวข้อในการจองใหม่</h1>
    <div class="row">
        <div class="col-lg-12">
            <h4 class="alert alert-success" class="page-header alert alert-warning"><i class="fa fa-table"></i> <a
                    value="จัดการร้องเรียน" href="#" onclick="window.history.back(2);">จัดการข้อมูลห้อง/โต๊ะ </a><a> /
                    เพิ่มใหม่</a></h4>
        </div>
        <!-- -->
    </div>
    <form name="form1" method="post" action="booking.php" enctype="multipart/form-data">
        <div class="form-group">
            <div class="col-md-8 ui-widget">
                <label class="col-md-4 control-label" for="id">รหัส </label>

                <div class="col-md-8">
                    <input id="id" class="form-control input-sm" name="id" readonly>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-8">
                <label class="col-md-4 control-label" for="name">ชื่อหัวข้อ<font color="red"> * </font></label>
                <div class="col-md-8">
                    <input id="booking_type" class="form-control input-sm" name="booking_type" required
                        placeholder="เช่น ห้องสร้างสุข ">
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-8">
                <label class="col-md-4 control-label" for="booking_id">เลขประจำห้อง/โต๊ะ<font color="red"> * </font>
                </label>
                <div class="col-md-8">
                    <input id="booking_id" class="form-control input-sm" name="booking_id" required
                        placeholder="เช่น 735 ">
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-8">
                <label class="col-md-4 control-label" for="Room_number">เลขลำดับห้อง/โต๊ะ<font color="red"> * </font>
                </label>
                <div class="col-md-8">
                    <select class="form-control input-sm" name="Room_number" id="Room_number">
                        <?php for ($i = 1; $i < 20; $i++) {
          echo "<option value='$i'>$i</option>";
      } ?>
                    </select>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-8">
                <label class="col-md-4 control-label" for="Capacity_person">ความจุ/คน<font color="red"> * </font>
                </label>
                <div class="col-md-8">
                    <select class="form-control input-sm" name="Capacity_person" id="Capacity_person">
                        <?php for ($i = 1; $i < 1000; $i++) {
          echo "<option value='$i'>$i</option>";
      } ?>
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
                        placeholder="เช่น 	ใช้สำหรับการประชุม " type="text"></textarea>
                </div>
            </div>
        </div>


        <div class="form-group">
            <div class="col-md-8">
                <label class="col-md-4 control-label" for="Room_type">ประเภทห้อง<font color="red"> * </font></label>
                <div class="col-md-8">
                    <input required id="Room_type" class="form-control input-sm" name="Room_type"
                        placeholder="เช่น ห้องค้นคว้า  ">
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-8">
                <label class="col-md-4 control-label" for="building">ตึก<font color="red"> * </font></label>
                <div class="col-md-8">
                    <input required id="building" class="form-control input-sm" name="building"
                        placeholder="เช่น 	บรรณราชนครินทร์  ">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-8">
                <label class="col-md-4 control-label" for="class">ชั้น<font color="red"> * </font></label>
                <div class="col-md-8">
                    <input required id="class" class="form-control input-sm" name="class" placeholder="เช่น 4 ">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-8">
                <label class="col-md-4 control-label" for="filAlbumShot">อัพโหลดรูป<font color="red"> * </font></label>
                <div class="col-md-8">
                    <input required type="file" name="filAlbumShot" class="form-control input-sm"><br>
                </div>
            </div>
            <!-- <div class="form-group">
		        <div class="col-md-8">
            <label class="col-md-4 control-label" for="staff_level">เลือกผู้ที่สามารถใช้ได้()</label>
		          <div class="col-md-8">
              <select class="form-control input-sm" name='staff_level' class='selectable'>
                       <option value='supervisor'>เจ้าหน้าที่</option>
                       <option value='non-supervisor'>ผู้ใช้</option>
                   </select>
		          </div>
		        </div>
		      </div>  -->
            <input required name="staff_level" value="non-supervisor" type="hidden" id="staff_level" />
            <!--  
          <input name="ACCOUNT_USERNAME" value="<?php echo $username; ?>" type="hidden" id="ACCOUNT_USERNAME"  />
          <input name="IDNO" value="<?php echo $id; ?>" type="hidden" id="IDNO"  />
          <input name="Email" value="<?php echo $email; ?>" type="hidden" id="Email"  /> -->

            <div class="form-group">
                <div class="col-md-8">
                    <label class="col-md-4 control-label" for="idno"></label>

                    <div class="col-md-8">
                        <button class="btn btn-success btn-sm" name="new_booking" value="Submit" type="submit"><span
                                class="fa fa-send fw-fa"></span> เพิ่มใหม่</button>
                        <button type="button" onclick="window.location='admin.php?tab=9' "
                            class="btn btn-default">ย้อนกลับ</button>
                    </div>
                </div>
            </div>
    </form>
</div>
</div>
<?php } ?>