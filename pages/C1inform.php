<?php if (isset($_SESSION['admin-user']) && $_SESSION['admin-user'] !== '') { ?>
<h1 class='text-center hide'>หน้า | จัดการข้อมูลการตัดสิทธิ์ </h1>
<div class="row">
    <div class="col-lg-12">
        <h3 class="alert alert-success" class="page-header alert btn-info"><i class="fa fa-key"></i>
            จัดการข้อมูลการตัดสิทธิ์</h3>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="table-responsive">
    <ul class="nav nav-pills" id="myTab">
        <li class="nav-item"><a class="nav-link active" href="#inbox" data-toggle="tab">ตัดสิทธิ์</a></li>
        <!-- <li  ><a href="#sent" data-toggle="tab">Sent Messages</a></li>  -->
        <li class="nav-item"><a class="nav-link" href="#create" data-toggle="tab">คืนสิทธิ์</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="inbox">
            <div class="col-lg-12">

                <br />

                <?php
                    require '../config/thai_date.php';
                    include 'db_connect.php'; // เรียกใช้งานไฟล์เชื่อมต่อกับฐานข้อมูล
                    $mysqli = connect(); // เชื่อมต่อกับฐานข้อมูล
                    $sql = 'SELECT * FROM employee ORDER BY id DESC ';
                    $result = $mysqli->query($sql);
                    ?>
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
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                <script>
                $(document).ready(function() {
                    $("#myInput1").on("keyup", function() {
                        var value = $(this).val().toLowerCase();
                        $("#myTable1 tr").filter(function() {
                            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                        });
                    });
                });
                </script>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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

                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <div> <span class="extra-sm"> </span>
                            <?php
                                //include("db_connect.php"); // เรียกใช้งานไฟล์เชื่อมต่อกับฐานข้อมูล
                                $db_con = connect(); // เชื่อมต่อกับฐานข้อมูล
                                $no = 0;
                                $data = [];
                                $arr = []; //booking_applications
                                $sql = "SELECT employee.staff_id, booking_applications.*
               FROM `booking_applications`
               INNER JOIN `employee` ON booking_applications.staff_id = employee.staff_id";
                                $qry = mysqli_query($db_con, $sql);
                                //while($row = mysql_fetch_assoc($qry)){  //-- วนลูปแสดงข้อมูลทั้งหมด
                                while ($row = mysqli_fetch_array($qry)) {
                                    if ($row['status'] == 'reject') {
                                        $active_qty = 0;
                                        $expire_qty = 0;
                                        //-- วันที่มากกว่าหรือเท่ากับวันนี้=ใช้งานปกติ, ถ้าน้อยกว่า=หมดอายุ
                                        if (
                                            $row['date_requested'] >=
                                            date('Y-m-d H:i:s')
                                        ) {
                                            $active_qty = 1;
                                        } else {
                                            $expire_qty = 1;
                                        }
                                        //-- ตรวจสอบค่าเดิมของสาขานั้นๆ ถ้ามีให้เพิ่มเข้าไปด้วย
                                        if (
                                            isset(
                                                $arr[$row['staff_id']]['active']
                                            )
                                        ) {
                                            $active_qty +=
                                                $arr[$row['staff_id']][
                                                    'active'
                                                ];
                                        }
                                        if (
                                            isset(
                                                $arr[$row['staff_id']]['expire']
                                            )
                                        ) {
                                            $expire_qty +=
                                                $arr[$row['staff_id']][
                                                    'expire'
                                                ];
                                        }
                                        //-- เก็บข้อมูลไว้ในอาร์เรย์
                                        $arr[$row['staff_id']]['name'] =
                                            $row['staff_id'];
                                        $arr[$row['staff_id']][
                                            'expire'
                                        ] = $expire_qty;
                                    }
                                }

                                if (!empty($arr)) {
                                    //-- ถ้ามีข้อมูลให้วนลูปแสดงข้อมูลทั้งหมด

                                    echo '  <br><h5 class="extra-sm"> ตารางรายชื่อผิดนัด   </h5> <br>
           <div class="col-lg-4">
           <input  class="form-control"id="myInput1" type="text" placeholder="ค้นหาข้อมูล รหัสสมาชิก, ผิดนัด(ครั้ง)"><br>
           </div>

           <table class="table table-bordered table-responsive-sm w-100" id="myTable1">
           <thead class="extra-sm">
           <tr>

               <th width="10%" >รหัสสมาชิก</th>
               <th width="11%">ผิดนัด(ครั้ง)</th>
 

           </tr>
       </thead>';
                                    foreach ($arr as $k => $v) {
                                        echo '<tr>';
                                        foreach ($v as $k2 => $v2) {
                                            $value = $arr[$k][$k2];
                                            echo '<td>' . $value . '</td>';
                                        }
                                        echo '</tr>';
                                    }
                                    echo '</table>';
                                }
                                ?>
                        </div>
                        <br>
                        <h5 class="extra-sm"> ตารางรายชื่อสมาชิกทั้งหมด </h5> <br>
                        <div class="col-lg-4">
                            <input class="form-control" id="myInput" type="text" placeholder="ค้นหาข้อมูลในตาราง"><br>
                        </div>

                        <table class="table table-bordered table-responsive-sm w-100" id="myTable">
                            <thead class='extra-sm'>
                                <tr>
                                    <th width="5%">ลำดับ</th>
                                    <th width="15%">รหัสสมาชิก</th>
                                    <th width="25%">ชื่อผู้ใช้</th>
                                    <th width="25%">ชื่อ-นามสกุล</th>


                                    <th width="10%">สถานะ</th>
                                    <th width="10%">จำนวนถูกระงับ</th>
                                    <th width="10%">ตัดสิทธิ์</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while (
                                        $rs = $result->fetch_object()
                                    ) {
                                        if (
                                            $rs->staff_level != '' &&
                                            $rs->staff_level != 'non'
                                        ) { ?>
                                <tr>
                                    <td><?php echo $rs->id; ?> </td>
                                    <td><?php echo $rs->staff_id; ?></td>
                                    <td><?php echo $rs->username; ?></td>
                                    <td><?php echo $rs->fname; ?>&nbsp;<?php echo $rs->lname; ?></td>

                                    <td class="center"><?php
                                                if (
                                                    $rs->staff_level == 'admin'
                                                ) {
                                                    echo 'แอดมิน';
                                                }
                                                if (
                                                    $rs->staff_level ==
                                                    'non-supervisor'
                                                ) {
                                                    echo 'สมาชิก';
                                                }
                                                if (
                                                    $rs->staff_level ==
                                                    'supervisor'
                                                ) {
                                                    echo 'เจ้าหน้าที่';
                                                }
                                                ?></td>

                                    <td class="center"><?php
                                                if ($rs->total_reject == '0') {
                                                    echo "<font color='green'> $rs->total_reject </font>";
                                                }
                                                if ($rs->total_reject >= '1') {
                                                    echo "<font color='red'> $rs->total_reject </font>";
                                                }
                                                ?>
                                    </td>
                                    <td class="center"><?php if (
                                                    $rs->staff_level ==
                                                    'supervisor'
                                                ) { ?>
                                        <form method="post" action="../pages/admin.php?tab=26">
                                            <input type='hidden' name='staff_id' value='<?php echo $rs->staff_id; ?>'>

                                            <button class='btn danger-btn' title="Edit" name="admin" type="submit"
                                                onclick="return confirm('คุณต้องการตัดสิทธิ์ที่เลือกใช่หรือไม')"><i
                                                    class='fa fa-remove pr-2'></i> ตัดสิทธิ์ </button>
                                        </form>
                                        <?php } elseif (
                                                    $rs->staff_level ==
                                                    'non-supervisor'
                                                ) { ?>
                                        <form method="post" action="../pages/admin.php?tab=26">
                                            <input type='hidden' name='staff_id' value='<?php echo $rs->staff_id; ?>'>

                                            <button class='btn danger-btn' title="Edit" name="admin" type="submit"
                                                onclick="return confirm('คุณต้องการตัดสิทธิ์ที่เลือกใช่หรือไม')"><i
                                                    class='fa fa-remove pr-2'></i> ตัดสิทธิ์ </button>
                                        </form>

                                        <?php } else { ?>
                                        <form method="post" action="../pages/admin.php?tab=26">
                                            <input type='hidden' name='staff_id' value='<?php echo $rs->staff_id; ?>'>

                                            <button class='btn danger-btn' title="Edit" name="admin" type="submit"
                                                onclick="return confirm('คุณต้องการตัดสิทธิ์ที่เลือกใช่หรือไม')"><i
                                                    class='fa fa-remove pr-2'></i> ตัดสิทธิ์ </button>
                                        </form>

                                        <?php } ?>
                                        <?php  ?>
                                    </td>

                                </tr>
                                <?php }
                                    } ?>



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
                //$mysqli = connect(); // เชื่อมต่อกับฐานข้อมูล
                $sql = 'SELECT * FROM employee ORDER BY id DESC ';
                $result = $mysqli->query($sql);
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
            <div class="panel-body">
                <div class="dataTable_wrapper">
                    <br>
                    <h5 class="extra-sm"> ตารางรายชื่อสมาชิกทั้งหมด </h5> <br>
                    <div class="col-lg-4">
                        <input class="form-control" id="myInput2" type="text"
                            placeholder="ค้นหาข้อมูลลำดับ	รหัสสมาชิก, ชื่อผู้ใช้, ชื่อ-นามสกุล"><br>
                    </div>

                    <table class="table table-bordered table-responsive-sm w-100" id="myTable2">
                        <thead class='extra-sm'>
                            <tr>
                                <th width="5%">ลำดับ</th>
                                <th width="10%">รหัสสมาชิก</th>
                                <th width="10%">ชื่อผู้ใช้</th>
                                <th width="10%">ชื่อ-นามสกุล</th>

                                <th width="15%">วันเวลาเริ่ม</th>
                                <th width="15%">วันเวลาสิ้นสุด</th>

                                <th width="15%">วันครบกำหนด</th>
                                <th width="10%">จำนวนถูกระงับ</th>
                                <th width="10%">คืนสิทธิ์</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($rs = $result->fetch_object()) {
                                    if ($rs->staff_level == 'non') {
                                        if ($rs->total_reject >= '1') { ?>
                            <tr>
                                <td><?php echo $rs->id; ?> </td>
                                <td><?php echo $rs->staff_id; ?></td>
                                <td><?php echo $rs->username; ?></td>
                                <td><?php echo $rs->fname; ?>&nbsp;<?php echo $rs->lname; ?></td>

                                <td class="center"><?php echo $rs->day_reject; ?></td>
                                <td class="center"><?php echo $rs->day_rejectend; ?></td>
                                <td class="center"><?php if (
                                                    $rs->day_rejectend <=
                                                    date('d-m-Y')
                                                ) {
                                                    echo "<font color='green'> (ครบกำหนดแล้ว) </font>";
                                                } else {
                                                    echo "<font color='red'> (ยังไม่ครบกำหนด) </font>";
                                                } ?></td>
                                <td class="center"><?php echo "<font color='red'> $rs->total_reject </font>"; ?></td>
                                <td class="center"><?php?>

                                    <a class='btn pending-btn'
                                        href='reinstate_db.php?staff_id=<?php echo $rs->staff_id; ?>'>
                                        <i class='fa fa-check pr-2'></i> คืนสิทธิ์</a>


                                    <?php  ?>
                                </td>

                            </tr>
                            <?php }
                                    }
                                } ?>
                        </tbody>
                    </table>

                </div>
                <!-- /.table-responsive -->
            </div>
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
<?php }else{?>

<h6>คุณไม่มีสิทธิ์เข้าถึงข้อมูลนี้</h6>

<?php } ?>