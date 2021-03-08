<?php

$result = $db_con->query("SELECT * FROM recommended_leaves WHERE
        status IS NULL");

echo '<div class="card mb-md-5">
    <h1 class="text-md text-center">รอดำเนินการ</h1>
        <table class="table table-bordered table-responsive-sm w-100">

            <thead >
                <th>ID</th>
                <th>ประเภท</th>
                <th> ID พนักงาน</th>
                <th>แนะนำโดย</th>
                <th>เหตุผล</th>
                <th>รวมวัน</th>
                <th>ที่</th>
                <th colspan="3">การดําเนินการ</th>
            </thead>';

if ($result->num_rows > 0) {
    while ($row = $result->fetch_object()) {
        $reason = substr($row->why_recommend, 0, 45);

        if ($row->leave_type == 'short_embark_disembark') {
            $type = 'Short Embarkation/Disembarkation Leave';
        } elseif ($row->leave_type == 'long_embark_disembark') {
            $type = 'Long Embarkation/Disembarkation Leave';
        } else {
            $type = ucfirst($row->leave_type);
        }

        $rows = query_db("SELECT fname,email FROM employee WHERE
            staff_id = $row->staff_id");

        $student = <<<STAFF
                <tr>

                    <td>$row->leave_id</td>

                    <td>$type</td>

                    <td>$row->staff_id</td>

                    <td>
                        $row->recommended_by
                    </td>

                    <td>
                        <button type="button" class="btn info-btn" data-toggle="modal" data-target="#reason-$row->leave_id">
                        <i class="fa fa-eye"></i>ดู
                        </button>
                        <div class="modal" id="reason-$row->leave_id" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title">เหตุผลที่แนะนำ</h5>
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
                        $row->num_days
                    </td>
                    <td>
                        $row->date_recommended
                    </td>
                    <td><form action="process.php" method="post">
                        <input name="leave_id" value="$row->leave_id" type="hidden">
                        <input type="hidden" name="staff_id" value="$row->staff_id">
                        <input type="hidden" name="email" value="$rows->email">
                        <input type="hidden" name="firstname" value="$rows->fname">
                        <input name="leave_type" value="$row->leave_type" type="hidden">
                        <input type="hidden" name="num_days" value="$row->num_days">
                        <button class="btn success-btn" name='accept'>ยอมรับ</button>
                        </form>
                    </td>
                    <td>
                        <form action='process.php' method='post'>
                            <input name="leave_id" value="$row->leave_id" type="hidden">
                            <input type="hidden" name="staff_id" value="$row->staff_id">
                            <input type="hidden" name="email" value="$rows->email">
                            <input type="hidden" name="firstname" value="$rows->fname">
                            <input name="leave_type" value="$row->leave_type" type="hidden">
                            <button name='reject' class='btn btn-danger btn-sm'>
                            Reject</button><br>
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