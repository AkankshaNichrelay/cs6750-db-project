<?php
include_once("./homepage_lib.php");
include_once("../Header/Header.php");
?>
<div class="listHost">
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

</body>
</html>