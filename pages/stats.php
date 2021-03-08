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

$result = $db_con->query(
    "SELECT * FROM booking_applications WHERE staff_id = $id"
);

echo '<div class="card mb-md-5">
        <h1 class="text-center mb-4 text-md">รายการร้องขอ </h1>
        <input  class="form-control"id="myInput" type="text" placeholder="ค้นหา.."><br>
            <table class="table table-bordered table-responsive-sm w-100" id="myTable">

            <thead >
                <th>ลำดับ</th>
                <th> ประเภท</th>
                <th>สถานะ</th>
                <th>วันที่ร้องขอ</th>
            </thead>';

if ($result->num_rows > 0) {
    while ($row = $result->fetch_object()) {
        if ($row->action == 'accept') {
            $status =
                "<button class='btn success-btn'>" .
                "<i class='fa fa-check pr-2'></i> อนุมัติ</button>";
        } elseif ($row->action == 'reject') {
            $status =
                "<button class='btn danger-btn'>" .
                "<i class='fa fa-remove pr-2'></i> ไม่อนุมัติ</button>";
        } else {
            $status =
                "<button class='btn pending-btn'>" .
                "<i class='fa fa-refresh pr-2'></i> รออนุมัติ</button>";
        }


            $type = ucfirst($row->booking_type) . ' ';
        

        $student = <<<STAFF
                <tr>

                    <td>$row->id</td>

                    <td>$type</td>

                    <td>
                        $status
                     </td>
                    <td>
                        $row->date_requested
                    </td>
                </tr>
STAFF;

        echo $student;
    }
} else {
    echo '<tr><td class="text-center mb-m-2">No booking data available</td></tr>';
}

echo '</table></div>';

$res = $db_con->query(
    "SELECT * FROM booking "
);

$rows = $res->num_rows;

if ($rows > 0) {
    $st = $db_con->query("SELECT * FROM booking_applications WHERE staff_id = '$staff_id'
        AND action = 'accept'");

    $rws = $st->num_rows;
    $r = $st->fetch_object();

    echo '<div class="card mb-md-5 mt-5">
        <h2 class="text-center text-md">ห้อง/โต๊ะที่จองได้</h2>
        <table class="table table-bordered table-responsive-sm w-100">
        <thead >
            <th> รหัส</th>
            <th>ชื่อห้อง/โต๊ะ</th>
            <th>เลขห้อง/โต๊ะ</th>
            <th>ประเภท</th>
            <th></th>
        </thead>';

    while ($row = $res->fetch_object()) {
        if ($row->id >= '1') {
            if ($rws > 0) {
                $ltype = $r->booking_type;
            } else {
                $ltype = '';
            }

            if ($row->booking_type == $ltype) {
                $days = $row->current_days - $rws;
            } else {
                $days = $row->current_days;
            }

            if ($row->allowed_days == 0) {
                $allowed = 'Indefinite';
            } else {
                $allowed = $row->allowed_days;
            }


                $type = $row->booking_type;

            echo "<tr><td>$row->booking_id</td>
            
                <td>" .
                ucfirst($type) .
                "</td>
                    
                <td>$row->Room_number</td>
                
                <td>$row->Room_type</td>
                    
              <td>$row->allowed_monthly_days</td></tr>";
        }
    }
    echo '</table></div>';
}