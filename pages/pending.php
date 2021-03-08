<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="/lib/bootstrap.min.css">
<script src="/lib/jquery-1.12.2.min.js"></script>
<script src="/lib/bootstrap.min.js"></script>
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
<?php if (isset($_SESSION['staff-user']) && $_SESSION['staff-user'] !== '') { ?>
<?php if ($level == 'supervisor') { ?>

<?php
    $result = $db_con->query("SELECT * FROM booking_applications WHERE 
        action IS NULL");
    include_once '../config/thai_date.php';
    echo '<div class="card mb-md-5">
<h1 class="text-center hide">หน้า | </h1>
<div class="card-header alert-success text-black">
    <h1 class="text-md text-center">อนุมัติรายการจอง</h1>
    </div>
   
    <label for=""><font class="text-sm"> ค้นหา</font>
    <input  class="form-control"id="myInput" type="text" placeholder="ค้นหาข้อมูล ลำดับ, ประเภท, รหัสผู้ใช้"></label><br>
        <table class="table table-bordered table-responsive-sm w-100"id="myTable">

             <thead  >
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


        $type = ucfirst($row->booking_type) . ' จอง';


        $id = $row->id;
        $staf_id = $row->staff_id;
        $booking_type = $row->booking_type;
        $booking_id = $row->booking_id;
        global $id;
        global $staf_id;
        global $booking_id;
        global $booking_type;

        $start = thai8($row->booking_start_date);

        $end = thai8($row->booking_end_date);

        $date_re = thai8($row->date_requested);

        $num_days = intval($end) - intval($start);

        $rows = query_db("SELECT fname,email FROM employee WHERE 
            staff_id = $row->staff_id");

        $student = <<<STAFF
                <tr id="myTable">

                    <td class="extra-sm">$row->id</td>
                    <td  class="extra-sm">$type</td>
                    <td class="extra-sm">
                        $row->staff_id
                    </td>
                
                     <td class="extra-sm">$start</td>
                   
                    <td class="extra-sm">
                        $end
                    </td>
                    <td class="extra-sm">
                        $date_re
                    </td>
                    <td class="extra-sm">
                    
                                <form action="recommend.php" method="post">
                                     <input name="ide" value="$row->id" type="hidden">
                                    <input name="booking_id" value="$row->booking_id" type="hidden">
                                    <input type="hidden" name="staff_id" value="$row->staff_id">
                                    <input type="hidden" name="recommended_by" value="$username">
                                    <input name="booking_type" value="$row->booking_type" type="hidden">

                                    <input type="hidden" name="email" value="$rows->email">
                                    <input type="hidden" name="firstname" value="$rows->fname">
                                    <input type="hidden" name="num_days" value="$num_days">
                                   
                                    <button class="btn btn-success" name='accept'>
                                    อนุมัติ
                                    </button>
                                </form>
                           
                    </td>
                    <td><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#reject-$row->id">
                    ไม่อนุมัติ
                        </button>
                        
                        <div class="modal" id="reject-$row->id" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" class="extra-sm">เหตุผล</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                    <form action='recommend.php' method='post'>
                                    <label for='notif'>มีเหตุผลใดที่ไม่อนุมัติการจองนี้หรือไม่? ใส่ที่ด้านล่างนี่</label>
                           
                                      <input name="ide" value="$row->id" type="hidden">
                                    <input type="hidden" name="email" value="$rows->email">
                                    <input type="hidden" name="firstname" value="$rows->fname">
                                    <input name="booking_id" value="$row->booking_id" type="hidden">
                                    <input type="hidden" name="staff_id" value="$row->staff_id">
                                    <input name="booking_type" value="$row->booking_type" type="hidden">
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
STAFF;

        echo $student;
      }
      echo '</table></div>';

      echo '';
    } else {
      echo '<tr><td class="text-center mb-m-2">ไม่มีข้อมูล</td></tr>' .
        '</table></div>';
    }
    ?>
<?php } elseif ($level == 'non-supervisor') { ?>

<td class="text-center mb-m-2">ไม่มีสิทธิ์</td>

<?php
    echo "<script type='text/javascript'>";
    echo "alert('เกิดข้อผิดพลาด ไม่มีสิทธิ์   !!');";
    echo 'window.history.back(1);';
    echo '</script>';
    ?>
<?php } elseif ($level == '') { ?>

<td class="text-center mb-m-2">ไม่มีสิทธิ์</td>

<?php
    echo "<script type='text/javascript'>";
    echo "alert('เกิดข้อผิดพลาด ท่านไม่มีสิทธิ์   !!');";
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
<?php
  $result = $db_con->query("SELECT * FROM booking_applications WHERE 
        action IS NULL");
  include_once '../config/thai_date.php';
  echo '<div class="card mb-md-5">
<h1 class="text-center hide">หน้า | </h1>
    <h1 class="text-md text-center">ยืนยันรายการจอง</h1>
    <input  class="form-control"id="myInput" type="text" placeholder="ค้นหา.."><br>


        <table class="table table-bordered table-responsive-sm w-100" >

             <thead id="myTable">
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

      $type = ucfirst($row->booking_type) . ' ';

      $id = $row->id;
      $staf_id = $row->staff_id;
      $booking_type = $row->booking_type;
      $booking_id = $row->booking_id;
      global $id;
      global $staf_id;
      global $booking_id;
      global $booking_type;
      $start = thai8($row->booking_start_date);

      $end = thai8($row->booking_end_date);

      $date_re = thai8($row->date_requested);

      $num_days = intval($end) - intval($start);
      $rows = query_db("SELECT fname,email FROM employee WHERE 
            staff_id = $row->staff_id");
      $student = <<<STAFF
                <tr id="myTable">

                    <td class="extra-sm">$row->id</td>
                    <td  class="extra-sm">$type</td>
                    <td class="extra-sm">
                        $row->staff_id
                    </td>
                
                     <td class="extra-sm">$start</td>
                   
                    <td class="extra-sm">
                        $end
                    </td>
                    <td class="extra-sm">
                        $date_re
                    </td>
                    <td class="extra-sm">
                    <button type="button" class="btn success-btn" class="extra-sm" data-toggle="modal" data-target="#rec2-$row->booking_id">
                        อนุมัติ
                    </button>
                    <div class="modal" id="rec2-$row->booking_id" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title">เหตุผลใด?</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                                <form action="recommend.php" method="post">
                                     <input name="ide" value="$row->id" type="hidden">
                                    <input name="booking_id" value="$row->booking_id" type="hidden">
                                    <input type="hidden" name="staff_id" value="$row->staff_id">
                                    <input type="hidden" name="recommended_by" value="$username">
                                    <input name="booking_type" value="$row->booking_type" type="hidden">

                                    <input type="hidden" name="email" value="$rows->email">
                                    <input type="hidden" name="firstname" value="$rows->fname">
                                    <input type="hidden" name="num_days" value="$num_days">
                                    <label>ให้เหตุผลที่นี่</label><br>
                                    <textarea name="why_recommend" class="form-control"></textarea><hr>
                                    <button class="btn btn-success" name='accept2'>
                                        ยืนยัน
                                    </button>
                                </form>
                            </div>
                           </div>
                          </div>
                         </div>
                    </td>
                    <td><button type="button" class="btn danger-btn" data-toggle="modal" data-target="#reject2-$row->id">
                    ไม่อนุมัติ
                        </button>
                        
                        <div class="modal" id="reject2-$row->id" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" class="extra-sm">เหตุผล</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                    <form action='recommend.php' method='post'>
                                    <label for='notif'>มีเหตุผลใดที่ไม่อนุมัติการจองนี้หรือไม่? ใส่ที่ด้านล่างนี่</label>
                                  
                                    
                                      <input name="ide" value="$row->id" type="hidden">
                                    <input type="hidden" name="email" value="$rows->email">
                                    <input type="hidden" name="firstname" value="$rows->fname">
                                    <input name="booking_id" value="$row->booking_id" type="hidden">
                                    <input type="hidden" name="staff_id" value="$row->staff_id">
                                    <input name="booking_type" value="$row->booking_type" type="hidden">
                                    <textarea name='reason' class='form-control' id='notif'></textarea><br>

                                    <button name='reject2' class='btn btn-danger btn-sm'>
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
STAFF;
      echo $student;
    }
    echo '</table></div>';
    echo '';
  } else {
    echo '<tr><td class="text-center mb-m-2">ไม่มีข้อมูล</td></tr>' .
      '</table></div>';
  }
  ?>
<?php } ?>