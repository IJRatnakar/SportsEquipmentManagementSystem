<?php
	
	include("../dbConfig.php");

	$uid = $_SESSION['uid'];
    
	$query = "SELECT * FROM Borrow Where uid = '$uid'";
	$returnD = mysqli_query($con, $query);
	$returnD1 = mysqli_query($con, $query);
	$res = mysqli_fetch_assoc($returnD);

?>

<!DOCTYPE html>
	<html>
	<head>
		<title></title>
		<link rel="stylesheet" type="text/css" href="../../css/inputs.css">
		<link rel="stylesheet" type="text/css" href="../../css/title.css">
		<link rel="stylesheet" type="text/css" href="../../css/form.css">
		<link rel="stylesheet" type="text/css" href="../../css/table.css">
	</head>
	<body>
		<div class="title">Issued-Sports-Equipment</div>
		 <table>
           <tr>
                <th>Equipment ID</th>
                <th>Item ID</th>
                 <th>Issue-Date</th>
                  <th>Return</th>
                 
            </tr>
            <?php
           
     while($row = mysqli_fetch_array($returnD1)) 
       {
       	$_SESSION['EquipmentId']=$row['EquipmentId'];
       	 ?>
  
                   <tr>
                   <td><?php echo ucfirst($row['EquipmentId']); ?></td>
					<td><?php echo ucfirst($row['itemid']); ?></td>
					<td><?php echo ucfirst($row['date_of_issue']); ?></td>
					<td>
						<a href="userPage.php?activity=returnSportsEquipment&itemid=<?php echo $row['itemid'];?>">Return</a>
					</td>
				
					</tr>

					<?php 
					
          }
  
           ?>
         </table>
	</body>
</html>