<?php
function connectDB() {
  // include_once("../con.php"); // To connect to the database
  $con = new mysqli("localhost:3307", "musify", "musify1234", "musify");
  // Check connection
  if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  return $con;
}

function getArtistID($username) {
	$con = connectDB();
    $sql="SELECT ArtistID
          FROM Artist
          WHERE ArtistName = '$username'";
    $result = mysqli_query($con, $sql);
	if (!$result) {
      printf("Error: %s\n", mysqli_error($con));
      exit();
    }
    return mysqli_fetch_array($result)['ArtistID'];
}

function getUserName($userID) {
    $con = connectDB();
    $sql="SELECT Username
          FROM User
          WHERE UserID = $userID";
    $result = mysqli_query($con, $sql);
	if (!$result) {
      printf("Error in getUserName: %s\n", mysqli_error($con));
      exit();
    }

    return mysqli_fetch_array($result)['Username'];
}


function getNumUsersFollowed($userID) {
    $con = connectDB();
    $sql="SELECT *
            FROM UserFollowsUser 
            WHERE UserID1 = $userID";
    $result = mysqli_query($con, $sql);
    if (!$result) {
        return 0;
    }
    return mysqli_num_rows($result);
}

function getNumFollowers($userID) {
    $con = connectDB();
    $sql="SELECT *
          FROM userfollowsartist
          WHERE ArtistID = $userID";
    $result = mysqli_query($con, $sql);
    if (!$result) {
        return 0;
    }
    return mysqli_num_rows($result);
}

function getUsersFollowed($userID) {
    $con = connectDB();
    $sql="SELECT UserID, UserName
          FROM User
          WHERE UserID IN (
            SELECT UserID2
            FROM UserFollowsUser
            WHERE UserID1 = $userID
          )";
    $result = mysqli_query($con, $sql);
  
    if (!$result) {
      printf("Error: %s\n", mysqli_error($con));
      exit();
    }
  
    while ($row = mysqli_fetch_array($result)) {
      echo "<li class='profileListItem'><a class='profileListItem' href='#'>" . $row['UserName'] . "</a></li>";
    }
    mysqli_close($con);
}

function getUsersFollowingID($userID) {
    $con = connectDB();
    $sql="SELECT UserID, UserName
            FROM User
            WHERE UserID IN (
            SELECT UserID
            FROM userfollowsartist
            WHERE ArtistID = $userID
            )";
    $result = mysqli_query($con, $sql);
    
    if (!$result) {
        printf("Error: %s\n", mysqli_error($con));
        exit();
    }
    
    while ($row = mysqli_fetch_array($result)) {
        echo "<li class='profileListItem'>"
			."<a class='profileListItem' href='../ViewProfile/ViewProfile.php?peopleSearch=". $row['UserName'] . "' >"
			. $row['UserName'] . "</a></li>";
    }
    mysqli_close($con);
}

function getPlaylistsFollowedByID($userID) {
    $con = connectDB();
	$sql = "SELECT PlaylistName, PlaylistID 
			FROM playlist 
			WHERE PlaylistOwnerID IN 
			(SELECT PlaylistID 
				FROM userfollowsplaylist 
				WHERE UserID = $userID
			)";
			
    $result = mysqli_query($con, $sql);
    
    if (!$result) {
        printf("Error: %s\n", mysqli_error($con));
        exit();
    }
    
    while ($row = mysqli_fetch_array($result)) {
        echo "<div class='profileListItem'><a class='profileListItem' href='#'>" . $row['PlaylistName'] . "</a></div>";
    }
    mysqli_close($con);
}

function getPlaylistsOwnedByID($userID) {
    $con = connectDB();
	$sql="SELECT PlaylistName 
			FROM playlist 
			WHERE PlaylistOwnerID = $userID";
    $result = mysqli_query($con, $sql);
    
    if (!$result) {
        printf("Error: %s\n", mysqli_error($con));
        exit();
    }
    
    while ($row = mysqli_fetch_array($result)) {
        echo "<li class='profileListItem'><a class='profileListItem' href='#'>" . $row['PlaylistName'] . "</a></li>";
    }
    mysqli_close($con);
}

function AlreadyfollowsArtist($userID,$followerID) {
    $con = connectDB();
	//INSERT INTO Persons (FirstN, LastN, Age)
	//VALUES
	$sql="Select ArtistID
			FROM userfollowsartist 
			WHERE ArtistID = '$userID' AND UserID = '$followerID' LIMIT 1";
    $result = mysqli_query($con, $sql);
    
    if (!$result) {
        return 0;
    }
	$row = mysqli_fetch_array($result);
	if ($row['ArtistID'] == $userID){
		return 1;
	}
	return 0;
}


?>
