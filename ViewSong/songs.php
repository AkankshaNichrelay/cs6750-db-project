<?php
include_once("../ViewSong/songs_lib.php");
include_once("../Header/Header.php");

$userID = 2;
$albumsearch="";
$artistsearch="";

if(isset($_GET['albumSearch']))
{
    $albumsearch=$_GET['albumSearch'];
}
if(isset($_GET['artistSearch']))
{
    $artistsearch=$_GET['artistSearch'];
}

?>
<div class="profileHost">
<div class='profileRow'>
    <div class='profileColumn'> 
        <h3 class="followingHeader"> List Of All the Songs </h3>
        <?php 
            getSongs($albumsearch,$artistsearch);
        ?>

    </div>
<div class="profileColumn">
        <h3 class='listHeader'> Filter songs by Artist Name </h3>
        <form action="../ViewSong/songs.php" method="GET">
            <input class="searchBar" type="text" id="artistSearch" name="artistSearch">
            <input type="submit" value="Submit">
        </form>
        <h3 class='listHeader'> Filter songs by Album Name  </h3>
        <form action="../ViewSong/songs.php" method="GET">
            <input class="searchBar" type="text" id="albumSearch" name="albumSearch">
            <input type="submit" value="Submit">
        </form>
    </div>
</div>
</div>
</body>
</html>
