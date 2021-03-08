<?php
include 'connection.php'; // เรียกใช้งานไฟล์เชื่อมต่อกับฐานข้อมูล

$query = mysqli_query($db_con, "SELECT COUNT(*) AS Mstatus FROM `tblmessage`");
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
$result = mysqli_query($db_con, "SELECT * from  tblmessage ORDER BY MessageID DESC $limit");
$paginationCtrls = '';
if ($last != 1) {
  if ($pagenum > 1) {
    $previous = $pagenum - 1;
    $paginationCtrls .= '<a href="' . $_SERVER['PHP_SELF'] . '?tab=7.1&pn=' . $previous . '" class="btn btn-info">กลับ</a> &nbsp; &nbsp; ';
    for ($i = $pagenum - 4; $i < $pagenum; $i++) {
      if ($i > 0) {
        $paginationCtrls .= '<a href="' . $_SERVER['PHP_SELF'] . '?tab=7.1&pn=' . $i . '" class="btn btn-primary">' . $i . '</a> &nbsp; ';
      }
    }
  }
  $paginationCtrls .= '' . $pagenum . ' &nbsp; ';
  for ($i = $pagenum + 1; $i <= $last; $i++) {
    $paginationCtrls .= '<a href="' . $_SERVER['PHP_SELF'] . '?tab=7.1&pn=' . $i . '" class="btn btn-primary">' . $i . '</a> &nbsp; ';
    if ($i >= $pagenum + 4) {
      break;
    }
  }
  if ($pagenum != $last) {
    $next = $pagenum + 1;
    $paginationCtrls .= ' &nbsp; &nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?tab=7.1&pn=' . $next . '" class="btn btn-info">ถัดไป</a> ';
  }
}
?>
<?php require '../config/thai_date.php'; ?>
<h1 class='text-center hide'>หน้า | แสดงข้อมูลแจ้งลืมของ</h1>

<div class="row">
    <div class="col-lg-12">

        <h4 class="alert alert-success" class="page-header alert btn-info"><i class="fa fa-bullhorn"></i>
            แสดงข้อมูลแจ้งลืมของ</h4>

    </div>
    <!-- /.col-lg-12 -->
</div>




<div class="row">
    <div class="col-sm-4">
        <div class="table-responsive">
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link active" href="index.php?tab=7">ยังไม่มารับ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?tab=7.1">รับของแล้ว</a>
                </li>

            </ul>
        </div>
    </div>
</div>


<br />

<?php
$resulta = $db_con->query(
  "SELECT * FROM tblmessage WHERE Mstatus = 'รอตรวจสอบ'"
);

if ($resulta->num_rows > 0) { ?>
<div class="row">



    <?php while ($rs = mysqli_fetch_array($result)) {
      if ($rs['Mstatus'] == 'รับของแล้ว') {
        $status =
          "<div class='alert alert-success' role='alert'> <span class='extra-sm'> <i class='fa fa-check pr-2'></i> มารับของแล้ว </span>
      </div>";
      } elseif ($rs['Mstatus'] == 'reject') {
        $status =
          "<div class='alert alert-danger' role='alert'> <span class='extra-sm'> <i class='fa fa-remove pr-2'></i> ยกเลิกการจอง </span>
          </div>";
      } else {
        $status =
          "<div class='alert alert-primary' role='alert'> <span class='extra-sm'> <i class='fa fa-refresh pr-2'></i> ยังไม่มีคนมารับ </span>
        </div>";
      }

      if ($rs['Category'] == 'แจ้งมีคนลืมของ') {
        if ($rs['Mstatus'] != 'รับของแล้ว') { ?>
    <!-- /.panel-heading -->
    <div class="col-sm-4 ">

        <div class="card">
            <div class="bg-white text-dark">
                <a target="_blank" href="../pages/user/myfile/<?php echo $rs['Mimage']; ?>">

                    <img id="myImg" src="../pages/user/myfile/<?php echo $rs['Mimage']; ?>" alt="Snow"
                        style="width:100%;max-width:500px height:100%;max-height:300px">
                </a>
                <div class="card-body">
                    <p class='extra-sm'>

                    <h4> <?php echo $rs['MessageCODE']; ?></h4>

                    <p><b>ประเภท : </b><?php echo $rs['Category']; ?></p>
                    <p><b>รายละเอียด : </b><?php echo $rs['MessageText']; ?></p><br>
                    <p><b>วันที่แจ้ง : </b><?php echo thai11($rs['date_no']); ?></p>

                    <br>
                    <?php echo $status; ?>

                    </p>
                </div>
            </div>
        </div>
    </div>
    <?php }
      }
    } ?>
    <!-- /.panel-body -->

    <!-- /.panel -->
</div>
<?php  } else {
  echo '<br><h2 class="text-center mb-5">ไม่มีข้อมูลที่สามารถใช้ได้</h2>';
} ?>
</div>
<!-- /.col-lg-6 -->




<?php 
//โค้ดเดิม

 //require '../config/thai_date.php';
// <h1 class='text-center hide'>หน้า | แสดงข้อมูลแจ้งลืมของ</h1>
// <div class="row">
//   <div class="col-lg-12">

//     <h4 class="alert alert-success" class="page-header alert btn-info"><i class="fa fa-bullhorn"></i> แสดงข้อมูลแจ้งลืมของ</h4>

//   </div>
//   <!-- /.col-lg-12 -->
// </div>
// <div class="table-responsive">
//   <ul class="nav nav-pills">
//     <li class="nav-item">
//       <a class="nav-link active" href="index.php?tab=7">ยังไม่มารับ</a>
//     </li>
//     <li class="nav-item">
//       <a class="nav-link" href="index.php?tab=7.1">รับของแล้ว</a>
//     </li>

//   </ul>


//   <div class="col-lg-12">

//     <br />
//     <?php
//     include 'connection.php'; // เรียกใช้งานไฟล์เชื่อมต่อกับฐานข้อมูล
//     //$db_con = connect(); // เชื่อมต่อกับฐานข้อมูล
//     $sql = 'SELECT * FROM tblmessage ORDER BY MessageID DESC  LIMIT 120';
//     $result = $db_con->query($sql);
//     
//     <div class="row">

//       <div class="col-lg-12 ">



//         <?php while ($rs = $result->fetch_object()) {
//           if ($rs->Mstatus == 'รับของแล้ว') {
//             $status =
//               "<button class='btn btn-success btn-lg btn' '>" .
//               "<i  class='fa fa-check pr-2'></i> มารับของแล้ว </button>";
//           } elseif ($rs->Mstatus == 'reject') {
//             $status =
//               "<button class='btn btn-danger btn-lg btn' >" .
//               "<i class='fa fa-remove pr-2'></i> ยกเลิกการจอง</button>";
//           } else {
//             $status =
//               "<button class='btn btn-primary btn-lg btn' >" .
//               "<i class='fa fa-refresh pr-2'></i>  ยังไม่มีคนมารับ</button>";
//           }

//           if ($rs->Category == 'แจ้งมีคนลืมของ') {
//             if ($rs->Mstatus != 'รับของแล้ว') { 
//               <!-- /.panel-heading -->
//               <div class="col-md-4 ">

//                 <div class="card" style="width: 20rem;">
//                   <div class="bg-white text-dark">
//                     <a target="_blank" href="../pages/user/myfile/<?php echo $rs->Mimage; "> <img src="../pages/user/myfile/<?php echo $rs->Mimage; " class="card-img-top" alt="Card image cap">
//                     </a>
//                     <div class="card-body">
//                       <p class='extra-sm'>

//                         <h4 > <?php echo $rs->MessageCODE; </h4>

//                         <p ><b>ประเภท : </b><?php echo $rs->Category; </p>
//                         <p ><b>รายละเอียด : </b><?php echo $rs->MessageText; </p><br>
//                         <p ><b>วันที่แจ้ง : </b><?php echo thai8($rs->date_no); </p>

//                         <br>
//                         <?php echo $status; 
//                       </p>
//                     </div>
//                   </div>
//                 </div>
//               </div>
//         <?php }
//           }
//         } 
//         <!-- /.panel-body -->

//         <!-- /.panel -->
//       </div>
//       <!-- /.col-lg-6 -->
//     </div>
//   </div>
// </div>
// </div>
// </div>
// </div>