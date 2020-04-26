<?php
		
	$con = new mysqli("localhost:3307", "musify", "musify1234", "musify");
	// Check connection
	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	
	if(isset($_POST['userID'])){
		if($_POST['following'] == 0){
			$sql="INSERT INTO userfollowsplaylist (UserID,PlaylistID) 
					VALUES
					('$_POST[followerID]','$_POST[userID]')";
					
			if (!mysqli_query($con,$sql))
			{
				die('Error: ' . mysqli_error($con));
			}
			echo "1 record added"; // Output to user
		}
		else{
			$sql="DELETE FROM userfollowsplaylist 
				WHERE UserID = '$_POST[followerID]' AND PlaylistID = '$_POST[userID]'";
					
			if (!mysqli_query($con,$sql))
			{
				die('Error: ' . mysqli_error($con));
			}
			echo "1 record removed"; // Output to user
		}
	}
	mysqli_close($con);



?>

