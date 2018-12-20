<?php
	include("../dbConfig.php");

	$selectedEquipmentId = $_REQUEST['selectedEquipmentId'];

	$query = mysqli_query($con, "Select * From Sports_stock Where EquipmentId= '$selectedEquipmentId'");

	$query2= mysqli_query($con, "Select * From Sport_item Where EquipmentId= '$selectedEquipmentId'");
	$result = mysqli_fetch_assoc($query);
	$availability=$result['availability'];

	


?>

<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<link rel="stylesheet" type="text/css" href="../../css/title.css">
		<link rel="stylesheet" type="text/css" href="../../css/table.css">
		<link rel="stylesheet" type="text/css" href="../../css/bookDetails.css">
	</head>
	<body>
		<div class="title">Sports Equipment Information</div>
		<div class="infoContainer">
			<div class="bookName">
				<?php echo ucfirst($result['sport_item']); ?>[<?php echo $selectedEquipmentId; ?>]
			</div>
			<?php
			/*if($issueId){
			?>
			<div class="issuingInfo">
				<?php
					
					if($result2['firstName'] && $result2['lastName']){
						?>
						This book is issued to 
						<a href="adminPage.php?activity=viewUserProfile&selectedMemberId=<?php echo $issueId; ?>"><?php echo ucfirst($result2['firstName'])." ".ucfirst($result2['lastName']); ?>.
						</a>
						<?php
					}
				?>
			</div>
			<?php
			}*/
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
                <td><strong>Item ID</strong></td>
                <td><strong>Brand</strong></td>
                <td><strong>No of Items</strong></td>
            </tr>
            <?php
           
     while($row = mysqli_fetch_array($query2)) 
       {
     //  echo '<option value= " '.$row['sport_item'].' " > '.$row['sport_item'].' </option>'; 
                  echo "<tr>";
                   echo "<td>".$row['itemid']."</td>";
                    echo "<td>".$row['brand']."</td>";
                     echo "<td>".$row['no_of_items']."</td>";
                   echo "</tr>";
      }
  
       ?>
         </table>
			</div>

			<div class="issuedBookDetails">
				<div class="issuedBookTitle">
					
				</div>
			</div>
		</div>
	</body>
</html>  