<?php

function connectDB() {
  // include_once("../con.php"); // To connect to the database
  $con = new mysqli("localhost:3306", "musify", "musify1234", "musify");
  // Check connection
  if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  return $con;
}

// Fetch Playlist Owner Name
function getPlaylistOwnerName($playlistID) {
  $con = connectDB();
  $sql="SELECT PlaylistOwnerID
	FROM Playlist
	WHERE PlaylistID = $playlistID";
  $result = mysqli_query($con,$sql);
  if (!$result) {
    printf("Error: %s\n", mysqli_error($con));
    exit();
  }
  $id = mysqli_fetch_array($result)[0];
  $sql="SELECT Username
	FROM User
	WHERE UserID = $id";
  $result = mysqli_query($con,$sql);
  if (!$result) {
    printf("Error: %s\n", mysqli_error($con));
    exit();
  }
  $name = mysqli_fetch_array($result)[0];
  mysqli_close($con);
  return $name;
}


// Fetch Playlist Name
function getPlaylistName($playlistID) {
  $con = connectDB();
  $sql="SELECT PlaylistName
	FROM Playlist
	WHERE PlaylistID = $playlistID";
  $result = mysqli_query($con,$sql);
  if (!$result) {
    printf("Error: %s\n", mysqli_error($con));
    exit();
  }
  $title = mysqli_fetch_array($result)[0];
  mysqli_close($con);
  return $title;
}

// Fetch Playlist
function getPlaylist($playlistID) {
  $con = connectDB();

  $sql="SELECT SongID, SongTitle, genre, language, year
		FROM PlaylistContainsSong NATURAL JOIN Song 
        WHERE PlaylistID = $playlistID
		ORDER BY year DESC";
  $result = mysqli_query($con,$sql);

  if (!$result) {
    printf("Error: %s\n", mysqli_error($con));
    exit();
  }
  echo "<table border='1'>
  <tr>
  <th>Title</th>
  <th>Genre</th>
  <th>Language</th>
  <th>Year Released</th>
  </tr>";
     // Print the data from the table row by row
     while($row = mysqli_fetch_array($result)) {
		   echo "<tr>";
           echo "<td><a href=ViewSong.php?song_id='" . $row['SongID'] . "'>" . $row['SongTitle'];
		   echo "</td>";
		   echo "<td>" . $row['genre'];
		   echo "</td>";
           echo "<td>" . $row['language'];
		   echo "</td>";
		   echo "<td>" . $row['year'];
           echo "</td>";
		   echo "</tr>";
	}
  echo "</table>";
  mysqli_close($con);
}

?>
