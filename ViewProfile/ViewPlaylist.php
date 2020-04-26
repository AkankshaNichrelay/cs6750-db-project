<?php
include_once("../ViewProfile/ViewPlaylist_lib.php");
include_once("../Header/Header.php");
//include_once("../ViewProfile/ViewProfile.css");

$playlistname = $_GET['peopleSearch'];
$userID = 2;
?>

<div class="profileHost">

<?php

$artistID = getPlaylistID($playlistname);
$followsUser = AlreadyfollowsPlaylist($artistID,$userID);
$playlistOwner = getPlaylistsOwner($artistID);

echo "<input type='hidden' id='hiddenFollowUser' name='followUser' value='" . $followsUser . "'/>";

//echo "people ID: " . $followsUser;
echo "<h1 class='profileHeader'>" . $playlistname . "</h1>";
echo "<h3 class='statsHeader'>Created by " . getUserName($playlistOwner) . " </h3>";
echo "<h3 class='statsHeader'>Followed by " . getNumFollowers($artistID) . " Followers </h3>";

echo "<div class='container' > <input class='btn followButton' id='followBtn' type='Submit'" 
	."onclick=myAjax('" .$artistID ."','". $userID. "') value='" . (($followsUser == 1)? 'Unfollow': 'Follow') ."' /> </div>";


?>
<div class='profileRow'>
    <div class='profileColumn' id='followersDiv' >
        <h3 class="followingHeader"> Followers: </h3>
        <?php
			getUsersFollowingID($artistID);
        ?>
    </div>
	<div class='profileColumn'>
        <h3 class="followingHeader"> More playlists created by <?php $playlistOwner ?>: </h3>
        <?php
			getPlaylistsOwnedByID($playlistOwner,$artistID);
        ?>
    </div>
</div>
</div>
</body>


<script src="js/jquery-1.6.2.min.js" type="text/javascript"></script> 
<script src="js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>

<script>

$(document).ready(function () {
	console.log('ready');
});


function myAjax(peopleID,userID) {
		console.log('clicked'+peopleID+' '+userID)
		hid = $( "#hiddenFollowUser" ).val()
      $.ajax({
           type: "POST",
           url: 'followPlaylist.php',
           data:{following:hid, userID: peopleID , followerID: userID},
           success:function(html) {
             console.log(html);
			 if (hid == 1){
				document.getElementById("hiddenFollowUser").value = 0;
				document.getElementById("followBtn").value = 'Follow';
			 }
			 else{
				document.getElementById("hiddenFollowUser").value = 1;
				document.getElementById("followBtn").value = 'Unfollow';
			 }	
			 $("#followersDiv").load(location.href+" #followersDiv>*","");
			 //$("#followersDiv").load(location.href+" #followersDiv>*","");
           }

      });
 }
</script>

</html>