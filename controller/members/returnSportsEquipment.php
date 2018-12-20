
<?php
include("../dbConfig.php");
$EquipmentId=$_SESSION['EquipmentId'];
$itemid=$_REQUEST['itemid'];
?>
<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<link rel="stylesheet" type="text/css" href="../../css/inputs.css">
		<link rel="stylesheet" type="text/css" href="../../css/title.css">
		<link rel="stylesheet" type="text/css" href="../../css/form.css">
	</head>
	<body>
		<div class="issueReturn">
			<div class="title">Return Sports Equipment</div>
			<form action="userPage.php" class="issueReturnForm">

				<label>User ID</label><input type="text" name="returnId" required autofocus placeholder="Issuer-Id" value="<?php echo $_SESSION['uid']; ?>" readonly><br>
				<label>Equipment ID</label><input type="text" name="returnEquipmentId" required autofocus placeholder="Equipment-Id" value="<?php echo $EquipmentId; ?>" readonly><br>
				<label>Item ID</label><input type="text" name="returnitemid" required autofocus placeholder="Item-Id" value="<?php echo $itemid; ?>" readonly><br>
				
				<input type="submit" name="returnBtn" value="<<Return">
			</form>
		</div>
	</body>
</html>
