<?php
    
    include_once 'header.php';
    require_once 'includes/functions.inc.php';

    userCheck();

    if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1200)) {
        // last request was more than 30 minutes ago
        echo "<script>alert('You were logged out for inactivity.');window.location.href='login.php';</script>";
        session_unset();     // unset $_SESSION variable for the run-time 
        session_destroy();   // destroy session data in storage

    }
    $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
    
?>

        <section class="container">
            <div class="inner-container">
                <h1>Welcome to the user page</h1>
                <?php
                    include_once 'includes/dbh.inc.php';
                    require_once 'includes/functions.inc.php';
                    
                        if (isset($_SESSION["useruid"])) {
                            echo "<p>Howdy user " . $_SESSION["useruid"] ." </p>";

                        }
                ?>
                <h2>Make a payment or <a href='maintreq.php'>request for maintenance/repair.</a></h2>
                <?php
                    userShowProp($conn);
                    

                    userShowBal($conn);

                ?>
        

            </div>
        </section>
        
<?php
    include_once 'footer.php';
?>