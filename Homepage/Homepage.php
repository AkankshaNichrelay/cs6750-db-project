<?php
include_once("./homepage_lib.php");
include_once("../Header/Header.php");
?>
<h3> Your playlists </h3>
<?php
$userID = 2;
getOwnedPlaylists($userID)
?>

<h3> Your followed artists </h3>
<?php
$userID = 2;
getArtistsFollowed($userID)
?>

<h3> Users you follow </h3>
<?php
$userID = 2;
getUsersFollowed($userID)
?>

</body>
</html>