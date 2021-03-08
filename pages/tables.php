<?php
// require '../config/mysql.php';
// require '../config/connect.php';
require '../config/thai_date.php'; ?>
<h1 class='text-center hide'>หน้าหลัก | ตารางผู้มาใช้บริการ </h1>

<div class="row">
    <div class="col-lg-12">
        <h4 class="alert alert-success" class="page-header alert btn-info"><i class="fa fa-table"></i>
            ตารางผู้มาใช้บริการ</h4>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">


            <?php
            include 'db_connect.php'; // เรียกใช้งานไฟล์เชื่อมต่อกับฐานข้อมูล
            $mysqli = connect(); // เชื่อมต่อกับฐานข้อมูล
            $sql =
                'SELECT * FROM booking_applications ORDER BY id DESC LIMIT 120';
            $result = $mysqli->query($sql);
            ?>


            <div class="dataTable_wrapper">

                <table class="table table-bordered table-responsive-sm w-100" id="dataTables-example">
                    <thead class='extra-sm'>
                        <tr>
                            <th class="extra-sm" width="5%">ลำดับ</th>
                            <th class="extra-sm" width="15%">เริ่ม</th>
                            <th class="extra-sm" width="15%">สิ้นสุด</th>
                            <!-- <th class="extra-sm"width="30%">จุดประสงค์การเข้าใช้งาน</th> -->
                            <th class="extra-sm" width="15%">วันเวลาที่ร้องขอ</th>
                            <th class="extra-sm" width="35%">ประเภท</th>
                            <th class="extra-sm" width="15%">สถานะ</th>
                        </tr>
                    </thead>
                    <tbody id="myTable" class='extra-sm'>
                        <?php while (
                            $rs = $result->fetch_object()
                        ) {

                            if ($rs->action == 'accept') {
                                $status =
                                    "<div  class='alert alert-success' role='alert'>" .
                                    "<i class='fa fa-check pr-2'class='extra-sm'></i> อนุมัติ </div>";
                            } elseif ($rs->action == 'reject') {
                                $status =
                                    "<div class='alert alert-danger' role='alert'>" .
                                    "<i class='fa fa-remove pr-2'></i> ไม่อนุมัติ</div>";
                            } else {
                                $status =
                                    "<div class='alert alert-warning' role='alert'>" .
                                    "<i class='fa fa-refresh pr-2'></i>  รออนุมัติ</div>";
                            }

                            if ($rs->status == 'accept') {
                                $status2 =
                                    "<div class='alert alert-success' role='alert'>" .
                                    "<i class='fa fa-check pr-2'></i> เข้าใช้งานแล้ว </div>";
                            } elseif ($rs->status == 'reject') {
                                $status2 =
                                    "<div class='alert alert-danger' role='alert'>" .
                                    "<i class='fa fa-remove pr-2'></i> อนุมัติ / ยกเลิก</div>";
                            } elseif ($rs->status == 'Suspend') {
                                $status2 =
                                    "<div class='alert alert-danger' role='alert'>" .
                                    "<i class='fa fa-remove pr-2'></i> อนุมัติ / ยกเลิก</div>";
                            } else {
                                $status2 =
                                    "<div class='alert alert-primary' role='alert'>" .
                                    "<i class='fa fa-refresh pr-2'></i>  อนุมัติ / รอใช้</div>";
                            }
                        ?>

                        <tr class="extra-sm">
                            <td class="extra-sm"><?php echo $rs->id; ?> </td>
                            <td class="extra-sm"><?php echo thai8(
                                                            $rs->booking_start_date
                                                        ); ?></td>
                            <td class="extra-sm"><?php echo thai8(
                                                            $rs->booking_end_date
                                                        ); ?></td>
                            <td class="extra-sm" class="center"><?php echo thai8(
                                                                        $rs->date_requested
                                                                    ); ?></td>
                            <td class="extra-sm" class="center"><?php echo $rs->booking_type; ?></td>
                            <td class="extra-sm" class="center"><?php if (
                                                                        $rs->action == 'accept'
                                                                    ) {
                                                                        echo $status2;
                                                                    } else {
                                                                        echo $status;
                                                                    } ?></td>

                        </tr>
                        <?php
                        } ?>



                    </tbody>
                </table>

            </div>
            <!-- /.table-responsive -->

            <!-- /.panel .chat-panel -->
        </div>
    </div>