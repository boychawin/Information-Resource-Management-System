<?php
include 'db_connect.php'; // เรียกใช้งานไฟล์เชื่อมต่อกับฐานข้อมูล
$mysqli = connect(); // เชื่อมต่อกับฐานข้อมูล
//นับทั้งปี
$sql =
    'SELECT SUBSTR(booking_start_date,1,4) AS timeResult FROM booking_applications GROUP BY timeResult';
$result = $mysqli->query($sql);
//$total = $result->row;

while ($rs = $result->fetch_object()) {
    //echo $rs ->timeResult." - ";
    $a[] = $rs->timeResult; //จับยัดใส่อะเรย์
}
?>
<script>
$(function() {

    Morris.Bar({
        element: 'morris-bar-chart',
        data: [

            <?php for ($i = 3; $i <= count($a) - 1; $i++) { ?> {
                y: '<?php echo $a[$i]; ?>',

                <?php
      $sql2 = "SELECT booking_id AS carA, COUNT(booking_id) AS typecarResult FROM booking_applications WHERE booking_start_date like '%$a[$i]%' GROUP BY carA";
      $result2 = $mysqli->query($sql2);
      while ($rs2 = $result2->fetch_object()) {
        if ($rs2->carA == '1011') {
            echo "		a:'" . $rs2->typecarResult . "', ";
        }

        if ($rs2->carA == '1012') {
            echo " b: '" . $rs2->typecarResult . "', ";
        }

        if ($rs2->carA == '1013') {
            echo " c: '" . $rs2->typecarResult . "', ";
        }

        if ($rs2->carA == '1014') {
            echo " d: '" . $rs2->typecarResult . "', ";
        }

        if ($rs2->carA == '1015') {
            echo " e: '" . $rs2->typecarResult . "'";
        }

        if ($rs2->carA == '1016') {
            echo " f1: '" . $rs2->typecarResult . "'";
        }

        // if ($rs2->carA == '1041') {
        //     echo " f2: '" . $rs2->typecarResult . "'";
        // }

        // if ($rs2->carA == '1042') {
        //     echo " f3: '" . $rs2->typecarResult . "'";
        // }
        // if ($rs2->carA == '1043') {
        //     echo " f4: '" . $rs2->typecarResult . "'";
        // }

        // if ($rs2->carA == '1044') {
        //     echo " f5: '" . $rs2->typecarResult . "'";
        // }
        // if ($rs2->carA == '1045') {
        //     echo " f6: '" . $rs2->typecarResult . "'";
        // }
        // if ($rs2->carA == '1046') {
        //     echo " f7: '" . $rs2->typecarResult . "'";
        // }
        // if ($rs2->carA == '1047') {
        //     echo " f8: '" . $rs2->typecarResult . "'";
        // }
        // if ($rs2->carA == '1048') {
        //     echo " f9: '" . $rs2->typecarResult . "'";
        // }
        // if ($rs2->carA == '1049') {
        //     echo " f10: '" . $rs2->typecarResult . "'";
        // }
        // if ($rs2->carA == '10410') {
        //     echo " f11: '" . $rs2->typecarResult . "'";
        // }
        //, 'f2', 'f3', 'f4', 'f5', 'f6', 'f7', 'f8', 'f9', 'f10', 'f11''ห้องสืบค้นส่วนบุคคล 6', 'ห้องสืบค้นส่วนบุคคล 7', 'ห้องสืบค้นกลุ่มย่อย 1', 'ห้องสืบค้นกลุ่มย่อย 2'



        
    }
    ?>
            },
            <?php } ?>
        ],
        xkey: 'y',
        ykeys: ['a', 'b', 'c', 'd', 'e', 'f1'],
        labels: ['โต๊ะหน้าอาคารบรรณราชนครินทร์ 1', 'โต๊ะหน้าอาคารบรรณราชนครินทร์ 2',
            'โต๊ะหน้าอาคารบรรณราชนครินทร์ 3', 'โต๊ะหน้าอาคารบรรณราชนครินทร์ 4',
            'โต๊ะหน้าอาคารบรรณราชนครินทร์ 5', 'โต๊ะหน้าอาคารบรรณราชนครินทร์ 6'
        ],
        hideHover: 'auto',
        resize: true
    });

});
</script>