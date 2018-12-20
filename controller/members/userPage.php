<?php
	session_start();

	include("../dbConfig.php");
	error_reporting(0);

	$username = $_SESSION['username'];

	//$result = mysqli_fetch_assoc(mysqli_query($con, "SELECT position FROM members WHERE username = '$username'"));

	if($_REQUEST['activity'] == 'logout'){
        $username = null;
        $username ="";
        unset($username);
        
        $_SESSION['username'] = null;
        $_SESSION['username'] ="";
        unset($_SESSION['username']);
        
        session_destroy();
    }

    if(empty($username)){
        header("location: ../home.php?activity=dashboard");
    }
?>

<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<link rel="stylesheet" type="text/css" href="../../css/title.css">
		<link rel="stylesheet" type="text/css" href="../../css/userPage.css">
		<link rel="stylesheet" type="text/css" href="../../css/home.css">
		<link rel="stylesheet" type="text/css" href="../../css/header.css">
		<link rel="stylesheet" type="text/css" href="../../css/navigation.css">
	</head>
	<body>
		<div class="container">
			<div class="header">
				<?php include("../header.php"); ?>
			</div>
			<div class="userContainer">
				<div class="title">
					Student Page
				</div>

				<div class="userWelcome">Welcome : <?php echo $_SESSION['username']; ?></div>

				<div class="logout"><a href="userPage.php?activity=logout">Logout</a></div>

				<div class="userAction">
					<ul>
						<li><a href="userPage.php?activity=viewProfile">View Profile</a></li>
						<li><a href="userPage.php?activity=editProfile">Edit Profile</a></li>
						<li><a href="userPage.php?activity=viewSportsEquipment">View Sports Equipment</a></li>
						<li><a href="userPage.php?activity=issuedSportsEquipment">Issued Sports Equipment</a></li>
					</ul>
				</div>

				<div class="userContent">
					<?php
					//ACTIVITY PERFORM...

						$activity = $_REQUEST['activity'];

						switch ($activity) {
							

							case 'issuedSportsEquipment':
								include("issuedSportsEquipment.php");	
								break;	

					

							case 'viewSportsEquipment':
                                 include("viewSportsEquipment.php");
								break;

							  case 'sportsEquipmentDetails':
                                include("sportsEquipmentDetails.php");
                                break;
		

							case 'editProfile':
								include("editProfile.php");
								break;

							case 'viewProfile':
								include("viewProfile.php");
								break;

							case 'borrowSportsEquipment':
							     include("issueSportsEquipment.php");
							     break;	

							 case 'returnSportsEquipment':
							     include("returnSportsEquipment.php");
							     break;	    

							default:
								include("viewProfile.php");
								break;
						}
					?>

					<?php
	                //UPDATE MEMBER...

	                    if(isset($_REQUEST['updateMemberBtn'])){

	                        $umemberId = $_REQUEST['umemberId'];
	                        $firstName = $_REQUEST['firstName'];
	                        $lastName = $_REQUEST['lastName'];
	                    
	                        $mobile = $_REQUEST['mobile'];
	                        $email = $_REQUEST['email'];

	                       

	                        $query1 = mysqli_query($con, "UPDATE members Set firstName ='$firstName', lastName ='$lastName', mobile ='$mobile', email ='$email' Where id = '$umemberId'");

	                        if($query1){
	                            //$errorMsg = "Updation is successfully done.";
	                            header("location: userPage.php?activity=viewProfile");
	                        }
	                        //include("editProfile.php");
	                    }    
	                ?>

					




     					<?php
					//ISSUE 

						if(isset($_REQUEST['issueBtn']))
						{//if click on issue button..

	                        $issueEquipmentId = $_REQUEST['issueEquipmentId'];
	                        $issueitemid=$_REQUEST['issueitemid'];
	                        $issuerId = $_REQUEST['issuerId'];

	                        if(!empty($issueEquipmentId)&& !empty($issueitemid) && !empty($issuerId))
	                        { //checks that both fields is not empty..

	                        	$query1 = "Select itemid,brand From Sport_item Where EquipmentId = '$issueEquipmentId' and itemid='$issueitemid'";
	                            $returnD1 = mysqli_query($con, $query1);
	                            $result1 = mysqli_fetch_assoc($returnD1);
	                            $brand=$result1['brand'];



	                            $query2 = "Select id From members Where id = '$issuerId'";
	                            $returnD2 = mysqli_query($con, $query2);
	                            $result2 = mysqli_fetch_assoc($returnD2);

	                            $query3 = "Select availability From Sports_stock Where EquipmentId = '$issueEquipmentId'";
	                            $returnD3 = mysqli_query($con, $query3);
	                            $result3 = mysqli_fetch_assoc($returnD3);


	                            if($issueitemid == $result1['itemid'] && $issuerId == $result2['id'])
	                            { //checks that book or issuer id exists or not..

	                                $query4 = "Select itemid,uid From Borrow Where itemid= '$issueitemid'";
	                                $returnD4 = mysqli_query($con, $query4);
	                                $result4 = mysqli_fetch_assoc($returnD4);

	                                	if($result3['availability']<1)
	                                	{
	                                		$errorMsg=" cuurently sport equipment is not available ";
	                                	}
	                                    elseif($issueitemid != $result4['itemid'])
	                                    {//checks that book is already issued or not..

	                                       date_default_timezone_set('Asia/Kolkata');
	                                        $dt = date("y/m/d");
	                                        $query5 = "INSERT INTO Borrow(uid,EquipmentId,itemid,date_of_issue,no_of_items_borrowed,brand) Values('$issuerId','$issueEquipmentId','$issueitemid','$dt',1,'$brand')";        
	                                        $returnD5 = mysqli_query($con, $query5);
	                                        if(!$returnD5)
	                                        {
	                                        	echo (mysqli_error($con));
	                                        }

	                                        $query6 = "UPDATE Sport_item SET no_of_items=no_of_items-1 where itemid='$issueitemid'";        
	                                        $returnD6 = mysqli_query($con, $query6);

	                                         $query7 = "SELECT no_of_items From Sport_item Where itemid= '$issueitemid'";

	                                		$returnD7 = mysqli_query($con, $query7);
	                                		$result7 = mysqli_fetch_assoc($returnD7);
	                                		if($result7['no_of_items']==0)
	                                		{
	                                			mysqli_query($con,"DELETE from Sport_item where itemid='$issueitemid'");
	                                			mysqli_query($con,"UPDATE Sports_stock SET availability=availability-1 where EquipmentId='$issueEquipmentId'");
	                                		}


	                                        //$queryForUnavailableBook = mysqli_query($con, "Update books Set available = 0 Where bookId = '$issueBookId'");

	                                        if($returnD6){
	                                            $errorMsg = " Sport Item has been successfully issued.";
	                                        }
	                                        else{
	                                            $errorMsg = "Problem in issueing this item.";
	                                        }
	                                    }
	                                    else{
	                                        $errorMsg = "Already issued to ".$result4['uid'].".";
	                                    }

	                            }

	                            elseif($issueitemid != $result1['itemid']){
	                                $errorMsg = "Please! Enter valid Item-Id.";
	                            }
	                            elseif($issuerId != $result2['id']){
	                                $errorMsg = "Please! Enter valid Issuer-Id.";
	                            }
	                        }
	                        else{
	                            $errorMsg = "Both fields can't be Empty.";
	                        }
                           

	                        include("viewSportsEquipment.php");
	                    }
	                    

					?>





					<?php
					//RETURN ...

						if(isset($_REQUEST['returnBtn'])){//checks that return button is clicked or not...

	                         $returnEquipmentId = $_REQUEST['returnEquipmentId'];
	                        $returnitemid=$_REQUEST['returnitemid'];
	                        $returnId = $_REQUEST['returnId'];
	                        

	                        if(!empty($returnId) && !empty($returnEquipmentId) && !empty($returnitemid) ){ //checks that both fields are filled or not...

	                            $query1 = "SELECT * From Borrow Where uid = '$returnId' && EquipmentId = '$returnEquipmentId' && itemid='$returnitemid'";
	                            $returnD1 = mysqli_query($con, $query1);
	                            $result1 = mysqli_fetch_assoc($returnD1);

	                            if($returnId == $result1['uid'] && $returnEquipmentId == $result1['EquipmentId'] && $returnitemid == $result1['itemid']){ //checks that book is issued or not or student id exists or not...

	                                date_default_timezone_set('Asia/Kolkata');
	                                $dt = date("y/m/d");

	                                 $query2 = "INSERT INTO Return_item(uid,EquipmentId,itemid,date_of_return) Values('$returnId','$returnEquipmentId','$returnitemid','$dt')";        
	                                        $returnD2 = mysqli_query($con, $query2);
	                                        if(!$returnD2)
	                                        {
	                                        	echo (mysqli_error($con));
	                                        }

	                                   $query3 = "SELECT * from  Sport_item where itemid='$returnitemid'";
	                                $returnD3 = mysqli_query($con, $query3);
	                                $result3 = mysqli_fetch_assoc($returnD3); 
	                                $no_of_items=$result3['no_of_items'];
	                                 $brand=$result1['brand'];
	                                

	                                /* $query4 = "SELECT * Sport_item where itemid='$returnitemid'";
	                                $returnD4= mysqli_query($con, $query4);
	                                $result4= mysqli_fetch_assoc($returnD4);*/

	                             
    									if(mysqli_num_rows($returnD3)==0)
    									{
	                                $query5 = "INSERT INTO Sport_item(itemid,EquipmentId,brand,no_of_items) Values('$returnitemid','$returnEquipmentId','$brand',1)";
	                                $returnD5 = mysqli_query($con, $query5);
	                                 $query8 = "UPDATE Sports_stock set availability=availability+1 where EquipmentId='$returnEquipmentId'";
	                                $returnD8 = mysqli_query($con, $query8);
	                                 }
	                                 else
	                                 {
	                                 $query6= "UPDATE Sport_item set no_of_items= $no_of_items+1 where itemid='$returnitemid'";
	                                $returnD6 = mysqli_query($con, $query6);	
	                                 }

	                                $query7= "DELETE  From Borrow where uid='$returnId' and itemid='$returnitemid'";
	                                $returnD7 = mysqli_query($con, $query7);

	                               
	                                
	                                if($returnD7){ //checks that book is returned or not..
	                                    $errorMsg = "Sport Equipment has been successfully returned.";
	                                }
	                                else{
	                                    $errorMsg = "Problem in returning this Item.";
	                                }

	                            }
	                            else{
	                                $errorMsg = "Item-Id or Issued-Id does not Exist or may not be issued.";
	                            }
	                        }
	                        else{
	                            $errorMsg = "fields must be filled.";
	                        }

	                        include("viewSportsEquipment.php");
	                    }   

					?>


					

					<?php
			        if(isset($errorMsg)){
			            ?>
			            <div class="errorMsg"><?php echo $errorMsg; ?></div>
		                <?php	
		        	}
			  		?>

				</div>
			</div>
		</div>
	</body>
</html>