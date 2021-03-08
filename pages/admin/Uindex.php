<?php
if (!isset($_SESSION['admin-user'])) {
    echo 'no';
    echo "<script type='text/javascript'>";
    echo "alert('เกิดข้อผิดพลาด');";
    echo 'window.history.back(1);';
    echo '</script>';
} ?>
<h1 class='text-center hide'>หน้า | จัดการสมาชิก</h1>
<div class="row">
    <div class="col-lg-12">
        <h3 class="alert alert-success" class="page-header alert btn-info"><i class="fa fa-table"></i> จัดการสมาชิก</h3>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="row">
    <div class="col-lg-12">

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">

                    <a href="admin.php?tab=24" class="btn btn-primary btn-xs  "> <i class="fa fa-plus-circle fw-fa"></i> เพิ่มใหม่</a>
                    <br> <br>
                    <?php
                    include 'db_connect.php'; // เรียกใช้งานไฟล์เชื่อมต่อกับฐานข้อมูล
                    $mysqli = connect(); // เชื่อมต่อกับฐานข้อมูล
                    $sql = 'SELECT * FROM employee ORDER BY id asc';
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
                    <div class="panel-body">
                        <div class="dataTable_wrapper">

                            <input class="form-control" id="myInput" type="text" placeholder="ค้นหาข้อมูล ลำดับ, รหัส, ชื่อ-สกุล, ฃื่อผู้ใช้, ตำแหน่ง"><br>


                            <table class="table table-bordered table-responsive-sm w-100" id="myTable">
                                <thead>
                                    <tr>
                                        <th width="5%">ลำดับ</th>
                                        <th width="15%">รหัส</th>
                                        <th width="20%">ชื่อ-สกุล</th>
                                        <th width="20%">ฃื่อผู้ใช้</th>
                                        <th width="20%">ตำแหน่ง</th>

                                        <th width="10%">แก้ไข</th>
                                        <th width="10%">ลบ</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while (
                                        $row = $result->fetch_object()
                                    ) { ?>
                                        <tr>

                                            <td class="center"><?php echo $row->id; ?> </td>
                                            <td class="center"><?php echo $row->staff_id; ?> </td>
                                            <td class="center"><?php echo $row->fname; ?>&nbsp;<?php echo $row->lname; ?></td>
                                            <td class="center"><?php echo $row->username; ?></td>


                                            <td class="center"><?php
                                            if ($row->staff_level == 'admin') {
                                                echo 'แอดมิน';
                                            }
                                            elseif (
                                                $row->staff_level ==
                                                'non-supervisor'
                                            ) {
                                                echo 'สมาชิก';
                                            }
                                            elseif (
                                                $row->staff_level ==
                                                'supervisor'
                                            ) {
                                                echo 'เจ้าหน้าที่';
                                            }
                                            else  {
                                                echo 'รออนุมัติ';
                                            }
                                            ?> </td>
                                            <td class="center">

                                                <form method="post" action="../pages/admin.php?tab=25">
                                                    <input type='hidden' name='id' value='<?php echo $row->id; ?>'>

                                                    <button title="Edit" name="admin" type="submit" class="btn btn-primary btn-xs"><span class="fa fa-edit fw-fa"></span></button>
                                                </form>


                                            </td>
                                            <td><a title="Delete" href="../pages/admin/UDelete.php?id=<?php echo $row->id; ?>" onclick="return confirm('คุณต้องการลบข้อมูลที่เลือกใช่หรือไม')" class="btn btn-danger btn-xs"><span class="fa fa-trash-o fw-fa"></span> </a></td>

                                        </tr>
                                    <?php }
//mysqli_close($db_con);
?>



                                </tbody>
                            </table>

                        </div>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.panel .chat-panel -->
                </div>
            </div>
        </div>
    </div>
</div>