<?php
	include("../dbConfig.php");

	$selectedEquipmentId = $_REQUEST['selectedEquipmentId'];

	$query = mysqli_query($con, "Select * From Sports_stock Where EquipmentId= '$selectedEquipmentId'");

	$query2= mysqli_query($con, "Select * From Sport_item Where EquipmentId= '$selectedEquipmentId'");
	$result = mysqli_fetch_assoc($query);
	//$result2 = mysqli_fetch_assoc($query2);
	$_SESSION['EquipmentId']=$selectedEquipmentId;
	

?>

<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<link rel="stylesheet" type="text/css" href="../../css/title.css">
		<link rel="stylesheet" type="text/css" href="../../css/bookDetails.css">
		<link rel="stylesheet" type="text/css" href="../../css/table.css">
	</head>
	<body>
		<div class="title">Sports Equipment Information</div>
		<div class="infoContainer">
			<div class="bookName">
				<?php echo ucfirst($result['sport_item']); ?>[<?php echo $selectedEquipmentId; ?>]
			</div>
			<?php
			
			?>
			<div class="bookInfo">
				<hr>
				<div class="label">Category</div>
				<div class="details"><?php echo ucfirst($result['category']); ?></div>
				<hr>
				<div class="label">Availability</div>
				<div class="details"><?php echo $result['availability']; ?></div>
				<hr>
				<div class="label">Entry Date</div>
				<div class="details"><?php echo ucfirst($result['entryDate']); ?></div>
				<hr>
			</div>
			<div class="bookInfo">
				 <table>
           <tr>
                <th><strong>Item ID</strong></th>
                <th><strong>Brand</strong></th>
                 <th><strong>No of Items</strong></th>
                 <th><strong>Borrow</strong></th>
                
            </tr>
            <?php
           
     while($row = mysqli_fetch_array($query2)) 
       {
       	 
       	 ?>
  
                   <tr>
                   <td><?php echo ucfirst($row['itemid']); ?></td>
					<td><?php echo ucfirst($row['brand']); ?></td>
					<td><?php echo ucfirst($row['no_of_items']); ?></td>
					<td>
						<a href="userPage.php?activity=borrowSportsEquipment&itemid=<?php echo $row['itemid'];?>">Borrow</a>
					</td>
					
					</tr>

					<?php 
					
          }
  
           ?>
         </table>
     </div>
			

		</div>
	</body>
</html>  