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
<?php
$result = $db_con->query("SELECT * FROM recommended_booking WHERE
        status IS NULL");

echo '<div class="card mb-md-5">
<h1 class="text-center hide">หน้า | </h1>
    <h1 class="text-md text-center">ข้อมูลสำรอง</h1>

    <input  class="form-control"id="myInput" type="text" placeholder="ค้นหา.."><br>


        <table class="table table-bordered table-responsive-sm w-100" id="myTable">

            <thead >
                <th>รหัส</th>
                <th>ประเภท</th>
                <th>รหัสผู้ร้องขอ</th>
                <th>ชื่อผู้ใช้</th>
                <th>เหตุผล</th>
                
                <th>วันที่</th>
                <th colspan="3">การดําเนินการ</th>
            </thead>';

if ($result->num_rows > 0) {
    while ($row = $result->fetch_object()) {
        $reason = substr($row->why_recommend, 0, 45);


            $type = ucfirst($row->booking_type);
        

        $rows = query_db("SELECT fname,email FROM employee WHERE
            staff_id = $row->staff_id");

        $student = <<<STAFF
                <tr>

                    <td>$row->booking_id</td>

                    <td>$type</td>

                    <td>$row->staff_id</td>

                    <td>
                        $row->recommended_by
                    </td>

                    <td>
                        <button type="button" class="btn info-btn" data-toggle="modal" data-target="#reason-$row->booking_id">
                        <i class="fa fa-eye"></i>ดู
                        </button>
                        <div class="modal" id="reason-$row->booking_id" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title">เหตุผล?</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <p>$row->why_recommend</p>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">ปิด</button>
                                </div>
                              </div>
                            </div>
                        </div>
                    </td>

              
                    <td>
                        $row->date_recommended
                    </td>
                    <td><form action="process.php" method="post">
                        <input name="ide" value="$row->id" type="hidden">
                        <input name="booking_id" value="$row->booking_id" type="hidden">
                        <input type="hidden" name="staff_id" value="$row->staff_id">
                        <input type="hidden" name="email" value="$rows->email">
                        <input type="hidden" name="firstname" value="$rows->fname">
                        <input name="booking_type" value="$row->booking_type" type="hidden">
                        <input type="hidden" name="num_days" value="$row->num_days">
                        <button class="btn success-btn" name='accept'>ยอมรับ</button>
                        </form>
                    </td>
                    <td>
                        <form action='process.php' method='post'>
                        <input name="ide" value="$row->id" type="hidden">
                            <input name="booking_id" value="$row->booking_id" type="hidden">
                            <input type="hidden" name="staff_id" value="$row->staff_id">
                            <input type="hidden" name="email" value="$rows->email">
                            <input type="hidden" name="firstname" value="$rows->fname">
                            <input name="booking_type" value="$row->booking_type" type="hidden">
                            <button name='reject' class='btn btn-danger btn-sm'>
                            ยกเลิก</button><br>
                        </form>
                    </td>
                </tr>
STAFF;

        echo $student;
    }

    echo '</table></div>';
} else {
    echo '<tr><td class="text-center mb-m-2">ไม่มีข้อมูลการจอง</td></tr>' .
        '</table></div>';
}