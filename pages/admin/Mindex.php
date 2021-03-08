<h1 class='text-center hide'>หน้า | </h1>
<?php
// require '../config/thai_date.php';
?>
<?php if (isset($_SESSION['staff-user']) && $_SESSION['staff-user'] !== '') { ?>
  <?php if ($level == 'supervisor') { ?>
    <div class="row">
      <div class="col-lg-12">
        <div class="col-lg-6">
          <h1 class="page-header">เรื่องแจ้ง/ร้องเรียน</h1>
        </div>
      </div>
      <!-- /.col-lg-12 -->
    </div>

    <div class="table-responsive">
      <ul class="nav nav-pills" id="myTab">
        <li class="nav-item"><a class="nav-link active" href="#inbox" data-toggle="tab">ข้อความการร้องเรียน</a></li>
        <!-- <li  ><a href="#sent" data-toggle="tab">Sent Messages</a></li>  -->
        <li class="nav-item"><a class="nav-link" href="#create" data-toggle="tab">สร้างข้อความ</a></li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane active" id="inbox">
          <div class="col-lg-12">

            <br />

            <?php
            include 'db_connect.php'; // เรียกใช้งานไฟล์เชื่อมต่อกับฐานข้อมูล
            $mysqli = connect();
            // เชื่อมต่อกับฐานข้อมูล
            $sql = 'SELECT * FROM tblmessage ORDER BY MessageID DESC';
            $result = $mysqli->query($sql);
            $con = connect();
            // เชื่อมต่อกับฐานข้อมูล
            $sql = 'SELECT * FROM tblmessage ORDER BY MessageID DESC';
            $result1 = $con->query($sql);
            ?>
            <!-- <script>
$.fn.editable.defaults.mode = 'popup';//inline
    $(document).ready(function() {		
		var currentYear = (new Date).getFullYear();
		//alert(currentYear);
      $('#dataTables-example').dataTable({
        responsive: true,"order": [[ 1, "DESC" ]],	  
      	    });
      	  });		  
  </script> -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script>
              $(document).ready(function() {
                $("#myInput").on("keyup", function() {
                  var value = $(this).val().toLowerCase();
                  $("#myTable tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                  });
                });
              });
            </script>
            <script>
              $(document).ready(function() {
                $("#myInput2").on("keyup", function() {
                  var value = $(this).val().toLowerCase();
                  $("#myTable2 tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                  });
                });
              });
            </script>
            <div class="row">
              <div class="col-lg-12">
                <h3 class="alert alert-success" class="page-header alert btn-info"><i class="fa fa-table"></i> รายการที่ยังไม่ตรวจสอบ</h3>
              </div>
              <!-- /.col-lg-12 -->
            </div>
            <div class="panel-body">
              <div class="dataTable_wrapper">

                <input class="form-control" id="myInput" type="text" placeholder="ค้นหาข้อมูลในตาราง"><br>


                <table class="table table-bordered table-responsive-sm w-100">
                  <thead>
                    <tr>
                      <th width="2%">ลำดับ</th>
                      <th width="8%">ชื่อผู้ใช้</th>
                      <th width="18%">ประเภท</th>
                      <th width="22%">อธิบายปัญหา</th>
                      <th width="10%">หัวข้อ</th>
                      <th width="20%">รูป</th>
                      <th width="12%">สถานะ</th>
                      <th width="18%">เปลี่ยนสถานะ</th>
                      <th width="10%">ลบ</th>

                    </tr>
                  </thead>
                  <tbody id="myTable">
                    <?php while ($row = $result->fetch_object()) {
                      if (
                        $row->Mstatus != 'แก้ไขแล้ว' &&
                        $row->Mstatus != 'ได้ทำความสะอาดแล้ว' &&
                        $row->Mstatus != 'รับของแล้ว' &&
                        $row->Mstatus != 'รับเรื่องแล้ว'
                      ) { ?>
                        <tr>
                          <td class="center"><?php echo $row->MessageID; ?> </td>
                          <td class="center"><?php echo $row->ACCOUNT_USERNAME; ?> </td>
                          <td class="center"><?php echo $row->Category; ?></td>
                          <td class="center"><?php echo $row->MessageText; ?></td>
                          <td class="center"><?php echo $row->MessageCODE; ?></td>
                          <td class="center" align=center><img class="center" src="../pages/user/myfile/<?php echo $row->Mimage; ?>" alt="Nature" class="resize" style="width:100%"><a href="../pages/user/myfile/<?php echo $row->Mimage; ?>" class="btn btn-link" target='_blank'> <span>คลิกดูรูป</span></a></td>
                          <td class="center"><?php echo $row->Mstatus; ?></td>
                          <td class="center">
                            <?php if (
                              isset($_SESSION['staff-user']) &&
                              $_SESSION['staff-user'] !== ''
                            ) { ?>
                              <form method="post" action="../pages/dashboard.php?tab=15">
                                <input type='hidden' name='id' value='<?php echo $row->MessageID; ?>'>

                                <button title="Edit" name="user" type="submit" class="btn btn-primary btn-xs"><span class="fa fa-edit fw-fa"></span></button>
                              </form>
                            <?php } ?>
                            <?php if (
                              isset($_SESSION['admin-user']) &&
                              $_SESSION['admin-user'] !== ''
                            ) { ?>
                              <form method="post" action="../pages/admin.php?tab=18">
                                <input type='hidden' name='id' value='<?php echo $row->MessageID; ?>'>

                                <button title="Edit" name="admin" type="submit" class="btn btn-primary btn-xs"><span class="fa fa-edit fw-fa"></span></button>
                              </form>

                            <?php } ?>
                          </td>

                          <td><a title="Delete" href="../pages/admin/MDelete.php?id=<?php echo $row->MessageID; ?>" onclick="return confirm('คุณต้องการลบข้อมูลที่เลือกใช่หรือไม')" class="btn btn-danger btn-xs"><span class="fa fa-trash-o fw-fa"></span> </a></td>

                        </tr>
                    <?php }
                    }
                    //mysqli_close($db_con);
                    ?>
                  </tbody>
                </table>

              </div>
              <!-- /.table-responsive -->
            </div>
            <div class="row">
              <div class="col-lg-12">
                <h3 class="alert alert-success" class="page-header alert btn-info"><i class="fa fa-table"></i> รายการที่ตรวจสอบแล้ว</h3>
              </div>
              <!-- /.col-lg-12 -->
            </div>
            <div class="panel-body">
              <div class="dataTable_wrapper">

                <input class="form-control" id="myInput2" type="text" placeholder="ค้นหาข้อมูลในตาราง"><br>
                <table class="table table-bordered table-responsive-sm w-100">
                  <thead>
                    <tr>
                      <th width="2%">ลำดับ</th>
                      <th width="8%">ชื่อผู้ใช้</th>
                      <th width="18%">ประเภท</th>
                      <th width="22%">อธิบายปัญหา</th>
                      <th width="10%">หัวข้อ</th>
                      <th width="20%">รูป</th>
                      <th width="20%">สถานะ</th>
                      <th width="10%">ลบ</th>
                    </tr>
                  </thead>
                  <tbody id="myTable2">
                    <?php while ($row = $result1->fetch_object()) {
                      if (
                        $row->Mstatus == 'แก้ไขแล้ว' ||
                        $row->Mstatus == 'ได้ทำความสะอาดแล้ว' ||
                        $row->Mstatus == 'รับของแล้ว' ||
                        $row->Mstatus == 'รับเรื่องแล้ว'
                      ) { ?>
                        <tr>
                          <td class="center"><?php echo $row->MessageID; ?> </td>
                          <td class="center"><?php echo $row->ACCOUNT_USERNAME; ?> </td>
                          <td class="center"><?php echo $row->Category; ?></td>
                          <td class="center"><?php echo $row->MessageText; ?></td>
                          <td class="center"><?php echo $row->MessageCODE; ?></td>
                          <td class="center" align=center><img class="center" src="../pages/user/myfile/<?php echo $row->Mimage; ?>" alt="Nature" class="resize" style="width:100%"><a href="../pages/user/myfile/<?php echo $row->Mimage; ?>" class="btn btn-link" target='_blank'> <span>คลิกดูรูป</span></a></td>
                          <td class="center"><?php echo $row->Mstatus; ?></td>
                          <!-- <td class="center"><a  title="Edit"href="../pages/Messageupdateform.php?id=<?php echo $row->MessageID; ?>" class="btn btn-primary btn-xs  "> <span class="fa fa-edit fw-fa"></span></a></td> -->
                          <td><a title="Delete" href="../pages/admin/MDelete.php?id=<?php echo $row->MessageID; ?>" onclick="return confirm('คุณต้องการลบข้อมูลที่เลือกใช่หรือไม')" class="btn btn-danger btn-xs"><span class="fa fa-trash-o fw-fa"></span> </a></td>

                        </tr>
                    <?php }
                    }
                    //mysqli_close($db_con);
                    ?>

                  </tbody>
                </table>

              </div>
              <!-- /.table-responsive -->
            </div>
          </div>
        </div>

        <div class="tab-pane " id="create">
          <br />
          <?php
          session_start();
          $fname = $_SESSION['staff-fname'];
          $email = $_SESSION['staff-email'];
          include 'booking-types.php';
          ?>
          <form name="form1" method="post" action="user/controller2.php" enctype="multipart/form-data">
            <div class="form-group">
              <div class="col-md-8 ui-widget">
                <label class="col-md-4 control-label" for="MessageCODE">หัวข้อ <font color='red'> * </font></label>

                <div class="col-md-8">
                  <input id="name" class="form-control input-sm" name="MessageCODE" placeholder="โปรดป้อนชื่อหัวข้อ " required>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-8">
                <label class="col-md-4 control-label" for="Category">ประเภท<font color='red'> * </font></label>
                <div class="col-md-8">
                  <select class="form-control input-sm" type="text" name="Category" required>
                    <option>แจ้งอุปกรณ์ชำรุด</option>
                    <option>แจ้งอุปกรณ์ไม่สะอาด</option>
                    <option>แจ้งมีคนลืมของ</option>
                    <option>ร้องเรียนเรื่องการบริการ</option>
                    <option>อื่นๆ</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-8">
                <label class="col-md-12 control-label" for="MessageText">อธิบายปัญหาของท่าน<font color="red"> *กรุณาบอกสถานที่พบด้วย*</font></label>

                <div class="col-md-8">
                  <textarea class="form-control input-sm" id="MessageText" rows="10" name="MessageText" placeholder="อธิบายปัญหา " type="text"></textarea>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-8">
                <label class="col-md-12 control-label" for="filAlbumShot">อัพโหลดรูป<font color='red'> * ไฟล์ .jpg .png .jpeg </font></label>
                <div class="col-md-8">
                  <input type="file" name="filAlbumShot" class="form-control input-sm"><br>
                </div>
              </div>
            </div>
            <input name="ACCOUNT_USERNAME" value="<?php echo $username; ?>" type="hidden" id="ACCOUNT_USERNAME" />
            <input name="IDNO" value="<?php echo $id; ?>" type="hidden" id="IDNO" />
            <input name="Email" value="<?php echo $email; ?>" type="hidden" id="Email" />
            <input name="Mstatus" value="รอตรวจสอบ" type="hidden" id="Mstatus" />
            <input name="date_no" value="<?php echo date('Y-m-d'); ?>" type="hidden" id="date_no" />

            <div class="form-group">
              <div class="col-md-8">
                <label class="col-md-4 control-label" for="idno"></label>

                <div class="col-md-8">
                  <button class="btn btn-primary btn-sm" name="btnSubmituser" value="Submit" type="submit"><span class="fa fa-send fw-fa"></span> ส่ง</button>
                </div>
              </div>
            </div>
          </form>
          <div class="form-group">
            <div class="col-md-8">
              <label class="col-md-4 control-label" for="idno"></label>

              <div class="col-md-8">

                <!-- <a href="index.php" class="btn btn-info"><span class="fa fa-arrow-circle-left fw-fa"></span></span>&nbsp;<strong>List of Users</strong></a> -->
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--/tab-content-->
    </div>
    </div>
    <!---End of container-->

  <?php } elseif ($level == 'non-supervisor') { ?>

    <td class="text-center mb-m-2">ไม่มีสิทธิ์</td>

    <?php
    echo "<script type='text/javascript'>";
    echo "alert('เกิดข้อผิดพลาด ไม่มีสิทธิ์   !!');";
    echo 'window.history.back(1);';
    echo '</script>';
    echo 'เกิดข้อผิดพลาด';
    ?>
  <?php } elseif ($level == '') { ?>

    <td class="text-center mb-m-2">ไม่มีสิทธิ์</td>

    <?php
    echo "<script type='text/javascript'>";
    echo "alert('เกิดข้อผิดพลาด ท่านไม่มีสิทธิ์   !!');";
    echo 'window.history.back(1);';
    echo '</script>';
    echo 'เกิดข้อผิดพลาด';
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
  <div class="row">
    <div class="col-lg-12">
      <div class="col-lg-6">
        <h1 class="page-header">เรื่องแจ้ง/ร้องเรียน</h1>
      </div>
    </div>
    <!-- /.col-lg-12 -->
  </div>

  <div class="table-responsive">
    <ul class="nav nav-pills" id="myTab">
      <li class="nav-item"><a class="nav-link active" href="#inbox" data-toggle="tab">ข้อความการร้องเรียน</a></li>
      <!-- <li  ><a href="#sent" data-toggle="tab">Sent Messages</a></li>  -->
      <li class="nav-item"><a class="nav-link" href="#create" data-toggle="tab">สร้างข้อความ</a></li>
    </ul>
    <div class="tab-content">
      <div class="tab-pane active" id="inbox">
        <div class="col-lg-12">

          <br />
          <?php
          include 'db_connect.php'; // เรียกใช้งานไฟล์เชื่อมต่อกับฐานข้อมูล
          $mysqli = connect(); // เชื่อมต่อกับฐานข้อมูล
          $sql = 'SELECT * FROM tblmessage ORDER BY MessageID DESC';
          $result = $mysqli->query($sql);
          $con = connect(); // เชื่อมต่อกับฐานข้อมูล
          $sql = 'SELECT * FROM tblmessage ORDER BY MessageID DESC';
          $result1 = $con->query($sql);
          ?>
          <!-- <script>
$.fn.editable.defaults.mode = 'popup';//inline
    $(document).ready(function() {
		
		var currentYear = (new Date).getFullYear();
		//alert(currentYear);
      $('#dataTables-example').dataTable({
        responsive: true,"order": [[ 1, "DESC" ]],
    	    });
      	  });
		  
  </script> -->
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
          <script>
            $(document).ready(function() {
              $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function() {
                  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
              });
            });
          </script>
          <script>
            $(document).ready(function() {
              $("#myInput2").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable2 tr").filter(function() {
                  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
              });
            });
          </script>
          <div class="row">
            <div class="col-lg-12">
              <h3 class="alert alert-success" class="page-header alert btn-info"><i class="fa fa-table"></i> รายการที่ยังไม่ตรวจสอบ</h3>
            </div>
            <!-- /.col-lg-12 -->
          </div>
          <div class="panel-body">
            <div class="dataTable_wrapper">

              <input class="form-control" id="myInput" type="text" placeholder="ค้นหาข้อมูลในตาราง"><br>


              <table class="table table-bordered table-responsive-sm w-100">
                <thead>
                  <tr>
                    <th width="2%">ลำดับ</th>
                    <th width="8%">ชื่อผู้ใช้</th>
                    <th width="18%">ประเภท</th>
                    <th width="22%">อธิบายปัญหา</th>
                    <th width="10%">หัวข้อ</th>
                    <th width="20%">รูป</th>
                    <th width="12%">สถานะ</th>
                    <th width="18%">เปลี่ยนสถานะ</th>
                    <th width="10%">ลบ</th>

                  </tr>
                </thead>
                <tbody id="myTable">
                  <?php while ($row = $result->fetch_object()) {
                    if (
                      $row->Mstatus != 'แก้ไขแล้ว' &&
                      $row->Mstatus != 'ได้ทำความสะอาดแล้ว' &&
                      $row->Mstatus != 'รับของแล้ว' &&
                      $row->Mstatus != 'รับเรื่องแล้ว'
                    ) { ?>
                      <tr>
                        <td class="center"><?php echo $row->MessageID; ?> </td>
                        <td class="center"><?php echo $row->ACCOUNT_USERNAME; ?> </td>
                        <td class="center"><?php echo $row->Category; ?></td>
                        <td class="center"><?php echo $row->MessageText; ?></td>
                        <td class="center"><?php echo $row->MessageCODE; ?></td>
                        <td class="center" align=center><img class="center" src="../pages/user/myfile/<?php echo $row->Mimage; ?>" alt="Nature" class="resize" style="width:100%"><a href="../pages/user/myfile/<?php echo $row->Mimage; ?>" class="btn btn-link" target='_blank'> <span>คลิกดูรูป</span></a></td>
                        <td class="center"><?php echo $row->Mstatus; ?></td>



                        <td class="center">
                          <?php if (
                            isset($_SESSION['staff-user']) &&
                            $_SESSION['staff-user'] !== ''
                          ) { ?>
                            <form method="post" action="../pages/dashboard.php?tab=15">
                              <input type='hidden' name='id' value='<?php echo $row->MessageID; ?>'>

                              <button title="Edit" name="user" type="submit" class="btn btn-primary btn-xs"><span class="fa fa-edit fw-fa"></span></button>
                            </form>
                          <?php } ?>
                          <?php if (
                            isset($_SESSION['admin-user']) &&
                            $_SESSION['admin-user'] !== ''
                          ) { ?>
                            <form method="post" action="../pages/admin.php?tab=18">
                              <input type='hidden' name='id' value='<?php echo $row->MessageID; ?>'>

                              <button title="Edit" name="admin" type="submit" class="btn btn-primary btn-xs"><span class="fa fa-edit fw-fa"></span></button>
                            </form>

                          <?php } ?>
                        </td>

                        <td><a title="Delete" href="../pages/admin/MDeletes.php?id=<?php echo $row->MessageID; ?>" onclick="return confirm('คุณต้องการลบข้อมูลที่เลือกใช่หรือไม')" class="btn btn-danger btn-xs"><span class="fa fa-trash-o fw-fa"></span> </a></td>

                      </tr>
                  <?php }
                  }
                  //mysqli_close($db_con);
                  ?>
                </tbody>
              </table>

            </div>
            <!-- /.table-responsive -->
          </div>
          <div class="row">
            <div class="col-lg-12">
              <h3 class="alert alert-success" class="page-header alert btn-info"><i class="fa fa-table"></i> รายการที่ตรวจสอบแล้ว</h3>
            </div>
            <!-- /.col-lg-12 -->
          </div>
          <div class="panel-body">
            <div class="dataTable_wrapper">

              <input class="form-control" id="myInput2" type="text" placeholder="ค้นหาข้อมูล ลำดับ, ชื่อผู้ใช้, ประเภท"><br>


              <table class="table table-bordered table-responsive-sm w-100">
                <thead>
                  <tr>
                    <th width="2%">ลำดับ</th>
                    <th width="8%">ชื่อผู้ใช้</th>
                    <th width="18%">ประเภท</th>
                    <th width="22%">อธิบายปัญหา</th>
                    <th width="10%">หัวข้อ</th>
                    <th width="20%">รูป</th>
                    <th width="20%">สถานะ</th>

                    <th width="10%">ลบ</th>

                  </tr>
                </thead>
                <tbody id="myTable2">
                  <?php while ($row = $result1->fetch_object()) {
                    if (
                      $row->Mstatus == 'แก้ไขแล้ว' ||
                      $row->Mstatus == 'ได้ทำความสะอาดแล้ว' ||
                      $row->Mstatus == 'รับของแล้ว' ||
                      $row->Mstatus == 'รับเรื่องแล้ว'
                    ) { ?>
                      <tr>
                        <td class="center"><?php echo $row->MessageID; ?> </td>
                        <td class="center"><?php echo $row->ACCOUNT_USERNAME; ?> </td>
                        <td class="center"><?php echo $row->Category; ?></td>
                        <td class="center"><?php echo $row->MessageText; ?></td>
                        <td class="center"><?php echo $row->MessageCODE; ?></td>
                        <td class="center" align=center><img class="center" src="../pages/user/myfile/<?php echo $row->Mimage; ?>" alt="Nature" class="resize" style="width:100%"><a href="../pages/user/myfile/<?php echo $row->Mimage; ?>" class="btn btn-link" target='_blank'> <span>คลิกดูรูป</span></a></td>
                        <td class="center"><?php echo $row->Mstatus; ?></td>
                        <!-- <td class="center"><a  title="Edit"href="../pages/Messageupdateform.php?id=<?php echo $row->MessageID; ?>" class="btn btn-primary btn-xs  "> <span class="fa fa-edit fw-fa"></span></a></td> -->
                        <td><a title="Delete" href="../pages/admin/MDeletes.php?id=<?php echo $row->MessageID; ?>" onclick="return confirm('คุณต้องการลบข้อมูลที่เลือกใช่หรือไม')" class="btn btn-danger btn-xs"><span class="fa fa-trash-o fw-fa"></span> </a></td>

                      </tr>
                  <?php }
                  }
                  //mysqli_close($db_con);
                  ?>
                </tbody>
              </table>

            </div>
            <!-- /.table-responsive -->
          </div>
        </div>
      </div>

      <div class="tab-pane " id="create">
        <br />


        <?php
        session_start();
        $fname = $_SESSION['staff-fname'];
        $email = $_SESSION['staff-email'];
        include 'booking-types.php';
        ?>
        <form name="form1" method="post" action="user/controller2.php" enctype="multipart/form-data">
          <div class="form-group">
            <div class="col-md-8 ui-widget">
              <label class="col-md-4 control-label" for="MessageCODE">หัวข้อ <font color='red'> * </font></label>

              <div class="col-md-8">
                <input id="name" class="form-control input-sm" name="MessageCODE" placeholder="โปรดป้อนชื่อหัวข้อ " required>
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-8">
              <label class="col-md-4 control-label" for="Category">ประเภท<font color='red'> * </font></label>
              <div class="col-md-8">
                <select class="form-control input-sm" type="text" name="Category" required>

                  <option>แจ้งอุปกรณ์ชำรุด</option>
                  <option>แจ้งอุปกรณ์ไม่สะอาด</option>
                  <option>แจ้งมีคนลืมของ</option>
                  <option>ร้องเรียนเรื่องการบริการ</option>
                  <option>อื่นๆ</option>

                </select>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-8">
              <label class="col-md-12 control-label" for="MessageText">อธิบายปัญหาของท่าน<font color="red"> *กรุณาบอกสถานที่พบด้วย*</font></label>

              <div class="col-md-8">
                <textarea class="form-control input-sm" id="MessageText" rows="10" name="MessageText" placeholder="โปรดป้อนอธิบายปัญหา กรุณาบอกสถานที่พบด้วย" type="text"></textarea>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-8">
              <label class="col-md-12 control-label" for="filAlbumShot">อัพโหลดรูป<font color='red'> *ไฟล์ .jpg .png .jpeg </font></label>
              <div class="col-md-8">
                <input type="file" name="filAlbumShot" class="form-control input-sm"><br>
              </div>
            </div>
          </div>
          <input name="ACCOUNT_USERNAME" value="<?php echo $username; ?>" type="hidden" id="ACCOUNT_USERNAME" />
          <input name="IDNO" value="<?php echo $id; ?>" type="hidden" id="IDNO" />
          <input name="Email" value="<?php echo $email; ?>" type="hidden" id="Email" />
          <input name="Mstatus" value="รอตรวจสอบ" type="hidden" id="Mstatus" />
          <input name="date_no" value="<?php echo date('Y-m-d'); ?>" type="hidden" id="date_no" />

          <div class="form-group">
            <div class="col-md-8">
              <label class="col-md-4 control-label" for="idno"></label>

              <div class="col-md-8">
                <button class="btn btn-primary btn-sm" name="btnSubmitadmin" value="Submit" type="submit"><span class="fa fa-send fw-fa"></span> ส่ง</button>
              </div>
            </div>
          </div>
        </form>
        <div class="form-group">
          <div class="col-md-8">
            <label class="col-md-4 control-label" for="idno"></label>

            <div class="col-md-8">

              <!-- <a href="index.php" class="btn btn-info"><span class="fa fa-arrow-circle-left fw-fa"></span></span>&nbsp;<strong>List of Users</strong></a> -->
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--/tab-content-->
  </div>
  </div>
  <!---End of container-->
<?php } ?>