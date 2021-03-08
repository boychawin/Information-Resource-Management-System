<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
            $(this).toggle($(this).text(ไม่ มีข้ อมูล).toLowerCase().indexOf(value) > -1)
        });
    });
});
</script>
<?php

if ($level == 'supervisor') {
  $result = $db_con->query("SELECT * FROM booking_applications WHERE 
        status IS NULL and  action = 'accept'");
} elseif ($level == 'non-supervisor') {
  $result = $db_con->query("SELECT * FROM booking_applications WHERE 
  status IS NULL and staff_id = $staff_id and action = 'accept'");
} elseif ($level == '' || $level == 'non') {
  $result = $db_con->query("SELECT * FROM booking_applications WHERE 
        status IS NULL and staff_id = $staff_id and action = 'accept'");
} else {
  $result = $db_con->query("SELECT * FROM booking_applications WHERE 
  status IS NULL and staff_id = $staff_id and action = 'accept'");
}

include_once '../config/thai_date.php';

echo '<div class="card mb-md-5">
<h1 class="text-center hide">หน้า | </h1>
<div class="card-header alert-success text-black">
    <h1 class="text-md text-center">ยืนยันเข้าใช้งาน</h1>
</div>
<label for=""><font class="text-sm"> ค้นหา</font>
    <input  class="form-control"id="myInput" type="text" placeholder="ค้นหาข้อมูล ลำดับ, รหัสผู้ใช้, ประเภท"><br>
    </label>

        <table class="table table-bordered table-responsive-sm w-100" id="myTable">

            <thead >
                <th>ลำดับ</th>
                <th>ประเภท</th>
                <th>รหัสผู้ใช้</th>
                <th>เริ่ม</th>
                <th>สิ้นสุด</th>
                <th>ร้องขอเมื่อ</th>
                <th colspan="3">การดําเนินการ</th>
            </thead>';

if ($result->num_rows > 0) {
  while ($row = $result->fetch_object()) {

    //$type = ucfirst($row->booking_type) . ' จอง';
    //$id = $row->id;
    $staf_id = $row->staff_id;
    $booking_type = $row->booking_type;
    $booking_id = $row->booking_id;
    //global $id;
    global $staf_id;
    global $booking_id;
    global $booking_type;

    $start = thai8($row->booking_start_date);

    $end = thai8($row->booking_end_date);

    $date_re = thai8($row->date_requested);

    $num_days = intval($end) - intval($start);

    $rows = query_db("SELECT fname,email FROM employee WHERE 
            staff_id = $row->staff_id");

if ($row->booking_end_date >= date('Y-m-d H:i:s') || $level == 'supervisor') {
?>
<tr>

    <td class="extra-sm"><?php echo $row->id; ?></td>
    <td class="extra-sm"><?php echo $row->booking_type; ?></td>
    <td class="extra-sm">
        <?php echo $row->staff_id; ?>
    </td>

    <td class="extra-sm"><?php echo $start; ?></td>

    <td class="extra-sm">
        <?php echo  $end; ?>
    </td>
    <td class="extra-sm">
        <?php echo  $date_re; ?>
    </td>
    <?php if ($row->booking_end_date >= date('Y-m-d H:i:s')) { ?>
    <td class="extra-sm">

        <form action="recommend2.php" method="post">
            <input name="ide" value="<?php echo   $row->id; ?>" type="hidden">
            <input name="booking_id" value="<?php echo  $row->booking_id; ?>" type="hidden">
            <input type="hidden" name="staff_id" value="<?php echo  $row->staff_id; ?>">
            <input type="hidden" name="recommended_by" value="<?php echo  $username; ?>">
            <input name="booking_type" value="<?php echo  $row->booking_type; ?>" type="hidden">

            <input type="hidden" name="email" value="<?php echo  $rows->email; ?>">
            <input type="hidden" name="firstname" value="<?php echo  $rows->fname; ?>">
            <input type="hidden" name="num_days" value="<?php echo  $num_days; ?>">



            <button class="btn btn-success" name='accept'>
                ยืนยันเข้าใช้
            </button>
        </form>

    </td>
    <?php } elseif ($level == 'supervisor') { ?>
    <td class="extra-sm">
        <button type="button" class="btn success-btn" class="extra-sm" data-toggle="modal" data-target="#rec-$row->id">
            ยืนยันเข้าใช้งาน
        </button>
        <div class="modal" id="rec-$row->id" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">เหตุผล?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="recommend2.php" method="post">
                            <input name="ide" value="<?php echo  $row->id; ?>" type="hidden">
                            <input name="booking_id" value="<?php echo  $row->booking_id; ?>" type="hidden">
                            <input type="hidden" name="staff_id" value="<?php echo  $row->staff_id; ?>">
                            <input type="hidden" name="recommended_by" value="<?php echo  $username; ?>">
                            <input name="booking_type" value="<?php echo  $row->booking_type; ?>" type="hidden">

                            <input type="hidden" name="email" value="<?php echo  $rows->email; ?>">
                            <input type="hidden" name="firstname" value="<?php echo  $rows->fname; ?>">
                            <input type="hidden" name="num_days" value="<?php echo  $num_days; ?>">
                            <label>ให้เหตุผลที่นี่</label><br>
                            <textarea name="why_recommend" class="form-control"
                                placeholder="ใส่หรือไม่ก็ได้ "></textarea>
                            <hr>
                            <button class="btn btn-success" name='accept'>
                                ยืนยัน
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </td>



    <?php if ($row->booking_end_date <= date('Y-m-d H:i:s')) { ?>
    <td class="text-center">
        <font color='red'>หมดเวลา</font>
    </td>
    <?php } ?>
    <td><button type="button" class="btn danger-btn" data-toggle="modal" data-target="#reject-$row->id">
            ยกเลิกการจอง
        </button>

        <div class="modal" id="reject-$row->id" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" class="extra-sm">เหตุผล?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action='recommend2.php' method='post'>
                            <label for='notif'>เหตุผลในการปฏิเสธ</label>
                            <hr class='divider'>
                            <small>มีเหตุผลใดที่ปฏิเสธการจองนี้หรือไม่? ใส่มัน
                                ที่นี่</small>
                            <input name="ide" value="<?php echo   $row->id; ?>" type="hidden">
                            <input type="hidden" name="email" value="<?php echo  $rows->email; ?>">
                            <input type="hidden" name="firstname" value="<?php echo  $rows->fname; ?>">
                            <input name="booking_id" value="<?php echo  $row->booking_id; ?>" type="hidden">
                            <input type="hidden" name="staff_id" value="<?php echo  $row->staff_id; ?>">
                            <input name="booking_type" value="<?php echo  $row->booking_type; ?>" type="hidden">
                            <textarea name='reason' class='form-control' id='notif'></textarea><br>

                            <button name='reject' class='btn btn-danger btn-sm'>
                                ยืนยัน</button>
                        </form>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </td>
</tr>
<?php } else { ?>

<td class="text-center">
    <font color='red'> หมดเวลา</font>
</td>

<?php

      } }?>

<?php
  }

  echo '</table></div>';
  ?>

<?php
} else {
  echo '<tr><td class="text-center mb-m-2">ไม่มีข้อมูล</td></tr>' .
    '</table></div>';
}
?>
<font color='red' class='extra-sm'> ปล.ถ้าไม่กด<u><b>ปุ่มยืนยันเข้าใช้</b></u> ภายในช่วงเวลาที่จองรายการจะหาย
    สามารถติดต่อเจ้าหน้าที่ได้ตามที่อยู่ด้านล่าง </font>