<?php include 'db_connect.php';
// เรียกใช้งานไฟล์เชื่อมต่อกับฐานข้อมูล
?>
<h1 class='text-center hide'>หน้า | แผนภาพสถิติผู้มาใช้บริการ</h1>
<?php if (isset($_SESSION['staff-user']) && $_SESSION['staff-user'] !== '') { ?>
    <?php if ($level == 'supervisor') { ?>
        <div class="row">
        <div class="col-lg-12">
            <h3 class="card-header alert-success text-black"><i class="fa fa-bar-chart fa-fw"></i> แผนภาพสถิติผู้มาใช้บริการ</h3>
        </div>
    </div>

    <!-- /.row -->
    <div class="row">

        <div class="col-lg-12">
            <div class="panel panel-default">

                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="card-header ">

                        <a href="../pages/report.php" class="btn btn-primary btn-sm  "> <i class="fa fa-bar-chart"></i> แผนภาพรายวัน</a>
                        <a href="../pages/report2.php" class="btn btn-success btn-sm  "> <i class="fa fa-bar-chart"></i> แผนภาพรายเดือน</a>
                        <a href="../pages/report3.php" class="btn btn-info btn-sm  "> <i class="fa fa-bar-chart"></i> แผนภาพรายปี</a>

                    </div>
                </div>
                <!-- /.panel-body -->
            </div><br>

            <!-- /.panel -->
        </div>

    </div>
    <!-- /.row -->
        <?php
        $con = connect();

        mysqli_query($con, "SET NAMES 'utf8' ");

        $query = "
SELECT COUNT(booking_id) AS totol, DATE_FORMAT(booking_start_date, '%Y') AS booking_start_date
FROM booking_applications 
GROUP BY DATE_FORMAT(booking_start_date, '%Y%')
";
        $result = mysqli_query($con, $query);
        $resultchart = mysqli_query($con, $query);
        //for chart
        $datesave = [];
        $totol = [];

        while ($rs = mysqli_fetch_array($resultchart)) {
            $datesave[] = "\"" . $rs['booking_start_date'] . "\"";
            $totol[] = "\"" . $rs['totol'] . "\"";
        }
        $datesave = implode(',', $datesave);
        $totol = implode(',', $totol);
        ?>
        <h3 align="center">รายงานการจองในแบบกราฟแท่งรายปี</h3>
        <table class="table table-bordered table-responsive-sm w-50" width="200" border="1" cellpadding="0" cellspacing="0" align="center">
            <thead>
                <tr>
                    <th width="10%">ปี</th>
                    <th width="10%">ยอดจอง</th>
                </tr>
            </thead>
            <?php while ($row = mysqli_fetch_array($result)) { ?>
                <tr>
                    <td align="center"><?php echo $row['booking_start_date']; ?></td>
                    <td align="right"><?php echo number_format(
                                            $row['totol']
                                        ); ?></td>
                </tr>
            <?php } ?>
        </table>
        <?php mysqli_close($con); ?>

        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js"></script>
        <hr>
        <p align="center">
            <!--devbanban.com-->
            <canvas id="myChart" width="800px" height="300px"></canvas>
            <script>
                var ctx = document.getElementById("myChart").getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: [<?php echo $datesave; ?>

                        ],
                        datasets: [{
                            label: 'รายงานภาพรวม แยกตามปี (คน)',
                            data: [<?php echo $totol; ?>],
                            backgroundColor: [
                                'rgba(75, 192, 192, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(75, 192, 192, 1)'
                            ],
                            borderColor: [

                            ],
                            borderWidth: 2
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
            </script>
        </p>
        <?php
        $connect = connect();
        $query =
            'SELECT booking_type, count(*) as booking_start_date FROM booking_applications GROUP BY booking_type';
        $result = mysqli_query($connect, $query);
        ?>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            google.charts.load('current', {
                'packages': ['corechart']
            });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    ['booking', 'Number'],
                    <?php while ($row = mysqli_fetch_array($result)) {
                        echo "['" .
                            $row['booking_type'] .
                            "', " .
                            $row['booking_start_date'] .
                            '],';
                    } ?>
                ]);
                var options = {
                    title: 'แสดงร้อยล่ะของห้อง/โต๊ะการจองทั้งหมด',
                    //is3D:true,  
                    pieHole: 0.0,
                    'width': 550,
                    'height': 400
                };
                var chart = new google.visualization.PieChart(document.getElementById('piechart'));
                chart.draw(data, options);
            }
        </script>
        <br /><br />
        <div align="center">
            <h3 align="center">รายงานสถิติห้อง/โต๊ะแบบแผนภูมิวงกลม</h3>
            <br />
            <div id="piechart"></div>
        </div>
        <br>
        <!-- <?php
                $mysqli = connect(); // เชื่อมต่อกับฐานข้อมูล
                $sql = 'SELECT * FROM booking ORDER BY id  ';
                $result = $mysqli->query($sql);
                ?>
                                    </tbody>
                                </table> -->
        <?php
        $connect1 = connect();
        $query1 =
            'SELECT Faculty_b, count(*) as booking_start_date FROM booking_applications GROUP BY Faculty_b';
        $result1 = mysqli_query($connect1, $query1);
        ?>


        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            google.charts.load('current', {
                'packages': ['corechart']
            });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var data1 = google.visualization.arrayToDataTable([
                    ['booking', 'Number'],
                    <?php while ($row = mysqli_fetch_array($result1)) {
                        echo "['" .
                            $row['Faculty_b'] .
                            "', " .
                            $row['booking_start_date'] .
                            '],';
                    } ?>
                ]);
                var options1 = {
                    title: 'แสดงร้อยล่ะของการจองแต่ละคณะ/หน่วยงาน',
                    //is3D:true,  
                    pieHole: 0.0,
                    'width': 550,
                    'height': 400
                };
                var chart = new google.visualization.PieChart(document.getElementById('piechart1'));
                chart.draw(data1, options1);
            }
        </script>

        <br /><br />
        <div align="center">
            <h3 align="center">รายงานสถิติคณะ/หน่วยงานแบบแผนภูมิวงกลม</h3>
            <br />
            <div id="piechart1"></div>
        </div>
        <br>
    <?php } elseif ($level == 'non-supervisor') { ?>

        <td class="text-center mb-m-2">ไม่มีสิทธิ์</td>
        <?php
        echo "<script type='text/javascript'>";
        echo "alert('เกิดข้อผิดพลาด ท่านไม่มีสิทธิ์ ระบบจะเก็บข้อมูลของท่านไว้  !!');";
        echo 'window.history.back(1);';
        echo '</script>';
        ?>
    <?php } elseif ($level == '') { ?>

        <td class="text-center mb-m-2">ไม่มีสิทธิ์</td>

        <?php
        echo "<script type='text/javascript'>";
        echo "alert('เกิดข้อผิดพลาด ท่านไม่มีสิทธิ์ ระบบจะเก็บข้อมูลของท่านไว้  !!');";
        echo 'window.history.back(1);';
        echo '</script>';
        ?>

    <?php } elseif ($level == 'non') { ?>

        <td class="text-center mb-m-2">ไม่มีสิทธิ์</td>

        <?php
        echo "<script type='text/javascript'>";
        echo "alert('เกิดข้อผิดพลาด ไม่มีสิทธิ์   !!');";
        echo 'window.history.back(1);';
        echo '</script>';
        ?>
<?php }
} ?>


<?php if (isset($_SESSION['admin-user']) && $_SESSION['admin-user'] !== '') { ?>
    <div class="row">
        <div class="col-lg-12">
            <h3 class="card-header alert-success text-black"><i class="fa fa-bar-chart fa-fw"></i> แผนภาพสถิติผู้มาใช้บริการ</h3>
        </div>
    </div>

    <!-- /.row -->
    <div class="row">

        <div class="col-lg-12">
            <div class="panel panel-default">

                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="card-header ">

                        <a href="../pages/report.php" class="btn btn-primary btn-sm"> <i class="fa fa-bar-chart"></i> แผนภาพรายวัน</a>
                        <a href="../pages/report2.php" class="btn btn-success btn-sm  "> <i class="fa fa-bar-chart"></i> แผนภาพรายเดือน</a>
                        <a href="../pages/report3.php" class="btn btn-info btn-sm  "> <i class="fa fa-bar-chart"></i> แผนภาพรายปี</a>

                    </div>
                </div>
                <!-- /.panel-body -->
            </div><br>

            <!-- /.panel -->
        </div>

    </div>
    <!-- /.row -->



    <?php
    $con = connect();
    mysqli_query($con, "SET NAMES 'utf8' ");
    $query = "
    SELECT COUNT(booking_id) AS totol, DATE_FORMAT(booking_start_date, '%Y') AS booking_start_date
    FROM booking_applications 
    GROUP BY DATE_FORMAT(booking_start_date, '%Y%')
    ";
    $result = mysqli_query($con, $query);
    $resultchart = mysqli_query($con, $query); //for chart
    $datesave = [];
    $totol = [];
    while ($rs = mysqli_fetch_array($resultchart)) {
        $datesave[] = "\"" . $rs['booking_start_date'] . "\"";
        $totol[] = "\"" . $rs['totol'] . "\"";
    }
    $datesave = implode(',', $datesave);
    $totol = implode(',', $totol);
    ?>

    <h3 align="center">รายงานการจองในแบบกราฟแท่งรายปี</h3>
    <table class="table table-bordered table-responsive-sm w-50" width="200" border="1" cellpadding="0" cellspacing="0" align="center">
        <thead>
            <tr>
                <th width="10%">ปี</th>
                <th width="10%">ยอดจอง</th>
            </tr>
        </thead>

        <?php while ($row = mysqli_fetch_array($result)) { ?>
            <tr>
                <td align="center"><?php echo $row['booking_start_date']; ?></td>
                <td align="right"><?php echo number_format(
                                        $row['totol']
                                    ); ?></td>
            </tr>
        <?php } ?>

    </table>
    <?php mysqli_close($con); ?>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js"></script>
    <hr>
    <p align="center">

        <!--devbanban.com-->

        <canvas id="myChart" width="800px" height="300px"></canvas>
        <script>
            var ctx = document.getElementById("myChart").getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: [<?php echo $datesave; ?>

                    ],
                    datasets: [{
                        label: 'รายงานภาพรวม แยกตามปี (คน)',
                        data: [<?php echo $totol; ?>],
                        backgroundColor: [
                            'rgba(75, 192, 192, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(75, 192, 192, 1)'

                        ],
                        borderColor: [


                        ],
                        borderWidth: 2
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        </script>
    </p>

    </html>
    <?php
    $connect = connect();
    $query =
        'SELECT booking_type, count(*) as booking_start_date FROM booking_applications GROUP BY booking_type';
    $result = mysqli_query($connect, $query);
    ?>


    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['booking', 'Number'],
                <?php while ($row = mysqli_fetch_array($result)) {
                    echo "['" .
                        $row['booking_type'] .
                        "', " .
                        $row['booking_start_date'] .
                        '],';
                } ?>
            ]);
            var options = {
                title: 'แสดงร้อยล่ะของห้อง/โต๊ะการจองทั้งหมด',
                //is3D:true,  
                pieHole: 0.0,
                'width': 550,
                'height': 400
            };
            var chart = new google.visualization.PieChart(document.getElementById('piechart'));
            chart.draw(data, options);
        }
    </script>

    <br /><br />
    <div align="center">
        <h3 align="center">รายงานสถิติห้อง/โต๊ะแบบแผนภูมิวงกลม</h3>
        <br />
        <div id="piechart"></div>
    </div>
    <br>
    <!-- <?php
            $mysqli = connect(); // เชื่อมต่อกับฐานข้อมูล
            $sql = 'SELECT * FROM booking ORDER BY id  ';
            $result = $mysqli->query($sql);
            ?>
              
                                        </tbody>
                                    </table> -->
    <?php
    $connect1 = connect();
    $query1 =
        'SELECT Faculty_b, count(*) as booking_start_date FROM booking_applications GROUP BY Faculty_b';
    $result1 = mysqli_query($connect1, $query1);
    ?>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data1 = google.visualization.arrayToDataTable([
                ['booking', 'Number'],
                <?php while ($row = mysqli_fetch_array($result1)) {
                    echo "['" .
                        $row['Faculty_b'] .
                        "', " .
                        $row['booking_start_date'] .
                        '],';
                } ?>
            ]);
            var options1 = {
                title: 'แสดงร้อยล่ะของการจองแต่ละคณะ/หน่วยงาน',
                //is3D:true,  
                pieHole: 0.0,
                'width': 550,
                'height': 400
            };
            var chart = new google.visualization.PieChart(document.getElementById('piechart1'));
            chart.draw(data1, options1);
        }
    </script>

    <br /><br />
    <div align="center">
        <h3 align="center">รายงานสถิติคณะ/หน่วยงานแบบแผนภูมิวงกลม</h3>
        <br />
        <div id="piechart1"></div>
    </div>

    <br>
<?php } ?>