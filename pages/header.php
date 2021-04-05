<?php
session_start();
error_reporting(0);
$directory = basename(dirname($_SERVER['PHP_SELF']));

include_once 'functions.php';

auto_update_booking_curr_date();

if (is_session_inplace('admin-user')) {
    $page = 'admin.php';
} elseif (is_session_inplace('supervisor-user')) {
    $page = 'dashboard.php?type=supervisor';
} elseif (is_session_inplace('staff-user')) {
    $page = 'dashboard.php';
}
?>
<script>
    window.addEventListener("load", function() {
        const loader = document.querySelector(".loader");
        loader.className += " hidden"; // class "loader hidden"
    });
</script>

<?php require_once 'styles.php'; ?>
<nav class="fixed-top navbar-expand-lg navbar-expand-xl navbar ">
    <a href="../pages/index" rel="home">
        <img src="../images/logo.png" width="50" height="50" class="img-fluid" href="/irms" alt="boychawin.com" class="logo">&nbsp; แจกระบบจองห้อง/โต๊ะ
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-toggle" aria-controls="navbar-toggle" aria-label="Toggle navigation">

        <span class="fa fa-bars"></span>

    </button>

    <div class="collapse navbar-collapse" id="navbar-toggle">

        <ul class="nav navbar-nav">

            <?php if (
                isset($_SESSION['admin-user']) &&
                $_SESSION['admin-user'] !== ''
            ) {
                $admin_username = $_SESSION['admin-user'];
                $admin_username = $_SESSION['admin-fname'];
                echo '

                    <li class="nav-item" >
                            <a class="nav-link text-white bg-dark" ' .
                    $admin_username .
                    '" >
                 ยินดีต้อนรับ ' .
                    ucfirst($admin_username) .
                    '</a> </li>
';

                echo "
                <li class='nav-item dropdown'>
                <a class='nav-link dropdown-toggle' href='#' id='navbarDropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false' title=''                          
            '' href='/irms/pages/dashboard.php?tab=4'>
                    <i class='fa fa-table'></i> สถานะห้อง/โต๊ะ</a>
                <div class='dropdown-menu' aria-labelledby='navbarDropdownMenuLink'>


                    <a class='dropdown-item' href='index.php?tab=4'>
                        <i class='fa fa-calendar '></i>
                        <span class='extra-sm'>แบบปฏิทิน</span>
                    </a>
                    <a class='dropdown-item' href='index.php?tab=3'>
                        <i class='fa fa-table '></i>
                        <span class='extra-sm '>แบบตาราง</span>
                    </a>

                </div>
            </li>

                

            <li class='nav-item'>
                <a class='nav-link' href='index.php?tab=7'>
                    <i class='fa fa-bullhorn'></i>
                    <span class='extra-sm'>รายการแจ้งลืมของ</span>
                </a>
            </li>

            <li class='nav-item'>
                <a class='nav-link' href='index.php?tab=5'>
                    <i class='fa fa-map-marker'></i>
                    <span class='extra-sm'>ข้อมูลห้อง/โต๊ะ</span>
                </a>
            </li>


      
                
                
                

                    
                    ";
                //             <li class="nav-item dropdown">
                //             <a  class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="' .
                //                 $admin_username .
                //                 '" href="/irms/pages/dashboard.php?tab=4">
                // <i class="fa fa-user"></i> ยินดีต้อนรับ ' .
                //                 ucfirst($admin_username) .
                //                 '</a> 
            ?>

                <li class="nav-item">
                    <a class="nav-link" href="admin.php?tab=2">
                        <i class="fa fa-tasks "></i>
                        <span class="extra-sm ">
                            อนุมัติสมัคร
                        </span>
                    </a>
                </li>


                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="' 
                    '" href="/irms/pages/dashboard.php?tab=4">
                        <i class="fa fa-user"></i> จัดการข้อมูล</a>

                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">


                        <a class="dropdown-item" href="admin.php?tab=9">
                            <i class="fa fa-table "></i>
                            <span class="extra-sm ">
                                จัดการข้อมูลห้อง/โต๊ะ
                            </span>
                        </a>



                        <a class="dropdown-item" href="admin.php?tab=10">
                            <i class="fa fa-key "></i>
                            <span class="extra-sm ">
                                จัดการข้อมูลร้องเรียน
                            </span>
                        </a>



                        <a class="dropdown-item" href="admin.php?tab=11">
                            <i class="fa fa-user "></i>
                            <span class="extra-sm">
                                จัดการข้อมูลสมาชิก
                            </span>
                        </a>



                        <a class="dropdown-item" href="admin.php?tab=17">
                            <i class="fa fa-user "></i>
                            <span class="extra-sm">
                                จัดการข้อมูลตัดสิทธิ์
                            </span>
                        </a>



                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        รายงาน
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">


                        <a class="dropdown-item" href="admin.php?tab=27">
                            <i class="fa fa-archive "></i>
                            <span class="extra-sm ">
                                รายการจองทั้งหมด
                            </span>
                        </a>
                        <a class="dropdown-item" href="admin.php?tab=15">
                            <i class="fa fa-bar-chart "></i>
                            <span class="extra-sm ">
                                แผนภาพสถิติ
                            </span>
                        </a>


                        <a class="dropdown-item" href="admin.php?tab=12">
                            <i class="fa fa-print "></i>
                            <span class="extra-sm ">คนใช้บริการ</span>
                        </a>

                        <a class="dropdown-item" href="admin.php?tab=13">
                            <i class="fa fa-print "></i>
                            <span class="extra-sm ">อุปกรณ์ชำรุด</span>
                        </a>

                        <a class="dropdown-item" href="admin.php?tab=14">
                            <i class="fa fa-print "></i>
                            <span class="extra-sm ">ยกเลิกการจอง</span>
                        </a>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="admin.php?tab=4">
                        <i class="fa fa-user-circle "></i>
                        <span class="extra-sm">ข้อมูลส่วนตัว</span>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="logout.php" class="nav-link">
                        <i class="fa fa-sign-out"></i>
                        ออก
                    </a>
                </li>



                <?php   } else {
                $elmns = <<<POP

            <li class="nav-item">
POP;


                if (
                    isset($_SESSION['staff-user']) &&
                    $_SESSION['staff-user'] != ''
                ) {
                    $staff_username = $_SESSION['staff-fname'];

                    $level = $_SESSION['staff-level'];


                    $user_dir =
                        'users/myaccount/images/' . $staff_username . '.jpg';



                    if (file_exists($user_dir)) {
                        echo '<a class="nav-link" title="' .
                            $staff_username .
                            '" href="#">
             <img src="' .
                            $user_dir .
                            '" class="img-square"></a></li>';
                    } else {


                        echo '

                            <li class="nav-item" >
                                    <a class="nav-link text-white bg-dark" ' .
                            $staff_username .
                            '" >
                         ยินดีต้อนรับ ' .
                            ucfirst($staff_username) .
                            '</a> </li>
';
                ?>



                        <?php if ($level == 'supervisor') {  ?>

                            <li class='nav-item dropdown'>
                                <a class='nav-link dropdown-toggle' href='#' id='navbarDropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false' title='' '' href='/irms/pages/dashboard.php?tab=4'>
                                    <i class='fa fa-table'></i> สถานะห้อง/โต๊ะ</a>
                                <div class='dropdown-menu' aria-labelledby='navbarDropdownMenuLink'>


                                    <a class='dropdown-item' href='index.php?tab=4'>
                                        <i class='fa fa-calendar '></i>
                                        <span class='extra-sm'>แบบปฏิทิน</span>
                                    </a>
                                    <a class='dropdown-item' href='index.php?tab=3'>
                                        <i class='fa fa-table '></i>
                                        <span class='extra-sm '>แบบตาราง</span>
                                    </a>

                                </div>
                            </li>



                            <li class='nav-item'>
                                <a class='nav-link' href='index.php?tab=5'>
                                    <i class='fa fa-map-marker'></i>
                                    <span class='extra-sm'>ข้อมูลห้อง/โต๊ะ</span>
                                </a>
                            </li>




                            <li class="nav-item">
                                <a class="nav-link" href="dashboard.php?tab=7">
                                    <i class="fa fa-recycle "></i>
                                    <span class="extra-sm ">อนุมัติจอง</span>
                                </a>
                            </li>



                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-bell "></i>
                                    <span class="extra-sm">แจ้ง/ร้องเรียน
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                                    <a class="dropdown-item" href="dashboard.php?tab=9">
                                        <i class="fa fa-key"></i>
                                        <span class="extra-sm">จัดการแจ้ง/ร้องเรียน</span>
                                    </a>


                                    <a class="dropdown-item" href="index.php?tab=7">
                                        <i class="fa fa-bullhorn"></i>
                                        <span class="extra-sm">รายการแจ้งลืมของ</span>
                                    </a>


                                </div>
                            </li>





                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    ดําเนินการ
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                                    <a class="dropdown-item" href="dashboard.php?tab=14">
                                        <i class="fa fa-edit "></i>
                                        <span class="extra-sm ">ยืนยันการเข้าใช้</span>
                                    </a>

                                    <a class="dropdown-item" href="dashboard.php?tab=6">
                                        <i class="fa fa-plus-circle "></i>
                                        <span class="extra-sm ">จองห้อง/โต๊ะ</span>
                                    </a>

                                    <a class="dropdown-item" href="dashboard.php?tab=19">
                                        <i class="fa fa-plus-circle "></i>
                                        <span class="extra-sm ">สมัคร</span>
                                    </a>




                                    <!-- <a class="dropdown-item" href="dashboard.php?tab=3">
                                        <i class="fa fa-archive "></i>
                                        <span class="extra-sm ">รายการจอง</span>
                                    </a> -->



                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    รายงาน
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="dashboard.php?tab=1">
                                        <i class="fa fa-bell "></i>
                                        <span class="extra-sm">สถานะการจอง</span>
                                    </a>

                                    <a class="dropdown-item" href="dashboard.php?tab=13">
                                        <i class="fa fa-bar-chart " aria-hidden="true"></i>
                                        <span class="extra-sm ">
                                            แผนภาพสถิติ
                                        </span>
                                    </a>

                                    <a class="dropdown-item" href="dashboard.php?tab=5">
                                        <i class="fa fa-bars "></i>
                                        <span class="extra-sm ">รายงานของฉัน</span>
                                    </a>


                                    <a class="dropdown-item" href="dashboard.php?tab=2">
                                        <i class="fa fa-bars "></i>
                                        <span class="extra-sm "> รายงานรวม</span>
                                    </a>




                                    <a class="dropdown-item" href="dashboard.php?tab=16">
                                        <i class="fa fa-print "></i>
                                        <span class="extra-sm ">คนใช้บริการ</span>
                                    </a>

                                    <a class="dropdown-item" href="dashboard.php?tab=17">
                                        <i class="fa fa-print "></i>
                                        <span class="extra-sm ">อุปกรณ์ชำรุด</span>
                                    </a>

                                    <a class="dropdown-item" href="dashboard.php?tab=18">
                                        <i class="fa fa-print "></i>
                                        <span class="extra-sm ">ยกเลิกการจอง</span>
                                    </a>

                                </div>
                            </li>






                        <?php }
                        if ($level == 'non-supervisor' || $level == 'non' || $level == 'noadmin' || $level == '') { ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-table "></i>
                                    <span class="extra-sm">สถานะห้อง/โต๊ะ
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">



                                    <a class="dropdown-item" href="index.php?tab=4">
                                        <i class="fa fa-calendar"></i>
                                        <span class="extra-sm">แบบปฏิทิน</span>
                                    </a>






                                    <a class="dropdown-item" href="index.php?tab=3">
                                        <i class="fa fa-table"></i>
                                        <span class="extra-sm">แบบตาราง</span>
                                    </a>


                                </div>
                            </li>



                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-plus-circle "></i>
                                    <span class="extra-sm">การจองห้อง/โต๊ะ
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                                    <a class="dropdown-item" href="dashboard.php?tab=6">
                                        <i class="fa fa-plus-circle "></i>
                                        <span class="extra-sm">จองห้อง/โต๊ะ</span>
                                    </a>


                                    <a class="dropdown-item" href="index.php?tab=5">
                                        <i class="fa fa-map-marker"></i>
                                        <span class="extra-sm">ข้อมูลห้อง/โต๊ะ</span>
                                    </a>


                                </div>
                            </li>



                            <li class="nav-item  ">
                                <a class="nav-link" href="dashboard.php?tab=14">
                                    <i class="fa fa-edit "></i>
                                    <span class="extra-sm">ยืนยันเข้าใช้</span>
                                </a>
                            </li>


                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-bell "></i>
                                    <span class="extra-sm">แจ้ง/ร้องเรียน
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                                    <a class="dropdown-item" href="dashboard.php?tab=8">
                                        <i class="fa fa-plus-circle"></i>
                                        <span class="extra-sm">การแจ้ง/ร้องเรียน</span>
                                    </a>


                                    <a class="dropdown-item" href="index.php?tab=7">
                                        <i class="fa fa-bullhorn"></i>
                                        <span class="extra-sm">รายการแจ้งลืมของ</span>
                                    </a>


                                </div>
                            </li>



                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="'                          
                            '" href="/irms/pages/dashboard.php?tab=4">
                                    <i class="fa fa-bars"></i> รายงาน</a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">


                                    <a class="dropdown-item" href="dashboard.php?tab=1">
                                        <i class="fa fa-bell "></i>
                                        <span class="extra-sm">สถานะการจอง</span>
                                    </a>
                                    <a class="dropdown-item" href="dashboard.php?tab=5">
                                        <i class="fa fa-bars "></i>
                                        <span class="extra-sm ">รายงาน</span>
                                    </a>

                                </div>
                            </li>


                        <?php } ?>

            <?php
                    }

                    echo "
                    <li class='nav-item'>
                    <a class='nav-link' href='dashboard.php?tab=4'>
                        <i class='fa fa-user-circle '></i>
                        <span class='extra-sm'>ข้อมูลส่วนตัว</span>
                    </a>
                </li>

                <li class='nav-item dropdown'>
                <a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                    <i class='fa fa-question-circle '></i>
                </a>
                <div class='dropdown-menu' aria-labelledby='navbarDropdown'>
                    <a class='dropdown-item' href='index.php?tab=6'>
                        <i class='fa fa-key'></i>
                        <span class='extra-sm'>กฎกติกา</span>
                    </a>
                </div>
            </li>
            
                <li class='nav-item'><a href='logout.php' class='nav-link'>" .
                        "<i class='fa fa-sign-out'></i> ออก</a></li>";
                } elseif (
                    isset($_SESSION['supervisor-user']) &&
                    $_SESSION['ssupervisor-user'] !== ''
                ) {
                    $supervisor_username = $_SESSION['ssupervisor-user'];

                    $user_dir =
                        'users/myaccount/images/' .
                        $supervisor_username .
                        '.jpg';

                    echo $elmns;

                    echo '<li class="nav-item">
                    <a class="nav-link" href="/irms/admin.php?tab=1">
                    <i class="fa fa-arrows-alt"></i>แนะนำที่รอดำเนินการ</a>
                </li>';

                    if (file_exists($user_dir)) {
                        echo '<a class="nav-link" title="' .
                            $supervisor_username .
                            '" href="#">
             <img src="' .
                            $user_dir .
                            '" class="img-square"></a>';
                    } else {
                        echo '<a class="nav-link" title="' .
                            $supervisor_username .
                            '" href="#">
                <i class="fa fa-user"></i> ' .
                            ucfirst($supervisor_username) .
                            '</a>';
                    }

                    echo "<li class='nav-item'><a href='logout.php' class='nav-link'>" .
                        "<i class='fa fa-sign-out'></i>ออก</a></li>";
                } else {
                    echo "
                    

                    <li class='nav-item dropdown'>
                    <a class='nav-link dropdown-toggle' href='#' id='navbarDropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false' title=''                          
                '' href='/irms/pages/dashboard.php?tab=4'>
                        <i class='fa fa-table'></i> สถานะห้อง/โต๊ะ</a>
                    <div class='dropdown-menu' aria-labelledby='navbarDropdownMenuLink'>


                        <a class='dropdown-item' href='index.php?tab=4'>
                            <i class='fa fa-calendar '></i>
                            <span class='extra-sm'>แบบปฏิทิน</span>
                        </a>
                        <a class='dropdown-item' href='index.php?tab=3'>
                            <i class='fa fa-table '></i>
                            <span class='extra-sm '>แบบตาราง</span>
                        </a>

                    </div>
                </li>

                    

                <li class='nav-item'>
                    <a class='nav-link' href='index.php?tab=7'>
                        <i class='fa fa-bullhorn'></i>
                        <span class='extra-sm'>รายการแจ้งลืมของ</span>
                    </a>
                </li>

                <li class='nav-item'>
                    <a class='nav-link' href='index.php?tab=5'>
                        <i class='fa fa-map-marker'></i>
                        <span class='extra-sm'>ข้อมูลห้อง/โต๊ะ</span>
                    </a>
                </li>

                <li class='nav-item'>
                    <a class='nav-link'href='index.php?tab=6'>
                        <i class='fa fa-key'></i>
                        <span class='extra-sm'>กฎกติกา</span>
                    </a>
                </li>

                <li class='nav-item'>
                    <a class='nav-link'href='index.php?tab=2'>
                        <i class='fa fa-sign-in'></i>
                        <span class='extra-sm'> เข้าสู่ระบบ
                        </span>
                    </a>
                </li>
                <li class='nav-item'>
                <a class='nav-link'href='index.php?tab=8'>
                    <i class='fa fa-sign-out'></i>
                    <span class='extra-sm'> สมัคร
                    </span>
                </a>
            </li>
          
                    ";
                }
            } ?>


        </ul>
    </div>
</nav>
<div class="loader">
    <img src="https://localhost/IRMS/images/VAyR.gif" alt="Loading..." />
</div>
<br>
<!-- <div class="row"> -->