<?php
include_once("../ViewProfile/ViewProfile_lib.php");
include_once("../Header/Header.php");
//include_once("../ViewProfile/ViewProfile.css");

$username = $_GET['peopleSearch'];
$userID = 2;
?>

<div class="profileHost">

<?php

$peopleID = getUserID($username);
$followsUser = AlreadyfollowsUser($peopleID,$userID);

echo "<input type='hidden' id='hiddenFollowUser' name='followUser' value='" . $followsUser . "'/>";

//echo "people ID: " . $followsUser;
echo "<h1 class='profileHeader'>" . $username . "</h1>";
echo "<h3 class='statsHeader'> Following: " . 
        getNumArtistsFollowed($peopleID) . 
        " Artists and " . 
        getNumUsersFollowed($peopleID) . 
        " Users</h3>";
echo "<h3 class='statsHeader'>" . getNumFollowers($peopleID) . " Followers </h3>";
if($peopleID != $userID){
	echo "<div class='container' > <input class='btn followButton' id='followBtn' type='Submit'" 
		."onclick=myAjax('" .$peopleID ."','". $userID. "') value='" . (($followsUser == 1)? 'Unfollow': 'Follow') ."' /> </div>";
}

?>
<div class='profileRow'>
    <div class='profileColumn'> 
        <h3 class="followingHeader"> Artists followed by <?php echo $username; ?>: </h3>
        <?php 
            getArtistsFollowed($peopleID);
        ?>
    </div>
    <div class='profileColumn' id='followersDiv'>
        <h3 class="followingHeader"> Followers: </h3>
        <?php
			getUsersFollowingID($peopleID);
        ?>
    </div>
</div>

<div class='profileRow'>
    <div class='profileColumn'> 
        <h3 class="followingHeader"> Playlists followed by <?php echo $username; ?>: </h3>
        <?php 
            getPlaylistsFollowedByID($peopleID);
        ?>
    </div>
    <div class='profileColumn'>
        <h3 class="followingHeader"> Playlists created by <?php echo $username ?>: </h3>
        <?php
			getPlaylistsOwnedByID($peopleID);
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
           url: 'followUser.php',
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
			 //$("#followersDiv").load("ViewProfile.php #followersDiv");
           }

      });
 }
</script>

</html>