<?php if (isset($_SESSION['staff-user']) && $_SESSION['staff-user'] !== '') { ?>
<?php if ($level == 'supervisor') { ?>
<td class="text-center mb-m-2">ไม่มีสิทธิ์</td>

<?php
    echo "<script type='text/javascript'>";
    echo "alert('ท่านยังไม่ได้รับสิทธิ์เข้าถึงหน้านี้   !!');";
    echo 'window.history.back(1);';
    echo '</script>';
    echo 'ท่านยังไม่ได้รับสิทธิ์เข้าถึงหน้านี้';
    ?>

<?php } elseif ($level == 'non-supervisor') { ?>
<?php
    session_start();
    $fname = $_SESSION['staff-fname'];
    $email = $_SESSION['staff-email'];
    include 'booking-types.php';
    ?>
<h1 class='text-center hide'>หน้า | แจ้ง/ร้องเรียน</h1>
<div class="row">
    <div class="col-lg-12">
        <div class="card-header alert-success">
            <h4><i class="fa fa-bullhorn"></i> แจ้ง/ร้องเรียน</h4>
        </div> &nbsp;
        <div class="row mb-2">
            <div class="col-md-6 mb-md-2">
                <form name="form1" method="post" action="user/controller.php" enctype="multipart/form-data">

                    <div class="extra-sm">
                        <div class="form-group">
                            <div class="col-md-12 ui-widget">
                                <label class="col-md-4 control-label" for="MessageCODE"><b>หัวข้อ</b>
                                    <font color='red'> * </font>
                                </label>

                                <div class="col-md-12">
                                    <input id="name" class="form-control input-sm" name="MessageCODE"
                                        placeholder="โปรดป้อนชื่อหัวข้อ " required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <label class="col-md-4 control-label" for="Category"><b>ประเภท</b>
                                    <font color='red'> * </font>
                                </label>
                                <div class="col-md-12">
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
                            <div class="col-md-12">
                                <label class="col-md-12 control-label" for="MessageText"><b>อธิบายปัญหาของท่าน</b>
                                    <font color="red"> *กรุณาระบุสถานที่ด้วย*</font>
                                </label>
                                <div class="col-md-12">
                                    <textarea class="form-control input-sm" id="MessageText" rows="10"
                                        name="MessageText" placeholder="โปรดป้อนอธิบายปัญหา และกรุณาระบุสถานที่ด้วย "
                                        type="text" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label class="col-md-12 control-label" for="filAlbumShot"><b>อัพโหลดรูป</b>
                                    <font color='red'> * ไฟล์ .jpg .png .jpeg</font>
                                </label>
                                <div class="col-md-12">
                                    <input type="file" name="filAlbumShot" class="form-control input-sm"><br>
                                </div>
                            </div>
                        </div>
                        <input name="ACCOUNT_USERNAME" value="<?php echo $username; ?>" type="hidden"
                            id="ACCOUNT_USERNAME" />
                        <input name="IDNO" value="<?php echo $id; ?>" type="hidden" id="IDNO" />
                        <input name="Email" value="<?php echo $email; ?>" type="hidden" id="Email" />
                        <input name="Mstatus" value="รอตรวจสอบ" type="hidden" id="Mstatus" />
                        <input name="date_no" value="<?php echo date('Y-m-d');?>" type="hidden" id="date_no" />

                        <div class="form-group">
                            <div class="col-md-12">
                                <label class="col-md-4 control-label" for="idno"></label>

                                <div class="col-md-12">
                                    <button class="btn btn-primary " name="btnSubmit" value="Submit" type="submit"><span
                                            class="fa fa-send fw-fa"></span> ส่ง</button>
                                </div>
                            </div>
                        </div>

                    </div>

                </form>

            </div>

            <div class="col-md-6 mb-md-2">
                <h5 class='text-left'> รายการแจ้ง/ร้องเรียน </h5>
                <?php
            $result = $db_con->query("SELECT * FROM tblmessage WHERE IDNO = '$staff_id' ORDER BY MessageID DESC LIMIT 10 ");
            ?>

                <table class="table table-bordered table-responsive-sm w-100">
                    <thead>
                        <tr>
                            <th width="5%">ลำดับ</th>
                            <th width="25%">ประเภท</th>
                            <th width="30%">อธิบายปัญหา</th>
                            <th width="15%">หัวข้อ</th>
                            <th width="20%">สถานะ</th>


                        </tr>
                    </thead>
                    <tbody id="myTable">
                        <?php while ($row = $result->fetch_object()) {
                ?>
                        <tr>
                            <td class="center"><?php echo $row->MessageID; ?> </td>
                            <td class="center"><?php echo $row->Category; ?></td>
                            <td class="center"><?php echo $row->MessageText; ?></td>
                            <td class="center"><?php echo $row->MessageCODE; ?></td>
                            <td class="center"><?php

                                        if ($row->Mstatus == 'รอตรวจสอบ') {
                                          echo "<font color='red'> $row->Mstatus </font>";
                                        } else {
                                          echo "<font color='green'> $row->Mstatus </font>";
                                        }
                                        ?>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>

            </div>
        </div>
        <font class='extra-sm' color='red'>* หมายเหตุ สำหรับประเภท<u><b>แจ้งมีคนลืมของ</b></u>
            แจ้งแล้วต้องเอาของไปฝากไว้กับเจ้าหน้าที่ </font>
        <hr>
    </div>
</div>

<?php } elseif ($level == '') { ?>

<td class="text-center mb-m-2">ไม่มีสิทธิ์</td>

<?php
    echo "<script type='text/javascript'>";
    echo "alert('ท่านยังไม่ได้รับสิทธิ์เข้าถึงหน้านี้   !!');";
    echo 'window.history.back(1);';
    echo '</script>';
    echo 'ท่านยังไม่ได้รับสิทธิ์เข้าถึงหน้านี้';
    ?>

<?php } elseif ($level == 'non') { ?>

<td class="text-center mb-m-2">ไม่มีสิทธิ์</td>

<?php
    echo "<script type='text/javascript'>";
    echo "alert('ท่านยังไม่ได้รับสิทธิ์เข้าถึงหน้านี้   !!');";
    echo 'window.history.back(1);';
    echo '</script>';
    ?>
<?php }
} ?>


<?php if (isset($_SESSION['admin-user']) && $_SESSION['admin-user'] !== '') { ?>

<td class="text-center mb-m-2">ไม่มีสิทธิ์</td>

<?php
  echo "<script type='text/javascript'>";
  echo "alert('ท่านยังไม่ได้รับสิทธิ์เข้าถึงหน้านี้   !!');";
  echo 'window.history.back(1);';
  echo '</script>';
  echo 'ท่านยังไม่ได้รับสิทธิ์เข้าถึงหน้านี้';
  ?>
<?php } ?>