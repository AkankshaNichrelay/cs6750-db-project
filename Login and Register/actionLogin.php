<html>
<head>
  <title>Welcome page</title>
  <link rel="stylesheet" href="styles/LoginF.css">
</head>
<body class="main">

<h1>Welcome back!</h1>

  <?php
  	$SERVER = 'localhost:3306';
  	$USERNAME = htmlspecialchars($_POST['username']);
  	$PASSWORD = htmlspecialchars($_POST['password']);
  	$DATABASE = 'MusiFi';

  	$con = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE);

  	//Check connection
  	if (mysqli_connect_errno())
     {
     echo "Failed to connect to MySQL: " . mysqli_connect_error();
     }
     else{
   // Form the SQL query (an INSERT query)
     echo "You are succesfully connected!";
     echo "<br>";

     //Check if they are an artist or a user
     $user_type = "SELECT * FROM Artist WHERE ArtistName='$USERNAME' ";
     $r_ut = mysqli_query($con, $user_type);

     //To set role
     //https://dev.mysql.com/doc/refman/8.0/en/set-role.html

     //if they are an artist:
     if ($r_ut){
      $artistcheck = 'no';
      while($row = mysqli_fetch_array($r_ut)) {
             $artistcheck = 'yes';
         }}
     
     if ($artistcheck=='yes'){
      echo "<br> You're an artist.";

      //Set appropriate privileges
      $role = "SET ROLE ONLYARTISTS";


     }
     //if they are a user:
     else{
      echo "<br> You're a user.";

      //Set appropriate privileges
      $role = "SET ROLE ONLYUSERS";
     }
     //

     if(mysqli_query($con, $role)){
      echo "<br> Role succesfully set.";
      } 
    else{
        echo "<br> ERROR: Unable to execute query. " . mysqli_error($con);
    }

     /*
     $my_info = "SELECT * FROM User WHERE username='$USERNAME'";

      $r_mp = mysqli_query($con, $my_info);

      if(mysqli_query($con, $my_info)){
        while($row = mysqli_fetch_array($r_mp)) {
             echo 'Your userID is '. $row['UserID'];
             echo " and your email is " . $row['email'];
             echo "<br>";
         }
      } 
    else{
        echo "ERROR: Unable to execute query. " . mysqli_error($con);
    } */

       mysqli_close($con);
     }
  ?>


</body>
</html>