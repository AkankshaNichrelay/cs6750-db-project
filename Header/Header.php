<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="description" contents="Musify Header">
        <link rel="stylesheet" href="../Header/Header.css">
        <link rel="stylesheet" href="../Homepage/Homepage.css">
    </head>
    <body>
        <header>
            <ul class="navbar">
                <li class="navbar" style="float:left">
                    <a class="navbar" href="../Homepage/Homepage.php">Home</a>
                </li>
                <li class="navbar">
                    <a class="navbar" href="../Profile/Profile.php">
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
                    </a>
                </li>
            </ul>
        </header>
