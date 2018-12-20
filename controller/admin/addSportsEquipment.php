<?php
	
	include("../dbConfig.php");

	
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
		<div class="title">Add-Sports-Equipment</div>
		<div class="addBookForm">
			<form action="adminPage.php">
				<input type="text" name="EquipmentId" required autofocus placeholder="Equipment-ID"><br>
				<input type="text" name="availability" required autofocus placeholder="availability">
				<br>
				<input type="text" name="sport_item" required autofocus placeholder="Sport Item">
				<br>
				<label>Category</label>
			<select name="formCategory">
  				<option value="">Select...</option>
   				<option value="Badminton">Badminton</option>
  				<option value="Cricket">Cricket</option>
 				 <option value="Football">Football</option> 
			</select>

			 <label>Entry Date:</label>
				<input type="date" name="entryDate"><br>
				<input type="submit" name="addSportsEquipmentBtn" value="Add Equipment"><br>
			</form>
		</div>
	</body>
</html>