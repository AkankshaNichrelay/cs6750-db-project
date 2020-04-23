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

function getUserName($userID) {
    $con = connectDB();
    $sql="SELECT Username
          FROM User
          WHERE UserID = $userID";
    $result = mysqli_query($con, $sql);

    return mysqli_fetch_array($result)['Username'];
}

function getArtistsFollowed($userID) {
    $con = connectDB();
    $sql="SELECT ArtistID, ArtistName 
          FROM Artist 
          WHERE ArtistID IN (
            SELECT ArtistID 
            FROM UserFollowsArtist 
            WHERE UserID = $userID
          )";
    $result = mysqli_query($con, $sql);
  
    if (!$result) {
      printf("Error: %s\n", mysqli_error($con));
      exit();
    }
    
    while ($row = mysqli_fetch_array($result)) {
      echo "<li><a href='#'>" . $row['ArtistName'] . "</a></li>";
    }
    mysqli_close($con);
}

function getNumArtistsFollowed($userID) {
    $con = connectDB();
    $sql="SELECT *
          FROM Artist 
          WHERE ArtistID IN (
            SELECT ArtistID 
            FROM UserFollowsArtist 
            WHERE UserID = $userID
          )";
    $result = mysqli_query($con, $sql);
    if (!$result) {
        return 0;
    }
    return mysqli_num_rows($result);
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
          FROM UserFollowsUser
          WHERE UserID2 = $userID";
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
      echo "<li class='listItem'><a class='listItem' href='#'>" . $row['UserName'] . "</a></li>";
    }
    mysqli_close($con);
}

function getUsersFollowingID($userID) {
    $con = connectDB();
    $sql="SELECT UserID, UserName
            FROM User
            WHERE UserID IN (
            SELECT UserID1
            FROM UserFollowsUser
            WHERE UserID2 = $userID
            )";
    $result = mysqli_query($con, $sql);
    
    if (!$result) {
        printf("Error: %s\n", mysqli_error($con));
        exit();
    }
    
    while ($row = mysqli_fetch_array($result)) {
        echo "<li class='listItem'><a class='listItem' href='#'>" . $row['UserName'] . "</a></li>";
    }
    mysqli_close($con);
}
?>