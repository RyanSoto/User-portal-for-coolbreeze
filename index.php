<?php
    include_once 'header.php';
    include_once 'includes/functions.inc.php';
    
    // timeOutLogout();


?>

            <section class="container">
                <div class="inner-container">
                <h1>Welcome to the resident portal</h1>
                    <?php
                            if (isset($_SESSION["useruid"])) {
                                echo "<p>Howdy " . $_SESSION["useruid"] ."</p>";

                            }
                            if (isset($_GET["success"])) {

                                if ($_GET["success"] == "submitted") {
                                    
                                    echo "<script>alert('You have successfully signed your lease.')</script>"; //;window.location.href='index.php';
                                    echo "<p>Your lease has been submitted and filed!</p>";
                                }

                                if ($_GET["success"] == "gen") {
                                    
                                    echo "<script>alert('Lease generated.')</script>"; //;window.location.href='index.php';
                                    echo "<p>The lease has been created and e-mailed to the tenant.</p>";
                                }

                                if ($_GET["success"] == "appsent") {
                                    
                                    echo "<script>alert('Application Sent!')</script>"; //;window.location.href='index.php';
                                    echo "<p>The application has been sent.</p>";
                                }
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