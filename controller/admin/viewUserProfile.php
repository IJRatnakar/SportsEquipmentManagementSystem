
<?php
	include("../dbConfig.php");

	$selectedMemberId = $_REQUEST['selectedMemberId'];

	$query = mysqli_query($con, "Select firstName,lastName,username,mobile,email From members Where id = '$selectedMemberId'");
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
				<div class="details"><?php echo $selectedMemberId; ?></div>
				<hr>
				<div class="label">Username</div>
				<div class="details"><?php echo ucfirst($result['username']); ?></div>
				<hr>
				<div class="label">Mobile</div>
				<div class="details"><?php echo $result['mobile']; ?></div>
				<hr>
				<div class="label">Email</div>
				<div class="details"><?php echo ucfirst($result['email']); ?></div>
				<hr>
			</div>
		</div>
	</body>
</html>