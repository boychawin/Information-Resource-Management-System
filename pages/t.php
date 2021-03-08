  <!-- Bootstrap Core CSS -->
  <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

  <link rel="icon" type="image/png" href="../images/Snru_3.png" />

  <!-- DataTables CSS -->
  <link href="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

  <!-- DataTables Responsive CSS -->
  <link href="../bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">

  <!-- Date -->
  <link href="css/bootstrap-datetimepicker.css" rel="stylesheet">


  <!-- Morris Charts CSS -->
  <link href="../bower_components/morrisjs/morris.css" rel="stylesheet">


  <!-- Custom Fonts -->
  <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

  <!--fancybox -->
  <link rel="stylesheet" href="../fancy/jquery.fancybox.css" type="text/css" media="screen" />

  <!-- Optionally add helpers - button, thumbnail and/or media -->
  <link rel="stylesheet" href="../fancy/helpers/jquery.fancybox-buttons.css" type="text/css" media="screen" />

  <!-- fullcalendar -->
  <link href='../fullcalendar.css' rel='stylesheet' />
  <link href='../fullcalendar.print.css' rel='stylesheet' media='print' />

  <!-- jQuery -->
  <script src="../bower_components/jquery/dist/jquery.min.js"></script>

  <!-- Bootstrap Core JavaScript -->
  <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

  <!-- Metis Menu Plugin JavaScript -->
  <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

  <!-- Morris Charts JavaScript -->
  <script src="../bower_components/raphael/raphael-min.js"></script>
  <script src="../bower_components/morrisjs/morris.min.js"></script>





  <!-- DataTables JavaScript -->
  <script src="../bower_components/DataTables/media/js/jquery.dataTables.min.js"></script>
  <script src="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>




  <!-- Custom Theme JavaScript -->
  <script src='../lib/moment.min.js'></script>

  <script src='../fullcalendar.min.js'></script>


  <script src='../lang/th.js'></script>
  <script src="../fancy/jquery.fancybox.pack.js"></script>
  <script src="../fancy/helpers/jquery.fancybox-thumbs.js"></script>
  <script src="../fancy/helpers/jquery.fancybox-buttons.js"></script>

  <?php
    require_once __DIR__ . '\vendor\autoload.php';
    $defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
    $fontDirs = $defaultConfig['fontDir'];

    $defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
    $fontData = $defaultFontConfig['fontdata'];

    $mpdf = new \Mpdf\Mpdf([
        'fontDir' => array_merge($fontDirs, [__DIR__ . '\t']),
        'fontdata' => $fontData + [
            'sarabun' => [
                'R' => 'THSarabunNew.ttf',
                'I' => 'THSarabunNew Italic.ttf',
                'B' => 'THSarabunNew Bold.ttf',
                'BI' => 'THSarabunNew BoldItalic.ttf',
            ],
        ],
        'default_font' => 'sarabun',
    ]);
    ?>

  <div class="row">
      <div class="col-lg-12">
          <a href="tt.pdf" class="btn btn-primary  "> <i class="fa fa-print icon"></i> ดาวโหลดรายงานในรูปแบบ PDF</a>
          <?php ob_start(); ?>
          <h3 class="alert alert-success" class="page-header alert btn-info"><i class="fa fa-table"></i>
              รายงานคนใช้บริการ</h3>
      </div>
      <!-- /.col-lg-12 -->
  </div>
  <div class="row">
      <div class="col-lg-12">

          <div class="row">
              <div class="col-lg-12">
                  <div class="panel panel-default">



                      <br> <br>
                      <?php
    include 'db_connect.php'; // เรียกใช้งานไฟล์เชื่อมต่อกับฐานข้อมูล
    $mysqli = connect(); // เชื่อมต่อกับฐานข้อมูล
    ($sql = 'SELECT * FROM booking_applications ORDER BY id asc') or
        die('Error:' . mysqli_error());
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


                      <div class="panel-body">
                          <div class="dataTable_wrapper">
                              <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                  <thead>
                                      <tr>
                                          <th width="18%">ลำดับ</th>
                                          <th width="11%">เริ่ม</th>
                                          <th width="11%">สิ้นสุด</th>
                                          <th width="30%">จุดประสงค์การเข้าใช้งาน</th>

                                          <th width="10%">ห้อง</th>
                                          <th width="10%">สถานะ</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php while (
                                        $row = $result->fetch_object()
                                    ) { ?>
                                      <tr>
                                          <td class="center"><?php echo $row->id; ?> </td>
                                          <td class="center"><?php echo $row->booking_start_date; ?></td>
                                          <td class="center"><?php echo $row->booking_end_date; ?></td>

                                          <td class="center"><?php echo $row->purpose; ?></td>
                                          <td class="center"><?php echo $row->booking_type; ?></td>


                                          <td class="center"><?php
                                            if ($row->action == '') {
                                                echo 'รอยืนยัน';
                                            }
                                            if ($row->action == 'accept') {
                                                echo 'ได้รับการยืนยันแล้ว';
                                            }
                                            if ($row->action == 'reject') {
                                                echo 'การยืนยันถูกปฏิเสธ';
                                            } else {
                                                //echo $row->action;
                                            }
                                            ?> </td>





                                          <td class="center"></td>
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


  <?php
$html = ob_get_contents();
$mpdf->WriteHTML($html);
$mpdf->Output('tt.pdf');
ob_end_flush();
?>

  <a href="tt.pdf" class="btn btn-primary  "> <i class="fa fa-print icon"></i> ดาวโหลดรายงานในรูปแบบ PDF</a>