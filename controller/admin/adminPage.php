<?php
	session_start();
	include("../dbConfig.php");
	//error_reporting(0);
	$username = $_SESSION['username'];

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
        header("location: ../home.php?activity=adminLogin");
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
		<link rel="stylesheet" type="text/css" href="../../css/inputs.css">
		<link rel="stylesheet" type="text/css" href="../../css/form.css">
	</head>
	<body>
		<div class="container">
			<div class="header">
				<?php include("../header.php"); ?>
			</div>
			<div class="userContainer">
				<div class="title">Admin Page</div>

				<div class="userWelcome">Welcome : <?php echo $_SESSION['username']; ?></div>

				<div class="logout"><a href="adminPage.php?activity=logout">Logout</a></div>

				<div class="userAction">
					<ul>
						
						<li><a href="adminPage.php?activity=viewProfile">View Profile</a></li>
						<li><a href="adminPage.php?activity=editProfile">Edit Profile</a></li>
						<li><a href="adminPage.php?activity=viewUsers">View Users</a></li>
						<li><a href="adminPage.php?activity=addSportsEquipment">Add Sports Equipment</a></li>
						<li><a href="adminPage.php?activity=viewSportsEquipment">View Sports Equipment</a></li>
						<li><a href="adminPage.php?activity=issuedSportsEquipment">Issued Sports Items</a></li>
				
					</ul>
				</div>

				<div class="userContent">
					<?php
					//ACTIVITY PERFORM...

						$activity = $_REQUEST['activity'];

						switch ($activity) {
							
							
							case 'viewProfile':
								include("viewProfile.php");
								break;

							case 'editProfile':
								include("editProfile.php");
								break;

							case 'viewUsers':
								include("viewUsers.php");	
								break;	

							case 'addSportsEquipment':
					
							     include("addSportsEquipment.php");
								break;	

							case 'viewSportsEquipment':
								
                                 include("viewSportsEquipment.php");
								break;

							case 'issuedSportsEquipment':
								include("issuedSportsEquipment.php");
								break;	

							
                             case 'sportsEquipmentDetails':
                                include("sportsEquipmentDetails.php");
                                break;

							case 'viewUserProfile':
								include("viewUserProfile.php");
								break;

							

							
                                case 'deleteSportsEquipment':
                                    
                                    $EquipmentId = $_REQUEST['EquipmentId'];
                                    
                                    
                                   $result = mysqli_num_rows(mysqli_query($con,"SELECT EquipmentId FROM Borrow Where EquipmentId = '$EquipmentId'"));
                                    $availabilityEquipment = mysqli_num_rows(mysqli_query($con,"SELECT EquipmentId FROM Sports_stock WHERE EquipmentId = '$EquipmentId'"));
                               
                                    if(empty($result) && !empty($availabilityEquipment)){
                                        if(mysqli_query($con,"DELETE FROM Sports_stock Where EquipmentId = '$EquipmentId'"))
                                        {

                                        header("location: adminPage.php?activity=viewSportsEquipment");
                                       }
                                    else
                                    {
                                        echo "Data could not be deleted";
                                    }
                                    }
                                   else{
                                        include("viewSportsEquipment.php");
                                        $errorMsg = "Equipment is issued to someone.So, it can't be deleted until it is available to library.";
                                   }

                                break;

                           
                                 case 'updateSportsEquipment':
                                    
                                    $EquipmentId = $_REQUEST['EquipmentId'];

                                    if(!empty($EquipmentId)){

                                        //$result = mysqli_fetch_assoc(mysqli_query($con,"SELECT availability FROM Sports_stock WHERE EquipmentId = '$EquipmentId'"));

                                        //if($result['availability'] >= 0){

                                            $result = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM Sports_stock WHERE EquipmentId = 'EquipmentId'"));
                                            ?>
                                            <div class="title">Update Sports Equipment</div>
                                            <div class="bookUpdateForm">
                                                <form action="adminPage.php">
                                                    <input type="text" name="EquipmentId" value=<?php echo $EquipmentId; ?> readonly><br>
                                                  
                                                
                                                    <input type="text" name="availability" required autofocus placeholder="Availability" ><br>
                                                   
                                                
                                                    <input type="date" name="entryDate"><br>
                                                
                                                    <input type="submit" name="updateSportsEquipmentBtn" value="Update">
                                                </form>
                                            </div>
                                            <?php 
                                        }

                                        else{
                                            include("viewSportsEquipment.php");
                                            $errorMsg = "Item is issued to someone. So it can't be edited.";
                                        }
                                    

                                break;



                                 case 'updateSportsEquipment-II':
                                    
                                    $EquipmentId = $_SESSION['EquipmentId'];
                                    $oldAvailability=$_SESSION['availability'];

                                    //echo "$EquipmentId";
                                    //echo "$oldAvailability";

                                    $result = mysqli_fetch_assoc(mysqli_query($con,"SELECT availability FROM Sports_stock WHERE EquipmentId = '$EquipmentId'"));

                                    if(!empty($EquipmentId) && $result['availability']>$oldAvailability){

                                    
                                          $_SESSION['increaseAvailability']=$result['availability']-$oldAvailability;
                                        ?>

                                            <div class="title">Update-Sports-Item</div>
                                            <div class="addBookForm">
                        <form action="adminPage.php">
                                <input type="text" name="EquipmentId" required autofocus placeholder="Equipment-ID" value=<?php echo "$EquipmentId"; ?> readonly><br>
                                     <?php  $i=1; while($i<=($result['availability']-$oldAvailability)){ ?>
                                 <label>Item ID <?php echo "$i"?></label><input type="text" name="itemid<?php echo 
                            "$i"; ?>" required autofocus placeholder="Item ID">
                                <br>
                                <label>Brand<?php echo "$i"?></label><input type="text" name="brand<?php echo "$i"; ?>" required autofocus placeholder="Brand">
                                <br>
                                <label>No of Items<?php echo "$i"?></label><input type="text" name="no_of_items<?php echo "$i"; ?>" required autofocus placeholder="No of Items">
                                <br>
                            <?php $i=$i+1;}?>
                            <input type="submit" name="updateSportsEquipment-IIBtn" value="Update Equipment"><br>
                                  </form>
                                </div>
                                            <?php 
                                        }
                                        else
                                            if(!empty($EquipmentId) && $result['availability']<$oldAvailability)
                                            {
                                                 $_SESSION['decreaseAvailability']=$oldAvailability-$result['availability'];
                                                    ?>
                                                   <div class="addBookForm">
                           <form action="adminPage.php">
                                <input type="text" name="EquipmentId" required autofocus placeholder="Equipment-ID" value=<?php echo "$EquipmentId"; ?> readonly><br>
                                     <?php  $i=1; while($i<=($oldAvailability-$result['availability'])) { ?>
                                 <label>Item ID <?php echo "$i"?></label><input type="text" name="itemid<?php echo 
                            "$i"; ?>" required autofocus placeholder="Item ID">
                                <br>
                               
                            <?php $i=$i+1;}?>
                            <input type="submit" name="updateSportsEquipment-IIIBtn" value="Delete Equipment"><br>
                                  </form>
                                </div>
                                <?php 
                                }
                                   else{
                                        include("viewSportsEquipment.php");
                                        //$errorMsg = "Equipment is issued to someone.So, it can't be deleted until it is available to library.";
                                  
                                            $errorMsg = "Item  is issued to someone. So it can't be edited.";
                                        }
                                    

                                break;





						}
					?>

					

                    <?php
                    //UPDATE ...

                        if(isset($_REQUEST['updateSportsEquipmentBtn'])){

                            $EquipmentId = $_REQUEST['EquipmentId'];
                           
                            $availability = $_REQUEST['availability'];
                            $entryDate = $_REQUEST['entryDate'];
                            $_SESSION['EquipmentId']=$EquipmentId;

                            $result = mysqli_fetch_assoc(mysqli_query($con,"SELECT availability FROM Sports_stock WHERE EquipmentId = '$EquipmentId'"));
                            $_SESSION['availability']=$result['availability'];

                            if(!empty($EquipmentId) && !empty($availability) &&!empty($entryDate)){

                                $result = mysqli_query($con,"UPDATE Sports_stock SET  availability = '$availability' ,entryDate='$entryDate' WHERE EquipmentId = '$EquipmentId'");

                                if(!empty($result)){
                                    header("location: adminPage.php?activity=updateSportsEquipment-II");
                                }
                            }
                            else{
                                $errorMsg = "Please! Enter in the Empty Field.";
                            }
                        }

                    ?>


                    <?php
                    if(isset($_REQUEST['updateSportsEquipment-IIBtn'])){
                            $tempAvailability=$_SESSION['increaseAvailability'];
                             
                            $i=1;
                             while($i<=$tempAvailability)
                             {

                                
                      
                            $EquipmentId = $_REQUEST['EquipmentId'];
                             $itemid = $_REQUEST['itemid'.$i];
                            $brand= $_REQUEST['brand'.$i];
                            $no_of_items=$_REQUEST['no_of_items'.$i];

                            if(!empty($EquipmentId) && !empty($itemid) && !empty($brand) && !empty($no_of_items)){

                               $user_check_query = "SELECT * FROM Sport_item WHERE itemid='$itemid' LIMIT 1";
   
                               $result = mysqli_query($con, $user_check_query);
                              $user = mysqli_fetch_assoc($result);

                          if ($user) { // if user exists
                        if ($user['itemid'] === $itemid) {
                   //array_push($errors, "SPORT Equipment with this itemId already exists");
                            $errorMsg = "SPORT Equipment with this itemId already exists";

                            
                        }
                      }
                        else
                            {
 
                                    $query = "INSERT INTO Sport_item(itemid, brand, EquipmentId,no_of_items) VALUES ('$itemid', '$brand', '$EquipmentId','$no_of_items')";
                                    mysqli_query($con, $query);
                                    $errorMsg = "Sports Equipment Sucessfully Added.";
                                    include("viewSportsEquipment.php");
                                
                               }

                            }
                            else{
                                $errorMsg = "Please! Enter in Empty Field.";
                            }
                            $i=$i+1;
                        }
                        
                            

                            
                        }

                    ?>

                    <?php
                    if(isset($_REQUEST['updateSportsEquipment-IIIBtn'])){
                            $tempAvailability=$_SESSION['decreaseAvailability'];
                             
                            $i=1;
                             while($i<=$tempAvailability)
                             {

                                
                      
                            $EquipmentId = $_REQUEST['EquipmentId'];
                             $itemid = $_REQUEST['itemid'.$i];
                           
                         

                            if(!empty($EquipmentId) && !empty($itemid)){

                              
 
                                    $query = "DELETE From Sport_item WHERE itemid='$itemid'";
                                    mysqli_query($con, $query);
                                    $errorMsg = "Sports Equipment Sucessfully Deleteed.";
                                    include("viewSportsEquipment.php");
                                
                               

                            }
                            else{
                                $errorMsg = "Please! Enter in Empty Field.";
                            }
                            $i=$i+1;
                        }
                        }
                            

                            
                        

                    ?>

					<?php
	                //Edit Admin...

	                    if(isset($_REQUEST['adminUpdateBtn'])){

	                        $uadminId = $_REQUEST['uadminId'];
	                        $firstName = $_REQUEST['firstName'];
	                        $lastName = $_REQUEST['lastName'];
	                        $username = $_REQUEST['username'];
	                        $pwd = $_REQUEST['pwd'];
	                        $email = $_REQUEST['email'];

	                        


	                        $query1 = mysqli_query($con,"UPDATE admin Set firstName ='$firstName', lastName ='$lastName', username ='$username', pwd ='$pwd', email ='$email' Where id = '$uadminId'");

	                        if($query1){
	                            //$errorMsg = "Updation is successfully done.";
	                            header("location: adminPage.php?activity=viewProfile");
	                        }
	                        //include("editProfile.php");
	                    }    
	                ?>

                   


    
                    <?php
                    if(isset($_REQUEST['addSportsEquipmentBtn'])){

                            $EquipmentId = $_REQUEST['EquipmentId'];
                            $availability = $_REQUEST['availability'];
                            $sport_item = $_REQUEST['sport_item'];
                            $entryDate = $_REQUEST['entryDate'];
                            $category = $_REQUEST['formCategory'];

                            if(!empty($EquipmentId) && !empty($availability) && !empty($sport_item) && !empty($entryDate) && !empty($category)){
                            	 $user_check_query = "SELECT * FROM Sports_stock WHERE EquipmentId='$EquipmentId' LIMIT 1";
   
                               $result = mysqli_query($con, $user_check_query);
                              $user = mysqli_fetch_assoc($result);

                          if ($user) { // if user exists
                  		if ($user['EquipmentId'] === $EquipmentId) {
                   //array_push($errors, "SPORT Equipment with this itemId already exists");
                	 		$errorMsg = "SPORT Equipment with this EquipmentId already exists";
                  		}
                  	  }
                        else

                              { // if($maxRows){

                                    $query = "INSERT INTO Sports_stock(EquipmentId,availability, entryDate,sport_item,category) 
          VALUES('$EquipmentId','$availability', '$entryDate','$sport_item','$category')";
                                    mysqli_query($con, $query);
                                    $errorMsg = "Sports Equipment Sucessfully Added.";

                                   
                                 $_SESSION['EquipmentId']="$EquipmentId";
                                 $_SESSION['availability']="$availability";
                                include("addSportsEquipment-II.php");
                               

                            }
                        }
                            else{
                                $errorMsg = "Please! Enter in Empty Field.";
                            }

                            
                        }

                    ?>


                     <?php
                    if(isset($_REQUEST['addSportsEquipment-IIBtn'])){
                            $tempAvailability=$_SESSION['availability'];
                             
                            $i=1;
                             while($i<=$tempAvailability)
                             {

                             	
                      
                            $EquipmentId = $_REQUEST['EquipmentId'];
                             $itemid = $_REQUEST['itemid'.$i];
                            $brand= $_REQUEST['brand'.$i];
                            $no_of_items=$_REQUEST['no_of_items'.$i];

                            if(!empty($EquipmentId) && !empty($itemid) && !empty($brand) && !empty($no_of_items)){

                               $user_check_query = "SELECT * FROM Sport_item WHERE itemid='$itemid' LIMIT 1";
   
                               $result = mysqli_query($con, $user_check_query);
                              $user = mysqli_fetch_assoc($result);

                          if ($user) { // if user exists
                  		if ($user['itemid'] === $itemid) {
                   //array_push($errors, "SPORT Equipment with this itemId already exists");
                	 		$errorMsg = "SPORT Equipment with this itemId already exists";
                  		}
                  	  }
                        else
                  			{
 
                                    $query = "INSERT INTO Sport_item(itemid, brand, EquipmentId,no_of_items) VALUES ('$itemid', '$brand', '$EquipmentId','$no_of_items')";
                                    mysqli_query($con, $query);
                                    $errorMsg = "Sports Equipment Sucessfully Added.";

                                   
                             
                                
                               }

                            }
                            else{
                                $errorMsg = "Please! Enter in Empty Field.";
                            }
                            $i=$i+1;
                        }
                        include("addSportsEquipment.php");
                            

                            
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