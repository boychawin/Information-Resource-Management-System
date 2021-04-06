<!DOCTYPE html>
<html>

<head>
    <title>หน้า | ปฏิทินผู้มาใช้บริการ</title>
    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="icon" type="image/png" href="https://boychawin.com/logo.png" />

    <!-- DataTables CSS -->
    <link href="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css"
        rel="stylesheet">

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
    <!-- script src="js/moment-with-locales.js"></script-->
    <script src="src/bootstrap-datetimepicker.js"></script>
    <script type="text/javascript">
    jQuery(document).ready(function() {
        //var currentLangCode = 'th';
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            eventLimit: true, // allow "more" link when too many events
            defaultDate: new Date(),
            //lang: currentLangCode,
            timezone: 'Asia/Bangkok',
            events: {
                url: 'data_events.php',
            },
            loading: function(bool) {
                $('#loading').toggle(bool);
            },

            eventClick: function(event) {
                if (event.url) {
                    $.fancybox({
                        'href': event.url,
                        'type': 'iframe',
                        'autoScale': false,
                        'openEffect': 'elastic',
                        'openSpeed': 'fast',
                        'closeEffect': 'elastic',
                        'closeSpeed': 'fast',
                        'closeBtn': true,
                        onClosed: function() {
                            parent.location.reload(true);
                        },
                        helpers: {
                            thumbs: {
                                width: 50,
                                height: 50
                            },

                            overlay: {
                                css: {
                                    'background': 'rgba(49, 176, 213, 0.7)'
                                }
                            }
                        }
                    });
                    return false;
                }
            },
        });
    });
    </script>
    <!-- <script>
  $(document).ready(function() {
      $('#dataTables-example').DataTable({
              responsive: true,
              "order": [[ 1, "desc" ]]
      });
  });
  </script> -->
    <style>
    #calendar {
        max-width: 900px;
        margin: 0 auto;
    }
    </style>
    <style type="text/css">
    .style17 {
        width: 19px;
    }

    .pagefooter {
        right: 0px;
        width: 150px;
        height: 120px;
        background-color: #F0F0F0;
        top: 400px;
        position: fixed;
        bottom: 0;
        position: fixed;
        min-height: 30px;
        background: #ffffff;
        border: 1px solid #ddd;
        -webkit-box-shadow: 2px 2px 5px 0px rgba(50, 50, 50, 0.52);
        -moz-box-shadow: 2px 2px 5px 0px rgba(50, 50, 50, 0.52);
        box-shadow: 2px 2px 5px 0px rgba(50, 50, 50, 0.52);
        border-top-left-radius: 5px;
        border-bottom-left-radius: 5px;
        padding: 5px;
        right: 0;
    }

    .event-warning {
        display: block;
        background-color: #e3bc08;
        width: 19px;
        height: 20px;
        margin-right: 2px;
        margin-bottom: 2px;
        -webkit-box-shadow: inset 0px 0px 5px 0px rgba(0, 0, 0, 0.4);
        box-shadow: inset 0px 0px 5px 0px rgba(0, 0, 0, 0.4);
        border-radius: 4px;
        border: 1px solid #ffffff;
    }

    .event-success {
        display: block;
        background-color: #006400;
        width: 19px;
        height: 20px;
        margin-right: 2px;
        margin-bottom: 2px;
        -webkit-box-shadow: inset 0px 0px 5px 0px rgba(0, 0, 0, 0.4);
        box-shadow: inset 0px 0px 5px 0px rgba(0, 0, 0, 0.4);
        border-radius: 4px;
        border: 1px solid #ffffff;
    }

    .event-important {
        display: block;
        background-color: #ad2121;
        width: 19px;
        height: 20px;
        margin-right: 2px;
        margin-bottom: 2px;
        -webkit-box-shadow: inset 0px 0px 5px 0px rgba(0, 0, 0, 0.4);
        box-shadow: inset 0px 0px 5px 0px rgba(0, 0, 0, 0.4);
        border-radius: 4px;
        border: 1px solid #ffffff;
    }

    .event-info {
        display: block;
        background-color: #1e90ff;
        width: 19px;
        height: 20px;
        margin-right: 2px;
        margin-bottom: 2px;
        -webkit-box-shadow: inset 0px 0px 5px 0px rgba(0, 0, 0, 0.4);
        box-shadow: inset 0px 0px 5px 0px rgba(0, 0, 0, 0.4);
        border-radius: 4px;
        border: 1px solid #ffffff;
    }

    .event-holdayindex {
        background-image: url("image/holiday.JPG");
        background-size: 60px 20px;
        /*  background-color: red;*/
        /* background-image: url("ป้ายวันหยุด.JPG");*/
        width: 60px;
        height: 20px;
    }

    .style19 {
        display: block;
        width: 19px;
        height: 20px;
        -webkit-box-shadow: inset 0px 0px 5px 0px rgba(0, 0, 0, 0.4);
        box-shadow: inset 0px 0px 5px 0px rgba(0, 0, 0, 0.4);
        border-radius: 4px;
        border: 1px solid #ffffff;
        margin-right: 2px;
        margin-bottom: 2px;
        background-color: #e3bc08;
    }


    .style21 {
        display: block;
        width: 19px;
        height: 20px;
        -webkit-box-shadow: inset 0px 0px 5px 0px rgba(0, 0, 0, 0.4);
        box-shadow: inset 0px 0px 5px 0px rgba(0, 0, 0, 0.4);
        border-radius: 4px;
        border: 1px solid #ffffff;
        margin-right: 2px;
        margin-bottom: 2px;
        background-color: #ad2121;
    }

    .offset-0 {
        padding-left: -10;
        padding-right: -10;
    }

    .style22 {
        text-decoration: underline;
        height: 19px;
    }

    .style24 {
        display: block;
        width: 19px;
        height: 20px;
        -webkit-box-shadow: inset 0px 0px 5px 0px rgba(0, 0, 0, 0.4);
        box-shadow: inset 0px 0px 5px 0px rgba(0, 0, 0, 0.4);
        border-radius: 4px;
        border: 1px solid #ffffff;
        margin-right: 2px;
        margin-bottom: 2px;
        background-color: #1e90ff;
    }

    .style25 {
        display: block;
        width: 19px;
        height: 20px;
        -webkit-box-shadow: inset 0px 0px 5px 0px rgba(0, 0, 0, 0.4);
        box-shadow: inset 0px 0px 5px 0px rgba(0, 0, 0, 0.4);
        border-radius: 4px;
        border: 1px solid #ffffff;
        margin-right: 2px;
        margin-bottom: 2px;
        background-color: #006400;
    }

    .style26 {
        font-size: medium;
    }
    </style>


    <div class="pagefooter visible-lg">
        <table align="center" cellpadding="0" cellspacing="0" class="nav-justified">
            <tbody>
                <tr>
                    <td colspan="2" class="style22">
                        แถบสีแสดงสถานะ
                    </td>
                </tr>


                <tr>
                    <td class="style25">
                        &nbsp;
                    </td>
                    <td class="style20">
                        อนุมัติ/เข้าใช้
                    </td>
                </tr>
                <tr>
                    <td class="style19">
                    </td>
                    <td class="style20">
                        รออนุมัติ
                    </td>
                </tr>
                <tr>
                    <td class="style21">
                    </td>
                    <td class="style20">
                        ไม่อนุมัติ/ยกเลิก
                    </td>
                </tr>

                <tr>
                    <td class="style24">
                    </td>
                    <td class="style20">
                        อนุมัติ/รอใช้ห้อง
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</head>

<body>

    <div class='col-md-12'>
        <?php include_once 'home.php'; ?>
        <div class="text-center">
            <a href='index.php' onclick="<?php echo 'window.history.back(1);'; ?>" class="btn btn-default btn-block">
                <i></i> ย้อนกลับ</a>
        </div>
    </div>

</body>

</html>