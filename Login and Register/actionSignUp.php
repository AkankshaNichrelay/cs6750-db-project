<html>
<head>
  <title>Welcome page</title>
  <link rel="stylesheet" href="styles/SignUp.css">
</head>
<body class="main">

<h1>Welcome To MusiFi!</h1>

  <?php

  $SERVER = 'localhost:3306';
  $Temp_USERNAME = 'root'; 
  //'SignUp';
  $Temp_PASSWORD = '';
  //'signingup';
  $DATABASE = 'MusiFi';

  $con = new mysqli($SERVER, $Temp_USERNAME, $Temp_PASSWORD, $DATABASE);

  //Check connection
  if (mysqli_connect_errno())
   {
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
   }

   else{
    //escape user input for security. Referenced https://www.tutorialrepublic.com/php-tutorial/php-mysql-insert-query.php this part

    $USERNAME = mysqli_real_escape_string($con, $_POST['username']);
    $PASSWORD = mysqli_real_escape_string($con, $_POST['password']);
    $EMAIL = mysqli_real_escape_string($con, $_REQUEST['SU_email']);
    $TYPE = $_POST['type'];

    // Form the SQL queries 

    //Create the user
    $new_user = "CREATE USER IF NOT EXISTS '$USERNAME'@'localhost' IDENTIFIED BY '$PASSWORD'";
    if(mysqli_query($con, $new_user)){
      echo "User created successfully.";
      } 
    else{
        echo "ERROR: Unable to execute query. " . mysqli_error($con);
    }
    //Add to User table
    //Make sure it is a username not already in use
    $add_user = "INSERT INTO User (Username, password, email)
    SELECT * FROM (SELECT '$USERNAME', '$PASSWORD', '$EMAIL') AS tmp
    WHERE NOT EXISTS (
        SELECT Username FROM User WHERE Username = '$USERNAME'
    ) LIMIT 1";

    //$add_user = "INSERT INTO User (Username, password, email) VALUES ('$USERNAME', '$PASSWORD', '$EMAIL')";

    if(mysqli_query($con, $add_user)){
      echo "<br> User successfully in MusiFi.";
      } 
    else{
        echo "<br> ERROR: Unable to execute query. " . mysqli_error($con);
    }

    //Grant SELECT privileges on all of MusiFi for all username 
    $access = "GRANT SELECT ON MusiFi.* TO '$USERNAME'@'localhost'";

    if(mysqli_query($con, $access)){
      echo "<br> Access succesfully set.";
      } 
    else{
        echo "<br> ERROR: Unable to execute query. " . mysqli_error($con);
    }

    //ARTIST PRIVILEGES VS USER PRIVILEGES.

    if ($TYPE == 'User'){
      echo '<br> You registered as a User.';

      //User Role.
      $grant = "GRANT ONLYUSERS TO '$USERNAME'@'localhost'";

      if(mysqli_query($con, $grant)){
        echo "<br> Privileges succesfully set.";
        } 
      else{
          echo "<br> ERROR: Unable to execute query. " . mysqli_error($con);
      }

    }
  else if ($TYPE == 'Artist'){

    echo "<br> You registered as an Artist.";

    //Insert into Artist table
    //Make sure it is a username not already in use
    $add_artist = "INSERT INTO Artist (ArtistName)
    SELECT * FROM (SELECT '$USERNAME') AS tmp
    WHERE NOT EXISTS (
        SELECT ArtistName FROM Artist WHERE ArtistName = '$USERNAME'
    ) LIMIT 1";

    if(mysqli_query($con, $add_artist)){
      echo "<br> Artist successfully in MusiFi.";
      } 
    else{
        echo "<br> ERROR: Unable to execute query. " . mysqli_error($con);
    }
    
    //Artist Role.

    $grant = "GRANT ONLYARTISTS TO '$USERNAME'@'localhost'";

      if(mysqli_query($con, $grant)){
        echo "<br> Privileges succesfully set.";
        } 
      else{
          echo "<br> ERROR: Unable to execute query. " . mysqli_error($con);
      }

    }
 }
 mysqli_close($con);

  ?>

</body>

<h2> Thank you for signing up!</h2>
<div> To continue, <a href="LoginForm.html" title="Login_Link"> login here </a> </div>
</html>