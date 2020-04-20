<?php
   include_once("./con.php"); // To connect to the database
   $con = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE);
   // Check connection
   if (mysqli_connect_errno())
     {
     echo "Failed to connect to MySQL: " . mysqli_connect_error();
     }
   // Form the SQL query (an INSERT query)
   $sql="SELECT * FROM Playlist";
   $result = mysqli_query($con,$sql);
     // Print the data from the table row by row
     while($row = mysqli_fetch_array($result)) {
           echo $row['PlaylistID'];
           echo " " . $row['PlaylistOwnerID'];
           echo " " . $row['PlaylistName'];
           echo "<br>";
}
   mysqli_close($con);
?>
