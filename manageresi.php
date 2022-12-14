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
                    <h1>Welcome to the admin page</h1>
                    <?php
                            if (isset($_SESSION["useruid"])) {
                                echo "<p>Howdy admin user " . $_SESSION["useruid"] ."</p>";
                            }
                    ?>
                    <p>Time to take care of business!</p>
                    <section class="admin-categories">
                        <h2>Manage Residents</h2>
                        <div class="admin-categories-list">
                            <div>
                                <h3>Update</h3>
                            </div>
                        </div>
                    </section>
                    <?php
                        adminShowAllResi($conn)
                    ?>
                    <a href ="manageresinameasc.php"><h3> Sort by Name in ascending order</h3></a>
                    <a href ="manageresinamedesc.php"><h3> Sort by Name in descending order</h3></a>
                    <a href ="manageresibal.php"><h3> Sort by Balance</h3></a>
                </div>
            </section>
        
<?php
    include_once 'footer.php';
?>