<?php

	include("../dbConfig.php");

	$query = "SELECT * FROM Borrow";
	$returnD = mysqli_query($con, $query);
	$returnD1 = mysqli_query($con, $query);
	$result = mysqli_fetch_assoc($returnD);
	
	
?>

<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<link rel="stylesheet" type="text/css" href="../../css/table.css">
		<link rel="stylesheet" type="text/css" href="../../css/title.css">
		<link rel="stylesheet" type="text/css" href="../../css/viewProfile.css">
	</head>
	<body>
		<div class="title">Member List</div>
		<table>
			<tr>
				<th>Borrow_id</th>
				<th>User ID</th>
				<th>Equipment ID</th>
				<th>Item ID</th>
				<th>Date of Issue</th>
				
			</tr>

			<?php
				while($result1 = mysqli_fetch_assoc($returnD1)){
				?>
				<tr>
					<td>
						 <a href="adminPage.php?activity=viewUserProfile&selectedMemberId=<?php echo $result1['uid']; ?>"><?php echo $result1['borrow_id']; ?></a>
					</td>
					<td><?php echo ($result1['uid']); ?></td>
					<td><?php echo ($result1['EquipmentId']); ?></td>
					<td><?php echo $result1['itemid']; ?></td>
					<td><?php echo $result1['date_of_issue']; ?></td>
					
				</tr>
				<?php
				}
			
			?>
		</table>
	</body>
</html>
