<?php

function connectDB() {
  // include_once("../con.php"); // To connect to the database
  $con = new mysqli("localhost:3306", "phpadmin", "123456", "musifi");
  // Check connection
  if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  return $con;
}


function getSongs($albumsearch,$artistsearch) {

    $con = connectDB();
    $sql="SELECT Songtitle, AlbumName, ArtistName 
          FROM song NATURAL JOIN album NATURAL JOIN artist";
    if($albumsearch!="")
    {
      $sql.=" WHERE AlbumName='$albumsearch'";
    }
    if($artistsearch!="")
    {
      $sql.=" WHERE ArtistName='$artistsearch'";
    }
    $result = mysqli_query($con, $sql);
    if (!$result) {
      printf("Error: %s\n", mysqli_error($con));
      exit();
    }
    echo "<table style='color:white;'><th>Songtitle</th><th>AlbumName</th><th>ArtistName</th>\n";
    while($row = mysqli_fetch_array($result)) 
    {
          echo "<tr><td>" . $row['Songtitle'] . "</td><td>". $row['AlbumName'] . "</td><td>" . $row['ArtistName'] . "</td></tr></h3>";
    }
    echo "</table>";
    mysqli_close($con);
}


function getSongdata($songname)
{

  $con = connectDB();
  $sql="SELECT Songtitle, AlbumName, ArtistName, SongID, genre, Language, year
          FROM song NATURAL JOIN album NATURAL JOIN artist WHERE Songtitle LIKE '%$songname%'";
  $result = mysqli_query($con, $sql);
  if (!$result) {
      printf("Error: %s\n", mysqli_error($con));
      exit();
    }
  $row = mysqli_fetch_array($result);
  echo "<table style='color:white;'><th>Songtitle</th><th>AlbumName</th><th>ArtistName</th><th>SongID</th><th>Genre</th><th>Language</th><th>Year</th>\n";
  echo "<tr><td>" . $row['Songtitle'] . "</td><td>". $row['AlbumName'] . "</td><td>" . $row['ArtistName'] . "</td><td>" . $row['SongID'] . 
  "</td><td>" . $row['genre'] . "</td><td>" . $row['Language'] . "</td><td>" . $row['year'] . "</td></tr></h3>";
  echo "</table>";
  mysqli_close($con);
}

function getUserName($userID) {
    $con = connectDB();
    $sql="SELECT Username
          FROM User
          WHERE UserID = $userID";
    $result = mysqli_query($con, $sql);

    return mysqli_fetch_array($result)['Username'];
}
?>