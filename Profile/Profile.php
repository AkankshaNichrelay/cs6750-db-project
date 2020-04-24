<?php
include_once("../Profile/profile_lib.php");
include_once("../Header/Header.php");

$userID = 2;
?>
<div class="profileHost">
<?php
echo "<h1 class='profileHeader'>" . getUserName($userID) . "</h1>";
echo "<h3 class='statsHeader'> Following: " . 
        getNumArtistsFollowed($userID) . 
        " Artists and " . 
        getNumUsersFollowed($userID) . 
        " Users</h3>";
echo "<h3 class='statsHeader'>" . getNumFollowers($userID) . " Followers </h3>"
?>
<div class='profileRow'>
    <div class='profileColumn'> 
        <h3 class="followingHeader"> Artists you're folliowing: </h3>
        <?php 
            getArtistsFollowed($userID);
        ?>
    </div>
    <div class='profileColumn'>
        <h3 class="followingHeader"> People you're following: </h3>
        <?php
        ?>
    </div>
</div>

</div>
</body>
</html>
