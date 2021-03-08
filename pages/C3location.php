<?php
include 'connection.php'; // เรียกใช้งานไฟล์เชื่อมต่อกับฐานข้อมูล
// $db_con = connect(); // เชื่อมต่อกับฐานข้อมูล
//$sql = 'SELECT * FROM booking ORDER BY MessageID DESC  LIMIT 120';
//$result = $db_con->query($sql);
// $sql = 'SELECT * FROM booking ORDER BY MessageID DESC  LIMIT 120';
//mysqli_query($db_con, "SET NAMES 'utf8' ");
$query = mysqli_query($db_con, "SELECT COUNT(id) FROM `booking`");
$row = mysqli_fetch_row($query);
$rows = $row[0];
$page_rows = 10;  //จำนวนข้อมูลที่ต้องการให้แสดงใน 1 หน้า  ตย. 5 record / หน้า 
$last = ceil($rows / $page_rows);
if ($last < 1) {
    $last = 1;
}
$pagenum = 1;
if (isset($_GET['pn'])) {
    $pagenum = preg_replace('#[^0-9]#', '', $_GET['pn']);
}
if ($pagenum < 1) {
    $pagenum = 1;
} else if ($pagenum > $last) {
    $pagenum = $last;
}
$limit = 'LIMIT ' . ($pagenum - 1) * $page_rows . ',' . $page_rows;
$result = mysqli_query($db_con, "SELECT * from  booking ORDER BY id ASC $limit");
$paginationCtrls = '';
if ($last != 1) {
    if ($pagenum > 1) {
        $previous = $pagenum - 1;
        $paginationCtrls .= '<a href="' . $_SERVER['PHP_SELF'] . '?tab=5&pn=' . $previous . '" class="btn btn-info">กลับ</a> &nbsp; &nbsp; ';
        for ($i = $pagenum - 4; $i < $pagenum; $i++) {
            if ($i > 0) {
                $paginationCtrls .= '<a href="' . $_SERVER['PHP_SELF'] . '?tab=5&pn=' . $i . '" class="btn btn-primary">' . $i . '</a> &nbsp; ';
            }
        }
    }
    $paginationCtrls .= '' . $pagenum . ' &nbsp; ';
    for ($i = $pagenum + 1; $i <= $last; $i++) {
        $paginationCtrls .= '<a href="' . $_SERVER['PHP_SELF'] . '?tab=5&pn=' . $i . '" class="btn btn-primary">' . $i . '</a> &nbsp; ';
        if ($i >= $pagenum + 4) {
            break;
        }
    }
    if ($pagenum != $last) {
        $next = $pagenum + 1;
        $paginationCtrls .= ' &nbsp; &nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?tab=5&pn=' . $next . '" class="btn btn-info">ถัดไป</a> ';
    }
}
?>

<h1 class='text-center hide'>หน้าหลัก | รายการห้อง/โต๊ะ </h1>

<div class="row">
    <div class="col-lg-12">
        <h4 class="alert alert-success" class="page-header alert btn-info"><i class="fa fa-map-marker"></i>
            รายการห้อง/โต๊ะ</h4>
    </div>
    <!-- /.col-lg-12 -->
</div>
<?php if (isset($_SESSION['admin-user']) && $_SESSION['admin-user'] !== '') { ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                รายการทั้งหมด <?php
                                $query1 = 'SELECT COUNT(*) AS id FROM booking';
                                $result1 = mysqli_query($db_con, $query1);
                                $a = 1;
                                while ($row = mysqli_fetch_array($result1)) {
                                    echo '<tr>';

                                    $b = $row['id'] - 1;
                                    echo " $b ห้อง/โต๊ะ";

                                    echo '</tr>';
                                }
                                ?>
            </div>
            <?php
            //include("db_connect.php"); // เรียกใช้งานไฟล์เชื่อมต่อกับฐานข้อมูล
            // $mysqli = connect(); // เชื่อมต่อกับฐานข้อมูล
            // $sql = 'SELECT * FROM booking ORDER BY id ASC  ';
            // $result = $mysqli->query($sql);

            // <h2>รายละเอียดห้อง/โต๊ะ</h2>
            // <p></p>
            // <p></p>
            ?>

            <div class="row">


                <?php while ($rs = mysqli_fetch_array($result)) {
                    if ($rs['id'] > '1') { ?>
                <!-- /.panel-heading  style="width: 18rem;"-->
                <div class="col-sm-4">
                    <div class="card">
                        <a target="_blank" href="../pages/myfile/<?php echo $rs['photo']; ?>"><img id="myImg"
                                src="../pages/myfile/<?php echo $rs['photo']; ?>" alt="Snow"
                                style="width:100%;max-width:500px height:100%;max-height:300px">
                        </a>
                        <div class="card-body">
                            <p class='extra-sm'>
                            <h6> <?php echo $rs['booking_type']; ?></h6>

                            <p><b>ลำดับที่ : </b>&nbsp;<?php echo $rs['Room_number']; ?> &nbsp;<b> ชั้น :</b>&nbsp;
                                &nbsp;<?php echo $rs['class']; ?></p>
                            <p><b>ตึก :</b>&nbsp; &nbsp;<?php echo $rs['building']; ?></p>
                            <p><b>ความจุ/คน :</b>&nbsp; &nbsp;<?php echo $rs['Capacity_person']; ?></p>
                            <p><b>ประเภทห้อง :</b>&nbsp; &nbsp;<?php echo $rs['Room_type']; ?></p>
                            <p><b>รายละเอียด :</b>&nbsp; &nbsp;<?php echo $rs['Room_details']; ?></p>


                            </p>
                        </div>
                    </div>
                </div>

                <?php }
                } ?>
                <!-- /.panel-body -->

                <!-- /.panel -->
            </div>
            <!-- /.col-lg-6 -->
        </div>
        <!-- /.panel-body -->
        <p>
            <center>
                <div id="pagination_controls"><?php echo $paginationCtrls; ?></div>
            </center>
        </p>
    </div>
    <!-- /.panel -->
</div>
</div>
<?php } ?>

<?php if (isset($_SESSION['staff-user']) && $_SESSION['staff-user'] !== '') { ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                รายการทั้งหมด <?php
                                $query1 = 'SELECT COUNT(*) AS id FROM booking';
                                $result1 = mysqli_query($db_con, $query1);
                                $a = 1;
                                while ($row = mysqli_fetch_array($result1)) {
                                    echo '<tr>';

                                    $b = $row['id'] - 1;
                                    echo " $b ห้อง/โต๊ะ";

                                    echo '</tr>';
                                }
                                ?>
            </div>

            <div class="row">


                <?php while ($rs = mysqli_fetch_array($result)) {
                    if ($rs['id'] > '1') { ?>
                <!-- /.panel-heading  style="width: 18rem;"-->
                <div class="col-sm-4">
                    <div class="card">
                        <a target="_blank" href="../pages/myfile/<?php echo $rs['photo']; ?>"><img id="myImg"
                                src="../pages/myfile/<?php echo $rs['photo']; ?>" alt="Snow"
                                style="width:100%;max-width:500px height:100%;max-height:300px">
                        </a>
                        <div class="card-body">
                            <p class='extra-sm'>
                            <h6> <?php echo $rs['booking_type']; ?></h6>

                            <p><b>ลำดับที่ : </b>&nbsp;<?php echo $rs['Room_number']; ?> &nbsp;<b> ชั้น :</b>&nbsp;
                                &nbsp;<?php echo $rs['class']; ?></p>
                            <p><b>ตึก :</b>&nbsp; &nbsp;<?php echo $rs['building']; ?></p>
                            <p><b>ความจุ/คน :</b>&nbsp; &nbsp;<?php echo $rs['Capacity_person']; ?></p>
                            <p><b>ประเภทห้อง :</b>&nbsp; &nbsp;<?php echo $rs['Room_type']; ?></p>
                            <p><b>รายละเอียด :</b>&nbsp; &nbsp;<?php echo $rs['Room_details']; ?></p>

                            <center>
                                <a type='submit' href='dashboard.php?tab=6&book=<?php echo $rs['id']; ?>' name='request'
                                    class='btn btn-primary'>เลือก</a>
                            </center>
                            </p>
                        </div>
                    </div>
                </div>

                <?php }
                } ?>
                <!-- /.panel-body -->

                <!-- /.panel -->
            </div>
            <!-- /.col-lg-6 -->
        </div>
        <!-- /.panel-body -->
        <p>
            <center>
                <div id="pagination_controls"><?php echo $paginationCtrls; ?></div>
            </center>
        </p>
    </div>
    <!-- /.panel -->
</div>
</div>

<?php }else{ ?>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                รายการทั้งหมด <?php
                                $query1 = 'SELECT COUNT(*) AS id FROM booking';
                                $result1 = mysqli_query($db_con, $query1);
                                $a = 1;
                                while ($row = mysqli_fetch_array($result1)) {
                                    echo '<tr>';

                                    $b = $row['id'] - 1;
                                    echo " $b ห้อง/โต๊ะ";

                                    echo '</tr>';
                                }
                                ?>
            </div>
            <?php
            //include("db_connect.php"); // เรียกใช้งานไฟล์เชื่อมต่อกับฐานข้อมูล
            // $mysqli = connect(); // เชื่อมต่อกับฐานข้อมูล
            // $sql = 'SELECT * FROM booking ORDER BY id ASC  ';
            // $result = $mysqli->query($sql);

            // <h2>รายละเอียดห้อง/โต๊ะ</h2>
            // <p></p>
            // <p></p>
            ?>

            <div class="row">


                <?php while ($rs = mysqli_fetch_array($result)) {
                    if ($rs['id'] > '1') { ?>
                <!-- /.panel-heading  style="width: 18rem;"-->
                <div class="col-sm-4">
                    <div class="card">
                        <a target="_blank" href="../pages/myfile/<?php echo $rs['photo']; ?>"><img id="myImg"
                                src="../pages/myfile/<?php echo $rs['photo']; ?>" alt="Snow"
                                style="width:100%;max-width:500px height:100%;max-height:300px">
                        </a>
                        <div class="card-body">
                            <p class='extra-sm'>
                            <h6> <?php echo $rs['booking_type']; ?></h6>

                            <p><b>ลำดับที่ : </b>&nbsp;<?php echo $rs['Room_number']; ?> &nbsp;<b> ชั้น :</b>&nbsp;
                                &nbsp;<?php echo $rs['class']; ?></p>
                            <p><b>ตึก :</b>&nbsp; &nbsp;<?php echo $rs['building']; ?></p>
                            <p><b>ความจุ/คน :</b>&nbsp; &nbsp;<?php echo $rs['Capacity_person']; ?></p>
                            <p><b>ประเภทห้อง :</b>&nbsp; &nbsp;<?php echo $rs['Room_type']; ?></p>
                            <p><b>รายละเอียด :</b>&nbsp; &nbsp;<?php echo $rs['Room_details']; ?></p>

                            <center>
                                <a type='submit' href='index.php?tab=2' name='request' class='btn btn-primary'>เลือก</a>
                            </center>
                            </p>
                        </div>
                    </div>
                </div>

                <?php }
                } ?>
                <!-- /.panel-body -->

                <!-- /.panel -->
            </div>
            <!-- /.col-lg-6 -->
        </div>
        <!-- /.panel-body -->
        <p>
            <center>
                <div id="pagination_controls"><?php echo $paginationCtrls; ?></div>
            </center>
        </p>
    </div>
    <!-- /.panel -->
</div>
</div>
<?php } ?>