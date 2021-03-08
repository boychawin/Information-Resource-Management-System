<?php
session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<title> หน้าหลัก | ระบบจัดการทรัพยากรสารสนเทศ</title>

<head>
    <meta name="author" content="Group One">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta property="og:url" content="https://boychawin.com/irms/pages/index" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="irms - ระบบจัดการทรัพยากรสารสนเทศ" />
    <meta property="og:description"
        content="ระบบจัดการทรัพยากรสารสนเทศ กรณีศึกษา อาคารบรรณราชนครินทร์ สำนักวิทยบริการและเทคโนโลยี สารสนเทศ มหาวิทยาลัยราชภัฏสกลนคร" />
    <meta property="og:image" content="https://boychawin.com/irms/images/สำนักวิทยบริการและเทคโนโลยีสารสนเทศ.jpg" />
    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <link rel="icon" type="image/png" href="../images/Snru_3.png" />
    <link rel="shortcut" href="../images/irms-arit1.png" />



    <!-- Date -->
    <!-- <link href="css/bootstrap-datetimepicker.css" rel="stylesheet">
   
    <link href="../bower_components/morrisjs/morris.css" rel="stylesheet">
  
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"> -->

    <link rel="stylesheet" href="../fancy/jquery.fancybox.css" type="text/css" media="screen" />

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

    <!-- DataTables JavaScript 
    <script src="../bower_components/DataTables/media/js/jquery.dataTables.min.js"></script>-->
    <!-- <script src="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script> -->
    <!-- DataTables CSS -->
    <link href="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css"
        rel="stylesheet">
    <!-- DataTables Responsive CSS 
    <link href="../bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">-->
    <!-- apiDataTables CSS -->
    <script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <link href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-75876762-1"></script>



    <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'UA-75876762-1');
    </script>
    <!-- Custom Theme JavaScript -->
    <script src='../lib/moment.min.js'></script>
    <script src='../fullcalendar.min.js'></script>
    <script src='../lang/th.js'></script>
    <script src="../fancy/jquery.fancybox.pack.js"></script>
    <!-- <script src="../fancy/helpers/jquery.fancybox-thumbs.js"></script>
    <script src="../fancy/helpers/jquery.fancybox-buttons.js"></script>
   script src="js/moment-with-locales.js"></script
    <script src="src/bootstrap-datetimepicker.js"></script>-->
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
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true,
            "order": [
                [0, "desc"]
            ]
        });
    });
    </script>
    <style>
    #calendar {
        max-width: 900px;
        margin: 0 auto;
    }
    </style>
</head>

<body background="../images/bg-arit-big.png">
    <?php
    include_once 'header2.php';

    //include_once 'dash-header2.php';
    echo "<div class='col-md-12'>" . "<div class='main-content '>";

    if (isset($_GET['tab']) && $_GET['tab'] == 4) {
        include_once 'showtab.php';
        include_once 'home.php';
    } elseif (isset($_GET['tab']) && $_GET['tab'] == 3) {
        include_once 'tables.php';
    } elseif (isset($_GET['tab']) && $_GET['tab'] == 2) {
        include_once 'login.php';
        include_once 'footers.php';
    } elseif (isset($_GET['tab']) && $_GET['tab'] == 1) {
        include_once 'home.php';
    } elseif (isset($_GET['tab']) && $_GET['tab'] == 5) {
        include_once 'C3location.php';
        include_once 'footers.php';
    } elseif (isset($_GET['tab']) && $_GET['tab'] == 6) {
        include_once 'C4rules.php';
        include_once 'footers.php';
    } elseif (isset($_GET['tab']) && $_GET['tab'] == 7) {
        include_once 'C2appeal.php';
        include_once 'footers.php';
    } elseif (isset($_GET['tab']) && $_GET['tab'] == 7.1) {
        include_once 'C2.1appeal.php';
        include_once 'footers.php';
    } elseif (isset($_GET['tab']) && $_GET['tab'] == 8) {
        include_once 'register.php';
        include_once 'footers.php';
    } elseif (isset($_GET['tab']) && $_GET['tab'] == 9) {
        include_once 'recover.php';
        include_once 'footers.php';
    } else {

        include_once 'showtab.php';
        include_once 'home.php';
    ?>

    <?php if (isset($_SESSION['staff-user']) == '') { ?>

    <script>
    $(document).ready(function() {
        $.fancybox({
            //'width'  : '100%',
            // 'height' : '10%',
            'hideHover': 'auto',
            'resize': true,
            // 'margin': '0',
            'autoScale': 'true', //false
            'transitionIn': 'fade',
            'transitionOut': 'fade',
            'type': 'iframe',
            'href': 'https://www.boychawin.com//irms/images/ru.png' // link ที่อยากให้แสดง
        });
    });
    </script> <?php } ?>
    <?php if (isset($_SESSION['staff-user']) == 'non-supervisor') {
            $staff_id1 = $_SESSION['staff-id'];
            include 'db_connect.php';
            $db_con = connect(); // เชื่อมต่อกับฐานข้อมูล
            ($query = "SELECT COUNT(*) AS id FROM booking_applications WHERE staff_id = '$staff_id1'");
            $result = mysqli_query(
                $db_con,
                $query
            );

            while (
                $row = mysqli_fetch_array(
                    $result
                )
            ) {
                if ($row['id'] >= "1" && $row['id'] <= "10") { ?>
    <script>
    $(document).ready(function() {
        $.fancybox({
            //'width'  : '100%',
            // 'height' : '10%',
            'hideHover': 'auto',
            'resize': true,
            // 'margin': '0',
            'autoScale': 'true', //false
            'transitionIn': 'fade',
            'transitionOut': 'fade',
            'type': 'iframe',
            'href': 'https://docs.google.com/forms/d/e/1FAIpQLSdvv-oLlZFXzPwgmCH3NLh93mxJRvWg5ZI631S2_1z8L5wDfQ/viewform?usp=sf_link' // link ที่อยากให้แสดง
        });
    });
    </script>

    <?php }
            }
        } ?>
    <?php
    }
    ?>
    <script>
    $(document).ready(function() {
        $(window).scroll(function() {
            if ($(this).scrollTop() > 50) {
                $('#back-to-top').fadeIn();
            } else {
                $('#back-to-top').fadeOut();
            }
        });
        // scroll body to 0px on click
        $('#back-to-top').click(function() {
            $('#back-to-top').tooltip('hide');
            $('body,html').animate({
                scrollTop: 0
            }, 800);
            return false;
        });

        $('#back-to-top').tooltip('show');
    });
    </script>
    <style>
    .back-to-top {
        cursor: pointer;
        position: fixed;
        bottom: 20px;
        right: 20px;
        display: none;
        z-index: 9999;
        /*ทำให้อยู่บนสุด*/
    }
    </style>
    <a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button" data-toggle="tooltip"
        data-placement="left"><i class="fa fa-chevron-up"></i></a>
</body>

</html>