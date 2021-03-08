<?php
date_default_timezone_set('Asia/Bangkok');

if (isset($_SESSION['staff-user']) && $_SESSION['staff-user'] !== '') { ?>
<?php if ($level == 'supervisor') { ?>


<?php if (isset($_GET['book']) && !empty($_GET['book'])) {


        ?>
<script language="JavaScript">
function resutName(strCusName) {
    frmMain.txtbooking_type.value = strCusName.split("   ")[0];
    frmMain.txtbuilding.value = strCusName.split("   ")[1];
    frmMain.txtclass.value = strCusName.split("   ")[2];
    frmMain.txtCapacity_person.value = strCusName.split("   ")[3];
    frmMain.equipment.value = strCusName.split("   ")[4];
    frmMain.myfile.value = strCusName.split("   ")[5];


}
</script>

<h1 class='text-center hide'>หน้า | เพิ่มการจองใหม่</h1>
<?php
            if ($level == 'non-supervisor') {
                $result = $db_con->query(
                    "SELECT * FROM booking WHERE for_staff_level = 'non-supervisor' or for_staff_level = 'supervisor' "
                );
            } elseif ($level == '' || $level == 'non') {
                $result = $db_con->query(
                    "SELECT * FROM booking WHERE for_staff_level = '' "
                );
                if ($level == '' || $level == 'non') {
                    echo "<h5><font color='red'> *ยังไม่สามารถจองได้ *</font></h5></p><br>";
                }
            } else {
                $result = $db_con->query(
                    "SELECT * FROM booking WHERE for_staff_level = 'supervisor' or for_staff_level = 'non-supervisor'"
                );
            }

            if ($result->num_rows > 0) {
                // include("booking-types.php");
                $rs = $result->fetch_object();
            ?>
<div class='extra-sm'>
    <div class='row'>

        <div class='col-md-10 mb-2 mx-auto'>

            <form name='frmMain' action='request.php' method='post' class='mb-5' id='request-form'>
                <?php
                                echo "<input type='hidden' name='staff_id' value='$id'>
<input type='hidden' name='booking_id' value='$rs->booking_id '>
<input type='hidden' name='Faculty_b' value='$Faculty '>
<input type='hidden' name='fnamelname' value='$fname1 $lname1 '>";
                                ?>
                <label for='booking-type'>ห้อง/โต๊ะ</label>
                <font color='red' class='extra-sm'> * </font>
                <div class='row mb-2'>
                    <div class='col-md-5 mb-md-2'>


                        <select OnChange="resutName(this.value);" class='extra-sm' name='booking_type'
                            class='form-control' required>";
                            <?php
                                            $book = $_GET['book'];
                                            $sql2 = "SELECT * FROM booking WHERE id='$book' ";
                                            $result2 = mysqli_query($db_con, $sql2);
                                            $rows = mysqli_fetch_array($result2);
                                            extract($rows);

                                            echo "<option  value='$booking_type ลำดับที่ $Room_number   ตึก $building   ชั้น $class   ที่นั่ง $Capacity_person คน   $Room_details   $booking_id''>$booking_type ลำดับที่ $Room_number </option>";
                                            ?>

                            <?php
                                        while ($row = $result->fetch_object()) {
                                            echo "<option  value='$row->booking_type ลำดับที่ $row->Room_number   ตึก $row->building   ชั้น $row->class   ที่นั่ง $row->Capacity_person คน   $row->Room_details   $row->booking_id''>$row->booking_type ลำดับที่ $row->Room_number </option>";
                                        }
                                        echo '</select></div>';
                                    }
                                        ?>
                            <div class='col-md-3 mb-md-2'>
                                <input class='form-control'
                                    value="<?php echo  $booking_type . " " . "ลำดับที่" . " " . $Room_number; ?>"
                                    name="txtbooking_type" type="hidden" required readonly>
                                <input class='form-control' value="<?php echo "ตึก" . " " . $building; ?>"
                                    name="txtbuilding" type="text" readonly required>
                            </div>

                            <div class='col-md-2 mb-md-2'>
                                <input class='form-control' value="<?php echo "ชั้น" . " " . $class; ?>" name="txtclass"
                                    type="text" min="1" max="" readonly required>
                            </div>
                            <div class='col-md-2 mb-md-'>
                                <input class='form-control' value="<?php echo $booking_id; ?>" name="myfile"
                                    type="hidden" readonly>
                                <input class='form-control'
                                    value="<?php echo "ที่นั่ง" . " " . $Capacity_person . " " . "คน"; ?>"
                                    name="txtCapacity_person" type="text" readonly required>
                            </div>
                    </div>
                    <hr>
                    <?php
                                    //YYYY-MM-DDTHH:mm
                                    //Y-m-d H:i:s
                                    $min = date('Y-m-d H:i:s');
                                    echo " <div class='row mb-2'>
<div class='col-md-6 mb-md-2'>
<label for='start'>วันเวลาที่เริ่มต้น</label><font color='red'> * </font>
<input type='datetime-local' name='booking_start_date' min='$min' id='start' class='form-control' required>
</div>
<div class='col-md-6 mb-md-2'>
<label for='end'>วันเวลาที่สิ้นสุด</label><font color='red'> * </font>
<input type='datetime-local' name='booking_end_date' id='end' min='$min' class='form-control' required>

</div> </div>
<hr>
<div class='row mb-2'>
<div class='col-md-4 mb-md-2'>
<label>จำนวนคนใช้ห้อง</label><font color='red'> * </font>
<select class='extra-sm'class='form-control' type='text' name='numberp' required>";
                                    for ($i = 1; $i < 1000; $i++) {
                                        echo "<option value='$i'>$i</option>";
                                    }
                                    echo "</select></div> 
<div class='col-md-8 mb-md-2'>
<label >จุดประสงค์การเข้าใช้งาน </label><font color='red'> * </font>

<textarea class='form-control' type='text' placeholder='โปรดป้อนรายละเอียดในการเข้าใช้งาน' name='purpose' required  rows='3' ></textarea>
<small class='error' id='error'></small>

</div> </div><hr>";

                                    echo " 
<label >รายละเอียด/อุปกรณ์ </label><font color='red'> </font><br>
<div  class='row mb-2'>
<div class='col-md-12 mb-md-2'>


<textarea value='$Room_details' name='equipment' class='form-control' type='text' title=''required  rows='3' readonly>$Room_details</textarea>

</div>

</div> 

<hr> 



<div class='text-center'>
<button type='submit' name='request' class='btn btn-primary' >
ขอจอง</button>
</div> 
<hr>
<font  class='extra-sm' color='red' >* <b>หมายเหตุ</b> สำหรับการจองใช้ห้องที่อยู่ใน<u><b>ตัวอาคาร</b></u>ควรจองห้องล่วงหน้าอย่างน้อย 2 วัน ระบบจะปรับสถานะเป็น <u><b>ไม่อนุมัติ</b></u> ทันทีกรุณาติดต่อเจ้าหน้าที่ตามเบอร์โทรศัพท์ด้านล่าง</font>
</div></form></div></div> </div> ";
                                } else { ?>


                    <script language="JavaScript">
                    function resutName(strCusName) {
                        frmMain.txtbooking_type.value = strCusName.split("   ")[0];
                        frmMain.txtbuilding.value = strCusName.split("   ")[1];
                        frmMain.txtclass.value = strCusName.split("   ")[2];
                        frmMain.txtCapacity_person.value = strCusName.split("   ")[3];
                        frmMain.equipment.value = strCusName.split("   ")[4];
                        frmMain.myfile.value = strCusName.split("   ")[5];


                    }
                    </script>

                    <h1 class='text-center hide'>หน้า | เพิ่มการจองใหม่</h1>
                    <?php
                                    if ($level == 'non-supervisor') {
                                        $result = $db_con->query(
                                            "SELECT * FROM booking WHERE for_staff_level = 'non-supervisor' or for_staff_level = 'supervisor' "
                                        );
                                    } elseif ($level == '' || $level == 'non') {
                                        $result = $db_con->query(
                                            "SELECT * FROM booking WHERE for_staff_level = '' "
                                        );
                                        if ($level == '' || $level == 'non') {
                                            echo "<h5><font color='red'> *ยังไม่สามารถจองได้ *</font></h5></p><br>";
                                        }
                                    } else {
                                        $result = $db_con->query(
                                            "SELECT * FROM booking WHERE for_staff_level = 'supervisor' or for_staff_level = 'non-supervisor'"
                                        );
                                    }

                                    if ($result->num_rows > 0) {
                                        // include("booking-types.php");
                                        $rs = $result->fetch_object();
                                    ?>
                    <div class='extra-sm'>
                        <div class='row'>

                            <div class='col-md-10 mb-2 mx-auto'>

                                <form name='frmMain' action='request.php' method='post' class='mb-5' id='request-form'>
                                    <?php
                                                        echo "<input type='hidden' name='staff_id' value='$id'>
            <input type='hidden' name='booking_id' value='$rs->booking_id '>
            <input type='hidden' name='Faculty_b' value='$Faculty '>
            <input type='hidden' name='fnamelname' value='$fname1 $lname1 '>";
                                                        ?>
                                    <label for='booking-type'>ห้อง/โต๊ะ</label>
                                    <font color='red' class='extra-sm'> * </font>
                                    <div class='row mb-2'>
                                        <div class='col-md-5 mb-md-2'>


                                            <select OnChange="resutName(this.value);" class='extra-sm'
                                                name='booking_type' class='form-control' required>";
                                                <option>- เลือกห้อง/โต๊ะ -</option>
                                                <?php
                                                                while ($row = $result->fetch_object()) {
                                                                    echo "<option  value='$row->booking_type ลำดับที่ $row->Room_number   ตึก $row->building   ชั้น $row->class   ที่นั่ง $row->Capacity_person คน   $row->Room_details   $row->booking_id''>$row->booking_type ลำดับที่ $row->Room_number </option>";
                                                                }
                                                                echo '</select></div>';
                                                            }
                                                                ?>
                                                <div class='col-md-3 mb-md-2'>
                                                    <input class='form-control' name="txtbooking_type" type="hidden"
                                                        readonly required>
                                                    <input class='form-control' name="txtbuilding" type="text" readonly
                                                        required>
                                                </div>

                                                <div class='col-md-2 mb-md-2'>
                                                    <input class='form-control' name="txtclass" type="text" min="1"
                                                        max="" readonly required>
                                                </div>
                                                <div class='col-md-2 mb-md-'>
                                                    <input class='form-control' name="myfile" type="hidden" readonly
                                                        required>
                                                    <input class='form-control' name="txtCapacity_person" type="text"
                                                        readonly required>
                                                </div>
                                        </div>
                                        <hr>
                                        <?php
                                                        $min = date('Y-m-d H:i:s');


                                                        echo " <div class='row mb-2'>
    <div class='col-md-6 mb-md-2'>
    <label for='start'>วันเวลาที่เริ่มต้น</label><font color='red'> * </font>
        <input type='datetime-local' name='booking_start_date' min='$min' id='start' class='form-control' required>
        </div>
        <div class='col-md-6 mb-md-2'>
        <label for='end'>วันเวลาที่สิ้นสุด</label><font color='red'> * </font>
        <input type='datetime-local' name='booking_end_date' id='end' min='$min' class='form-control' required>

        </div> </div>
        <hr>
        <div class='row mb-2'>
    <div class='col-md-4 mb-md-2'>
       <label>จำนวนคนใช้ห้อง</label><font color='red'> * </font>
       <select class='extra-sm'class='form-control' type='text' name='numberp' required>";
                                                        for ($i = 1; $i < 1000; $i++) {
                                                            echo "<option value='$i'>$i</option>";
                                                        }
                                                        echo "</select></div> 
    <div class='col-md-8 mb-md-2'>
    <label >จุดประสงค์การเข้าใช้งาน </label><font color='red'> * </font>
      
    <textarea class='form-control' type='text' placeholder='โปรดป้อนรายละเอียดในการเข้าใช้งาน' name='purpose' required  rows='3' ></textarea>
      <small class='error' id='error'></small>
     
    </div> </div><hr>";

                                                        echo " 
     <label >รายละเอียด/อุปกรณ์ </label><font color='red'> </font><br>
    <div  class='row mb-2'>
            <div class='col-md-12 mb-md-2'>
            

            <textarea  name='equipment' class='form-control' type='text' title=''required  rows='3' readonly></textarea>
            
            </div>

            </div> 

        <hr> 



        <div class='text-center'>
        <button class='btn btn-primary' type='submit' name='request'>
        ขอจอง</button>
        </div>
        <hr>
        <font  class='extra-sm' color='red' >* <b>หมายเหตุ</b> สำหรับการจองใช้ห้องที่อยู่ใน<u><b>ตัวอาคาร</b></u>ควรจองห้องล่วงหน้าอย่างน้อย 2 วัน ระบบจะปรับสถานะเป็น <u><b>ไม่อนุมัติ</b></u> ทันทีกรุณาติดต่อเจ้าหน้าที่ตามเบอร์โทรศัพท์ด้านล่าง</font>
        </div></form></div></div> </div> ";
                                                    }  ?>


                                        <?php } elseif ($level == 'non-supervisor') { ?>

                                        <?php if (isset($_GET['book']) && !empty($_GET['book'])) {


                                                        ?>
                                        <script language="JavaScript">
                                        function resutName(strCusName) {
                                            frmMain.txtbooking_type.value = strCusName.split("   ")[0];
                                            frmMain.txtbuilding.value = strCusName.split("   ")[1];
                                            frmMain.txtclass.value = strCusName.split("   ")[2];
                                            frmMain.txtCapacity_person.value = strCusName.split("   ")[3];
                                            frmMain.equipment.value = strCusName.split("   ")[4];
                                            frmMain.myfile.value = strCusName.split("   ")[5];


                                        }
                                        </script>

                                        <h1 class='text-center hide'>หน้า | เพิ่มการจองใหม่</h1>
                                        <?php
                                                            if ($level == 'non-supervisor') {
                                                                $result = $db_con->query(
                                                                    "SELECT * FROM booking WHERE for_staff_level = 'non-supervisor' or for_staff_level = 'supervisor' "
                                                                );
                                                            } elseif ($level == '' || $level == 'non') {
                                                                $result = $db_con->query(
                                                                    "SELECT * FROM booking WHERE for_staff_level = '' "
                                                                );
                                                                if ($level == '' || $level == 'non') {
                                                                    echo "<h5><font color='red'> *ยังไม่สามารถจองได้ *</font></h5></p><br>";
                                                                }
                                                            } else {
                                                                $result = $db_con->query(
                                                                    "SELECT * FROM booking WHERE for_staff_level = 'supervisor' or for_staff_level = 'non-supervisor'"
                                                                );
                                                            }

                                                            if ($result->num_rows > 0) {
                                                                // include("booking-types.php");
                                                                $rs = $result->fetch_object();
                                                            ?>
                                        <div class='extra-sm'>
                                            <div class='row'>

                                                <div class='col-md-10 mb-2 mx-auto'>

                                                    <form name='frmMain' action='request.php' method='post' class='mb-5'
                                                        id='request-form'>
                                                        <?php
                                                                                echo "<input type='hidden' name='staff_id' value='$id'>
            <input type='hidden' name='booking_id' value='$rs->booking_id '>
            <input type='hidden' name='Faculty_b' value='$Faculty '>
            <input type='hidden' name='fnamelname' value='$fname1 $lname1 '>";
                                                                                ?>
                                                        <label for='booking-type'>ห้อง/โต๊ะ</label>
                                                        <font color='red' class='extra-sm'> * </font>
                                                        <div class='row mb-2'>
                                                            <div class='col-md-5 mb-md-2'>


                                                                <select OnChange="resutName(this.value);"
                                                                    class='extra-sm' name='booking_type'
                                                                    class='form-control' required>";
                                                                    <?php
                                                                                            $book = $_GET['book'];
                                                                                            $sql2 = "SELECT * FROM booking WHERE id='$book' ";
                                                                                            $result2 = mysqli_query($db_con, $sql2);
                                                                                            $rows = mysqli_fetch_array($result2);
                                                                                            extract($rows);

                                                                                            echo "<option  value='$booking_type ลำดับที่ $Room_number   ตึก $building   ชั้น $class   ที่นั่ง $Capacity_person คน   $Room_details   $booking_id''>$booking_type ลำดับที่ $Room_number </option>";
                                                                                            ?>

                                                                    <?php
                                                                                        while ($row = $result->fetch_object()) {
                                                                                            echo "<option  value='$row->booking_type ลำดับที่ $row->Room_number   ตึก $row->building   ชั้น $row->class   ที่นั่ง $row->Capacity_person คน   $row->Room_details   $row->booking_id''>$row->booking_type ลำดับที่ $row->Room_number </option>";
                                                                                        }
                                                                                        echo '</select></div>';
                                                                                    }
                                                                                        ?>
                                                                    <div class='col-md-3 mb-md-2'>
                                                                        <input class='form-control'
                                                                            value="<?php echo  $booking_type . " " . "ลำดับที่" . " " . $Room_number; ?>"
                                                                            name="txtbooking_type" type="hidden"
                                                                            required readonly>
                                                                        <input class='form-control'
                                                                            value="<?php echo "ตึก" . " " . $building; ?>"
                                                                            name="txtbuilding" type="text" required
                                                                            readonly>
                                                                    </div>

                                                                    <div class='col-md-2 mb-md-2'>
                                                                        <input class='form-control'
                                                                            value="<?php echo "ชั้น" . " " . $class; ?>"
                                                                            name="txtclass" type="text" min="1" max=""
                                                                            required readonly>
                                                                    </div>
                                                                    <div class='col-md-2 mb-md-'>
                                                                        <input class='form-control'
                                                                            value="<?php echo $booking_id; ?>"
                                                                            name="myfile" type="hidden" required
                                                                            readonly>
                                                                        <input class='form-control'
                                                                            value="<?php echo "ที่นั่ง" . " " . $Capacity_person . " " . "คน"; ?>"
                                                                            name="txtCapacity_person" type="text"
                                                                            required readonly>
                                                                    </div>
                                                            </div>
                                                            <hr>
                                                            <?php
                                                                                    //YYYY-MM-DDTHH:mm
                                                                                    //Y-m-d H:i:s
                                                                                    $min = date('Y-m-d H:i:s');
                                                                                    echo " <div class='row mb-2'>
    <div class='col-md-6 mb-md-2'>
    <label for='start'>วันเวลาที่เริ่มต้น</label><font color='red'> * </font>
        <input type='datetime-local' name='booking_start_date' min='$min' id='start' class='form-control' required>
        </div>
        <div class='col-md-6 mb-md-2'>
        <label for='end'>วันเวลาที่สิ้นสุด</label><font color='red'> * </font>
        <input type='datetime-local' name='booking_end_date' id='end' min='$min' class='form-control' required>

        </div> </div>
        <hr>
        <div class='row mb-2'>
    <div class='col-md-4 mb-md-2'>
       <label>จำนวนคนใช้ห้อง</label><font color='red'> * </font>
       <select class='extra-sm'class='form-control' type='text' name='numberp' required>";
                                                                                    for ($i = 1; $i < 1000; $i++) {
                                                                                        echo "<option value='$i'>$i</option>";
                                                                                    }
                                                                                    echo "</select></div> 
    <div class='col-md-8 mb-md-2'>
    <label >จุดประสงค์การเข้าใช้งาน </label><font color='red'> * </font>
      
    <textarea class='form-control' type='text' placeholder='โปรดป้อนรายละเอียดในการเข้าใช้งาน' name='purpose' required  rows='3' ></textarea>
      <small class='error' id='error'></small>
     
    </div> </div><hr>";

                                                                                    echo " 
     <label >รายละเอียด/อุปกรณ์ </label><font color='red'> </font><br>
    <div  class='row mb-2'>
            <div class='col-md-12 mb-md-2'>
            

            <textarea value='$Room_details' name='equipment' class='form-control' type='text' title=''required  rows='3' readonly>$Room_details</textarea>
            
            </div>

            </div> 

        <hr> 



        <div class='text-center'>
        <button type='submit' name='request' class='btn btn-primary' >
        ขอจอง</button>
        </div> 
        <hr>
        <font  class='extra-sm' color='red' >* <b>หมายเหตุ</b> สำหรับการจองใช้ห้องที่อยู่ใน<u><b>ตัวอาคาร</b></u>ควรจองห้องล่วงหน้าอย่างน้อย 2 วัน ระบบจะปรับสถานะเป็น <u><b>ไม่อนุมัติ</b></u> ทันทีกรุณาติดต่อเจ้าหน้าที่ตามเบอร์โทรศัพท์ด้านล่าง</font>
        </div></form></div></div> </div> ";
                                                                                } else { ?>



                                                            <script language="JavaScript">
                                                            function resutName(strCusName) {
                                                                frmMain.txtbooking_type.value = strCusName.split("   ")[
                                                                    0];
                                                                frmMain.txtbuilding.value = strCusName.split("   ")[1];
                                                                frmMain.txtclass.value = strCusName.split("   ")[2];
                                                                frmMain.txtCapacity_person.value = strCusName.split(
                                                                    "   ")[3];
                                                                frmMain.equipment.value = strCusName.split("   ")[4];
                                                                frmMain.myfile.value = strCusName.split("   ")[5];


                                                            }
                                                            </script>

                                                            <h1 class='text-center hide'>หน้า | เพิ่มการจองใหม่</h1>
                                                            <?php
                                                                                    if ($level == 'non-supervisor') {
                                                                                        $result = $db_con->query(
                                                                                            "SELECT * FROM booking WHERE for_staff_level = 'non-supervisor' or for_staff_level = 'supervisor' "
                                                                                        );
                                                                                    } elseif ($level == '' || $level == 'non') {
                                                                                        $result = $db_con->query(
                                                                                            "SELECT * FROM booking WHERE for_staff_level = '' "
                                                                                        );
                                                                                        if ($level == '' || $level == 'non') {
                                                                                            echo "<h5><font color='red'> *ยังไม่สามารถจองได้ *</font></h5></p><br>";
                                                                                        }
                                                                                    } else {
                                                                                        $result = $db_con->query(
                                                                                            "SELECT * FROM booking WHERE for_staff_level = 'supervisor' or for_staff_level = 'non-supervisor'"
                                                                                        );
                                                                                    }

                                                                                    if ($result->num_rows > 0) {
                                                                                        // include("booking-types.php");
                                                                                        $rs = $result->fetch_object();
                                                                                    ?>
                                                            <div class='extra-sm'>
                                                                <div class='row'>

                                                                    <div class='col-md-10 mb-2 mx-auto'>

                                                                        <form name='frmMain' action='request.php'
                                                                            method='post' class='mb-5'
                                                                            id='request-form'>
                                                                            <?php
                                                                                                        echo "<input type='hidden' name='staff_id' value='$id'>
            <input type='hidden' name='booking_id' value='$rs->booking_id '>
            <input type='hidden' name='Faculty_b' value='$Faculty '>
            <input type='hidden' name='fnamelname' value='$fname1 $lname1 '>";
                                                                                                        ?>
                                                                            <label for='booking-type'>ห้อง/โต๊ะ</label>
                                                                            <font color='red' class='extra-sm'> *
                                                                            </font>
                                                                            <div class='row mb-2'>
                                                                                <div class='col-md-5 mb-md-2'>


                                                                                    <select
                                                                                        OnChange="resutName(this.value);"
                                                                                        class='extra-sm'
                                                                                        name='booking_type'
                                                                                        class='form-control' required>";
                                                                                        <option>- เลือกห้อง/โต๊ะ -
                                                                                        </option>
                                                                                        <?php
                                                                                                                while ($row = $result->fetch_object()) {
                                                                                                                    echo "<option  value='$row->booking_type ลำดับที่ $row->Room_number   ตึก $row->building   ชั้น $row->class   ที่นั่ง $row->Capacity_person คน   $row->Room_details   $row->booking_id'>$row->booking_type ลำดับที่ $row->Room_number </option>";
                                                                                                                }
                                                                                                                echo '</select></div>';
                                                                                                            }
                                                                                                                ?>
                                                                                        <div class='col-md-3 mb-md-2'>
                                                                                            <input class='form-control'
                                                                                                name="txtbooking_type"
                                                                                                type="hidden" required
                                                                                                readonly>
                                                                                            <input class='form-control'
                                                                                                name="txtbuilding"
                                                                                                type="text" readonly
                                                                                                required>
                                                                                        </div>

                                                                                        <div class='col-md-2 mb-md-2'>
                                                                                            <input class='form-control'
                                                                                                name="txtclass"
                                                                                                type="text" min="1"
                                                                                                max="" readonly
                                                                                                required>
                                                                                        </div>
                                                                                        <div class='col-md-2 mb-md-'>
                                                                                            <input class='form-control'
                                                                                                name="myfile"
                                                                                                type="hidden" readonly
                                                                                                required>
                                                                                            <input class='form-control'
                                                                                                name="txtCapacity_person"
                                                                                                type="text" readonly
                                                                                                required>
                                                                                        </div>
                                                                                </div>
                                                                                <hr>
                                                                                <?php
                                                                                                        //YYYY-MM-DDTHH:mm
                                                                                                        //Y-m-d H:i:s
                                                                                                        $min = date('Y-m-d H:i:s');
                                                                                                        echo " <div class='row mb-2'>
    <div class='col-md-6 mb-md-2'>
    <label for='start'>วันเวลาที่เริ่มต้น</label><font color='red'> * </font>
        <input type='datetime-local' name='booking_start_date' min='$min' id='start' class='form-control' required>
        </div>
        <div class='col-md-6 mb-md-2'>
        <label for='end'>วันเวลาที่สิ้นสุด</label><font color='red'> * </font>
        <input type='datetime-local' name='booking_end_date' id='end' min='$min' class='form-control' required>

        </div> </div>
        <hr>
        <div class='row mb-2'>
    <div class='col-md-4 mb-md-2'>
       <label>จำนวนคนใช้ห้อง</label><font color='red'> * </font>
       <select class='extra-sm'class='form-control' type='text' name='numberp' required>";
                                                                                                        for ($i = 1; $i < 1000; $i++) {
                                                                                                            echo "<option value='$i'>$i</option>";
                                                                                                        }
                                                                                                        echo "</select></div> 
    <div class='col-md-8 mb-md-2'>
    <label >จุดประสงค์การเข้าใช้งาน </label><font color='red'> * </font>
      
    <textarea class='form-control' type='text' placeholder='โปรดป้อนรายละเอียดในการเข้าใช้งาน' name='purpose' required  rows='3' ></textarea>
      <small class='error' id='error'></small>
     
    </div> </div><hr>";

                                                                                                        echo " 
     <label >รายละเอียด/อุปกรณ์ </label><font color='red'> </font><br>
    <div  class='row mb-2'>
            <div class='col-md-12 mb-md-2'>
            

            <textarea  name='equipment' class='form-control' type='text' title=''required  rows='3' readonly></textarea>
            
            </div>

            </div> 

        <hr> 



        <div class='text-center'>
        <button type='submit' name='request' class='btn btn-primary' >
        ขอจอง</button>
        </div> 
        <hr>
        <font  class='extra-sm' color='red' >* <b>หมายเหตุ</b> สำหรับการจองใช้ห้องที่อยู่ใน<u><b>ตัวอาคาร</b></u>ควรจองห้องล่วงหน้าอย่างน้อย 2 วัน ระบบจะปรับสถานะเป็น <u><b>ไม่อนุมัติ</b></u> ทันทีกรุณาติดต่อเจ้าหน้าที่ตามเบอร์โทรศัพท์ด้านล่าง</font>
        </div></form></div></div> </div> ";
                                                                                                    }                ?>


                                                                                <?php } elseif ($level == '') { ?>

                                                                                <td class="text-center mb-m-2">
                                                                                    ไม่มีสิทธิ์</td>

                                                                                <?php
                                                                                                        echo "<script type='text/javascript'>";
                                                                                                        echo "alert('ท่านยังไม่ได้รับสิทธิ์เข้าถึงหน้านี้ !!');";
                                                                                                        echo 'window.history.back(1);';
                                                                                                        echo '</script>';
                                                                                                        ?>
                                                                                <?php } elseif ($level == 'non') { ?>

                                                                                <td class="text-center mb-m-2">
                                                                                    ไม่มีสิทธิ์</td>

                                                                                <?php
                                                                                                        echo "<script type='text/javascript'>";
                                                                                                        echo "alert('ท่านยังไม่ได้รับสิทธิ์เข้าถึงหน้านี้ !!');";
                                                                                                        echo 'window.history.back(1);';
                                                                                                        echo '</script>';
                                                                                                        ?>
                                                                                <?php }
                                                                                            } ?>


                                                                                <?php if (isset($_SESSION['admin-user']) && $_SESSION['admin-user'] !== '') { ?>

                                                                                <script language="JavaScript">
                                                                                function resutName(strCusName) {
                                                                                    frmMain.txtbooking_type.value =
                                                                                        strCusName.split("   ")[0];
                                                                                    frmMain.txtbuilding.value =
                                                                                        strCusName.split("   ")[1];
                                                                                    frmMain.txtclass.value = strCusName
                                                                                        .split("   ")[2];
                                                                                    frmMain.txtCapacity_person.value =
                                                                                        strCusName.split("   ")[3];
                                                                                    frmMain.equipment.value = strCusName
                                                                                        .split("   ")[4];
                                                                                    frmMain.myfile.value = strCusName
                                                                                        .split("   ")[5];


                                                                                }
                                                                                </script>

                                                                                <h1 class='text-center hide'>หน้า |
                                                                                    เพิ่มการจองใหม่</h1>
                                                                                <?php
                                                                                                    if ($level == 'non-supervisor') {
                                                                                                        $result = $db_con->query(
                                                                                                            "SELECT * FROM booking WHERE for_staff_level = 'non-supervisor' or for_staff_level = 'supervisor' "
                                                                                                        );
                                                                                                    } elseif ($level == '' || $level == 'non') {
                                                                                                        $result = $db_con->query(
                                                                                                            "SELECT * FROM booking WHERE for_staff_level = '' "
                                                                                                        );
                                                                                                        if ($level == '' || $level == 'non') {
                                                                                                            echo "<h5><font color='red'> *ยังไม่สามารถจองได้ *</font></h5></p><br>";
                                                                                                        }
                                                                                                    } else {
                                                                                                        $result = $db_con->query(
                                                                                                            "SELECT * FROM booking WHERE for_staff_level = 'supervisor' or for_staff_level = 'non-supervisor'"
                                                                                                        );
                                                                                                    }

                                                                                                    if ($result->num_rows > 0) {
                                                                                                        // include("booking-types.php");
                                                                                                        $rs = $result->fetch_object();
                                                                                                    ?>
                                                                                <div class='extra-sm'>
                                                                                    <div class='row'>

                                                                                        <div
                                                                                            class='col-md-10 mb-2 mx-auto'>

                                                                                            <form name='frmMain'
                                                                                                action='request.php'
                                                                                                method='post'
                                                                                                class='mb-5'
                                                                                                id='request-form'>
                                                                                                <?php
                                                                                                                        echo "<input type='hidden' name='staff_id' value='$id'>
            <input type='hidden' name='booking_id' value='$rs->booking_id '>
            <input type='hidden' name='Faculty_b' value='$Faculty '>
            <input type='hidden' name='fnamelname' value='$fname1 $lname1 '>";
                                                                                                                        ?>
                                                                                                <label
                                                                                                    for='booking-type'>ห้อง/โต๊ะ</label>
                                                                                                <font color='red'
                                                                                                    class='extra-sm'> *
                                                                                                </font>
                                                                                                <div class='row mb-2'>
                                                                                                    <div
                                                                                                        class='col-md-5 mb-md-2'>


                                                                                                        <select
                                                                                                            OnChange="resutName(this.value);"
                                                                                                            class='extra-sm'
                                                                                                            name='booking_type'
                                                                                                            class='form-control'
                                                                                                            required>";
                                                                                                            <option>-
                                                                                                                เลือกห้อง/โต๊ะ
                                                                                                                -
                                                                                                            </option>
                                                                                                            <?php
                                                                                                                                while ($row = $result->fetch_object()) {
                                                                                                                                    echo "<option  value='$row->booking_type ลำดับที่ $row->Room_number   ตึก $row->building   ชั้น $row->class   ที่นั่ง $row->Capacity_person คน   $row->Room_details   $row->booking_id''>$row->booking_type ลำดับที่ $row->Room_number </option>";
                                                                                                                                }
                                                                                                                                echo '</select></div>';
                                                                                                                            }
                                                                                                                                ?>
                                                                                                            <div
                                                                                                                class='col-md-3 mb-md-2'>
                                                                                                                <input
                                                                                                                    class='form-control'
                                                                                                                    name="txtbooking_type"
                                                                                                                    type="hidden"
                                                                                                                    readonly
                                                                                                                    required>
                                                                                                                <input
                                                                                                                    class='form-control'
                                                                                                                    name="txtbuilding"
                                                                                                                    type="text"
                                                                                                                    readonly
                                                                                                                    required>
                                                                                                            </div>

                                                                                                            <div
                                                                                                                class='col-md-2 mb-md-2'>
                                                                                                                <input
                                                                                                                    class='form-control'
                                                                                                                    name="txtclass"
                                                                                                                    type="text"
                                                                                                                    min="1"
                                                                                                                    max=""
                                                                                                                    readonly
                                                                                                                    required>
                                                                                                            </div>
                                                                                                            <div
                                                                                                                class='col-md-2 mb-md-'>
                                                                                                                <input
                                                                                                                    class='form-control'
                                                                                                                    name="myfile"
                                                                                                                    type="hidden"
                                                                                                                    readonly
                                                                                                                    required>
                                                                                                                <input
                                                                                                                    class='form-control'
                                                                                                                    name="txtCapacity_person"
                                                                                                                    type="text"
                                                                                                                    readonly
                                                                                                                    required>
                                                                                                            </div>
                                                                                                    </div>
                                                                                                    <hr>
                                                                                                    <?php
                                                                                                                            $min = date('Y-m-d H:i:s');


                                                                                                                            echo " <div class='row mb-2'>
    <div class='col-md-6 mb-md-2'>
    <label for='start'>วันเวลาที่เริ่มต้น</label><font color='red'> * </font>
        <input type='datetime-local' name='booking_start_date' min='$min' id='start' class='form-control' required>
        </div>
        <div class='col-md-6 mb-md-2'>
        <label for='end'>วันเวลาที่สิ้นสุด</label><font color='red'> * </font>
        <input type='datetime-local' name='booking_end_date' id='end' min='$min' class='form-control' required>

        </div> </div>
        <hr>
        <div class='row mb-2'>
    <div class='col-md-4 mb-md-2'>
       <label>จำนวนคนใช้ห้อง</label><font color='red'> * </font>
       <select class='extra-sm'class='form-control' type='text' name='numberp' required>";
                                                                                                                            for ($i = 1; $i < 1000; $i++) {
                                                                                                                                echo "<option value='$i'>$i</option>";
                                                                                                                            }
                                                                                                                            echo "</select></div> 
    <div class='col-md-8 mb-md-2'>
    <label >จุดประสงค์การเข้าใช้งาน </label><font color='red'> * </font>
      
    <textarea class='form-control' type='text' placeholder='โปรดป้อนรายละเอียดในการเข้าใช้งาน' name='purpose' required  rows='3' ></textarea>
      <small class='error' id='error'></small>
     
    </div> </div><hr>";

                                                                                                                            echo " 
     <label >รายละเอียด/อุปกรณ์ </label><font color='red'> </font><br>
    <div  class='row mb-2'>
            <div class='col-md-12 mb-md-2'>
            

            <textarea  name='equipment' class='form-control' type='text' title=''required  rows='3' readonly></textarea>
            
            </div>

            </div> 

        <hr> 



        <div class='text-center'>
        <button class='btn btn-primary' type='submit' name='request'>
        ขอจอง</button>
        </div>
        <hr>
        <font  class='extra-sm' color='red' >* <b>หมายเหตุ</b> สำหรับการจองใช้ห้องที่อยู่ใน<u><b>ตัวอาคาร</b></u>ควรจองห้องล่วงหน้าอย่างน้อย 2 วัน ระบบจะปรับสถานะเป็น <u><b>ไม่อนุมัติ</b></u> ทันทีกรุณาติดต่อเจ้าหน้าที่ตามเบอร์โทรศัพท์ด้านล่าง</font>
        </div></form></div></div> </div> ";



                                                                                                                            ?>


                                                                                                    <?php } ?>