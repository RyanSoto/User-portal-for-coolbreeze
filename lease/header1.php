<?php 
    session_start();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cool Breeze Login</title>
    <link rel="stylesheet" href="../../CSS/main.css">
</head>
<body>
        <nav class="header-nav">
            <section class="header-sec">
                <div class="icon-img"> 
                    <a class ="header-icon" href="../../index.php"><img src="../../img/Logo.png" alt="Logo"></a>
                </div>
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <?php
                            if (isset($_SESSION["useruid"])) {

                                if ($_SESSION["usertype"] == "admin") {
                                echo "<li><a href='admin.php'>Account</a></li>";
                                echo "<li><a href='includes/logout.inc.php'>Log out</a></li>";
                                } else {
                                    echo "<li><a href='user.php'>Account</a></li>";
                                    echo "<li><a href='includes/logout.inc.php'>Log out</a></li>";
                                }
                            }
                            else {
                                echo "<li><a href='login.php'>Login</a></li>";
                                echo "<li><a href='signup.php'>Sign Up</a></li>";
                            }
                            ?>
                </ul>
            </section>

        </nav>

    <div class="wrapper">