
<?php
	include("../dbConfig.php");

	$uid = $_SESSION['uid'];

	$query = mysqli_query($con, "Select * From admin Where id = '$uid'");
	$result = mysqli_fetch_assoc($query);


?>

<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<link rel="stylesheet" type="text/css" href="../../css/title.css">
		<link rel="stylesheet" type="text/css" href="../../css/viewProfile.css">
	</head>
	<body>
		<div class="title">View Profile</div>
		<div class="infoContainer">
			
			<div class="userName">
				
			</div>
			<div class="info">
				<hr>
				
				<div class="details"><strong><?php echo ucfirst($result['firstName'])." ".ucfirst($result['lastName']); ?></strong></div>
				<hr>
				<div class="label">Id</div>
				<div class="details"><?php echo $result['id']; ?></div>
				<hr>
				<div class="label">Username</div>
				<div class="details"><?php echo ($result['username']); ?></div>
				<hr>
				<div class="label">Mobile</div>
				<div class="details"><?php echo $result['mobile']; ?></div>
				<hr>
				<div class="label">Email</div>
				<div class="details"><?php echo ($result['email']); ?></div>
				<hr>
			</div>
		</div>
	</body>
</html>