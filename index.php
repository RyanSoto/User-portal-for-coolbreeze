<?php
    include_once 'header.php';

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
                <h1>Welcome to the resident portal</h1>
                    <?php
                            if (isset($_SESSION["useruid"])) {
                                echo "<p>Howdy " . $_SESSION["useruid"] ."</p>";

                            }
                    ?>
                    
                    <p>Make a payment or request maintenance/repair</p>
                
                    <section class="index-categories">
                            <h2><a href="login.php">Login Here</a></h2>
                            <!-- <div class="index-categories-list">
                                <div>
                                    <h3>Fun Stuff</h3>
                                </div>
                                <div>
                                    <h3>Serious Stuff</h3>
                                </div>
                                <div>
                                    <h3>Serious Stuff</h3>
                                </div>
                                <div>
                                    <h3>Boring Stuff</h3>
                                </div>
                            </div> -->
                    </section>
                </div>
            </section>

        
<?php
    include_once 'footer.php';
?>