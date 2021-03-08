<?php if (isset($_SESSION['admin-user']) && $_SESSION['admin-user'] !== '') { ?>
<h1 class='text-center hide'>หน้า | จัดการข้อมูลห้อง/โต๊ะ</h1>
<div class="row">
    <div class="col-lg-12">
        <h3 class="alert alert-success" class="page-header alert btn-info"><i class="fa fa-table"></i>
            จัดการข้อมูลห้อง/โต๊ะ</h3>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="row">
    <div class="col-lg-12">

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">

                    <a href="admin.php?tab=23" class="btn btn-primary btn-xs  "> <i class="fa fa-plus-circle fw-fa"></i>
                        เพิ่มใหม่</a>
                    <br> <br>
                    <?php
            include 'db_connect.php'; // เรียกใช้งานไฟล์เชื่อมต่อกับฐานข้อมูล
            $mysqli = connect(); // เชื่อมต่อกับฐานข้อมูล
            $sql = 'SELECT * FROM booking ORDER BY id asc';
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


                    <div class="panel-body">
                        <div class="dataTable_wrapper">

                            <input class="form-control" id="myInput" type="text"
                                placeholder="ค้นหาข้อมูล ลำดับ, รหัส, ชื่อหัวข้อ ">
                            <br>

                            <table class="table table-bordered table-responsive-sm w-100" id="myTable">
                                <thead>
                                    <tr>
                                        <th width="5%">ลำดับ</th>
                                        <th width="5%">รหัส</th>
                                        <th width="15%">ชื่อหัวข้อ</th>
                                        <th width="35%">รายละเอียด</th>
                                        <th width="20%">ที่อยู่รูปภาพ</th>

                                        <th width="10%">แก้ไข</th>
                                        <th width="10%">ลบ</th>

                                    </tr>
                                </thead>
                                <tbody id="myTable">
                                    <?php while ($row = $result->fetch_object()) {
                        if ($row->id > '1') { ?>
                                    <tr>
                                        <td class="center"><?php echo $row->id; ?> </td>
                                        <td class="center"><?php echo $row->booking_id; ?> </td>
                                        <td class="center"><?php echo $row->booking_type; ?></td>
                                        <td class="center"><?php echo $row->Room_details; ?></td>

                                        <td class="center" align=center><img class="center"
                                                src="../pages/myfile/<?php echo $row->photo; ?>" alt="Nature"
                                                class="resize" style="width:100%"><a
                                                href="../pages/myfile/<?php echo $row->photo; ?>" class="btn btn-link">
                                                <span>คลิกดูรูป</span></a></td>




                                        <td class="center">
                                            <form method="post" action="../pages/admin.php?tab=22">
                                                <input type='hidden' name='id' value='<?php echo $row->id; ?>'>

                                                <button title="Edit" name="admin" type="submit"
                                                    class="btn btn-primary btn-xs"><span
                                                        class="fa fa-edit fw-fa"></span></button>
                                            </form>

                                        </td>
                                        <td><a title="Delete" href="locationDelete.php?id=<?php echo $row->id; ?>"
                                                onclick="return confirm('คุณต้องการลบข้อมูลที่เลือกใช่หรือไม')"
                                                class="btn btn-danger btn-xs"><span class="fa fa-trash-o fw-fa"></span>
                                            </a></td>

                                    </tr>
                                    <?php }
                    }
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

<?php } ?>