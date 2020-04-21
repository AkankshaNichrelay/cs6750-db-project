<?php
    function connectDB() {
      include_once("./con.php"); // To connect to the database
      $con = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE);
      // Check connection
      if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
      }
      return $con;
    }

    // Song Search
    function getSongSearch($formInput) {
      $con = connectDB();
      $sql="SELECT *
            FROM Song
            WHERE SongTitle = $formInput";
      $result = mysqli_query($con, $sql);

      if (!$result) {
        printf("Error: %s\n", mysqli_error($con));
        exit();
      }

      while($row = mysqli_fetch_array($result)) {
        echo $row['SongID'] . " " . $row['SongTitle'] . $row['genre'] . "<br> ";
        echo _getArtistsOwnSong($row['SongID'], $con) . "\n";
      }
      mysqli_close($con);
    }

    // Find the artists that own a song
    function _getArtistsOwnSong($songID, $con) {
      $sql="SELECT ArtistName
            FROM Artist
            WHERE ArtistID IN (
              SELECT ArtistID
              FROM ArtistOwnsSong
              WHERE SongID = $songID
            )";
      $result = mysqli_query($con, $sql);
      if (!$result) {
        printf("Error: %s\n", mysqli_error($con));
        exit();
      }

      $ret = "";
      while($row = mysqli_fetch_array($result)) {
        $ret = $ret . $row['ArtistName'] . ",";
      }
      return $ret;
    }

    // Owned Playlists
    function getOwnedPlaylists($userID) {
      $con = connectDB();
      $sql="SELECT PlaylistName, PlaylistID 
            FROM Playlist 
            WHERE PlaylistOwnerID = $userID";
      $result = mysqli_query($con,$sql);

      if (!$result) {
        printf("Error: %s\n", mysqli_error($con));
        exit();
      }

      while($row = mysqli_fetch_array($result)) {
        echo $row['PlaylistID'] . " " . $row['PlaylistName'] . "<br>\n ";
      }
      mysqli_close($con);
    }
    
    // Artists followed
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
        echo $row['ArtistID'] . " " . $row['ArtistName'] . "<br> \n";
      }
      mysqli_close($con);
    }

    // Users followed
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
        echo $row['UserID'] . " " . $row['UserName'] . "<br> \n";
      }
      mysqli_close($con);
    }

    $userID="2";
    $formInput="'Style'";
    // getUsersFollowed($userID);
    getSongSearch($formInput);
?>
