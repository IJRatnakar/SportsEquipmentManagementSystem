
<?php
	include("../dbConfig.php");

	$uid = $_SESSION['uid'];
    
    $query = mysqli_query($con, "SELECT firstName,lastName,mobile,email From members Where id = '$uid'");
    $result = mysqli_fetch_assoc($query);

?>

<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<link rel="stylesheet" type="text/css" href="../../css/title.css">
		<link rel="stylesheet" type="text/css" href="../../css/inputs.css">
		<link rel="stylesheet" type="text/css" href="../../css/form.css">
		<link rel="stylesheet" type="text/css" href="../../css/editProfile.css">
	</head>
	<body>

		<div class="title">Update Member</div>
	    <div class="updatearea">
			<form action="userPage.php" method="POST" enctype="multipart/form-data" class="updateForm">
		        <input type="text" name="umemberId" value=<?php echo $uid; ?> readonly><br>
		        <input type="text" name="firstName" required autofocus placeholder="First Name" value=<?php echo $result['firstName']; ?>><br>
		        <input type="text" name="lastName" required autofocus placeholder="Last Name" value=<?php echo $result['lastName']; ?>><br>
		        <input type="text" name="mobile" required autofocus placeholder="Mobile No" value=<?php echo $result['mobile']; ?>><br>
		        <input type="email" name="email" required autofocus placeholder="Email" value=<?php echo $result['email']; ?>><br>

		       

		        <input type="submit" name="updateMemberBtn" value="Update"><br>
	        </form>
	    </div>

	</body>
</html>