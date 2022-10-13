<!-- update rent, occupied, lease -->

<?php


    include_once 'header.php';

    if (!isset($_SESSION["useruid"]))
    {
        header("location:login.php?error=notloggedin");
        exit();
    } else 

    if  ($_SESSION["usertype"] == "user") {
        header("location: login.php?error=notadmin");
        exit();
    }

    if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1200)) {
        // last request was more than 30 minutes ago
        echo "<script>alert('You were logged out for inactivity.');window.location.href='login.php';</script>";
        session_unset();     // unset $_SESSION variable for the run-time 
        session_destroy();   // destroy session data in storage

    }
    $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp

    include_once 'includes/dbh.inc.php';
    include_once 'includes/functions.inc.php';

?>

    <section class="container">
                    <div class="inner-container">
                        <h1>Update Resident</h1>
                        <?php
                        adminShowReq($conn)
                        ?>
                    </div>
    </section>
                        