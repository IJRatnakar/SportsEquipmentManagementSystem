
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
			<div class="title">Issue-Sport-Equipment</div>
			<form action="userPage.php" class="issueReturnForm">

			    <label>User ID</label><input type="text" name="issuerId" required autofocus placeholder="Issuer-Id" value="<?php echo $_SESSION['uid']; ?>" readonly><br>
				<label>Equipment ID</label><input type="text" name="issueEquipmentId" required autofocus placeholder="Equipment-Id" value="<?php echo $EquipmentId; ?>" readonly><br>
				<label>Item ID</label><input type="text" name="issueitemid" required autofocus placeholder="Item-Id" value="<?php echo $itemid; ?>" readonly><br>
				
				
				<input type="submit" name="issueBtn" value=">>Issue">
				
			</form>
		</div>
	</body>
</html>