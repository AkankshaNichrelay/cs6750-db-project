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

function getPlaylistID($username) {
	$con = connectDB();
    $sql="SELECT PlaylistID
          FROM playlist
          WHERE PlaylistName = '$username'";
    $result = mysqli_query($con, $sql);
	if (!$result) {
      printf("Error: %s\n", mysqli_error($con));
      exit();
    }
    return mysqli_fetch_array($result)['PlaylistID'];
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


function getNumFollowers($userID) {
    $con = connectDB();
    $sql="SELECT *
          FROM userfollowsplaylist
          WHERE PlaylistID = $userID";
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
            FROM userfollowsplaylist
            WHERE PlaylistID = $userID
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

function getPlaylistsOwner($userID) {
    $con = connectDB();
	$sql="SELECT PlaylistOwnerID
			FROM playlist 
			WHERE PlaylistID = $userID";
    $result = mysqli_query($con, $sql);
    
    if (!$result) {
        printf("Error: %s\n", mysqli_error($con));
        exit();
    }
    
     return mysqli_fetch_array($result)['PlaylistOwnerID'];
}

function AlreadyfollowsPlaylist($playlistID,$followerID) {
    $con = connectDB();
	//INSERT INTO Persons (FirstN, LastN, Age)
	//VALUES
	$sql="Select PlaylistID
			FROM userfollowsplaylist 
			WHERE PlaylistID = '$playlistID' AND UserID = '$followerID' LIMIT 1";
    $result = mysqli_query($con, $sql);
    
    if (!$result) {
        return 0;
    }
	$row = mysqli_fetch_array($result);
	if ($row['PlaylistID'] == $playlistID){
		return 1;
	}
	return 0;
}

function getPlaylistsOwnedByID($userID,$playlistID) {
    $con = connectDB();
	$sql="SELECT PlaylistName 
			FROM playlist 
			WHERE PlaylistOwnerID = $userID AND PlaylistID <> $playlistID ";
    $result = mysqli_query($con, $sql);
    
    if (!$result) {
        printf("Error: %s\n", mysqli_error($con));
        exit();
    }
    
    while ($row = mysqli_fetch_array($result)) {
		echo "<li class='profileListItem'>"
			."<a class='profileListItem' href='../ViewProfile/ViewPlaylist.php?peopleSearch=". $row['PlaylistName'] . "' >"
			. $row['PlaylistName'] . "</a></li>";
    }
    mysqli_close($con);
}


?>
