<?php
header('Content-type:application/json; charset=UTF-8');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', false);
include 'db_connect.php'; // เรียกใช้งานไฟล์เชื่อมต่อกับฐานข้อมูล
$mysqli = connect(); // เชื่อมต่อกับฐานข้อมูล

//$q="SELECT * FROM tbl_event WHERE date(event_start)>='".$_GET['start']."'  ";
//$q.=" AND date(event_end)<='".$_GET['end']."' ORDER by event_id";
$q =
    "SELECT * FROM booking_applications WHERE date(booking_start_date)>='" .
    $_GET['start'] .
    "'  ";
$q .= " AND date(booking_end_date)<='" . $_GET['end'] . "' ORDER by id";

$result = $mysqli->query($q);

while ($rs = $result->fetch_object()) {
    if ($rs->action == '') {
        $color = '#FFFFFF';
        //FF0000
    }
    if ($rs->action == 'accept' && $rs->status == '') {
        $color = '#FF9900';
        //FF0000
    }
    if ($rs->action == 'reject' && $rs->status == '') {
        $color = '#FFFFFF';
    }
    if ($rs->action == '' && $rs->status == '') {
        $color = '#e3bc08';
    }

    if ($rs->status == 'accept' && $rs->action == 'accept') {
        $color = '#009900';
        //FF0000
    }
    if ($rs->status == 'reject' && $rs->action == 'accept') {
        $color = '#FFFFFF';
    }
    if ($rs->status == '' && $rs->action == 'accept') {
        $color = '#1e90ff';
    }
    $json_data[] = [
        'id' => $rs->id,
        'title' =>
            $rs->booking_type . ',' . $rs->purpose . ',' . $rs->booking_id,
        'start' => $rs->booking_start_date,
        'end' => $rs->booking_end_date,
        'url' => 'show2.php?id=' . $rs->id,
        'color' => $color,

        //"url"=>$rs->event_url,
        //"allDay"=>($rs->event_allDay==true)?true:false
        // กำหนด event object property อื่นๆ ที่ต้องการ
    ];
    //$json= array_push($json, $json_data);
}
//echo "xxxxxxxx";
$json = json_encode($json_data);

if (isset($_GET['callback']) && $_GET['callback'] != '') {
    echo $_GET['callback'] . '(' . $json . ');';
} else {
    echo $json;
}