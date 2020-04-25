<!DOCTYPE html>
<?php
include_once("./playlist_lib.php");
$playlistID = $_GET['playlist_id'];
?>
<html>
<body>
	<div class=row>
		<?php
		$title = getPlaylistName($playlistID);
		$owner = getPlaylistOwnerName($playlistID);
		?>
		<h2 style="text-align:left"><?php echo $title;?></h2>
		<h5 style="text-align:left">Owned by: <?php echo $owner;?></h5>
	</div>
    <div class=row>
            <?php
			getPlaylist($playlistID)
            ?>
    </div>
</body>
</html>
