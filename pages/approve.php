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
$res = $db_con->query('SELECT * FROM employee WHERE staff_level IS NULL ');
include_once '../config/thai_date.php';
if ($res->num_rows > 0) {
    echo '<div class="card mb-md-5">
    <h1 class="text-center hide">หน้า | </h1>
   
    <div class="card-header alert-success text-black"> <h1 class="text-md text-center">อนุมัติการสมัคร</h1></div>

    <label for=""><font class="text-sm"> ค้นหา</font> <input  class="form-control"id="myInput" type="text" placeholder="ค้นหาข้อมูล รหัส, ชื่อผู้ใช้, ชื่อ-นามสกุล"></label>

        <table class="table table-bordered table-responsive-sm w-100" id="myTable">

            <thead >
                <th width="15%"> รหัส</th>
                <th width="20%">ชื่อผู้ใช้</th>
                <th width="30%">ชื่อ-นามสกุล</th>
                <th width="15%">วันที่สมัคร</th>
                <th colspan="2">การดําเนินการ</th>
            </thead>';

    while ($row = $res->fetch_object()) {

        $start = thai11($row->date_registered);
        
        $student = <<<STAFF
                <tr>

                    <td>$row->staff_id</td>
                    <td>$row->username</td>
                    <td>
                        $row->fname $row->lname
                    </td>
                
                     <td>$start</td>
                   
                    
                    <td><form action="process.php" method="post">
                        <input name="staff_id" value="$row->staff_id" type="hidden">
                        <input type="hidden" name="id" value="$row->id">
                        <button class="btn success-btn" name='approve'>อนุมัติ</button>
                        </form>
                    </td>
                    <td><form action="process.php" method="post">
                    <input name="staff_id" value="$row->staff_id" type="hidden">
                    <input type="hidden" name="id" value="$row->id">
                    <button class="btn danger-btn" name='noapprove'>ไม่อนุมัติ</button>
                    </form>
                </td>
                    
                   
                </tr>
STAFF;

        echo $student;
    }

    echo '</table></div>';
} else {
    echo '<div class="mt-4">
        <h1 class="text-md text-center">ไม่มีอะไรข้อมูลให้แสดง</h1></div>';
}