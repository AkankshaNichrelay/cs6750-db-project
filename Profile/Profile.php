<?php
include_once("../Profile/profile_lib.php");
include_once("../Header/Header.php");

$userID = 2;
echo "<h1>" . getUserName($userID) . "</h1>";
echo "<h3> Following: " . 
        getNumArtistsFollowed($userID) . 
        " Artists and " . 
        getNumUsersFollowed($userID) . 
        " Users</h3>";
echo "<h3>" . getNumFollowers($userID) . " Followers </h3>"
?>
<h3> Artists you're folliowing: </h3>
<?php 
    getArtistsFollowed($userID);
?>

<h3> People you're following: </h3>
<?php
?>

</body>
</html>
