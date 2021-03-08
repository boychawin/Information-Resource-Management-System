<?php

$page = "index.php";


?>
<div class="row mt-4">
    <div class="col-md-3 navigation bg-white">
        <h4 class="ml-3 hide-sm">
            <a href="<?php echo $page; ?>"> </a>
            <i class="fa fa-home"></i>
            <span class="extra-sm">หน้าแรก</span>
        </h4>

        <ul class="main-nav">

            <!-- <li class="list-main">
                <a href="<?php echo $page; ?>">
                    <i class="fa fa-home "></i>
                    <span class="extra-sm">หน้าแรก</span>
                </a>
            </li> -->
            <?php if (
                isset($_SESSION['admin-user']) &&
                $_SESSION['admin-user'] !== ''
            ) { ?>
            <li class="list-main">
                <a href="index.php?tab=4">
                    <i class="fa fa-calendar"></i>
                    <span class="extra-sm">สถานะแบบปฏิทิน</span>
                </a>
            </li>

            <li class="list-main">
                <a href="index.php?tab=3">
                    <i class="fa fa-table"></i>
                    <span class="extra-sm">สถานะแบบตาราง</span>
                </a>
            </li>

            <li class="list-main">
                <a href="index.php?tab=7">
                    <i class="fa fa-bullhorn"></i>
                    <span class="extra-sm">แจ้งลืมของ</span>
                </a>
            </li>

            <li class="list-main">
                <a href="index.php?tab=5">
                    <i class="fa fa-map-marker"></i>
                    <span class="extra-sm">ห้อง/โต๊ะ</span>
                </a>
            </li>

            <li class="list-main">
                <a href="index.php?tab=6">
                    <i class="fa fa-key"></i>
                    <span class="extra-sm">คู่มือ</span>
                </a>
            </li>
            <?php  } else {
                if (
                    isset($_SESSION['staff-user']) &&
                    $_SESSION['staff-user'] != ''
                ) {
                ?>
            <li class="list-main">
                <a href="index.php?tab=4">
                    <i class="fa fa-calendar"></i>
                    <span class="extra-sm">สถานะแบบปฏิทิน</span>
                </a>
            </li>

            <li class="list-main">
                <a href="index.php?tab=3">
                    <i class="fa fa-table"></i>
                    <span class="extra-sm">สถานะแบบตาราง</span>
                </a>
            </li>

            <li class="list-main">
                <a href="index.php?tab=7">
                    <i class="fa fa-bullhorn"></i>
                    <span class="extra-sm">แจ้งลืมของ</span>
                </a>
            </li>

            <li class="list-main">
                <a href="index.php?tab=5">
                    <i class="fa fa-map-marker"></i>
                    <span class="extra-sm">ห้อง/โต๊ะ</span>
                </a>
            </li>

            <li class="list-main">
                <a href="index.php?tab=6">
                    <i class="fa fa-key"></i>
                    <span class="extra-sm">คู่มือ</span>
                </a>
            </li>




            <?php } else { ?>

            <li class="list-main">
                <a href="index.php?tab=4">
                    <i class="fa fa-calendar"></i>
                    <span class="extra-sm">สถานะแบบปฏิทิน</span>
                </a>
            </li>

            <li class="list-main">
                <a href="index.php?tab=3">
                    <i class="fa fa-table"></i>
                    <span class="extra-sm">สถานะแบบตาราง</span>
                </a>
            </li>

            <li class="list-main">
                <a href="index.php?tab=7">
                    <i class="fa fa-bullhorn"></i>
                    <span class="extra-sm">แจ้งลืมของ</span>
                </a>
            </li>

            <li class="list-main">
                <a href="index.php?tab=5">
                    <i class="fa fa-map-marker"></i>
                    <span class="extra-sm">ห้อง/โต๊ะ</span>
                </a>
            </li>

            <li class="list-main">
                <a href="index.php?tab=6">
                    <i class="fa fa-key"></i>
                    <span class="extra-sm">คู่มือ</span>
                </a>
            </li>

            <li class="list-main">
                <a href="index.php?tab=2">
                    <i class="fa fa-sign-in"></i>
                    <span class="extra-sm"> เข้าสู่ระบบ
                    </span>
                </a>
            </li>
            <?php }
            } ?>
        </ul>
    </div>