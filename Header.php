<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="description" contents="Musify Header">
    </head>
    <body>
        <header>
            <?php
                $userID = 2;
                $con = connectDB();
                $sql="SELECT Username
                        FROM User
                        WHERE UserID = $userID";
                $result = mysqli_query($con, $sql);
                $row = mysqli_fetch_array($result);
                mysqli_close($con);
                echo "Logged in as " . $row['Username'];
            ?>
        </header>
