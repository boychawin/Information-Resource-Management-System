<?PHP
function thai($bbb)
{
	$d2 = substr($bbb, 0, 2);
	$m2 = substr($bbb, 3, 2);
	$y3 = substr($bbb, 6, 4);
	$h2 = substr($bbb, 10, 6);
	$y4 = $y3 + "543";
	if ($m2 == "01") {
		$m2 = "มกราคม";
	}
	if ($m2 == "02") {
		$m2 = "กุมภาพันธ์";
	}
	if ($m2 == "03") {
		$m2 = "มีนาคม";
	}
	if ($m2 == "04") {
		$m2 = "เมษายน";
	}
	if ($m2 == "05") {
		$m2 = "พฤษภาคม";
	}
	if ($m2 == "06") {
		$m2 = "มิถุนายน";
	}
	if ($m2 == "07") {
		$m2 = "กรกฎาคม";
	}
	if ($m2 == "08") {
		$m2 = "สิงหาคม";
	}
	if ($m2 == "09") {
		$m2 = "กันยายน";
	}
	if ($m2 == "10") {
		$m2 = "ตุลาคม";
	}
	if ($m2 == "11") {
		$m2 = "พฤศจิกายน";
	}
	if ($m2 == "12") {
		$m2 = "ธันวาคม";
	}
	if ($bbb == "") {
		return "";
	} else {
		//return $y1 . "-" . $m1 . "-" . $d1. "" . $h1;
		return $d2 . "&nbsp;" . $m2 . "&nbsp;" . $y4 . "&nbspเวลา" . $h2 . " น.";
	}
}

function thai2($bbb)
{
	$d2 = substr($bbb, 0, 2);
	$m2 = substr($bbb, 3, 2);
	$y3 = substr($bbb, 6, 4);
	$h2 = substr($bbb, 10, 6);
	$y4 = $y3 + "543";
	if ($m2 == "01") {
		$m2 = "มกราคม";
	}
	if ($m2 == "02") {
		$m2 = "กุมภาพันธ์";
	}
	if ($m2 == "03") {
		$m2 = "มีนาคม";
	}
	if ($m2 == "04") {
		$m2 = "เมษายน";
	}
	if ($m2 == "05") {
		$m2 = "พฤษภาคม";
	}
	if ($m2 == "06") {
		$m2 = "มิถุนายน";
	}
	if ($m2 == "07") {
		$m2 = "กรกฎาคม";
	}
	if ($m2 == "08") {
		$m2 = "สิงหาคม";
	}
	if ($m2 == "09") {
		$m2 = "กันยายน";
	}
	if ($m2 == "10") {
		$m2 = "ตุลาคม";
	}
	if ($m2 == "11") {
		$m2 = "พฤศจิกายน";
	}
	if ($m2 == "12") {
		$m2 = "ธันวาคม";
	}
	if ($bbb == "") {
		return "";
	} else {
		//return $y1 . "-" . $m1 . "-" . $d1. "" . $h1;
		return $d2 . "&nbsp;" . $m2 . "&nbsp;" . $y4;
	}
}

function thai3($ttt)
{
	$d1 = substr($ttt, 0, 2);
	$m1 = substr($ttt, 3, 2);
	$y = substr($ttt, 6, 4);
	if ($ttt == "") {
		return "";
	} else {
		return $y . "-" . $m1 . "-" . $d1;
	}
}

function thai4($ttt)
{
	$d1 = substr($ttt, 0, 2);
	$m1 = substr($ttt, 3, 2);
	$y = substr($ttt, 6, 4);
	$h = substr($ttt, 10, 6);
	if ($ttt == "") {
		return "";
	} else {
		return $y . "-" . $m1 . "-" . $d1 . " " . $h;
	}
}

function thai5($bbb)
{
	$y3 = substr($bbb, 0, 4);
	$m2 = substr($bbb, 5, 2);
	$d2 = substr($bbb, 8, 2);
	$y4 = $y3 + "543";
	if ($m2 == "01") {
		$m2 = "มกราคม";
	}
	if ($m2 == "02") {
		$m2 = "กุมภาพันธ์";
	}
	if ($m2 == "03") {
		$m2 = "มีนาคม";
	}
	if ($m2 == "04") {
		$m2 = "เมษายน";
	}
	if ($m2 == "05") {
		$m2 = "พฤษภาคม";
	}
	if ($m2 == "06") {
		$m2 = "มิถุนายน";
	}
	if ($m2 == "07") {
		$m2 = "กรกฎาคม";
	}
	if ($m2 == "08") {
		$m2 = "สิงหาคม";
	}
	if ($m2 == "09") {
		$m2 = "กันยายน";
	}
	if ($m2 == "10") {
		$m2 = "ตุลาคม";
	}
	if ($m2 == "11") {
		$m2 = "พฤศจิกายน";
	}
	if ($m2 == "12") {
		$m2 = "ธันวาคม";
	}
	if ($bbb == "") {
		return "";
	} else {
		//return $y1 . "-" . $m1 . "-" . $d1. "" . $h1;
		return $d2 . "&nbsp;" . $m2 . "&nbsp;" . $y4;
	}
}

function thai6($ttt)
{
	$d1 = substr($ttt, 8, 2);
	$m1 = substr($ttt, 5, 2);
	$y = substr($ttt, 0, 4);
	if ($ttt == "") {
		return "";
	} else {
		return $d1 . "-" . $m1 . "-" . $y;
	}
}

function thai7($ttt)
{
	$d1 = substr($ttt, 8, 2);
	$m1 = substr($ttt, 5, 2);
	$y = substr($ttt, 0, 4);
	$h = substr($ttt, 10, 6);
	if ($ttt == "") {
		return "";
	} else {
		return $d1 . "-" . $m1 . "-" . $y . "" . $h;
	}
}

function thai8($bbb)
{
	$y3 = substr($bbb, 0, 4);
	$m2 = substr($bbb, 5, 2);
	$d2 = substr($bbb, 8, 2);
	$h2 = substr($bbb, 10, 9);
	$y4 = $y3 + "543";

	if ($m2 == "01") {
		$m2 = "มกราคม";
	}
	if ($m2 == "02") {
		$m2 = "กุมภาพันธ์";
	}
	if ($m2 == "03") {
		$m2 = "มีนาคม";
	}
	if ($m2 == "04") {
		$m2 = "เมษายน";
	}
	if ($m2 == "05") {
		$m2 = "พฤษภาคม";
	}
	if ($m2 == "06") {
		$m2 = "มิถุนายน";
	}
	if ($m2 == "07") {
		$m2 = "กรกฎาคม";
	}
	if ($m2 == "08") {
		$m2 = "สิงหาคม";
	}
	if ($m2 == "09") {
		$m2 = "กันยายน";
	}
	if ($m2 == "10") {
		$m2 = "ตุลาคม";
	}
	if ($m2 == "11") {
		$m2 = "พฤศจิกายน";
	}
	if ($m2 == "12") {
		$m2 = "ธันวาคม";
	}

	if ($d2 == "01") {
		$d2 = "1";
	}
	if ($d2 == "02") {
		$d2 = "2";
	}
	if ($d2 == "03") {
		$d2 = "3";
	}
	if ($d2 == "04") {
		$d2 = "4";
	}
	if ($d2 == "05") {
		$d2 = "5";
	}
	if ($d2 == "06") {
		$d2 = "6";
	}
	if ($d2 == "07") {
		$d2 = "7";
	}
	if ($d2 == "08") {
		$d2 = "8";
	}
	if ($d2 == "09") {
		$d2 = "9";
	}
	if ($bbb == "") {
		return "";
	} else {
		//return $y1 . "-" . $m1 . "-" . $d1. "" . $h1;
		return $d2 . "&nbsp;" . $m2 . "&nbsp;" . $y4 . "&nbspเวลา" . $h2 . " น.";
	}
}

function thai9($ttt)
{
	$d1 = substr($ttt, 0, 2);
	$m1 = substr($ttt, 3, 2);
	$y = substr($ttt, 6, 4);
	$h = substr($ttt, 10, 6);
	$y2 = $y - 543;
	if ($ttt == "") {
		return "";
	} else {
		return $y2 . "-" . $m1 . "-" . $d1 . " " . $h;
	}
}

function thai10($ttt)
{
	$d1 = substr($ttt, 8, 2);
	$m1 = substr($ttt, 5, 2);
	$y = substr($ttt, 0, 4);
	$h = substr($ttt, 10, 9);
	$y2 = $y - 543;
	if ($ttt == "") {
		return "";
	} else {
		return $y2 . "-" . $m1 . "-" . $d1 . " " . $h;
	}
}


function DateDiff($strDate1, $strDate2)
{
	return ((strtotime($strDate2) - strtotime($strDate1)) /  (60 * 60 * 24)) + 1;  // 1 day = 60*60*24
}



function thai11($bbb)
{
	$y3 = substr($bbb, 0, 4);
	$m2 = substr($bbb, 5, 2);
	$d2 = substr($bbb, 8, 2);
	$h2 = substr($bbb, 10, 9);
	$y4 = $y3 + "543";

	if ($m2 == "01") {
		$m2 = "มกราคม";
	}
	if ($m2 == "02") {
		$m2 = "กุมภาพันธ์";
	}
	if ($m2 == "03") {
		$m2 = "มีนาคม";
	}
	if ($m2 == "04") {
		$m2 = "เมษายน";
	}
	if ($m2 == "05") {
		$m2 = "พฤษภาคม";
	}
	if ($m2 == "06") {
		$m2 = "มิถุนายน";
	}
	if ($m2 == "07") {
		$m2 = "กรกฎาคม";
	}
	if ($m2 == "08") {
		$m2 = "สิงหาคม";
	}
	if ($m2 == "09") {
		$m2 = "กันยายน";
	}
	if ($m2 == "10") {
		$m2 = "ตุลาคม";
	}
	if ($m2 == "11") {
		$m2 = "พฤศจิกายน";
	}
	if ($m2 == "12") {
		$m2 = "ธันวาคม";
	}

	if ($d2 == "01") {
		$d2 = "1";
	}
	if ($d2 == "02") {
		$d2 = "2";
	}
	if ($d2 == "03") {
		$d2 = "3";
	}
	if ($d2 == "04") {
		$d2 = "4";
	}
	if ($d2 == "05") {
		$d2 = "5";
	}
	if ($d2 == "06") {
		$d2 = "6";
	}
	if ($d2 == "07") {
		$d2 = "7";
	}
	if ($d2 == "08") {
		$d2 = "8";
	}
	if ($d2 == "09") {
		$d2 = "9";
	}
	if ($bbb == "") {
		return "";
	} else {
		//return $y1 . "-" . $m1 . "-" . $d1. "" . $h1;
		return $d2 . "&nbsp;" . $m2 . "&nbsp;" . $y4 . "&nbsp";
	}
}
