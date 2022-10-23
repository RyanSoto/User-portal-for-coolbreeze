<?php


    include_once 'header.php';
    include_once 'includes/functions.inc.php';

    adminCheck();


    if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1200)) {
        // last request was more than 30 minutes ago
        echo "<script>alert('You were logged out for inactivity.');window.location.href='login.php';</script>"; // alert user and redirect
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
                        <h2>Make changes to the database or create a document</h2>
                        <div class="admin-categories-list">
                            <div>
                                <h3><a href='manageprop.php'>Manage Properties</a></h3>
                            </div>
                            <div>
                                <h3><a href='manageresi.php'>Manage Residents</a></h3>
                            </div>
                            <div>
                                <h3><a href='managemaint.php'>Manage Maintenance/Repair Requests</a></h3>
                            </div>
                            <div>
                                <h3><a href='makedoc.php'>Create a document</a></h3>
                            </div>
                        </div>
                    </section>
                </div>
            </section>
        
<?php
    include_once 'footer.php';
?>