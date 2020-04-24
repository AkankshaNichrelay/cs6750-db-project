<?php
include_once("./homepage_lib.php");
include_once("../Header/Header.php");
?>
<div class="listHost">
    <div class="homeColumn">
        <h3 class="listHeader"> Your playlists </h3>
            <?php
            $userID = 2;
            getOwnedPlaylists($userID)
            ?>

        <h3 class="listHeader"> Your followed artists </h3>
            <?php
            $userID = 2;
            getArtistsFollowed($userID)
            ?>

        <h3 class="listHeader"> Users you follow </h3>
            <?php
            $userID = 2;
            getUsersFollowed($userID)
            ?>
    </div>
    <div class="homeColumn">
        <h3 class='listHeader'> Search People </h3>
        <form action="../ViewProfile/ViewProfile.php" method="GET">
            <input class="searchBar" type="text" id="peopleSearch" name="peopleSearch">
            <input type="submit" value="Submit">
        </form>
        <h3 class='listHeader'> Search Songs </h3>
        <form action="../ViewSong/ViewSong.php" method="GET">
            <input class="searchBar" type="text" id="songSearch" name="songSearch">
            <input type="submit" value="Submit">
        </form>
    </div>
</div>

</body>
</html>