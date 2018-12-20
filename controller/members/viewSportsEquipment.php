<?php
	
	include("../dbConfig.php");

	$query = "SELECT * FROM Sports_stock";
	$returnD = mysqli_query($con, $query);
	$returnD1 = mysqli_query($con, $query);
	$result = mysqli_fetch_assoc($returnD);

?>

<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<link rel="stylesheet" type="text/css" href="../../css/title.css">
		<link rel="stylesheet" type="text/css" href="../../css/table.css">
	</head>
	<body>
		
		<div class="title">Sports Equipment List</div>
		<table>
			<tr>
				<th>Equipment Id</th>
				<th>Category</th>
				<th>Sport Item</th>
				<th>Availability</th>
			</tr>
			<?php
				while($result1 = mysqli_fetch_assoc($returnD1)){
				?>
				<tr>
					<td>
						<a href="userPage.php?activity=sportsEquipmentDetails&selectedEquipmentId=<?php echo $result1['EquipmentId']; ?>"> <?php echo $result1['EquipmentId']; ?> </a>
					</td>
					<td><?php echo ucfirst($result1['category']); ?></td>
					<td><?php echo ucfirst($result1['sport_item']); ?></td>
					<td>
						<?php 
							
							echo ucfirst($result1['availability']);
						?>
					</td>
					
				</tr>
				<?php
				}
			?>
			
		</table>
	</body>
</html>