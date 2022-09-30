<?php 
    session_start();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Login Project</title>
</head>
<body>
        <nav>
            <div class="wrapper">
                <a href="index.php"><img src="img/LogoMakr-3m6JPf.png" alt="Logo"></a>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <?php
                        if (isset($_SESSION["useruid"])) {
                            echo "<li><a href='account.php'>Account</a></li>";
                            echo "<li><a href='includes/logout.inc.php'>Log out</a></li>";
                        }
                        else {
                            echo "<li><a href='login.php'>Login</a></li>";
                            echo "<li><a href='signup.php'>Sign Up</a></li>";
                        }
                        ?>
                </ul>
            </div>
        </nav>

    <div class="wrapper">