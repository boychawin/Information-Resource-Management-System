<html>
<head>
<title>ThaiCreate.Com Tutorial</title>
</head>
<?php
include 'connection.php'; //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี
$result = $db_con->query(
	"SELECT * FROM booking"
);
?>

<script language="JavaScript">
	function resutName(strCusName)
	{
			frmMain.txtID.value = strCusName.split("|")[0];
			frmMain.txtName.value = strCusName.split("|")[1];
			frmMain.numberp.max = strCusName.split("|")[1];
			
	}
	
</script>

<body>
	
	<form action="page.php" method="post" name="frmMain">
		List Menu 
		  <select name="lmName1" OnChange="resutName(this.value);">
			<option value=""><-- Please Select Item --></option>
			<?php
    while ($row = $result->fetch_object()) {
			?>
			<option value="<?php echo $row->booking_type ?>|<?php echo $row->Room_number?>"><?php echo $row->booking_type ?><?php echo $row->Room_number?></option>
			<?php
			}
			?>
		  </select>
		  <input name="txtID" type="text" value="">
		  <input name="txtName" type="number" min="1"max=""value="">

		 
       <select type='text' name='numberp' value="" max="">
		   <?php for ($i = 1; $i <  1000; $i++) { ?>
			<option value='<?php $i?>'><?php echo $i;?></option>
			<?php }?>
		</select>
		
	
	</form>
</body>
</html>
<?php
	mysqli_close($db_con);
?>