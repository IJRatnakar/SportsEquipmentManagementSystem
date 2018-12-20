<?php
	
	include("../dbConfig.php");
	$EquipmentId=$_SESSION['EquipmentId'];
    $tempAvailability=$_SESSION['availability'];
	
?>

<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<link rel="stylesheet" type="text/css" href="../../css/title.css">
		<link rel="stylesheet" type="text/css" href="../../css/inputs.css">
		<link rel="stylesheet" type="text/css" href="../../css/form.css">
	</head>
	<body>
		<div class="title">Add-Sports-Item</div>
		<div class="addBookForm">
			<form action="adminPage.php">
				<input type="text" name="EquipmentId" required autofocus placeholder="Equipment-ID" value=<?php echo "$EquipmentId"; ?> readonly><br>
				<?php  $i=1; while($i<=$tempAvailability){ ?>
				<label>Item ID <?php echo "$i"?></label><input type="text" name="itemid<?php echo 
				"$i"; ?>" required autofocus placeholder="Item ID">
				<br>
				<label>Brand<?php echo "$i"?></label><input type="text" name="brand<?php echo "$i"; ?>" required autofocus placeholder="Brand">
				<br>
				<label>No of Items:<?php echo "$i"?></label><input type="text" name="no_of_items<?php echo "$i"; ?>" required autofocus placeholder="No of Items">
				<br>
				<?php $i=$i+1;}?>
				<input type="submit" name="addSportsEquipment-IIBtn" value="Add Equipment"><br>
			</form>
		</div>
	</body>
</html>