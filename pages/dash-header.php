<?php
if (is_session_inplace('admin-user')) {
    $page = 'admin.php';
} elseif (is_session_inplace('supervisor-user')) {
    $page = 'dashboard.php?type=supervisor';
} elseif (is_session_inplace('staff-user')) {
    $page = 'dashboard.php';
} ?>
<div class="row mt-4">
    <div class="col-md-3 navigation bg-white">
        <h4 class="ml-3 hide-sm">
            <i class="fa fa-user"></i>
            <span class="extra-sm"><?php echo ucfirst($username); ?></span>
        </h4>

        <ul class="main-nav">

            <li class="list-main">
                <a href="<?php echo $page; ?>?tab=4">
                    <i class="fa fa-user-circle icon"></i>
                    <span class="extra-sm">บัญชีของฉัน</span>
                </a>
            </li>
            <?php if ($level == 'supervisor') { ?>
            <li class="list-main">
                <a href="dashboard.php?tab=7">
                    <i class="fa fa-recycle icon"></i>
                    <span class="extra-sm ">อนุมัติการจอง</span>
                </a>
            </li>

            <li class="list-main">
                <a href="dashboard.php?tab=14">
                    <i class="fa fa-edit icon"></i>
                    <span class="extra-sm ">ยืนยันการใช้งาน</span>
                </a>
            </li>
            <?php } ?>

            <?php if ($level == 'non-supervisor') { ?>


            <li class="list-main">
                <a href="dashboard.php?tab=14">
                    <i class="fa fa-edit icon"></i>
                    <span class="extra-sm ">ยืนยันเข้าใช้งาน</span>
                </a>
            </li>
            <?php } ?>



            <?php if (
                isset($_SESSION['staff-user']) &&
                $_SESSION['staff-user'] !== ''
            ) { ?>

            <li class="list-main">
                <a href="dashboard.php?tab=1">
                    <i class="fa fa-bell icon"></i>
                    <span class="extra-sm">สถานะการจอง</span>
                </a>
            </li>
            <?php if ($level == 'supervisor') { ?>
            <li class="list-main">
                <a href="dashboard.php?tab=2">
                    <i class="fa fa-edit icon"></i>
                    <span class="extra-sm">ข้อมูลการจอง</span>
                </a>
            </li>
            <?php } ?>

            <?php if ($level == 'non-supervisor') { ?>


            <li class="list-main">
                <a href="dashboard.php?tab=6">
                    <i class="fa fa-plus-circle icon"></i>
                    <span class="extra-sm">เพิ่มการจองใหม่</span>
                </a>
            </li>


            <!-- <li class="list-main">
                        <a data-toggle="collapse" href="#more" role="button" aria-controls="more">
                            <i class="fa fa-plus icon"></i>
                            <span class="extra-sm">การดําเนินการ</span>
                        </a>

                        <ul id="more" class="collapse toggle-collapse"> -->
            <!-- <li>
                        <a href="dashboard.php?tab=6">
                            <i class="fa fa-plus-circle icon"></i>
                            <span class="extra-sm ">เพิ่มการจองใหม่</span>
                        </a>
                    </li> -->

            <!-- <li>
                                <a href="dashboard.php?tab=3">
                                    <i class="fa fa-archive icon"></i>
                                    <span class="extra-sm ">รายการจอง</span>
                                </a>
                            </li>-->
            <li class="list-main">
                <a href="dashboard.php?tab=5">
                    <i class="fa fa-print icon"></i>
                    <span class="extra-sm ">รายงาน</span>
                </a>
            </li>
            <!-- </ul>
                    </li> -->

            <li class="list-main">
                <a href="dashboard.php?tab=8">
                    <i class="fa fa-edit icon"></i>
                    <span class="extra-sm ">แจ้งเจ้าหน้าที่</span>
                </a>
            </li>
            <br>
            <?php } ?>

            <?php
                if ($level == 'supervisor') { ?>


            <li class="list-main">
                <a data-toggle="collapse" href="#more" role="button" aria-controls="more">
                    <i class="fa fa-plus icon"></i>
                    <span class="extra-sm">การดําเนินการ</span>
                </a>

                <ul id="more" class="collapse toggle-collapse">

                    <li>
                        <a href="dashboard.php?tab=19">
                            <i class="fa fa-plus-circle icon"></i>
                            <span class="extra-sm ">สมัคร</span>
                        </a>
                    </li>


                    <li>
                        <a href="dashboard.php?tab=6">
                            <i class="fa fa-plus-circle icon"></i>
                            <span class="extra-sm ">เพิ่มการจองใหม่</span>
                        </a>
                    </li>

                    <li>
                        <a href="dashboard.php?tab=3">
                            <i class="fa fa-archive icon"></i>
                            <span class="extra-sm ">รายการจอง</span>
                        </a>
                    </li>
                    <li>
                        <a href="dashboard.php?tab=5">
                            <i class="fa fa-print icon"></i>
                            <span class="extra-sm ">รายงาน</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="list-main">
                <a href="dashboard.php?tab=9">
                    <i class="fa fa-key icon"></i>
                    <span class="extra-sm ">จัดการร้องเรียน</span>
                </a>
            </li>
            <li class="list-main">
                <a data-toggle="collapse" href="#more1" role="button" aria-controls="more1">
                    <i class="fa fa-plus icon"></i>
                    <span class="extra-sm">พิมพ์รายงาน</span>
                </a>

                <ul id="more1" class="collapse toggle-collapse">
                    <li>
                        <a href="dashboard.php?tab=16">
                            <i class="fa fa-print icon"></i>
                            <span class="extra-sm ">คนใช้บริการ</span>
                        </a>
                    </li>

                    <li>
                        <a href="dashboard.php?tab=17">
                            <i class="fa fa-print icon"></i>
                            <span class="extra-sm ">อุปกรณ์ชำรุด</span>
                        </a>
                    </li>
                    <li>
                        <a href="dashboard.php?tab=18">
                            <i class="fa fa-print icon"></i>
                            <span class="extra-sm ">ยกเลิกการจอง</span>
                        </a>
                    </li>
                </ul>
            </li>


            <li class="list-main">
                <a href="dashboard.php?tab=13">
                    <i class="fa fa-bar-chart icon" aria-hidden="true"></i>
                    <span class="extra-sm ">
                        แผนภาพสถิติ
                    </span>
                </a>
            </li>


            <?php }
                if ($level == '' && $total_reject == '0') {
                    echo "<h7><font color='red'>*ยังไม่ได้รับการยืนยัน กรุณายืนยันตัวตนที่อีเมลภายในวันที่สมัคร คือ " .
                        $date_registered .
                        ' เพื่อใช้งานหรือรอทางเจ้าหน้าที่อนุมัติ*</font></h7></p><br>';
                } elseif ($level == 'non' && $total_reject >= '1') {
                    echo "<h7 class='extra-sm'><font color='red'> *บัญชีท่านถูกระงับชั่วคราว เป็นเวลา 15 วัน เรื่มนับตั้งแต่วันที่  " .
                        $day_reject .
                        ' เป็นต้นไป* </font></h7></p>';
                    if ($day_rejectend <= date('d-m-Y')) {
                        echo "<h7 class='extra-sm'><font color='green'> (ครบกำหนดแล้ว) </font></h7>";
                    } else {
                        echo "<h7 class='extra-sm'><font color='red'> (ยังไม่ครบกำหนด) </font></h7>";
                    }
                    echo "<h7 class='extra-sm'><font color='red'> ปล.ถ้าหากครบวันที่กำหนดแล้วระบบยังใช้ไม่ได้ให้ติดต่อเจ้าหน้าที่ </font></h7></p>";
                } elseif ($level == '') {
                    echo "<h7 class='center'><font color='red'> ให้ติดต่อเจ้าหน้าที่ </font></h7></p>";
                }
                } elseif (
                isset($_SESSION['admin-user']) &&
                $_SESSION['admin-user'] !== ''
            ) { ?>

            <li class="list-main">
                <a href="admin.php?tab=16">
                    <i class="fa fa-recycle icon"></i>
                    <span class="extra-sm ">ยืนยันสถานะจอง</span>
                </a>
            </li>


            <!-- <li class="list-main">
                    <a href="admin.php?tab=3">
                        <i class="fa fa-refresh icon"></i>
                        <span class="extra-sm ">
                            ข้อมูลสำรอง
                        </span>
                    </a>
                </li> -->

            <li class="list-main">
                <a href="admin.php?tab=2">
                    <i class="fa fa-tasks icon"></i>
                    <span class="extra-sm ">
                        อนุมัติสมัคร
                    </span>
                </a>

            </li>

            <!-- <li class="list-main">
                <a href="admin.php?tab=1">
                <i class="fa fa-plus icon"></i>
                <span class="extra-sm ">
                เพิ่มหัวข้อในการจอง
                </span>
                </a>
            </li> -->

            <!-- <li class="list-main">
                <a href="admin.php?tab=7">
                <i class="fa fa-address-book-o icon"></i>
                <span class="extra-sm ">
                    เปลี่ยนบทบาท
                </span>
                </a>
            </li>

            <li class="list-main">
                <a href="admin.php?tab=5">
                <i class="fa fa-check icon"></i>
                <span class="extra-sm ">
                    จัดการข้อมูล
                </span>
                </a>

            </li>



            <li class="list-main">
                <a href="admin.php?tab=6">
                <i class="fa fa-briefcase icon"></i>
                <span class="extra-sm ">
                    รายละเอียดใหม่
                </span>
                </a>

            </li>
-->
            <li class="list-main">
                <a href="admin.php?tab=27">
                    <i class="fa fa-archive icon"></i>
                    <span class="extra-sm ">
                        รายการจอง
                    </span>
                </a>
            </li>

            <li class="list-main">
                <a href="admin.php?tab=9">
                    <i class="fa fa-table icon"></i>
                    <span class="extra-sm ">
                        ข้อมูลห้อง/โต๊ะ
                    </span>
                </a>
            </li>

            <li class="list-main">
                <a href="admin.php?tab=10">
                    <i class="fa fa-key icon"></i>
                    <span class="extra-sm ">
                        การร้องเรียน
                    </span>
                </a>
            </li>

            <li class="list-main">
                <a href="admin.php?tab=11">
                    <i class="fa fa-user icon"></i>
                    <span class="extra-sm">
                        จัดการสมาชิก
                    </span>
                </a>
            </li>

            <li class="list-main">
                <a href="admin.php?tab=17">
                    <i class="fa fa-user icon"></i>
                    <span class="extra-sm">
                        ข้อมูลตัดสิทธิ์
                    </span>
                </a>
            </li>

            <li class="list-main">
                <a data-toggle="collapse" href="#more" role="button" aria-controls="more">
                    <i class="fa fa-plus icon"></i>
                    <span class="extra-sm">พิมพ์รายงาน</span>
                </a>

                <ul id="more" class="collapse toggle-collapse">
                    <li>
                        <a href="admin.php?tab=12">
                            <i class="fa fa-print icon"></i>
                            <span class="extra-sm ">คนใช้บริการ</span>
                        </a>
                    </li>

                    <li>
                        <a href="admin.php?tab=13">
                            <i class="fa fa-print icon"></i>
                            <span class="extra-sm ">อุปกรณ์ชำรุด</span>
                        </a>
                    </li>
                    <li>
                        <a href="admin.php?tab=14">
                            <i class="fa fa-print icon"></i>
                            <span class="extra-sm ">ยกเลิกการจอง</span>
                        </a>
                    </li>



                </ul>
            </li>

            <li class="list-main">
                <a href="admin.php?tab=15">
                    <i class="fa fa-bar-chart icon"></i>
                    <span class="extra-sm ">
                        แผนภาพสถิติ
                    </span>
                </a>
            </li>

            <?php } ?>
        </ul>
    </div>